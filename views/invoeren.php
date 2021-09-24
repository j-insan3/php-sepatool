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
<div class="field">
  <label>Ingangsdatum:</label>
  <input type="date" name = "debtor_mandate_date" placeholder="(YYYY-MM-DD)"><br>
</div>
<div class="field">
<label>Soort lid:</label>
<select name="member_type_id">
 <?php
$query2 = "SELECT name, id
	FROM member_type
	ORDER BY `name`ASC";
$result2 = mysqli_query($link, $query2);
while ($row2 = mysqli_fetch_array($result2))
{
	echo '<option value="' . htmlspecialchars($row2['id']) . '">'
        . htmlspecialchars($row2['name'])
        . '</option>';
}
echo '</select>' ;
?>
</div>
<div class="field">
<label>Crediteur:</label>
<select name="creditor_id">
<?php
$query3 = "SELECT id, creditor_name
	FROM creditor";
$result3 = mysqli_query($link, $query3);
while ($row3 = mysqli_fetch_array($result3))
{
	echo '<option value="' . htmlspecialchars($row3['id']) . '">'
        . htmlspecialchars($row3['creditor_name'])
        . '</option>';
}
echo '</select>' ;
?>
</div>

 <input type="submit" value="Voeg toe">
 </form>

<?php
} elseif($invoeren == 'creditor') {
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=create&create=creditor" method="post">
<div class="field">
<label>Crediteur:</label>
<input type="text" name="creditor_name" autofocus required /><br />
</div>
<div class="field">
<label>IBAN:</label>
<input type="text" name="creditor_account_IBAN" required /><br />
</div>
<div class="field">
<label>BIC:</label>
<input type="text" name = "creditor_agent_BIC" required /><br>
</div>
<div class="field">
<label>Incassant ID:</label>
<input type="text" name = "creditor_id" maxlength="6" required /><br>
</div>
<div class="field">
<label>Code:</label>
 <select name = "local_instrument_code" required value="CORE" /><br>
 <option value="CORE"></option>
</div>
<div class="field">
<label>Type:</label>
<select name = "seq_type" required value="S_RECURRING"/><br>
<option value="S_RECURRING"></option>
<option value="S_FIRST"></option>
<option value="S_FINAL"></option>
<option value="S_ONEOFF"></option>
</div>
<input type="submit" value="Voeg toe">
</form>
 <?php
} elseif($invoeren == 'membertype') {
?>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" action="index.php?page=create&create=membertype" method="post">
<div class="field">
<label>Soort:</label>
<input type="text" name="name" autofocus required/><br />
</div>
<div class="field">
<label>Bedrag in centen</label>
<input type="number" name="amount" /><br />
</div>
<div class="field">
<label>Omschrijving:</label>
<input type="text" name = "remittance_information" /><br>
</div>
<input type="submit" value="Voeg toe">
</form>

 <?php
} else {
echo 'geen geldige parameter';
}
?>
