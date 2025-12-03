<?php

session_start();

$customer_name = $_GET['customer_name'];

$sql = "SELECT *
FROM 014_customers
WHERE forename LIKE '%$customer_name%';";

// include('./config/db_config.php');

include('../config/db_config.php');

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo 
        '<div class="customers">
            <div class="flex items-center gap-6">
                <p>'.$row['customer_id'].'</p>
                <p>'.$row['forename'].'</p>
                <p>'.$row['lastname'].'</p>
            </div>
            <div class="flex">
                <a class="button" href="./forms/form_customer_update.php?customer_id='.$row['customer_id'].'&customer_name='.$row['forename'].'&customer_lastname='.$row['lastname'].'">Update</a>
                <a class="button" href="./forms/form_customer_delete.php?customer_id='.$row['customer_id'].'&customer_name='.$row['forename'].'&customer_lastname='.$row['lastname'].'">Delete</a> 
            </div>
        </div>';
  }
}
mysqli_close($conn);

?>