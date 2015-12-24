<section class="content-header">
	<h1>
		Barang Masuk
		<small>Merchandise Management</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li><?=anchor($breadcrumb,'Barang Masuk Management')?></li>
		<li class="active"><?=$heading?></li>
	</ol>
</section>

<section class="content">
	<?=$this->session->flashdata('alert')?>
	<?=$action?>
	<div class="box">
		<div class="box-header owner"><?=$owner?></div>
		<div class="box-body">
			<div class="form-group form-inline">
				<?=form_label('Nama Barang','barang_id',array('class'=>'control-label'))?>
				<?=form_dropdown('barang_id',$this->mdl_barang->dropdown(),set_value('barang_id',(isset($row->barang_id)?$row->barang_id:'')),'required=required class="form-control input-sm"')?>
				<small><?=form_error('barang_id')?></small>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Tanggal','tanggal',array('class'=>'control-label'))?>
				<?=form_input(array('name'=>'tanggal','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'40','autocomplete'=>'off','value'=>set_value('tanggal',(isset($row->tanggal)?format_tanggal($row->tanggal):'')),'required'=>'required'))?>
				<small><?=form_error('tanggal')?></small>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Banyak','banyak',array('class'=>'control-label'))?>
				<?=form_input(array('id'=>'banyak','name'=>'banyak','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('banyak',(isset($row->banyak)?$row->banyak:'')),'required'=>'required'))?>
				<small><?=form_error('banyak')?></small>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Vendor','vendor_id',array('class'=>'control-label'))?>
				<?=form_dropdown('vendor_id',$this->mdl_vendor->dropdown(),set_value('vendor_id',(isset($row->vendor_id)?$row->vendor_id:'')),'class="form-control input-sm"')?>
				<small><?=form_error('vendor_id')?></small>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Operator','operator',array('class'=>'control-label'))?>
				<?=form_input(array('id'=>'operator','name'=>'operator','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('operator',(isset($row->operator)?$row->operator:''))))?>
				<small><?=form_error('operator')?></small>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Keterangan','keterangan',array('class'=>'control-label'))?>
				<?=form_input(array('id'=>'keterangan','name'=>'keterangan','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('keterangan',(isset($row->keterangan)?$row->keterangan:''))))?>
				<small><?=form_error('keterangan')?></small>
			</div>
		</div>
		<div class="box-footer">
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span> Save</button>
		</div>
	</div>
	<?=form_close()?>
</section>
