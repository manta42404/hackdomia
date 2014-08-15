<div class="requests form">
<?php echo $this->Form->create('Request'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Request'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Requests'), array('action' => 'index')); ?></li>
	</ul>
</div>
