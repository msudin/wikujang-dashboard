<?php
$thisPage = "Data Transaksi All";
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
  session_destroy();	
  $login_redirect_url = "../index.php";
  echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

  include '../dbcon/config.php';
  include '../utils/lib.php';

  $user_id = $_SESSION['user_id'];
  $username = mysqli_query($koneksi, "select * from admin where id_admin='$user_id'");
  $dataid = mysqli_fetch_array($username);

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SI-SPP | Data Pembayaran</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php
    include "header_admin.php";
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pembayaran
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pembayaran</a></li>
        <li class="active">Data Pembayaran</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box box-body">
              <?php
              if(isset($_GET['message'])){
                  if($_GET['message']=="add_success"){
                      echo '<div class="box-body"><div class="alert alert-success alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <h4><i class="icon fa fa-check"></i> Alert !</h4>
                            Berhasil Menambahkan Siswa Baru. 
                            </div></div>';
                  }elseif($_GET['message']=="edit_success"){
                      echo '<div class="box-body"><div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Alert !</h4>
                            Edit Siswa Berhasil. 
                            </div></div>';
                  } elseif($_GET['message']=="delete_success"){
                      echo '<div class="box-body"><div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Alert !</h4>
                            Hapus Pembayaran Berhasil. 
                            </div></div>';
                  }
                  elseif($_GET['message']=="print_success"){
                    echo '<div class="box-body"><div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h4><i class="icon fa fa-check"></i> Alert !</h4>
                          Cetak Pembayaran Berhasil. 
                          </div></div>';
                }
                } ?>


            <div class="box-body">
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="3px">No</th>
                  <th width="120px">ID PB</th>
                  <th width="90px">NIS</th>
                  <th width="200px">Nama Siswa</th>
                  <th width="90px"> Kelas</th>
                  <th width="120px">Bulan</th>
                  <th width="90px">Nominal</th>
                  <th width="140px">Tgl PB</th>
                  <th width="5px">Ket</th>
                  <th width="120px" class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 0; 
                $data_transaksi = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis ORDER BY id_bayar DESC limit 500"); 
                while($dt=mysqli_fetch_array($data_transaksi)){
                  $no++; 
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $dt['id_bayar']; ?></td>
                  <td><?php echo $dt['nis_bayar']; ?></td>
                  <td><?php echo $dt['nama_siswa']; ?> </td>
                  <td><?php echo $dt['kls_siswa']; ?></td>
                  <td><?php echo convertinfaq($dt['bulan_bayar']); ?></td>
                  <!-- <td> <?php //  echo $dt['bulan_bayar']; ?></td> -->
                  <td><?php echo rupiah0($dt['nominal_bayar']); ?></td>
                  <td><?php echo substr($dt['tgl_bayar'], 0, 10); ?></td>
                  <td><span class="badge bg-red">LUNAS</span></td>
                  <td align="center">
                    <a href="#" class="delete-modal btn btn-danger btn-sm" onclick="confirm_modal('transaksi_delete_proses.php?modal_id=<?php echo $dt['id_bayar']; ?>');">
                      <i class="glyphicon glyphicon-trash"></i>
                    </a>
                    <!-- cetak popup -->
                    <a href="#" class="edit_modal btn btn-success btn-sm"  id_bayar='<?php echo $dt['id_bayar']; ?>' >
                      <i class="glyphicon glyphicon-print"></i>
                    </a>
                </tr>
                <?php } ?>
                </tbody>
               <tfoot>
                <tr>
                  <th width="3px">No</th>
                  <th width="120px">ID PB</th>
                  <th width="90px">NIS</th>
                  <th width="200px">Nama Siswa</th>
                  <th width="90px">Bulan</th>
                  <th width="120px">Bulan</th>
                  <th width="90px">Nominal</th>
                  <th width="140px">Tgl PB</th>
                  <th width="5px">Ket</th>
                  <th width="120px" class="text-center">Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="box">
            <div class="box box-body"> 
            <div class="col-md-12">
            <!-- Form Goup -->
            <form method="POST" action="transaksi_data_show_all.php" target="_blank">
              <div class="form-group">
                  <!-- /.input group -->
                <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                  <tr>
                    <th width="95%"> Limit Data Maksimum : 500</th>
                    <th width="5%">                   
                          <button type="submit" class="btn btn-block btn-success" name="cetak" value="cetak">
                          <span></span>Show All
                        </th>
                  <tr>
                </table>
                </div>
                  <!-- /.div row -->
              </div>
              </form>              
          </div>
        <!-- /.error-content -->     
      </div>
      </div>
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- footer area -->
  <?php 
      include "footer.php"; 
    ?>
  <!-- ./footer -->
<!-- ./wrapper -->

<!-- Modal Popup untuk delete--> 
<div class="modal fade" id="modal_delete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Apakah Anda Yakin Ingin menghapus Transaksi Pembayaran ini ?</h4>
      </div>  
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="delete_link">Hapus</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Popup untuk Print--> 
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
<script type="text/javascript">
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

<!-- Javascript untuk popup modal Print--> 
<script type="text/javascript">
   $(".edit_modal").click(function() {
      var m = $(this).attr("id_bayar");
		   $.ajax({
    			   url: "transaksi_data_modal_print.php",
    			   type: "GET",
    			   data : {id_bayar: m,},
    			   success: function (ajaxData){
      			   $("#ModalEdit").html(ajaxData);
      			   $("#ModalEdit").modal('show',{backdrop: 'true'});
      		   }
    		   });
        });
</script>

<!-- //Javascript untuk popup modal Delete--> -->
<script type="text/javascript"> 
    function confirm_modal(delete_url)
    {
      $('#modal_delete').modal('show', {backdrop: 'static',keyboard: 'false'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>
</body>
</html>
