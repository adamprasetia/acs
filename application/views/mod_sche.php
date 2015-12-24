<section class="content-header">
	<h1>
		Schedule
		<small>Schedule Management</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li class="active">Schedule</li>
	</ol>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">Hari Ini : <?=date('d F Y')?></div>
		<div class="box-body">
			<div class="table-responsive">
				<?=$table_sekarang?>
			</div>
		</div>
	</div>
	<div class="box">
		<div class="box-header">Bulan Lalu : <?=date('F Y',strtotime('first day of last month'))?></div>
		<div class="box-body">
			<div class="table-responsive">
				<?=$table_bulan_lalu?>
			</div>
		</div>
	</div>
	<div class="box">
		<div class="box-header">Bulan Ini : <?=date('F Y')?></div>
		<div class="box-body">
			<div class="table-responsive">
				<?=$table_bulan_ini?>
			</div>
		</div>
	</div>
	<div class="box">
		<div class="box-header">Bulan Depan : <?=date('F Y',strtotime('first day of next month'))?></div>
		<div class="box-body">
			<div class="table-responsive">
				<?=$table_bulan_depan?>
			</div>
		</div>
	</div>
</section>


