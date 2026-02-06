<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');

// Get data
$customer_id = $_SESSION['customer_id'];
$customer_forename = $_SESSION['username'];
$customer_lastname = $_SESSION['userLastname'];

// Put data in the database
include('../config/db_config.php');

if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

$order_number = generateOrderNumber($customer_id, $customer_forename, $customer_lastname);

// create query - add t orders table
$sql = "INSERT INTO `014_orders` (order_number, product_id, customer_id, vendor_id, quantity, product_unit_price)
SELECT '$order_number', sc.product_id, sc.customer_id, p.vendor_id, sc.quantity, (p.product_unit_price * sc.quantity)
FROM `014_shopping_cart` AS sc
INNER JOIN `014_products` AS p ON p.product_id = sc.product_id
WHERE sc.customer_id = $customer_id";

// ------------------------------------

// need to send order of products from suppliers to suppliers here.
// vendor_id 0 is local customers.
$data = "SELECT *
FROM `014_vendors`;";

$result = mysqli_query($conn, $data);

$vendors = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $vendors[] = $row;
  }
}

foreach ($vendors as $vendor) {
    $vendorId = $vendor["vendor_id"];
    $apiKey = $vendor["api_key"];
    $url = $vendor["api_endpoint_orders"] . "?apikey=" . $apiKey;
    sendOrdersSuppliers($conn, $vendorId, $url);
}

// mysqli_close($conn);

function sendOrdersSuppliers($conn, $vendorId, $url) {
    $sendOrder =
            "SELECT 
                o.order_number AS order_number,
                p.product_code AS product_code,
                o.quantity AS product_quantity,
                o.placed_on AS order_placed_on,
                c.forename AS customer_forename,
                c.lastname AS customer_surname,
                c.nif AS customer_nif,
                c.email AS customer_email,
                c.phone_number AS customer_phone,
                a.address AS customer_address,
                a.city AS customer_location,
                a.country AS customer_country,
                a.zip_code AS customer_zip
            FROM `014_orders` AS o
            INNER JOIN `014_products` AS p ON o.product_id = p.product_id
            INNER JOIN `014_customers` AS c ON o.customer_id = c.customer_id
            INNER JOIN `014_customer_address` AS ca ON c.customer_id = ca.customer_id
            INNER JOIN `014_address` AS a ON ca.address_id = a.address_id
            WHERE p.vendor_id <> 0
                AND p.vendor_id = '$vendorId';";

    $result = mysqli_query($conn, $sendOrder);

    $order = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $order[] = $row;
        }
    } else {
        return;
    }

    $payload = json_encode($order);
    $urlOrder = $url . "&orders_json=" . urlencode($payload);

    print_r($urlOrder);

    $ch = curl_init($urlOrder);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if ($response === false) {
        error_log("cURL error for vendor {$vendorId}: " . curl_error($ch));
    }

    curl_close($ch);
}

// ----------------------------------------------------

// execute query
if (mysqli_query($conn, $sql)) {
    // delete from shopping cart.
    $deleteFromShoppingCart =
    "DELETE
    FROM `014_shopping_cart`
    WHERE customer_id = $customer_id;";

    mysqli_query($conn, $deleteFromShoppingCart);

    echo
        '<main class="bg-green flex flex-col items-center justify-center gap-6" style="flex: 1;">
            <p>Product ordered successfully</p>
            <p class="button"><a href="/student014/shop/backend/index.php">Return to Start</a></p>
        </main>';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// close channel after finishing query
mysqli_close($conn);

require($backend.'footer.php');
?>