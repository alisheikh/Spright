<?php
App::uses('AppController', 'Controller');
/**
 * Statustypes Controller
 *
 * @property Statustype $Statustype
 * @property PaginatorComponent $Paginator
 */
class StatustypesController extends AppController {

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
		$this->Statustype->recursive = 0;
		$this->set('statustypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Statustype->exists($id)) {
			throw new NotFoundException(__('Invalid statustype'));
		}
		$options = array('conditions' => array('Statustype.' . $this->Statustype->primaryKey => $id));
		$this->set('statustype', $this->Statustype->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Statustype->create();
			if ($this->Statustype->save($this->request->data)) {
				$this->Session->setFlash(__('The statustype has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The statustype could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->Statustype->exists($id)) {
			throw new NotFoundException(__('Invalid statustype'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Statustype->save($this->request->data)) {
				$this->Session->setFlash(__('The statustype has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The statustype could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Statustype.' . $this->Statustype->primaryKey => $id));
			$this->request->data = $this->Statustype->find('first', $options);
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
		$this->Statustype->id = $id;
		if (!$this->Statustype->exists()) {
			throw new NotFoundException(__('Invalid statustype'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Statustype->delete()) {
			$this->Session->setFlash(__('The statustype has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The statustype could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
