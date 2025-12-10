<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');
if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

?>
<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
    <form class="flex flex-col gap-6 items-center" action="../db/db_review_delete.php" method="POST">
        <?php
            $review_id = htmlspecialchars($_POST['review_id']);
            $review_content = htmlspecialchars($_POST['review_content']);
            $customer_name = htmlspecialchars($_POST['customer_name']);
        ?>
        <p>Are you sure you want to delete this review?</p>
        <p class="flex justify-center items-center gap-5">
            <label for="review_id">Review ID:</label>
            <input class="textBox" type="text" id="review_id" name="review_id" value="<?php echo $review_id ?>" readonly>
        </p>
        <p class="flex justify-center items-center gap-5">
            <label for="customer_name">Customer Name:</label>
            <input class="textBox" type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" readonly>
        </p>
        <p class="flex justify-center items-center gap-5">
            <textarea class="textBox" id="review_content" name="review_content" rows="5" cols="40" placeholder="<?php echo $review_content; ?>" readonly></textarea>
        </p>
        <div class="flex gap-5">
            <p class="button">
                <input type="submit" value="Delete">
            </p>
            <p class="button">
                <a href="/student014/shop/backend/reviews.php">Cancel</a>
            </p>
        </div>
    </form>
</main>