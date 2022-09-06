<?php
$thisPage = "Rekap Transaksi Perbulan";
date_default_timezone_set('Asia/Jakarta');
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Tata Usaha'){
  session_destroy();	
  $login_redirect_url = "../index.php";
  echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

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
    <title>SI-SPP </title>
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
    include 'lib.php'; 
    include "header_admin.php";

    if(isset($_GET['bulan'])){
      $bulan_value = $_GET['bulan']; 
      $kelas_value = $_GET['kelas']; 
      $tahun_value = $_GET['tahun']; 
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
                    Rekap Pembayaran (Per-Bulan)
                    <small>Preview</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="#">Pembayaran</a></li>
                    <li class="active">Rekap Perbulan</li>
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
                                                        <th style="width: 60px">Bulan</th>
                                                        <th style="width: 5px">Tahun</th>
                                                        <th style="width: 30px">Kelas</th>
                                                        <th style="width: 2px"></th>
                                                        <th style="width: 2px"></th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <select class="form-control" style="width: 100%;"
                                                                    name="bulan" required>
                                                                    <option value="<?php echo $bulan_value; ?>">
                                                                        <?php echo $bulan[$bulan_value];?></option>
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
                                                                    <option value="<?php echo $kls['nama_kelas']; ?>">
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
                                    <!-- /from group -->
                                </div>
                                <!-- /.error-content -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box box-body">
                                        <div class="box-body">
                                            <div class="box-body table-responsive no-padding">
                                                <table id="example1" class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th width="3px">No</th>
                                                            <th width="120px">ID Pembayaran</th>
                                                            <th width="90px">NIS</th>
                                                            <th width="300px">Nama Siswa</th>
                                                            <th width="90px">Kelas</th>
                                                            <th width="120px">Bulan</th>
                                                            <th width="90px">Nominal</th>
                                                            <th width="140px">Tgl Pembayaran</th>
                                                            <th width="5px">Keterangan</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                      $setbln = date('m'); 
                      $settahun = date('Y'); 
                      $no = 0; 
                      if(isset($_GET['bulan'])){
                        if($_GET['kelas'] == 'Pilih Kelas' || $_GET['kelas']== 'All' ){
                          $get_bulan = $_GET['bulan']; 
                          $get_tahun = $_GET['tahun'];
                          $bulta = $get_bulan."-".$get_tahun;    
                          $data_transaksi = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE bulan_bayar LIKE '%$bulta%' ORDER BY id_bayar DESC"); 
                          
                          $total_trans = mysqli_query($koneksi, "SELECT SUM(nominal_bayar) FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE bulan_bayar LIKE '%$bulta%' ORDER BY id_bayar DESC"); 
                          $total = mysqli_fetch_array($total_trans); 
                          $transaksi_nominal = $total[0]; 	

                         } else if($_GET['kelas'] != 'Pilih Kelas' || $_GET['kelas'] != 'ALL'){
                          $get_bulan = $_GET['bulan']; 
                          $get_tahun = $_GET['tahun']; 
                          $bulta = $get_bulan."-".$get_tahun; 
                          $get_kelas = $_GET['kelas']; 
                          $data_transaksi = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE bulan_bayar LIKE '%$bulta%' AND kls_siswa='$get_kelas' ORDER BY id_bayar DESC"); 
                        
                          $total_trans = mysqli_query($koneksi, "SELECT SUM(nominal_bayar) FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE bulan_bayar LIKE '%$bulta%' AND kls_siswa='$get_kelas' ORDER BY id_bayar DESC"); 
                          $total = mysqli_fetch_array($total_trans); 
                          $transaksi_nominal = $total[0]; 	

                        }
                      } else {
                        $bulta = $setbln."-".$settahun; 
                        $data_transaksi = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE bulan_bayar='$bulta' ORDER BY id_bayar DESC"); 
                      
                        $total_trans = mysqli_query($koneksi, "SELECT SUM(nominal_bayar) FROM tb_pembayaran INNER JOIN tb_siswa ON tb_pembayaran.nis_bayar=tb_siswa.id_nis WHERE bulan_bayar='$bulta' ORDER BY id_bayar DESC"); 
                        $total = mysqli_fetch_array($total_trans); 
                        $transaksi_nominal = $total[0]; 	
                      
                      }

                  while($dt=mysqli_fetch_array($data_transaksi)){
                  $no++;
                  $bulan_bayar= $bulan[substr($dt['bulan_bayar'], 0,2)]." ".substr($dt['bulan_bayar'], 3,4);
                ?>

                                                        <tr>
                                                            <td><?php echo $no; ?></td>
                                                            <td><?php echo $dt['id_bayar']; ?></td>
                                                            <td><?php echo $dt['nis_bayar']; ?></td>
                                                            <td><?php echo $dt['nama_siswa'] ?> </td>
                                                            <td><?php echo $dt['kls_siswa'] ?> </td>
                                                            <td><?php echo $bulan_bayar; ?></td>
                                                            <td><?php echo rupiah0($dt['nominal_bayar']); ?></td>
                                                            <td><?php echo substr($dt['tgl_bayar'], 0,10); ?></td>
                                                            <td><span class="badge bg-red">LUNAS</span></td>
                                                        </tr>

                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th width="3px">No</th>
                                                            <th width="120px">ID Pembayaran</th>
                                                            <th width="90px">NIS</th>
                                                            <th width="300px">Nama Siswa</th>
                                                            <th width="90px">Kelas</th>
                                                            <th width="120px">Bulan</th>
                                                            <th width="90px">Nominal</th>
                                                            <th width="140px">Tgl Pembayaran</th>
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

                                <div class="box">
                                    <div class="box box-body">
                                        <div class="col-md-12">
                                            <!-- Form Goup -->
                                            <form method="POST" action="../_report/cetak/report_bulan.php"
                                                target="_blank">
                                                <div class="form-group">
                                                    <!-- /.input group -->
                                                    <div class="box-body table-responsive no-padding">
                                                        <table class="table table-hover">
                                                            <tr>
                                                                <th width="95%"> Total Pembayaran :
                                                                    <?php echo rupiah0($transaksi_nominal); ?></th>
                                                                <input type="hidden" name="bulan"
                                                                    value="<?php echo $bulan_value; ?>">
                                                                <input type="hidden" name="tahun"
                                                                    value="<?php echo $tahun_value; ?>">
                                                                <input type="hidden" name="kelas"
                                                                    value="<?php echo $kelas_value; ?>">
                                                                <th width="5%">
                                                                    <button type="submit"
                                                                        class="btn btn-block btn-success" name="cetak"
                                                                        value="cetak">
                                                                        <i class="glyphicon glyphicon-print"></i>
                                                                        <span></span>Cetak
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

        <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
            //Datemask2 mm/dd/yyyy
            $('#datemask2').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
            //Money Euro
            $('[data-mask]').inputmask()

            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'DD/MM/YYYY hh:mm A'
                }
            })
            //Date range as a button
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                            'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                        'MMMM D, YYYY'))
                }
            )

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })

            //Colorpicker
            $('.my-colorpicker1').colorpicker()
            //color picker with addon
            $('.my-colorpicker2').colorpicker()

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false
            })
        })
        </script>







</body>

</html>