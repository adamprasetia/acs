<section class="content-header">
	<h1>
		Barang Keluar
		<small>Merchandise Management</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li class="active">Barang Keluar</li>
	</ol>
</section>
<section class="content">
	<?=$this->session->flashdata('alert')?>
	<div class="box">
		<?=form_open($action_add)?>
		<div class="box-body">
			<div class="row">
				<div class="col-md-7">
					<div class="form-group form-inline">
						<?=form_label('Nama Barang','barang_id',array('class'=>'control-label'))?>
						<?=form_dropdown('barang_id',$this->mdl_barang->dropdown(),set_value('barang_id',(isset($row->barang_id)?$row->barang_id:'')),'required=required class="form-control input-sm"')?>
						<small><?=form_error('barang_id')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Tanggal','tanggal',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'tanggal','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'20','autocomplete'=>'off','value'=>set_value('tanggal',(isset($row->tanggal)?format_tanggal($row->tanggal):'')),'required'=>'required'))?>
						<small><?=form_error('tanggal')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Banyak','banyak',array('class'=>'control-label'))?>
						<?=form_input(array('id'=>'banyak','name'=>'banyak','class'=>'form-control input-sm','maxlength'=>'50','size'=>'10','autocomplete'=>'off','value'=>set_value('banyak',(isset($row->banyak)?$row->banyak:'')),'required'=>'required'))?>
						<small><?=form_error('banyak')?></small>
					</div>				
				</div>
				<div class="col-md-5">
					<div class="form-group form-inline">
						<?=form_label('Vendor','vendor_id',array('class'=>'control-label'))?>
						<?=form_dropdown('vendor_id',$this->mdl_vendor->dropdown(),set_value('vendor_id',(isset($row->vendor_id)?$row->vendor_id:'')),'class="form-control input-sm"')?>
						<small><?=form_error('vendor_id')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Operator','operator',array('class'=>'control-label'))?>
						<?=form_input(array('id'=>'operator','name'=>'operator','class'=>'form-control input-sm','maxlength'=>'50','size'=>'30','autocomplete'=>'off','value'=>set_value('operator',(isset($row->operator)?$row->operator:''))))?>
						<small><?=form_error('operator')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Keterangan','keterangan',array('class'=>'control-label'))?>
						<?=form_input(array('id'=>'keterangan','name'=>'keterangan','class'=>'form-control input-sm','maxlength'=>'50','size'=>'30','autocomplete'=>'off','value'=>set_value('keterangan',(isset($row->keterangan)?$row->keterangan:''))))?>
						<small><?=form_error('keterangan')?></small>
					</div>				
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span> Add</button>
		</div>
		<?=form_close()?>	
	</div>
	<div class="box">
		<div class="box-body">
			<?=form_open($action,array('class'=>'form-inline'))?>
				<div class="form-group">
					<?=form_label('Show entries','limit')?>
					<?=form_dropdown('limit',array('10'=>'10','50'=>'50','100'=>'100'),set_value('limit',$this->input->get('limit')),'onchange="submit()" class="form-control input-sm"')?> 
				</div>
				<div class="form-group">
					<?=form_input(array('name'=>'search','value'=>$this->input->get('search'),'autocomplete'=>'off','placeholder'=>'Search..','onchange=>"submit()"','class'=>'form-control input-sm'))?>
				</div>
				<div class="form-group">
					<?=form_dropdown('campaign_id',$this->mdl_campaign->dropdown(),set_value('campaign_id',$this->input->get('campaign_id')),'class="form-control input-sm" onchange="submit()"')?>
				</div>
				<div class="form-group">
					<?=form_input(array('name'=>'tanggal_from','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','placeholder'=>'From','autocomplete'=>'off','value'=>set_value('tanggal_from',$this->input->get('tanggal_from'))))?>
					<?=form_input(array('name'=>'tanggal_to','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','placeholder'=>'To','autocomplete'=>'off','value'=>set_value('tanggal_to',$this->input->get('tanggal_to'))))?>
				</div>
				<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-filter"></span> Filter</button>
			<?=form_close()?>
			<div class="table-responsive">
				<table class="table">
					<?=$table?>
				</table>
			</div>
			<div class="form-inline">
				<div class="form-group">
					<?=form_label($total)?>
				</div>
				<div class="pull-right">
					<?=$pagination?>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<?=$export_btn?>
		</div>
	</div>
</section>


