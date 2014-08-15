<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title_for_layout; ?></title>
</head>
<body>
	<?php echo $this->fetch('content'); ?>

	<p>A bientot sur <?php echo $this->Html->link($this->Html->url('/', true)); ?></p>
</body>
</html>