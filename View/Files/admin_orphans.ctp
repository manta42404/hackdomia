<?php 
echo $this->Session->flash("success");
echo $this->Session->flash("failed");
if (isset($files)):
$data_subjects = array(	
	'Fr'		=>	'Français',
	'Maths'	=>	'Mathématiques',
	'Math'	=>	'Mathématiques',
	'Hist'	=>	'Histoire',
	'Geo'		=>	'Géographie',
	'HG'		=>	'Histoire Géo',
	'EdC'		=>	'Education Civique',
	'HGEC'	=>	'Histoire Géo Ed. Civique',
	'HDA'		=>	'Histoire des Arts',
	'Ang'		=>	'Anglais',
	'All'		=>	'Allemand',
	'Esp'		=>	'Espagnol',
	'Ita'		=>	'Italien',
	'SP'		=>	'Sciences Physiques',
	'PC'		=>	'Physique Chimie',
);
$data_grades = array(
	'6e'		=>	'6e',
	'5e'		=>	'5e',
	'4e'		=>	'4e',
	'3e'		=>	'3e',
	'2de'		=>	'2de',
	'2nd'		=>	'2de',
	'1re'		=>	'1re',
	'1st'		=>	'1re',
	'Te'		=>	'Terminal',
	'2dePro'=>	'2de Pro',
	'2ndPro'=>	'2de Pro',
	'1rePro'=>	'1re Pro',
	'1stPro'=>	'1re Pro',
	'TePro'	=>	'Terminal Pro',
);
$data_descriptions = array(
	'col'	=> 'Collection : ',
	'ed'	=> 'Edition : ',
	'aut'	=> 'Auteurs : ',
);
echo $this->Form->create('File', array('action' => 'orphans')); 
echo "<div class=\"large-12 columns\">";
	$a = 1;
	foreach ($files as $id => $file):
		$filename_no_ext = substr($file, 0, strrpos($file, '.'));
		$file_data = explode('_', $filename_no_ext, 4);
		$file_title = str_replace(array('_','-'),' ',$filename_no_ext);
		$file_subject = (array_key_exists($file_data[0], $data_subjects)) ? 
			$data_subjects["$file_data[0]"] : $file_data[0] ;
		$file_grade = (array_key_exists($file_data[1], $data_grades)) ? $data_grades["$file_data[1]"] : $file_data[1] ;
		$file_editor = $file_data[2];
		$file_description = "";
		if (isset($file_data[3])) {
			$description = explode('_', $file_data[3]);
			for ($i=0; isset($description[$i]); $i++) {
				if (array_key_exists($description[$i], $data_descriptions)) {
					$file_description .= $data_descriptions[$description[$i]].$description[$i+1].", \n";
					$i++;
				} else {
					$file_description .= $description[$i].", \n" ;
				}
			}
			$file_description = str_replace('-',' ',$file_description);
		}
		if ($a != 1 && ($a-1) % 3 == 0) {
			echo "<div class=\"large-12 columns\">\n";
		}
	?>
	<div class="large-4 column">
		<div class="panel">
			<h5><a href="/app/webroot/files/<?php echo $file ?>" target="_blank"><?php echo $file ?></a></h5>
			<hr>
			<?= $this->Form->input("$id.old_filename", array('type' => 'hidden', 'label' => null, 'value' => $file,)); ?>
			<?= $this->Form->input("$id.ignore", array('type' => 'checkbox', 'label' => 'Ignorer ce fichier')); ?>
			<div class="row collaps">
				<div class="large-12 columns">
					<label><?php echo __("Nom du fichier"); ?></label>
				</div>
				<div class="large-12 columns">
					<?php echo $this->Form->input("$id.filename", array(
						'label' => false, 'placeholder' => 'filename', 'value' => $file, 'type' => 'text', 'required', 
						'error' => array(
							'attributes' => array('wrap' => 'small', 'class' => 'error')
						)
					)); ?>
				</div>
			</div>
			<div class="row collaps">
				<div class="large-12 columns">
					<label><?php echo __("Titre"); ?></label>
				</div>
				<div class="large-12 columns">
					<?php echo $this->Form->input("$id.title", array(
						'label' => false, 'placeholder' => 'Titre', 'value' => $file_title, 'type' => 'text', 'required', 
						'error' => array(
							'attributes' => array('wrap' => 'small', 'class' => 'error')
						)
					)); ?>
				</div>
			</div>
			<div class="row collaps">
				<div class="large-3 columns">
					<label class="inline"><?php echo __("Matière"); ?></label>
				</div>
				<div class="large-9 columns">
					<?php echo $this->Form->input("$id.subject", array(
						'label' => false, 'required', 'placeholder' => 'Matière', 'value' => $file_subject, 'error' => array(
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
					<?php echo $this->Form->input("$id.grade", array(
						'label' => false, 'required', 'placeholder' => 'Classe', 'value' => $file_grade, 'error' => array(
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
					<?php echo $this->Form->input("$id.editor", array(
						'label' => false, 'required', 'placeholder' => 'Editeur', 'value' => $file_editor, 'error' => array(
							'attributes' => array('wrap' => 'small', 'class' => 'error')
						)
					)); ?>
				</div>
			</div>
			<div class="row collaps">
				<div class="large-12 columns">
					<label><?php echo __("Description"); ?></label>
				</div>
				<div class="large-12 columns">
					<?php echo $this->Form->input("$id.description", array(
						'type' => 'textarea', 'style' => 'resize:none', 'label' => false, 'required' => false,
						'placeholder' => 'Description', 'value' => $file_description, 
						'error' => array(
							'attributes' => array('wrap' => 'small', 'class' => 'error')
						)
					)); ?>
				</div>
			</div>
		</div>
	</div>
	<?php 
	if ($a % 3 == 0) { echo "</div>\n"; } 
	$a++;
	endforeach;
echo $this->Form->end(array('label' => __("Envoyer"), 'class' => 'button large-12 column'));
else: ?>
<div data-alert class="alert-box">
	<?php echo __('Aucun fichier'); ?>
	<a href="#" class="close">&times;</a>
</div>
<?php endif; ?>
