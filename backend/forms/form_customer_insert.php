<?php
    $backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
    require($backend.'header.php');
?>

<main class="min-h-screen bg-green flex flex-col items-center justify-center gap-6">
    <form class="flex flex-col gap-6 items-center" action="/student014/shop/backend/db/db_customer_insert.php" method="POST">
        <p class="flex justify-center items-center gap-5">
            <label for="customer_id">Customer ID:</label>
            <input class="textBox" type="text" id="customer_id" name="customer_id">
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_forename">Customer forename:</label>
            <input class="textBox" type="text" id="customer_forename" name="customer_forename">
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_lastname">Customer lastname:</label>
            <input class="textBox" type="text" id="customer_lastname" name="customer_lastname">
        </p>
        <p class="button">
            <input type="submit" value="Submit">
        </p>
    </form>
</main>


<?php require($backend.'footer.php'); ?>