<section class="content-header">
	<h1>
		Report ONLINE
		<small>Calculate Data</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li><?=anchor($breadcrumb,'Filter')?></li>
		<li class="active">Report</li>
	</ol>
</section>
<section class="content">
	<?=$this->session->flashdata('alert')?>
	<?=$heading?>
	<div class="box">
		<div class="box-body">
			<?=form_open($action,array('class'=>'form-inline'))?>
				<div class="form-group">
					<?=form_dropdown('campaign_id',$this->mdl_campaign->dropdown(),set_value('campaign_id',$this->input->get('campaign_id')),'class="form-control input-sm" onchange="submit()"')?>
				</div>				
				<div class="form-group">
					<?=form_input(array('name'=>'entry_date_from','placeholder'=>'From','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('entry_date_from',$this->input->get('entry_date_from'))))?>
					<?=form_input(array('name'=>'entry_date_to','placeholder'=>'To','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('entry_date_to',$this->input->get('entry_date_to'))))?>
				</div>
				<div class="form-group form-inline">
					<?=form_dropdown('week',array('6'=>'Senin','5'=>'Selasa','4'=>'Rabu','3'=>'Kamis','2'=>'Jumat','1'=>'Sabtu','0'=>'Minggu'),set_value('week',$this->input->get('week')),'class="form-control input-sm" onchange="submit()"')?>
				</div>
				<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-filter"></span> Filter</button>
			<?=form_close()?>
			<div class="table-responsive">
				<?=$table?>
			</div>
		</div>
		<div class="box-footer">
			<?=$export_btn?>
		</div>
	</div>
</section>


