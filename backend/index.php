<?php $backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/'; ?>
<?php require($backend.'header.php'); ?>
<main class="min-h-screen bg-green flex flex-col items-center justify-center">
    <div class="flex flex-col items-center justify-center gap-6">
        <p>Welcome to my backend</p>
        <nav>
            <ul class="flex items-center justify-center gap-6">
                <li><a class="button" href="./products.php">Products</a></li>
                <?php
                if ($_SESSION['customer_role'] == 'admin') {
                    echo '<li><a class="button" href="./customers.php">Customers</a></li>';
                }
                ?>
                <li><a class="button" href="./shopping_carts.php">Shopping Carts</a></li>
                <li><a class="button" href="./orders.php">Orders</a></li>
            </ul>
        </nav>
    </div>
</main>
<?php require($backend.'footer.php'); ?>







<!--

htmlspecialchars();

only apply to incoming data.

empty() -> to check if value is null.

filter_var($variable, FILTER_VARIABLE_EMAIL) -> 
preg_match('/^[a-zA-Z\s]/', $variable) -> 

-->