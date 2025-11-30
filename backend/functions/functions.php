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

?>