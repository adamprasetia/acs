<section class="content-header">
	<h1>
		Campaign
		<small>Campaign/Event Management</small>
	</h1>
	<ol class="breadcrumb">
		<li><?php echo anchor('dashboard','Dashboard')?></li>
		<li><?php echo anchor($breadcrumb,'Campaign Management')?></li>
		<li class="active"><?php echo $heading?></li>
	</ol>
</section>

<section class="content">
	<?php echo $this->session->flashdata('alert')?>
	<?php echo $action?>
	<div class="box">
		<div class="box-header owner"><?php echo $owner?></div>
		<div class="box-body">
			<div class="form-group form-inline">
				<?php echo form_label('Campaign','name',array('class'=>'control-label'))?>
				<?php echo form_input(array('name'=>'name','class'=>'form-control input-sm','maxlength'=>'50','size'=>'50','autocomplete'=>'off','value'=>set_value('name',(isset($row->name)?$row->name:'')),'required'=>'required','autofocus'=>'autofocus'))?>
				<small><?php echo form_error('name')?></small>
			</div>
			<div class="form-group form-inline">
				<?php echo form_label('Brand','brand',array('class'=>'control-label'))?>
				<?php echo form_input(array('name'=>'brand','class'=>'form-control input-sm','maxlength'=>'50','size'=>'50','autocomplete'=>'off','value'=>set_value('brand',(isset($row->brand)?$row->brand:'')),'required'=>'required'))?>
				<small><?php echo form_error('brand')?></small>
			</div>
			<div class="form-group form-inline">
				<?php echo form_label('Start','start',array('class'=>'control-label'))?>
				<?php echo form_input(array('name'=>'start','class'=>'form-control input-sm tanggal','maxlength'=>'10','autocomplete'=>'off','value'=>set_value('start',(isset($row->start)?format_tanggal($row->start):'')),'required'=>'required'))?>
				<small><?php echo form_error('start')?></small>
			</div>
			<div class="form-group form-inline">
				<?php echo form_label('End','end',array('class'=>'control-label'))?>
				<?php echo form_input(array('name'=>'end','class'=>'form-control input-sm tanggal','maxlength'=>'10','autocomplete'=>'off','value'=>set_value('end',(isset($row->end)?format_tanggal($row->end):'')),'required'=>'required'))?>
				<small><?php echo form_error('end')?></small>
			</div>
			<div class="form-group form-inline">
				<?php echo form_label('Status','status',array('class'=>'control-label'))?>
				<?php echo form_dropdown('status',campaign_status_dropdown(),set_value('status',(isset($row->status)?$row->status:'')),'required=required class="form-control input-sm"')?>
				<small><?php echo form_error('status')?></small>
			</div>
		</div>
		<div class="box-footer">
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span> Save</button>
			<?php echo anchor($breadcrumb,'<span class="glyphicon glyphicon-repeat"></span> Back',array('class'=>'btn btn-danger btn-sm'))?>
		</div>
	</div>
	<?php echo form_close()?>
</section>
