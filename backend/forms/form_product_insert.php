<?php
    $backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
?>

<?php require($backend.'header.php'); ?> <!--here goes name of my header.php file and location in folder-->
<?php //maybe need option to enter pictures of products.?>
<main>
    <form class="call-form" action="/student014/online_shop/backend/db/db_product_insert.php" method="POST">
        <p class="input-id">
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id">
        </p>
        <p class="input-id">
            <label for="product_name">Product name:</label>
            <input type="text" id="product_name" name="product_name">
        </p>
        <p class="input-id">
            <label for="product_price">Product price:</label>
            <input type="number" id="product_price" name="product_price">
        </p>
        <p class="buttons">
            <input type="submit" value="Insert">
        </p>
    </form>
</main>


<?php require($backend.'footer.php'); ?> <!--here goes name of my footer.php file and location in folder-->