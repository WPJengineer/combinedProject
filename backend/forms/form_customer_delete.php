<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
require($backend.'header.php');

?>
<main>
    <form class="call-form" action="../db/db_customer_delete.php" method="POST">
        <?php
            $customer_id = $_GET['customer_id'];
            $customer_name = $_GET['customer_name'];
            $customer_lastname = $_GET['customer_lastname'];
        ?>
        <p>Are you sure you want to delete this customer?</p>
        <p class="input-id">
            <label for="customerid">Customer ID:</label>
            <input type="text" id="customer_id" name="customer_id" value="<?php echo $customer_id ?>" readonly>
        </p>
        <p class="input-id">
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" readonly>
        </p>
        <p class="input-id">
            <label for="customer_lastname">Customer Lastname:</label>
            <input type="text" id="customer_lastname" name="customer_lastname" value="<?php echo $customer_lastname; ?>" readonly>
        </p>
        <div>
            <p class="buttons">
                <input type="submit" value="Delete">
            </p>
            <p class="buttons">
                <a href="/student014/online_shop/backend/customers.php">Cancel</a>
            </p>
        </div>
    </form>
</main>
