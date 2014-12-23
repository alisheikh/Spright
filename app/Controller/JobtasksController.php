<?php
App::uses('AppController', 'Controller');
/**
 * Jobtasks Controller
 *
 * @property Jobtask $Jobtask
 * @property PaginatorComponent $Paginator
 */
class JobtasksController extends AppController {

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
		$this->Jobtask->recursive = 0;
		$this->set('jobtasks', $this->Paginator->paginate());
	}

	public function getJobTemplateTasks() {

		// $this->paginate = array(
		// 	'fields' => array('Skill.code', 'DT_RowId', 'Jobtask.code', 'Jobtask.description', 'Jobtask.created'),
		// 	'contain' => array('Skill'),
		// 	'conditions' => array('Jobtask.id' => 3));

		$this->paginate = array(
			// 'fields' => array('Jobtask.code'),
			'link' => array(
				'Skill',
			),
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
		if (!$this->Jobtask->exists($id)) {
			throw new NotFoundException(__('Invalid jobtask'));
		}
		$options = array('conditions' => array('Jobtask.' . $this->Jobtask->primaryKey => $id));
		$this->set('jobtask', $this->Jobtask->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id = 1) {
		if ($this->request->is('post')) {

			$this->request->data['Jobtask']['jobtemplate_id'] = $id;

			$this->Jobtask->create();
			if ($this->Jobtask->save($this->request->data)) {
				$this->Session->setFlash(__('The jobtask has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('controller' => 'jobtemplates', 'action' => 'view/' . $id));
			} else {
				$this->Session->setFlash(__('The jobtask could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$jobtemplates = $this->Jobtask->Jobtemplate->find('list');
		$skills = $this->Jobtask->Skill->find('list');
		$this->set(compact('jobtemplates', 'skills'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Jobtask->exists($id)) {
			throw new NotFoundException(__('Invalid jobtask'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Jobtask->save($this->request->data)) {
				$this->Session->setFlash(__('The jobtask has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jobtask could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Jobtask.' . $this->Jobtask->primaryKey => $id));
			$this->request->data = $this->Jobtask->find('first', $options);
		}
		$jobtemplates = $this->Jobtask->Jobtemplate->find('list');
		$skills = $this->Jobtask->Skill->find('list');
		$this->set(compact('jobtemplates', 'skills'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Jobtask->id = $id;
		if (!$this->Jobtask->exists()) {
			throw new NotFoundException(__('Invalid jobtask'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Jobtask->delete()) {
			$this->Session->setFlash(__('The jobtask has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The jobtask could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
