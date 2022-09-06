<?php
include 'siswa_uc.php';
$thisPage = "Data Siswa";

validateSession();
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
  <link rel="stylesheet" href="../dist/css/loader.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini" onload="myFunction()">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
<div class="wrapper">

<?php
    include "header_admin.php";
  ?>

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Siswa
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Siswa</a></li>
        <li class="active">Data Siswa</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
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
                            Hapus Siswa Berhasil. 
                            </div></div>';
                  }
                } ?>
            <div class="form-group">
                    <a href="siswa_input.php" class="btn btn-success">
                      <i class="glyphicon glyphicon-plus"></i> Tambah Siswa
                    </a>
                </div>
            <div class="box-body">
            <div class="box-body table-responsive no-padding">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="13%">NIS</th>
                  <th width="50%">Nama</th>
                  <th width="5%">L/P</th>
                  <th width="12%">Kelas</th>
                  <th width="15%" class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php
                
               
                $no = 0; 
                $data_siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa ORDER BY id_nis ASC"); 
                while($ds=mysqli_fetch_array($data_siswa)){
                  $no++; 
             
                ?>
              
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo $ds['id_nis']; ?></td>
                  <td><?php echo $ds['nama_siswa']; ?></td>
                  <td><?php echo $ds['jk_siswa']; ?></td>
                  <td><?php echo $ds['kls_siswa']; ?></td>
                  <td align="center">
                    <a href="siswa_edit.php?id_nis=<?php echo $ds['id_nis']; ?>" class="edit_modal btn btn-warning btn-sm">
                      <i class="glyphicon glyphicon-pencil"></i>
                    </a>
                    <a href="#" class="delete-modal btn btn-danger btn-sm" onclick="confirm_modal('siswa_uc.php?modal_id=<?php echo $ds['id_nis']; ?>&uc_type=delete');">
                      <i class="glyphicon glyphicon-trash"></i>
                    </a>
                  </td>
                </tr>
                
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th width="5%">No</th>
                  <th width="13%">NIS</th>
                  <th width="50%">Nama</th>
                  <th width="5%">L/P</th>
                  <th width="12%">Kelas</th>
                  <th width="15%" class="text-center">Aksi</th>
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
        <h4 class="modal-title" style="text-align:center;">Apakah Anda Yakin Ingin menghapus Siswa Ini ?</h4>
      </div>  
      <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
        <a href="#" class="btn btn-danger" id="delete_link">Hapus</a>
        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
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

<script>
  // Loading Page
  var myVar;
  function myFunction() {
      myVar = setTimeout(showPage, 1);

  }
  function showPage() {
      document.getElementById("loader").style.display = "none";
      document.getElementById("myDiv").style.display = "block";
  }
</script>


<!-- Javascript untuk popup modal Delete--> 
<script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modal_delete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>

<script>            
  // Loading Page
  var myVar;
  function myFunction() {
      myVar = setTimeout(showPage, 5);
  }
  function showPage() {
      document.getElementById("loader").style.display = "none";
      document.getElementById("myDiv").style.display = "block";
  }
</script>
</body>
</html>
