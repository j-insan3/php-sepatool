<?php
// Maak connectie
include 'connect.php';
include 'menu.php';

//Bepaal pagina
$update = htmlspecialchars($_GET["update"]);

if ( $update == 'creditor'){

//Vul variabelen vanuit POST
 $id=$_POST['id'];
 $creditor_name=$_POST['creditor_name'];
 $creditor_account_IBAN=$_POST['creditor_account_IBAN'];
 $creditor_agent_BIC=$_POST['creditor_agent_BIC'];
 $creditor_id=$_POST['creditor_id'];
 $local_instrument_code=$_POST['local_instrument_code'];
 $seq_type=$_POST['seq_type'];

 //Voer query uit
 if ($stmt = $link->prepare("UPDATE creditor SET creditor_name=?, creditor_account_IBAN=?, creditor_agent_BIC=?, creditor_id=?, local_instrument_code=?, seq_type=? WHERE id='$id'")) {

    // Bind the variables to the parameter as strings.
    $stmt->bind_param("ssssss", $creditor_name, $creditor_account_IBAN, $creditor_agent_BIC, $creditor_id, $local_instrument_code, $seq_type);

    // Execute the statement.
    $stmt->execute();

    // Close the prepared statement.
    $stmt->close();

}
 echo 'Update succesvol';
 ?>
 <meta http-equiv="refresh" content="2; url=index.php?page=overzicht&view=creditors" />
 <?php

} elseif ( $update == 'debtor'){

//Vul variabelen vanuit POST
 $id=$_POST['id'];
 $member=$_POST['member'];
 $debtor_name=$_POST['debtor_name'];
 $debtor_account_IBAN=$_POST['debtor_account_IBAN'];
 $debtor_mandate=$_POST['debtor_mandate'];
 $debtor_mandate_date=$_POST['debtor_mandate_date'];
 $member_type_id=$_POST['member_type_id'];
 $creditor_id=$_POST['creditor_id'];

 //Voer query uit
 if ($stmt = $link->prepare("UPDATE debtor SET member=?, debtor_name=?, debtor_account_IBAN=?, debtor_mandate=?, debtor_mandate_date=?, member_type_id=?, creditor_id=? WHERE id='$id'")) {

    // Bind the variables to the parameter as strings.
    $stmt->bind_param("sssssii", $member, $debtor_name, $debtor_account_IBAN, $debtor_mandate, $debtor_mandate_date, $member_type_id, $creditor_id);

    // Execute the statement.
    $stmt->execute();

    // Close the prepared statement.
    $stmt->close();

}
 echo 'Update succesvol';
?>
<meta http-equiv="refresh" content="2; url=index.php?page=overzicht&view=debtors" />

<?php
} elseif ( $update == 'membertype'){
//Vul variabelen vanuit POST
 $id=$_POST['id'];
 $name=$_POST['name'];
 $amount=$_POST['amount'];
 $remittance_information=$_POST['remittance_information'];


//Voer query uit
 if ($stmt = $link->prepare("UPDATE member_type SET name=?, amount=?, remittance_information=? WHERE id='$id'")) {

    // Bind the variables to the parameter as strings.
    $stmt->bind_param("sis", $name, $amount, $remittance_information);

    // Execute the statement.
    $stmt->execute();

    // Close the prepared statement.
    $stmt->close();

}
 echo 'Invoer succesvol';
 ?>
<meta http-equiv="refresh" content="2; url=index.php?page=overzicht&view=membertype" />

<?php
} elseif ( $update == 'user'){


//Vul variabelen vanuit POST
 $id=$_SESSION['user_name'];
 $password=$_POST['password'];
 $password_repeat=$_POST['password_repeat'];
 $mail=$_POST['mail'];
 $password_hash = password_hash($password, PASSWORD_DEFAULT);

 if ( $password == $password_repeat ) {

 //Voer query uit
 if ($stmt = $link->prepare("UPDATE users SET user_password_hash=?, user_email=? WHERE user_name='$id'")) {

    // Bind the variables to the parameter as strings.
    $stmt->bind_param("ss", $password_hash, $mail);

    // Execute the statement.
    $stmt->execute();

    // Close the prepared statement.
    $stmt->close();

}
 echo 'Update succesvol';
}
else {
echo 'Wachtwoorden komen niet overeen!';
}
}
?>
