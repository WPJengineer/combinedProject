document.addEventListener('DOMContentLoaded', () => {

    const btnHome = document.getElementById('btnHome');
    const btnHome2 = document.getElementById('btnHome2');
    const btnLogo = document.getElementById('btnLogo');
    const btnMenu = document.querySelector("#btnMenu");
    const menuPrincipal = document.querySelector(".menu");
    const btnCloseMenu = document.querySelector("#btnCloseMenu");
    const btnLogin = document.querySelector('.btnLogin');
    const btnLogin2 = document.querySelector('.user');

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