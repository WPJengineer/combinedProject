<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');
if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

?>
<!-- include username and passowrd -->
<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
    <form class="flex flex-col gap-6 items-center" action="/student014/shop/backend/db/db_customer_insert.php" method="POST">
        <p class="flex justify-center items-center gap-5">
            <label for="customer_id">Customer ID:</label>
            <input class="textBox" type="number" id="customer_id" name="customer_id">
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_forename">Customer forename:</label>
            <input class="textBox" type="text" id="customer_forename" name="customer_forename">
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_lastname">Customer lastname:</label>
            <input class="textBox" type="text" id="customer_lastname" name="customer_lastname">
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_username">Customer username:</label>
            <input class="textBox" type="text" id="customer_username" name="customer_username">
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="password">Password:</label>
            <input class="textBox" type="password" id="password" name="password">
        </p>
        <p class="flex justify-center items-center gap-5">
            <fieldset class="flex gap-4 items-center">
                <legend>Customer role:</legend>
                <label for="admin_role" class="cursor-pointer">
                    <input type="radio" id="admin_role" name="role" value="admin">
                    Admin: 
                </label>
                <label for="customer_role" class="cursor-pointer">
                    <input type="radio" id="customer_role" name="role" value="customer">
                    Customer: 
                </label>
            </fieldset>
        </p>
        <p class="button">
            <input type="submit" value="Submit">
        </p>
    </form>
</main>


<?php require($backend.'footer.php'); ?>