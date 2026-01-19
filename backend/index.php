<?php $backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/'; ?>
<?php require($backend.'header.php'); ?>
<main class="bg-green flex flex-col items-center justify-center" style="flex: 1;">
    <div class="flex flex-col items-center justify-center gap-6">
        <p>Welcome to my backend</p>
        <nav>
            <ul class="flex items-center justify-center gap-6">
                <li class="button"><a href="./products.php">Products</a></li>
                <?php
                if ($_SESSION['customer_role'] == 'admin') {
                    echo '<li class="button"><a href="./customers.php">Customers</a></li>';
                }
                ?>
                <li class="button"><a href="./shopping_carts.php">Shopping Carts</a></li>
                <li class="button"><a href="./orders.php">Orders</a></li>
                <?php
                // if ($_SESSION['customer_role'] == 'admin') {
                    echo '<li class="button"><a href="./reviews.php">Reviews</a></li>';
                // }
                ?>
                <li class="button"><a href="./sandbox.php">Sandbox</a></li>
            </ul>
        </nav>
    </div>
</main>
<?php require($backend.'footer.php'); ?>