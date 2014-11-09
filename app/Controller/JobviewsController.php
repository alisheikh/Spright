<?php
App::uses('AppController', 'Controller');
/**
 * Jobviews Controller
 *
 * @property Jobview $Jobview
 * @property PaginatorComponent $Paginator
 */
class JobviewsController extends AppController {

	public $components = array('Paginator', 'RequestHandler');

	function gettasks() {

		$this->paginate = array(
			'fields' => array('DT_RowId', 'JobID', 'description', 'fullname',
				'SiteCode', 'BuildingCode', 'FloorCode', 'RoomCode', 'TaskCode',
				'qs1', 'qs2', 'qs3', 'qs4', 'qs5', 'Status', 'requester', 'created'),
			 'order' => array(
            'DT_RowId' => 'desc'
        )
		);

		$this->DataTable->mDataProp = true;

		$this->set('response', $this->DataTable->getResponse());

		$this->set('_serialize', 'response');

	}

}
