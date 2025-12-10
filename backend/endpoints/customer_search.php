<?php

session_start();

$customer_name = htmlspecialchars($_POST['customer_name']);

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
                <form method="POST" action="./forms/form_customer_update.php">
                    <input type="hidden" name="customer_id" value="'.$row['customer_id'].'">
                    <input type="hidden" name="customer_name" value="'.$row['forename'].'">
                    <input type="hidden" name="customer_lastname" value="'.$row['lastname'].'">
                    <input type="hidden" name="customer_username" value="'.$row['username'].'">
                    <input type="hidden" name="password" value="'.$row['password'].'">
                    <input type="submit" value="Update" class="button">
                </form>
                <form method="POST" action="./forms/form_customer_delete.php">
                    <input type="hidden" name="customer_id" value="'.$row['customer_id'].'">
                    <input type="hidden" name="customer_name" value="'.$row['forename'].'">
                    <input type="hidden" name="customer_lastname" value="'.$row['lastname'].'">
                    <input type="hidden" name="customer_username" value="'.$row['username'].'">
                    <input type="submit" value="Delete" class="button">
                </form>
            </div>
        </div>';
  }
}
mysqli_close($conn);

?>