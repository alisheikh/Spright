<?php
App::uses('AppController', 'Controller');
/**
 * Jobviews Controller
 *
 * @property Jobview $Jobview
 * @property PaginatorComponent $Paginator
 */
class ApisController extends AppController {

	public $components = array('Paginator', 'RequestHandler');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->response->header('Access-Control-Allow-Origin', '*');
		$this->response->header('Access-Control-Allow-Methods', '*');
		$this->response->header('Access-Control-Allow-Headers', '*');
		$this->response->header('Access-Control-Max-Age', '172800');
	}

/**
 *
 * Works MOdule
 *
 **/

	//Get all jobs and tasks.
	function gettasks() {

		$this->Api->setSource('jobviews');

		$this->paginate = array(
			'fields' => array('DT_RowId', 'JobID', 'description', 'fullname',
				'SiteCode', 'BuildingCode', 'FloorCode', 'RoomCode', 'TaskCode',
				'qs1', 'qs2', 'qs3', 'qs4', 'qs5', 'Status', 'requester', 'scheduled', 'created'),
			'order' => array(
				'DT_RowId' => 'desc',
			),
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());

		$this->set('_jsonp', true);
		$this->set('_serialize', 'response');

	}

	function getyourtasks() {

		$this->Api->setSource('jobviews');
		$user_id = $this->Auth->user('id');

		$this->paginate = array(
			'fields' => array('DT_RowId', 'JobID', 'description', 'status', 'fullname',
				'SiteCode', 'BuildingCode', 'FloorCode', 'RoomCode', 'TaskCode',
				'qs1', 'qs2', 'qs3', 'qs4', 'qs5', 'Status', 'requester', 'scheduled', 'created', 'statustype_id'),
			'conditions' => array(
				'user_id' => $user_id, 'statustype_id' => array('2','6') //2: Scheduled 6: Accepted
			),
			'order' => array(
				'DT_RowId' => 'desc',
			),
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize', 'response');

	}

	//Get all jobs and no tasks
	function getjobs() {

		$this->Api->setSource('worklistviews');

		$test = $this->paginate = array(
			'fields' => array('DT_RowId', 'jobID', 'description', 'fullname',
				'SiteCode', 'BuildingCode', 'FloorCode', 'RoomCode',
				'qs1', 'qs2', 'qs3', 'qs4', 'qs5', 'Status', 'requester', 'created', 'statustype_id'),
			'conditions' => array(
				'statustype_id' => array(1, 2),
			),
			'order' => array(
				'DT_RowId' => 'desc',
			),
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize', 'response');

	}

	//Return all jobs raised by your
	function yourjobs() {

		$this->Api->setSource('worklistviews');

		$test = $this->paginate = array(
			'fields' => array('DT_RowId', 'jobID', 'description', 'fullname',
				'SiteCode', 'BuildingCode', 'FloorCode', 'RoomCode',
				'qs1', 'qs2', 'qs3', 'qs4', 'qs5', 'Status', 'requester', 'created', 'statustype_id'),
			'conditions' => array(
				'statustype_id' => array(1, 2), 'user_id' => $this->Auth->user('id'),
			),
			'order' => array(
				'DT_RowId' => 'desc',
			),
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize', 'response');

	}

/**
 *
 * Asset Module
 *
 **/

	//Return all jobs raised by your
	function assetList() {

		$this->Api->setSource('assetlist');

		$test = $this->paginate = array(
			'fields' => array('DT_RowId', 'asset', 'site', 'building', 'floor', 'room', 'description', 'status', 'serial', 'make', 'manufacturer', 'cost', 'created', 'modified'),

			'order' => array(
				'DT_RowId' => 'desc',
			),
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize', 'response');

	}

/**
 *
 * Mobile Spright.
 *
 **/

	function updateTask() {
		header('Access-Control-Allow-Origin: *');

		$this->autoRender = false;

		if ($this->request->is('post')) {

			$action = $this->request->data('action');

			$this->loadModel('Task');

			$this->Task->id = $this->request->data('task_id');

			if ($action === "accept"):

				if ($this->Task->saveField('statustype_id', 6)):

					echo '{"success":true}';

				else:

					echo '{"success":false}';

				endif;

			endif;

			if ($action === "reject"):

			endif;

		}

	}

}
