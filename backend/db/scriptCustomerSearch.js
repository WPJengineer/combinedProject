const endPointCustomer = '/student014/shop/backend/endpoints/customer_search.php';

showCustomer("");

function showCustomer(str) {
  if (str.length == null && str.length == 0) {
    document.getElementById('txtHintCustomer').innerHTML = "";
    return;
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('txtHintCustomer').innerHTML = this.responseText;
          }
      };
  }
  xmlhttp.open('GET', endPointCustomer + '?customer_name=' + str, true);
  xmlhttp.send();  
}