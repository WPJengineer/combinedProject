document.addEventListener('DOMContentLoaded', () => {

    const btnMenu = document.querySelector("#btnMenu");
    const menuHeader = document.querySelector(".menuHeader");
    const btnCloseMenu = document.querySelector("#btnCloseMenu");
    const selectSizeBtn = document.querySelectorAll('.selectSizeBtn');
    const btnMinus = document.querySelector('.btnMinus');
    const btnPlus = document.querySelector('.btnPlus');
    const quantity = document.querySelector('.quantity');
    // const productImage = document.getElementById('product-image');
    // const btnBlack = document.getElementById('btnBlack');
    // const btnWhite = document.getElementById('btnWhite');
    // const btnOrange = document.getElementById('btnOrange');
    // const btnGrey = document.getElementById('btnGrey');
    // const btnGreen = document.getElementById('btnGreen');
    const scrollContainer = document.getElementById("scrollContainer");
    const btnLeft = document.getElementById("btnLeft");
    const btnRight = document.getElementById("btnRight");
    const btnHome = document.getElementById('btnHome');
    const btnHome2 = document.getElementById('btnHome2');
    const btnLogo = document.getElementById('btnLogo');
    let total = parseInt(quantity.textContent, 10);
    const SCROLL_AMOUNT = 300;

    const params = new URLSearchParams(window.location.search);
    const productId = params.get("id");

    if (!productId) {
        console.error("No product id provided");
        return;
    }

    loadProduct(productId);
    
    async function loadProduct(productId) {
        try {
            const response = await fetch(
                `https://remotehost.es/student014/shop/backend/endpoints/products_frontend.php`
            );
            const products = await response.json();
            const product = products.find(p => String(p.product_id) === String(productId));
            if (!product) throw new Error("Product not found");
            renderProduct(product);

        } catch (err) {
            console.error(err);
        }
    }

    function renderProduct(p) {
        document.querySelector(".product-name").textContent = p.product_name;
        document.querySelector(".product-price").textContent =
            `${Number(p.product_unit_price).toFixed(2)} €`;

        document.querySelector(".product-image").src = p.product_image;
        document.querySelector(".product-description").textContent =
            p.product_description ?? "";
    }



    btnMenu.addEventListener('click', () => {
        menuHeader.style.display = "flex";
    });

    btnCloseMenu.addEventListener('click', () => {
        menuHeader.style.display = "none";
    });

    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            menuHeader.style.display = "";
        }
    });

    // btnBlack.addEventListener('click', () => productImage.src = "../assets/images/25.png");
    // btnWhite.addEventListener('click', () => productImage.src = "../assets/images/1.png");
    // btnOrange.addEventListener('click', () => productImage.src = "../assets/images/9.png");
    // btnGrey.addEventListener('click', () => productImage.src = "../assets/images/17.png");
    // btnGreen.addEventListener('click', () => productImage.src = "../assets/images/33.png");

    selectSizeBtn.forEach(btn => {
        btn.addEventListener('click', () => {
            const isSelected = btn.classList.contains('bg-dark');
            selectSizeBtn.forEach(b => {
                b.classList.remove('bg-dark', 'text-light');
                b.classList.add('bg-light', 'text-dark');
            });
            if (!isSelected) {
                btn.classList.remove('bg-light', 'text-dark');
                btn.classList.add('bg-dark', 'text-light');
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

    btnHome.addEventListener('click', () => {
        window.location.href = "../index.html";
    });

    btnHome2.addEventListener('click', () => {
        window.location.href = "../index.html";
    });

    btnLogo.addEventListener('click', () => {
        window.location.href = "../index.html";
    });

});