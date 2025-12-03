<?php

// if (!isset($_SESSION['customer_id'])) {
//     header("Location: /student014/shop/backend/forms/form_login.php");
//     exit();
// }


include('./config/db_config.php');

$sql = "SELECT *
FROM `014_reviews`;";

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
                    </form>
                </div>
              </div>
            <div id="txtHintProduct"></div>';
    } else {
        echo "No reviews found";
    }
    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

?>