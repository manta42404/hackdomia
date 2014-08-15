<div class="row large-4 medium-6">
	<h2><?php echo $title_for_layout; ?></h2>
	<?php
	echo $this->Session->flash();
	echo $this->Form->create('User');
	echo $this->Form->input('email', array('label' => 'Email', 'placeholder' => 'Email'));
	echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'button expand'));
	?>
</div>