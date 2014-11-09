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

	public $components = array('Paginator', 'RequestHandler');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Task->recursive = 0;
		$this->set('tasks', $this->Paginator->paginate());
	}

	function getTasks() {
		$this->Task->recursive = 2;

		$this->Task->Behaviors->load('Containable');

		// $this->paginate = array('link' => array('Job'));

		$this->paginate = array(
			'fields' => array('Task.id', 'Task.code', 'Task.job_id'),
			'conditions' => array(
				'Task.scheduled' => 1,
			),
			'contain' => array(
				'Job' => array(
					'fields' => array(
						'Job.id', 'Job.description',
					),
					'Site' => array(
						'fields' => array(
							'Site.code',
						)
					),
					'Building' => array(
						'fields' => array(
							'Building.code',
						)
					),
					'Floor' => array(
						'fields' => array(
							'Floor.code',
						)
					),
					'Room' => array(
						'fields' => array(
							'Room.code',
						)
					)
				)
			)

		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize', 'response');
	}

	public function schedule() {

		$this->autoRender = false;
		$task_id = $this->request->query['job'];
		$user_id = $this->request->query['resource'];

		if ($this->request->is('get')) {

			$save = $this->Task->updateAll(
				array('Task.user_id' => $user_id, 'Task.scheduled' => 1, 'Task.statustype_id' => 2),
				array('Task.id' => $task_id));

			if ($save) {
				$error = array('SUCCESS' => true, 'DATA' => 'Task Succesfully Scheduled');
				echo json_encode($error);
			} else {
				Configure::write('debug', 1);
				throw new InternalErrorException('An internal error occured, the job was not scheduled');// 500 error
			}

		}
	}

	public function workplanner() {
		$this->Task->recursive = 2;

		//$this->Job>contain('Task');

		$jobs = $this->Task->find('all', array('order' => array('Job.id DESC')));

		//Load Users into controller as we need to know what jobs we can assign people
		$this->loadModel('User');

		$this->User->contain('Task');
		$users = $this->User->find('all', array('conditions' => array('active' => 1)
		));

		$this->set('tasks', $jobs);
		$this->set('users', $users);
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
