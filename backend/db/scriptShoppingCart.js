const endPointShoppingCart = '/student014/shop/backend/endpoints/showQuantity.php';

const btnMinus = document.querySelectorAll('.btnMinus');
const btnPlus = document.querySelectorAll('.btnPlus');

// console.log(btnMinus);

btnMinus.forEach(btn => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    const quantity = e.target.parentElement;
    let numQuantity = +quantity.querySelector('#numQuantity').innerText;
    if (numQuantity > 1) {
      numQuantity--;
    }
    quantity.querySelector('#numQuantity').innerText = numQuantity;
    // reduceQuantity(numQuantity);
    // if (num <= 1) {
    //   return;
    // } else {
    //   var xmlhttp = new XMLHttpRequest();
    //   xmlhttp.onreadystatechange = function() {
    //       if (this.readyState == 4 && this.status == 200) {
    //         numQuantity.innerHTML = this.responseText;
    //       }
    //   };
    // }
    // xmlhttp.open('GET', endPointShoppingCart + '?quantity=' + str, true);
    // xmlhttp.send();
    });
});

btnPlus.forEach(btn => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    const quantity = e.target.parentElement;
    let numQuantity = +quantity.querySelector('#numQuantity').innerText;
    numQuantity++;
    quantity.querySelector('#numQuantity').innerText = numQuantity;
  });
});

// function reduceQuantity(num) {

//   if (num <= 1) {
//     return;
//   } else {
//     var xmlhttp = new XMLHttpRequest();
//     xmlhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//           const numQuantity = quantity.querySelector('#numQuantity').innerHTML = this.responseText;
//         }
//     };
//   }
//   xmlhttp.open('GET', endPointShoppingCart + '?quantity=' + str, true);
//   xmlhttp.send(); 
// }

// function increaseQuantity(num) {

// }