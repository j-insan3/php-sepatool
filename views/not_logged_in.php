
<!-- login form box -->
<center>
<br>
<link href="style.css" rel="stylesheet" type="text/css">
<form class="user-form" method="post" action="index.php?page=home" name="loginform">
<img src=img/logo.jpg>
<br>
<br>
<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
?>
<div class="field2">
<?php
            echo $error;
?>
</div>
<?php
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
?>
<div class="field2">
<?php
            echo $message;
?>
</div>
<?php
        }
    }
}
?>
<div class="field">
    <label for="login_input_username">Gebruikersnaam</label>
    <input id="login_input_username" class="login_input" type="text" name="user_name" required />
</div>
<div class ="field">
    <label for="login_input_password">Wachtwoord</label>
    <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
</div>
<div class ="field3">
    <input type="submit"  name="login" value="Log in" />
</div>

</form>


