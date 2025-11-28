<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php'); 
if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

// if inserting from shopping_cart should call a separate file if addding from products page to avoid issue with getting product id.
$product_id = $_GET['product_id'];
$customer_id = $_SESSION['customer_id'];

?>




<main class="bg-green flex flex-col items-center justify-center gap-6"  style="flex: 1;">
    <form class="flex flex-col gap-6 items-center" action="/student014/shop/backend/db/db_shopping_cart_insert.php" method="POST">
        <p class="flex justify-center items-center gap-5">
            <label for="customer_id">Customer ID:</label>
            <input class="textBox" type="number" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>">
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="product_id">Product ID:</label>
            <input class="textBox" type="number" id="product_id" name="product_id" value="<?php echo $product_id; ?>">
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="quantity">Quantity:</label>
            <input class="textBox" type="number" id="quantity" name="quantity">
        </p>
        <p class="button">
            <input type="submit" value="Insert">
        </p>
    </form>
</main>
<?php require($backend.'footer.php'); ?>