<?php
App::uses('AppController', 'Controller');
/**
 * Jobtemplates Controller
 *
 * @property Jobtemplate $Jobtemplate
 * @property PaginatorComponent $Paginator
 */
class JobtemplatesController extends AppController {

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
		$this->Jobtemplate->recursive = 0;
		$this->set('jobtemplates', $this->Paginator->paginate());
	}

	public function getJobTemplates() {
		$this->paginate = array(
			'fields' => array('DT_RowId', 'code', 'description', 'created'),
			'conditions' => array('deleted' => 0));

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
		if (!$this->Jobtemplate->exists($id)) {
			throw new NotFoundException(__('Invalid jobtemplate'));
		}
		$options = array('conditions' => array('Jobtemplate.' . $this->Jobtemplate->primaryKey => $id));
		$this->set('jobtemplate', $this->Jobtemplate->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Jobtemplate->create();
			if ($this->Jobtemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The jobtemplate has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'edit', $this->Jobtemplate->id));
			} else {
				$this->Session->setFlash(__('The jobtemplate could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->Jobtemplate->exists($id)) {
			throw new NotFoundException(__('Invalid jobtemplate'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Jobtemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The jobtemplate has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jobtemplate could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {

			$options = array('conditions' => array('Jobtemplate.' . $this->Jobtemplate->primaryKey => $id));
			$options2 = array('conditions' => array('id' => $id), array('contain' => array('Skill')));
			//$this->set('tasks', $this->Paginator->paginate());

			$this->request->data = $this->Jobtemplate->find('first', $options);

			$this->set('tasks', $this->Jobtemplate->find('all', $options2));
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
		$this->Jobtemplate->id = $id;
		if (!$this->Jobtemplate->exists()) {
			throw new NotFoundException(__('Invalid jobtemplate'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Jobtemplate->delete()) {
			$this->Session->setFlash(__('The jobtemplate has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The jobtemplate could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
