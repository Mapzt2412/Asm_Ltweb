<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["fullname"]);
unset($_SESSION["loged"]);
header("Location: login.php");
?>