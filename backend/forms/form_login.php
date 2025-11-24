<?php
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/online_shop/backend/';
require($backend.'header.php');
?>

<!-- <h1>Log in</h1> -->
<?php
    if (!isset($_SESSION['username'])) {
        echo
            '<form class="flex flex-col gap-6 items-center justify-center" action="/student014/online_shop/backend/db/db_login.php" method="POST">
                <p>
                    <label for="username">Username:</label>
                    <input class="textBox" type="text" id="username" name="username">
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input class="textBox" type="password" id="password" name="password">
                </p>
                <p>
                    <input  class="button" type="submit" value="Log In">
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

<?php require($backend.'footer.php'); ?>