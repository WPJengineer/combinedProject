document.addEventListener('DOMContentLoaded', () => {

    const btnMenu = document.querySelector("#btnMenu");
    const menuPrincipal = document.querySelector(".menu");
    const btnFilters = document.querySelector("#btnFilters");
    const menuFilters = document.querySelector(".menuFilters");
    const btnCloseMenu = document.querySelector("#btnCloseMenu");
    const btnCloseFilters = document.querySelector("#btnCloseFilters");
    const btnLogin = document.querySelector('.btnLogin');
    const btnLogin2 = document.querySelector('.user');
    const btnShoppingCart = document.querySelector('.btnShoppingCart');
    const btnShoppingCart2 = document.querySelector('.btnShoppingCart2');
    const btnShowMore = document.querySelector(".mostrar");
    const btnDwec = document.querySelector(".btnDwec");
    let allProducts = [];
    let visibleCount = 0;
    const PAGE_SIZE = 6;

    //FUNCTIONS

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
            article.innerHTML = `<button type="button" class="wishlistBtn" aria-label="Añadir ${p.product_name} a favoritos" aria-pressed="false">
                                    <img src="./assets/iconos/favorite_border_24dp_OFOFOF.png" alt="" class="icon heart">
                                </button>
                                <div class="bottom-overlay">
                                    <div>
                                        <h4 id="product-name-${p.product_id}">${p.product_name}</h4>
                                        <h3><span>${Number(p.product_unit_price).toFixed(2)}</span>€</h3>
                                    </div>
                                    <button type="button" class="openProductBtn" aria-haspopup="dialog" aria-controls="product-dialog-${p.product_id}" aria-label="Ver detalles y comprar ${p.product_name}">
                                        <img src="./assets/iconos/shopping_cart_24dp_FCFCFC.png" alt="" class="icon cart">
                                    </button>
                                </div>
                                <div class="menuProduct" id="product-dialog-${p.product_id}" role="dialog" aria-modal="true" aria-hidden="true" aria-labelledby="product-title-${p.product_id}">
                                    <form>
                                        <img role="button" class="icon btnCloseProduct" aria-label="Cerrar detalles de ${p.product_name}" src="./assets/iconos/close_24dp_0F0F0F.png" alt="">
                                        <div class="product">
                                            <div role="button">
                                                <img src="${p.product_image}" alt="${p.product_name}">
                                                <button class="num-products" aria-label="Cantidad"><span class="btnMinus" role="button" aria-label="Disminuir cantidad">-</span><span class="quantity" aria-live="polite">1</span><span class="btnPlus" role="button" aria-label="Aumentar cantidad">+</span></button>
                                                <p class="price"><span>${Number(p.product_unit_price).toFixed(2)}</span>€</p>
                                            </div>
                                            <p>${p.product_name}</p>
                                        </div>
                                        <div class="color" role="radiogroup" aria-label="Selecciona color">
                                            <p>Selecciona color</p>
                                            <div>
                                                <button type="button" role="radio" aria-checked="false" aria-label="Color negro"></button>
                                                <button type="button" role="radio" aria-checked="false" aria-label="Color blanco"></button>
                                                <button type="button" role="radio" aria-checked="false" aria-label="Color beige"></button>
                                                <button type="button" role="radio" aria-checked="false" aria-label="Color gris"></button>
                                                <button type="button" role="radio" aria-checked="false" aria-label="Color verde"></button>
                                            </div>
                                        </div>
                                        <div class="size" role="radiogroup" aria-label="Selecciona tu talla">
                                            <p>Selecciona tu talla</p>
                                            <div>
                                                <button type="button" role="radio" aria-checked="false">XS</button>
                                                <button type="button" role="radio" aria-checked="false">S</button>
                                                <button type="button" role="radio" aria-checked="false">M</button>
                                                <button type="button" role="radio" aria-checked="false">L</button>
                                                <button type="button" role="radio" aria-checked="false">XL</button>
                                                <button type="button" role="radio" aria-checked="false">2XL</button>
                                            </div>
                                        </div>
                                        <div class="buttons">
                                            <button class="addToCart button">Añadir a la cesta</button>
                                            <button class="button">Comprar ahora</button>
                                        </div>
                                    </form>
                                </div>`;

            const menuProduct = article.querySelector(".menuProduct");
            const btnCloseProduct = article.querySelector(".btnCloseProduct");
            const addProducts = article.querySelector(".cart");
            const btnMinus = article.querySelector('.btnMinus');
            const btnPlus = article.querySelector('.btnPlus');
            const quantity = article.querySelector('.quantity');
            let total = parseInt(quantity.textContent, 10);
            const addToCart = article.querySelector('.addToCart');

            addToCart.addEventListener('click', (e) => {
                e.preventDefault();
                const quantity = +article.querySelector('.quantity').textContent;
                //missing to chcek if logged in and add to shopping cart in backend.
                const cart = getGuestCart();
                const existingIndex = cart.findIndex(
                    item => String(item.product_id) === String(p.product_id)
                );
            
                if (existingIndex >= 0) {
                    cart[existingIndex].quantity += quantity;
                } else {
                    cart.push({
                        product_id: p.product_id,
                        product_name: p.product_name,
                        product_unit_price: Number(p.product_unit_price),
                        product_image: p.product_image,
                        quantity: quantity
                    });
                }
            
                saveGuestCart(cart);
                closeMenuTab();
            });

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

            btnMinus.addEventListener('click', (e) => {
                e.preventDefault();
                if (total <= 1) return;
                total--;
                quantity.textContent = total;
            });
        
            btnPlus.addEventListener('click', (e) => {
                e.preventDefault();
                total++;
                quantity.textContent = total;
            });

            addProducts.addEventListener("click", (e) => {
                e.stopPropagation();
                menuProduct.classList.add("is-open");
                document.body.classList.add("modal-open");
            });

            btnCloseProduct.addEventListener("click", (e) => {
                e.stopPropagation();
                closeMenuTab();
            });

            function closeMenuTab() {
                menuProduct.classList.remove("is-open");
                document.body.classList.remove("modal-open");
            }

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

    //EVENTS


    btnMenu.addEventListener('click', () => {
        menuPrincipal.style.display = "flex";

    });

    btnFilters.addEventListener('click', () => {
        menuFilters.style.display = "flex";
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

    btnShowMore.addEventListener("click", () => {
        renderProducts();
    });


    btnDwec.addEventListener('click', () => {
        window.location.href = "/student014/shop/joc-dwec";
    })
});