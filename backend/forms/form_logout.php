<?php
session_start();
session_destroy();
setcookie('language', null, -1, '/');
header("Location: ./form_login.php");
?>