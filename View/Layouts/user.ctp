<!DOCTYPE html>
<!--
#########################################################################
#############################.By.Manta42404.#############################
###...NN....N...EEEEEEE...BBBBBBB...........JJ....IIIIII....X....X....###
###...N.N...N...E.........B.....BB..........JJ......II.......X..X.....###
###...N..N..N...EEEEE.....BBBBBBB...........JJ......II........XX......###
###...N...N.N...E.........B......BB...JJ....JJ......II.......X..X.....###
###...N....NN...EEEEEEE...BBBBBBBB......JJJJ......IIIIII....X....X....###
#############################.By.Manta42404.#############################
#########################################################################
-->
<html><!--  style="margin-top:50px" -->
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('foundation');
		echo $this->Html->css('style');
		echo $this->Html->css('font-awesome');
		echo $this->Html->css('iconFont');
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">
		<div class=" show-for-large-up fixed"><!-- -->
			<nav class="top-bar docs-bar show-for-large-up" data-topbar>
				<ul id="joyride1" class="title-area">
					<li class="name">
						<h1><a href="#">Hackdomia</a></h1>
					</li>
				</ul>
				<section class="top-bar-section">
					<ul class="left">
						<li>
							<?= $this->Html->link(__('Accueil'),
							array('controller' => 'files', 'action' => 'index', 'admin' => false)); ?>
						</li>
						<li>
							<?= $this->Html->link(__('Demande de fichiers'),
							array('controller' => 'requests', 'admin' => false)); ?>
						</li>
					</ul>
					<ul class="right">
						<li class="has-dropdown not-click" data-options="is_hover: false">
							<a href="#"><?= Inflector::humanize(AuthComponent::user('username')); ?></a>
							<ul class="dropdown">
								<li><label><?= Inflector::humanize(AuthComponent::user('username')); ?></label></li>
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
						'controller' => 'request', 'admin' => false)); ?>
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
						<?= $this->Html->link(__("Déconnexion"), array(
							'controller' => 'users', 'action' =>	 'logout', 'admin' => false)); ?>
					</li>
				</ul>
				<span>Copyright &copy; 2014 manta42404 & nebjix • Développé et Administré par manta42404 et nebjix</span>
			</div>
		</aside>
		<a class="exit-off-canvas" href="#"></a>
		<section role="main" class="main-section scroll-container">		
			<div style="height:60px"></div>
			<div class="large-12 columns">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
			<footer class="hide-for-small">
				<div class="large-12 columns">
					<hr/>
					<div class="small-9 columns">
						<p>Copyright &copy; 2014 manta42404 & nebjix • Développé et Administré par manta42404 et nebjix</p>
					</div>
					<div class="small-3 columns">
						<ul class="inline-list right">
							<?= $this->Html->link(__('Accueil'),
								array('controller' => 'files', 'action' => 'index', 'admin' => false)); ?>
							<a>•</a>
							<?= $this->Html->link(__('Mentions légales'),
								array('controller' => 'pages', 'action' => 'display', 'mentions', 'admin' => false)); ?>
							<a>•</a>
							<?= $this->Html->link(__("Déconnexion"), array(
								'controller' => 'users', 'action' =>	 'logout', 'admin' => false)); ?>
						</ul>
					</div>
				</div>
			</footer>
		</section>
	</div>
</div>
			<?php echo $this->element('sql_dump'); ?>
<?php
echo $this->Html->script('vendor/jquery');
echo $this->Html->script('vendor/jquery.cookie');
echo $this->Html->script('vendor/fastclick');
echo $this->Html->script('vendor/placeholder');
echo $this->Html->script('vendor/modernizr');
echo $this->Html->script('foundation.min');
?>
<script>
	$(document).foundation();
</script>
<script>
	$(document).foundation('joyride', 'start');
</script>
<?php echo $this->fetch('script'); ?>
</body>
</html>