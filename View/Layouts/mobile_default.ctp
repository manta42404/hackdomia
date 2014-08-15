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
		echo $this->Html->css('foundation');
		echo $this->Html->css('responsive-tables');
		echo $this->Html->css('font-awesome');
		echo $this->Html->css('iconFont');
		echo $this->Html->css('style');
		echo $this->fetch('meta');
		echo $this->fetch('css');
	?>
</head>
<body>
<div class="off-canvas-wrap" data-offcanvas>
	<div class="inner-wrap">
		<?php echo $this->element('menu'); ?>
		<?php echo $this->element('mobile_menu'); ?>
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
							<?= $this->Html->link(__("Connexion"), array(
								'controller' => 'users' , 'action' => '	login', 'admin' => false)); ?>
						</ul>
					</div>
				</div>
			</footer>
		</section>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</div>
<?php
echo $this->Html->script('vendor/jquery');
echo $this->Html->script('vendor/jquery.cookie');
echo $this->Html->script('vendor/fastclick');
echo $this->Html->script('vendor/placeholder');
echo $this->Html->script('vendor/modernizr');
echo $this->Html->script('foundation.min');
echo $this->Html->script('responsive-tables');
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