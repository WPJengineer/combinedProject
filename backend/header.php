<?php

session_start();
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
include($backend.'/functions/functions.php');

if (isset($_GET['language'])) {
    setcookie('language', $_GET['language'], time() + 86400, '/');
    header("Location: " . strtok($_SERVER['REQUEST_URI'], '?'));
    exit();
}
$language = $_COOKIE['language'] ?? 'EN';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Teamware</title>
    <link rel="stylesheet" href="/student014/shop/css/backend_style/backend_style-output.css">
</head>
<body class="min-h-screen flex flex-col text-xl text-dark font-afacad md:text-2xl lg:text-[28px]">
    <header class="flex items-center justify-between px-5 bg-light">
        <img class="logo" src="/student014/shop/assets/images/logo.png" alt="logo">
        <nav>
            <ul class="flex items-center gap-5">
                <li><?php echo 'Welcome '.($_SESSION['username'] ?? 'Guest'); ?></li>
                <li><?php
                if (!isset($_SESSION['customer_role'])) {
                    $_SESSION['customer_role'] = 'guest';
                }
                if ($_SESSION['customer_role'] == 'admin' || $_SESSION['customer_role'] == 'customer') {
                    echo'<a href="/student014/shop/backend/index.php"><img class="icon" src="/student014/shop/assets/iconos/home_24dp_0F0F0F.png" alt="home-icon"></a>';
                }
                ?>
                </li>
                <li><a href="/student014/shop/backend/forms/form_login.php"><img class="icon" id="btnRoles" src="/student014/shop/assets/iconos/person_24dp_0F0F0F.png" alt="role-icon"></a></li>
                <li>
                    <form action="<?php echo htmlspecialchars(strtok($_SERVER['REQUEST_URI'], '?')); ?>" method="GET">
                        <select name="language"  onchange="this.form.submit()">
                            <option value="EN" <?= $language === 'EN' ? 'selected' : '' ?>>EN</option>
                            <option value="ES" <?= $language === 'ES' ? 'selected' : '' ?>>ES</option>
                            <option value="CA" <?= $language === 'CA' ? 'selected' : '' ?>>CA</option>
                        </select>
                    </form>
                </li>
                <li><img class="icon" src="/student014/shop/assets/iconos/search_24dp_OFOFOF.png" alt="search-icon"></li>
            </ul>
        </nav>
    </header>

