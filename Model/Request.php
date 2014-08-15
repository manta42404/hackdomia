<?php
App::uses('AppModel', 'Model');
/**
 * Request Model
 *
 */
class Request extends AppModel {

	public $belongsTo = 'User';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'subject' => array(
			'Champ requis' => array(
				'rule' => 'notEmpty',
			),
			'Entre 3 et 30 caractères' => array(
				'rule' => array('between', 3, 30),
			),
		),
		'grade' => array(
			'Champ requis' => array(
				'rule' => 'notEmpty',
			),
			'Entre 2 et 20 caractères' => array(
				'rule' => array('between', 2, 20),
			),
		),
		'editor' => array(
			'Champ requis' => array(
				'rule' => 'notEmpty',
			),
			'Entre 4 et 50 caractères' => array(
				'rule' => array('between', 4, 50),
			),
		),
		'description' => array(
			'80 caractères max' => array(
				'rule' => array('maxLength', 80),
			),
		),
	);
}
