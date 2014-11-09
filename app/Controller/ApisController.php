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

	//Get all jobs and tasks.
	function gettasks() {

		$this->Api->setSource('jobviews');

		$this->paginate = array(
			'fields' => array('DT_RowId', 'JobID', 'description', 'fullname',
				'SiteCode', 'BuildingCode', 'FloorCode', 'RoomCode', 'TaskCode',
				'qs1', 'qs2', 'qs3', 'qs4', 'qs5', 'Status', 'requester', 'scheduled', 'created'),
			'order' => array(
				'DT_RowId' => 'desc',
			)
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize', 'response');

	}

	//Get all jobs and no tasks
	function getjobs() {

		$this->Api->setSource('worklistviews');

		$this->paginate = array(
			'fields' => array('DT_RowId', 'jobID', 'description', 'fullname',
				'SiteCode', 'BuildingCode', 'FloorCode', 'RoomCode',
				'qs1', 'qs2', 'qs3', 'qs4', 'qs5', 'Status', 'requester', 'created'),
			'order' => array(
				'DT_RowId' => 'desc',
			)
		);

		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize', 'response');

	}

}
