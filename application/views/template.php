<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title><?php echo $title?></title>
	<link href="<?php echo base_url('assets/img/avengers.jpg')?>" rel="shortcut icon" type="image/x-icon"/>	
	
	<link href="<?php echo base_url('../assets/jquery-ui-1.11.2.custom/jquery-ui.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url('../assets/bootstrap-3.3.4-dist/css/bootstrap.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url('../assets/morris.js-0.5.1/morris.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url('../assets/font-awesome-4.3.0/css/font-awesome.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url('../assets/ionicons-2.0.1/css/ionicons.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url('../assets/AdminLTE-2.1.1/dist/css/AdminLTE.min.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url('../assets/AdminLTE-2.1.1/dist/css/skins/_all-skins.min.css')?>" type="text/css" rel="stylesheet"/>

	<link href="<?php echo base_url('assets/css/mod.css')?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url('assets/css/style.css')?>" type="text/css" rel="stylesheet"/>

  <script src="<?php echo base_url('../assets/js/jquery-1.11.3.min.js')?>"></script>
  <script src="<?php echo base_url('../assets/jquery-ui-1.11.2.custom/jquery-ui.min.js')?>"></script>
  <script> var base_url = "<?php echo base_url()?>"</script>
</head>
<body class="skin-green sidebar-mini fixed <?php echo ($this->session->userdata('sidebar')=='1'?'sidebar-collapse':'')?>">
  <div class="wrapper">
    <header class="main-header">
      <?php echo anchor('dashboard','<span class="logo-mini">'.img(array('src'=>'assets/img/logo.png')).'</span><span class="logo-lg">'.img(array('src'=>'assets/img/logo.png')).' ACS 2.0</span>',array('class'=>'logo'))?>
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php echo $user_image?>
                <span class="hidden-xs"><?php echo $username?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <?php echo $user_image_circle?>
                  <p>
                    <?php echo $username.' - '.$user_level?>
                  </p>
                </li>
                <li class="user-body">
                  <?php echo anchor("change_password","Change Password",array('class'=>'btn btn-default btn-flat'))?>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <?php echo anchor("profile","Profile",array('class'=>'btn btn-default btn-flat'))?>
                  </div>
                  <div class="pull-right">
                    <?php echo anchor("login/logout","Sign Out",array('class'=>'btn btn-default btn-flat'))?>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <?php echo $user_image_circle?>
          </div>
          <div class="pull-left info">
            <p><?php echo $username?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <ul class="sidebar-menu">
          <li class="header">MAINMENU</li>
          <li class="<?php echo ($this->session->userdata('user_level')<>1?"hide":"")?> <?php echo ($this->uri->segment(1)=='user'?'active':'')?>"><?php echo anchor("user","<i class='fa fa-lock'></i> <span>Security</span>")?></li>
          <li class="<?php echo ($this->session->userdata('user_level')==1 || $this->session->userdata('user_level')==2?"":"hide")?> <?php echo ($this->uri->segment(1)=='campaign'?'active':'')?>"><?php echo anchor("campaign","<i class='fa fa-flag'></i> <span>Campaign</span>")?></li>
          <li class="treeview <?php echo ($this->uri->segment(1)=='individual'?"active":"")?>">
          <a href="#"><i class='fa fa-user'></i> <span>Individual</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><?php echo anchor("individual/add","<span>New</span>")?></li>
            <li><?php echo anchor("individual/import","<span>Import by excel</span>")?></li>
            <li><?php echo anchor("individual/update","<span>Update by excel</span>")?></li>
            <li><?php echo anchor("individual/filter","<span>List Data</span>")?></li>
            <li><?php echo anchor("individual/query","<span>Query Data</span> <small class='label pull-right bg-green'>new</small>")?></li>
          </ul>
          </li>
          <li class="treeview <?php echo (strpos($this->uri->segment(1), 'report') === false?"":"active")?>">
            <a href="#"><i class='fa fa-area-chart'></i> <span>Report</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><?php echo anchor("report_calculate/filter","<span>Calculate</span>")?></li>
              <li><?php echo anchor("report_online/filter","<span>Online</span>")?></li>
            </ul>
          </li>
          <li class="treeview <?php echo (strpos($this->uri->segment(1), 'barang') === false && strpos($this->uri->segment(1), 'vendor') === false?"":"active")?> <?php echo ($this->session->userdata('user_level')==1 || $this->session->userdata('user_level')==2?"":"hide")?>">
            <a href="#"><i class='fa fa-cubes'></i> <span>Inventory</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><?php echo anchor("vendor","<span>Vendor</span>")?></li>
              <li><?php echo anchor("barang","<span>Barang</span>")?></li>
              <li><?php echo anchor("barang_masuk","<span>Barang Masuk</span>")?></li>
              <li><?php echo anchor("barang_keluar","<span>Barang Keluar</span>")?></li>
            </ul>
          </li>
          <li class="treeview <?php echo (strpos($this->uri->segment(1), 'sche') === false && strpos($this->uri->segment(1), 'absent') === false?"":"active")?> <?php echo ($this->session->userdata('user_level')==1 || $this->session->userdata('user_level')==2?"":"hide")?>">
            <a href="#"><i class='fa fa-filter'></i> <span>Moderation</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <li><?php echo anchor("mod_sche","<span>Schedule</span>")?></li>
              <li><?php echo anchor("mod_sche_beat","<span>Schedule BEAT</span>")?></li>
              <li><?php echo anchor("mod_sche_move","<span>Schedule MOVE</span>")?></li>
              <li><?php echo anchor("mod_absent","<span>Absent</span>")?></li>
            </ul>
          </li>
        </ul>
      </section>
    </aside>

    <div class="content-wrapper">
      <?php echo $content?>
    </div>

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        PT Data Bina Solusindo
      </div>
      <strong>Copyright &copy; 2016 <a href="#">ADirect</a>.</strong> All rights reserved.
    </footer>      
  </div>
	<script src="<?php echo base_url('../assets/bootstrap-3.3.4-dist/js/bootstrap.min.js')?>"></script>
	<script src="<?php echo base_url('../assets/AdminLTE-2.1.1/dist/js/app.min.js')?>"></script>
	<script src="<?php echo base_url('../assets/AdminLTE-2.1.1/plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
	<script src="<?php echo base_url('assets/js/general.js')?>"></script>
</body>
</html>