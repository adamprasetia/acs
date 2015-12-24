<section class="content-header">
	<h1>
		Individual Filter
		<small>Adult Smokers Management Selection</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li><?=anchor($breadcrumb,'Individual Management')?></li>
		<li class="active">Individual Filter</li>
	</ol>
</section>

<section class="content">
	<?=$this->session->flashdata('alert')?>
	<?=$action?>
	<div class="box">
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group form-inline">
						<?=form_label('Campaign','campaign_id',array('class'=>'control-label'))?>
						<?=form_dropdown('campaign_id',$this->mdl_campaign->dropdown(),set_value('campaign_id',$this->input->get('campaign_id')),'class="form-control input-sm" autofocus')?>
						<small><?=form_error('campaign_id')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Individual Code','individual_code',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'individual_code','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('individual_code',$this->input->get('individual_code'))))?>
						<small><?=form_error('individual_code')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('MOP ID','mop_id',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'mop_id','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('mop_id',$this->input->get('mop_id'))))?>
						<small><?=form_error('mop_id')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Firstname','firstname',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'firstname','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('firstname',$this->input->get('firstname'))))?>
						<small><?=form_error('firstname')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Lastname','lastname',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'lastname','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','size'=>'40','autocomplete'=>'off','value'=>set_value('lastname',$this->input->get('lastname'))))?>
						<small><?=form_error('lastname')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Nickname','nickname',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'nickname','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('nickname',$this->input->get('nickname'))))?>
						<small><?=form_error('nickname')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Sex','sex',array('class'=>'control-label'))?>
						<?=form_dropdown('sex',$this->mdl_individual->dropdown('sex'),set_value('sex',$this->input->get('sex')),'class="form-control input-sm"')?>
						<small><?=form_error('sex')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Date of Birth','dob_from',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'dob_from','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('dob_from',$this->input->get('dob_from'))))?>
						<?=form_input(array('name'=>'dob_to','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('dob_to',$this->input->get('dob_to'))))?>
						<small><?=form_error('dob_from')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('ID Type','id_type',array('class'=>'control-label'))?>
						<?=form_dropdown('id_type',$this->mdl_individual->dropdown('id_type'),set_value('id_type',$this->input->get('id_type')),'class="form-control input-sm"')?>
						<small><?=form_error('id_type')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('ID Number','id_number',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'id_number','class'=>'form-control input-sm','maxlength'=>'20','size'=>'40','autocomplete'=>'off','value'=>set_value('id_number',$this->input->get('id_number'))))?>
						<small><?=form_error('id_number')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Telephone','tlp',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'tlp','class'=>'form-control input-sm','maxlength'=>'20','size'=>'40','autocomplete'=>'off','value'=>set_value('tlp',$this->input->get('tlp'))))?>
						<small><?=form_error('tlp')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Email','email',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'email','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('email',$this->input->get('email'))))?>
						<small><?=form_error('email')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Facebook','fb',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'fb','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('fb',$this->input->get('fb'))))?>
						<small><?=form_error('fb')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Twitter','tw',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'tw','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('tw',$this->input->get('tw'))))?>
						<small><?=form_error('tw')?></small>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-inline">
						<?=form_label('Address','address',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'address','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('address',$this->input->get('address'))))?>
						<small><?=form_error('address')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('City','city',array('class'=>'control-label'))?>
						<?=form_dropdown('city',$this->mdl_individual->dropdown('city'),set_value('city',$this->input->get('city')),'class="form-control input-sm"')?>
						<small><?=form_error('city')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Pos Code','pos_code',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'pos_code','class'=>'form-control input-sm','maxlength'=>'5','size'=>'40','autocomplete'=>'off','value'=>set_value('pos_code',$this->input->get('pos_code'))))?>
						<small><?=form_error('pos_code')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Curr Brand','brand',array('class'=>'control-label'))?>
						<?=form_dropdown('brand',$this->mdl_individual->dropdown('brand'),set_value('brand',$this->input->get('brand')),'class="form-control input-sm"')?>
						<small><?=form_error('brand')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Sec Brand','brand_',array('class'=>'control-label'))?>
						<?=form_dropdown('brand_',$this->mdl_individual->dropdown('brand_'),set_value('brand_',$this->input->get('brand_')),'class="form-control input-sm"')?>
						<small><?=form_error('brand_')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Source Type','source_type',array('class'=>'control-label'))?>
						<?=form_dropdown('source_type',$this->mdl_individual->dropdown('source_type'),set_value('source_type',$this->input->get('source_type')),'class="form-control input-sm"')?>
						<small><?=form_error('source_type')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Source User','source_user',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'source_user','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('source_user',$this->input->get('source_user'))))?>
						<small><?=form_error('source_user')?></small>
					</div>

					<div class="form-group form-inline">
						<?=form_label('Survey Date','survey_date_from',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'survey_date_from','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('survey_date_from',$this->input->get('survey_date_from'))))?>
						<?=form_input(array('name'=>'survey_date_to','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('survey_date_to',$this->input->get('survey_date_to'))))?>
						<small><?=form_error('survey_date_from')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Upload Date','upload_date_from',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'upload_date_from','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('upload_date_from',$this->input->get('upload_date_from'))))?>
						<?=form_input(array('name'=>'upload_date_to','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('upload_date_to',$this->input->get('upload_date_to'))))?>
						<small><?=form_error('upload_date_from')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Entry Date','entry_date_from',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'entry_date_from','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('entry_date_from',$this->input->get('entry_date_from'))))?>
						<?=form_input(array('name'=>'entry_date_to','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('entry_date_to',$this->input->get('entry_date_to'))))?>
						<small><?=form_error('entry_date_from')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Verification Date','verifikasi_date_from',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'verifikasi_date_from','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('verifikasi_date_from',$this->input->get('verifikasi_date_from'))))?>
						<?=form_input(array('name'=>'verifikasi_date_to','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('verifikasi_date_to',$this->input->get('verifikasi_date_to'))))?>
						<small><?=form_error('verifikasi_date_from')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Referred by','referred',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'referred','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('referred',$this->input->get('referred'))))?>
						<small><?=form_error('referred')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('DRN Number','drn_number',array('class'=>'control-label'))?>
						<?=form_input(array('name'=>'drn_number','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('drn_number',$this->input->get('drn_number'))))?>
						<small><?=form_error('drn_number')?></small>
					</div>
					<div class="form-group form-inline">
						<?=form_label('Status Verification','status_verifikasi',array('class'=>'control-label'))?>
						<?=form_dropdown('status_verifikasi',$this->mdl_individual->dropdown('status_verifikasi'),set_value('status_verifikasi',$this->input->get('status_verifikasi')),'class="form-control input-sm"')?>
						<small><?=form_error('status_verifikasi')?></small>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-filter"></span> Filter</button>
		</div>
	</div>
	<?=form_close()?>
</section>
