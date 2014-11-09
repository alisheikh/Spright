<?php
App::uses('AppController', 'Controller');
/**
 * Schedules Controller
 *
 * @property Schedule $Schedule
 * @property PaginatorComponent $Paginator
 */
class SchedulesController extends AppController {

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
		$this->Schedule->recursive = 0;
		$this->set('schedules', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Schedule->exists($id)) {
			throw new NotFoundException(__('Invalid schedule'));
		}
		$options = array('conditions' => array('Schedule.' . $this->Schedule->primaryKey => $id));
		$this->set('schedule', $this->Schedule->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Schedule->create();
			if ($this->Schedule->save($this->request->data)) {
				


		require_once (APP . 'Vendor' . DS . 'Recurr' . DS . 'autoload.php');

		$timezone = 'Australia/Perth';

		function getIcalDate($time, $incl_time = true) {
			return $incl_time ? date('Ymd\THis', $time) : date('Ymd', $time);
		}

		//$this->autoRender = false;

		if ($this->request->is(array('post'))) {

			debug($this->data);

			$startD = $this->data['Schedule']['startdate'];
			$endD = NULL;
			$count = $this->data['Schedule']['count'];
			$interval = $this->data['Schedule']['interval'];

			$interval = (int) $interval;
			$freq = $this->data['Schedule']['freq'];
			$runtime = $this->data['Schedule']['runtime'];

			$startDate = new \DateTime($startD, new \DateTimeZone($timezone));
			$endDate = new \DateTime($endD, new \DateTimeZone($timezone));// Optional

			$test = null;

			//Only set an end date if the "on" radio button is selected
			if ($runtime === 'SCHEDULED'):
				$endD = $this->data['Schedule']['enddate'];

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



				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schedule could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
	public function edit($id = null) {
		if (!$this->Schedule->exists($id)) {
			throw new NotFoundException(__('Invalid schedule'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Schedule->save($this->request->data)) {
				$this->Session->setFlash(__('The schedule has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The schedule could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Schedule.' . $this->Schedule->primaryKey => $id));
			$this->request->data = $this->Schedule->find('first', $options);
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
		$this->Schedule->id = $id;
		if (!$this->Schedule->exists()) {
			throw new NotFoundException(__('Invalid schedule'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Schedule->delete()) {
			$this->Session->setFlash(__('The schedule has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The schedule could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
