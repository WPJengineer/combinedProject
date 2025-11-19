document.addEventListener('DOMContentLoaded', () => {

    const btnMenu = document.querySelector("#btnMenu");
    const menuPrincipal = document.querySelector(".menu");
    const btnCloseMenu = document.querySelector("#btnCloseMenu");
    const btnsSize = document.querySelectorAll('.size button');
    const btnMinus = document.querySelector('.btnMinus');
    const btnPlus = document.querySelector('.btnPlus');
    const quantity = document.querySelector('.quantity');
    let total = parseInt(quantity.textContent, 10);

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

});