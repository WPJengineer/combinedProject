<?php

if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

include('./config/db_config.php');

if ($_SESSION['customer_role'] == 'admin') {
    $sql = "SELECT r.review_id, p.product_image, CONCAT(c.forename, ' ', c.lastname) AS customer_name, r.review_content, r.review_score
    FROM `014_reviews` AS r
    INNER JOIN `014_products` AS p ON p.product_id = r.product_id
    INNER JOIN `014_customers` AS c ON c.customer_id = r.customer_id;";
} else {
    $sql = "SELECT p.product_image, r.review_content, r.review_score
    FROM `014_reviews` AS r
    INNER JOIN `014_products` AS p ON p.product_id = r.product_id
    WHERE customer_id = '$customer_id';";
}



// execute query
$result = mysqli_query($conn, $sql);

// if connection fails show error if not get result of query
if (mysqli_query($conn, $sql)) {
    
    if (mysqli_num_rows($result) > 0) {
    // Fetch and display each row
         while ($row = mysqli_fetch_assoc($result)) {
            echo
                '<div class="reviews">
                    <img class="w-25 border" src="'.$row['product_image'].'" alt="product-image">';
                    if ($_SESSION['customer_role'] == 'admin') {
                        echo '<p>'.$row['customer_name'].'</p>';
                    }
                    echo '
                    <p>'.$row['review_content'].'</p>
                    <p>'.$row['review_score'].' Stars</p>';
                    if ($_SESSION['customer_role'] == 'admin') {
                        echo'
                    <form method="POST" action="./forms/form_review_delete.php">
                        <input type="hidden" name="review_id" value="'.$row['review_id'].'">
                        <input type="hidden" name="review_content" value="'.$row['review_content'].'">
                        <input type="hidden" name="customer_name" value="'.$row['customer_name'].'">
                        <input type="submit" value="Delete review" class="button">
                    </form>';
                    }
                echo'
                </div>';
        }
    } else {
        echo '<div class="flex flex-col items-center justify-center gap-6" style="flex: 1;">
                <p>No reviews found</p>
            </div>';
    }
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

?>