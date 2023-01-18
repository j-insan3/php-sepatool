<?php
// Maak connectie
include 'connect.php';
include 'menu.php';

//bepaal wat te verwijderen
$delete = htmlspecialchars($_GET["delete"]);

if ($delete == 'debtor') {

//Welk lid
$id = htmlspecialchars($_GET["id"]);

//Welke dag
$endDate = date('Y-m-d');
// Set inactive
$Active = 1;
 //Voer query uit
 if ($stmt = $link->prepare("Update debtor SET endDate=?, Active=? WHERE id ='$id' ")) {

    // Bind the variables to the parameter as strings.
    $stmt->bind_param("si", $endDate, $Active);

    // Execute the statement.
    $stmt->execute();

    // Close the prepared statement.
    $stmt->close();

}
 echo 'Lid uitgeschreven';
}
 ?>
 <meta http-equiv="refresh" content="1; url=index.php?page=overzicht&view=debtors" />
