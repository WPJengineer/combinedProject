<?php
    $backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
?>

<?php require($backend.'header.php'); ?>
<?php //maybe need option to enter pictures of products.?>
<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
    <form class="flex flex-col gap-6 items-center" action="/student014/shop/backend/db/db_product_insert.php" method="POST">
        <p class="flex justify-center items-center gap-5">
            <label for="product_id">Product ID:</label>
            <input class="textBox" type="text" id="product_id" name="product_id">
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="product_name">Product name:</label>
            <input class="textBox" type="text" id="product_name" name="product_name">
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="product_price">Product price:</label>
            <input class="textBox" type="number" id="product_price" name="product_price">
        </p>
        <p>
            <input class="button" type="submit" value="Insert">
        </p>
    </form>
</main>


<?php require($backend.'footer.php'); ?>