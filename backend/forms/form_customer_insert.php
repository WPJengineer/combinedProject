<?php
    $backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
    require($backend.'header.php');
?>

<main>
    <form class="call-form" action="/student014/online_shop/backend/db/db_customer_insert.php" method="POST">
        <p class="input-id">
            <label for="customer_id">Customer ID:</label>
            <input type="text" id="customer_id" name="customer_id">
        </p>
        <p class="input-id">
            <label for="customer_forename">Customer forename:</label>
            <input type="text" id="customer_forename" name="customer_forename">
        </p>
        <p class="input-id">
            <label for="customer_lastname">Customer lastname:</label>
            <input type="text" id="customer_lastname" name="customer_lastname">
        </p>
        <p class="buttons">
            <input type="submit" value="Submit">
        </p>
    </form>
</main>


<?php require($backend.'footer.php'); ?>