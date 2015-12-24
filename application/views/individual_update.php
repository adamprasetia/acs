<section class="content-header">
	<h1>
		Individual Update
		<small>Update Existing Adult Smokers</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li><?=anchor($breadcrumb,'Individual Management')?></li>
		<li class="active">Individual Update</li>
	</ol>
</section>

<section class="content">
	<?=$this->session->flashdata('alert')?>
	<?=form_open_multipart('individual/update')?>
	<div class="box">
		<div class="box-body">
			<div class="form-group form-inline">
				<?=form_label('File Excel 2007(*.xlsx)','userfile',array('class'=>'control-label'))?>
				<?=form_upload(array('name'=>'userfile','class'=>'form-control'))?>
				<small><?=form_error('userfile')?></small>
			</div>
		</div>
		<div class="box-footer">
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-import"></span> Update</button>
			&nbsp;|&nbsp;<?php echo anchor(base_url().'files/TEMPLATE_INDIVIDUAL_UPDATE.xlsx','Download Template');?>
		</div>
	</div>
	<?=form_close()?>
</section>
