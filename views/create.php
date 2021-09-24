<?php
// Maak connectie
include 'connect.php';
include 'menu.php';

//Bepaal pagina
$create = htmlspecialchars($_GET["create"]);

if ( $create == 'hond'){

//Vul variabelen vanuit POST
 $Naam=$_POST['Naam']; 
 $Ras=$_POST['Ras']; 
 $lidID=$_POST['lidID']; 
 $Datum=$_POST['Datum'];
 $Stamboomnaam=$_POST['Stamboomnaam'];
 $Instructeur=$_POST['Instructeur'];
 $Cursus=$_POST['Cursus'];
 $ChipNR=$_POST['ChipNR'];

 //Voer query uit
 if ($stmt = $link->prepare("INSERT INTO Honden (HondNaam, Ras, GebDatum, Stamboomnaam, InstructeurID, lidID, CursusID, ChipNR) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ")) {
 
    // Bind the variables to the parameter as strings. 
    $stmt->bind_param("ssssiiis", $Naam, $Ras, $Datum, $Stamboomnaam, $Instructeur, $lidID, $Cursus, $ChipNR);
 
    // Execute the statement.
    $stmt->execute();
 
    // Close the prepared statement.
    $stmt->close();
 
}
 echo 'Invoer succesvol';
 ?> 
<meta http-equiv="refresh" content="2; url=index.php?page=invoeren&invoeren=hond" />
<?php
} elseif ( $create == 'lid') {
//Vul variabelen vanuit POST
 $Naam=$_POST['Naam']; 
 $Achternaam=$_POST['Achternaam']; 
 $Adres=$_POST['Adres']; 
 $PostCode=$_POST['PostCode'];
 $Woonplaats=$_POST['Woonplaats'];
 $Telefoonnummer=$_POST['Telefoonnummer'];
 $Email=$_POST['Email'];

 //Voer query uit
 if ($stmt = $link->prepare("INSERT INTO Leden (Naam, Achternaam, Adres, PostCode, Woonplaats, Telefoonnummer, Email) VALUES (?, ?, ?, ?, ?, ?, ?) ")) {
 
    // Bind the variables to the parameter as strings. 
    $stmt->bind_param("sssssss", $Naam, $Achternaam, $Adres, $PostCode, $Woonplaats, $Telefoonnummer, $Email);
 
    // Execute the statement.
    $stmt->execute();
 
    // Close the prepared statement.
    $stmt->close();
 
}
 echo 'Invoer succesvol';
 ?> 
<meta http-equiv="refresh" content="2; url=index.php?page=invoeren&invoeren=hond" />

<?php
} elseif ( $create == 'cursus') {
//Vul variabelen vanuit POST
 $CursusNaam=$_POST['CursusNaam']; 
 $DiplomaNaam=$_POST['DiplomaNaam']; 
 $Cdeel1=$_POST['Cdeel1']; 
 $Punten1=$_POST['Punten1'];
 $Cdeel2=$_POST['Cdeel2'];
 $Punten2=$_POST['Punten2'];
 $Cdeel3=$_POST['Cdeel3']; 
 $Punten3=$_POST['Punten3'];
 $Cdeel4=$_POST['Cdeel4'];
 $Punten4=$_POST['Punten4'];
 $Cdeel5=$_POST['Cdeel5']; 
 $Punten5=$_POST['Punten5'];
 $Cdeel6=$_POST['Cdeel6'];
 $Punten6=$_POST['Punten6'];
 $Cdeel7=$_POST['Cdeel7']; 
 $Punten7=$_POST['Punten7'];
 $Cdeel8=$_POST['Cdeel8'];
 $Punten8=$_POST['Punten8'];
 $Cdeel9=$_POST['Cdeel9']; 
 $Punten9=$_POST['Punten9'];
 $Cdeel10=$_POST['Cdeel10'];
 $Punten10=$_POST['Punten10'];
 $Cdeel11=$_POST['Cdeel11'];
 $Punten11=$_POST['Punten11'];

 
//Voer query uit
 if ($stmt = $link->prepare("INSERT INTO Cursus (CursusNaam, DiplomaNaam, Cdeel1, Cdeel2, Cdeel3, Cdeel4, Cdeel5, Cdeel6, Cdeel7, Cdeel8, Cdeel9, Cdeel10, Cdeel11, Punten1, Punten2, Punten3, Punten4, Punten5, Punten6, Punten7, Punten8, Punten9, Punten10, Punten11) 
							VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ")) {
 
    // Bind the variables to the parameter as strings. 
    $stmt->bind_param("ssssssssssssssssssssssss", $CursusNaam, $DiplomaNaam, $Cdeel1, $Cdeel2, $Cdeel3, $Cdeel4, $Cdeel5, $Cdeel6, $Cdeel7, $Cdeel8, $Cdeel9, $Cdeel10, $Cdeel11, $Punten1, $Punten2, $Punten3, $Punten4, $Punten5, $Punten6, $Punten7, $Punten8, $Punten9, $Punten10, $Punten11);
 
 
    // Execute the statement.
    $stmt->execute();
 
    // Close the prepared statement.
    $stmt->close();
 
}
 echo 'Invoer succesvol';
 ?> 
<meta http-equiv="refresh" content="2; url=index.php?page=invoeren&invoeren=cursus" />
<?php
} elseif ( $create == 'instructeur') {
//Vul variabelen vanuit POST
 $Instructeur=$_POST['Instructeur']; 
 
//Voer query uit
 if ($stmt = $link->prepare("INSERT INTO Instructeur (Naam) 
							VALUES (?) ")) {
 
    // Bind the variables to the parameter as strings. 
    $stmt->bind_param("s", $Instructeur);
 
 
    // Execute the statement.
    $stmt->execute();
 
    // Close the prepared statement.
    $stmt->close();
 
}
 echo 'Invoer succesvol';
 ?> 
<meta http-equiv="refresh" content="2; url=index.php?page=invoeren&invoeren=instructeur" />
<?php
}
?>

