<section class="content-header">
	<h1>
		Individual
		<small>Adult Smokers Management</small>
	</h1>
	<ol class="breadcrumb">
		<li><?php echo anchor('dashboard','Dashboard')?></li>
		<li><?php echo anchor($breadcrumb,'Individual Filter')?></li>
		<li class="active">Individual</li>
	</ol>
</section>
<section class="content">
	<?php 
		$q = $this->input->get('query');
		if($q <> ''){
			echo '<div class="alert alert-info"><b>Query</b> : '.$q.'</div>';
		}
	?>
	<?php echo $this->session->flashdata('alert')?>
	<div class="box">
		<div class="box-header">
			<?php echo $add_btn?>
			<div class="pull-right">
				<?php echo $export_btn?>
				<?php echo $export_xls_btn?>
			</div>
		</div>		
		<div class="box-body">
			<?php echo form_open($action,array('class'=>'form-inline'))?>
				<div class="form-group">
					<?php echo form_label('Show entries','limit')?>
					<?php echo form_dropdown('limit',array('10'=>'10','50'=>'50','100'=>'100'),set_value('limit',$this->input->get('limit')),'onchange="submit()" class="form-control input-sm"')?> 
				</div>
				<div class="form-group">
					<?php echo form_input(array('name'=>'search','value'=>$this->input->get('search'),'size'=>'40','autocomplete'=>'off','placeholder'=>'Search..','onchange=>"submit()"','class'=>'form-control input-sm'))?>
				</div>
				<div class="form-group">
					<?php echo form_dropdown('campaign_id',$this->mdl_campaign->dropdown(),set_value('campaign_id',$this->input->get('campaign_id')),'class="form-control input-sm" onchange="submit()"')?>
				</div>				
			<?php echo form_close()?>
			<div class="table-responsive">
				<?php echo $table?>
			</div>
		</div>
		<div class="box-footer">
			<?php echo form_label($total,'',array('class'=>'label-footer'))?>
			<div class="pull-right">
				<?php echo $pagination?>
			</div>
		</div>		
	</div>
</section>


