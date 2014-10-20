<?php
App::uses('AppController', 'Controller');
/**
 * Jobs Controller
 *
 * @property Job $Job
 * @property PaginatorComponent $Paginator
 */
class JobsController extends AppController {

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

		$this->Job->recursive = 0;

		$this->Paginator->settings = array(
			'limit' => 10, 'order' => 'Job.id DESC',
		);

		$this->set('jobs', $this->Paginator->paginate());
	}

/**
 * JSON actions
 *
 * */

	public function checkForDuplicates() {

		$this->Job->recursive = -1;

//$this->autoRender = false;

		$qs = $this->request->query['qs'];
		$id = $this->request->query['node'];
		$room_id = $this->request->query['room_id'];
//Check if QS is last in tree
		$this->loadModel('Question');
		$this->Question->id = $id;
		$childCount = $this->Question->childCount($id, true);

		$level = explode("[", $qs);
		$level = trim(end($level), "]") . "ID";

//Only check for duplicate if the QS is the last in the tree
		if ($childCount < 1):
			$json = $this->Job->find('all', array(
				'conditions' => array($level => $id, 'room_id' => $room_id, 'created >=' => date('Y-m-d H:i:s', strtotime('-24 hour'))),
				'recursive' => -1,
			));

		endif;

		$this->set('json', $json);
		$this->set('_serialize', 'json');
	}

	public function getJobs() {
		$this->paginate = array(
			'fields' => array('Job.id', 'Job.fullname', 'Building.code', 'Room.code', 'Statustype.code'),
			'contain' => array('Room', 'Building', 'Statustype')
		);
		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize', 'response');

	}

	public function dashboard() {
		$this->Job->recursive = 0;
		$this->set('jobs', $this->Paginator->paginate());
	}

	public function workplanner() {
		$this->Job->recursive = 0;
		$this->set('jobs', $this->Paginator->paginate());
	}

	public function schedule() {
		$this->autoRender = false;

		debug($_POST['sort']);

		if ($this->RequestHandler->isAjax()) {
			/*  foreach($_GET['item'] as $order => $id)
		$this->Feature->id = $id;
		$this->Feature->saveField('priority', $order);
		}*/
		}}

	public function complete() {
		$this->autoRender = false;
		$this->request->data['Job']['statustype_id'] = 3;

		if ($this->request->is(array('post', 'put'))) {
			if ($this->Job->save($this->request->data)) {
				$this->Session->setFlash(__('Saved'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}

		}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Job->exists($id)) {
			throw new NotFoundException(__('Invalid job'));
		}
		$options = array('conditions' => array('Job.' . $this->Job->primaryKey => $id));
		$this->set('job', $this->Job->find('first', $options));
	}

	public function getJob($id = null) {
		if (!$this->Job->exists($id)) {
			throw new NotFoundException(__('Invalid job'));
		}
		$options = array('conditions' => array('Job.' . $this->Job->primaryKey => $id));
		$this->set('job', $this->Job->find('first', $options));

		$this->set('_serialize', 'job');
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {

			//Lets figure out what job template to use, I couldn't think of an elegant way to do this.

			$qs1 = $this->request->data['Job']['qs1ID'];
			$qs2 = $this->request->data['Job']['qs2ID'];
			$qs3 = $this->request->data['Job']['qs3ID'];
			$qs4 = $this->request->data['Job']['qs4ID'];
			$qs5 = $this->request->data['Job']['qs5ID'];

			if ($qs5):
				$templateID = $qs5;
			elseif ($qs4):
				$templateID = $qs4;
			elseif ($qs3):
				$templateID = $qs3;
			elseif ($qs2):
				$templateID = $qs2;
			else:
				$templateID = $qs1;
			endif;

			$this->request->data['Job']['statustype_id'] = 1;
			$this->request->data['Job']['jobtype_id'] = 1;
			$this->request->data['Job']['user_id'] = $this->Auth->user('id');
			$this->Job->create();

			if ($this->Job->save($this->request->data)) {

				//What job template does this question row relate to?
				$this->loadModel('Question');
				$question = $this->Question->find('first', array('conditions' => array('id' => $this->request->data['Job']['qs1ID'])));

				//Job template ID from find above

				$jobTemplateID = $question['Question']['jobtemplate_id'];

				//We have executed the save, so we need the job ID now to assosiate it to the tasks
				$lastJobID = $this->Job->getLastInsertID();

				//We know the the job template ID now so lets see what tasks need to be created for it.
				$this->loadModel('Jobtask');
				$jobTasks = $this->Jobtask->find('all', array('conditions' => array('jobtemplate_id' => $jobTemplateID)));

				// debug($jobTasks);

				$this->loadModel('Task');

				foreach ($jobTasks as $jobTask) {

					$this->Task->create();

					$this->Task->save(array(
						'job_id' => $lastJobID,
						'code' => $jobTask['Jobtask']['code'],
						'skill_id' => $jobTask['Jobtask']['skill_id'],
						'scheduled' => 0,
						'statustype_id' => 1,
						'created' => date("Y-m-d H:i:s")
					));

				}

				//$this->Model->create(); // Create a new record
				//$this->Model->save($row); // And save it

				$this->Session->setFlash(__('Your job has been raised'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'edit', $this->Job->id));
			} else {
				$this->Session->setFlash(__('The job could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->Job->User->find('list');
		$jobtypes = $this->Job->Jobtype->find('list');
		//$buildings = $this->Job->Building->find('list');
		$statustypes = $this->Job->Statustype->find('list');
		//$questions = $this->Job->Question->find('list',array('conditions' => array('parent_id' => 0),array(

		//          'fields'     => array('Question.code','Question.code'))));
		$this->set(compact('users', 'jobtypes', 'rooms', 'statustypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Job->exists($id)) {
			throw new NotFoundException(__('Invalid job'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Job->save($this->request->data)) {
				$this->Session->setFlash(__('The job has been saved.'), 'default', array('class' => 'alert alert-success'));
				//return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {

			$options = array('conditions' => array('Job.' . $this->Job->primaryKey => $id));
			$this->request->data = $this->Job->find('first', $options);

			//debug($this->request->data);
		}
		$users = $this->Job->User->find('list');
		$jobtypes = $this->Job->Jobtype->find('list');
		$rooms = $this->Job->Room->find('list');
		$buildings = $this->Job->Building->find('list');
		$statustypes = $this->Job->Statustype->find('list');
		$this->set(compact('users', 'jobtypes', 'rooms', 'statustypes', 'buildings'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Job->id = $id;
		if (!$this->Job->exists()) {
			throw new NotFoundException(__('Invalid job'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Job->delete()) {
			$this->Session->setFlash(__('The job has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The job could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
