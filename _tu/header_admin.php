<header class="main-header">
 <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>PP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SI</b>-SPP</span>
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
              <span class="hidden-xs"><?php echo $dataid['adm_fullname']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../dist/img/adminmage.png" class="img-circle" alt="User Image">

                <p>
                <?php echo $dataid['adm_fullname']; ?>
                  <small><?php echo $_SESSION['adm_level']; ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
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
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/adminmage.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $dataid['adm_fullname']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $_SESSION['adm_level'];; ?></a>
        </div>
      </div>

        <!-- search form -->
      <div class="sidebar-form">
        <div class="input-group">

        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li <?php if($thisPage == "Dashboard") echo "class='active'"; ?>>
          <a href="index.php">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
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
          </ul>
        </li>
       

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
