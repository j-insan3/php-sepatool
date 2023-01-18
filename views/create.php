<?php
// Maak connectie
include 'connect.php';
include 'menu.php';

//Bepaal pagina
$create = htmlspecialchars($_GET["create"]);

if ( $create == 'debtor'){

//Vul variabelen vanuit POST
 $member=$_POST['member'];
 $debtor_name=$_POST['debtor_name'];
 $debtor_account_IBAN=$_POST['debtor_account_IBAN'];
 $debtor_mandate=$_POST['debtor_mandate'];
 $debtor_mandate_date=$_POST['debtor_mandate_date'];
 $member_type_id=$_POST['member_type_id'];
 $creditor_id=$_POST['creditor_id'];
 $member_lastname=$_POST['member_lastname'];
 $Adres=$_POST['Adres'];
 $PC=$_POST['PC'];
 $City=$_POST['City'];
 $Phone=$_POST['Phone'];
 $Email=$_POST['Email'];
 $BirthDate=$_POST['BirthDate'];
 $NBB=$_POST['NBB'];
 $Comment=$_POST['Comment'];

 //Voer query uit
 if ($stmt = $link->prepare("INSERT INTO debtor (member, member_lastname, Adres, PC, City, Phone, Email, BirthDate, NBB, Comment, debtor_name, debtor_account_IBAN, debtor_mandate, debtor_mandate_date, member_type_id, creditor_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ")) {

    // Bind the variables to the parameter as strings.
    $stmt->bind_param("sssssississsssii", $member, $member_lastname, $Adres, $PC, $City, $Phone, $Email, $BirthDate, $NBB, $Comment, $debtor_name, $debtor_account_IBAN, $debtor_mandate, $debtor_mandate_date, $member_type_id, $creditor_id);

    // Execute the statement.
    $stmt->execute();

    // Close the prepared statement.
    $stmt->close();

}
 echo 'Invoer succesvol';
 ?>
<meta http-equiv="refresh" content="1; url=index.php?page=invoeren&invoeren=debtor" />


<?php
} elseif ( $create == 'creditor') {
//Vul variabelen vanuit POST
 $creditor_name=$_POST['creditor_name'];
 $creditor_account_IBAN=$_POST['creditor_account_IBAN'];
 $creditor_agent_BIC=$_POST['creditor_agent_BIC'];
 $creditor_id=$_POST['creditor_id'];
 $local_instrument_code=$_POST['local_instrument_code'];
 $seq_type=$_POST['seq_type'];

 //Voer query uit
 if ($stmt = $link->prepare("INSERT INTO creditor (creditor_name, creditor_account_IBAN, creditor_agent_BIC, creditor_id, local_instrument_code, seq_type) VALUES (?, ?, ?, ?, ?, ?) ")) {

    // Bind the variables to the parameter as strings.
    $stmt->bind_param("ssssss", $creditor_name, $creditor_account_IBAN, $creditor_agent_BIC, $creditor_id, $local_instrument_code, $seq_type);

    // Execute the statement.
    $stmt->execute();

    // Close the prepared statement.
    $stmt->close();

}
 echo 'Invoer succesvol';
 ?>
<meta http-equiv="refresh" content="1; url=index.php?page=invoeren&invoeren=creditor" />

<?php
} elseif ( $create == 'membertype') {
//Vul variabelen vanuit POST
 $name=$_POST['name'];
 $amount=$_POST['amount'];
 $remittance_information=$_POST['remittance_information'];


//Voer query uit
 if ($stmt = $link->prepare("INSERT INTO member_type (name, amount, remittance_information)
							VALUES (?, ?, ?) ")) {

    // Bind the variables to the parameter as strings.
    $stmt->bind_param("sis", $name, $amount, $remittance_information);

     // Execute the statement.
    $stmt->execute();

    // Close the prepared statement.
    $stmt->close();

}
 echo 'Invoer succesvol';
 ?>
<meta http-equiv="refresh" content="2; url=index.php?page=invoeren&invoeren=membertype" />
<?php
}
?>
