<?php

if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/'; ?>

<?php require($backend.'header.php'); ?>
<main class="bg-green flex flex-col items-center justify-center gap-6"  style="flex: 1;">
    <form class="flex flex-col gap-6 items-center" action="/student014/shop/backend/db/db_shopping_cart_insert.php" method="POST">
        <p class="flex justify-center items-center gap-5">
            <label for="customer_id">Customer ID:</label>
            <input class="textBox" type="number" id="customer_id" name="customer_id">
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="product_id">Product ID:</label>
            <input class="textBox" type="number" id="product_id" name="product_id">
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