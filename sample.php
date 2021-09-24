<?php
require __DIR__ . '/vendor/autoload.php';
use Digitick\Sepa\TransferFile\Factory\TransferFileFacadeFactory;
use Digitick\Sepa\PaymentInformation;

//Set the initial information
// third parameter 'pain.008.003.02' is optional would default to 'pain.008.002.02' if not changed
$directDebit = TransferFileFacadeFactory::createDirectDebit('SampleUniqueMsgId', 'SampleInitiatingPartyName', 'pain.008.003.02');

// create a payment, it's possible to create multiple payments,
// "firstPayment" is the identifier for the transactions
// This creates a one time debit. If needed change use ::S_FIRST, ::S_RECURRING or ::S_FINAL respectively
$directDebit->addPaymentInfo('unionIncasso', array(
    'id'                    => 'unionIncasse',
    'dueDate'               => new DateTime('now + 7 days'), // optional. Otherwise default period is used
    'creditorName'          => 'BC Union',
    'creditorAccountIBAN'   => 'FI1350001540000056',
    'creditorAgentBIC'      => 'PSSTFRPPMON',
    'seqType'               => PaymentInformation::S_RECURRING,
    'creditorId'            => 'DE21WVM1234567890',
    'localInstrumentCode'   => 'CORE' // default. optional.
    // Add/Set batch booking option, you can pass boolean value as per your requirement, optional
    //'batchBooking'          => true, 
));

// Add a Single Transaction to the named payment
$directDebit->addTransfer('unionIncasso', array(
    'amount'                => 1500, // `amount` should be in cents
    'debtorIban'            => 'NL39SNSB0908960557',
//    'debtorBic'             => 'OKOYFIHH',
    'debtorName'            => 'JE Bruggeman',
    'debtorMandate'         => 'AB12345',
    'debtorMandateSignDate' => '13.10.2012',
    'remittanceInformation' => 'Contributie',
    'endToEndId'            => 'Invoice-No X' // optional, if you want to provide additional structured info
));
// Retrieve the resulting XML
//echo $directDebit->asXML();
