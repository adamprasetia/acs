<section class="content-header">
	<h1>
		Campaign
		<small>Campaign/Event Management</small>
	</h1>
	<ol class="breadcrumb">
		<li><?php echo anchor('dashboard','Dashboard')?></li>
		<li class="active">Campaign</li>
	</ol>
</section>
<section class="content">
	<?php echo $this->session->flashdata('alert')?>
	<div class="box">
		<div class="box-header">
			<?php echo $add_btn?>
		</div>		
		<div class="box-body">
			<?php echo form_open($action,array('class'=>'form-inline'))?>
				<div class="form-group">
					<?php echo form_label('Show entries','limit')?>
					<?php echo form_dropdown('limit',array('10'=>'10','50'=>'50','100'=>'100'),set_value('limit',$this->input->get('limit')),'onchange="submit()" class="form-control input-sm"')?> 
				</div>
				<div class="form-group">
					<?php echo form_input(array('name'=>'search','value'=>$this->input->get('search'),'autocomplete'=>'off','placeholder'=>'Search..','onchange=>"submit()"','class'=>'form-control input-sm'))?>
				</div>
				<div class="form-group">
					<?php echo form_dropdown('status',campaign_status_dropdown(),set_value('status',$this->input->get('status')),'class="form-control input-sm" onchange="submit()"')?>
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


