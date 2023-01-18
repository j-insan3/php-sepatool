<html>
<head>
<script type="text/javascript" src="jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="style-table.js"></script>
<script src="sorttable.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<script>
function toggleColumn(n) {
    var currentClass = document.getElementById("debtorTable").className;
    if (currentClass.indexOf("show"+n) != -1) {
        document.getElementById("debtorTable").className = currentClass.replace("show"+n, "");
    }
    else {
        document.getElementById("debtorTable").className += " " + "show"+n;
    }
}
var tableToExcel = (function () {
        var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
        return function (table, name, filename) {
            if (!table.nodeType) table = document.getElementById(table)
            var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }

            document.getElementById("dlink").href = uri + base64(format(template, ctx));
            document.getElementById("dlink").download = filename;
            document.getElementById("dlink").click();

        }
    })()
</script>
</head>
<?php
include 'connect.php';
include 'menu.php';

//bepaal view
$view = htmlspecialchars($_GET["view"]);

if ($view == 'debtors') {
?>
<body>
<h1>Overzicht Leden</h1>
<br>
<div class="field2">
<a id="dlink"  style="display:none;"></a>

<input type="button" onclick="tableToExcel('debtorTable', 'debtor', 'ledenoverzicht.xls')" value="Exporteer naar Excel">
<label><input type='checkbox' onclick='toggleColumn(1);'>Inclusief Betaalgegevens</label>
</div>
<br>
<table id="debtorTable" class="sortable" border="0">
<thead>
<tr><th>Voornaam</th><th>Achternaam</th><th>Adres</th><th>PC</th><th>Plaats</th><th>Telefoon</th><th>Email</th><th>Geb. Datum</th><th>NBB</th><th>Soort Lidmaatschap</th><th class='col1'>Incasso tnv</th><th class='col1'>IBAN</th><th class='col1'>Mandate ID</th><th class='col1'>Mandate datum</th><th class='col1'>Crediteur</th><th class="sorttable_nosort">Verwijderen?</th></tr>
</thead>
<tbody>
<?php
 $query = "SELECT debtor.*, member_type.name, creditor.creditor_name
           FROM debtor
           INNER JOIN member_type ON debtor.member_type_id=member_type.id
           INNER JOIN creditor ON debtor.creditor_id=creditor.id
		       "
		;
 $results = mysqli_query($link, $query);
 
while($row = mysqli_fetch_array($results))
{
  echo "<tr><td>";
  echo '<a href="index.php?page=updateform&update=debtor&id=' . htmlspecialchars($row['id']) . '">'
        . htmlspecialchars($row['member'])
        . '</a>';
  echo "</td><td>";
  echo '<a href="index.php?page=updateform&update=debtor&id=' . htmlspecialchars($row['id']) . '">'
        . htmlspecialchars($row['member_lastname'])
        . '</a></td>';
  echo "<td>" . $row['Adres'] . "</td>";
  echo "<td>" . $row['PC'] . "</td>";
  echo "<td>" . $row['City'] . "</td>";
  echo "<td>" . $row['Phone'] . "</td>";
  echo "<td>" . $row['Email'] . "</td>";
  echo "<td>" . $row['BirthDate'] . "</td>";
  echo "<td>" . $row['NBB'] . "</td>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td class='col1'>" . $row['debtor_name'] . "</td>";
  echo "<td class='col1'>" . $row['debtor_account_IBAN'] . "</td>";
  echo "<td class='col1'>" . $row['debtor_mandate'] . "</td>";
  echo "<td class='col1'>" . $row['debtor_mandate_date'] . "</td>";
  echo "<td class='col1'>" . $row['creditor_name'] . "</td>";
  echo "<td>";
  echo '<a href="index.php?page=verwijder&delete=debtor&id=' . htmlspecialchars($row['id']) . '">'
        . htmlspecialchars('Verwijder')
        . '</a>';
  echo "</td></tr>";
  }
echo "</tbody></table>";
}
elseif ($view == 'creditors') {
?>
<body>
<h1>Crediteuren</h1>
<br>
<br>
<div class="field2">
<a id="dlink"  style="display:none;"></a>

<input type="button" onclick="tableToExcel('mytable', 'creditors', 'creditors.xls')" value="Exporteer naar Excel">
</div>
<br>
<table id="mytable" class="sortable" border="0">
<thead>
<tr><th>Crediteur</th><th>IBAN</th><th>BIC</th><th>Incassant ID</th><th>Code</th><th>Type</th><th>SEPA</th><th class="sorttable_nosort">Verwijderen?</th></tr>
</thead>
<tbody>
<?php
 $query = "SELECT *
		FROM creditor";
 $results = mysqli_query($link, $query);
while($row = mysqli_fetch_array($results))
{
  echo '<tr><td scope="row">';
  echo '<a href="index.php?page=updateform&update=creditor&id=' . htmlspecialchars($row['id']) . '">'
        . htmlspecialchars($row['creditor_name'])
        . '</a>';
  echo "</td><td>";
  echo $row['creditor_account_IBAN'];
  echo "</td><td>";
  echo $row['creditor_agent_BIC'];
  echo "</td><td>";
  echo $row['creditor_id'];
  echo "</td><td>";
  echo $row['local_instrument_code'];
  echo "</td><td>";
  echo $row['seq_type'];
  echo "</td><td>";
    echo '<a href="index.php?page=sepaexport&id=' . htmlspecialchars($row['id']) . '">'
        . htmlspecialchars('Maak SEPA XML')
        . '</a>';
  echo "</td><td>";
    echo '<a href="index.php?page=verwijder&delete=creditor&id=' . htmlspecialchars($row['id']) . '">'
        . htmlspecialchars('Verwijder')
        . '</a>';
  echo "</td></tr>";
 }
echo "</tbody></table>";
}
elseif ($view == 'membertype') {
?>
<body>
<h1>Overzicht soorten lidmaatschap</h1>
<br>
<div class="field2">
<a id="dlink"  style="display:none;"></a>

<input type="button" onclick="tableToExcel('membertypetable', 'membertype', 'lidmaatschapoverzicht.xls')" value="Exporteer naar Excel">
</div>
<br>
<table id="membertypetable" class="sortable" border="0">
<thead>
<tr><th>Naam</th><th>Bedrag</th><th>Omschrijving</th><th class="sorttable_nosort">Verwijderen?</th></tr>
</thead>
<?php
 $query = "SELECT *
			FROM member_type";
 $results = mysqli_query($link, $query);
while($row = mysqli_fetch_array($results))
{
if ($row['id'] == '0' ) {  // Verberg de Curus 'geen'
	} else {
  echo "<tr><td>";
  echo '<a href="index.php?page=updateform&update=membertype&id=' . htmlspecialchars($row['id']) . '">'
        . htmlspecialchars($row['name'])
        . '</a>';
  echo "</td><td>";
  echo $row['amount'];
  echo "</td><td>";
  echo $row['remittance_information'];
  echo "</td><td>";
  echo '<a href="index.php?page=verwijder&delete=membertype&id=' . htmlspecialchars($row['id']) . '">'
        . htmlspecialchars('Verwijder')
        . '</a>';
  echo "</td></tr>";

  }
 }
echo "</table>";

}

?>
</body>
</html>
