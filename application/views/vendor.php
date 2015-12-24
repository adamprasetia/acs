<section class="content-header">
	<h1>
		Vendor
		<small>Alliance Management</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li class="active">Alliance</li>
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
					<?=form_input(array('name'=>'search','value'=>$this->input->get('search'),'autocomplete'=>'off','placeholder'=>'Search..','onchange=>"submit()"','class'=>'form-control input-sm'))?>
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
			</div>
		</div>
	</div>
</section>


