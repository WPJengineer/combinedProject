<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');

?>
<main class="bg-green flex flex-col" style="flex: 1;">
<?php include($backend.'/db/db_select_customers.php'); ?>
</main>

<?php

require($backend.'footer.php');

?>