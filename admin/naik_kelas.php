<?php
include '../utils/lib.php';
include 'naik_kelas_uc.php';
$thisPage = "Naik Kelas";

session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Admin'){
  session_destroy();	
  $login_redirect_url = "../index.php";
  echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

$kls = $_GET['kelas']; 
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
    <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.checkboxes.css">
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

<body class="hold-transition skin-blue sidebar-mini" onload="myFunction()">
    <!-- Loading Page -->
    <div id="loader"></div>
    <div style="display:none;" id="myDiv" class="animate-bottom">
        <!-- /Loading Page -->
        <div class="wrapper">
            <?php include "header_admin.php"; ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Naik Kelas Siswa
                        <small>Preview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Siswa</a></li>
                        <li class="active">Naik Kelas Siswa</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
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
                                                  Edit SPP Siswa Berhasil. 
                                                  </div></div>';
                                        }
                                      } 
                                  ?>
                                <form method="POST" id="myForm">
                                    <div class="box-body">
                                        <div class="box-body table-responsive no-padding">
                                            <table id="example1" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th width="10%">NIS</th>
                                                        <th width="40%">Nama</th>
                                                        <th width="10%">Kelas</th>
                                                        <th width="45%">Keterangan</th>
                                                        <th align="left"><input type="checkbox" id="chkAll" /></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $no = 0; 
                                                        $data_siswa = getDataSiswa($kls); 
                                                        foreach($data_siswa as $ds){
                                                          $no++; 
                                                      ?>
                                                    <tr>
                                                        <td><?php echo $no; ?></td>
                                                        <td><?php echo $ds['id_nis']; ?></td>
                                                        <td><?php echo $ds['nama_siswa']; ?></td>
                                                        <td><?php echo $ds['kls_siswa']; ?>/<?php echo $ds['jk_siswa']; ?>
                                                        </td>
                                                        <td><?php echo $ds['ket_siswa']; ?></td>
                                                        <td><input type="checkbox" name="naikkelas" id="Checkbox"></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <tr>
                                                <th width="80%">
                                                    <center> Action </center>
                                                </th>

                                                <td>
                                                    <button id="Button1" class="btn btn-block btn-success" type="button"
                                                        value="Submit"><span></span>Naik Kelas
                                                </td>
                                            <tr>
                                            <tr>
                                        </table>
                                    </div>
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
                </form>
                <!-- iniformnya -->
            </div>
            <!-- /.content-wrapper -->
            <!-- footer area -->
            <?php 
              include "footer.php"; 
            ?>
            <!-- ./footer -->
            <!-- ./wrapper -->

            <!-- Modal Popup untuk Edit-->
            <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                aria-hidden="true">
            </div>

            <!-- jQuery 3 -->
            <script src="../bower_components/jquery/dist/jquery.min.js"></script>
            <!-- Bootstrap 3.3.7 -->
            <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- DataTables -->
            <script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
            <script src="../bower_components/datatables.net-bs/js/dataTables.checkboxes.min.js"></script>
            <!-- SlimScroll -->
            <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
            <!-- AdminLTE App -->
            <script src="../dist/js/adminlte.min.js"></script>
            <!-- AdminLTE for demo purposes -->
            <script src="../dist/js/demo.js"></script>


            <script type="text/javascript">
            // FUNCTION TO SELECT CHECK ALL 
            $(function() {
                $("#chkAll").click(function() {
                    $("input[name='naikkelas']").attr("checked", this.checked);
                });
                $('#example').DataTable({});
            });

            // SUBMIT GET CHECK ALL AJAX GET 
            $(document).ready(function() {
                $('#example1').DataTable({
                    'paging': false,
                    // "pagingType": "full_numbers",
                    'lengthChange': true,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': true
                });

                var oTable = $("#example1").dataTable();
                $("#Button1").click(function() {
                    $("input:checkbox", oTable.fnGetNodes()).each(function() {
                        var tuisre = $(this).is(":checked");
                        if (tuisre) {
                            var nis = $(this).parent().prev().prev().prev().prev().text();
                            var nama = $(this).parent().prev().prev().prev().text();
                            var kelas = $(this).parent().prev().prev().text();
                            console.log('nis :' + nis + ", nama siswa : " + nama);

                            //GET DATA
                            var splitdata = kelas.split(" ");
                            var getkelas = splitdata[0];
                            var getsubkelas = splitdata[1];
                            var lenght = getsubkelas.length - 2;
                            var classname = getsubkelas.substring(0, lenght);

                            var savekelas;
                            var status;

                            if (getkelas == "X") {
                                savekelas = "XI " + classname;
                                status = 0;
                                console.log("kelas baru : XI " + classname + ", Status = " +
                                    status);
                            } else if (getkelas == "XII") {
                                savekelas = "";
                                status = 1;
                                console.log("kelas baru : SUDAH ALUMNI => " + savekelas +
                                    ", Status = " + status);
                            } else if (getkelas == "XI") {
                                savekelas = "XII " + classname;
                                status = 1;
                                console.log("kelas baru : XII" + classname + ", Status = " +
                                    status);
                            }

                            // FUNCTION AJAX UPDATE SQL QUERY DATA DATABASE
                            $.ajax({
                                type: 'POST',
                                url: "naik_kelas_uc.php",
                                data: {
                                    id_nis: nis,
                                    new_kelas: savekelas,
                                    status: status, 
                                    uc_type: "update"
                                },
                                success: function() {}
                            });
                        }
                    });

                    // RELOAD PAGE AFTER VIEW SECONDS
                    setTimeout(function() { // wait for 2 secs
                        location.reload(); // then reload the page
                    }, 1);
                });
            });


            // Loading Page
            var myVar;
            function myFunction() {
                myVar = setTimeout(showPage, 100);
            };

            function showPage() {
                document.getElementById("loader").style.display = "none";
                document.getElementById("myDiv").style.display = "block";
            };

            // <!-- Javascript untuk popup modal Delete  -->
            function confirm_modal(delete_url) {
                $('#modal_delete').modal('show', {
                    backdrop: 'static'
                });
                document.getElementById('delete_link').setAttribute('href', delete_url);
            };

            </script>
</body>
</html>