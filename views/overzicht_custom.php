<html>
<head>
<script src="sorttable.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<script>
function toggleColumn(n) {
    var currentClass = document.getElementById("mytable").className;
    if (currentClass.indexOf("show"+n) != -1) {
        document.getElementById("mytable").className = currentClass.replace("show"+n, "");
    }
    else {
        document.getElementById("mytable").className += " " + "show"+n;
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

if ($view == 'leden') {
?>
<body>
<h1>Overzicht Leden</h1>
<br>
<div class="field2">
<a id="dlink"  style="display:none;"></a>

<input type="button" onclick="tableToExcel('LedenTabel', 'leden', 'ledenoverzicht.xls')" value="Exporteer naar Excel">
</div>
<br>
<table id="LedenTabel" class="sortable" border="1">
<thead>
<tr><th>Voornaam</th><th>Achternaam</th><th>Adres</th><th>PostCode</th><th>Woonplaats</th><th>Telefoonnummer</th><th>Email</th><th class="sorttable_nosort">Verwijderen?</th></tr>
</thead>
<?php
 $query = "SELECT *
		FROM Leden"
		;
 $results = mysqli_query($link, $query);
while($row = mysqli_fetch_array($results))
{
  echo "<tr><td>"; 
  echo '<a href="index.php?page=updateform&update=lid&id=' . htmlspecialchars($row['lidID']) . '">' 
        . htmlspecialchars($row['Naam']) 
        . '</a>';
  echo "</td><td>";   
  echo '<a href="index.php?page=updateform&update=lid&id=' . htmlspecialchars($row['lidID']) . '">' 
        . htmlspecialchars($row['Achternaam']) 
        . '</a>';
  echo "</td><td>";    
  echo $row['Adres'];
  echo "</td><td>";  
  echo $row['PostCode'];
  echo "</td><td>";   
  echo $row['Woonplaats'];
  echo "</td><td>";    
  echo $row['Telefoonnummer'];
  echo "</td><td>";
  echo $row['Email'];
  echo "</td><td>";
  echo '<a href="index.php?page=verwijder&delete=lid&id=' . htmlspecialchars($row['lidID']) . '">' 
        . htmlspecialchars('Verwijder') 
        . '</a>';
  echo "</td></tr>";			
  }
echo "</table>";
}
elseif ($view == 'honden') {
?>
<body>
<h1>Overzicht Honden</h1>
<br>
<div class="field3">
<label><input type='checkbox' onclick='toggleColumn(1);'>Inclusief NAW eigenaar</label>
</div>
<br>
<div class="field2">
<a id="dlink"  style="display:none;"></a>

<input type="button" onclick="tableToExcel('mytable', 'honden', 'hondenoverzicht.xls')" value="Exporteer naar Excel">
</div>
<br>
<table id="mytable" class="sortable" border="1">
<thead>
<tr><th>Naam Hond</th><th>Voornaam</th><th>Achternaam</th><th>Ras</th><th>Stamboom</th><th>Instructeur</th><th>Geboortedatum</th><th>Chip</th><th>Cursus</th><th class='col1'>Adres</th><th class='col1'>Postcode</th><th class='col1'>Woonplaats</th><th class='col1'>Telefoonnummer</th><th class='col1'>Email</th><th class="sorttable_nosort">Verwijderen?</th></tr>
</thead>
<?php
 $query = "SELECT *, Leden.Naam NaamLid, Leden.Achternaam, Instructeur.Naam InsNaam, Cursus.CursusNaam CurNaam, Leden.Adres, Leden.PostCode, Leden.Woonplaats, Leden.Telefoonnummer, Leden.Email
		FROM Honden
		INNER JOIN Instructeur ON Honden.InstructeurID=Instructeur.InstructeurID 
		INNER JOIN Cursus ON Honden.CursusID=Cursus.CursusID 
		INNER JOIN Leden ON Honden.lidID=Leden.lidID";
 $results = mysqli_query($link, $query);
while($row = mysqli_fetch_array($results))
{
  echo "<tr><td>"; 
  echo '<a href="index.php?page=updateform&update=hond&id=' . htmlspecialchars($row['HondID']) . '">' 
        . htmlspecialchars($row['HondNaam']) 
        . '</a>';
  echo "</td><td>";   
  echo $row['NaamLid'];
  echo "</td><td>";   
  echo $row['Achternaam'];
  echo "</td><td>";    
  echo $row['Ras'];
  echo "</td><td>";  
  echo $row['Stamboomnaam'];
  echo "</td><td>";   
  echo $row['InsNaam'];
  echo "</td><td>";   
  echo $row['GebDatum'];
  echo "</td><td>";
  echo $row['ChipNR'];
    echo "</td><td>";  
  if ($row['CursusID'] == '0' ) {
  echo $row['CurNaam'];
  } else {
  echo '<a href="diploma.php?&id=' . htmlspecialchars($row['HondID']) . '" target="_blank">' 
        . htmlspecialchars($row['CurNaam']) 
        . '</a>';
  };
  echo "</td><td class='col1'>";  
  echo $row['Adres'];
  echo "</td><td class='col1'>";
  echo $row['PostCode'];
  echo "</td><td class='col1'>";
  echo $row['Woonplaats'];
  echo "</td><td class='col1'>";
  echo $row['Telefoonnummer'];
  echo "</td><td class='col1'>";
  echo $row['Email'];
  echo "</td><td>";
    echo '<a href="index.php?page=verwijder&delete=hond&id=' . htmlspecialchars($row['HondID']) . '">' 
        . htmlspecialchars('Verwijder') 
        . '</a>';
  echo "</td></tr>"; 
 }
echo "</table>";
}
elseif ($view == 'cursus') {
?>
<body>
<h1>Overzicht Cursussen</h1>
<div class="field2">
<a id="dlink"  style="display:none;"></a>

<input type="button" onclick="tableToExcel('HondenTabel', 'cursus', 'cursusoverzicht.xls')" value="Exporteer naar Excel">
</div>
<br>
<table id="HondenTabel" class="sortable" border="1">
<thead>
<tr><th>Naam Cursus</th><th>Naam Diploma</th><th class="sorttable_nosort">Verwijderen?</th></tr>
</thead>
<?php
 $query = "SELECT * 
			FROM Cursus";
 $results = mysqli_query($link, $query);
while($row = mysqli_fetch_array($results))
{
if ($row['CursusID'] == '0' ) {  // Verberg de Curus 'geen'
	} else {  
  echo "<tr><td>"; 
  echo '<a href="index.php?page=updateform&update=cursus&id=' . htmlspecialchars($row['CursusID']) . '">' 
        . htmlspecialchars($row['CursusNaam']) 
        . '</a>';
  echo "</td><td>";   
  echo $row['DiplomaNaam'];
  echo "</td><td>";   
  echo '<a href="index.php?page=verwijder&delete=cursus&id=' . htmlspecialchars($row['CursusID']) . '">' 
        . htmlspecialchars('Verwijder') 
        . '</a>';
  echo "</td></tr>"; 
  }
 }
echo "</table>";
}
elseif ($view == 'instructeurs') {
?>
<body>
<h1>Overzicht Instructeurs</h1>
<br>
<div class="field2">
<a id="dlink"  style="display:none;"></a>

<input type="button" onclick="tableToExcel('HondenTabel', 'instructeurs', 'instructeursoverzicht.xls')" value="Exporteer naar Excel">
</div>
<br>
<table id="HondenTabel" class="sortable" border="1">
<thead>
<tr><th>Naam Instructeur</th><th class="sorttable_nosort">Verwijderen?</th></tr>
</thead>
<?php
 $query = "SELECT * 
			FROM Instructeur";
 $results = mysqli_query($link, $query);
while($row = mysqli_fetch_array($results))
{
if ($row['InstructeurID'] == '0' ) {  // Verberg de Curus 'geen'
	} else {  
  echo "<tr><td>"; 
  echo '<a href="index.php?page=updateform&update=instructeur&id=' . htmlspecialchars($row['InstructeurID']) . '">' 
        . htmlspecialchars($row['Naam']) 
        . '</a>';
  echo "</td><td>";   
  echo '<a href="index.php?page=verwijder&delete=instructeur&id=' . htmlspecialchars($row['InstructeurID']) . '">' 
        . htmlspecialchars('Verwijder') 
        . '</a>';
  echo "</td></tr>"; 
  }
 }
echo "</table>";
}




