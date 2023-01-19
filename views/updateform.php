<?php


include 'connect.php';
include 'menu.php';
?>
<script>
/*
 * Returns 1 if the IBAN is valid 
 * Returns FALSE if the IBAN's length is not as should be (for CY the IBAN Should be 28 chars long starting with CY )
 * Returns any other number (checksum) when the IBAN is invalid (check digits do not match)
 */
function isValidIBANNumber(input) {
    var CODE_LENGTHS = {
        AD: 24, AE: 23, AT: 20, AZ: 28, BA: 20, BE: 16, BG: 22, BH: 22, BR: 29,
        CH: 21, CR: 21, CY: 28, CZ: 24, DE: 22, DK: 18, DO: 28, EE: 20, ES: 24,
        FI: 18, FO: 18, FR: 27, GB: 22, GI: 23, GL: 18, GR: 27, GT: 28, HR: 21,
        HU: 28, IE: 22, IL: 23, IS: 26, IT: 27, JO: 30, KW: 30, KZ: 20, LB: 28,
        LI: 21, LT: 20, LU: 20, LV: 21, MC: 27, MD: 24, ME: 22, MK: 19, MR: 27,
        MT: 31, MU: 30, NL: 18, NO: 15, PK: 24, PL: 28, PS: 29, PT: 25, QA: 29,
        RO: 24, RS: 22, SA: 24, SE: 24, SI: 19, SK: 24, SM: 27, TN: 24, TR: 26,   
        AL: 28, BY: 28, CR: 22, EG: 29, GE: 22, IQ: 23, LC: 32, SC: 31, ST: 25,
        SV: 28, TL: 23, UA: 29, VA: 22, VG: 24, XK: 20
    };
    var iban = String(input).toUpperCase().replace(/[^A-Z0-9]/g, ''), // keep only alphanumeric characters
            code = iban.match(/^([A-Z]{2})(\d{2})([A-Z\d]+)$/), // match and capture (1) the country code, (2) the check digits, and (3) the rest
            digits;
    // check syntax and length
    console.log("code",code);
    console.log("iban",iban);
    if (!code || iban.length !== CODE_LENGTHS[code[1]]) {
      document.getElementById("iban").classList.add("error");
      document.getElementById("errorMessage").innerHTML = "IBAN Lengte FOUT!";      
    }
    // rearrange country code and check digits, and convert chars to ints
    digits = (code[3] + code[1] + code[2]).replace(/[A-Z]/g, function (letter) {
        return letter.charCodeAt(0) - 55;
    });
    // final check
    return mod97(digits);
}

function mod97(string) {
    var checksum = string.slice(0, 2), fragment;
    for (var offset = 2; offset < string.length; offset += 7) {
        fragment = String(checksum) + string.substring(offset, offset + 7);
        checksum = parseInt(fragment, 10) % 97;
    }
    if ( checksum != 1 ) {
      document.getElementById("iban").classList.add("error");
      document.getElementById("errorMessage").innerHTML = "IBAN FOUT!";
    }
        else {
        document.getElementById("iban").classList.remove("error");
        document.getElementById("errorMessage").innerHTML = "";
        }
    //return checksum;
}
</script>
<style>
.error {
border: 3px solid red;
}
.error-text {
color: red;
}
</style>

<?php

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
<option value="RCUR">Recurring</option>
<option value="FRST">First</option>
<option value="FNAL">Final</option>
<option value="OOFF">Single</option>
</select>

 </div>
<input type="submit" value="Wijzig" />
</form>

<?php
} elseif ($update == 'debtor') {
$select_id = htmlspecialchars($_GET["id"]);
//Vraag gegevens op
$query = "SELECT debtor.*, creditor.id, creditor.creditor_name, member_type.*
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
<label>Voornaam Lid:</label> <input type="text" name="member" value="<?php echo $row['member']; ?>" autofocus/><br />
 </div>
<div class="field">
  <label>Achternaam:</label>
  <input type="text" name = "member_lastname" value="<?php echo $row['member_lastname']; ?>"><br>
</div>
<div class="field">
  <label>Adres:</label>
  <input type="text" name = "Adres" value="<?php echo $row['Adres']; ?>"><br>
</div>
<div class="field">
  <label>Postcode:</label>
  <input type="text" name = "PC" value="<?php echo $row['PC']; ?>"><br>
</div>
<div class="field">
  <label>Stad:</label>
  <input type="text" name = "City" value="<?php echo $row['City']; ?>"><br>
</div>
<div class="field">
  <label>Telefoon:</label>
  <input type="number" name = "Phone" value="<?php echo $row['Phone']; ?>"><br>
</div>
<div class="field">
  <label>Email:</label>
  <input type="email" name = "Email" value="<?php echo $row['Email']; ?>"><br>
</div>
<div class="field">
  <label>Geboortedatum:</label>
  <input type="date" name = "BirthDate" placeholder="(YYYY-MM-DD)" value="<?php echo $row['BirthDate']; ?>"><br>
</div>
<div class="field">
  <label>NBB:</label>
  <input type="number" name = "NBB" value="<?php echo $row['NBB']; ?>"><br>
</div>
<div class="field">
  <label>Comment:</label>
  <input type="text" name = "Comment" value="<?php echo $row['Comment']; ?>"><br>
</div>
<div class="field">
<label>Debiteur Naam:</label> <input type="text" name="debtor_name" value="<?php echo $row['debtor_name']; ?>" /><br />
 </div>
<div class="field">
<label>IBAN:</label> <input type="text" name = "debtor_account_IBAN" id="iban" onchange="isValidIBANNumber(document.getElementById('iban').value);" value="<?php echo $row['debtor_account_IBAN']; ?>" />
<span id="errorMessage" class="error-text"></span> <br>
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
<label>Soort:</label>
<input type="text" name="name" value="<?php echo $row['name']; ?>" autofocus required/><br />
</div>
<div class="field">
<label>Bedrag in centen:</label>
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
