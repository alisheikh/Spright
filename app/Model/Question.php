<?php
App::uses('AppModel', 'Model');
/**
 * Question Model
 *
 * @property Question $ParentQuestion
 * @property Jobtemplate $Jobtemplate
 * @property Question $ChildQuestion
 */
class Question extends AppModel {

	public $actsAs = array('Tree');
	public $displayField = 'code';

	public $virtualFields = array(
		'title' => 'Question.code');

/**
 * Behaviors
 *
 * @var array
 */

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
		'parent_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lft' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rght' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'jobtemplate_id' => array(
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
		'Jobtemplate' => array(
			'className' => 'Jobtemplate',
			'foreignKey' => 'jobtemplate_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		)
	);

// /**
	//  * hasMany associations
	//  *
	//  * @var array
	//  */
	// 	public $hasMany = array(
	// 		'ChildQuestion' => array(
	// 			'className' => 'Question',
	// 			'foreignKey' => 'parent_id',
	// 			'dependent' => false,
	// 			'conditions' => '',
	// 			'fields' => '',
	// 			'order' => '',
	// 			'limit' => '',
	// 			'offset' => '',
	// 			'exclusive' => '',
	// 			'finderQuery' => '',
	// 			'counterQuery' => ''
	// 		)
	// 	);

}
