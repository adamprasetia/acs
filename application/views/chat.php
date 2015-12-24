<div class="item">
	<?=$this->template->get_user_image($photo,'online')?>
	<p class="message">
		<a href="#" class="name">
			<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> <?=ago(strtotime($date))?></small>
			<?=$fullname?>
		</a>
		<?=html_escape($chat)?>
	</p>
</div>
