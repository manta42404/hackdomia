<div class="show-for-large-up fixed"><!-- -->
	<nav class="top-bar" data-topbar>
		<ul id="joyride1" class="title-area">
			<li class="name">
				<h1><a href="#"><?php echo Configure::read('name'); ?> </a></h1>
			</li>
		</ul>
		<section class="top-bar-section">
			<ul class="left">
				<li>
					<?php echo $this->Html->link(__('Accueil'),
					array('controller' => 'files', 'action' => 'index', 'admin' => false)); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Fichiers orphelins'),
					array('controller' => 'files', 'action' => 'orphans', 'admin' => true)); ?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Demande de fichier'),
					array('controller' => 'requests', 'action' => 'index', 'admin' => true)); ?>
				</li>
			</ul>
			<ul class="right">
				<li class="has-dropdown not-click" data-options="is_hover: false">
					<a href="#"><?php echo Inflector::humanize(AuthComponent::user('username')); ?></a>
					<ul class="dropdown">
						<li><label><?php echo Inflector::humanize(AuthComponent::user('username')); ?></label></li>
						<li>
							<?php echo $this->Html->link(__("Mon compte"),
							array('controller' => 'users', 'admin' => false)); ?></i>
						</li>
						<li class="divider"></li>
						<li>
							<?php echo $this->Html->link(__("Deconnexion"),
							array('controller' => 'users', 'action' => 'logout', 'admin' => false)); ?>
						</li>
					</ul>
				</li>
			</ul>
		</section>
	</nav>
</div>
<!-- mobile nav -->
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
			<li>
				<?= $this->Html->link(__("Connexion"), array(
					'controller' => 'users' , 'action' => '	login', 'admin' => false)); ?>
			</li>
			<li>
				<?= $this->Html->link(__("Inscription"), array(
					'controller' => 'users', 'action' => 'signup', 'admin' => false)); ?>
			</li>
		</ul>
		<span>Copyright &copy; 2014 manta42404 & nebjix • Développé et Administré par manta42404 et nebjix</span>
	</div>
</aside>
<a class="exit-off-canvas" href="#"></a>