<section class="content-header">
	<h1>
		Individual Import
		<small>Import New Adult Smokers</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li><?=anchor($breadcrumb,'Individual Management')?></li>
		<li class="active">Individual Import</li>
	</ol>
</section>

<section class="content">
	<?=$this->session->flashdata('alert')?>
	<?=form_open_multipart('individual/import')?>
	<div class="box">
		<div class="box-body">
			<div class="form-group form-inline">
				<?=form_label('Campaign','campaign_id',array('class'=>'control-label'))?>
				<?=form_dropdown('campaign_id',$this->mdl_campaign->dropdown(),set_value('campaign_id',(isset($row->campaign_id)?$row->campaign_id:'')),'required=required class="form-control input-sm" autofocus')?>
				<small><?=form_error('campaign_id')?></small>
			</div>
			<div class="form-group form-inline">
				<?=form_label('File Excel 2007(*.xlsx)','userfile',array('class'=>'control-label'))?>
				<?=form_upload(array('name'=>'userfile','class'=>'form-control'))?>
			</div>
		</div>
		<div class="box-footer">
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-import"></span> Import</button>
			&nbsp;|&nbsp;<?php echo anchor(base_url().'files/TEMPLATE_INDIVIDUAL_IMPORT.xlsx','Download Template');?>
		</div>
	</div>
	<?=form_close()?>
</section>
