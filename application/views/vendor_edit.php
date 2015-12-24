<section class="content-header">
	<h1>
		Vendor
		<small>Alliance Management</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li><?=anchor($breadcrumb,'Vendor Management')?></li>
		<li class="active"><?=$heading?></li>
	</ol>
</section>

<section class="content">
	<?=$this->session->flashdata('alert')?>
	<?=$action?>
	<div class="box box-default">
		<div class="box-header owner"><?=$owner?></div>
		<div class="box-body">
			<div class="form-group form-inline">
				<?=form_label('Vendor Name','name',array('class'=>'control-label'))?>
				<?=form_input(array('name'=>'name','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('name',(isset($row->name)?$row->name:'')),'required'=>'required','autofocus'=>'autofocus'))?>
				<small><?=form_error('name')?></small>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Address','address',array('class'=>'control-label'))?>
				<?=form_textarea(array('name'=>'address','class'=>'form-control input-sm','rows'=>'3','cols'=>'40','autocomplete'=>'off','value'=>set_value('address',(isset($row->address)?$row->address:''))))?>
				<small><?=form_error('address')?></small>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Telephone','tlp',array('class'=>'control-label'))?>
				<?=form_input(array('name'=>'tlp','class'=>'form-control input-sm','maxlength'=>'50','size'=>'30','autocomplete'=>'off','value'=>set_value('tlp',(isset($row->tlp)?$row->tlp:''))))?>
				<small><?=form_error('tlp')?></small>
			</div>
		</div>
		<div class="box-footer">
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span> Save</button>
		</div>
	</div>
	<?=form_close()?>
</section>
