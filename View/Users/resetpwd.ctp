<div class="row large-4 medium-6">
	<h2><?php echo $title_for_layout; ?></h2>
	<?php
	echo $this->Session->flash();
	echo $this->Form->create('User');
		echo $this->Form->input('new_password', array(
			'label' => __("Nouveau mot de passe"), 'placeholder' => 'New password', 'type' => 'password'
		));
		echo $this->Form->input('new_password_repeat', array(
			'label' => __("Confirmer le nouveau mot de passe"), 'placeholder' => 'New password repeat', 'type' => 'password'
		));
	echo $this->Form->end(array('label' => __("Enregistrer"), 'class' => 'button expand')); ?>
</div>