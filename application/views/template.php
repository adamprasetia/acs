<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title><?=$title?></title>
	<link href="<?=base_url('assets/img/avengers.jpg')?>" rel="shortcut icon" type="image/x-icon"/>	
	
	<link href="<?=base_url('../assets/jquery-ui-1.11.2.custom/jquery-ui.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('../assets/bootstrap-3.3.4-dist/css/bootstrap.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('../assets/morris.js-0.5.1/morris.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('../assets/font-awesome-4.3.0/css/font-awesome.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('../assets/ionicons-2.0.1/css/ionicons.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('../assets/AdminLTE-2.1.1/dist/css/AdminLTE.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('../assets/AdminLTE-2.1.1/dist/css/skins/_all-skins.min.css')?>" type="text/css" rel="stylesheet"/>

	<link href="<?=base_url('assets/css/mod.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?=base_url('assets/css/style.css')?>" type="text/css" rel="stylesheet"/>
</head>
<body class="skin-blue-light sidebar-mini <?=($this->session->userdata('sidebar')=='1'?'sidebar-collapse':'')?>">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
		<?=anchor('dashboard','<span class="logo-mini">'.img(array('src'=>'assets/img/logo.png')).'</span><span class="logo-lg">'.img(array('src'=>'assets/img/logo.png')).' ACS 1.0</span>',array('class'=>'logo'))?>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
				          <?=$user_image?>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?=$username?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
				           <?=$user_image_circle?>
                    <p>
                      <?=$username.' - '.$user_level?>
                    </p>
                  </li>
                  <li class="user-body">
					         <?=anchor("change_password","Change Password",array('class'=>'btn btn-default btn-flat'))?>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
				            <?=anchor("profile","Profile",array('class'=>'btn btn-default btn-flat'))?>
                    </div>
                    <div class="pull-right">
					           <?=anchor("login/logout","Sign Out",array('class'=>'btn btn-default btn-flat'))?>
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

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
			       <?=$user_image_circle?>
            </div>
            <div class="pull-left info">
              <p><?=$username?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>


          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MAINMENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="<?=($this->session->userdata('user_level')<>1?"hide":"")?> <?=($this->uri->segment(1)=='user'?'active':'')?>"><?=anchor("user","<i class='fa fa-lock'></i> <span>Security</span>")?></li>
            <li class="<?=($this->session->userdata('user_level')==1 || $this->session->userdata('user_level')==2?"":"hide")?> <?=($this->uri->segment(1)=='campaign'?'active':'')?>"><?=anchor("campaign","<i class='fa fa-flag'></i> <span>Campaign</span>")?></li>
            <li class="treeview <?=($this->uri->segment(1)=='individual'?"active":"")?>">
              <a href="#"><i class='fa fa-user'></i> <span>Individual</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
        				<li><?=anchor("individual/add","<span>New</span>")?></li>
        				<li><?=anchor("individual/import","<span>Import by excel</span>")?></li>
        				<li><?=anchor("individual/update","<span>Update by excel</span>")?></li>
        				<li><?=anchor("individual/filter","<span>List Data</span>")?></li>
              </ul>
            </li>
            <li class="treeview <?=(strpos($this->uri->segment(1), 'report') === false?"":"active")?>">
              <a href="#"><i class='fa fa-area-chart'></i> <span>Report</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
        				<li><?=anchor("report_calculate/filter","<span>Calculate</span>")?></li>
        				<li><?=anchor("report_online/filter","<span>Online</span>")?></li>
              </ul>
            </li>
            <li class="treeview <?=(strpos($this->uri->segment(1), 'barang') === false && strpos($this->uri->segment(1), 'vendor') === false?"":"active")?> <?=($this->session->userdata('user_level')==1 || $this->session->userdata('user_level')==2?"":"hide")?>">
              <a href="#"><i class='fa fa-cubes'></i> <span>Inventory</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
        				<li><?=anchor("vendor","<span>Vendor</span>")?></li>
        				<li><?=anchor("barang","<span>Barang</span>")?></li>
        				<li><?=anchor("barang_masuk","<span>Barang Masuk</span>")?></li>
        				<li><?=anchor("barang_keluar","<span>Barang Keluar</span>")?></li>
              </ul>
            </li>
            <li class="treeview <?=(strpos($this->uri->segment(1), 'sche') === false && strpos($this->uri->segment(1), 'absent') === false?"":"active")?> <?=($this->session->userdata('user_level')==1 || $this->session->userdata('user_level')==2?"":"hide")?>">
              <a href="#"><i class='fa fa-filter'></i> <span>Moderation</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
        				<li><?=anchor("mod_sche","<span>Schedule</span>")?></li>
                <li><?=anchor("mod_sche_beat","<span>Schedule BEAT</span>")?></li>
        				<li><?=anchor("mod_sche_move","<span>Schedule MOVE</span>")?></li>
        				<li><?=anchor("mod_absent","<span>Absent</span>")?></li>
              </ul>
            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
		<?=$content?>
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          PT Data Bina Solusindo
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">ADirect</a>.</strong> All rights reserved.
      </footer>      
    </div><!-- ./wrapper -->
	<script> var base_url = "<?=base_url()?>"</script>
	<script src="<?=base_url('../assets/js/jquery-1.11.3.min.js')?>"></script>
	<script src="<?=base_url('../assets/jquery-ui-1.11.2.custom/jquery-ui.min.js')?>"></script>
	<script src="<?=base_url('../assets/bootstrap-3.3.4-dist/js/bootstrap.min.js')?>"></script>
	<script src="<?=base_url('../assets/AdminLTE-2.1.1/dist/js/app.min.js')?>"></script>
	<script src="<?=base_url('../assets/AdminLTE-2.1.1/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
	<script src="<?=base_url('assets/js/general.js')?>"></script>
</body>
</html>