<form onsubmit="return doSearch();" id="joyride2" class="large-4 small-12 columns row collapse left">
	<div class="small-10 columns">
		<input type="text" id="search" placeholder="Recherche">
	</div>
	<div class="small-2 columns">
		<input type="submit" id="do_search" class="button postfix" value="Go">
	</div>
</form>
<form onsubmit="return doAction();" class="large-5 small-12 columns right">
	<div class="row collapse">
		<div class="large-4 small-5 columns">
			<span class="prefix">Action groupée : </span>
		</div>
		<div class="large-6 small-5 columns">
			<select id="selected_action">
				<option value="zip">Télécharger zippés</option>
				<option value="each">Télécharger</option>
			</select>
		</div>
		<div class="small-2 columns">
			<input type="submit" id="do_action" class="button postfix" value="Go">
		</div>
	</div>
</form>
<div data-alert class="alert-box info columns">
	<a href="/requests">
		<div><?php echo __("Il manque quelque-chose ? Vos manuels ne sont pas là ? <em>Demandez !</em>"); ?></div>
	</a>
	<a href="#" class="close">&times;</a>
</div>
<table class="small-12 files responsive">
	<thead>
		<tr>
			<th class="checkbox">
				<input type="checkbox" name="select_all" id="select_all" value="0">
			</th>
			<th><?php echo $this->Paginator->sort('title', __('Titre')); ?></th>
			<th><?php echo $this->Paginator->sort('subject', __('Matière')); ?></th>
			<th><?php echo $this->Paginator->sort('grade', __('Classe')); ?></th>
			<th><?php echo $this->Paginator->sort('editor', __('Editeur')); ?></th>
			<th><?php echo $this->Paginator->sort('description', __('Description')); ?></th>
			<th class="actions">Télécharger</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($files as $file): ?>
		<tr>
			<td><input type="checkbox" name="files[]" value="<?php echo h($file['File']['id']); ?>">&nbsp;</td>
			<td><?php echo $this->Html->link(h($file['File']['title']), array(
				'controller' => 'files', 'action' => 'view', $file['File']['id'])); ?>
			</td>
			<td><?php echo h($file['File']['subject']); ?>&nbsp;</td>
			<td><?php echo h($file['File']['grade']); ?>&nbsp;</td>
			<td><?php echo h($file['File']['editor']); ?>&nbsp;</td>
			<td><?php echo h($file['File']['description']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('Télécharger'), array('action' => 'download', $file['File']['id']), array('class' => 'button tiny')); ?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<p>
<?php echo $this->Paginator->counter(array(
	'format' => __('Affiché : {:current} enregistrements sur un total de {:count}, de {:start} à {:end}')
	)); ?>
</p>
<div class="pagination-centered">
	<ul class="pagination">
		<?php
		echo $this->Paginator->prev('«', array('tag' => 'li', 'class' => 'arrow'), null, array('tag' => 'li', 'class' => 'unavailable'));
		echo $this->Paginator->numbers(array('tag' => 'li', 'separator' => ''));
		echo $this->Paginator->next('»', array('tag' => 'li', 'class' => 'arrow'), null, array('tag' => 'li', 'class' => 'unavailable'));
		?>
	</ul>
</div>
<?php echo $this->element('joyride'); ?>
<?php $this->start('script'); ?>
<script>
$(document).ready(function() {
	$("#select_all").click(function(){
		var status = $(this).prop("checked");
		$("td>input:checkbox").prop("checked",status);
	});

	$("#do_action").click(function() {
		var checks = $("td>input:checkbox").serializeArray(); 
		if (checks.length == 0) { 
			alert('Choisisez au moins un fichier.');
			return false; 
		} 
		else {
			var action = $('#selected_action').val();
			if (action == 'zip') {
				var checkboxes = $.map($('input:checkbox:checked'), function(e,i) {
					if (e.value != '0') {
						return +e.value;
					}
				});
				<?php 
					echo "window.location.href='".$this->Html->url(array('action' => 'download_zip', ), true)."/'+checkboxes;"; 
				?>

			}
			else if (action == 'each') {
				var checkboxes = $.map($('input:checkbox:checked'), function(e,i) {
					if (e.value != '0') {
						return +e.value;
					}
				});
				alert('Désolé, cette fonctionnalité n\'est pas encore disponible');
				<?php 
					// echo "window.location.href='".$this->Html->url(array('action' => 'download_each', ), true)."/'+checkboxes;"; 
				?>

			}
			return false;
		}
	});

	$("#do_search").click(function() {
		var search = $("input:text#search").val();
		<?php 
		echo "window.location.href='".$this->Html->url(array(
			'action' => 'search', ), true)."/'+search"; ?>;
	});
});

function doAction() {
	var checks = $("td>input:checkbox").serializeArray(); 
	if (checks.length == 0) { 
		alert('Choisisez au moins un fichier.');
		return false; 
	} 
	else {
		var action = $('#selected_action').val();
		if (action == 'zip') {
			var checkboxes = $.map($('input:checkbox:checked'), function(e,i) {
				if (e.value != '0') {
					return +e.value;
				}
			});
			<?php 
				echo "window.location.href='".$this->Html->url(array('action'=>'download_zip'), true)."/'+checkboxes;"; 
			?>

		}
		else if (action == 'each') {
			var checkboxes = $.map($('input:checkbox:checked'), function(e,i) {
				if (e.value != '0') {
					return +e.value;
				}
			});
			alert('Désolé, cette fonctionnalité n\'est pas encore disponible');
			<?php 
				// echo "window.location.href='".$this->Html->url(array('action'=>'download_each'), true)."/'+checkboxes;"; 
			?>

		}
		return false;
	}
}

function doSearch() {
	var search = $("input:text#search").val();
	<?php 
		echo "window.location.href='".$this->Html->url(array('action'=>'search'), true)."/'+search;";
	?>
	return false;
}
</script>
<?php $this->end(); ?>