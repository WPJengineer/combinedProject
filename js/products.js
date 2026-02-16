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
    const btnShoppingCart = document.querySelector('.btnShoppingCart');
    const btnShoppingCart2 = document.querySelector('.btnShoppingCart2');
    const btnLogin = document.querySelector('.btnLogin');
    const btnLogin2 = document.querySelector('.user');
    let total = parseInt(quantity.textContent, 10);
    const addToCart = document.querySelector('.addToCart');
    const SCROLL_AMOUNT = 300;
    const params = new URLSearchParams(window.location.search);
    const productId = params.get("id");
    let productData = null;

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
            productData = product;
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

    function getGuestCart() {
        try {
            const items = localStorage.getItem("guestCart") ? JSON.parse(localStorage.getItem("guestCart")) : [];
            return Array.isArray(items) ? items : [];
        } catch {
            return [];
        }
    }

    function saveGuestCart(cart) {
        localStorage.setItem("guestCart", JSON.stringify(cart));
    }



    addToCart.addEventListener('click', (e) => {
        e.preventDefault();
        if (!productData) return;
        const quantity = +document.querySelector('.quantity').textContent;
        //missing to chcek if logged in and add to shopping cart in backend.
        const cart = getGuestCart();
        const existingIndex = cart.findIndex(
            item => String(item.product_id) === String(productData.product_id)
        );
    
        if (existingIndex >= 0) {
            cart[existingIndex].quantity += quantity;
        } else {
            cart.push({
                product_id: productData.product_id,
                product_name: productData.product_name,
                product_unit_price: Number(productData.product_unit_price),
                product_image: productData.product_image,
                quantity: quantity
            });
        }
    
        saveGuestCart(cart);
        window.location.href = '../index.html';
    });

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

    btnShoppingCart.addEventListener('click', () => {
        window.location.href = "./shopping_cart.html";
    });

    btnShoppingCart2.addEventListener('click', () => {
        window.location.href = "./shopping_cart.html";
    });

    btnLogin.addEventListener('click', () => {
        window.location.href = "/student014/shop/backend/forms/form_login.php";
    });

    btnLogin2.addEventListener('click', () => {
        window.location.href = "/student014/shop/backend/forms/form_login.php";
    });
    
});