<?php
$thisPage = "Data Transaksi All";
date_default_timezone_set('Asia/Jakarta');
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
  session_destroy();	
  $login_redirect_url = "../../index.php";
  echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

  include '../utils/lib.php';
  include '../dbcon/config.php';

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
    <!-- daterange picker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/iCheck/all.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
    <link rel="stylesheet" href="../dist/css/loader.css">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<!-- Loading Page -->
<body class="hold-transition skin-blue sidebar-mini" onload="myFunction()" style="margin:0;">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
<!-- /Loading Page -->

        <div class="wrapper">

            <?php
        
          include "header_admin.php";
          if(isset($_GET['bulan'])){
            $bulan_value = $_GET['bulan']; 
            $tahun_value = $_GET['tahun']; 
            $kelas_value = $_GET['kelas']; 
            } else {
              $bulan_value = date('m'); 
              $kelas_value = "All"; 
              $tahun_value = date('Y');
            }
        ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Data Pembayaran (Belum Pelunasan)
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
                                    <div class="col-md-12">
                                        <!-- Form Goup -->
                                        <div class="form-group">
                                            <!-- /.input group -->
                                            <form action="" method="GET">
                                                <div class="box-body table-responsive no-padding">
                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th style="width: 20px">Bulan</td>
                                                            <th style="width: 20px">Tahun</td>
                                                            <th style="width: 20px">Kelas</td>
                                                            <th style="width: 30px">
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <select class="form-control" style="width: 100%;"
                                                                        name="bulan" required>
                                                                        <!-- <option value="<?php echo $bulan_value; ?>"><?php echo $bulan[$bulan_value];?></option> -->
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
                                                                        name="tahun" required>
                                                                        <option value="<?php echo $tahun_value; ?>">
                                                                            <?php echo $tahun_value; ?></option>
                                                                        <?php for ($thn=date("Y")-2; $thn <=date("Y")+1; $thn++){
                                                                echo"<option value='$thn'>$thn</option>";
                                                                }
                                                                ?>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <select class="form-control select2 "
                                                                        style="width: 100%;" name="kelas" required>
                                                                        <option value="<?php echo $kelas_value; ?>">
                                                                            <?php echo $kelas_value; ?></option>
                                                                        <option value="All">All </option>
                                                                        <?php 
                                                                    $jmlKelas = mysqli_query($koneksi,"SELECT * FROM tb_kelas"); 
                                                                    while($kls=mysqli_fetch_array($jmlKelas))
                                                                    {?>
                                                                        <option
                                                                            value="<?php echo $kls['nama_kelas']; ?>">
                                                                            <?php echo $kls['nama_kelas']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <button type="submit" class="btn btn-block btn-primary"
                                                                    name="pilih" value="pilih">
                                                                    <span></span> Pilih
                                                            </td>
                                                        <tr>
                                                    </table>
                                                </div>
                                            </form>
                                            <!-- /.div row -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /from group -->
                            </div>
                            <div class="box box-body">
                                <div class="box-body">
                                    <div class="box-body table-responsive no-padding">
                                        <table id="example1" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="3px">No</th>
                                                    <th width="120px">NIS</th>
                                                    <th width="300px">Nama Siswa</th>
                                                    <th width="100px">Kelas Siswa</th>
                                                    <th width="120px">Bulan</th>
                                                    <th width="90px">Nominal</th>
                                                    <th width="5px">Keterangan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                              $ti = 0;
                                              $tot_tung = 0;
                                              $no = 0; 

                                              if(isset($_GET['kelas'])){
                                                  if($_GET['kelas'] != 'All'){
                                                  $kelas_value = $_GET['kelas'];
                                                  $data_siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE kls_siswa='$kelas_value' "); 
                                                  } elseif($_GET['kelas'] == 'All'){
                                                    $data_siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa"); 
                                                  } 
                                                } else {
                                                $data_siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa"); 
                                                }
                
                                              while($ds=mysqli_fetch_array($data_siswa)){
                                                $no++; 
                                                $getnis= $ds['id_nis']; 

                                              if(isset($_GET['bulan'])){
                                                if($_GET['kelas'] == 'All'){
                                                    $get_bulan = $_GET['bulan']; 
                                                    $get_tahun = $_GET['tahun'];
                                                    $bulta = $get_tahun."-".$get_bulan;
                                                    $cekbayar = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE nis_bayar='$getnis' AND bulan_bayar='$bulta'");
                                                } elseif($_GET['kelas'] != 'All'){
                                                    $get_bulan = $_GET['bulan']; 
                                                    $get_tahun = $_GET['tahun'];
                                                    $bulta = $get_tahun."-".$get_bulan; 
                                                    $cekbayar = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE nis_bayar='$getnis' AND kls_bayar='$kelas_value' AND bulan_bayar='$bulta'");
                                                } 
                                             } else {
                                             $bulta = date('Y-m');
                                             $get_tahun = date('Y');
                                             $cekbayar = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran  WHERE nis_bayar='$getnis' AND bulan_bayar ='$bulta' ");
                                             }   
                                             
                                             $cekahir =  mysqli_fetch_array($cekbayar); 
                                              if(mysqli_num_rows($cekbayar) == 0 ){
                                                if($get_tahun == 2017 || $get_tahun == 2018 ){
                                                  $ti = "-"; 
                                                  $tot_tung = 0; 
                                                ?>
                                                <?php  
                                              } else {
                                                
                                                if(isset($_GET['kelas']) && $_GET['kelas'] != 'All'){
                                                $ti = $ti + 1; 
                                                $data_siswa2 = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_nis='$getnis' AND kls_siswa='$kelas_value' "); 
                                                $ds2 = mysqli_fetch_array($data_siswa2);
                                                $tot_tung = $tot_tung + $ds2['nominal_spp']; 
                                                $bulan_bayar= $bulan[date('m')]." ".date('Y'); 
                                                ?>
                                                <tr>
                                                    <td><?php echo $ti; ?></td>
                                                    <td><?php echo $ds2['id_nis']; ?></td>
                                                    <td><?php echo $ds2['nama_siswa']; ?></td>
                                                    <td><?php echo $ds2['kls_siswa']; ?></td>
                                                    <td><?php echo $bulan[substr($bulta,5,2)]." ".substr($bulta,0,4); ?>
                                                    </td>
                                                    <td><?php echo rupiah0($ds2['nominal_spp']) ; ?></td>
                                                    <td><span class="badge bg-yellow">Belum Dibayar</span></td>
                                                </tr>
                                                <?php 

                                                } else {
                                                    $ti = $ti + 1; 
                                                    $data_siswa2 = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_nis='$getnis' "); 
                                                    $ds2 = mysqli_fetch_array($data_siswa2);
                                                    $tot_tung = $tot_tung + $ds2['nominal_spp']; 
                                                    $bulan_bayar= $bulan[date('m')]." ".date('Y'); 
                                                    ?>
                                                <tr>
                                                    <td><?php echo $ti; ?></td>
                                                    <td><?php echo $ds2['id_nis']; ?></td>
                                                    <td><?php echo $ds2['nama_siswa']; ?></td>
                                                    <td><?php echo $ds2['kls_siswa']; ?></td>
                                                    <td><?php echo $bulan[substr($bulta,5,2)]." ".substr($bulta,0,4); ?>
                                                    </td>
                                                    <td><?php echo rupiah0($ds2['nominal_spp']) ; ?></td>
                                                    <td><span class="badge bg-yellow">Belum Dibayar</span></td>
                                                </tr>
                                                <?php 

                                                
                                               } } } }  ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th width="3px">No</th>
                                                    <th width="120px">NIS</th>
                                                    <th width="300px">Nama Siswa</th>
                                                    <th width="80px">Kelas Siswa</th>
                                                    <th width="120px">Bulan</th>
                                                    <th width="100px">Nominal</th>
                                                    <th width="5px">Keterangan</th>
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
                    </div>
                    <!-- /.row -->
                    <div class="box">
                        <div class="box box-body">
                            <div class="col-md-12">
                                <!-- Form Goup -->
                                <form method="POST" action="../_report/cetak/report_bulan.php" target="_blank">
                                    <div class="form-group">
                                        <!-- /.input group -->
                                        <div class="box-body table-responsive no-padding">
                                            <table class="table table-hover">
                                                <tr>
                                                    <th width="95%"> Belum Pelunasan :
                                                        <?php 
                                                                    echo $ti; ?> Siswa</th>
                                                    <input type="hidden" name="bulan"
                                                        value="<?php echo $bulan_value; ?>">
                                                    <input type="hidden" name="tahun"
                                                        value="<?php echo $tahun_value; ?>">
                                                <tr>
                                                <tr>
                                                    <th width="95%"> Jumlah belum terbayar bulan ini
                                                        <?php echo "(".$bulan[substr($bulta,5,2)]." ".substr($bulta,0,4).") : "; 
                                                                    echo rupiah0($tot_tung); ?></th>
                                                </tr>
                                            </table>
                                        </div>
                                        <!-- /.div row -->
                                    </div>
                                </form>
                            </div>
                            <!-- /.error-content -->
                        </div>
                    </div>
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
                            <h4 class="modal-title" style="text-align:center;">Apakah Anda Yakin Ingin menghapus
                                Transaksi
                                Pembayaran ini ?</h4>
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
            <!-- Select2 -->
            <script src="../bower_components/select2/dist/js/select2.full.min.js"></script>
            <!-- DataTables -->
            <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
            <!-- InputMask -->
            <script src="../plugins/input-mask/jquery.inputmask.js"></script>
            <script src="../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
            <script src="../plugins/input-mask/jquery.inputmask.extensions.js"></script>
            <!-- date-range-picker -->
            <script src="../bower_components/moment/min/moment.min.js"></script>
            <script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
            <!-- bootstrap datepicker -->
            <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
            <!-- bootstrap color picker -->
            <script src="../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
            <!-- bootstrap time picker -->
            <script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
            <!-- SlimScroll -->
            <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
            <!-- iCheck 1.0.1 -->
            <script src="../plugins/iCheck/icheck.min.js"></script>
            <!-- FastClick -->
            <script src="../bower_components/fastclick/lib/fastclick.js"></script>
            <!-- AdminLTE App -->
            <script src="../dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="../dist/js/demo.js"></script>
            <!-- Page script -->

            <!-- page script -->
            <script>
            $(function() {
                $('.select2').select2()

                $('#example1').DataTable()
                $('#example2').DataTable({
                    'paging': true,
                    'lengthChange': false,
                    'searching': false,
                    'ordering': true,
                    'info': true,
                    'autoWidth': false
                })
            })
            </script>

            <!-- Javascript untuk popup modal Delete-->
            <script type="text/javascript">
            function confirm_modal(delete_url) {
                $('#modal_delete').modal('show', {
                    backdrop: 'static'
                });
                document.getElementById('delete_link').setAttribute('href', delete_url);
            }
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
</body>

</html>