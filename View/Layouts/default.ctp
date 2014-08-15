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
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array(
			'responsive-tables',
			'responsive-tables',
			'font-awesome',
			'iconFont',
			'foundation',
			'style',
		));
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">
		<?php echo $this->element($menu); ?>
		<section role="main" class="main-section scroll-container">		
			<div class="hide-for-large-up" style="height:40px"></div>
			<div class="large-12 columns clearfix" style="margin-top:20px">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
			<footer class="hide-for-small">
				<div class="large-12 columns">
					<hr/>
					<div class="small-8 columns">
						<p>Copyright &copy; 2014 manta42404 & nebjix • Développé et Administré par manta42404 et nebjix</p>
					</div>
					<div class="small-4 columns">
						<ul class="inline-list right">
							<?php echo $this->Html->link(__('Accueil'),
								array('controller' => 'files', 'action' => 'index', 'admin' => false)); ?>
							<a>•</a>
							<?php echo $this->Html->link(__('Mentions'), array(
								'controller' => 'pages', 'action' => 'display', 'mentions', 'admin' => false)); ?>
							<a>•</a>
							<?php if (AuthComponent::user('id')): ?>
							<?php echo $this->Html->link(__("Déconnexion"), array(
								'controller' => 'users', 'action' => 'logout', 'admin' => false)); ?>
							<?php else: ?>
							<?php echo $this->Html->link(__("Connexion"), array(
								'controller' => 'users' , 'action' => '	login', 'admin' => false)); ?>
							<a>•</a>
							<?php echo $this->Html->link(__("Inscription"), array(
								'controller' => 'users', 'action' => 'signup', 'admin' => false)); ?>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</footer>
		</section>
		<?php echo $this->element('sql_dump'); ?>
	</div>
</div>
<?php echo $this->Html->script(array(
	'vendor/jquery',
	'vendor/jquery.cookie',
	'vendor/fastclick',
	'vendor/placeholder',
	'vendor/modernizr',
	'foundation.min',
	'responsive-tables',
));
?>
<script>
	$(document).foundation();
</script>
<script>
	// $(document).foundation('joyride', 'start');
</script>
<?php echo $this->fetch('script'); ?>
</body>
</html>