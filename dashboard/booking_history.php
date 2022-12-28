<?php
include_once('../helper/import.php');
$thisPage = "booking_history";
startSession();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Booking</title>
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
        Riwayat
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li>Booking</li>
        <li class="active">Riwayat</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Table Info -->
      <div class="row">
        <div class="col-md-4 col-sm-8 col-xs-12">
            <div class="info-box">
                <a href="">
                <span class="info-box-icon bg-green"><i class="ion ion-cash"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Pendapatan Booking</i></span>
                    <span class="info-box-number">
                        <?php 
                            $trans_paid = getBookingRevenue(NULL, "PAID");
                            echo rupiah0($trans_paid->totalAmount); 
                        ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-8 col-xs-12">
            <div class="info-box">
                <a href="">
                <span class="info-box-icon bg-orange"><i class="ion ion-android-sync"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Proses</i></span>
                    <span class="info-box-number"> 
                        <?=count(getBookings(NULL, 'waiting_approval'))?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-8 col-xs-12">
            <div class="info-box">
                <a href="">
                    <span class="info-box-icon bg-green"><i class="ion ion-checkmark-circled"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Terbayar</span>
                    <span class="info-box-number">
                      <?php 
                          $trans_paid = getBookingRevenue(NULL, "PAID");
                          echo $trans_paid->totalData ?? 0; 
                      ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-8 col-xs-12">
            <div class="info-box">
                <a href="">
                <span class="info-box-icon bg-blue"><i class="ion ion-android-sync"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Belum Bayar</i></span>
                    <span class="info-box-number"> 
                        <?php 
                          $trans_pending = getBookingRevenue(NULL, "PENDING");
                          echo $trans_pending->totalData ?? 0; 
                      ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-8 col-xs-12">
            <div class="info-box">
                <a href="">
                    <span class="info-box-icon bg-red"><i class="ion ion-close-circled"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Expired</span>
                    <span class="info-box-number">
                      <?php 
                          $trans_exp = getBookingRevenue(NULL, "EXPIRED");
                          echo $trans_exp->totalData ?? 0; 
                      ?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-md-4 col-sm-8 col-xs-12">
            <div class="info-box">
                <a href="">
                    <span class="info-box-icon bg-black"><i class="ion ion-close-circled"></i></span>
                </a>
                <div class="info-box-content">
                    <span class="info-box-text">Rejected/Ditolak</span>
                    <span class="info-box-number">
                      <?=count(getBookings(NULL, 'rejected'))?>
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
      </div> <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
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
                    <th>No. Referensi</th>
                    <th>User</th>
                    <th>Warung</th>
                    <th>DP</th>
                    <th>Services Fee</th>
                    <th>Admin Fee</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Tgl Bayar</th>
                    <th>Metode Pembayaran</th>
                    <th>Dibuat</th>
                    <!-- <th class="text-center">Aksi</th> -->
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 0; 
                    $dataList = getBookings();
                    foreach($dataList as $data) {
                      $no++; 
                    ?>
                  <tr>
                    <td><?=$no; ?></td>
                    <td><?=$data->id?></td>
                    <td><?=$data->user->fullName?></td>
                    <td><?php echo $data->warung->name; ?>
                    </td>
                    <td><?=rupiah0($data->dpAmount)?></td>
                    <td><?=rupiah0($data->invoice->fees)?></td>
                    <td><?=rupiah0($data->invoice->amount)?></td>
                    <td><?=bookingStatusColorName($data->status)?></td>
                    <td><?=bookingPaymentColorName($data->invoice->status)?></td>
                    <td><?=dateUtcToLocal($data->invoice->paymentDate, "Y-m-d H:i:s")?></td>
                    <td>
                      <?php 
                          if (!empty($data->invoice->method)) {
                            echo $data->invoice->channel;
                            echo " (".$data->invoice->method.")";
                          } 
                      ?>
                    </td>
                    <td><?=$data->createdAt?></td>
                    <!-- <td align = "center">
                      <a href="#" class="edit_modal btn btn-warning btn-sm" id='<?php echo serialize(['id'=>$data->id, 'name'=>$data->name]); ?>'>
                        <i class="glyphicon glyphicon-pencil"></i>
                      </a>
                    </td> -->
                  </tr>
                  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>No. Referensi</th>
                    <th>Warung</th>
                    <th>Nama</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Tgl Bayar</th>
                    <th>Metode Pembayaran</th>
                    <th>Dibuat</th>
                    <!-- <th class="text-center">Aksi</th> -->
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

<!-- Modal Popup untuk Edit--> 
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk delete--> 
<div class="modal fade" id="modal_delete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Hapus Data ?</h4>
      </div>  
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="delete_link">Hapus</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Batal</button>
      </div>
    </div>
  </div>
</div>

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
<script type="text/javascript">
   $(".edit_modal").click(function() {
      var m = $(this).attr("id");
		   $.ajax({
    			   url: "ads_edit.php",
    			   type: "GET",
    			   data : {
              modal_id: m
            },
    			   success: function (ajaxData){
      			   $("#ModalEdit").html(ajaxData);
      			   $("#ModalEdit").modal('show',{backdrop: 'true'});
      		   }
    		   });
        });
</script>
<script type="text/javascript">
    function confirm_modal(delete_url){
      $('#modal_delete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>
</body>
</html>
