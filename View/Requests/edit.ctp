<div class="requests form">
<?php echo $this->Form->create('Request'); ?>
	<fieldset>
		<legend><?php echo __('Edit Request'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('subject');
		echo $this->Form->input('level');
		echo $this->Form->input('editor');
		echo $this->Form->input('description');
		echo $this->Form->input('user_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Request.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Request.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Requests'), array('action' => 'index')); ?></li>
	</ul>
</div>
