const endPointShoppingCart = '/student014/shop/backend/endpoints/showQuantity.php';

const btnMinus = document.querySelectorAll('.btnMinus');
const btnPlus = document.querySelectorAll('.btnPlus');

const productId = btn.dataset.productId;
const customerId = btn.dataset.customerId;

btnMinus.forEach(btn => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    const quantity = e.target.parentElement;
    let numQuantity = +quantity.querySelector('#numQuantity').innerText;
    if (numQuantity > 1) {
      numQuantity--;
      quantity.querySelector('#numQuantity').innerText = numQuantity;
    }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          quantity.querySelector('#numQuantity').innerText = this.responseText;
        }
    };
    xmlhttp.open('GET', endPointShoppingCart + '?quantity=' + encodeURIComponent(numQuantity) + '&product_id=' + encodeURIComponent(productId) + '&customer_id=' + encodeURIComponent(customerId), true);
    xmlhttp.send();
    });
});

btnPlus.forEach(btn => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    const quantity = e.target.parentElement;
    let numQuantity = +quantity.querySelector('#numQuantity').innerText;
    numQuantity++;
    quantity.querySelector('#numQuantity').innerText = numQuantity;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          quantity.querySelector('#numQuantity').innerText = this.responseText;
        }
    };
    xmlhttp.open('GET', endPointShoppingCart + '?quantity=' + encodeURIComponent(numQuantity) + '&product_id=' + encodeURIComponent(productId) + '&customer_id=' + encodeURIComponent(customerId), true);
    xmlhttp.send();
  });
});