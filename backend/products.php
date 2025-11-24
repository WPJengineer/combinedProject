<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require_once($backend.'header.php');

?>
<main class="min-h-screen bg-green flex flex-col">
<?php include($backend.'/db/db_select_products.php'); ?>
</main>

<?php

require_once($backend.'footer.php');

?>