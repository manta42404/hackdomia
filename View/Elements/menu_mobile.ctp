<div class="fixed hide-for-large-up">
	<nav class="tab-bar hide-for-large-up">
		<a class="left-off-canvas-toggle menu-icon">
			<span>Hackdomia</span>
		</a>
	</nav>
</div>
<aside class="left-off-canvas-menu">
	<ul class="off-canvas-list">
		<li><label class="first">Hackdomia</label></li>
		<li>
			<?= $this->Html->link(__('Accueil'),
				array('controller' => 'files', 'action' => 'index', 'admin' => false)); ?>
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