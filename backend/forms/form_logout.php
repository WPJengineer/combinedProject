<?php
session_start();

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
$log = $backend . 'logs/log.txt';
$handle = fopen($log, 'a');
if (!$handle) {
    echo "Cannot open log file";
} else {
    $message = "\n" . $_SESSION['customer_id'] . " " . $_SESSION['username'] . " " . "logged out" . " " . date('Y-m-d H:i:s');
    fwrite($handle, $message);
    fclose($handle);
}

session_destroy();
setcookie('language', null, -1, '/');
header("Location: ./form_login.php");
?>