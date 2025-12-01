const endPointOrder = '/student014/shop/backend/endpoints/orders_search.php';

showOrder("");

function showOrder(str) {
  if (str.length == null && str.length == 0) {
    document.getElementById('txtHintOrder').innerHTML = "";
    return;
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('txtHintOrder').innerHTML = this.responseText;
          }
      };
  }
  xmlhttp.open('GET', endPointOrder + '?order_number=' + str, true);
  xmlhttp.send();  
}