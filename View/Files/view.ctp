<div class="large-12 columns" style="margin-top:-60px">
	<?php echo $this->Html->link(null, '/files/'.$file['File']['filename'], array('class' => 'media')); ?>
</div>
<?php $this->start('script'); ?>
	<?php echo $this->Html->script('jquery.media') ?>
	<script>
	$('a.media').media({width: '100%', height: '600px'});
	</script>
<?php $this->end(); ?>