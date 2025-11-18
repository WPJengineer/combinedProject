<?php
    $backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
?>

<form action="/student014/online_shop/backend/db/db_order_insert.php" method="POST">
    <p>
        <label for="customer_id">Customer ID:</label>
        <input type="text" id="customer_id" name="customer_id">
    </p>
    <p>
        <label for="product_id">Product ID:</label>
        <input type="text" id="product_id" name="product_id">
    </p>
    <p>
        <label for="quantity">Quantity: </label>
        <input type="number" id="quantity" name="quantity">
    </p>
    <p>
        <input type="submit" value="Submit">
    </p>
</form>