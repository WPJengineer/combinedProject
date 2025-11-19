<?php

if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/online_shop/backend/forms/form_login.php");
    exit();
    //issue here with redirection.
}

$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);

include('./config/db_config.php');

if ($_SESSION['customer_role'] == 'admin') {
    $sql = "SELECT s.customer_id, c.forename, c.lastname, s.product_id, p.product_name, product_unit_price, p.product_image, s.quantity
    FROM `014_shopping_cart` AS s
    INNER JOIN `014_products` AS p ON s.product_id = p.product_id
    INNER JOIN `014_customers` AS c ON s.customer_id = c.customer_id;";
} else {
    $sql = "SELECT s.customer_id, c.forename, c.lastname, s.product_id, p.product_name, product_unit_price, p.product_image, s.quantity
    FROM `014_shopping_cart` AS s
    INNER JOIN `014_products` AS p ON s.product_id = p.product_id
    INNER JOIN `014_customers` AS c ON s.customer_id = c.customer_id
    WHERE s.customer_id =". $_SESSION['customer_id'].";";
}

// execute query
$result = mysqli_query($conn, $sql);

// if connection fails show error if not get result of query
if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
    // Fetch and display each row
        echo
            // '<main>
                '<div class="insertBar">
                    <div class="insertBtn buttons">
                        <a href="./forms/form_shopping_cart_insert.php">Insert Into Shopping Carts</a>
                    </div>
                </div>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo
                '<div class="shopping-cart">
                    <div>
                        <img src="'.$row['product_image'].'" alt="product-image">
                        <div class="shopping-cart-info">
                            <p>'.$row['product_name'].'</p>
                            <p>'.$row['product_unit_price'].'€</p>
                            <p>'.$row['forename'].'</p>
                            <p>'.$row['lastname'].'</p>
                            <p>'.$row['quantity'].'</p>
                        </div>
                    </div>
                    <div class="buttons">
                        <a href="">Place Order</a>
                        <a href="./forms/form_shopping_cart_update.php?product_id='.$row['product_id'].'&product_name='.$row['product_name'].'&product_price='.$row['product_unit_price'].'&product_image='.$row['product_image'].'">Update</a>
                        <a href="./forms/form_shopping_cart_delete.php?product_id='.$row['product_id'].'&product_name='.$row['product_name'].'&product_price='.$row['product_unit_price'].'&product_image='.$row['product_image'].'">Delete</a> 
                    </div>
                </div>';
        }
        // echo '</main>';
    } else {
        echo "No product or customer found with ID: ";
    }
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

?>