<?php
$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');
?>

<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
    <h1 class="text-4xl font-bold">Welcome to the backend</h1>
    <form class="flex flex-col gap-6 items-center justify-center" action="/student014/shop/backend/db/db_register.php" method="POST">
        <p>
            <label for="forename">Forename:</label>
            <input class="textBox" type="text" id="forename" name="forename">
        </p>
        <p>
            <label for="lastname">Lastname:</label>
            <input class="textBox" type="text" id="lastname" name="lastname">
        </p>
        <p>
            <label for="username">Username:</label>
            <input class="textBox" type="text" id="username" name="username">
        </p>
        <p>
            <label for="password">Password:</label>
            <input class="textBox" type="password" id="password" name="password">
        </p>
        <!-- missing script to check validity of data input and if password match both textboxes -->
        <p>
            <label for="confirm-password">Confirm Password:</label>
            <input class="textBox" type="password" id="confirm-password" name="confirm-password">
        </p>
        <p>
            <input  class="button" type="submit" value="Register">
        </p>
    </form>
</main>
<?php require($backend.'footer.php'); ?>