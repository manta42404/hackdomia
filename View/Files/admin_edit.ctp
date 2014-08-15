<div class="files form">
<?php echo $this->Form->create('File'); ?>
	<fieldset>
		<legend><?php echo __('Admin Edit File'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('subject');
		echo $this->Form->input('level');
		echo $this->Form->input('editor');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('File.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('File.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Files'), array('action' => 'index')); ?></li>
	</ul>
</div>
