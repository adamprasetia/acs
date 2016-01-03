<section class="content-header">
	<h1>
		Individual
		<small>Adult Smokers Management</small>
	</h1>
	<ol class="breadcrumb">
		<li><?php echo anchor('dashboard','Dashboard')?></li>
		<li><?php echo anchor($breadcrumb,'Individual Management')?></li>
		<li class="active"><?php echo $heading?></li>
	</ol>
</section>

<section class="content">
	<?php echo $this->session->flashdata('alert')?>
	<?php echo $action?>
	<div class="box box-default">
		<div class="box-header owner"><?php echo $owner?></div>
		<div class="box-body">
			<div class="form-group form-inline">
				<?php echo form_label('Campaign','campaign_id',array('class'=>'control-label'))?>
				<?php echo form_dropdown('campaign_id',$this->mdl_campaign->dropdown(),set_value('campaign_id',(isset($row->campaign_id)?$row->campaign_id:'')),'required=required class="form-control input-sm" autofocus')?>
				<small><?php echo form_error('campaign_id')?></small>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group form-inline">
						<?php echo form_label('MOP ID','mop_id',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'mop_id','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('mop_id',(isset($row->mop_id)?$row->mop_id:''))))?>
						<small><?php echo form_error('mop_id')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Firstname','firstname',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'firstname','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('firstname',(isset($row->firstname)?$row->firstname:'')),'required'=>'required'))?>
						<small><?php echo form_error('firstname')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Lastname','lastname',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'lastname','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','size'=>'40','autocomplete'=>'off','value'=>set_value('lastname',(isset($row->lastname)?$row->lastname:''))))?>
						<small><?php echo form_error('lastname')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Nickname','nickname',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'nickname','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('nickname',(isset($row->nickname)?$row->nickname:''))))?>
						<small><?php echo form_error('nickname')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Sex','sex',array('class'=>'control-label'))?>
						<?php echo form_input(array('id'=>'sex','name'=>'sex','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('sex',(isset($row->sex)?$row->sex:'')),'required'=>'required'))?>
						<small><?php echo form_error('sex')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Date of Birth','dob',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'dob','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'40','autocomplete'=>'off','value'=>set_value('dob',(isset($row->dob)?format_tanggal($row->dob):'')),'required'=>'required'))?>
						<small><?php echo form_error('dob')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('ID Type','id_type',array('class'=>'control-label'))?>
						<?php echo form_input(array('id'=>'id_type','name'=>'id_type','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('id_type',(isset($row->id_type)?$row->id_type:''))))?>
						<small><?php echo form_error('id_type')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('ID Number','id_number',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'id_number','class'=>'form-control input-sm','maxlength'=>'20','size'=>'40','autocomplete'=>'off','value'=>set_value('id_number',(isset($row->id_number)?$row->id_number:'')),'required'=>'required'))?>
						<small><?php echo form_error('id_number')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Telephone','tlp',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'tlp','class'=>'form-control input-sm','maxlength'=>'20','size'=>'40','autocomplete'=>'off','value'=>set_value('tlp',(isset($row->tlp)?$row->tlp:''))))?>
						<small><?php echo form_error('tlp')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Email','email',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'email','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('email',(isset($row->email)?$row->email:'')),'required'=>'required'))?>
						<small><?php echo form_error('email')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Facebook','fb',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'fb','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('fb',(isset($row->fb)?$row->fb:''))))?>
						<small><?php echo form_error('fb')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Twitter','tw',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'tw','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('tw',(isset($row->tw)?$row->tw:''))))?>
						<small><?php echo form_error('tw')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Address','address',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'address','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('address',(isset($row->address)?$row->address:''))))?>
						<small><?php echo form_error('address')?></small>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group form-inline">
						<?php echo form_label('City','city',array('class'=>'control-label'))?>
						<?php echo form_input(array('id'=>'city','name'=>'city','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('city',(isset($row->city)?$row->city:''))))?>
						<small><?php echo form_error('city')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Pos Code','pos_code',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'pos_code','class'=>'form-control input-sm','maxlength'=>'5','size'=>'40','autocomplete'=>'off','value'=>set_value('pos_code',(isset($row->pos_code)?$row->pos_code:''))))?>
						<small><?php echo form_error('pos_code')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Curr Brand','brand',array('class'=>'control-label'))?>
						<?php echo form_input(array('id'=>'brand','name'=>'brand','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('brand',(isset($row->brand)?$row->brand:'')),'required'=>'required'))?>
						<small><?php echo form_error('brand')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Sec Brand','brand_',array('class'=>'control-label'))?>
						<?php echo form_input(array('id'=>'brand_','name'=>'brand_','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('brand_',(isset($row->brand_)?$row->brand_:''))))?>
						<small><?php echo form_error('brand_')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Source Type','source_type',array('class'=>'control-label'))?>
						<?php echo form_input(array('id'=>'source_type','name'=>'source_type','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('source_type',(isset($row->source_type)?$row->source_type:'')),'required'=>'required'))?>
						<small><?php echo form_error('source_type')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Source User','source_user',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'source_user','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('source_user',(isset($row->source_user)?$row->source_user:''))))?>
						<small><?php echo form_error('source_user')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Survey Date','survey_date',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'survey_date','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'40','autocomplete'=>'off','value'=>set_value('survey_date',(isset($row->survey_date)?format_tanggal($row->survey_date):''))))?>
						<small><?php echo form_error('survey_date')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Upload Date','upload_date',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'upload_date','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'40','autocomplete'=>'off','value'=>set_value('upload_date',(isset($row->upload_date)?format_tanggal($row->upload_date):''))))?>
						<small><?php echo form_error('upload_date')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Entry Date','entry_date',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'entry_date','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'40','autocomplete'=>'off','value'=>set_value('entry_date',(isset($row->entry_date)?format_tanggal($row->entry_date):''))))?>
						<small><?php echo form_error('entry_date')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Verification Date','verifikasi_date',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'verifikasi_date','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'40','autocomplete'=>'off','value'=>set_value('verifikasi_date',(isset($row->verifikasi_date)?format_tanggal($row->verifikasi_date):''))))?>
						<small><?php echo form_error('verifikasi_date')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Referred by','referred',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'referred','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('referred',(isset($row->referred)?$row->referred:''))))?>
						<small><?php echo form_error('referred')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('DRN Number','drn_number',array('class'=>'control-label'))?>
						<?php echo form_input(array('name'=>'drn_number','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('drn_number',(isset($row->drn_number)?$row->drn_number:''))))?>
						<small><?php echo form_error('drn_number')?></small>
					</div>
					<div class="form-group form-inline">
						<?php echo form_label('Status Verification','status_verifikasi',array('class'=>'control-label'))?>
						<?php echo form_input(array('id'=>'status_verifikasi','name'=>'status_verifikasi','class'=>'form-control input-sm','maxlength'=>'50','size'=>'40','autocomplete'=>'off','value'=>set_value('status_verifikasi',(isset($row->status_verifikasi)?$row->status_verifikasi:'')),'required'=>'required'))?>
						<small><?php echo form_error('status_verifikasi')?></small>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer">
			<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span> Save</button>
			<?php echo anchor($breadcrumb,'<span class="glyphicon glyphicon-repeat"></span> Back',array('class'=>'btn btn-danger btn-sm'))?>
		</div>
	</div>
	<?php echo form_close()?>
</section>
