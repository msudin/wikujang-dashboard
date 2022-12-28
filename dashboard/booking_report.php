<?php
include_once('../helper/import.php');
$thisPage = "booking_history";
startSession();


if(isset($_GET['month'])){
  $selected_month = $_GET['month']; 
  $selected_year = $_GET['year']; 
} else {
  $selected_month = date('m'); 
  $selected_year = date('Y');
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Rekap</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include_once "nav_header.php"; ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Rekap
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li>Booking</li>
        <li class="active">Rekap</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Table Info -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box box-body">
              <div class="col-md-12">
                  <!-- Form Goup -->
                  <div class="form-group">
                      <!-- /.input group -->
                      <form action="" method="GET">
                          <div class="box-body table-responsive no-padding">
                              <table class="table table-hover">
                                  <tr>
                                      <th style="width: 60px">Bulan</th>
                                      <th style="width: 30px">Tahun</th>
                                      <th style="width: 2px"></th>
                                  </tr>
                                  <tr>
                                      <td>
                                          <div class="input-group">
                                              <div class="input-group-addon">
                                                  <i class="fa fa-calendar"></i>
                                              </div>
                                              <select class="form-control" style="width: 100%;"
                                                  name="month" required>
                                                  <option value="<?php echo $selected_month; ?>">
                                                      <?php echo $bulan[$selected_month];?></option>
                                                  <option value="01">Januari</option>
                                                  <option value="02">Februari</option>
                                                  <option value="03">Maret</option>
                                                  <option value="04">April</option>
                                                  <option value="05">Mei</option>
                                                  <option value="06">Juni</option>
                                                  <option value="07">Juli</option>
                                                  <option value="08">Agustus</option>
                                                  <option value="09">September</option>
                                                  <option value="10">Oktober</option>
                                                  <option value="11">November</option>
                                                  <option value="12">Desember</option>
                                              </select>
                                          </div>
                                      </td>
                                      <td>
                                          <div class="input-group">
                                              <div class="input-group-addon">
                                                  <i class="fa fa-calendar"></i>
                                              </div>
                                              <select class="form-control" style="width: 100%;"
                                                  name="year" required>
                                                  <option value="<?php echo $selected_year; ?>">
                                                      <?php echo $selected_year; ?></option>
                                                  <?php 
                                                    for ($thn = date("Y")-5; $thn <= date("Y")+1; $thn++) {
                                                      echo"<option value='$thn'>$thn</option>";
                                                    }
                                                  ?>
                                              </select>
                                          </div>
                                      </td>
                                      <td style="width: 10%;">
                                          <button type="submit" class="btn btn-block btn-primary">
                                              <span></span> Terapkan
                                      </td>
                                  <tr>
                              </table>
                          </div>
                      </form>
                      <!-- /.div row -->
                  </div>
                  <!-- /from group -->
              </div>
                <!-- /.error-content -->
            </div>
          </div>             
          <div class="box">
            <div class="box box-body">
              <!-- Ads Banner -->
              <?php
              if (isset($_GET['success'])) {
                  if($_GET['success'] == "add"){
                      echo '<div class="box-body">
                              <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i> Berhasil !</h4>Tambah Iklan
                              </div>
                            </div>';
                  } else if($_GET['success'] == "edit"){
                      echo '<div class="box-body">
                              <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-check"></i> Berhasil !</h4> Ubah Iklan
                              </div>
                            </div>';
                  } else if($_GET['success'] == "delete"){
                      echo '<div class="box-body"><div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Berhasil !</h4>
                              Iklan telah dihapus 
                            </div></div>';
                  } else if ($_GET['success'] == "invalid") {
                    echo '<div class="box-body"><div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h4><i class="icon fa fa-check"></i> Gagal !</h4>
                            Terjadi kesalahan dalam memproses data
                          </div></div>';
                  }
              } ?>
            <!-- Table List -->
            <div class="box-body">
              <div class="box-body table-responsive no-padding">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Warung</th>
                    <th>Total Booking</th>
                    <th>Menunggu Konfirmasi Warung</th>
                    <th>Disetujui</th>
                    <th>Menunggu Pembayaran</th>
                    <th>Dibayar</th>
                    <th>Pembayaran Expired</th>
                    <th>Ditolak</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0; 
                    $dataList = getBookingSummary($selected_year.'-'.$selected_month);
                    foreach($dataList as $data) {
                      $no++; 
                    ?>
                  <tr>
                    <td><?=$no; ?></td>
                    <td><?=$data->warungId?></td>
                    <td><?=$data->warungName?></td>
                    <td><?php echo $data->totalBooking; ?></td>
                    <td><?=$data->totalWaiting?></td>
                    <td><?=$data->totalApproved?></td>
                    <td><?=$data->totalPending?></td>
                    <td><?=$data->totalPaid?></td>
                    <td><?=$data->totalExpired?></td>
                    <td><?=$data->totalRejected?></td>
                  </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Warung</th>
                    <th>Total Booking</th>
                    <th>Menunggu Konfirmasi Warung</th>
                    <th>Disetujui</th>
                    <th>Menunggu Pembayaran</th>
                    <th>Dibayar</th>
                    <th>Pembayaran Expired</th>
                    <th>Ditolak</th>
                  </tr>
                  </tfoot>
                </table>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- footer area -->
  <?php include_once "nav_footer.php"; ?>
  <!-- ./footer -->
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
