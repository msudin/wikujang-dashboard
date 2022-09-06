<?php
$thisPage = "Dashboard";
date_default_timezone_set('Asia/Jakarta');
session_start();
if (empty($_SESSION['user_id']) || $_SESSION['adm_level'] !='Tata Usaha'){
    session_destroy();	
    $login_redirect_url = "../index.php";
    echo "<script>alert('Akses ditolak, Silahkan Login !'); window.location = '$login_redirect_url'</script>";
}

  include '../dbcon/config.php';
  include 'lib.php';

  $user_id = $_SESSION['user_id'];
  $username = mysqli_query($koneksi, "select * from admin where id_admin='$user_id'");
  $dataid = mysqli_fetch_array($username);

  $date_today = date("Y-m-d");

  // Cek Data Pembayaran Setiap Bulan
  $settahun = date('Y'); 

  //Set VALUE Total Query Bulan
    
  //Cek Bulan Janurari 
  $set_jnr = "01-".$settahun; 
  $qry1 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_jnr'"); 
  $jan = mysqli_num_rows($qry1);  

  //Cek Bulan Februari
  $set_feb = "02-".$settahun; 
  $qry2 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_feb'"); 
  $feb = mysqli_num_rows($qry2);  

  //Cek Bulan Maret
  $set_mrt = "03-".$settahun; 
  $qry3 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_mrt'"); 
  $mart = mysqli_num_rows($qry3);
  
  //Cek Bulan APRIL
  $set_apr = "04-".$settahun; 
  $qry4 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_apr'"); 
  $apr = mysqli_num_rows($qry4);  
  
 //Cek Bulan Mei
 $set_mei = "05-".$settahun; 
 $qry5 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_mei'"); 
 $mei = mysqli_num_rows($qry5);  

 //Cek Bulan Juni
 $set_jun = "06-".$settahun; 
 $qry6 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_jun'"); 
 $jun = mysqli_num_rows($qry6);  

 //Cek Bulan Juli
 $set_jul = "07-".$settahun; 
 $qry7 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_jul'"); 
 $jul = mysqli_num_rows($qry7);  


 //Cek Bulan Agustus
 $set_agus= "08-".$settahun; 
 $qry8 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_agus'"); 
 $agus = mysqli_num_rows($qry8);  

 //Cek Bulan September
 $set_sep= "09-".$settahun; 
 $qry9 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_sep'"); 
 $sep = mysqli_num_rows($qry9);
 
 //Cek Bulan Oktober
 $set_okt= "10-".$settahun; 
 $qry10 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_okt'"); 
 $okt = mysqli_num_rows($qry10);  

 //Cek Bulan November
 $set_nov= "11-".$settahun; 
 $qry11 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_nov'"); 
 $nov = mysqli_num_rows($qry11);  

 //Cek Bulan Desember
 $set_des= "12-".$settahun; 
 $qry12 = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$set_des'"); 
 $des = mysqli_num_rows($qry12);  

 $total= array("$jan", "$feb", "$mart", "$apr", "$mei", "$jun", "$jul",
                "$agus", "$sep","$okt","$nov", "$des");



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

    <style>
    /* Center the loader */
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

