<section class="content-header">
	<h1>
		Dashboard
		<small>Control panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?=$individual_total?></h3>
					<p>Individual</p>
				</div>
				<div class="icon">
					<i class="ion ion-person"></i>
				</div>
				<?=anchor('individual/filter','More info <i class="fa fa-arrow-circle-right"></i>',array('class'=>'small-box-footer'))?>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?=$campaign_total?></h3>
					<p>Campaign</p>
				</div>
				<div class="icon">
					<i class="ion ion-calendar"></i>
				</div>
				<?=anchor('campaign','More info <i class="fa fa-arrow-circle-right"></i>',array('class'=>'small-box-footer'))?>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?=$vendor_total?></h3>
					<p>Vendor</p>
				</div>
				<div class="icon">
					<i class="ion ion-briefcase"></i>
				</div>
				<?=anchor('vendor','More info <i class="fa fa-arrow-circle-right"></i>',array('class'=>'small-box-footer'))?>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?=$barang_total?></h3>
					<p>Barang</p>
				</div>
				<div class="icon">
					<i class="ion ion-cube"></i>
				</div>
				<?=anchor('barang','More info <i class="fa fa-arrow-circle-right"></i>',array('class'=>'small-box-footer'))?>
			</div>
		</div>
	</div>
	<div class="box box-info">
		<div class="box-header with-border">
			<h3 class="box-title">Individual per Campaign</h3>
		</div>
		<div class="box-body chart-responsive">
			<div class="chart" id="campaign-individual-chart" style="height: 300px;"></div>
		</div>
	</div>	
	<div class="box">
		<div class="box-header">
		  <i class="fa fa-comments-o"></i>
		  <h3 class="box-title">Chat</h3>
		</div>
		<div class="box-footer">
		<?=form_open('chat/set',array('id'=>'form-chat'))?>
		  <div class="input-group">
			<?=form_input(array('name'=>'chat','class'=>'form-control','placeholder'=>'Type message...','autocomplete'=>'off'))?>
			<div class="input-group-btn">
			  <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
			</div>
		  </div>
		<?=form_close()?>  
		</div>
		<div class="box-body chat" id="chat-box"></div>
	</div>
</section>
<script> var base_url = "<?=base_url()?>"</script>
<script src="<?=base_url('../assets/js/jquery-1.11.3.min.js')?>"></script>
<script src="<?=base_url('../assets/jquery-ui-1.11.2.custom/jquery-ui.min.js')?>"></script>
<script src="<?=base_url('../assets/AdminLTE-2.1.1/plugins/morris/raphael-min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('../assets/AdminLTE-2.1.1/plugins/morris/morris.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('assets/js/chat.js')?>"></script>
<script>
	$(document).ready(function(){
		$.ajax({    
			url: 'dashboard/get_campaign_individual',
			dataType: "json",
			success: function(str) {    
				Morris.Bar({  
					element: 'campaign-individual-chart',
					resize: true,
					data: str,
					xkey: 'c',
					ykeys: ['t'],
					labels: ['Total'],
					hideHover: 'auto',
					barColors: ["#3c8dbc", "#f56954"]
				});  
			}		
		});	  		
	});
</script>

