<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');
if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}



?>

<main>
    <div id="myPlot" style="width:100%;max-width:700px"></div>
</main>

<?php

require($backend.'footer.php');

?>