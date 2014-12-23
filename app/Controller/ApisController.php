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



}
