<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

if (!isset($_SESSION["employee"])) {
    header("Location: ess-login.php");
}

require_once '../globals.include.php';
?>
<form action="/reports.php">
<input type="text" id="city" name="city" value="Katy">
<input type="submit" namne="submit" value="Submit">
</form>
