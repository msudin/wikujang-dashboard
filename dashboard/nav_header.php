<?php
include '../dbcon/config.php';

$user_id = $_SESSION['user_id'];
$username = mysqli_query($koneksi, "select * from admin where id_admin='$user_id'");
$dataid = mysqli_fetch_array($username);
?>

<header class="main-header">
 <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>W</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>WIKUJANG</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../dist/img/adminmage.png" class="user-image" alt="User Image">
              <span class="hidden-xs"> <?php echo $_SESSION['userName']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../dist/img/adminmage.png" class="img-circle" alt="User Image">
                <p><?php echo $_SESSION['fullName']; ?></p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li <?php if($thisPage == "Dashboard") echo "class='active'"; ?>>
        <a href="index.php">
          <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
      </li>
      <!-- <li class="treeview">
        <a href="#">
          <i class="fa fa-edit"></i><span> Pembayaran</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if($thisPage == "Transaksi Cari") echo "class='active'"; ?>><a href="transaksi_cari.php"><i class="fa fa-plus"></i> Input Pembayaran</a></li>
          <li <?php if($thisPage == "Data Transaksi All") echo "class='active'"; ?>><a href="transaksi_data_all.php"><i class="fa  fa-clone"></i> Data Pembayaran</a></li>
          <li <?php if($thisPage == "Data Transaksi Persiswa") echo "class='active'"; ?>><a href="transaksi_cari_peruser.php"><i class="fa  fa-clone"></i> Data Per Siswa</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-calendar"></i><span> Rekap Pembayaran</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if($thisPage == "Rekap Transaksi Perhari") echo "class='active'"; ?>><a href="transaksi_rekap_perhari.php"><i class="glyphicon glyphicon-tag"></i> Rekap Per Hari</a></li>
          <li <?php if($thisPage == "Rekap Transaksi Perminggu") echo "class='active'"; ?>><a href="transaksi_rekap_perminggu.php"><i class="glyphicon glyphicon-tag"></i> Rekap Per Minggu</a></li>
          <li <?php if($thisPage == "Rekap Transaksi Perbulan") echo "class='active'"; ?>><a href="transaksi_rekap_bulan.php"><i class="glyphicon glyphicon-tag"></i> Rekap Per Bulan</a></li>
        </ul>
      </li>

      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i><span> Siswa</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if($thisPage == "Data Siswa") echo "class='active'"; ?>><a href="siswa_data.php"><i class="fa  fa-clone"></i> Data Siswa</a></li>
          <li <?php if($thisPage == "SPP Siswa") echo "class='active'"; ?> ><a href="sispp_data.php"><i class="fa  fa-credit-card"></i> SPP Per Siswa</a></li>
          <li <?php if($thisPage == "Naik Kelas") echo "class='active'"; ?> ><a href="naik_kelas_cari.php"><i class="fa  fa-user-plus"></i> Naik Kelas</a></li>
          </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i><span> Kelas</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if($thisPage == "Data Kelas") echo "class='active'"; ?> ><a href="kelas_data.php"><i class="fa  fa-user-plus"></i> Data Kelas</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-bank"></i><span> SPP</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if($thisPage == "Nominal SPP") echo "class='active'"; ?> ><a href="spp_default.php"><i class="fa  fa-user-plus"></i>Set Nominal</a></li>
        </ul>
      </li>
      <li <?php if($thisPage == "Administrator") echo "class='active'"; ?>>
        <a href="adm_data.php">
          <i class="fa  fa-user"></i> <span>Administrator</span>
        </a>
      </li> -->
    </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
