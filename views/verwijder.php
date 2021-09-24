<?php
// Maak connectie
include 'connect.php';
include 'menu.php';

//bepaal wat te verwijderen
$delete = htmlspecialchars($_GET["delete"]);

if ($delete == 'hond') {

//Welke hond
$id = htmlspecialchars($_GET["id"]);
 //Voer query uit
 if ($stmt = $link->prepare("DELETE FROM `dog_db`.`Honden` WHERE `Honden`.`HondID` = ?")) {
 
    // Bind the variables to the parameter as strings. 
    $stmt->bind_param("i", $id);
 
    // Execute the statement.
    $stmt->execute();
 
    // Close the prepared statement.
    $stmt->close();
 
}
 echo 'Hond Verwijderd';
 ?>
 <meta http-equiv="refresh" content="1; url=index.php?page=overzicht&view=honden" />
<?php
}
elseif ($delete == 'lid') {

//Wie
$id = htmlspecialchars($_GET["id"]);

//Check of dit lid nog geen hond in de database heef staan

$query = "SELECT lidID 
			FROM Honden 
			WHERE lidID = '$id'";
$results = mysqli_query($link, $query);

if(mysqli_num_rows($results) == 0) {

//Voer query uit
 if ($stmt = $link->prepare("DELETE FROM `dog_db`.`Leden` WHERE `Leden`.`lidID` = ?")) {
 
    // Bind the variables to the parameter as strings. 
    $stmt->bind_param("i", $id);
 
    // Execute the statement.
    $stmt->execute();
 
    // Close the prepared statement.
    $stmt->close();
 
}
 echo 'Lid Verwijderd';
 ?>
 <meta http-equiv="refresh" content="1; url=index.php?page=overzicht&view=leden" />
 <?php
} else {
    // Lid heeft nog een hond

echo 'Lid heeft nog een hond! Verwijderen onmogelijk';

}
}
elseif ($delete == 'cursus') {

//Wie
$id = htmlspecialchars($_GET["id"]);

//Check of dit lid nog geen hond in de database heef staan

$query = "SELECT CursusID 
			FROM Honden 
			WHERE lidID = '$id'";
$results = mysqli_query($link, $query);

if(mysqli_num_rows($results) == 0) {

//Voer query uit
 if ($stmt = $link->prepare("DELETE FROM `dog_db`.`Cursus` WHERE `Cursus`.`CursusID` = ?")) {
 
    // Bind the variables to the parameter as strings. 
    $stmt->bind_param("i", $id);
 
    // Execute the statement.
    $stmt->execute();
 
    // Close the prepared statement.
    $stmt->close();
 
}
 echo 'Cursus Verwijderd';
 ?>
 <meta http-equiv="refresh" content="1; url=index.php?page=overzicht&view=cursus" />
 <?php
} else {
    // Cursus heeft nog een hond op zijn naam

echo 'Deze cursus heeft nog een hond ingeschreven staan! Verwijderen onmogelijk';

}
}
elseif ($delete == 'instructeur') {

//Wie
$id = htmlspecialchars($_GET["id"]);

//Check of dit lid nog geen hond in de database heef staan

$query = "SELECT InstructeurID 
			FROM Honden 
			WHERE InstructeurID = '$id'";
$results = mysqli_query($link, $query);

if(mysqli_num_rows($results) == 0) {

//Voer query uit
 if ($stmt = $link->prepare("DELETE FROM `dog_db`.`Instructeur` WHERE `Instructeur`.`InstructeurID` = ?")) {
 
    // Bind the variables to the parameter as strings. 
    $stmt->bind_param("i", $id);
 
    // Execute the statement.
    $stmt->execute();
 
    // Close the prepared statement.
    $stmt->close();
 
}
 echo 'Instructeur Verwijderd';
 ?>
 <meta http-equiv="refresh" content="1; url=index.php?page=overzicht&view=instructeur" />
 <?php
} else {
    // Instructeur heeft nog een hond op zijn naam

echo 'Deze instructeur heeft nog een hond op zijn naam staan! Verwijderen onmogelijk';

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

