<?php
App::uses('AppModel', 'Model');
/**
 * Faulttype Model
 *
 */
class Faulttype extends AppModel {

	public $displayField = 'code';

	public $virtualFields = array(
		'DT_RowId' => 'Faulttype.id',
	);

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
	);
}
