<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
require($backend.'header.php');

?>

<main>
    <form class="call-form" action="../db/db_product_update.php" method="POST">
        <?php
            $product_id = $_GET['product_id'];
            $product_name = $_GET['product_name'];
            $product_price = $_GET['product_price'];
            $product_image = $_GET['product_image'];
        ?>
        <!-- <p class="input-id"> -->
            <!-- <label for="product_id">Product ID:</label> -->
            <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id; ?>">
        <!-- </p> -->
        <p class="product-img">
            <label for="product_image"></label>
            <img src="<?php echo $product_image; ?>" alt="product-image">
        </p>
        <p class="input-id">
            <label for="product_name">Product name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo $product_name; ?>">
        </p>
        <p class="input-id">
            <label for="product_price">Product price:</label>
            <input type="number" id="product_price" name="product_price" value="<?php echo $product_price; ?>">
        </p>
        
        
        <p class="buttons">
            <input type="submit" value="Update">
        </p>
    </form>
</main>

<?php

require($backend.'footer.php');

?>