<div class="row large-8">
	<h2><?php echo $title_for_layout; ?></h2>
	<div class="medium-8 column">
		<h3><?php echo __("Modifier mes infos"); ?></h3>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Form->create('User');
			echo $this->Form->input('email', array(
				'label' => __("Adresse email"), 'placeholder' => 'Email'
			));
			echo $this->Form->input('new_password', array(
				'label' => __("Changer de mot de passe"), 'placeholder' => 'New password'
			));
			echo $this->Form->input('new_password_repeat', array(
				'label' => __("Confirmer le nouveau mot de passe"), 'placeholder' => 'New password repeat'
			));
		echo $this->Form->end(array('label' => __("Enregistrer"), 'class' => 'button expand')); ?>
	</div>
	<div class="medium-4 small-6 column">
		<h3><?php echo __('Devenir premium') ?></h3>
		<?php echo $this->Html->link(__('Devenir premium'), 
		array('controller' => 'premium'), array('class' => 'button expand')); ?>
	</div>
	<div class="medium-4 small-6 column">
		<h4><?php echo __('Supprimer mon compte') ?></h4>
		<?php echo $this->Html->link(__('Supprimer mon compte'), 
		array('action' => 'delete'), array('class' => 'small disabled expand button')); ?>
	</div>
</div>