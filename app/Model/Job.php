<?php
App::uses('AppModel', 'Model');
/**
 * Job Model
 *
 * @property User $User
 * @property Jobtype $Jobtype
 * @property Room $Room
 * @property Statustype $Statustype
 * @property Joblog $Joblog
 * @property Task $Task
 * @property Jobtemplate $Jobtemplate
 */
class Job extends AppModel {

	public $actsAs = array('Containable');

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'jobtype_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'room_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'statustype_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'Jobtype' => array(
			'className' => 'Jobtype',
			'foreignKey' => 'jobtype_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'Room' => array(
			'className' => 'Room',
			'foreignKey' => 'room_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
		'Statustype' => array(
			'className' => 'Statustype',
			'foreignKey' => 'statustype_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
				'Site' => array(
			'className' => 'Code',
			'foreignKey' => 'site_id',
			'conditions' => '',
			'fields' => 'code',
			'order' => '',
		),
		'Building' => array(
			'className' => 'Code',
			'foreignKey' => 'building_id',
			'conditions' => '',
			'fields' => 'code',
			'order' => '',
		),
				'Floor' => array(
			'className' => 'Code',
			'foreignKey' => 'floor_id',
			'conditions' => '',
			'fields' => 'code',
			'order' => '',
		),		'Room' => array(
			'className' => 'Code',
			'foreignKey' => 'room_id',
			'conditions' => '',
			'fields' => 'code',
			'order' => '',
		),
				'Asset' => array(
			'className' => 'Code',
			'foreignKey' => 'asset_id',
			'conditions' => '',
			'fields' => 'code',
			'order' => '',
		),
		'Qs1' => array(
			'className' => 'Question',
			'foreignKey' => 'qs1',
			'conditions' => '',
			'fields' => 'code',
			'order' => '',
		),
		'Qs2' => array(
			'className' => 'Question',
			'foreignKey' => 'qs2',
			'conditions' => '',
			'fields' => 'code',
			'order' => '',
		),
		'Qs3' => array(
			'className' => 'Question',
			'foreignKey' => 'qs3',
			'conditions' => '',
			'fields' => 'code',
			'order' => '',
		),
		'Qs4' => array(
			'className' => 'Question',
			'foreignKey' => 'qs4',
			'conditions' => '',
			'fields' => 'code',
			'order' => '',
		),
		'Qs5' => array(
			'className' => 'Question',
			'foreignKey' => 'qs5',
			'conditions' => '',
			'fields' => 'code',
			'order' => '',
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Joblog' => array(
			'className' => 'Joblog',
			'foreignKey' => 'job_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => '',
		),
		'Task' => array(
			'className' => 'Task',
			'foreignKey' => 'job_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => '',
		)
	);

}
