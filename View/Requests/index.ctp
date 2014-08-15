<div class="large-2 columns">&nbsp;</div>
<div class="large-8 columns">
	<h3><?php echo __("Demandes de fichiers"); ?></h3>
	<p><?php echo __("Il manque quelque-chose ? Vos manuels ne sont pas là ? <em>Demandez !</em>"); ?></p>
	<?php echo $this->Session->flash(); ?>
	<div class="section-container" data-section="">
		<section class="section">
			<h5 class="title"><?php echo __("Demander un fichier"); ?></h5>
			<p>
				<?php echo __("Avant de faire une demande, vérifier qu'elle n'est pas déjà faite dans la liste en dessous."); ?>
			</p>
			<div class="content" id="panel1" data-slug="panel1">
				<?php echo $this->Form->create('Request', array('action' => 'add')); ?>
					<div class="row collaps">
						<div class="large-3 columns">
							<label class="inline"><?php echo __("Matière"); ?></label>
						</div>
						<div class="large-9 columns">
							<?php echo $this->Form->input('subject', array(
								'label' => false, 'required', 'error' => array(
									'attributes' => array('wrap' => 'small', 'class' => 'error')
								)
							)); ?>
						</div>
					</div>
					<div class="row collaps">
						<div class="large-3 columns">
							<label class="inline"><?php echo __("Classe"); ?></label>
						</div>
						<div class="large-9 columns">
							<?php echo $this->Form->input('grade', array(
								'label' => false, 'required', 'error' => array(
									'attributes' => array('wrap' => 'small', 'class' => 'error')
								)
							)); ?>
						</div>
					</div>
					<div class="row collaps">
						<div class="large-3 columns">
							<label class="inline"><?php echo __("Editeur"); ?></label>
						</div>
						<div class="large-9 columns">
							<?php echo $this->Form->input('editor', array(
								'label' => false, 'required', 'error' => array(
									'attributes' => array('wrap' => 'small', 'class' => 'error')
								)
							)); ?>
						</div>
					</div>
					<div class="row collaps">
						<div class="large-3 columns">
							<label class="inline">
								<?php echo __("Autre, Description<br><small>Collection, Année d'édition, Sous-titre, Auteur(s) ...</small>"); ?>
							</label>
						</div>
						<div class="large-9 columns">
							<?php echo $this->Form->input('description', array(
								'type' => 'textarea', 'style' => 'resize:none', 'label' => false, 'required' => false,
								'error' => array(
									'attributes' => array('wrap' => 'small', 'class' => 'error')
								)
							)); ?>
						</div>
					</div>
				<?php echo $this->Form->end(array('label' => __("Envoyer"), 'class' => 'button')); ?>
			</div>
		</section>
	</div>
</div>
<div class="large-2 columns">&nbsp;</div>
	<table class="small-12 responsive">
		<thead>
			<tr>
					<th><?php echo $this->Paginator->sort('subject', __('Matière')); ?></th>
					<th><?php echo $this->Paginator->sort('grade', __('Classe')); ?></th>
					<th><?php echo $this->Paginator->sort('editor', __('Editeur')); ?></th>
					<th><?php echo $this->Paginator->sort('description', __('Description')); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($requests as $request): ?>
			<tr>
				<td><?php echo h($request['Request']['subject']); ?>&nbsp;</td>
				<td><?php echo h($request['Request']['grade']); ?>&nbsp;</td>
				<td><?php echo h($request['Request']['editor']); ?>&nbsp;</td>
				<td><?php echo h($request['Request']['description']); ?>&nbsp;</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="pagination-centered">
		<ul class="pagination">
			<?php
				echo $this->Paginator->prev('«', 
					array('tag' => 'li', 'class' => 'arrow'), null, 
					array('tag' => 'li', 'class' => 'unavailable')
				);
				echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => ''));
				echo $this->Paginator->next('»', 
					array('tag' => 'li', 'class' => 'arrow'), null, 
					array('tag' => 'li', 'class' => 'unavailable')
				);
			?>
		</ul>
	</div>
</div>
