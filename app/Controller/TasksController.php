<?php
App::uses('AppController', 'Controller');
/**
 * Tasks Controller
 *
 * @property Task $Task
 * @property PaginatorComponent $Paginator
 */
class TasksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Task->recursive = 0;
		$this->set('tasks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
		$this->set('task', $this->Task->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Task->create();
			if ($this->Task->save($this->request->data)) {
				$this->Session->setFlash(__('The task has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The task could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$jobs = $this->Task->Job->find('list');
		$statustypes = $this->Task->Statustype->find('list');
		$this->set(compact('jobs', 'statustypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Invalid task'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Task->save($this->request->data)) {
				$this->Session->setFlash(__('The task has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The task could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
			$this->request->data = $this->Task->find('first', $options);
		}
		$jobs = $this->Task->Job->find('list');
		$statustypes = $this->Task->Statustype->find('list');
		$this->set(compact('jobs', 'statustypes'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Task->id = $id;
		if (!$this->Task->exists()) {
			throw new NotFoundException(__('Invalid task'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Task->delete()) {
			$this->Session->setFlash(__('The task has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The task could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
