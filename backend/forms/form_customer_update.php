<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
require($backend.'header.php');

?>

<main>
    <form class="call-form" action="../db/db_customer_update.php" method="POST">
        <?php
            $customer_id = $_GET['customer_id'];
            $customer_name = $_GET['customer_name'];
            $customer_lastname = $_GET['customer_lastname'];
        ?>
        <p class="input-id">
            <label for="customer_id">Customer ID:</label>
            <input type="text" id="customer_id" name="customer_id" value="<?php echo $customer_id ?>" readonly>
        </p>
        <p class="input-id">
            <label for="customer_forename">Customer forename:</label>
            <input type="text" id="customer_forename" name="customer_forename" value="<?php echo $customer_name ?>">
        </p>
        <p class="input-id">
            <label for="customer_lastname">Customer lastname:</label>
            <input type="text" id="customer_lastname" name="customer_lastname" value="<?php echo $customer_lastname ?>">
        </p>
        
        
        <p class="buttons">
            <input type="submit" value="Update">
        </p>
    </form>
</main>

<?php

require($backend.'footer.php');

?>