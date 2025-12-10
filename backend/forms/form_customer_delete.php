<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');
if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

?>
<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
    <form class="flex flex-col gap-6 items-center" action="../db/db_customer_delete.php" method="POST">
        <?php
            $customer_id = htmlspecialchars($_POST['customer_id']);
            $customer_name = htmlspecialchars($_POST['customer_name']);
            $customer_lastname = htmlspecialchars($_POST['customer_lastname']);
            $customer_username = htmlspecialchars($_POST['customer_username']);
        ?>
        <p>Are you sure you want to delete this customer?</p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_id">Customer ID:</label>
            <input class="textBox" type="text" id="customer_id" name="customer_id" value="<?php echo $customer_id ?>" readonly>
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_name">Customer Name:</label>
            <input class="textBox" type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" readonly>
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_lastname">Customer Lastname:</label>
            <input class="textBox" type="text" id="customer_lastname" name="customer_lastname" value="<?php echo $customer_lastname; ?>" readonly>
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_username">Customer username:</label>
            <input class="textBox" type="text" id="customer_username" name="customer_username" value="<?php echo $customer_username ?>" readonly>
        </p>
        <div class="flex gap-5">
            <p class="button">
                <input type="submit" value="Delete">
            </p>
            <p class="button">
                <a href="/student014/shop/backend/customers.php">Cancel</a>
            </p>
        </div>
    </form>
</main>
