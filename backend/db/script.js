const endPoint = '/student014/online_shop/backend/endpoints/product-search.php';
function showHint(str) {
  if (str.length == 0) {
      document.getElementById('txtHint').innerHTML = '';
    //   return;
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById('txtHint').innerHTML = this.responseText;
          }
      };
  }
  xmlhttp.open('GET', endPoint + '?product_name=' + str, true);
  xmlhttp.send();  
}