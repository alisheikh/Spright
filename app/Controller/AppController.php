<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

//'DebugKit.Toolbar,'
class AppController extends Controller {

	public $components = array('DataTable','DebugKit.Toolbar',
		'Acl',
		'Auth' => array(
			'authorize' => array(
				'Actions' => array('actionPath' => 'controllers'),
			),
		),
		'Session',
	);

	public $helpers = array(
		'Session',
		'Html' => array('className' => 'BoostCake.BoostCakeHtml'),
		'Form' => array('className' => 'BoostCake.BoostCakeForm'),
		'Paginator' => array('className' => 'BoostCake.BoostCakePaginator'),
	);

	public function recordActivity() {

		$user_id = $this->Auth->user('id');

		if ($user_id):

			$this->loadModel('User');

			$data = array(
				'id' => $user_id,
				'lastactive' => date('Y-m-d H:i:s'),
				'modified' => false,
			);

			$this->User->save($data, array('callbacks' => false, 'validate' => false));
		endif;
	}

	public function beforeFilter() {

		Configure::write('current_controller', $this->name);

		$this->recordActivity();

		$this->Auth->allow();

		$this->layout = 'sprightv2';

		//Configure AuthComponent
		$this->Auth->loginAction = array(
			'controller' => 'users',
			'action' => 'login',
		);
		$this->Auth->logoutRedirect = array(
			'controller' => 'users',
			'action' => 'login',
		);
		$this->Auth->loginRedirect = array(
			'controller' => 'jobs',
			'action' => 'dashboard',
		);
	}

}
