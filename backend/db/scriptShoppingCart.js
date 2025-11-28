const endPointShoppingCart = '/student014/shop/backend/endpoints/showQuantity.php';

const btnMinus = document.querySelectorAll('.btnMinus');
const btnPlus = document.querySelectorAll('.btnPlus');

// console.log(btnMinus);

btnMinus.forEach(btn => {
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    const quantity = e.parentElement;
    // const numQuantity = quantity.querySelector('#numQuantity');
    console.log('hola');
    console.log(quantity);
    // console.log(numQuantity);
  });
});

