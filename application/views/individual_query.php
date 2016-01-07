<link href="<?php echo base_url('assets/lib/query-builder/css/query-builder.default.min.css')?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url('assets/lib/query-builder/css/bootstrap-datepicker3.min.css')?>" type="text/css" rel="stylesheet"/>
<section class="content-header">
	<h1>
		Individual Query
		<small>Custom Adult Smokers Management Selection</small>
	</h1>
	<ol class="breadcrumb">
		<li><?php echo anchor('dashboard','Dashboard')?></li>
		<li><?php echo anchor($breadcrumb,'Individual Management')?></li>
		<li class="active">Individual Query</li>
	</ol>
</section>
<section class="content">
	<div class="well well-sm">
		<div id="builder"></div>
		<button class="btn btn-primary btn-sm parse-sql" data-stmt="false"><span class="glyphicon glyphicon-refresh"></span> Generate</button>
		<div id="result" class="hide">
			<h3 id="query-result-label">Query Result</h3>
			<pre></pre>
			<a id="get-data" href="#" class="btn btn-success btn-sm" target="_blank"><span class="glyphicon glyphicon-export"></span> Get Data</a>
		</div>
	</div>
</section>
<script type="text/javascript" src="<?php echo base_url('assets/lib/query-builder/js/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/query-builder/js/jQuery.extendext.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/query-builder/js/doT.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/query-builder/js/moment.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/lib/query-builder/js/query-builder.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/qbuilder.js')?>"></script>

