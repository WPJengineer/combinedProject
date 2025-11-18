<?php  $backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/'; ?>

<?php require($backend.'header.php'); ?>
<main>
    <form class="call-form" action="/student014/online_shop/backend/db/db_shopping_cart_insert.php" method="POST">
        <?php 
            $customer_id = $_SESSION['customer_id'];
            $product_id = $_GET['product_id'];
        ?>
        <p class="input-id">
            <label for="customer_id">Customer ID:</label>
            <input type="text" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>" readonly>
        </p>
        <p class="input-id">
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id" value="<?php echo $product_id; ?>" readonly>
        </p>
        <p class="input-id">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="1">
        </p>
        <p class="buttons">
            <input type="submit" value="Insert">
        </p>
    </form>
</main>
<?php require($backend.'footer.php'); ?>