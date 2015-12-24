<section class="content-header">
	<h1>
		Change Password
		<small>Change user password</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li class="active"><?=$heading?></li>
	</ol>
</section>

<section class="content">
	<?=$this->session->flashdata('alert')?>
	<?=$action?>
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group form-inline">
				<?=form_label('New Password','new_password',array('class'=>'control-label'))?>
				<?=form_password(array('name'=>'new_password','class'=>'form-control input-sm','maxlength'=>'50','autocomplete'=>'off','value'=>set_value('new_password',''),'required'=>'required','autofocus'=>'autofocus'))?>
				<small><?=form_error('new_password')?></small>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Confirm Password','con_password',array('class'=>'control-label'))?>
				<?=form_password(array('name'=>'con_password','class'=>'form-control input-sm','maxlength'=>'50','autocomplete'=>'off','value'=>set_value('con_password',''),'required'=>'required'))?>
				<small><?=form_error('con_password')?></small>
			</div>
		</div>
		<div class="panel-footer">
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span> Save</button>
		</div>
	</div>
	<?=form_close()?>
</section>
