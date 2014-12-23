<?php
App::uses('AppController', 'Controller');
require_once (APP . 'Vendor' . DS . 'Recurr' . DS . 'autoload.php');
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

	public function ical($id = null) {

		$this->autoRender = false;

		require_once (APP . 'Vendor' . DS . 'iCalcreator.class.php');

		if (!$this->Schedule->exists($id)) {
			throw new NotFoundException(__('Invalid schedule'));
		}
		$options = array('conditions' => array('Schedule.' . $this->Schedule->primaryKey => $id));

		$schedule = $this->Schedule->find('first', $options);

		//debug($schedule);

		$id = $schedule['Schedule']['id'];
		$startDate = $schedule['Schedule']['startdate'];
		$endDate = $schedule['Schedule']['enddate'];
		$code = $schedule['Schedule']['code'];
		$description = $schedule['Schedule']['description'];
		$completionTime = $schedule['Schedule']['completiontime'];
		$runTime = $schedule['Schedule']['runtime'];
		$freq = $schedule['Schedule']['freq'];
		$interval = $schedule['Schedule']['intval'];
		$byday = $schedule['Schedule']['byday'];

		$occurenceEndTime = $new_time = date($startDate, strtotime('+' . $completionTime . ' hours'));

		$tz = "Europe/Stockholm";// define time zone
		$config = array("unique_id" => $id, // set Your unique id,
			// required if any component UID is missing
			"TZID" => $tz);// opt. set "calendar" timezone
		$v = new vcalendar($config);// create a new calendar object instance

		$v->setProperty("method", "PUBLISH");// required of some calendar software
		$v->setProperty("x-wr-calname", $code);// required of some calendar software
		$v->setProperty("X-WR-CALDESC", $description);// required of some calendar software
		$v->setProperty("X-WR-TIMEZONE", $tz);// required of some calendar software

		$xprops = array("X-LIC-LOCATION" => $tz);// required of some calendar software
		iCalUtilityFunctions::createTimezone($v, $tz, $xprops);// create timezone component(-s) opt. 1

		$vevent = &$v->newComponent("vevent");// create an event calendar component
		$vevent->setProperty("dtstart", $startDate);
		$vevent->setProperty("dtend", $occurenceEndTime);
		$vevent->setProperty("LOCATION", "Central Placa");// property name - case independent
		$vevent->setProperty("summary", $code);
		$vevent->setProperty("description", $description);
		$vevent->setProperty("comment", $description);
		$vevent->setProperty("attendee", "adminemail@spright.com.au");

		switch ($runTime) {
			case "SCHEDULED":
				$RRULE = array("FREQ" => $freq, "UNTIL" => $endDate, 'INTERVAL' => $interval);
			case "NEVER":
				$RRULE = array("FREQ" => $freq, 'INTERVAL' => $interval);
		}

		$vevent->setProperty("rrule", $RRULE);

		$v->returnCalendar();
	}

	public function forecast($type = null) {

		$this->autoRender = false;
		$timezone = 'Australia/Perth';

		//Get current date
		$date = date("Y-m-d H:i:s");

		$schedules = $this->Schedule->find('all', array('conditions' => array('active' => '1', "startdate BETWEEN '" . $date . "' AND DATE_ADD('" . $date . "', INTERVAL 30 DAY)")));

		foreach ($schedules as $schedule):

			$code = $schedule['Schedule']['code'];
			$startD = $schedule['Schedule']['startdate'];
			$endD = NULL;
			$interval = $schedule['Schedule']['intval'];
			$freq = $schedule['Schedule']['freq'];
			$runTime = $schedule['Schedule']['runtime'];
			$byday = $schedule['Schedule']['byday'];
			$startDate = new \DateTime($startD, new \DateTimeZone($timezone));
			$endDate = new \DateTime($endD, new \DateTimeZone($timezone));// Optional
			$test = null;

			//Determine the RRULE
			//Refer to http://tools.ietf.org/html/rfc2445 for more information

			if ($runTime === "SCHEDULED"):
				$RRULE = "FREQ=$freq;UNTIL=$endD;INTERVAL=$interval";
			elseif ($runTime === "NEVER"):
				$RRULE = "FREQ=$freq;INTERVAL=$interval";
			elseif ($runTime === "COUNT"):
				$RRULE = "FREQ=$freq;COUNT=$count;INTERVAL=$interval";
			endif;

			echo "<h1>Dates for $runTime ($code) </h1>";
			echo "<h2>$RRULE</h2>";
			echo "<h3>" . date('Y-m-d H:i:s', strtotime($date . ' + 5 days')) . "</h3>";
			$rule = new \Recurr\Rule($RRULE, $startDate, null, $timezone);
			$transformer = new \Recurr\Transformer\ArrayTransformer();

			$textTransformer = new \Recurr\Transformer\TextTransformer();

			foreach ($transformer->transform($rule)->toArray() as $numObject => $object):
				if ($object->getStart()->format('Y-m-d H:i:s') < date('Y-m-d', strtotime($date . ' + 40 days'))):
					echo $object->getStart()->format('Y-m-d H:i:s');
					echo "<br />";
				endif;
			endforeach;

		endforeach;

		//debug($schedules);
	}

	public function add() {

		$jobTemplates = $this->Schedule->Jobtemplate->find('list');

		$this->set(compact('jobTemplates'));

		if ($this->request->is('post')) {
			$this->Schedule->create();
			
			if ($this->request->is('post')) {

				$timezone = 'Australia/Perth';

				function getIcalDate($time, $incl_time = true) {
					return $incl_time ? date('Ymd\THis', $time) : date('Ymd', $time);
				}

				$this->autoRender = false;

				debug($this->request->data);

				$startD = $this->data['Schedule']['startdate'];
				$endD = NULL;
				$interval = $this->data['Schedule']['intval'];
				$freq = $this->data['Schedule']['freq'];
				$runtime = $this->data['Schedule']['runtime'];
				$startDate = new \DateTime($startD, new \DateTimeZone($timezone));
				$endDate = new \DateTime($endD, new \DateTimeZone($timezone));// Optional
				$byday = $this->data['Schedule']['byday'];
				$byday = implode(",", $byday);
				$date = date("Y-m-d");

				$RRULE = "FREQ=$freq;INTERVAL=$interval;";

				if ($freq === "WEEKLY"):
					$RRULE .= ";BYDAY=$byday";
				endif;

				if ($runtime === "SCHEDULED"):
					$RRULE .= ";UNTIL=$endDate";
				endif;

				echo "RULE : " . $RRULE . "<br />";

				$rule = new \Recurr\Rule($RRULE, $startDate, null, $timezone);
				$transformer = new \Recurr\Transformer\ArrayTransformer();

				$textTransformer = new \Recurr\Transformer\TextTransformer();
				echo $textTransformer->transform($rule);

				echo "<pre>";

				//echo getIcalDate(time());

				//$originalArray = $transformer->transform($rule)->toArray();

				//$scheduleValues = array_slice($originalArray, 0, 31, true);
				$futureDate = date('Y-m-d', strtotime($date . ' + 40 days'));
				echo "$date Created jobs until " . $futureDate . "<br />";
				echo "<hr>";

				foreach ($transformer->transform($rule)->toArray() as $numObject => $object):
					if ($object->getStart()->format('Y-m-d H:i:s') <= $futureDate):
						echo $object->getStart()->format('Y-m-d H:i:s');
						echo "<br />";
					endif;
				endforeach;

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
