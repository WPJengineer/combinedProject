document.addEventListener('DOMContentLoaded', () => {

    const btnMenu = document.querySelector("#btnMenu");
    const menuPrincipal = document.querySelector(".menu");
    const btnCloseMenu = document.querySelector("#btnCloseMenu");
    const btnsSize = document.querySelectorAll('.size button');
    const btnMinus = document.querySelector('.btnMinus');
    const btnPlus = document.querySelector('.btnPlus');
    const quantity = document.querySelector('.quantity');
    const productImage = document.getElementById('product-image');
    const btnBlack = document.getElementById('btnBlack');
    const btnWhite = document.getElementById('btnWhite');
    const btnOrange = document.getElementById('btnOrange');
    const btnGrey = document.getElementById('btnGrey');
    const btnGreen = document.getElementById('btnGreen');
    const scrollContainer = document.getElementById("scrollContainer");
    const btnLeft = document.getElementById("btnLeft");
    const btnRight = document.getElementById("btnRight");
    let total = parseInt(quantity.textContent, 10);
    const SCROLL_AMOUNT = 300;

    btnMenu.addEventListener('click', () => {
        menuPrincipal.style.display = "flex";
    });

    btnCloseMenu.addEventListener('click', () => {
        menuPrincipal.style.display = "none";
    });

    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            menuPrincipal.style.display = "";
        }
    });

    btnBlack.addEventListener('click', () => productImage.src = "../assets/images/25.png");
    btnWhite.addEventListener('click', () => productImage.src = "../assets/images/1.png");
    btnOrange.addEventListener('click', () => productImage.src = "../assets/images/9.png");
    btnGrey.addEventListener('click', () => productImage.src = "../assets/images/17.png");
    btnGreen.addEventListener('click', () => productImage.src = "../assets/images/33.png");

    btnsSize.forEach(btn => {
        btn.addEventListener('click', () => {
            
            const isSelected = btn.classList.contains('bg-dark');
            btnsSize.forEach(b => {
                b.classList.remove('bg-dark', 'text-light');
                b.classList.add('bg-light');
            });
            if (!isSelected) {
                btn.classList.replace('bg-light', 'bg-dark');
                btn.classList.add('text-light');
            }
        });
    });

    btnMinus.addEventListener('click', () => {
        if (total <= 1) return;
        total--;
        quantity.textContent = total;
    });

    btnPlus.addEventListener('click', () => {
        total++;
        quantity.textContent = total;
    });

    btnRight.addEventListener("click", () => {
        scrollContainer.scrollBy({
            left: SCROLL_AMOUNT,
            behavior: "smooth"
        });
    });

    btnLeft.addEventListener("click", () => {
        scrollContainer.scrollBy({
            left: -SCROLL_AMOUNT,
            behavior: "smooth"
        });
    });

});