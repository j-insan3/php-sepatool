<?php
include 'connect.php';
require APP_PATH . '/vendor/autoload.php';
use Digitick\Sepa\TransferFile\Factory\TransferFileFacadeFactory;
use Digitick\Sepa\PaymentInformation;

$select_id = htmlspecialchars($_GET["id"]);
//$select_id = 1;

$query = "SELECT *
                FROM creditor
		WHERE id='$select_id'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);
$seq_type_merge = "PaymentInformation::" . $row['seq_type'];

//Set the initial information
// third parameter 'pain.008.003.02' is optional would default to 'pain.008.002.02' if not changed
$directDebit = TransferFileFacadeFactory::createDirectDebit('SampleUniqueMsgId', 'SampleInitiatingPartyName', 'pain.008.003.02');

// create a payment, it's possible to create multiple payments,
// This creates a one time debit. If needed change use ::S_FIRST, ::S_RECURRING or ::S_FINAL respectively
$directDebit->addPaymentInfo('Incasso', array(
    'id'                    => 'Incasso',
//    'dueDate'               => new DateTime('now + 7 days'), // optional. Otherwise default period is used
    'creditorName'          => $row['creditor_name'],
    'creditorAccountIBAN'   => $row['creditor_account_IBAN'],
    'creditorAgentBIC'      => $row['creditor_agent_BIC'],
    'seqType'               => $seq_type_merge,
    'creditorId'            => $row['creditor_id'],
    'localInstrumentCode'   => $row['local_instrument_code'] // default. optional.
    // Add/Set batch booking option, you can pass boolean value as per your requirement, optional
    //'batchBooking'          => true,
));


$query_transactions = "SELECT debtor.*, creditor.*, member_type.*
                FROM debtor
                INNER JOIN creditor ON debtor.creditor_id=creditor.id
                INNER JOIN member_type ON debtor.member_type_id=member_type.id
		WHERE creditor.id='$select_id'";

$result_tr = mysqli_query($link, $query_transactions);

while ($row_tr = mysqli_fetch_array($result_tr))
{
// Add a Single Transaction to the named payment
$directDebit->addTransfer('Incasso', array(
    'amount'                => $row_tr['amount'], // `amount` should be in cents
    'debtorIban'            => $row_tr['debtor_account_IBAN'],
//    'debtorBic'             => 'OKOYFIHH',
    'debtorName'            => $row_tr['debtor_name'],
    'debtorMandate'         => $row_tr['debtor_mandate'],
    'debtorMandateSignDate' => $row_tr['debtor_mandate_date'],
    'remittanceInformation' => $row_tr['remittance_information'] . " " . $row_tr['member']
//    'endToEndId'            => 'Invoice-No ' // optional, if you want to provide additional structured info
));
}
// Retrieve the resulting XML
header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="sepa.xml"');
echo $directDebit->asXML();
