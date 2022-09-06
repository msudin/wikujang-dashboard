<?php
include_once "home_uc.php";
include '../dbcon/config.php';
include '../utils/lib.php';

$thisPage = "Dashboard";
date_default_timezone_set('Asia/Jakarta');

if (validateHome() === true) { loadBody(); }
?>

<?php
    function loadBody(){ 
        $total = getDataGrafik();
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
                <!-- Google Font -->
            <link rel="stylesheet"
                href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-xs-12">
                                    <div class="info-box">
                                        <a href="transaksi_rekap_perhari.php">
                                            <span class="info-box-icon bg-aqua"><i class="ion ion-bag"></i></span>
                                        </a>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Transaksi /Hari</span>
                                            <span class="info-box-number"><?php echo getTotalTransToday(); ?>
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
                                            <span class="info-box-number"> 
                                                <?php 
                                                    $data = getTotalThisDayTrans(); 
                                                    echo rupiah0($data); 
                                                ?>
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
                                            <i> *bulan <?php echo convertmonthtobulan(date("m"));?> </i>
                                            <span class="info-box-number">
                                                <?php
                                            $month_filter = date("Y")."-".date("m");    
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
                                                            $ti = $usercount - $cb;
                                                            $pre = "100"; 
                                                            $bayar_pro = $ti * $pre / $usercount;

                                                            //while($ds=mysqli_fetch_array($data_siswa)){
                                                            //$no++; 
                                                            //$getnis= $ds['id_nis']; 
                                                            //$cekbayar = mysqli_query($koneksi, "SELECT * FROM tb_pembayaran WHERE nis_bayar='$getnis' AND bulan_bayar LIKE '%$month_filter%' ");
                                                            //$cekahir =  mysqli_fetch_array($cekbayar);                   
                                                            //if(mysqli_num_rows($cekbayar) == 0){
                                                            //    $ti = $ti + 1; 
                                                            //    $data_siswa2 = mysqli_query($koneksi, "SELECT * FROM tb_siswa WHERE id_nis='$getnis' "); 
                                                            //    $ds2 = mysqli_fetch_array($data_siswa2);
                                                            //    $bulan_bayar= $bulan[date('m')]." ".date('Y');
                                                            //}}

                                                            ?>
                                                                <span class="info-box-number"><?=$ti;?></span>

                                                                <div class="progress">
                                                                    <div class="progress-bar" style="width: <?=$bayar_pro;?>%">
                                                                    </div>
                                                                </div>
                                                                <span class="progress-description">
                                                                    Bulan <?php echo convertmonthtobulan(date("m"));?>
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
                                                                    Bulan <?php echo convertmonthtobulan(date("m"));?>
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
                    <?php include "footer.php"; ?>
                    <!-- ./footer -->
                    <!-- Loading Page -->
                    <!-- <div id="loader"></div>  -->
                    <!-- <div style="display:none;" id="myDiv" class="animate-bottom"> -->
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
                <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
                <script src="../dist/js/pages/dashboard2.js"></script>
                <!-- AdminLTE for demo purposes -->
                <script src="../dist/js/demo.js"></script>
            
            
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

            <script> // Loading Page;
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
    <?php }
?>

