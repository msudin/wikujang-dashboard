<?php
$thisPage = "Input Siswa";
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
  session_destroy();	
  $login_redirect_url = "../index.php";
  echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}
  include 'lib.php'; 
  include '../dbcon/config.php';

  $user_id = $_SESSION['user_id'];
  $username = mysqli_query($koneksi, "select * from admin where id_admin='$user_id'");
  $dataid = mysqli_fetch_array($username);

  // Get Value Data
  $get_id = $_GET['id_nis'];
  $sql = "SELECT * FROM tb_siswa WHERE id_nis='$get_id'";
  $qry = mysqli_query($koneksi, $sql); 
  $ds = mysqli_fetch_array($qry); 
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SI-SPP | Input Siswa</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css">
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
       Form Edit Siswa
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Edit Siswa</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
          <!-- /.box-header -->
          <!-- form start -->
            <div class=" box box-body">
              <form class="form-horizontal" action="siswa_edit_proses.php" method="POST" enctype="multipart/form-data">
              <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <font color="black"><h4> Informasi !</h4>
                <i>* Perubahan dan penentuan SPP hanya dapat dilakukan di menu SISWA - SPP Siswa. </i> 
                </font>
              </div>
              <input type="hidden" name="nis" value="<?php echo $ds['id_nis']; ?>" />
              <div class="form-group">
                <label class="col-sm-2 control-label" >ID Siswa</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" value="<?php echo $ds['id_nis']; ?>" readonly >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">Nama</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="nama" value="<?php echo $ds['nama_siswa']; ?>" required>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">Jenis Kelamin</label>
                <div class="col-sm-5">
                  <select class="form-control" style="width: 100%;" name="jk" required>
                  <option selected="selected" value="<?php echo $ds['jk_siswa']; ?>"><?php echo $ds['jk_siswa']; ?></option>
                    <option value="L">L</option>
                    <option value="P">P</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">Kelas</label>
                <div class="col-sm-5">
                  <select class="form-control select2" name="kelas" required style="width: 100%;">
                  <option selected="selected" value="<?php echo $ds['kls_siswa']; ?>"><?php echo $ds['kls_siswa']; ?></option>
                 <?php 
                  $jmlKelas = mysqli_query($koneksi,"SELECT * FROM tb_kelas"); 
                  while($kls=mysqli_fetch_array($jmlKelas))
                  {?>
                    <option value="<?php echo $kls['nama_kelas']; ?>"><?php echo $kls['nama_kelas']; ?></option>
                  <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary" name="simpan_edit">
                    <span class="glyphicon glyphicon-plus"></span> Simpan
                  </button>
                    <a href="siswa_data.php" class="btn btn-danger">
                      <i class="glyphicon glyphicon-remove"></i> Kembali
                    </a>
                </div>
              </div>
            </form>
          </div>
          <!-- /.Form -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
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
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Select2 -->
<script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>

<script>
    function proses() {
    var x = document.getElementById("mySelect").value ;
    if(x !="manual") {
      document.getElementById('ifYes').style.display = 'none';
    
    }else if(x=="manual")
    document.getElementById('ifYes').style.display = 'block';
    }
</script>

<!-- Format Rupiah -->
<script type="text/javascript">
    function inputAngka(input) {
    return [].map.call(input, function(x) {
    return x;
    }).reverse().join('');
    }
    function formatTitik(number) {
    return number.split('.').join('');
    }
    function pisahdgnTitik(input) {
    var value = input.value,
    plain = formatTitik(value),
    reversed = inputAngka(plain),
    isiTitik = reversed.match(/.{1,3}/g).join('.'),
    normal = inputAngka(isiTitik);
    input.value = normal;
}
</script>

</body>
</html>
