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
	WHERE debtor.id='$select_id'";

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
 <label>Crediteur:</label> <select name = "creditor_id">
  <option value="<?php echo $row['creditor_id']; ?>"><?php echo $row['creditor_name']; ?> (huidige)</option>
  <?php
 $query_creditors = "SELECT creditor_name, id
 	FROM creditor
 	ORDER BY `creditor_name`ASC";
 $result_creditors = mysqli_query($link, $query_creditors);
 while ($row_creditors = mysqli_fetch_array($result_creditors))
 {
         echo '<option value="' . htmlspecialchars($row_creditors['id']) . '">'
         . htmlspecialchars($row_creditors['creditor_name'] )
         . '</option>';
 }
 echo '</select>' ;
 ?>
 <br>
  </div>
<input type="submit" value="Wijzig" />
</form>
<?php
} elseif ($update == 'membertype') {

$select_id = htmlspecialchars($_GET["id"]);
//Vraag gegevens op
$query = "SELECT *
	FROM member_type
	WHERE id='$select_id'";

$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);

// Maak formulier
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=update&update=membertype" method="post">
<input type="hidden" name="id" value="<?php echo $select_id; ?>" /><br />
<div class="field">
<label>Bedrag in centen:</label>
<input type="text" name="name" value="<?php echo $row['name']; ?>" autofocus required/><br />
</div>
<div class="field">
<label>Amount:</label>
<input type="number" name = "amount" maxlength="4" value="<?php echo $row['amount']; ?>"/><br>
</div>
<div class="field">
<label>Omschrijving:</label>
 <input type="text" name = "remittance_information" value="<?php echo $row['remittance_information']; ?>" /><br>
</div>
<input type="submit" value="Update">
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
