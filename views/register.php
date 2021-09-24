<?php
include 'menu.php';
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
include 'connect.php';
?>
<head>
<script src="sorttable.js"></script>
</head>
<link href="style.css" rel="stylesheet" type="text/css">
<!-- register form -->
<div class ="field3">
<strong> Nieuwe gebruiker toevoegen </strong>
</div>
<form class="user-form" method="post" action="register.php?page=beheer" name="registerform">
<div class="field">
    <!-- the user name input field uses a HTML5 pattern check -->
    <label for="login_input_username">Gebruikersnaam</label>
    <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
	<strong>alleen letters en cijfers, tussen de 2 en 64 karakters</strong>
</div>

    <!-- the email input field uses a HTML5 email type check -->
<div class ="field">
    <label for="login_input_email">E-mail adres</label>
    <input id="login_input_email" class="login_input" type="email" name="user_email" required />
</div>

<div class="field">
    <label for="login_input_password_new">Wachtwoord </label>
    <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
	<strong>minimaal 6 karakters</strong>
	</div>
	<div class ="field">
    <label for="login_input_password_repeat">Herhaal wachtwoord</label>
    <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
	</div>
	<br>
    <input type="submit"  name="register" value="Registreer" />
</form>


<div class="field2">
<strong>Huidige Gebruikers</strong>
</div>
<br>
<div class="field">
<table id="LedenTabel" class="sortable" border="1">
<thead>
<tr><th>Gebruikersnaam</th><th>Mail</th><th class="sorttable_nosort">Verwijderen?</th></tr>
</thead>
<?php
$query = "SELECT *
		FROM users"
		;
 $results = mysqli_query($link, $query);
while($row = mysqli_fetch_array($results))
{
  echo "<tr><td>"; 
  echo $row['user_name'];
  echo "</td><td>";   
  echo $row['user_email'];
  echo "</td><td>";  
  echo '<a href="index.php?page=verwijder&delete=user&id=' . htmlspecialchars($row['user_id']) . '">' 
        . htmlspecialchars('Verwijder') 
        . '</a>';
  echo "</td></tr>";			
  }
echo "</table>";
?>
</div>
