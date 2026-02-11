const endPointProduct = '/student014/shop/backend/endpoints/product_search.php';
const endPointCustomer = '/student014/shop/backend/endpoints/customer_search.php';
const endPointShoppingCart = '/student014/shop/backend/endpoints/showQuantity.php';
const btnMinus = document.querySelectorAll('.btnMinus');
const btnPlus = document.querySelectorAll('.btnPlus');
const endPointOrder = '/student014/shop/backend/endpoints/orders_search.php';
const stars = document.querySelectorAll('.star');
const ratingInput = document.getElementById('rating');

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
  xmlhttp.open('POST', endPointCustomer, true);
  xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  var params = "customer_name=" + encodeURIComponent(str);
  xmlhttp.send(params);  
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
  // misiing to make post and not get method to send data
  xmlhttp.open('GET', endPointOrder + '?order_number=' + str, true);
  xmlhttp.send();  
}

// function plotGraph() {
//   // i need to fetch these from my database
//   const months = ["January", "February",  "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
//   const subtotals = [100,100,100,100,100,100,100,100,100,100,100,100];

//   const data = [{
//   x:months,
//   y:subtotals,
//   type:"bar",
//   orientation:"v",
//   marker: {color:"rgba(0,0,255,0.6)"}
//   }];
//   const layout = {title:"Monthly income for 2025"};
//   console.log("hello");
//   Plotly.newPlot("myPlot", data, layout);
// }

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
    xmlhttp.open('POST', endPointShoppingCart, true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const params =
      'quantity='   + encodeURIComponent(numQuantity) +
      '&product_id='  + encodeURIComponent(productId) +
      '&customer_id=' + encodeURIComponent(customerId);
    xmlhttp.send(params);
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
    xmlhttp.open('POST', endPointShoppingCart, true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    const params =
      'quantity='   + encodeURIComponent(numQuantity) +
      '&product_id='  + encodeURIComponent(productId) +
      '&customer_id=' + encodeURIComponent(customerId);
    xmlhttp.send(params);
  });
});

stars.forEach(star => {
  star.addEventListener('click', (e) => {
    const rating = parseInt(e.target.dataset.value);
    ratingInput.value = rating;
    stars.forEach(star => {
      if (parseInt(star.dataset.value) <= rating) {
        star.src = "/student014/shop/assets/iconos/icon-star-full.png";
      } else {
        star.src = "/student014/shop/assets/iconos/icon-star-empty.png";
      }
    });
  })
});