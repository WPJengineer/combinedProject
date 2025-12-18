document.addEventListener('DOMContentLoaded', () => {

    const btnMenu = document.querySelector("#btnMenu");
    const menuPrincipal = document.querySelector(".menu");
    const btnFilters = document.querySelector("#btnFilters");
    const menuFilters = document.querySelector(".menuFilters");
    const btnCloseMenu = document.querySelector("#btnCloseMenu");
    const btnCloseFilters = document.querySelector("#btnCloseFilters");
    // const menuProduct = document.querySelectorAll(".menuProduct");
    // const addProducts = document.querySelectorAll(".cart");
    // const btnCloseProduct = document.querySelector("#btnCloseProduct");
    const btnLogin = document.querySelector('.btnLogin');
    const btnLogin2 = document.querySelector('.user');
    const btnShoppingCart = document.querySelector('.btnShoppingCart');
    const btnShoppingCart2 = document.querySelector('.btnShoppingCart2');
    // const selectProduct = document.querySelectorAll('.article-card');
    const btnShowMore = document.querySelector(".mostrar");
    let allProducts = [];
    let visibleCount = 0;
    const PAGE_SIZE = 6;

    // selectProduct.forEach(card => {
    //     card.addEventListener('click', (e) => {
    //         if (e.target.classList.contains("icon")) return;
    //         window.location.href = "./views/products.html";
    //     });
    // });

    btnMenu.addEventListener('click', () => {
        menuPrincipal.style.display = "flex";
    });

    btnFilters.addEventListener('click', () => {
        menuFilters.style.display = "flex";
    });

    // this will have e.target later to get each product on to the screen.
    // menuProduct.forEach(btn => {
    //     btn.addEventListener('click', () => {
    //     btn.style.display = "flex";
    //     });
    // });

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

    // btnCloseProduct.addEventListener('click', () => {
    //     menuProduct.style.display = "none";
    // });

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
        const url = "https://remotehost.es/student014/shop/backend/endpoints/products_frontend.php";
        try {
            const response = await fetch(url);

            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }

            const products = await response.json();
            allProducts = products;
            visibleCount = 0;
            grid.innerHTML = "";
            renderProducts();
        } catch (error) {
            console.error("Failed to fetch products:", error);
        }
    }
    getProducts();

    function renderProducts() {
        const grid = document.getElementById("productsGrid");
        const end = visibleCount + PAGE_SIZE;
        const slice = allProducts.slice(visibleCount, end);

        slice.forEach(p => {
            const article = document.createElement("article");
            article.className = "article-card";
            article.dataset.id = p.product_id;
            article.style.backgroundImage = `url("${p.product_image}")`;
            article.innerHTML = `<img src="./assets/iconos/favorite_border_24dp_OFOFOF.png" alt="heart" class="icon heart">
                                <div class="bottom-overlay">
                                    <div>
                                        <h4>${p.product_name}</h4>
                                        <h3><span>${Number(p.product_unit_price).toFixed(2)}</span>€</h3>
                                    </div>
                                    <div>
                                        <img src="./assets/iconos/shopping_cart_24dp_FCFCFC.png" alt="shopping-cart" class="icon cart">
                                    </div>
                                </div>
                                <div class="menuProduct">
                                    <form action="#" method=""><!--missing method-->
                                        <img class="icon btnCloseProduct" src="./assets/iconos/close_24dp_0F0F0F.png" alt="close-icon">
                                        <div class="product">
                                            <div>
                                                <img src="${p.product_image}" alt="foto-producto">
                                                <button class="num-products"><span>-</span><span>1</span><span>+</span></button>
                                                <p class="price"><span>${Number(p.product_unit_price).toFixed(2)}</span>€</p>
                                            </div>
                                            <p>${p.product_name}</p>
                                        </div>
                                        <div class="color">
                                            <p>Selecciona color</p>
                                            <div>
                                                <button></button>
                                                <button></button>
                                                <button></button>
                                                <button></button>
                                                <button></button>
                                            </div>
                                        </div>
                                        <div class="size">
                                            <p>Selecciona tu talla</p>
                                            <div>
                                                <button>XS</button>
                                                <button>S</button>
                                                <button>M</button>
                                                <button>L</button>
                                                <button>XL</button>
                                                <button>2XL</button>
                                            </div>
                                        </div>
                                        <div class="buttons">
                                            <button class="button">Añadir a la cesta</button>
                                            <button class="button">Comprar ahora</button>
                                        </div>
                                    </form>
                                </div>`;

            const menuProduct = article.querySelector(".menuProduct");
            const btnCloseProduct = article.querySelector(".btnCloseProduct");
            const addProducts = article.querySelector(".cart");

            addProducts.addEventListener("click", (e) => {
                e.stopPropagation();
                menuProduct.classList.add("is-open");
                document.body.classList.add("modal-open");
            });

            btnCloseProduct.addEventListener("click", (e) => {
                e.stopPropagation();
                menuProduct.classList.remove("is-open");
                document.body.classList.remove("modal-open");
            });

            article.addEventListener("click", (e) => {
                if (e.target.classList.contains("icon")) return;
                window.location.href = `./views/products.html?id=${article.dataset.id}`;
            });

            menuProduct.addEventListener("click", (e) => e.stopPropagation());
            menuProduct.querySelector("form").addEventListener("click", (e) => e.stopPropagation());

            grid.appendChild(article);
        });

        visibleCount = end;
        updateCounter();
    }

    function updateCounter() {
        const shown = Math.min(visibleCount, allProducts.length);
        document.querySelector(".show-more span:nth-child(1)").textContent = shown;
        document.querySelector(".show-more span:nth-child(2)").textContent = allProducts.length;

        if (shown >= allProducts.length) {
            document.querySelector(".mostrar").style.display = "none";
        }
    }

    btnShowMore.addEventListener("click", () => {
        renderProducts();
    });

});