<?php
// Maak connectie
include 'connect.php';
include 'menu.php';

//bepaal wat te verwijderen
$delete = htmlspecialchars($_GET["delete"]);

if ($delete == 'debtor') {

//Welke hond
$id = htmlspecialchars($_GET["id"]);
 //Voer query uit
 if ($stmt = $link->prepare("DELETE FROM `debtor` WHERE `debtor`.`id` = ?")) {

    // Bind the variables to the parameter as strings.
    $stmt->bind_param("i", $id);

    // Execute the statement.
    $stmt->execute();

    // Close the prepared statement.
    $stmt->close();

}
 echo 'Debiteur Verwijderd';
 ?>
 <meta http-equiv="refresh" content="1; url=index.php?page=overzicht&view=debtors" />
<?php
}
elseif ($delete == 'creditor') {

//Wie
$id = htmlspecialchars($_GET["id"]);

//Check of deze crediteur geen debiteuren in de database heef staan

$query = "SELECT creditor_id
			FROM debtor
			WHERE creditor_id = '$id'";
$results = mysqli_query($link, $query);

if(mysqli_num_rows($results) == 0) {

//Voer query uit
 if ($stmt = $link->prepare("DELETE FROM `creditor` WHERE `creditor`.`id` = ?")) {

    // Bind the variables to the parameter as strings.
    $stmt->bind_param("i", $id);

    // Execute the statement.
    $stmt->execute();

    // Close the prepared statement.
    $stmt->close();

}
 echo 'crediteur Verwijderd';
 ?>
 <meta http-equiv="refresh" content="1; url=index.php?page=overzicht&view=creditors" />
 <?php
} else {
    // Nog debiteuren aanwezig

echo 'Nog debiteuren aanwezig';

}
}
elseif ($delete == 'membertype') {

//Wie
$id = htmlspecialchars($_GET["id"]);

//Check of er geen leden dit type lidmaatschap hebben

$query = "SELECT member_type_id
			FROM debtor
			WHERE member_type_id = '$id'";
$results = mysqli_query($link, $query);

if(mysqli_num_rows($results) == 0) {

//Voer query uit
 if ($stmt = $link->prepare("DELETE FROM `member_type` WHERE `member_type`.`id` = ?")) {

    // Bind the variables to the parameter as strings.
    $stmt->bind_param("i", $id);

    // Execute the statement.
    $stmt->execute();

    // Close the prepared statement.
    $stmt->close();

}
 echo 'Lidmaatschap Verwijderd';
 ?>
 <meta http-equiv="refresh" content="1; url=index.php?page=overzicht&view=membertype" />
 <?php
} else {

echo 'Nog leden met dit type lidmaatschap';

}
}
elseif ($delete == 'user') {

//Wie
$id = htmlspecialchars($_GET["id"]);

//Check of dit lid nog geen hond in de database heef staan

$query = "SELECT *
			FROM users
			WHERE user_id = '$id'";
$results = mysqli_query($link, $query);
$row = mysqli_fetch_array($results);

if( $_SESSION['user_name'] == $row['user_name']) {

    // Je mag niet jezelf verwijderen

echo 'Hey ';
echo $row['user_name'];
echo ', je kunt niet jezelf verwijderen! ';


} else {
//Voer query uit
 if ($stmt = $link->prepare("DELETE FROM `dog_db`.`users` WHERE `users`.`user_id` = ?")) {

    // Bind the variables to the parameter as strings.
   $stmt->bind_param("i", $id);

    // Execute the statement.
    $stmt->execute();
 
    // Close the prepared statement.
    $stmt->close();


 echo 'Gebruiker Verwijderd';
 }
 ?>
 <meta http-equiv="refresh" content="1; url=register.php?page=beheer" />
 <?php
}
}

?>
