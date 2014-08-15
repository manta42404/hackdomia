<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel {

	public function beforeSave($options = array()) {
		if (!empty($this->data['User']['password'])) {
			$this->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
		}
		return true;
	}

	public $hasMany = 'Request';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'Champ requis' => array(
				'rule' => 'notEmpty',
			),
			'Entre 3 et 12 caractères' => array(
				'rule' => array('between', 3, 12),
			),
			'Seulement AlphaNumérique' => array(
				'rule' => 'alphaNumeric',
			),
			'Username déjà pris' => array(
				'rule' => 'isUnique',
			),
		),
		'email' => array(
			'Champ requis' => array(
				'rule' => 'notEmpty',
				'required' => true,
			),
			'L\'email doit être valide' => array(
				'rule' => 'email',
			),
			'Email déjà utilisé' => array(
				'rule' => 'isUnique',
			),
		),
		'password' => array(
			'Champ requis' => array(
				'rule' => 'notEmpty',
				'allowEmpty' => false,
				'required' => true,
				'on' => 'create',
			),
			'4 caractères minimum' => array(
				'rule' => array('minLength', 4),
				'on' => 'create',
			),
		),
	);
}