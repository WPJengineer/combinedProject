<?php

$backend = $_SERVER['DOCUMENT_ROOT'].'/student014/shop/backend/';
require($backend.'header.php');
if (!isset($_SESSION['customer_id'])) {
    header("Location: /student014/shop/backend/forms/form_login.php");
    exit();
}

include('../config/db_config.php');

$sql2025 = "SELECT total_subtotal FROM `014_view_monthly_income_2025`;";

$result = mysqli_query($conn, $sql2025);

$subtotals2025 = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $subtotals2025[] = $row['total_subtotal'];
  }
}

$sql2026 = "SELECT total_subtotal FROM `014_view_monthly_income_2026`;";

$result = mysqli_query($conn, $sql2026);

$subtotals2026 = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $subtotals2026[] = $row['total_subtotal'];
  }
}

$sqlProducts2025 = "SELECT product_name, total_revenue FROM `014_view_income_per_product_2025`;";

$result = mysqli_query($conn, $sqlProducts2025);

$products2025 = [];
$totalRevenue2025 = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $products2025[] = $row['product_name'];
    $totalRevenue2025[] = $row['total_revenue'];
  }
}

$sqlProducts2026 = "SELECT product_name, total_revenue FROM `014_view_income_per_product_2026`;";

$result = mysqli_query($conn, $sqlProducts2026);

$products2026 = [];
$totalRevenue2026 = [];

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $products2026[] = $row['product_name'];
    $totalRevenue2026[] = $row['total_revenue'];
  }
}

mysqli_close($conn);
// print_r($subtotals);

?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>
<main class="bg-green" style="padding:25px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:25px;">
    <canvas id="myChart2025" style="width:100vW;max-width:1000px;max-height:650px;"></canvas>
    <canvas id="myChart2026" style="width:100vW;max-width:1000px;max-height:650px;"></canvas>
    <canvas id="myChartProducts2025" style="width:100vW;max-width:1000px;max-height:650px;"></canvas>
    <canvas id="myChartProducts2026" style="width:100vW;max-width:1000px;max-height:650px;"></canvas>
</main>
<script>
    const months = ["January", "February",  "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const subtotals2025 = <?php echo json_encode($subtotals2025); ?>;
    const subtotals2026 = <?php echo json_encode($subtotals2026); ?>;
    const products2025 = <?php echo json_encode($products2025); ?>;
    const totalRevenue2025 = <?php echo json_encode($totalRevenue2025); ?>;
    const products2026 = <?php echo json_encode($products2026); ?>;
    const totalRevenue2026 = <?php echo json_encode($totalRevenue2026); ?>;

    const ctx2025 = document.getElementById('myChart2025');
    const ctx2026 = document.getElementById('myChart2026');
    const ctxProducts2025 = document.getElementById('myChartProducts2025');
    const ctxProducts2026 = document.getElementById('myChartProducts2026');

    const barColorsProducts = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145",
        "#add10eff",
        "#7a0492ff",
        "#ca3a93ff",
        "#f14415ff",
        "#f1e537ff"
    ];

    new Chart(ctx2025, {
        type: "bar",
        data: {
            labels: months,
            datasets: [{
                backgroundColor: "blue",
                data: subtotals2025
            }]
        },
        options: {
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: "monthly income 2025",
                    font: { size: 16 },
                    color: "black"
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: "black"
                    },
                    grid: {
                        color: "rgba(0,0,0,0.1)"
                    }
                },
                y: {
                    ticks: {
                        color: "black"
                    },
                    grid: {
                        color: "rgba(0,0,0,0.1)"
                    }
                }
            }
        }
    });

    new Chart(ctx2026, {
        type: "bar",
        data: {
            labels: months,
            datasets: [{
                backgroundColor: "orange",
                data: subtotals2026
            }]
        },
        options: {
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: "monthly income 2026",
                    font: { size: 16 },
                    color: "black"
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: "black"
                    },
                    grid: {
                        color: "rgba(0,0,0,0.1)"
                    }
                },
                y: {
                    ticks: {
                        color: "black"
                    },
                    grid: {
                        color: "rgba(0,0,0,0.1)"
                    }
                }
            }
        }
    });

    new Chart(ctxProducts2025, {
        type: "pie",
        data: {
            labels: products2025,
            datasets: [{
            backgroundColor: barColorsProducts,
            data: totalRevenue2025
            }]
        },
        options: {
            plugins: {
            legend: {display: false},
            title: {
                display: true,
                text: "Top 10 income products 2025",
                font: {size: 16},
                color: "black"
            }
            }
        }
    });

    new Chart(ctxProducts2026, {
        type: "pie",
        data: {
            labels: products2026,
            datasets: [{
            backgroundColor: barColorsProducts,
            data: totalRevenue2026
            }]
        },
        options: {
            plugins: {
            legend: {display: false},
            title: {
                display: true,
                text: "Top 10 income products 2026",
                font: {size: 16},
                color: "black"
            }
            }
        }
    });

</script>

<?php

require($backend.'footer.php');

?>