document.addEventListener('DOMContentLoaded', () => {

    const btnHome = document.getElementById('btnHome');
    const btnHome2 = document.getElementById('btnHome2');
    const btnLogo = document.getElementById('btnLogo');
    const btnMenu = document.querySelector("#btnMenu");
    const menuPrincipal = document.querySelector(".menu");
    const btnCloseMenu = document.querySelector("#btnCloseMenu");
    const btnLogin = document.querySelector('.btnLogin');
    const btnLogin2 = document.querySelector('.user');
    let cart = [];

    //FUNCTIONS

    async function getShoppingCart() {
        // const cart = getGuestCart();
        //check for logged in or not
        //if logged in get info from backend
        //if not logged in get info from localStorage
        // if (cart.length === 0) return;
        const shoppingCart = document.getElementById("shopping_cart");
        try {
            const url = "https://remotehost.es/student014/shop/backend/endpoints/shopping_cart_frontend.php";
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }
            const items = await response.json();
            shoppingCart.innerHTML = "";
            renderCart(items, shoppingCart);
        } catch (error) {
            console.error("Failed to fetch shopping cart:", error);
        }
    }
    getShoppingCart();

    function renderCart(items, container) {
        if (!items || items.length === 0) {
            container.innerHTML = "<p>Your cart is empty.</p>";
            return;
        }
        const html = items.map(item => {
            const qty = Number(item.quantity) || 1;

            const name = item.product_name ?? "Nombre producto";
            const price = Number(item.product_unit_price) || 0;
            const img = item.product_image;
            // this is prepared for when we use the categories
            // const tags = [
            //     "M",
            //     "Unisex",
            //     item.color
            // ].filter(Boolean).join(" ");

            return `<div class="product" data-product-id="${item.product_id}">
                        <div class="product-image">
                            <img src="${img}" alt="product-image">
                        </div>
                        <div class="actions">
                            <div class="btnQuantity">
                                <button class="qty-minus" type="button">-</button>
                                <span class="qty">${qty}</span>
                                <button class="qty-plus" type="button">+</button>
                            </div>
                            <div class="btnDelete">
                                <img class="icon delete" src="../assets/iconos/delete_24dp_OFOFOF.png" alt="delete-icon">
                            </div>
                        </div>
                        <div class="price">
                            <span>${(price * qty).toFixed(2)}€</span>
                        </div>
                        <div class="product-details">
                            <p class="product-name">${name}</p>
                            <p class="product-tags">Tags</p>
                            <span>${price.toFixed(2)}€</span>
                        </div>
                    </div>`;
        }).join("");
        container.insertAdjacentHTML("beforeend", html);
    }

    //EVENTS

    btnHome.addEventListener('click', () => {
        window.location.href = "../index.html";
    });

    btnHome2.addEventListener('click', () => {
        window.location.href = "../index.html";
    });

    btnLogo.addEventListener('click', () => {
        window.location.href = "../index.html";
    });

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

    btnLogin.addEventListener('click', () => {
        window.location.href = "/student014/shop/backend/forms/form_login.php";
    });

    btnLogin2.addEventListener('click', () => {
        window.location.href = "/student014/shop/backend/forms/form_login.php";
    });

});