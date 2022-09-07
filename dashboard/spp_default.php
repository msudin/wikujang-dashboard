<?php
include 'spp_uc.php';
include '../utils/lib.php';
$thisPage = "Nominal SPP";

validateSession();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SI-SPP | SET SPP</title>
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
        Data SPP
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">SPP</a></li>
        <li class="active">Set Nominal</li>
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
                            Berhasil Menambahkan Nominal SPP Baru. 
                            </div></div>';
                  }elseif($_GET['message']=="add_failed"){
                      echo '<div class="box-body"><div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4> Info !</h4>
                            Nominal yang dimasukkan harus berupa angka ! 
                            </div></div>';
                  } elseif($_GET['message']=="delete_success"){
                      echo '<div class="box-body"><div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Alert !</h4>
                            Hapus Nominal SPP Berhasil. 
                            </div></div>';
                  }
                } ?>
            <div class="form-group">
                    <a href="#" class="btn btn-success" data-target="#ModalAdd" data-toggle="modal">
                      <i class="glyphicon glyphicon-plus"></i> Tambah SPP
                    </a>  
              </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th width="10%">No</th>
                  <th width="80%" >Nominal SPP</th>
                  <th width="15%" class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $no = 0; 
                $dataList = getDataSPP();
                foreach($dataList as $kls){
                  $no++; 
                ?>
                <tr>
                  <td><?php echo $no; ?></td>
                  <td><?php echo rupiah1($kls['nominal_spp']); ?></td>
                  <td align="center">
                    <a href="#" class="delete-modal btn btn-danger btn-sm" onclick="confirm_modal('spp_uc.php?modal_id=<?php echo $kls['id_spp']; ?>&uc_type=delete');">
                      <i class="glyphicon glyphicon-trash"></i>
                    </a>
                  </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th width="10%">No</th>
                  <th width="80%" >Nominal SPP</th>
                  <th class="text-center" width="10%">Aksi</th>
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

<!-- Modal Popup untuk Add--> 
<div id="ModalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title" id="myModalLabel">Tambah Nominal SPP </h4>
        </div>
        <div class="modal-body">
          <form action="spp_uc.php" name="modal_popup" enctype="multipart/form-data" method="POST">
                <div class="form-group">
                  <label for="Modal Name">Nominal SPP</label>
                  <input type="hidden" name="uc_type" value="insert" />
                  <input type="text" onkeyup="pisahdgnTitik(this)" name="nominal_spp"  class="form-control" maxlength="11" required/>
                </div>
              <div class="modal-footer">
                  <button class="btn btn-success" type="submit">
                      Simpan
                  </button>
                  <button type="reset" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">
                    Cancel
                  </button>
              </div>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Popup untuk Edit--> 
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

</div>

<!-- Modal Popup untuk delete--> 
<div class="modal fade" id="modal_delete">
  <div class="modal-dialog">
    <div class="modal-content" style="margin-top:100px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="text-align:center;">Apakah Anda Yakin Ingin menghapus nominal SPP Ini ?</h4>
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

<!-- Javascript untuk popup modal Edit--> 
<script type="text/javascript">
   $(document).ready(function () {
   $(".edit_modal").click(function(e) {
      var m = $(this).attr("id");
		   $.ajax({
    			   url: "kelas_edit_modal.php",
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

<!-- Javascript untuk popup modal Delete--> 
<script type="text/javascript">
    function confirm_modal(delete_url)
    {
      $('#modal_delete').modal('show', {backdrop: 'static'});
      document.getElementById('delete_link').setAttribute('href' , delete_url);
    }
</script>

<!-- Format Rupiah Versi 1, tambahkan id="rupiah" pada input type -->
<script type="text/javascript">
		
		var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
 
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
 
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
	</script>

<!-- Format Rupiah Versi 2 -->
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
