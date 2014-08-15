<h2>Hello <?php echo $username; ?></h2>

<p>Tu t'es récement inscrit sur hackdomia.fr et nous t'en remercions.</p>
<p>Avant de pouvoir te connecter et accéder aux fonctionalités du site, <br>
il te faud activer ton compte, pour cela utilise ce lien : </p>
 
<?php echo $this->Html->link($this->Html->url(
	array('controller'=>'users', 'action'=>'activate', $token),
	true
)); ?>

<p>Rappel de tes identifiants :</p>
<p>Nom d'utilisateur (username) : <?php echo $username; ?><br>
Mot de pase (password) : <?php echo $password; ?></p>