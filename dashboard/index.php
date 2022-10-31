<?php
include_once('../helper/import.php');
$thisPage = "dashboard";
startSession();
loadBody(); 

function loadBody() {  
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
    /* Center the loader Loading Page Style*/
    #loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;

    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Add animation to "page content" */

    .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
        from {
            bottom: -100px;
            opacity: 0
        }

        to {
            bottom: 0px;
            opacity: 1
        }
    }

    @keyframes animatebottom {
        from {
            bottom: -100px;
            opacity: 0
        }

        to {
            bottom: 0;
            opacity: 1
        }
    }

    #myDiv {
        display: none;
    }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini" style="margin:0;">
<?php $thisPage = "Dashboard"; ?>
<div class="wrapper">
    <?php include_once "nav_header.php"; ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Dashboard</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href="">
                            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">User</span>
                            <span class="info-box-number"><?php echo getTotalUser(); ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href="">
                        <span class="info-box-icon bg-red"><i class="ion ion-cube"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">Warung</span>
                            <span class="info-box-number"> 
                                <?php echo getTotalWarung(); ?>    
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href="">
                            <span class="info-box-icon bg-gray"><i class="ion ion-ios-pint"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">Menu</span>
                            <span class="info-box-number">
                                <?php echo getTotalProduct(); ?>
                            </span>
                        </div></a>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href="">
                        <span class="info-box-icon bg-green"><i class="ion ion-android-sync"></i></span>
                        </a>
                        <div class="info-box-content">
                            <span class="info-box-text">Iklan Berjalan</i></span>
                            <span class="info-box-number"> 
                                <?=count(getAds(NULL, 'active'))?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                        <h3 class="box-title">Iklan</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                            <tr>
                                                <th>No </th>
                                                <th>Warung</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th>Pembayaran</th>
                                                <th>Tanggal Dibuat</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 0;
                                                $listAds = getAds(5);
                                                foreach($listAds as $data) { 
                                                    $no++;   
                                                ?>
                                                <tr>
                                                <td><a href=""><?=$no?></a></td>
                                                <td>
                                                    <?php
                                                        if (empty($data->warung->name)) {
                                                            echo "Administrator";
                                                        } else {
                                                            echo $data->warung->name;
                                                        }
                                                    ?>
                                                </td>
                                                <td><?=$data->name?></td>
                                                <td><?=adsStatusColorName($data->status)?></td>
                                                <td><?=adsPaymentStatus($data->invoice->status)?></td>
                                                <td>
                                                    <div class="sparkbar"><?php echo convertDateFormat($data->createdAt); ?></div>
                                                </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i
                                                class="ion ion-ios-pricetag-outline"></i></span>
                                        <a href="#" style="color: #FFFFFF">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Menunggu Pembayaran</span>
                                                <span class="info-box-number"><?=count(getAds(NULL, NULL, "PENDING"))?></span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 100%">
                                                    </div>
                                                </div>
                                                <span class="progress-description">
                                                    Lihat Semua
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="fa fa-credit-card"></i></span>
                                        <a href="" style="color: #FFFFFF">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Total Pendapatan</span>
                                                <span class="info-box-number">
                                                    <?php 
                                                        $monthy = date('Y-m');
                                                        $trans_tb = getAdsRevenue($monthy, "PAID");
                                                        echo rupiah0($trans_tb->totalAmount); 
                                                    ?>
                                                </span>
                                                <div class="progress">
                                                    <div class="progress-bar" style="width: 100%"></div>
                                                </div>
                                                <span class="progress-description">
                                                    Bulan <?php echo convertmonthtobulan(date("m"));?>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer clearfix">
                            <a href="ads.php" class="btn btn-sm btn-info btn-flat pull-left">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- TABLE: LATEST WARUNG -->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Daftar Warung</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Jam Buka</th>
                        <th>Jam Tutup</th>
                        <th>Register</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no = 0;
                        $listUser = getListWarung(5);
                        foreach($listUser as $data) { $no++; ?>
                        <tr>
                            <td><a href=""><?php echo $no; ?></a></td>
                            <td><?php echo $data->name; ?></td>
                            <td>
                                <?php 
                                    if ($data->isOpen == "true") { 
                                        echo '<span class="label label-primary">Buka</span>'; 
                                    } else { 
                                        echo '<span class="label label-info">Tutup</span>';
                                    }
                                ?>
                            </td>
                            <td><?php echo $data->openTime; ?> WIB</td>
                            <td><?php echo $data->closedTime; ?> WIB</td>
                            <td>
                                <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo convertDateFormat($data->createdAt); ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                <a href="warung.php" class="btn btn-sm btn-info btn-flat pull-left">Lihat Semua</a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- TABLE: LATEST USER -->
            <div class="box box-info">
                <div class="box-header with-border">
                <h3 class="box-title">Daftar User</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Status</th>
                        <th>Register</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $no = 0;
                        $listUser = getListUser(5);
                        foreach($listUser as $data) { $no++; ?>
                        <tr>
                            <td><a href="#"><?php echo $no; ?></a></td>
                            <td><?php echo $data->fullName; ?></td>
                            <td>
                                <?php if ($data->role == "user") { echo '<span class="label label-info">User</span>'; } ?>
                                <?php if ($data->role == "warung") { echo '<span class="label label-success">User Warung</span>'; } ?>
                                <?php 
                                    if ($data->deletedAt == "") { 
                                        echo '<span class="label label-primary">Aktif</span>'; 
                                    } else {
                                        echo '<span class="label label-danger">Tidak Aktif</span>'; 
                                    }
                                ?>
                            </td>
                            <td>
                                <div class="sparkbar" data-color="#00a65a" data-height="20"><?php echo convertDateFormat($data->createdAt); ?></div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a href="user.php" class="btn btn-sm btn-info btn-flat pull-left">Lihat Semua</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
    <!-- footer area -->
    <?php include_once "nav_footer.php"; ?>
    <!-- ./footer -->
    <!-- End Loading Page -->
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
<!-- Sparkline -->
<script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Loading  -->
<script>
    var myVar;
    function myFunction() {
        myVar = setTimeout(showPage, 0);
    }

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
    }
</script>    
</body>
</html>
<?php } ?>

