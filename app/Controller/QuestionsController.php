<?php
App::uses('AppController', 'Controller');
/**
 * Questions Controller
 *
 * @property Question $Question
 * @property PaginatorComponent $Paginator
 */
class QuestionsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'RequestHandler');

	public function getquestion() {

		if (isset($_GET['data']['Job']['qs1'])):
			$question_id = $_GET['data']['Job']['qs1'];
		endif;

		if (isset($_GET['data']['Job']['qs2'])):
			$question_id = $_GET['data']['Job']['qs2'];
		endif;

		if (isset($_GET['data']['Job']['qs3'])):
			$question_id = $_GET['data']['Job']['qs3'];
		endif;

		if (isset($_GET['data']['Job']['qs4'])):
			$question_id = $_GET['data']['Job']['qs4'];
		endif;

		if (isset($_GET['data']['Job']['qs5'])):
			$question_id = $_GET['data']['Job']['qs5'];
		endif;

		$json = $this->Question->find('list', array(
			'conditions' => array('parent_id' => $question_id),
			'recursive' => -1
		));

		if (sizeof($json) >= 1) {
			$json = array('0' => '--') + $json;

		}

		$this->set('json', $json);
		$this->set('_serialize', 'json');

	}

	public function updateCode() {
		$this->autoRender = false;
		if ($this->request->is('post')) {

			$this->Question->save($this->request->data);
		}
	}

	function view($id = null) {

		if ($id == null) {die("No ID received");
		}

		//$id = $this->request->query['id'];

		$idExist = $this->Question->findById($id);
		if (!$idExist) {
			throw new NotFoundException(__('Invalid ID'));
		}

		$questions = $this->Question->find('all', array('conditions' => array('Question.id' => $id)
			, 'fields' => array('Question.id', 'Question.code', 'Jobtemplate.code', 'Question.jobtemplate_id'),

		));

		function mapThreaded($source, &$target) {
			foreach ($source as $item) {
				$node = array
				(
					'data[Question][id]' => $item['Question']['id'],
					'data[Question][code]' => $item['Question']['code'],
					'data[Question][jobtemplate_id]' => $item['Question']['jobtemplate_id'],

				);

				$target[] = $node;
			}
		}

		$tree = array();

		mapThreaded($questions, $tree);

		$results = $this->set('json', $tree);

		$this->set('_serialize', 'json');

	}

/**
 * index method
 *
 * @return void
 */
	function index() {
		//$Questionlist = $this->Question->generateTreeList(null, null, null, " - ");

		//.$Questionlist = $this->Question->find('all');

		//$this->loadModel('Jobtemplate');
		$jobTemplates = $this->Question->Jobtemplate->find('list');

		$this->set(compact('jobTemplates'));
	}

	function buildQuestion() {

		if (isset($_GET['root'])) {

			$questions = $this->Question->find('all', array('conditions' => array('Question.parent_id' => 0),
				'fields' => array('code', 'id', 'lazy', 'folder'),
				'order' => array('lft ASC')
			));

		} elseif (isset($_GET['key'])) {
			$key = ltrim($_GET['key'], '_');

			$questions = $this->Question->find('all', array('conditions' => array('Question.parent_id' => $_GET['key']),
				'fields' => array('code', 'id', 'lazy', 'folder'),
				'order' => array('lft ASC')
			));

		}

		function mapThreaded($source, &$target) {
			foreach ($source as $item) {
				$node = array
				(
					'key' => $item['Question']['id'],
					'title' => $item['Question']['code'],
					'lazy' => $item['Question']['lazy'],
					'folder' => $item['Question']['folder'],
					'children' => array()
				);

				//	if (count($item['children'])) {
				//		mapThreaded($item['children'], $node['children']);
				//	}

				$target[] = $node;
			}
		}

		$tree = array();

		mapThreaded($questions, $tree);

		$results = $this->set('json', $tree);

		$this->set('_serialize', 'json');

	}

	public function saveCode() {

		$this->autoRender = false;

		//GET Variables
		$code = $this->request->query['code'];
		$id = $this->request->query['id'];

		$this->request->data['Question']['code'] = $code;
		$this->request->data['Question']['parent_id'] = $id;

		//Lets save it now but only if this request is via a GET request
		if ($this->request->is('get')) {

			$this->Question->save($this->request->data);

			echo $this->Question->getLastInsertID();

		}

	}

	function add() {
		if (!empty($this->data)) {
			$this->Question->save($this->data);
			$this->redirect(array('action' => 'index'));
		} else {
			$parents[0] = "[ No Parent ]";
			$Questionlist = $this->Question->generateTreeList(null, null, null, " - ");
			if ($Questionlist) {
				foreach ($Questionlist as $key => $value) {
					$parents[$key] = $value;
				}
				$this->set(compact('parents'));
			}
		}
	}

	function edit($id = null) {
		if (!empty($this->data)) {
			if ($this->Question->save($this->data) == false) {
				$this->Session->setFlash('Error saving Question.');
			}

			$this->redirect(array('action' => 'index'));
		} else {
			if ($id == null) {die("No ID received");
			}

			$this->data = $this->Question->read(null, $id);
			$parents[0] = "[ No Parent ]";
			$Questionlist = $this->Question->generatetreelist(null, null, null, " - ");
			if ($Questionlist) {
				foreach ($Questionlist as $key => $value) {
					$parents[$key] = $value;
				}
			}

			$this->set(compact('parents'));
		}
	}

	function delete($id = null) {
		$this->autoRender = false;
		
		if ($id == null) {
			die("No ID received");
		}

		$this->Question->id = $id;
		if ($this->Question->delete() == false) {

		}
	}

	function deleteCode() {
		$id = $this->request->query['key'];
		if ($id == null) {
			die("Invalid node ID provided");
		}

		if ($this->request->is('get')) {
			$this->Question->id = $id;
			$this->Question->delete();
		}
	}

	function moveup($id = null) {
		if ($id == null) {
			die("No ID received");
		}

		$this->Question->id = $id;
		if ($this->Question->moveup() == false) {
			$this->Session->setFlash('The Question could not be moved up.');
		}

		$this->redirect(array('action' => 'index'));
	}

	function movedown($id = null) {
		if ($id == null) {
			die("No ID received");
		}

		$this->Question->id = $id;
		if ($this->Question->movedown() == false) {
			$this->Session->setFlash('The Question could not be moved down.');
		}

		$this->redirect(array('action' => 'index'));
	}
	function removeNode($id = null) {
		if ($id == null) {
			die("Nothing to Remove");
		}

		if ($this->Question->removeFromTree($id) == false) {
			$this->Session->setFlash('The Question can\'t be removed.');
		}

		$this->redirect(array('action' => 'index'));
	}

}
