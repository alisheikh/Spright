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

	function yourTasks() {

		$this->set('pageTitle', 'Your Tasks');

	}

	function completetask($id = null) {

		$this->request->data['Task']['id'] = $id;
		$this->layout = 'ajax';
		$faulttypes = $this->Task->Faulttype->find('list');
		$this->set(compact('faulttypes'));

	}

	public function save($id = null) {

		$this->autoRender = false;

		if (!$this->Task->exists($id)) {
			throw new NotFoundException(__('Save Failed Invalid Task'));
		}

		if ($this->request->is(array('post', 'put'))) {

			//If the task is rejected, then unschedule the task.
			if ($this->request->data['Task']['statustype_id'] == 7):
				$this->request->data['Task']['user_id'] = 0;
				$this->request->data['Task']['scheduled'] = 0;
			endif;

			//If the task is rejected, then unschedule the task.
			if ($this->request->data['Task']['statustype_id'] == 3):
				
			//Check if this is the last task to be completed.
			$notCompletedJobs = $this->Task->find('count',array('conditions'=>array('Task.id'=>$id,'statustype_id NOT'=> 3)));

				if($notCompletedJobs<=0):
					$this->loadModel('Job');
				endif;

			endif;

			if ($this->Task->save($this->request->data)) {

			} else {
				throw new NotFoundException(__('Save Failed'));
			}

		}
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
				throw new InternalErrorException('An internal error occured, the job was not scheduled'); // 500 error
			}

		}
	}

	public function workplanner() {

		$this->set('pageTitle', 'Work Planner');
		$this->Task->recursive = 2;

		$jobs = $this->Task->find('all', array('order' => array('Job.id DESC')));

		//Load Users into controller as we need to know what jobs we can assign people
		$this->loadModel('User');

		$this->User->contain('Task');
		$users = $this->User->find('all', array('conditions' => array('active' => 1),
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

}
