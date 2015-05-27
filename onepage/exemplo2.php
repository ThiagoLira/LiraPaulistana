<?php
require_once "php/login.php";
?>

<form method="POST" action="loginTeste.php">
<input type="text" id="user" name="user" required />
<input type="password" id="pass" name="pass" required />
<input type="submit" id="submit" name="submit" value="Login">
</form>