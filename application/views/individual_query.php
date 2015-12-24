<section class="content-header">
	<h1>
		Individual Query
		<small>Custom Adult Smokers Management Selection</small>
	</h1>
	<ol class="breadcrumb">
		<li><?=anchor('dashboard','Dashboard')?></li>
		<li><?=anchor($breadcrumb,'Individual Management')?></li>
		<li class="active">Individual Filter</li>
	</ol>
</section>
<section class="content">
	<div class="well well-sm">
		<div id="builder"></div>
	</div>
</section>
<button class="btn btn-primary parse-sql" data-stmt="false">SQL</button>
<div id="result" class="hide">
	<h3>Output</h3>
	<pre></pre>
</div>
<script> var base_url = "<?=base_url()?>"</script>
<script src="<?=base_url('../assets/js/jquery-1.11.3.min.js')?>"></script>
<script src="<?=base_url('../assets/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js')?>"></script>
<script src="<?=base_url('../assets/bower_components/bootbox/bootbox.js')?>"></script>
<script src="<?=base_url('../assets/bower_components/jquery-extendext/jQuery.extendext.min.js')?>"></script>
<script src="<?=base_url('../assets/bower_components/sql-parser/browser/sql-parser.js')?>"></script>
<script src="<?=base_url('../assets/bower_components/doT/doT.js')?>"></script>
<script src="<?=base_url('../assets/jquery-querybuilder/dist/js/query-builder.js')?>"></script>
<script src="<?=base_url('assets/js/qbuilder.js')?>"></script>
