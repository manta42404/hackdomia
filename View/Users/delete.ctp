<div class="row large-4 medium-6">
	<h2><?php echo $title_for_layout; ?></h2>
	<?php
	echo $this->Session->flash();
	echo $this->Form->create('User');
		echo $this->Form->input('delete', array(
			'type' => 'checkbox', 'label' => __("Supprimer mon compte.")
		));
	echo $this->Form->end(array('label' => __("Supprimer mon compte"), 'class' => 'button expand alert')); ?>
</div>