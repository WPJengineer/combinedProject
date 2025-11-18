<?php
//issue here with redirection.
session_start();
// if (!isset($_SESSION['customer_id'])) {
//     header("Location: /student014/online_shop/backend/forms/form_login.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Teamware</title>
    <style>

        :root {
            --dark: #0f0f0f;
            --light: #fcfcfc;
            --green: #4fb286;
            --blue: #336699;
        }

        @font-face {
            font-family: "afacad";
            src: url("/student014/online_shop/backend/fonts/afacad.ttf");
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            list-style: none;
            text-decoration: none;
        }

        body {
            font-family: 'afacad';
        }

        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            height: 100px;
            background-color: var(--light);
        }

        .menu ul {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        #logo {
            width: 200px;
        }

        .icon {
            width: 30px;
        }

        main {
        padding: 25px;
        background-color: var(--green);
        height: calc(100vh - 177px); /*height of header and footer substracted from the heigh i want the page to have*/
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        gap: 50px;
        }

        main p {
            font-size: 20px;
            text-align: center;
        }

        .products, .customers, .orders, .shopping-cart {
            background-color: var(--green);
            border-top: 1px solid var(--dark);
            border-bottom: 1px solid var(--dark);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 50px 10px 10px;
        }

        .products > div, .customers > div, .orders > div, .shopping-cart > div {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .products div img, .shopping-cart div img {
            width: 100px;
            height: 150px;
        }

        .products .product-info, .customers .customer-info, .orders .order-info, .shopping-cart-info , .call-form p {
            font-size: 28px;
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .products .buttons, .customers .buttons, .orders .buttons, .shopping-cart .buttons {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .links {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .links ul {
            display: flex;
            gap: 50px;
        }

        .call-form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .input-id {
            display: flex;
            gap: 50px;
            justify-content: center;
        }

        .input-id input, .input-id a {
            border: 1px solid var(--dark);
            border-radius: 5px;
            text-align: center;
            font-size: 20px;
        }

        .buttons input, .input-id a, .buttons a, .links a, .button {
            background-color: var(--blue);
            color: var(--light);
            padding: 5px 10px;
            border-radius: 20px;
            border: 1px solid var(--dark);
            font-size: 20px;
            text-decoration: none;
            box-shadow: 4px 2px 2px var(--dark);
        }

        .insertBar {
            background-color: var(--dark);
            height: 50px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding-right: 50px;
        }

        .insertBtn a, .buttons a {
            display: flex;
        } 

        a:hover, input:not([type="text"]):not([type="number"]):hover, li:hover, .button:hover {
            transform: scale(1.1);
            cursor: pointer;
        }

        .buttons input:active, .input-id a:active, .buttons a:active, .links a:active, .button:active {
            box-shadow: -2px -1px 2px var(--dark);
        }

        .call-form div {
            display: flex;
            align-items: baseline;
            justify-content: center;
            gap: 25px;
        }

        .product-img img {
            width: 100px;
            height: 150px;
            border: 1px solid var(--dark);
        }

        .menuRoles form {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--light);
            border: 1px solid var(--dark);
            border-radius: 5px;
            padding: 10px;
            display: flex; /*display: none; how to comes as default and then when clicked on it changes to display: flex;*/
            flex-direction: column;
            align-items: center;
            gap: 20px;
            font-size: 20px;
        }

        .menuRoles input[type="submit"] {
            background-color: var(--blue);
            color: var(--light);
            padding: 5px 10px;
            border-radius: 20px;
            border: 1px solid var(--dark);
            font-size: 20px;
            text-decoration: none;
            box-shadow: 4px 2px 2px var(--dark);
        }

        .menuRoles input[type="submit"]:active {
            box-shadow: -2px -1px 2px var(--dark);
        }

        .menuRoles a {
            color: var(--dark);
        }

        footer {
            background-color: var(--light);
            font-size: 20px;
            text-align: center;
            padding: 25px;
        }

        .hidden {
            display: none;
        }

    </style>
</head>
<body>
    <header>
        <img id="logo" src="/student014/online_shop/backend/images/logo.png" alt="logo">
        <nav class="menu">
            <ul>
                <li><?php echo 'Welcome '.($_SESSION['username'] ?? 'Guest'); ?></li>
                <li><?php
                if (!isset($_SESSION['customer_role'])) {
                    $_SESSION['customer_role'] = 'guest';
                }
                if ($_SESSION['customer_role'] == 'admin' || $_SESSION['customer_role'] == 'customer') {
                    echo'<a href="/student014/online_shop/backend/index.php"><img class="logo" src="/student014/online_shop/backend/iconos/home_24dp_0F0F0F.png" alt="home-icon"></a></li>';
                }
                ?>
                <li><a href="/student014/online_shop/backend/forms/form_login.php"><img class="logo" id="btnRoles" src="/student014/online_shop/backend/iconos/person_24dp_0F0F0F.png" alt="role-icon"></li></a>
                <li><img class="logo" src="/student014/online_shop/backend/iconos/search_24dp_OFOFOF.png" alt="search-icon"></li>
            </ul>
        </nav>
    </header>


