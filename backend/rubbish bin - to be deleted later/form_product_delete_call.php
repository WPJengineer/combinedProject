<?php
// no longer needed
$product_id = $_GET['product_id'];
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
require($backend.'header.php');

?>

<main>
    <form class="call-form" action="/student014/online_shop/backend/forms/form_product_delete.php" method="POST">
        <p>Which product do you want to delete?</p>
        <p class="input-id">
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id" value="<?php echo $product_id?>" readonly>
        </p>
        <p class="buttons">
            <input type="submit" value="Accept">
        </p>
    </form>
</main>

<?php

require($backend.'footer.php');

?>