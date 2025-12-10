<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');
if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

?>

<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
    <form class="flex flex-col gap-6 items-cente" action="../db/db_customer_update.php" method="POST">
        <?php
            $customer_id = htmlspecialchars($_POST['customer_id']);
            $customer_name = htmlspecialchars($_POST['customer_name']);
            $customer_lastname = htmlspecialchars($_POST['customer_lastname']);
            $customer_username = htmlspecialchars($_POST['customer_username']);
            $password = htmlspecialchars($_POST['password']);
        ?>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_id">Customer ID:</label>
            <input class="textBox" type="text" id="customer_id" name="customer_id" value="<?php echo $customer_id ?>" readonly>
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_forename">Customer forename:</label>
            <input class="textBox" type="text" id="customer_forename" name="customer_forename" value="<?php echo $customer_name ?>" required>
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_lastname">Customer lastname:</label>
            <input class="textBox" type="text" id="customer_lastname" name="customer_lastname" value="<?php echo $customer_lastname ?>" required>
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_username">Customer username:</label>
            <input class="textBox" type="text" id="customer_username" name="customer_username" value="<?php echo $customer_username ?>" required>
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="password">Password:</label>
            <input class="textBox" type="text" id="password" name="password" value="<?php echo $password ?>" required>
        </p>
        <p class="flex justify-center">
            <input class="button" type="submit" value="Update">
        </p>
    </form>
</main>

<?php

require($backend.'footer.php');

?>