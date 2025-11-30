<?php

// if (!isset($_SESSION['customer_id'])) {
//     header("Location: /student014/shop/backend/forms/form_login.php");
//     exit();
// }

$conn = mysqli_connect('localhost', 'root', '', 'online_shop_db', 3306);

include('./config/db_config.php');

$sql = "SELECT *
FROM 014_customers;";

// execute query
$result = mysqli_query($conn, $sql);

// if connection fails show error if not get result of query
if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
    // Fetch and display each row
        echo
            '<div class="insertBar">
                <div>
                    <form>
                        <input class="textBox" id="textBox" onkeyup="showCustomer(this.value)" type="text" placeholder="Type customer name...">
                    </form>
                </div>
                <div class="button">
                    <a href="./forms/form_customer_insert.php">Insert New Customer</a>
                </div>
            </div>
            <div id="txtHintCustomer"></div>';
    } else {
        echo "No customer found with ID: ";
    }
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

?>