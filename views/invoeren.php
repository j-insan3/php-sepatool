<?php


include 'connect.php';
include 'menu.php';

//Wat invoeren?
$invoeren = htmlspecialchars($_GET["invoeren"]);

if ($invoeren == 'debtor') {
?>


<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=create&create=debtor" method="post">
<div class="field">
  <label>Lid:</label>
  <input type="text" name="member" autofocus required ><br>
</div>
<div class="field">
  <label>Debiteur Naam:</label>
  <input type="text" name = "debtor_name" required><br>
</div>
<div class="field">
  <label>IBAN:</label>
  <input type="text" name = "debtor_account_IBAN"><br>
</div>
<div class="field">
  <label>Mandaat:</label>
  <input type="text" name = "debtor_mandate"><br>
</div>
  <label>Ingangsdatum:</label>
  <input type="date" name = "debtor_mandate_date" placeholder="(YYYY-MM-DD)"><br>
</div>
<div class="field">
<label>Soort lid:</label>
 <?php
$query2 = "SELECT name, id
	FROM member_type
	ORDER BY `name`ASC";
$result2 = mysqli_query($link, $query2);
while ($row2 = mysqli_fetch_array($result2))
{
	echo '<option value="' . htmlspecialchars($row2['id']) . '">'
        . htmlspecialchars($row2['name'] ))
        . '</option>';
}
echo '</select>' ;
?>
</div>
<div class="field">
<label>Instructeur:</label>
<select name="Instructeur">
<?php
$query3 = "SELECT *
	FROM Instructeur";
$result3 = mysqli_query($link, $query3);
while ($row3 = mysqli_fetch_array($result3))
{
	echo '<option value="' . htmlspecialchars($row3['InstructeurID']) . '">'
        . htmlspecialchars($row3['Naam'])
        . '</option>';
}
echo '</select>' ;
?>
</div>
<div class="field">
<label>Cursus:</label>
<select name="Cursus">
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

 <input type="submit" value="Voeg toe">
 </form>
 <?php
} elseif($invoeren == 'lid') {
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=create&create=lid" method="post">
<div class="field">
<label>Voornaam:</label>
<input type="text" name="Naam" autofocus required /><br />
</div>
<div class="field">
<label>Achternaam:</label>
<input type="text" name="Achternaam" required /><br />
</div>
<div class="field">
<label>Adres:</label>
<input type="text" name = "Adres" required /><br>
</div>
<div class="field">
<label>Postcode:</label>
<input type="text" name = "PostCode" maxlength="6" required /><br>
</div>
<div class="field">
<label>Woonplaats:</label>
 <input type="text" name = "Woonplaats" required /><br>
</div>
<div class="field">
<label>Telefoonnummer:</label>
<input type="number" name = "Telefoonnummer" maxlength="10" /><br>
</div>
<div class="field">
<label>Email:</label>
<input type="email" name = "Email" maxlength="50" /><br>
</div>
<input type="submit" value="Voeg toe">
</form>
 <?php
} elseif($invoeren == 'cursus') {
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=create&create=cursus" method="post">
<div class="field">
<label>Cursusnaam:</label>
<input type="text" name="CursusNaam" autofocus required/><br />
</div>
<div class="field">
<label>Naam Diploma:</label>
<input type="text" name="DiplomaNaam" /><br />
</div>
<div class="field">
<label>Onderdeel 1:</label>
<input type="text" name = "Cdeel1" /><br>
<label>Punten:</label>
<input type="number" name = "Punten1" maxlength="2" /><br>
</div>
<div class="field">
<label>Onderdeel 2:</label>
 <input type="text" name = "Cdeel2"  /><br>
<label>Punten:</label>
<input type="number" name = "Punten2" maxlength="2" /><br>
</div>
<div class="field">
<label>Onderdeel 3:</label>
<input type="text" name = "Cdeel3" /><br>
<label>Punten:</label>
<input type="number" name = "Punten3" maxlength="2" /><br>
</div>
<div class="field">
<label>Onderdeel 4:</label>
 <input type="text" name = "Cdeel4"  /><br>
<label>Punten:</label>
<input type="number" name = "Punten4" maxlength="2" /><br>
</div>
<div class="field">
<label>Onderdeel 5:</label>
<input type="text" name = "Cdeel5" /><br>
<label>Punten:</label>
<input type="number" name = "Punten5" maxlength="2" /><br>
</div>
<div class="field">
<label>Onderdeel 6:</label>
 <input type="text" name = "Cdeel6"  /><br>
<label>Punten:</label>
<input type="number" name = "Punten6" maxlength="2" /><br>
</div>
<div class="field">
<label>Onderdeel 7:</label>
<input type="text" name = "Cdeel7" /><br>
<label>Punten:</label>
<input type="number" name = "Punten7" maxlength="2" /><br>
</div>
<div class="field">
<label>Onderdeel 8:</label>
 <input type="text" name = "Cdeel8"  /><br>
<label>Punten:</label>
<input type="number" name = "Punten8" maxlength="2" /><br>
</div>
<div class="field">
<label>Onderdeel 9:</label>
<input type="text" name = "Cdeel9" /><br>
<label>Punten:</label>
<input type="number" name = "Punten9" maxlength="2" /><br>
</div>
<div class="field">
<label>Onderdeel 10:</label>
 <input type="text" name = "Cdeel10"  /><br>
<label>Punten:</label>
<input type="number" name = "Punten10" maxlength="2" /><br>
</div>
<div class="field">
<label>Onderdeel 11:</label>
<input type="text" name = "Cdeel11" /><br>
<label>Punten:</label>
<input type="number" name = "Punten11" maxlength="2" /><br>
</div>
<input type="submit" value="Voeg toe">
</form>
 <?php
 } elseif ($invoeren == 'instructeur') {

 // Maak formulier
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=create&create=instructeur" method="post">
<div class="field">
<label>Instructeur:</label> <input type="text" name="Instructeur" autofocus required/><br />
 </div>
<input type="submit" value="Voeg toe" />
</form>
<?php

} else {
echo 'geen geldige parameter';
}
?>
