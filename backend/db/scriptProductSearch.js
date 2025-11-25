const endPointProduct = '/student014/shop/backend/endpoints/product_search.php';

showProduct("");

function showProduct(str) {
  if (str.length == null && str.length == 0) {
    document.getElementById('txtHintProduct').innerHTML = "";
    return;
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('txtHintProduct').innerHTML = this.responseText;
          }
      };
  }
  xmlhttp.open('GET', endPointProduct + '?product_name=' + str, true);
  xmlhttp.send();  
}