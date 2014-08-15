<div class="row panel large-4 medium-6">
<?php echo $this->Session->flash(); ?>
<?php echo $this->Form->create('User', array('action' => 'login')); ?>
	<?php echo $this->Form->input('username', array('label' => 'Pseudo', 'placeholder' => 'Pseudo')); ?>
	<?php echo $this->Form->input('password', array(
		'label' => 'Mot de passe '.$this->Html->link("Oublié ?", array('action'=>'pwdforgotten'), array('class'=>'small')), 
		'placeholder' => 'Password')); ?>
	<?php echo $this->Form->input('rememberMe', array('type' => 'checkbox', 'label' => 'Se souvenir de moi', 'checked')) ?>
<?php echo $this->Form->end(array('label' => 'Connexion', 'div' => false, 'class' => 'button expand')); ?>
</div>
