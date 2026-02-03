<?php
// $url = 'https://dataservice.accuweather.com/currentconditions/v1/305482';
// $ch = curl_init();
// $data = array(
// 	'Authorization' => 'Bearer zpka_0c52a288c0d7420b9a9acf1bc51cf5d0_8a04fb91'
// );
// $payload = json_encode($data);
// curl_setopt($ch, CURLOPT_URL, 'https://dataservice.accuweather.com/currentconditions/v1/305482');
// curl_setopt($ch, CURLOPT_POST, true);
// curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
// // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
// $result = curl_exec($ch);
// curl_close($ch);
// echo $result;

// ----------------- weather api to be resolved later.

// make a function that runs all in a for loop to retrieve all products from all the urls.

// alan
// $url = 'https://remotehost.es/student024/Shop/backend/endpoints/sellers/sellers_products.php';
// $apiKey = 'e888b918-330e-43c5-a103-111d57a4a28f';



// json_encode($new_array, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE)

// -----------------------------------

// need to put into an array so we can use a for loop to go through all of our suppliers to get fetch their products
// option to either hardcore here in php or better approach is go fetch all from the database and fill out that array.
// because each supplier has a different scheme for their naming convention have to build function for each supplier and call that function when we have that supplier as the key of the array.
// header('Content-Type: application/json; charset=utf-8');
include('./config/db_config.php');

$sql = "SELECT *
FROM `014_vendors`;";

$result = mysqli_query($conn, $sql);

$vendors = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $vendors[] = $row;
  }
}

foreach ($vendors as $vendor) {

  // echo json_encode($vendor["vendor_id"]);
  // echo json_encode($vendor["vendor_name"]);
  $apiKey = json_encode($vendor["api_key"]);
  // echo stripslashes(json_encode($vendor["api_key"]));
  // echo stripslashes(json_encode($vendor["api_endpoint_products"]));
  $url = stripslashes(json_encode($vendor["api_endpoint_products"]))
  //  . "?apikey=$apiKey"
   ;
  echo $url;
  getProductsFromSuppliers($apiKey, $url);
}

mysqli_close($conn);

function getProductsFromSuppliers($apiKey, $url) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = curl_exec($ch);

  if ($result === false) {
    echo "cURL error: " . curl_error($ch);
  } else {
    echo $result;
  }
  curl_close($ch);
}

// niki
// $apiKeyNiki = '10203040F';
// $url = "https://remotehost.es/student022/backend/apis/suppliers/api_endpoint_call_products.php?apikey=$apiKeyNiki";
// $apiKey = "12345josep";
// $apiKeyJosep = "525b16b0-2b14-49b6-b4ed-3646c299c0ef";
// $url = "https://remotehost.es/student014/shop/backend/endpoints/product_seller.php?apikey=$apiKeyp";
// josep
// $url = "https://remotehost.es/student012/shop/backend/endpoints/seller_products.php?apikey=$apiKeyJosep";

// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $result = curl_exec($ch);

// if ($result === false) {
//     echo "cURL error: " . curl_error($ch);
// } else {
    // echo $result;
    // $keys = ['product_id','product_name','product_image','product_price','product_desc','product_color','product_stock','product_size'];
    // $new_array=[];
    // $test = json_decode($result, true);
    // foreach ($test as $key => $value) {
    //     if(in_array($key,$keys)) {
    //         $new_array[$key]=$value;
    //     }

    //     print_r("product id: " . $value["product_id"] . " ");
    //     print_r("product name: " . $value["product_name"] . " ");
    //     print_r("product price: " . $value["unit_price"] . " ");
// }
// }

// curl_close($ch);
?>