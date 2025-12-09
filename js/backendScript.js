const endPointProduct = '/student014/shop/backend/endpoints/product_search.php';
const endPointCustomer = '/student014/shop/backend/endpoints/customer_search.php';
const endPointShoppingCart = '/student014/shop/backend/endpoints/showQuantity.php';
const btnMinus = document.querySelectorAll('.btnMinus');
const btnPlus = document.querySelectorAll('.btnPlus');
const endPointOrder = '/student014/shop/backend/endpoints/orders_search.php';
// const btnReview1 = document.querySelectorAll('.star1');
// const btnReview2 = document.querySelectorAll('.star2');
// const btnReview3 = document.querySelectorAll('.star3');
// const btnReview4 = document.querySelectorAll('.star4');
// const btnReview5 = document.querySelectorAll('.star5');
const btnReview = document.querySelectorAll('.btnReview');

// FUNCTIONS

showProduct("");

function showProduct(str) {
  const hint = document.getElementById('txtHintProduct');
  if (!hint) return;  
  if (str.length == null && str.length == 0) {
    hint.innerHTML = "";
    return;
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            hint.innerHTML = this.responseText;
          }
      };
  }
  xmlhttp.open('GET', endPointProduct + '?product_name=' + str, true);
  xmlhttp.send();  
}

showCustomer("");

function showCustomer(str) {
  const hint = document.getElementById('txtHintCustomer');
  if (!hint) return; 
  if (str.length == null && str.length == 0) {
    hint.innerHTML = "";
    return;
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            hint.innerHTML = this.responseText;
          }
      };
  }
  xmlhttp.open('GET', endPointCustomer + '?customer_name=' + str, true);
  xmlhttp.send();  
}

function updateSubtotal(btn, quantity) {
  const cart = btn.closest('.shopping-cart');
  const priceElement = cart.querySelector('#unit-price');
  const subtotalElement = cart.querySelector('.subtotal');
  const unitPrice = parseFloat(priceElement.innerText.replace(/[^\d.]/g, ''));
  const newSubtotal = unitPrice * quantity;

  subtotalElement.innerText = 'Subtotal: ' + newSubtotal + '€';
  updateCartTotal();
}

function updateCartTotal() {
  const subtotals = document.querySelectorAll('.subtotal');
  let total = 0;

  subtotals.forEach((subtotal) => {
    let value = parseFloat(subtotal.innerText.replace(/[^\d.]/g, ''));
    total += value;
  });

  document.getElementById('cart-total').innerText = 'Subtotal: ' + total.toFixed(2) + '€'  
}

showOrder("");

function showOrder(str) {
  const hint = document.getElementById('txtHintOrder');
  if (!hint) return;   
  if (str.length == null && str.length == 0) {
    hint.innerHTML = "";
    return;
  } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            hint.innerHTML = this.responseText;
          }
      };
  }
  xmlhttp.open('GET', endPointOrder + '?order_number=' + str, true);
  xmlhttp.send();  
}

// EVENTS

btnMinus.forEach(btn => {
  btn.addEventListener('click', (e) => {
    // e.preventDefault();
    const productId = btn.dataset.productId;
    const customerId = btn.dataset.customerId;
    const quantity = e.target.parentElement;
    let numQuantity = +quantity.querySelector('#numQuantity').innerText;
    if (numQuantity > 1) {
      numQuantity--;
      quantity.querySelector('#numQuantity').innerText = numQuantity;
      updateSubtotal(btn, numQuantity);
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
    updateSubtotal(btn, numQuantity);
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

btnReview.forEach(btn => {
  btn.addEventListener('click',(e) => {
    // need to get customer id and product_id.
    location.href = '/student014/shop/backend/forms/form_review_insert.php?customer_id="1"&product_id="1"';
  });
});

// btnReview1.forEach(btn => {
//   btn.addEventListener('click', (e) => {
//     e.currentTarget.src = "/student014/shop/assets/iconos/icon-star-full.png";
//   });
// });

// btnReview2.forEach(btn => {
//   btn.addEventListener('click', (e) => {
//     e.currentTarget.src = "/student014/shop/assets/iconos/icon-star-full.png";
//   });
// });

// btnReview3.forEach(btn => {
//   btn.addEventListener('click', (e) => {
//     e.currentTarget.src = "/student014/shop/assets/iconos/icon-star-full.png";
//   });
// });

// btnReview4.forEach(btn => {
//   btn.addEventListener('click', (e) => {
//     e.currentTarget.src = "/student014/shop/assets/iconos/icon-star-full.png";
//   });
// });

// btnReview5.forEach(btn => {
//   btn.addEventListener('click', (e) => {
//     e.currentTarget.src = "/student014/shop/assets/iconos/icon-star-full.png";
//   });
// });