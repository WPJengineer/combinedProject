<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');

?>
<main class="min-h-screen bg-green flex flex-col">
<?php include($backend.'/db/db_select_orders.php'); ?>
</main>

<?php

require($backend.'footer.php');

?>