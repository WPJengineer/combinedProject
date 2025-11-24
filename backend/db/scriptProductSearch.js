const endPointProduct = '/student014/shop/backend/endpoints/product_search.php';

let str = "";
showProduct(str);

function showProduct(str) {
  if (str.length == null && str.length == 0) {
    document.getElementById('txtHint').innerHTML = "";
    return;
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('txtHint').innerHTML = this.responseText;
          }
      };
  }
  xmlhttp.open('GET', endPointProduct + '?product_name=' + str, true);
  xmlhttp.send();  
}