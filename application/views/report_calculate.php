<section class="content-header">
	<h1>
		Report Calculate
		<small>Calculate Data Individual</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li><?=anchor($breadcrumb,'Report Calculate Filter')?></li>
		<li class="active">Report Calculate</li>
	</ol>
</section>
<section class="content">
	<?=$this->session->flashdata('alert')?>
	<?=$heading?>
	<div class="box">
		<div class="box-body">
			<div class="table-responsive">
				<?=$table?>
			</div>
		</div>
		<div class="box-footer">
			<?=$export_btn?>
		</div>
	</div>
</section>

