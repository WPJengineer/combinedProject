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
            // '<main>
                '<div class="insertBar">
                    <div class="search-bar">
                        <form>
                            <input type="text" onkeyup="showHint(this.value)" placeholder="Type product name...">
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
                
            // while ($row = mysqli_fetch_assoc($result)) {
                
            //     echo
            //         '<div class="products">
            //             <div>
            //                 <img src="'.$row['product_image'].'" alt="product-image">
            //                 <div class="product-info">
            //                     <p>'.$row['product_name'].'</p>
            //                     <p>'.$row['product_unit_price'].'€</p>
            //                 </div>
            //             </div>';
                        
            //             if ($_SESSION['customer_role'] == "admin") {
            //                 echo
            //                     '<div class="buttons">
            //                         <a href="./forms/form_shopping_cart_insert.php?product_id='.$row['product_id'].'">Add to cart</a>
            //                         <a href="./forms/form_product_update.php?product_id='.$row['product_id'].'&product_name='.$row['product_name'].'&product_price='.$row['product_unit_price'].'&product_image='.$row['product_image'].'">Update</a>
            //                         <a href="./forms/form_product_delete.php?product_id='.$row['product_id'].'&product_name='.$row['product_name'].'&product_price='.$row['product_unit_price'].'&product_image='.$row['product_image'].'">Delete</a> 
            //                     </div>
            //                 </div>';
            //             } else {
            //                 echo
            //                     '<div class="buttons">
            //                         <a href="./forms/form_shopping_cart_insert.php?product_id='.$row['product_id'].'">Add to cart</a> 
            //                     </div>
            //                 </div>';
            //             }
            // }

    } else {
        echo "No product found with ID: " . $product_id;
    }
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

?>