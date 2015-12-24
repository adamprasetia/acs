<section class="content-header">
	<h1>
		Individual
		<small>Adult Smokers Management</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li><?=anchor($breadcrumb,'Individual Filter')?></li>
		<li class="active">Individual</li>
	</ol>
</section>
<section class="content">
	<?=$this->session->flashdata('alert')?>
	<div class="box">
		<div class="box-body">
			<?=form_open($action,array('class'=>'form-inline'))?>
				<div class="form-group">
					<?=form_label('Show entries','limit')?>
					<?=form_dropdown('limit',array('10'=>'10','50'=>'50','100'=>'100'),set_value('limit',$this->input->get('limit')),'onchange="submit()" class="form-control input-sm"')?> 
				</div>
				<div class="form-group">
					<?=form_input(array('name'=>'search','value'=>$this->input->get('search'),'size'=>'40','autocomplete'=>'off','placeholder'=>'Search..','onchange=>"submit()"','class'=>'form-control input-sm'))?>
				</div>
				<div class="form-group">
					<?=form_dropdown('campaign_id',$this->mdl_campaign->dropdown(),set_value('campaign_id',$this->input->get('campaign_id')),'class="form-control input-sm" onchange="submit()"')?>
				</div>				
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
			<?=$add_btn?>
			<div class="pull-right">
				<?=$export_btn?>
				<?=$export_xls_btn?>
			</div>
		</div>
	</div>
</section>


