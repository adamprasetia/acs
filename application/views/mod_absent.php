<section class="content-header">
	<h1>
		Absent
		<small>Absent Moderation</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li class="active">Absent</li>
	</ol>
</section>
<section class="content">
	<?=$this->session->flashdata('alert')?>
	<?=form_open($action,array('class'=>'form-inline'))?>
		<div class="box">
			<div class="box-body">
					<div class="form-group">
						<?=form_label('Date','date')?>
						<?=form_input(array('name'=>'date_from','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('date_from',$this->input->get('date_from'))))?>
						<?=form_input(array('name'=>'date_to','class'=>'form-control input-sm tanggal','maxlength'=>'10','size'=>'15','autocomplete'=>'off','value'=>set_value('date_to',$this->input->get('date_to'))))?>
					</div>
					<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-filter"></span> Filter</button>
			</div>
		</div>
	<?=form_close()?>
	<?=form_open($action_update,array('class'=>'form-inline'))?>
		<div class="box">
			<div class="box-body">
				<div class="table-responsive">
					<?=$table?>
				</div>
			</div>
			<div class="box-footer">
				<button class="btn btn-primary btn-sm" type="submit" onclick="return confirm('Are you sure')"><span class="glyphicon glyphicon-save"></span> Save</button>
				<?=$auto_btn?>
				<?=$fee_btn?>
				<?=$fee_senior_btn?>
				<div class="pull-right">
					<?=$clear_btn?>
				</div>
			</div>
		</div>
	<?=form_close()?>
</section>


