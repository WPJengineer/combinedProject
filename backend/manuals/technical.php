<?php $backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/'; ?>
<?php require($backend.'header.php'); ?>
<main class="bg-green flex flex-col p-5" style="flex: 1;">
    <h1 class="font-bold text-4xl">Technical Manual</h1>
    <div>
        <h2 class="font-bold text-2xl">Introduction</h2>
        <p><strong>Project name:</strong>TeamWare</p>
        <p><strong>Description:</strong>TeamWare is a web-based e-commerce application focused on selling the merchandise of the Teams participating in the Silph Factions team format.</p>
    </div>
    <div>
        <h2 class="font-bold text-2xl">Implemented Features</h2>
        <ul class="list-disc flex flex-col gap-1 pl-8">
            <li>User session management</li>
            <li>Product, customers and orders management system</li>
            <li>Image upload using PHP file handling</li>
            <li>Language selector using cookies</li>
            <li>Dynamic shopping cart using AJAX with POST</li>
            <li>Filter products using AJAX with GET</li>
            <li>Shows graphs of monthly an dyeraly income</li>
            <li>Retrieve products from other e-commerce using cURL</li>
        </ul>
    </div>
    <div>
        <h2 class="font-bold text-2xl">Pending Features</h2>
        <ul class="list-disc flex flex-col gap-1 pl-8">
            <li>Reviews management system</li>
            <li>Full multilingual content translation</li>
            <li>Advanced form validation</li>
            <li>Error handling</li>
            <li>Payment methods and Address management</li>
            <li>Automatic email confirmation per processed orders</li>
        </ul>
    </div>
</main>
<?php require($backend.'footer.php'); ?>