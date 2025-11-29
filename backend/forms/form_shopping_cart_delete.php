<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');
if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

?>

<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
    <form class="flex flex-col gap-6 items-center" action="../db/db_shopping_cart_delete.php" method="POST">
        <?php
            $product_id = $_GET['product_id'];
            $product_name = $_GET['product_name'];
            $product_price = $_GET['product_price'];
            $product_image = $_GET['product_image'];
            $customer_id = $_SESSION['customer_id'];
            $quantity = $_GET['quantity'];
        ?>
        <p>Are you sure you want to delete this product from your shopping cart?</p>
        <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id ?>">
        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id ?>">
        <p class="w-25 border">
            <label for="product_image"></label>
            <img src="<?php echo $product_image; ?>" alt="product-image">
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="product_name">Product name:</label>
            <input class="textBox" type="text" id="product_name" name="product_name" value="<?php echo $product_name; ?>" readonly>
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="product_price">Product price:</label>
            <input class="textBox" type="number" id="product_price" name="product_price" value="<?php echo $product_price; ?>" readonly>
        </p>
        <div class="flex gap-5">
            <p class="button">
                <input type="submit" value="Delete">
            </p>
            <p class="button">
                <a href="/student014/shop/backend/shopping_carts.php">Cancel</a>
            </p>
        </div>
    </form>
</main>

<?php

require($backend.'footer.php');

?>