<body class="hold-transition skin-blue sidebar-mini"onload="myFunction()" style="margin:0;">
   
        <?php
        $thisPage = "Dashboard";
        ?>
        <div class="wrapper">

            <!-- Header Menu, Logo , Left Asside Menu, Etc -->
            <?php
                include "header_admin.php";
            ?>


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- Info boxes -->
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <a href="transaksi_rekap_perhari.php">
                                    <span class="info-box-icon bg-aqua"><i class="ion ion-bag"></i></span>
                                </a>

                                <div class="info-box-content">
                                    <span class="info-box-text">Transaksi /Hari</span>
                                    <span class="info-box-number"><?php 
                                  $sql_trans_count= mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE tgl_bayar LIKE '%$date_today%' ");
                                  $transcount = mysqli_num_rows($sql_trans_count);
                                  echo $transcount; ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <a href="transaksi_rekap_perhari.php">
                                    <span class="info-box-icon bg-green"><i class="ion-stats-bars"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Pembayaran</span>
                                    <span class="info-box-text">/Hari</span>
                                    <span class="info-box-number"> <?php 
                                  $sum_bayar_today= mysqli_query($koneksi, "SELECT SUM(nominal_bayar) FROM tb_pembayaran WHERE tgl_bayar LIKE '%$date_today%' ");
                                  $data_nilai = mysqli_fetch_array($sum_bayar_today); 
                                  $jumlah_nilai = $data_nilai[0]; 
                                  echo rupiah0($jumlah_nilai); ?>
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
                                <a href="siswa_data.php">
                                    <span class="info-box-icon bg-yellow"><i class="ion  ion-person-add"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Jumlah Siswa</span>
                                    <span class="info-box-number"><?php
                                  $qry_user= mysqli_query($koneksi, "select * from tb_siswa");
                                  $usercount = mysqli_num_rows($qry_user);
                                  echo $usercount; ?>
                                    </span>
                                </div></a>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <!-- /.col -->
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <a href="transaksi_rekap_bulan.php">
                                    <span class="info-box-icon bg-red"><i
                                            class="glyphicon glyphicon-ok-sign"></i></span>
                                </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pelunasan </span>
                                    <i> *Bulan <?php echo $bulan[date("m")];?> </i>
                                    <span class="info-box-number">
                                        <?php
                                    $month_filter = date("m")."-".date("Y");    
                                    $cekbayar = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE bulan_bayar='$month_filter' ");             
                                    echo $cb = mysqli_num_rows($cekbayar);
                                      ?>
                                    </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div> <!-- /.row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Statistik</h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="text-center">
                                                <strong>Statistik Pembayaran Tahun <?php echo date('Y');?> </strong>
                                            </p>
                                            <!-- AREA CHART -->
                                            <div class="box box-primary">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Bar Chart</h3>
                                                    <div class="box-tools pull-right">
                                                        <button type="button" class="btn btn-box-tool"
                                                            data-widget="collapse"><i class="fa fa-minus"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-box-tool"
                                                            data-widget="remove"><i class="fa fa-times"></i></button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <div class="chart">
                                                        <canvas id="areaChart" style="height:250px"></canvas>
                                                    </div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->
                                        </div>
                                        <!-- /.col -->

                                        <!-- /.info-box-content -->
                                        <div class="col-md-4">
                                            <div class="info-box bg-yellow">
                                                <span class="info-box-icon"><i
                                                        class="ion ion-ios-pricetag-outline"></i></span>

                                                <a href="transaksi_data_belum.php" style="color: #FFFFFF">
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Menunggu Pelunasan</span>
                                                        <?php
                
                                                    $month_filter = date("m-Y");
                                    
                                                    $ti = 0;
                                                    $no = 0; 
                                                    $data_siswa = mysqli_query($koneksi, "SELECT * FROM tb_siswa"); 
                                                    while($ds=mysqli_fetch_array($data_siswa)){
                                                    $no++; 
                                                    $getnis= $ds['id_nis']; 
                                                    $cekbayar = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE nis_bayar='$getnis' AND bulan_bayar LIKE '%$month_filter%' ");
                                                    $cekahir =  mysqli_fetch_array($cekbayar);                   
                                                    if(mysqli_num_rows($cekbayar) == 0){
                                                        $ti = $ti + 1; 
                                                        $data_siswa2 = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_nis='$getnis' "); 
                                                        $ds2 = mysqli_fetch_array($data_siswa2);

                                                        $bulan_bayar= $bulan[date('m')]." ".date('Y');
 
                                                    }}

                                                    $pre = "100"; 
                                                    $bayar_pro = $ti * $pre / $usercount; 
                                                    ?>
                                                        <span class="info-box-number"><?=$ti;?></span>

                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: <?=$bayar_pro;?>%">
                                                            </div>
                                                        </div>
                                                        <span class="progress-description">
                                                            Bulan <?php echo $bulan[date("m")];?>
                                                        </span>
                                                    </div>
                                                </a>
                                                <!-- /.info-box-content -->
                                            </div>
                                            <!-- /.info-box -->
                                            <div class="info-box bg-green">

                                                <span class="info-box-icon"><i class="fa fa-credit-card"></i></span>

                                                <a href="#" style="color: #FFFFFF">
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Total Pembayaran</span>
                                                        <?php
                                                        $monthy = date('Y-m');
                                                    
                                                    $sql_tb = mysqli_query($koneksi, "SELECT SUM(nominal_bayar) FROM tb_pembayaran WHERE tgl_bayar LIKE '%$monthy%' "); 
                                                    $tb = mysqli_fetch_array($sql_tb); 
                                                    $trans_tb = $tb[0]; 
                                                    ?>
                                                        <span class="info-box-number">
                                                            <?php echo rupiah0($trans_tb); ?></span>

                                                        <div class="progress">
                                                            <div class="progress-bar" style="width: 100%"></div>
                                                        </div>
                                                        <span class="progress-description">
                                                            Bulan <?php echo $bulan[date("m")];?>
                                                        </span>
                                                    </div>
                                                </a>
                                                <!-- /.info-box-content -->
                                            </div>
                                        </div>
                                        <!-- /.row -->
                                    </div>
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
        </div>
        <div id="loader"></div>
        <div style="display:none;" id="myDiv" class="animate-bottom">
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
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="../dist/js/pages/dashboard2.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
        <script>
    // Loading Page
    var myVar;

    function myFunction() {
        myVar = setTimeout(showPage, 1500);

    }

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
    }
    </script>
       
        <script>
    $(function() {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas)

        var areaChartData = {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ],
            datasets: [{
                    label: 'Jumlah Siswa',
                    fillColor: 'rgba(210, 214, 222, 1)',
                    strokeColor: 'rgba(210, 214, 222, 1)',
                    pointColor: 'rgba(210, 214, 222, 1)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data: [<?php
                                    for($x=0;$x<12;$x++){
                                    echo '"'. $usercount . '",';
                                    }
                                     ?>]
                },
                {
                    label: 'Jumlah Pembayaran',
                    fillColor: 'rgba(60,141,188,0.9)',
                    strokeColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    //data: [30, 48, 40, 19, 86, 27, 90]
                    data: [<?php
                                    for($x=0;$x<12;$x++){
                                    echo '"'.$total[$x] . '",';
                                    }
                                     ?>]
                }
            ]
        }

        var areaChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: 'rgba(0,0,0,.05)',
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        }

        //Create the line chart
        areaChart.Bar(areaChartData, areaChartOptions)

    })
    </script>

    
        
</body>
</html>