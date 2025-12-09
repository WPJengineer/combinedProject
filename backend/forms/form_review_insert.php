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
        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $_GET['customer_id'] ?>">
        <input type="hidden" id="product_id" name="product_id" value="<?php echo $_GET['product_id'] ?>">
        <div class="flex">
            <img class="star1" src="/student014/shop/assets/iconos/icon-star-empty.png" alt="star-icon-empty">
            <img class="star2" src="/student014/shop/assets/iconos/icon-star-empty.png" alt="star-icon-empty">
            <img class="star3" src="/student014/shop/assets/iconos/icon-star-empty.png" alt="star-icon-empty">
            <img class="star4" src="/student014/shop/assets/iconos/icon-star-empty.png" alt="star-icon-empty">
            <img class="star5" src="/student014/shop/assets/iconos/icon-star-empty.png" alt="star-icon-empty">
        </div>
        <textarea class="textBox p-2" id="review" name="review" rows="5" cols="40" placeholder="Write your review here..."></textarea>
        <p class="button">
            <input type="submit" value="Add Review">
        </p>
    </form>
</main>

<?php require($backend.'footer.php'); ?>