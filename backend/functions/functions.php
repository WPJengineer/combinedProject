<?php
// function to create order_number (initials customer + customer_id + random gen number)
function generateOrderNumber($customer_id, $customer_forename, $customer_lastname) {
    $firstLetterForename = strtoupper(substr($customer_forename, 0, 1));
    $firstLetterLastname  = strtoupper(substr($customer_lastname, 0, 1));
    $random = str_pad(rand(1, 99999), 5, "0", STR_PAD_LEFT);
    return $firstLetterForename . $firstLetterLastname . $customer_id . $random;
}

// function to calculate subtotal of each product added to order table.
function getSubtotalProduct($quantity, $price_per_unit) {
    return $quantity * $price_per_unit;
}

// function to check inputs in forms.
function checkInput($input) {
    if (empty($input)) {
        echo 'Error input is empty!';
        return false;
    } else {
        return true;
    }
}

function checkNames($input) {
    if (!preg_match('/^[a-zA-Z\s]/', $input)) {
        echo 'Error input is not valid!';
        return false;
    } else {
        return true;
    }
}

// function to check passwords.
function checkPassword($online_password, $cornfirmPassword) {
    if (checkInput($_POST['online_password'])) {
        $online_password = $_POST['online_password'];
    } else {
        echo 'Password field was not correct';
        header("Location: /student014/shop/backend/forms/form_register.php");
        exit();
    }

    if (checkInput($_POST['confirm-password'])) {
        $confirmPassword = $_POST['confirm-password'];
    } else {
        echo 'Confirm password field was not correct';
        header("Location: /student014/shop/backend/forms/form_register.php");
        exit();
    }

    if ($online_password == $confirmPassword) {
        return true;
    } else {
        echo "Error inputs aren't the same";
        return false;
    }
}

// function to chcek registration form.
function registrationInputs() {
    if (checkInput($_POST['forename'])) {
        $forename = $_POST['forename'];
        $forename = trim($forename);
        $forename = htmlspecialchars($forename);
        if (!checkNames($forename)) {
            echo 'Forename field was not correct';
            header("Location: /student014/shop/backend/forms/form_register.php");
            exit();
        }
    } else {
        echo 'Forename field was not correct';
        header("Location: /student014/shop/backend/forms/form_register.php");
        exit();
    }

    if (checkInput($_POST['lastname'])) {
        $lastname = $_POST['lastname'];
        $lastname = trim($lastname);
        $lastname = htmlspecialchars($lastname);
        if (!checkNames($lastname)) {
            echo 'Lastname field was not correct';
            header("Location: /student014/shop/backend/forms/form_register.php");
            exit();
        }
    } else {
        echo 'Lastname field was not correct';
        header("Location: /student014/shop/backend/forms/form_register.php");
        exit();
    }

    if (checkInput($_POST['username'])) {
        $username = $_POST['username'];
    } else {
        echo 'Username field was not correct';
        header("Location: /student014/shop/backend/forms/form_register.php");
        exit();
    }

    if (checkPassword($_POST['online_password'], $_POST['confirm-password'])) {
        $password = $_POST['online_password'];
    } else {
        echo 'Passwords did not match';
        header("Location: /student014/shop/backend/forms/form_register.php");
        exit();
    }
}

?>