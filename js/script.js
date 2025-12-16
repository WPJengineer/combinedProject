document.addEventListener('DOMContentLoaded', () => {

    const btnMenu = document.querySelector("#btnMenu");
    const menuPrincipal = document.querySelector(".menu");
    const btnFilters = document.querySelector("#btnFilters");
    const menuFilters = document.querySelector(".menuFilters");
    const btnCloseMenu = document.querySelector("#btnCloseMenu");
    const btnCloseFilters = document.querySelector("#btnCloseFilters");
    const menuProduct = document.querySelector(".menuProduct");
    const addProducts = document.querySelectorAll(".cart");
    const btnCloseProduct = document.querySelector("#btnCloseProduct");
    const btnLogin = document.querySelector('.menu div button:nth-child(1)');
    const btnLogin2 = document.querySelector('.user');
    const btnShoppingCart = document.querySelector('.btnShoppingCart');
    const btnShoppingCart2 = document.querySelector('.btnShoppingCart2');
    const selectProduct = document.querySelectorAll('.article-card');

    selectProduct.forEach(card => {
        card.addEventListener('click', (e) => {
            if (e.target.classList.contains("icon")) return;
            window.location.href = "./views/products.html";
        });
    });

    btnMenu.addEventListener('click', () => {
        menuPrincipal.style.display = "flex";
    });

    btnFilters.addEventListener('click', () => {
        menuFilters.style.display = "flex";
    });

    // this will have e.target later to get each product on to the screen.
    addProducts.forEach(addProduct => {
        addProduct.addEventListener('click', () => {
        menuProduct.style.display = "flex";
        });
    });

    btnCloseMenu.addEventListener('click', () => {
        menuPrincipal.style.display = "none";
    });

    btnCloseFilters.addEventListener('click', () => {
        menuFilters.style.display = "none";
    });

    // to avoid issue with disappearing filters menu after resizing to desktop
    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            menuPrincipal.style.display = "";
        }

        if (window.innerWidth >= 992) {
            menuFilters.style.display = "";
        }
    });

    btnCloseProduct.addEventListener('click', () => {
        menuProduct.style.display = "none";
    });

    btnLogin.addEventListener('click', () => {
        window.location.href = "/student014/shop/backend/forms/form_login.php";
    });

    btnLogin2.addEventListener('click', () => {
        window.location.href = "/student014/shop/backend/forms/form_login.php";
    });

    btnShoppingCart.addEventListener('click', () => {
        window.location.href = "./views/shopping_cart.html";
    });

    btnShoppingCart2.addEventListener('click', () => {
        window.location.href = "./views/shopping_cart.html";
    });

    async function getProducts() {
        const grid = document.getElementById("productsGrid");
        if (!grid) return;
        const url = "https://remotehost.es/student014/shop/backend/endpoints/product_search.php";
        try {
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }

            const products = await response.json();

            grid.innerHTML = "";

            for (const p of products) {
                const article = document.createElement("article");
                article.className = "article-card";

                article.style.backgroundImage = `url("${p.product_image}")`;

                article.innerHTML = `
                    <img src="./assets/iconos/favorite_border_24dp_OFOFOF.png" alt="heart" class="icon heart">
                    <div class="bottom-overlay">
                    <div>
                        <h4>${p.product_name}</h4>
                        <h3><span>${Number(p.product_unit_price).toFixed(2)}</span>€</h3>
                    </div>
                    <div>
                        <img src="./assets/iconos/shopping_cart_24dp_FCFCFC.png" alt="shopping-cart" class="icon cart">
                    </div>
                    </div>
                `;

                grid.appendChild(article);
            }

        } catch (error) {
            console.error("Failed to fetch products:", error);
        }
    }
    getProducts();

});