<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
require($backend.'header.php');
include($backend.'/db/db_select_orders.php');
require($backend.'footer.php');

?>