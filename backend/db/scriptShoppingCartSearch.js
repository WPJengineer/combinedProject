const endPointShoppingCart = '/student014/shop/backend/endpoints/shopping_cart_search.php';

showShoppingCart("");

function showShoppingCart(str) {
  if (str.length == null && str.length == 0) {
    document.getElementById('txtHintShoppingCart').innerHTML = "";
    return;
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('txtHintShoppingCart').innerHTML = this.responseText;
          }
      };
  }
  xmlhttp.open('GET', endPointShoppingCart + '?product_name=' + str, true);
  xmlhttp.send();  
}