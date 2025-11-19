<?php
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
require_once($backend.'header.php');
?>

<main>
    <h1>Log in</h1>
    <?php
        if (!isset($_SESSION['username'])) {
            echo
                '<form class="call-form" action="/student014/online_shop/backend/db/db_login.php" method="POST"><!--check which method-->
                    <p class="input-id">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username">
                    </p>
                    <p class="input-id">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </p>
                    <p class="buttons">
                        <input type="submit" value="Log In">
                    </p>
                </form>';
        } else {
            echo
                '<button class="button" onclick="logOut()">Log Out</button>
                <script>
                    function logOut() {
                        window.location.href="/student014/online_shop/backend/forms/form_logout.php"
                    }
                </script>';
        }
    ?>
</main>

<?php require($backend.'footer.php'); ?>