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
              <span class="hidden-xs"> <?php echo $_SESSION['fullName']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../dist/img/adminmage.png" class="img-circle" alt="User Image">
                <p><?php echo $_SESSION['fullName']; ?>
                  <small>Administrator</small>
                </p>
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
      <li <?php if($thisPage == "dashboard") echo "class='active'"; ?>>
        <a href="index.php">
          <i class="fa fa-home"></i> <span>Dashboard</span>
        </a>
      </li>
      <li <?php if($thisPage == "user") echo "class='active'"; ?>>
        <a href="user.php">
          <i class="fa fa-users"></i> <span>User</span>
        </a>
      </li>
      <li <?php if($thisPage == "warung") echo "class='active'"; ?>>
        <a href="warung.php">
          <i class="ion ion-cube"></i> <span>Warung</span>
        </a>
      </li>
      <li <?php if($thisPage == "category") echo "class='active'"; ?>>
        <a href="category.php">
          <i class="fa fa-archive"></i> <span>Kategori Menu</span>
        </a>
      </li>
      <li <?php if($thisPage == "ads") echo "class='active'"; ?>>
        <a href="ads.php">
          <i class="fa fa-bar-chart-o"></i> <span>Iklan</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-bar-chart-o"></i> <span>Booking</span>
        </a>
        <ul class="treeview-menu">
          <li <?php if($thisPage == "booking_history") echo "class='active'"; ?>><a href="booking_history.php"><i class="glyphicon glyphicon-tag"></i>Riwayat</a></li>
          <li <?php if($thisPage == "booking_report") echo "class='active'"; ?>><a href="booking_report.php"><i class="glyphicon glyphicon-tag"></i>Rekap</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa fa-bar-chart-o"></i><span> Withdraw</span>
        </a>
        <ul class="treeview-menu">
          <li <?php if($thisPage == "withdraw_history") echo "class='active'"; ?>><a href="withdraw_history.php"><i class="glyphicon glyphicon-tag"></i>Riwayat</a></li>
          <li <?php if($thisPage == "withdraw_process") echo "class='active'"; ?>><a href="withdraw_process.php"><i class="glyphicon glyphicon-tag"></i>Menunggu Pencairan</a></li>
        </ul>
      </li>
    </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
