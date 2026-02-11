<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');
if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

include('../config/db_config.php');

$sql = "SELECT total_subtotal FROM view_monthly_income_2025;";

$result = mysqli_query($conn, $sql);

$subtotals = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $subtotals[] = $row['total_subtotal'];
  }
}

// print_r($subtotals);

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>
<main>
    <canvas id="myChart" style="width:100%;max-width:700px"></canvas>
</main>
<script>
    const months = ["January", "February",  "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const subtotals = <?php echo json_encode($subtotals); ?>;

    const barColors = ["blue"];
    const ctx = document.getElementById('myChart');
    

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: months,
            datasets: [{
            backgroundColor: barColors,
            data: subtotals
            }]
        },
        options: {
            plugins: {
            legend: {display: false},
            title: {
                display: true,
                text: "monthly income",
                font: {size: 16}
            }
            }
        }
    });

    console.log(subtotals);
    myChart.newPlot("myPlot", data, layout);
</script>

<?php

require($backend.'footer.php');

?>