<?php
App::uses('AppModel', 'Model');
/**
 * File Model
 *
 */
class File extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
* Virtual field
*
* @var array
*/
	public $virtualFields = array(
		// 'new_filename' => 'File.filename',
		// 'old_filename' => 'File.filename',
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'Champ requis' => array(
				'rule' => 'notEmpty',
			),
			'Entre 6 et 50 caractères' => array(
				'rule' => array('between', 6, 50),
			),
			'Le fichier existe déja' => array(
				'rule' => 'isUnique',
				'required' => 'create',
			),
		),
		'subject' => array(
			'Champ requis' => array(
				'rule' => 'notEmpty',
			),
			'25 caractères max' => array(
				'rule' => array('maxLength', 25),
			),
		),
		'level' => array(
			'Champ requis' => array(
				'rule' => 'notEmpty',
			),
			'25 caractères max' => array(
				'rule' => array('maxLength', 25),
			),
		),
		'editor' => array(
			'Champ requis' => array(
				'rule' => 'notEmpty',
			),
			'25 caractères max' => array(
				'rule' => array('maxLength', 25),
			),
		),
		'description' => array(
			'80 caractères max' => array(
				'rule' => array('maxLength', 80),
			),
		),
		'filename' => array(
			'Champ requis' => array(
				'rule' => 'notEmpty',
			),
			'Le fichier existe déja' => array(
				'rule' => 'isUnique',
				'required' => 'create',
			),
			"Caractère alphanumérique, '.', '-' ou '_'" => array(
				'rule' => '/[a-zA-Z0-9\._-]+/i',
			),
		),
	);
}
