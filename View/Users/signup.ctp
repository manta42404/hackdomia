<div class="row large-6 medium-8">
	<h3><?php echo $title_for_layout; ?></h3>
	<p><?php echo __("Crée-toi un compte et accède à de nouvelles fonctionalités"); ?></p>
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->Form->create('User', array('action' => 'signup')); ?>
		<div class="row collaps">
			<div class="medium-3 columns">
				<label class="inline"><?php echo __("Nom d'utilisateur"); ?></label>
			</div>
			<div class="medium-9 columns">
				<?php echo $this->Form->input('username', array(
					'label' => false, 'required', 'placeholder' => 'Username', 'error' => array(
						'attributes' => array('wrap' => 'small', 'class' => 'error')
					)
				)); ?>
			</div>
		</div>
		<div class="row collaps">
			<div class="medium-3 columns">
				<label class="inline"><?php echo __("Adresse mail"); ?></label>
			</div>
			<div class="medium-9 columns">
				<?php echo $this->Form->input('email', array(
					'label' => false, 'required', 'placeholder' => 'Email', 'error' => array(
						'attributes' => array('wrap' => 'small', 'class' => 'error')
					)
				)); ?>
			</div>
		</div>
		<div class="row collaps">
			<div class="medium-3 columns">
				<label class="inline"><?php echo __("Mot de passe"); ?></label>
			</div>
			<div class="medium-9 columns">
				<?php echo $this->Form->input('password', array(
					'label' => false, 'required', 'placeholder' => 'Password', 'error' => array(
						'attributes' => array('wrap' => 'small', 'class' => 'error')
					)
				)); ?>
			</div>
		</div>
	<?php echo $this->Form->end(array('label' => __("S'inscrire"), 'class' => 'button expand')); ?>
	<div class="alert-box info">Ces informations seront contenues dans le mail de validation.</div>
</div>
