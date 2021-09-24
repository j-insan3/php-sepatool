<?php


include 'connect.php';
include 'menu.php';

//Wat updaten?
$update = htmlspecialchars($_GET["update"]);

if ($update == 'hond') {
$select_id = htmlspecialchars($_GET["id"]);
//Vraag gegevens op
$query = "SELECT Honden.*, Instructeur.InstructeurID, Instructeur.Naam InsNaam, Cursus.CursusNaam CursusNaam, Leden.Naam LidNaam, Leden.Achternaam
	FROM Honden 
	INNER JOIN Instructeur ON Honden.InstructeurID=Instructeur.InstructeurID 
	INNER JOIN Cursus ON Honden.CursusID=Cursus.CursusID 
	INNER JOIN Leden ON Honden.lidID=Leden.lidID
	WHERE Honden.HondID='$select_id'";

$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

// Maak formulier 
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=update&update=hond" method="post">
<input type="hidden" name="HondID" value="<?php echo $select_id; ?>" /><br />
<div class="field">
<label>Naam:</label> <input type="text" name="Naam" value="<?php echo $row['HondNaam']; ?>" autofocus/><br />
 </div>
<div class="field">
<label>Ras:</label> <input type="text" name="Ras" value="<?php echo $row['Ras']; ?>" /><br />
 </div>
<div class="field">
<label>Geb datum:</label> <input type="date" name = "Datum" placeholder="(YYYY-MM-DD)" value="<?php echo $row['GebDatum']; ?>" /><br>
 </div>
<div class="field">
<label>Stamboom:</label> <input type="text" name = "Stamboomnaam" value="<?php echo $row['Stamboomnaam']; ?>" /><br> 
 </div>
 <div class="field">
<label>Chip:</label> <input type="text" name = "ChipNR" value="<?php echo $row['ChipNR']; ?>" /><br> 
 </div>
<div class="field">
<label>Eigenaar:</label> <select name="lidID">
<option value="<?php echo $row['lidID']; ?>"><?php echo $row['LidNaam']; ?> <?php echo $row['Achternaam']; ?> (huidige)</option> 
<?php
$query2 = "SELECT Naam, lidID, Achternaam
	FROM Leden
	ORDER BY `Leden`.`Achternaam` ASC";
$result2 = mysqli_query($link, $query2);
while ($row2 = mysqli_fetch_array($result2)) 
{    
	echo '<option value="' . htmlspecialchars($row2['lidID']) . '">' 
        . htmlspecialchars($row2['Achternaam'] ) . htmlspecialchars(" "). htmlspecialchars( $row2['Naam']) 
        . '</option>';
}
echo '</select>' ;
?>
<br>
 </div>
<div class="field">
<label>Instructeur:</label> <select name="Instructeur">
<option value="<?php echo $row['InstructeurID']; ?>"><?php echo $row['InsNaam']; ?> (huidige)</option> 
<?php
$query3 = "SELECT *
	FROM Instructeur
	ORDER BY `Instructeur`.`Naam` ASC";
$result3 = mysqli_query($link, $query3);
while ($row3 = mysqli_fetch_array($result3)) 
{    
	echo '<option value="' . htmlspecialchars($row3['InstructeurID']) . '">' 
        . htmlspecialchars($row3['Naam']) 
        . '</option>';
}
echo '</select>' ;
?>
<br>
 </div>
<div class="field">
<label>Cursus:</label> <select name="Cursus">
<option value="<?php echo $row['CursusID']; ?>"><?php echo $row['CursusNaam']; ?> (huidige)</option> 
<?php
$query4 = "SELECT *
	FROM Cursus";
$result4 = mysqli_query($link, $query4);
while ($row4 = mysqli_fetch_array($result4)) 
{    
	echo '<option value="' . htmlspecialchars($row4['CursusID']) . '">' 
        . htmlspecialchars($row4['CursusNaam']) 
        . '</option>';
}
echo '</select>' ;
?>

 </div>
<input type="submit" value="Wijzig" />
</form>

<?php
} elseif ($update == 'lid') {
$select_id = htmlspecialchars($_GET["id"]);
//Vraag gegevens op
$query = "SELECT *
	FROM Leden 
	WHERE lidID='$select_id'";

$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

// Maak formulier 
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=update&update=lid" method="post">
<input type="hidden" name="lidID" value="<?php echo $select_id; ?>" /><br />
<div class="field">
<label>Voornaam:</label> <input type="text" name="Naam" value="<?php echo $row['Naam']; ?>" autofocus/><br />
 </div>
<div class="field">
<label>Achternaam:</label> <input type="text" name="Achternaam" value="<?php echo $row['Achternaam']; ?>" /><br />
 </div>
<div class="field">
<label>Adres:</label> <input type="text" name = "Adres" value="<?php echo $row['Adres']; ?>" /><br>
 </div>
<div class="field">
<label>Postcode:</label> <input type="text" name = "PostCode" maxlength="6" value="<?php echo $row['PostCode']; ?>" /><br> 
 </div>
<div class="field">
<label>Woonplaats:</label> <input type="text" name = "Woonplaats" value="<?php echo $row['Woonplaats']; ?>" /><br> 
 </div>
<div class="field">
<label>Telefoonnummer:</label> <input type="number" name = "Telefoonnummer" maxlength="10" value="<?php echo $row['Telefoonnummer']; ?>" /><br> 
 </div>
 <div class="field">
<label>Email:</label> <input type="email" name = "Email" maxlength="50" value="<?php echo $row['Email']; ?>" /><br> 
 </div>
<input type="submit" value="Wijzig" />
</form>
<?php
} elseif ($update == 'cursus') {

$select_id = htmlspecialchars($_GET["id"]);
//Vraag gegevens op
$query = "SELECT *
	FROM Cursus
	WHERE CursusID='$select_id'";

$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

// Maak formulier 
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=update&update=cursus" method="post"> 
<input type="hidden" name="CursusID" value="<?php echo $select_id; ?>" /><br />
<div class="field">
<label>Cursusnaam:</label> 
<input type="text" name="CursusNaam" value="<?php echo $row['CursusNaam']; ?>" autofocus required/><br />
</div>
<div class="field">
<label>Naam Diploma:</label> 
<input type="text" name="DiplomaNaam" value="<?php echo $row['DiplomaNaam']; ?>" /><br />
</div>
<div class="field">
<label>Onderdeel 1:</label> 
<input type="text" name = "Cdeel1" value="<?php echo $row['Cdeel1']; ?>" /><br>
<label>Punten:</label> 
<input type="number" name = "Punten1" maxlength="2" value="<?php echo $row['Punten1']; ?>"/><br> 
</div>
<div class="field">
<label>Onderdeel 2:</label> 
 <input type="text" name = "Cdeel2" value="<?php echo $row['Cdeel2']; ?>" /><br> 
<label>Punten:</label> 
<input type="number" name = "Punten2" maxlength="2" value="<?php echo $row['Punten2']; ?>"/><br> 
</div>
<div class="field">
<label>Onderdeel 3:</label> 
<input type="text" name = "Cdeel3" value="<?php echo $row['Cdeel3']; ?>"/><br>
<label>Punten:</label> 
<input type="number" name = "Punten3" maxlength="2" value="<?php echo $row['Punten3']; ?>"/><br> 
</div>
<div class="field">
<label>Onderdeel 4:</label> 
 <input type="text" name = "Cdeel4" value="<?php echo $row['Cdeel4']; ?>" /><br> 
<label>Punten:</label> 
<input type="number" name = "Punten4" maxlength="2" value="<?php echo $row['Punten4']; ?>"/><br> 
</div>
<div class="field">
<label>Onderdeel 5:</label> 
<input type="text" name = "Cdeel5" value="<?php echo $row['Cdeel5']; ?>"/><br>
<label>Punten:</label> 
<input type="number" name = "Punten5" maxlength="2" value="<?php echo $row['Punten5']; ?>"/><br> 
</div>
<div class="field">
<label>Onderdeel 6:</label> 
 <input type="text" name = "Cdeel6"  value="<?php echo $row['Cdeel6']; ?>"/><br> 
<label>Punten:</label> 
<input type="number" name = "Punten6" maxlength="2" value="<?php echo $row['Punten6']; ?>"/><br> 
</div>
<div class="field">
<label>Onderdeel 7:</label> 
<input type="text" name = "Cdeel7" value="<?php echo $row['Cdeel7']; ?>"/><br>
<label>Punten:</label> 
<input type="number" name = "Punten7" maxlength="2" value="<?php echo $row['Punten7']; ?>"/><br> 
</div>
<div class="field">
<label>Onderdeel 8:</label> 
 <input type="text" name = "Cdeel8"  value="<?php echo $row['Cdeel8']; ?>"/><br> 
<label>Punten:</label> 
<input type="number" name = "Punten8" maxlength="2" value="<?php echo $row['Punten8']; ?>"/><br> 
</div>
<div class="field">
<label>Onderdeel 9:</label> 
<input type="text" name = "Cdeel9" value="<?php echo $row['Cdeel9']; ?>"/><br>
<label>Punten:</label> 
<input type="number" name = "Punten9" maxlength="2" value="<?php echo $row['Punten9']; ?>"/><br> 
</div>
<div class="field">
<label>Onderdeel 10:</label> 
 <input type="text" name = "Cdeel10"  value="<?php echo $row['Cdeel10']; ?>"/><br> 
<label>Punten:</label> 
<input type="number" name = "Punten10" maxlength="2" value="<?php echo $row['Punten10']; ?>"/><br> 
</div>
<div class="field">
<label>Onderdeel 11:</label> 
<input type="text" name = "Cdeel11" value="<?php echo $row['Cdeel11']; ?>"/><br>
<label>Punten:</label> 
<input type="number" name = "Punten11" maxlength="2" value="<?php echo $row['Punten11']; ?>"/><br> 
</div>
<input type="submit" value="Update"> 
</form> 

<?php

}elseif ($update == 'instructeur') {

$select_id = htmlspecialchars($_GET["id"]);
//Vraag gegevens op
$query = "SELECT *
	FROM Instructeur 
	WHERE InstructeurID='$select_id'";

$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

// Maak formulier 
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=update&update=instructeur" method="post">
<input type="hidden" name="InstructeurID" value="<?php echo $select_id; ?>" /><br />
<div class="field">
<label>Instructeur:</label> <input type="text" name="Instructeur" value="<?php echo $row['Naam']; ?>" autofocus/><br />
 </div>
<input type="submit" value="Wijzig" />
</form>
<?php
}elseif ($update == 'user') {

$select_id = htmlspecialchars($_SESSION["user_name"]);

//Vraag gegevens op
$query = "SELECT *
	FROM users 
	WHERE user_name='$select_id'";

$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

// Maak formulier 
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=update&update=user" method="post">
<input type="hidden" name="user_id" value="<?php echo $select_id; ?>" /><br />
<div class="field">
<label>Wachtwoord:</label> <input type="password" name="password" pattern=".{6,}" required autofocus/><br />
 </div>
 <div class="field">
<label>Herhaal Wachtwoord:</label> <input type="password" name="password_repeat" pattern=".{6,}" required/><br />
 </div>
 <div class="field">
<label>E-mail:</label> <input type="email" name="mail" value="<?php echo $row['user_email']; ?>"autofocus/><br />
 </div>
<input type="submit" value="Wijzig" />
</form>
<?php
}


?>
