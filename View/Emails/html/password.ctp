<h2>Hello <?php echo $username; ?></h2>

<p>Tu as demandé à créer un nouveau mot de passe, rien de plus simple !
Pour cela utilise ce lien :</p>
 
<?php echo $this->Html->link($this->Html->url(
	array('controller'=>'users', 'action'=>'resetpwd', $token),
	true
)); ?>

<p>Tu n'as pas demander à changer de mot de passe ?
Pas de panique, ignore simplement ce mail.</p>