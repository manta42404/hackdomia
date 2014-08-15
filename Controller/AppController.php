<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $components = array('Session','Cookie','Auth','Paginator','DebugKit.Toolbar');
	// public $helpers = array('Zip');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Cookie->httpOnly = true;
		$this->Auth->authenticate = array('Form' => array(
			'scope' => array('User.active' => 1),
		));
		$this->Auth->authorize = array('Controller');
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => false);
		$this->Auth->loginRedirect = array('controller' => 'files', 'action' => 'index', 'admin' => false);
		$this->Auth->logoutRedirect = array('controller' => 'files', 'action' => 'index', 'admin' => false);
		$this->Auth->authError = "Tu t'es cru chez ta mère ?\nDégage d'ici !";
		$this->Auth->allow(array('index', 'login', 'logout', 'signup', 'activate', 'pwdforgotten', 'resetpwd'));

		if (isset($this->request->params['prefix'])) {
			$this->Auth->deny();
		}

		$this->set('title_for_layout', Configure::read('name'));
		$this->set('menu', 'menu');
		if ($this->Auth->user('rank') != null) {
			$this->set('menu', 'menu_'.$this->Auth->user('rank'));
		}

		if (!$this->Auth->loggedIn() && $this->Cookie->read('rememberMe')) {
			$cookie = $this->Cookie->read('rememberMe');
			$this->loadModel('User');
			$user = $this->User->find('first', array(
				'conditions' => array(
					'User.username' => $cookie['username'],
					'User.password' => $cookie['password'],
				)
			));
			if ($user && !$this->Auth->login($user['User'])) {
				$this->redirect('/users/logout');
			}
		}

		if ($this->Session->read('data')) {
			$this->request->data = $this->Session->read('data');
			$this->Session->delete('data');
		}
		if ($this->Session->read('errors')) {
			foreach($this->Session->read('errors') as $model => $errors) {
				$this->loadModel($model);
				$this->$model->validationErrors = $errors;
			}
			$this->Session->delete('errors');
		}
	// debug($this->request->params);
	}

	public function isAuthorized($user) {
		$params = $this->request->params;
		$lvls = array(
			'admin' => 9,
			'users' => 7,
			'files' => 5,
			'requests' => 5,
		);

		if (isset($params['prefix'])) {
			if ($user['rank'] == $lvls[$params['prefix']]) {
				return true;
			}
			elseif ($user['rank'] == $lvls[$params['controller']]) {
				return true;
			}
		} else {
			return true;
		}
		
/*

		$params = $this->request->params;

		// switch ($user['rank']) {
		// 	if (isset($params['prefix'])) {
		// 		case $lvls[$params['prefix']]:
		// 			return true;
		// 		break;
		// 	}
		// 	if (isset($params['controller'])) {
		// 		case $lvls[$params['controller']]:
		// 			return true;
		// 		break;
		// 	}
		// 	default:
		// 		return false;
		// 		break;
		// }

		if (isset($params['prefix'])) {
			$lvlaction = $lvls[$params['prefix']];
			switch ($user['rank']) {
				case $lvls[$params['prefix']]:
					return true;
				break;
				case $lvls[$params['controller']]:
					return true;
				break;
				default:
					return false;
					break;
			}
		} else {
			$lvlaction = $lvls[$params['controller']];
			switch ($user['rank']) {
				case $lvls[$params['controller']]:
					return true;
				break;
				default:
					return false;
					break;
			}
		}
		// if ($user['rank'] >= $lvlaction) {
		// 	return true;
		// }
		// throw new NotFoundException();
		return false;

*/
	}
}