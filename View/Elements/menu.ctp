<div class="show-for-large-up fixed"><!-- -->
	<nav class="top-bar" data-topbar>
		<ul id="joyride1" class="title-area">
			<li class="name">
				<h1><a href="#"><?php echo Configure::read('name') ?></a></h1>
			</li>
		</ul>
		<section class="top-bar-section">
			<ul class="left">
				<li>
					<?php echo $this->Html->link(__('Accueil'), '/'); ?>
				</li>
			</ul>
			<ul class="right">
				<li class="has-form">
					<a href="#" class="button" data-options="align:left" data-dropdown="login">Connexion</a>
					<ul id="login" class="content f-dropdown" data-dropdown-content>
						<?php echo $this->Form->create('User', array('action' => 'login')); ?>
							<?php echo $this->Form->input('username', array('label' => false, 'placeholder' => 'Pseudo')); ?>
							<?php echo $this->Form->input('password', array('label' => false, 'placeholder' => 'Password')); ?>
							<?php echo $this->Html->link("Mot de pass oublié ?", array('action'=>'pwdforgotten')); ?>
							<?php echo $this->Form->input('rememberMe', array('type' => 'checkbox', 'label' => 'Se souvenir de moi', 'checked')) ?>
						<?php echo $this->Form->end(array('label' => 'Connexion', 'div' => false, 'class' => 'button expand')); ?>
					</ul>
				</li>
				<li>
					<?php echo $this->Html->link(__("Inscription"),
					array('controller' => 'users' , 'action' => 'signup', 'admin' => false)); ?>
				</li>
			</ul>
		</section>
	</nav>
</div>
<div class="fixed hide-for-large-up">
	<nav class="tab-bar hide-for-large-up">
		<a href="/" class="left-off-canvas-toggle menu-icon">
			<span>Hackdomia</span>
		</a>
	</nav>
</div>
<aside class="left-off-canvas-menu">
	<ul class="off-canvas-list">
		<li><label class="first">Hackdomia</label></li>
		<li>
			<?= $this->Html->link(__('Accueil'),
				array('/', 'admin' => false)); ?>
		</li>
		<li>
			<?= $this->Html->link(__('Demande de fichiers'),array(
				'controller' => 'requests', 'admin' => false)); ?>
		</li>
		<?php if (AuthComponent::user('id')): ?>
		<li><label><?= Inflector::humanize(AuthComponent::user('username')); ?></label></li>
		<li>
			<?= $this->Html->link(__("Mon compte"), array(
				'controller' => 'users', 'admin' => false)); ?>
		</li>
		<li>
			<?= $this->Html->link(__("Editer mon profil"), array(
				'controller' => 'users', 'action' => 'edit', 'admin' => false)); ?>
		</li>
		<hr>
		<li>
			<?= $this->Html->link(__("Déconnexion"), array(
				'controller' => 'users', 'action' =>	 'logout', 'admin' => false)); ?>
		</li>
		<?php else: ?>
		<li>
			<?= $this->Html->link(__("Connexion"), array(
				'controller' => 'users', 'action' => 'login', 'admin' => false)); ?>
		</li>
		<li>
			<?= $this->Html->link(__("Inscription"), array(
				'controller' => 'users', 'action' => 'signup', 'admin' => false)); ?>
		</li>
		<?php endif; ?>
	</ul>
	<hr>
	<div class="links">
		<ul class="top">
			<li>
				<?= $this->Html->link(__('Accueil'),
					array('controller' => 'files', 'action' => 'index', 'admin' => false)); ?>
			</li>
			<li>
				<?= $this->Html->link(__('Mentions légales'),
					array('controller' => 'pages', 'action' => 'display', 'mentions', 'admin' => false)); ?>
			</li>
			<?php if (!AuthComponent::user('id')): ?>
			<li>
				<?= $this->Html->link(__("Connexion"), array(
					'controller' => 'users' , 'action' => '	login', 'admin' => false)); ?>
			</li>
			<li>
				<?= $this->Html->link(__("Inscription"), array(
					'controller' => 'users', 'action' => 'signup', 'admin' => false)); ?>
			</li>
			<?php else: ?>
			<li>
				<?= $this->Html->link(__("Déconnexion"), array(
					'controller' => 'users', 'action' => 'logout', 'admin' => false)); ?>
			</li>
			<?php endif; ?>
		</ul>
		<span>Copyright &copy; 2014 manta42404 & nebjix • Développé et Administré par manta42404 et nebjix</span>
	</div>
</aside>
<a class="exit-off-canvas" href="#"></a>