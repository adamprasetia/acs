<section class="content-header">
	<h1>
		Report Calculate Filter
		<small>Calculate Data Individual Selection</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li class="active">Report Calculate Filter</li>
	</ol>
</section>

<section class="content">
	<?=$this->session->flashdata('alert')?>
	<?=$action?>
	<div class="box">
		<div class="box-body">
			<div class="form-group form-inline">
				<?=form_label('Campaign','campaign_id',array('class'=>'control-label'))?>
				<?=form_dropdown('campaign_id',$this->mdl_campaign->dropdown(),set_value('campaign_id',$this->input->get('campaign_id')),'class="form-control input-sm" autofocus')?>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Sex','sex',array('class'=>'control-label'))?>
				<?=form_dropdown('sex',$this->mdl_individual->dropdown('sex'),set_value('sex',$this->input->get('sex')),'class="form-control input-sm" autofocus')?>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Source Type','source_type',array('class'=>'control-label'))?>
				<?=form_dropdown('source_type',$this->mdl_individual->dropdown('source_type'),set_value('source_type',$this->input->get('source_type')),'class="form-control input-sm" autofocus')?>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Survey Date','survey_date_from',array('class'=>'control-label'))?>
				<?=form_input(array('name'=>'survey_date_from','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('survey_date_from',$this->input->get('survey_date_from'))))?>
				<?=form_input(array('name'=>'survey_date_to','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('survey_date_to',$this->input->get('survey_date_to'))))?>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Upload Date','upload_date_from',array('class'=>'control-label'))?>
				<?=form_input(array('name'=>'upload_date_from','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('upload_date_from',$this->input->get('upload_date_from'))))?>
				<?=form_input(array('name'=>'upload_date_to','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('upload_date_to',$this->input->get('upload_date_to'))))?>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Entry Date','entry_date_from',array('class'=>'control-label'))?>
				<?=form_input(array('name'=>'entry_date_from','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('entry_date_from',$this->input->get('entry_date_from'))))?>
				<?=form_input(array('name'=>'entry_date_to','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('entry_date_to',$this->input->get('entry_date_to'))))?>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Verification Date','verifikasi_date_from',array('class'=>'control-label'))?>
				<?=form_input(array('name'=>'verifikasi_date_from','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('verifikasi_date_from',$this->input->get('verifikasi_date_from'))))?>
				<?=form_input(array('name'=>'verifikasi_date_to','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('verifikasi_date_to',$this->input->get('verifikasi_date_to'))))?>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Status Verification','status_verifikasi',array('class'=>'control-label'))?>
				<?=form_dropdown('status_verifikasi',$this->mdl_individual->dropdown('status_verifikasi'),set_value('status_verifikasi',$this->input->get('status_verifikasi')),'class="form-control input-sm" autofocus')?>
			</div>
			<div class="form-group form-inline">
				<?=form_label('Week Start','week',array('class'=>'control-label'))?>
				<?=form_dropdown('week',array('6'=>'Senin','5'=>'Selasa','4'=>'Rabu','3'=>'Kamis','2'=>'Jumat','1'=>'Sabtu','0'=>'Minggu'),set_value('week',$this->input->get('week')),'class="form-control input-sm"')?>
			</div>			
		</div>
		<div class="box-footer">
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-filter"></span> Filter</button>
		</div>
	</div>
	<?=form_close()?>
</section>
