<?php
App::uses('AppController', 'Controller', 'Cookie');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler');

	public function getNames() {

		$q = $_GET['q'];

		$json = $this->User->find('all', array(
			'conditions' => array(
				'User.fullname LIKE' => '%' . $q . '%'),
			'fields' => array('User.fullname', 'User.email', 'User.contact')
		));
		$json = Set::extract('/User/.', $json);

		$this->set('json', $json);

		$this->set('_serialize', 'json');

	}

	public function beforeFilter() {
		parent::beforeFilter();
		// Allow users to register and logout.
		$this->Auth->allow('login', 'logout', 'add');
	}

	public function login() {

		if ($this->request->is('post')) {

			if ($this->Auth->login()) {

				return $this->redirect($this->Auth->redirectUrl());

			} else {
				$this->Session->setFlash('Incorrect username or password, please try again.', 'default', array('class' => 'alert alert-danger'));

			}
		}
	}

	public function logout() {
		//$this->Cookie->delete('rememberMeSpright');
		return $this->redirect($this->Auth->logout());
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */

	public function password() {

		if ($this->request->is('post')) {

			$userID = $this->Session->read('Auth.User.id');
			$user = $this->User->read(null, $userID);
			$yourPassword = $user['User']['password'];
			$suppliedPassword = AuthComponent::password(
				$this->request->data['User']['current']
			);

			$password1 = $this->request->data['User']['password1'];
			$password2 = $this->request->data['User']['password2'];

			if ($suppliedPassword != $yourPassword) {

				$this->Session->setFlash('Password supplied does not match your current password', 'default', array('class' => 'alert alert-danger'));
			} else {

				if ($password1 === $password2) {
					$this->Session->setFlash('Success! Your password has been changed', 'default', array('class' => 'alert alert-success'));
					$this->User->saveField('password', $password2);
					return true;
				} else {
					$this->Session->setFlash('Your new passwords do not match', 'default', array('class' => 'alert alert-danger'));
					return false;
				}

			}

		}

	}

	public function add() {

		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
				__('The user could not be saved. Please, try again.')
			);
		}

		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
				__('The user could not be saved. Please, try again.')
			);
		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->request->onlyAllow('post');

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
}
