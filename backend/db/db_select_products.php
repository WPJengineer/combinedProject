<?php

if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/online_shop/backend/forms/form_login.php");
    exit();
    //issue here with redirection.
}

$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);

include('./config/db_config.php');

$sql = "SELECT *
FROM 014_products;";

// execute query
$result = mysqli_query($conn, $sql);

// if connection fails show error if not get result of query
if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
    // Fetch and display each row
        echo
            '<div class="insertBar">
                <div class="search-bar">
                    <form>
                        <input id="textBox" onkeyup="showHint(this.value)" type="text" placeholder="Type product name...">
                    </form>
                </div>';
                if ($_SESSION['customer_role'] == "admin") {
                    echo '<div class="insertBtn buttons">
                    <a href="./forms/form_product_insert.php">Insert New Product</a>
                </div>';
                }
                echo 
                '</div>
            <div id="txtHint"></div>';
    } else {
        echo "No product found with ID: " . $product_id;
    }
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

?>