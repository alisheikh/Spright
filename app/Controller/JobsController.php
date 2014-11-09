<?php
App::uses('AppController', 'Controller');

// App::import('Vendor', 'When');

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

	public function schedule() {

		require_once (APP . 'Vendor' . DS . 'Recurr' . DS . 'autoload.php');

		$timezone = 'Australia/Perth';

		function getIcalDate($time, $incl_time = true) {
			return $incl_time ? date('Ymd\THis', $time) : date('Ymd', $time);
		}

		//$this->autoRender = false;

		if ($this->request->is(array('post'))) {

			debug($this->data);

			$startD = $this->data['Job']['startdate'];
			$endD = NULL;
			$count = $this->data['Job']['count'];
			$interval = $this->data['Job']['interval'];

			$interval = (int) $interval;
			$freq = $this->data['Job']['freq'];
			$runtime = $this->data['Job']['runtime'];

			$startDate = new \DateTime($startD, new \DateTimeZone($timezone));
			$endDate = new \DateTime($endD, new \DateTimeZone($timezone));// Optional

			$test = null;

			//Only set an end date if the "on" radio button is selected
			if ($runtime === 'SCHEDULED'):
				$endD = $this->data['Job']['enddate'];

				$rule = new \Recurr\Rule("FREQ=$freq;UNTIL=$endD;INTERVAL=$interval", $startDate, $endDate, $timezone);
			endif;

			if ($runtime === 'NEVER'):
				$rule = new \Recurr\Rule("FREQ=$freq;INTERVAL=$interval", $startDate, null, $timezone);

			endif;

			if ($runtime === 'COUNT'):
				$rule = new \Recurr\Rule("FREQ=$freq;COUNT=$count;INTERVAL=$interval", $startDate, null, $timezone);
			endif;

			$transformer = new \Recurr\Transformer\ArrayTransformer();

//$timezone        = 'America/New_York';
			//$startDate       = new \DateTime('2013-06-12 20:00:00', new \DateTimeZone($timezone));
			//$rule            = new \Recurr\Rule('FREQ=MONTHLY;COUNT=5', $startDate, $timezone);
			$textTransformer = new \Recurr\Transformer\TextTransformer();
			echo $textTransformer->transform($rule);

			echo "<pre>";

			//echo getIcalDate(time());

			foreach ($transformer->transform($rule)->toArray() as $numObject => $object) {

				echo $object->getStart()->format('Y-m-d H:i:s');
				echo "<br />";
			}
			echo "</pre>";

		}

	}

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

		$jobs = $this->Job->find('all', array('conditions' => array('deleted' => 0), 'fields' => array('id'),
			'order' => array('id DESC')
		));

		//Load Users into controller as we need to know what jobs we can assign people
		$this->loadModel('User');

		$this->User->contain('Task');
		$users = $this->User->find('all', array('conditions' => array('active' => 1)
		));

		$this->set('jobs', $jobs);
		$this->set('users', $users);
	}

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

				//We have executed the save, so we need the job ID now to assosiate it to the tasks
				$lastJobID = $this->Job->getLastInsertID();

				//What job template does this question row relate to?
				$this->loadModel('Question');
				$question = $this->Question->find('first', array('conditions' => array('Question.id' => $this->request->data['Job']['qs1ID'])));

				//Job template ID from find above

				if ($question['Question']['jobtemplate_id']):
					$jobTemplateID = $question['Question']['jobtemplate_id'];

					//A job template has been assigned to that question set row, so lets see what
					$this->loadModel('Jobtask');
					$jobTasks = $this->Jobtask->find('all', array('conditions' => array('jobtemplate_id' => $jobTemplateID)));

					if (sizeof($jobTasks <= 1)):
						$this->loadModel('Task');
						$this->Task->save(array(
							'job_id' => $lastJobID,
							'code' => 'General Task',
							'skill_id' => 1,
							'scheduled' => 0,
							'statustype_id' => 1,
							'created' => date("Y-m-d H:i:s")
						));
					else:

						//Tasks have been found, lets create them all
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

					endif;
				else:
					//Questionset has no custom template assigned, so lets use the default "general" template
					$this->loadModel('Task');
					$this->Task->save(array(
						'job_id' => $lastJobID,
						'code' => 'General Task',
						'skill_id' => 1,
						'scheduled' => 0,
						'statustype_id' => 1,
						'created' => date("Y-m-d H:i:s")
					));

				endif;

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
