<?php

// if (!isset($_SESSION['customer_id'])) {
//     header("Location: /student014/shop/backend/forms/form_login.php");
//     exit();
// }

// include('./config/db_config.php');

include('./config/db_config.php');

// $sql = "SELECT *
// FROM 014_orders;";

$sql = "
SELECT o.order_number, o.product_id, p.product_name, p.product_image, CONCAT(c.forename, ' ', c.lastname) AS customer_name, o.quantity, o.product_unit_price, o.placed_on
FROM `014_orders` AS o
INNER JOIN `014_products` AS p ON o.product_id = p.product_id
INNER JOIN `014_customers` AS c ON o.customer_id = c.customer_id
WHERE o.customer_id =". $_SESSION['customer_id'].";
";

// execute query
$result = mysqli_query($conn, $sql);

// if connection fails show error if not get result of query
if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
    // Fetch and display each row
        echo
            '<div class="insertBar">
            </div>';
            // ajax for showing orders ordered between certain dates. - pending.
        // echo
        //     '<div class="insertBar">
        //         <form class="flex gap-6">
        //             <input class="textBox" id="textBoxStart" onkeyup="showOrder(this.value)" type="date">
        //             <input class="textBox" id="textBoxEnd" onkeyup="showOrder(this.value)" type="date">
        //         </form>
        //     </div>
        //     <div id="txtHintOrder"></div>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo 
                '<div class="orders">
                    <div class="flex items-center gap-6">
                        <img class="w-25 border" src="'.$row['product_image'].'" alt="product-image">
                        <p>'.$row['order_number'].'</p>
                        <p>'.$row['product_name'].'</p>
                        <p>'.$row['customer_name'].'</p>
                        <p>'.$row['quantity'].'</p>
                        <p>'.$row['product_unit_price'].'€</p>
                        <p>'.$row['placed_on'].'</p>
                    </div>
                </div>';
        }
    } else {
        echo "No product found with that ID";
    }
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

?>