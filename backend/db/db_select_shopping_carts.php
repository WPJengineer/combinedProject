<?php

if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

// include('./config/db_config.php');

include('./config/db_config.php');

// if ($_SESSION['customer_role'] == 'admin') {
//     $sql = "SELECT s.customer_id, c.forename, c.lastname, s.product_id, p.product_name, product_unit_price, p.product_image, s.quantity
//     FROM `014_shopping_cart` AS s
//     INNER JOIN `014_products` AS p ON s.product_id = p.product_id
//     INNER JOIN `014_customers` AS c ON s.customer_id = c.customer_id;";
// } else {
$sql = "SELECT s.customer_id, c.forename, c.lastname, s.product_id, p.product_name, product_unit_price, p.product_image, s.quantity
FROM `014_shopping_cart` AS s
INNER JOIN `014_products` AS p ON s.product_id = p.product_id
INNER JOIN `014_customers` AS c ON s.customer_id = c.customer_id
WHERE s.customer_id =". $_SESSION['customer_id'].";";

// }

// execute query
$result = mysqli_query($conn, $sql);

// if connection fails show error if not get result of query
if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
    // Fetch and display each row
        // echo
        //     '<div class="insertBar">
        //         <div class="button">
        //             <a href="./db/db_order_insert.php">Place Order</a>
        //         </div>
        //     </div>';
        $cartTotal = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $subtotal = getSubtotalProduct($row['quantity'], $row['product_unit_price']);
            $cartTotal += $subtotal;
            echo
                '<div class="shopping-cart">
                    <div class="flex gap-6">
                        <img class="w-25 border" src="'.$row['product_image'].'" alt="product-image">
                        <div class="flex items-center gap-6">
                            <p>'.$row['product_name'].'</p>
                            <p>'.$row['product_unit_price'].'€</p>
                            <p>'.$row['forename'].'</p>
                            <p>'.$row['lastname'].'</p>
                            <form class="flex items-center gap-5 border rounded-full border-dark bg-light px-3 py-1">
                                <input class="btnMinus p-2 hover:cursor-pointer" type="button" value="-" data-product-id="'.$row['product_id'].'" data-customer-id="'.$row['customer_id'].'">
                                <span id="numQuantity" class="p-2">'.$row['quantity'].'</span>
                                <input class="btnPlus p-2 hover:cursor-pointer" type="button" value="+" data-product-id="'.$row['product_id'].'" data-customer-id="'.$row['customer_id'].'">
                            </form>
                            <p class="font-bold">Subtotal: '.$subtotal.'€</p>
                        </div>
                    </div>
                    <div class="button">
                        <a class="" href="./forms/form_shopping_cart_delete.php?product_id='.$row['product_id'].'&product_name='.$row['product_name'].'&product_price='.$row['product_unit_price'].'&product_image='.$row['product_image'].'&quantity='.$row['quantity'].'">Remove</a> 
                    </div>
                </div>';
        }
        echo
            '<div class="flex items-center justify-end gap-5">
                <p class="font-bold">Subtotal: '.$cartTotal.'€</p>
                <div class="button">
                    <a href="./db/db_order_insert.php">Place Order</a>
                </div>
            </div>';
        // echo '</main>';
    } else {
        echo
            '<div class="flex flex-col items-center justify-center gap-6" style="flex: 1;">
                <p>No product or customer found with ID</p>
            </div>';
    }
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

?>