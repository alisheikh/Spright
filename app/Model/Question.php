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
