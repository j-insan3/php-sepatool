<?php


include 'connect.php';
include 'menu.php';

//IBAN Check
?>
<head>
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
</head>
<?php
//Wat invoeren?
$invoeren = htmlspecialchars($_GET["invoeren"]);

if ($invoeren == 'debtor') {
?>


<link href="style.css" rel="stylesheet" type="text/css">
<form name="debtorform" class="user-form" action="index.php?page=create&create=debtor" method="post">
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
  <input type="text" name = "debtor_account_IBAN" id="iban" onchange="isValidIBANNumber(document.getElementById('iban').value);">
  <span id="errorMessage" class="error-text"></span>
</div>
<div class="field">
  <label>Mandaat:</label>
  <input type="text" name = "debtor_mandate" id="mandate"><br>
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
 <input type="button" onclick="alertValidIBAN(document.getElementById('iban').value);" value="Check IBAN">
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
<input type="text" name="creditor_account_IBAN" required id="iban"/>
<br />
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
 <option value="CORE">CORE</option>
 </select>
</div>
<div class="field">
<label>Type:</label>
<select name = "seq_type" required value="RCUR"/><br>
<option value="RCUR">Recurring</option>
<option value="FRST">First</option>
<option value="FNAL">Final</option>
<option value="OOFF">Single</option>
</select>
</div>
<input type="submit" value="Voeg toe">
 <input type="button" onclick="alertValidIBAN(document.getElementById('iban').value);" value="Check IBAN">

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
