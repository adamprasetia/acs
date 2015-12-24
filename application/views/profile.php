<section class="content-header">
	<h1>
		Profile
		<small>User Profile</small>
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
			<div class="row">
				<div class="col-md-2">
					<?=$this->template->get_user_image((isset($row->photo)?$row->photo:''),'img-responsive')?>
				</div>	
				<div class="col-md-2">
					<div class="form-group form-inline">
						<?=form_label('Fullname','fullname',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'fullname','class'=>'form-control input-sm','maxlength'=>'50','autocomplete'=>'off','value'=>set_value('fullname',(isset($row->fullname)?$row->fullname:'')),'required'=>'required','autofocus'=>'autofocus'))?>
						<small><?=form_error('fullname')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Photo','userfile',array('class'=>'control-label'))?>
						<?=form_upload(array('name'=>'userfile','class'=>'form-control'))?>
					</div>
				</div>	
			</div>	
		</div>
		<div class="panel-footer">
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span> Save</button>
		</div>
	</div>
	<?=form_close()?>
</section>
