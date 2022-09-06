<?php
$thisPage = "Transaksi Cari";
date_default_timezone_set('Asia/Jakarta');
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Tata Usaha'){
  session_destroy();	
  $login_redirect_url = "../index.php";
  echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

  include 'lib.php'; 
  include '../dbcon/config.php';

  $user_id = $_SESSION['user_id'];
  $username = mysqli_query($koneksi, "select * from admin where id_admin='$user_id'");
  $dataid = mysqli_fetch_array($username);

  //Get Data Siswa
  if($_GET['nis'] != null){
    $id_nis = $_GET['nis']; 
  }


  $sql = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_nis='$id_nis' "); 
  $ds = mysqli_fetch_array($sql); 

  if(mysqli_num_rows($sql)==0){
    $transcari_redirect_url = "transaksi_cari.php";
    echo "<script>alert('NIS tidak ditemukan !'); window.location = '$transcari_redirect_url'</script>";
  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SI-SPP | Data Kelas</title>
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
        Pembayaran SPP
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pembayaran</a></li>
        <li class="active">Transaksi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-4">
          <!-- Box -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Informasi Siswa</h3>
            </div>

            <?php
              if(isset($_GET['message'])){
                  if($_GET['message']=="already_exist"){
                      echo '<div class="box-body"><div class="alert alert-danger alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <h4><i class="icon fa fa-exclamation"></i> Alert !</h4>
                            Data Pembayaran SPP Sudah Ada, Silahkan Pilih Pembayaran di Bulan Lainnya !
                            </div></div>';
                  }
                } ?>
            <!-- /.box-header -->
            <form action="transaksi_simpan.php" method="POST">
              <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th style="width: 120px">NIS</th>
                  <th  style="width: 2px">:</th>
                  <th colspan='3'><input type="hidden" value="<?php echo $ds['id_nis']; ?>" name="id_nis"><?php echo $ds['id_nis']; ?></th>
                </tr>
                <tr>
                  <td>Nama</td>
                  <td>:</td>
                  <td colspan='3'><?php echo $ds['nama_siswa']; ?></td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td>:</td>
                  <td colspan='3'><?php echo $ds['jk_siswa']; ?></td>
                </tr>
                <tr>
                  <td>Kelas</td>
                  <td>:</td>
                  <td colspan='3'><input type="hidden" value="<?php echo $ds['kls_siswa']; ?>" name="kelas_siswa"><?php echo $ds['kls_siswa']; ?></td>
                </tr>
                <tr>
                  <td>Nominal SPP</td>
                  <td>:</td>
                  <td colspan='3'><input type="hidden" value="<?php echo $ds['nominal_spp']; ?>" name="nominal_spp" ><?php echo rupiah0($ds['nominal_spp']); ?></td>
                </tr>
                <tr>
                  <td>Keterangan</td>
                  <td>:</td>
                  <td colspan='3'><input type="hidden" value="<?php echo $ds['ket_siswa']; ?>" name="ket_siswa" ><?php echo $ds['ket_siswa']; ?></td>
                </tr>
                <tr >
                  <td>Pelunasan Bulan</td>
                  <td>:</td>
                  <td colspan='3'><select class="form-control" style="width: 100%;" name="bulan" required>
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
                  </select></td>
                </tr>
                <tr >
                  <td>Tahun</td>
                  <td>:</td>
                  <td colspan='3'><select class="form-control" style="width: 100%;" name="tahun" required>
                  <?php 
                    $thn_this = date("Y"); 
                    echo"<option value='$thn_this'>$thn_this</option>";
                    for ($thn=date("Y")-2; $thn <=date("Y")+2; $thn++){
                    echo"<option value='$thn'>$thn</option>"; }
                  $data = 'tgl';
                  ?>
                  </select></td>
                </tr>

                <tr>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-default ">Aksi</button>
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#" class="edit_modal" id='<?php echo $ds['id_nis']; ?>'>Cetak Multiple Bulan</a></li>
                      </ul>
                      </div>
                    </td>
                    <td></td>
                    <td>
                      <button type="submit" class="btn btn-primary" name="simpan">
                        <span class="glyphicon glyphicon-plus"></span> Simpan
                      </button>
                    </td>
                    <td><a href="transaksi_cari.php" class="btn btn-danger btn-md">
                      <i class="glyphicon glyphicon-remove"></i> Kembali
                    </a></td>
                </tr>
              </table>
              <?php
              $date_today = date("Y-m-d"); 
              $sql = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE tgl_bayar LIKE '%$date_today%'");
              if (mysqli_num_rows($sql) !=null){ 
                $date_trans = date("Ymd");
                $sql_trans = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE tgl_bayar LIKE '%$date_today%' ORDER BY id_bayar DESC LIMIT 1");
                $tr = mysqli_fetch_array($sql_trans);
                $gettrkode = substr($tr['id_bayar'], 0, 11); 
                $getDate = substr($tr['id_bayar'],8,5); 
                $trkodelast = $getDate + 1 ; 

                //--- Set Tr Kode ---//
                if($getDate < 9){
                  $datefinal = $gettrkode.$trkodelast;
                }elseif ($trkodelast > 999){
                  $gettrkode4 = substr($tr['id_bayar'], 0, 8); 
                  $datefinal = $gettrkode4.$trkodelast;
                }elseif ($trkodelast > 99){
                    $gettrkode3 = substr($tr['id_bayar'], 0, 9); 
                    $datefinal = $gettrkode3.$trkodelast;
                } elseif ($trkodelast > 9 ) {
                  $gettrkode2 = substr($tr['id_bayar'], 0, 10); 
                  $datefinal = $gettrkode2.$trkodelast;
                } 


                ?>
                <input type="hidden" value="<?php echo $datefinal ?>" name="id_trans">

                
               <?php } else { 
                $date_null = date("Ymd"); 
                $id_tr = $date_null."0001"; 
               ?>
              <input type="hidden" value="<?php echo $id_tr; ?>" name="id_trans">
            <?php }
              ?>
              <input type="hidden" value="<?php echo date("Y-m-d H:i:s"); ?>" name="tgl_trans">
              <input type="hidden" name="admin" value="<?php echo $dataid['adm_fullname']; ?>">
              <!-- /.Form Group -->
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
         <!-- box -->
        <div class="col-md-8">
          <div class="box">
            <div class="box-header success">
              <h3 class="box-title">Data Pembayaran SPP</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-hover">
                <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th style="width: 150px">Bulan</th>
                  <th style="width: 150px">No. Transaksi</th>
                  <th style="width: 120px">SPP</th>
                  <th>Tgl Pembayaran</th>
                  <th>Keterangan</th>
                  <th>Aksi</th  >
                </tr>
             </thead>
             <tbody>
               <?php
                $no = 0; 
                $kls_nis = $ds['kls_siswa']; 
                $data_pembayaran = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE nis_bayar='$id_nis' AND kls_bayar='$kls_nis' ORDER BY id_bayar Desc"); 
                while($ps=mysqli_fetch_array($data_pembayaran)){
                  $no++;
                
                  $bulan_bayar= $bulan[substr($ps['bulan_bayar'], 0,2)]." ".substr($ps['bulan_bayar'], 3,4);
                 
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $bulan_bayar; ?></td>
                  <td><?php echo $ps['id_bayar']; ?></td>
                  <td><?php echo rupiah0($ps['nominal_bayar']); ?></td>
                  <td><?php echo substr($ps['tgl_bayar'], 0, 10); ?></td>
                  <td><span class="badge bg-red">LUNAS</span></td>
                  <td>
                    <a href="../_report/cetak/faktur.php?id_trans=<?php echo $ps['id_bayar']; ?>" target="_blank" class="btn btn-success btn-sm">
                      <i class="glyphicon glyphicon-print"></i>
                    </a></td>
                </tr>
                <?php } ?>
             </tbody>
              </table>
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
  <?php 
      include "footer.php"; 
    ?>
  <!-- ./footer -->
<!-- ./wrapper -->

<!-- Modal Popup untuk Edit--> 
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


<!-- Javascript untuk popup modal Edit--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".edit_modal").click(function(e) {
      var m = $(this).attr("id");
		   $.ajax({
    			   url: "transaksi_cetak_getmultiple.php",
    			   type: "GET",
    			   data : {modal_id: m,},
    			   success: function (ajaxData){
      			   $("#ModalEdit").html(ajaxData);
      			   $("#ModalEdit").modal('show',{backdrop: 'true'});
      		   }
    		   });
        });
      });
</script>

</body>
</html>
