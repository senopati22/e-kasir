<style>
#chartdiv {
  width: 100%;
  height: 500px;
}
</style>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
</div>

<?php
$periksa = $this->db->query("SELECT * from barang where jumlah <= 3")->result();
foreach($periksa as $prk)
{
?>
<div style='padding:10px; text-align: center;' class='alert alert-warning'>
    <span class='fas fa-exclamation-triangle'></span> Stok <a style='color:red; text-decoration: none; text-transform: uppercase; font-weight: bold;'><?= $prk->nama ?></a> yang tersisa sudah kurang dari 3. Silahkan pesan lagi! <span class='fas fa-exclamation-triangle'></span>
</div>
<?php
}
?>

<!-- Content Row -->
<div class="row">

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <?php
            $date = date("d-m-Y");
            $bl = date('m');
            $th = date('Y');
            function formatAngka($angka)
            {
                $hasil = number_format($angka, 0, '.', '.');
                return $hasil;
            }
            ?>
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
            Total pendapatan pada bulan <br> <?= indonesian_date($date, 'F Y') ?>
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                  $qq = $this->db->query("SELECT SUM(laba) as jumlah from barang_laku where month(tanggal) = '$bl'")->result();
                  foreach($qq as $qt)
                  {
                      echo "Rp. ".formatAngka($qt->jumlah);
                  }
              ?>
            </div>
          </div>
          <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Total pendapatan pada tahun <br> <?= indonesian_date($date, 'Y') ?>
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                $qq = $this->db->query("SELECT SUM(laba) as jumlah from barang_laku where year(tanggal) = '$th'")->result();
                foreach($qq as $qw)
                {
                    echo "Rp. ".formatAngka($qw->jumlah);
                }
              ?>
            </div>
          </div>
          <div class="col-auto">
              <i class="fa fa-dollar-sign fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Jumlah data barang <br> <?= $this->session->userdata('site_name') ?>
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                $qe = $this->db->query("SELECT SUM(jumlah) as jumlah from barang")->result();
                foreach($qe as $qr)
                {
                    echo formatAngka($qr->jumlah);
                }
              ?>
            </div>
          </div>
          <div class="col-auto">
              <i class="fas fa-box fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Earnings (Monthly) Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
              Jumlah data supplier <br> <?= $this->session->userdata('site_name') ?>
            </div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              <?php
                $qt = $this->db->query("SELECT COUNT(namasp) as jumlah from supplier")->result();
                foreach($qt as $qy)
                {
                    echo formatAngka($qy->jumlah);
                }
              ?>
            </div>
          </div>
          <div class="col-auto">
              <i class="fas fa-user-tie fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- ======== GRAFIK ========== -->

<div class="row">
  <div class="col-lg-12">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <?php
          $min = date('Y') - 4;
          $dt = date('Y');
        ?>
        <h6 class="m-0 font-weight-bold text-success pull-left"><i class="fas fa-chart-area"></i> Total pendapatan dari tahun <?= $min ?> sampai tahun <?= $dt ?>.</h6>
        <h6 class="m-0 text-primary pull-right">
          Rp.
          <?php
            $uy = $this->db->query("SELECT SUM(laba) AS jumlah FROM barang_laku where year(tanggal) between '$min' and '$dt'")->result();
            foreach($uy as $qe)
            {
              echo "<b>".formatAngka($qe->jumlah)." ,-</b>";
            }
          ?>
        </h6>
      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div id="chartdiv"></div>
      </div>
    </div>
  </div>
</div>


<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.XYChart);

chart.data = [
  <?php
    $qr = $this->db->query("SELECT SUM(laba) AS jumlah, year(tanggal) as tahun FROM barang_laku where year(tanggal) between '$min' and '$dt' GROUP BY YEAR(tanggal)")->result();
    foreach ($qr as $key)
    {
      $jum = $key->jumlah;
      $tanggal = $key->tahun;
      if($jum == NULL)
      {
          $jum = 0;
      }

      $gr = '{
      "tahun": "'.$tanggal.'",
      "pendapatan": '.$jum.',
      "lineColor": chart.colors.next()
      },';

      echo $gr;
    }
  ?>
];

// Set input format for the dates
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.ticks.template.disabled = true;
categoryAxis.renderer.line.opacity = 0;
categoryAxis.renderer.grid.template.disabled = true;
categoryAxis.renderer.minGridDistance = 40;
categoryAxis.dataFields.category = "tahun";
categoryAxis.startLocation = 0.4;
categoryAxis.endLocation = 0.6;


var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.tooltip.disabled = true;
valueAxis.renderer.line.opacity = 0;
valueAxis.renderer.ticks.template.disabled = true;
valueAxis.min = 0;

var lineSeries = chart.series.push(new am4charts.LineSeries());
lineSeries.dataFields.categoryX = "tahun";
lineSeries.dataFields.valueY = "pendapatan";
lineSeries.tooltipText = "Pendapatan: Rp. {valueY.value}";
lineSeries.fillOpacity = 0.5;
lineSeries.strokeWidth = 3;
lineSeries.propertyFields.stroke = "lineColor";
lineSeries.propertyFields.fill = "lineColor";

var bullet = lineSeries.bullets.push(new am4charts.CircleBullet());
bullet.circle.radius = 6;
bullet.circle.fill = am4core.color("#fff");
bullet.circle.strokeWidth = 3;

chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "panX";
chart.cursor.lineX.opacity = 0;
chart.cursor.lineY.opacity = 0;

// chart.scrollbarX = new am4core.Scrollbar();
// chart.scrollbarX.parent = chart.bottomAxesContainer;

}); // end am4core.ready()
</script>
