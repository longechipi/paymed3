<?php 
include('../layouts/header.php');
require('../conf/conexion.php');
?>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <?php include("../layouts/menu.php"); ?>
            <div class="layout-page">
                <?php include("../layouts/navbar.php"); ?>
                <div class="content-wrapper">
                    <div class="container-fluid flex-grow-1 container-p-y">
                        <div class="row">    
<div class="col-lg-12 mb-12 order-0">
    <div class="card">
        <div class="d-flex align-items-end row">
            <div class="col-12">
                <div class="card-body">
                    <h5 class="card-title text-primary">Estadisticas</h5>
                    <div id="totalRevenueChart" class="px-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
$a = "SELECT MONTH(fechacita) AS mes, COUNT(MONTH(fechacita)) AS total 
FROM citas 
WHERE YEAR(fechacita) = YEAR(NOW())
AND idmed = $idmedico
GROUP BY MONTH(fechacita) 
ORDER BY mes ASC";
$ares=$mysqli->query($a);
  while ($row = $ares->fetch_assoc()) {
    $mes1 = $row['mes'];
    $total = $row['total'];
    $resultados[$mes1] = $total;
  }
  $meses1 = range(1, 12);
  $claves = array_keys($resultados);
  $resultadosCompletos = array_fill(0, 12, 0);

  foreach ($claves as $clave) {
    $resultadosCompletos[$clave] = $resultados[$clave];
  }
  $resultadosCompletos = array_slice($resultadosCompletos, 1);

  $mes = array("'Enero'", "'Febrero'", "'Marzo'", "'Abril'", "'Mayo'", "'Junio'", "'Julio'", "'Agosto'", "'Septiembre'", "'Octtubre'", "'Noviembre'", "'Diciembre'");
  $meses = implode(",", $mes);
?>

</div>
                    </div>
                    <?php include('../layouts/footer.php')?>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
    </div>
    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<?php include('../layouts/script.php')?>

<script>
    'use strict';

    (function() {
      let cardColor, headingColor, axisColor, shadeColor, borderColor;

      cardColor = config.colors.white;
      headingColor = config.colors.headingColor;
      axisColor = config.colors.axisColor;
      borderColor = config.colors.borderColor;

      // Total Revenue Report Chart - Bar Chart
      // --------------------------------------------------------------------
      const totalRevenueChartEl = document.querySelector('#totalRevenueChart'),
        totalRevenueChartOptions = {
          series: [{
            name: '<?php echo date('Y'); ?>',
            data: <?php echo json_encode($resultadosCompletos); ?>
          }],
          chart: {
            height: 300,
            type: 'bar',
            toolbar: {
              show: false
            }
          },
          plotOptions: {
            bar: {
              columnWidth: '30%',
              borderRadius: 8,
              startingShape: 'rounded',
            }
          },
          colors: [config.colors.primary],
          dataLabels: {
            enabled: false
          },
          grid: {
            borderColor: borderColor,
            padding: {
              top: 0,
              bottom: -8,
              left: 20,
              right: 20
            }
          },
          xaxis: {
            categories: [<?php print_r($meses); ?>],
            labels: {
              style: {
                fontSize: '15px',
                colors: axisColor
              }
            },
          },
          yaxis: {
            labels: {
              style: {
                fontSize: '15px',
                colors: axisColor
              }
            }
          },

        };
      const totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
      totalRevenueChart.render();
    })();
  </script>
</body>
</html>