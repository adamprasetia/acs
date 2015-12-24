<section class="content-header">
	<h1>
		Barang
		<small>Management Merchandise</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li><?=anchor($breadcrumb,'Management Barang')?></li>
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
				<?=form_label('Nama Barang','name',array('class'=>'control-label'))?>
				<?=form_input(array('name'=>'name','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('name',(isset($row->name)?$row->name:'')),'required'=>'required','autofocus'=>'autofocus'))?>
				<small><?=form_error('name')?></small>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Campaign','campaign_id',array('class'=>'control-label'))?>
				<?=form_dropdown('campaign_id',$this->mdl_campaign->dropdown(),set_value('campaign_id',(isset($row->campaign_id)?$row->campaign_id:'')),'required=required class="form-control input-sm"')?>
				<small><?=form_error('campaign_id')?></small>
			</div>
		</div>
		<div class="box-footer">
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span> Save</button>
		</div>
	</div>
	<?=form_close()?>
</section>
