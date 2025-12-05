const endPointShoppingCart = '/student014/shop/backend/endpoints/showQuantity.php';

const btnMinus = document.querySelectorAll('.btnMinus');
const btnPlus = document.querySelectorAll('.btnPlus');

// function updateSubtotal(btn, quantity) {
//   const cart = btn.closest('.shopping-cart');
//   const priceElement = cart.querySelector('.unit-price');
//   const subtotalElement = cart.querySelector('.subtotal');
//   const unitPrice = parseFloat(priceElement.innerText.replace(/[^\d.]/g, ''));
//   const newSubtotal = unitPrice * quantity;

//   subtotalElement.innerText = 'Subtotal: ' + newSubtotal.toFixed(2) + '€';
// }

btnMinus.forEach(btn => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    const productId = btn.dataset.productId;
    const customerId = btn.dataset.customerId;
    const quantity = e.target.parentElement;
    let numQuantity = +quantity.querySelector('#numQuantity').innerText;
    if (numQuantity > 1) {
      numQuantity--;
      quantity.querySelector('#numQuantity').innerText = numQuantity;
      // updateSubtotal(btn, numQuantity);
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
    const productId = btn.dataset.productId;
    const customerId = btn.dataset.customerId;
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