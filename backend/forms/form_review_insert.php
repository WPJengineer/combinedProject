<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');
if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

?>

<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
    <form class="flex flex-col gap-6 items-center" action="/student014/shop/backend/db/db_review_insert.php" method="POST">
    <?php 
        $customer_id = htmlspecialchars($_POST['customer_id']);
        $product_id = htmlspecialchars($_POST['product_id']);
    ?>
        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id ?>">
        <input type="hidden" id="product_id" name="product_id" value="<?php echo $product_id; ?>">
        <div class="flex">
            <img class="star" data-value="1" src="/student014/shop/assets/iconos/icon-star-full.png" alt="star-icon-full">
            <img class="star" data-value="2" src="/student014/shop/assets/iconos/icon-star-empty.png" alt="star-icon-empty">
            <img class="star" data-value="3" src="/student014/shop/assets/iconos/icon-star-empty.png" alt="star-icon-empty">
            <img class="star" data-value="4" src="/student014/shop/assets/iconos/icon-star-empty.png" alt="star-icon-empty">
            <img class="star" data-value="5" src="/student014/shop/assets/iconos/icon-star-empty.png" alt="star-icon-empty">
        </div>
        <input type="hidden" name="rating" id="rating" value="1">
        <textarea class="textBox" id="review" name="review" rows="5" cols="40" placeholder="Write your review here..." required></textarea>
        <p class="button">
            <input type="submit" value="Add Review">
        </p>
    </form>
</main>

<?php require($backend.'footer.php'); ?>