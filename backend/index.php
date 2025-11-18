<?php $backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/'; ?>
<?php require($backend.'header.php'); ?> <!--here goes name of my header.php file and location in folder-->




<main>
    <p>Welcome to my backend</p>
    <div>
        <nav class="links">
            <ul>
                <li><a href="./products.php">Products</a></li>
                <?php
                if ($_SESSION['customer_role'] == 'admin') {
                    echo '<li><a href="./customers.php">Customers</a></li>';
                }
                ?>
                <li><a href="./shopping_carts.php">Shopping Carts</a></li>
                <li><a href="./orders.php">Orders</a></li>
            </ul>
        </nav>
    </div>
</main>

<?php require($backend.'footer.php'); ?> <!--here goes name of my footer.php file and location in folder-->

</html>






<!--

htmlspecialchars();

only apply to incoming data.

empty() -> to check if value is null.

filter_var($variable, FILTER_VARIABLE_EMAIL) -> 
preg_match('/^[a-zA-Z\s]/', $variable) -> 

-->