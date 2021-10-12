<?php


include 'connect.php';
include 'menu.php';

//Wat updaten?
$update = htmlspecialchars($_GET["update"]);

if ($update == 'creditor') {
$select_id = htmlspecialchars($_GET["id"]);
//Vraag gegevens op
$query = "SELECT *
	FROM creditor
	WHERE id='$select_id'";

$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

// Maak formulier
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=update&update=creditor" method="post">
<input type="hidden" name="id" value="<?php echo $select_id; ?>" /><br />
<div class="field">
<label>Crediteur:</label> <input type="text" name="creditor_name" value="<?php echo $row['creditor_name']; ?>" autofocus/><br />
 </div>
<div class="field">
<label>IBAN:</label> <input type="text" name="creditor_account_IBAN" value="<?php echo $row['creditor_account_IBAN']; ?>" /><br />
 </div>
<div class="field">
<label>BIC:</label> <input type="text" name = "creditor_agent_BIC" value="<?php echo $row['creditor_agent_BIC']; ?>" /><br>
 </div>
<div class="field">
<label>Incassant ID:</label> <input type="text" name = "creditor_id" value="<?php echo $row['creditor_id']; ?>" /><br>
 </div>
 <div class="field">
<label>Code:</label> <select name = "local_instrument_code">
	<option value="<?php echo $row['local_instrument_code']; ?>"> <?php echo $row['local_instrument_code']; ?> </option>
</select>
 </div>
<div class="field">
<label>Type:</label> <select name="seq_type">
<option value="<?php echo $row['seq_type']; ?>"><?php echo $row['seq_type']; ?> (huidige)</option>
<option value="S_RECURRING">Recurring</option>
<option value="S_FIRST">First</option>
<option value="S_FINAL">Final</option>
<option value="S_ONEOFF">Single</option>
</select>

 </div>
<input type="submit" value="Wijzig" />
</form>

<?php
} elseif ($update == 'debtor') {
$select_id = htmlspecialchars($_GET["id"]);
//Vraag gegevens op
$query = "SELECT debtor.*, creditor.*, member_type.*
	FROM debtor
	INNER JOIN member_type ON debtor.member_type_id=member_type.id
	INNER JOIN creditor ON debtor.creditor_id=creditor.id
	WHERE id='$select_id'";

$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

// Maak formulier
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=update&update=debtor" method="post">
<input type="hidden" name="id" value="<?php echo $select_id; ?>" /><br />
<div class="field">
<label>Lid:</label> <input type="text" name="member" value="<?php echo $row['member']; ?>" autofocus/><br />
 </div>
<div class="field">
<label>Debiteur Naam:</label> <input type="text" name="debtor_name" value="<?php echo $row['debtor_name']; ?>" /><br />
 </div>
<div class="field">
<label>IBAN:</label> <input type="text" name = "debtor_account_IBAN" value="<?php echo $row['debtor_account_IBAN']; ?>" /><br>
 </div>
<div class="field">
<label>Mandaat:</label> <input type="text" name = "debtor_mandate" maxlength="8" value="<?php echo $row['debtor_mandate']; ?>" /><br>
 </div>
<div class="field">
<label>Ingangsdatum:</label> <input type="date" name = "debtor_mandate_date" value="<?php echo $row['debtor_mandate_date']; ?>" /><br>
 </div>
<div class="field">
<label>Soort lid:</label> <select name = "member_type_id">
 <option value="<?php echo $row['member_type_id']; ?>"><?php echo $row['name']; ?> (huidige)</option>
 <?php
$query_member_types = "SELECT name, id
	FROM member_type
	ORDER BY `name`ASC";
$result_member_types = mysqli_query($link, $query_member_types);
while ($row_member_types = mysqli_fetch_array($result_member_types))
{
        echo '<option value="' . htmlspecialchars($row_member_types['id']) . '">'
        . htmlspecialchars($row_member_types['name'] )
        . '</option>';
}
echo '</select>' ;
?>
<br>
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
