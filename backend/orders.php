<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');

?>
<main class="bg-green flex flex-col items-center justify-center" style="flex: 1;">
<?php include($backend.'/db/db_select_orders.php'); ?>
</main>

<?php

require($backend.'footer.php');

?>