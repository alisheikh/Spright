<?php
App::uses('AppController', 'Controller');
/**
 * Faulttypes Controller
 *
 * @property Faulttype $Faulttype
 * @property PaginatorComponent $Paginator
 */
class FaulttypesController extends AppController {

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
		$this->Faulttype->recursive = 0;
		$this->set('faulttypes', $this->Paginator->paginate());
	}

	public function getfaulttypes() {
		$this->paginate = array(
			'fields' => array('DT_RowId', 'code', 'created'),
		);
		$this->DataTable->mDataProp = true;
		$this->set('response', $this->DataTable->getResponse());
		$this->set('_serialize', 'response');

	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Faulttype->exists($id)) {
			throw new NotFoundException(__('Invalid faulttype'));
		}
		$options = array('conditions' => array('Faulttype.' . $this->Faulttype->primaryKey => $id));
		$this->set('faulttype', $this->Faulttype->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Faulttype->create();
			if ($this->Faulttype->save($this->request->data)) {
				$this->Session->setFlash(__('The faulttype has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The faulttype could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->Faulttype->exists($id)) {
			throw new NotFoundException(__('Invalid faulttype'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Faulttype->save($this->request->data)) {
				$this->Session->setFlash(__('The faulttype has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The faulttype could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Faulttype.' . $this->Faulttype->primaryKey => $id));
			$this->request->data = $this->Faulttype->find('first', $options);
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
		$this->request->data['faulttype_id'] = $id;
		
		if (!$this->Faulttype->exists()) {
			throw new NotFoundException(__('Invalid faulttype'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Faulttype->delete()) {

		} else {
			throw new NotFoundException(__('Invalid faulttype'));
		}

	}
}
