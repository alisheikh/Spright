<?php
App::uses('AppModel', 'Model');
/**
 * Code Model
 *
 * @property Code $ParentCode
 * @property Code $ChildCode
 */
class Code extends AppModel {

	public $actsAs = array('Tree',
	);

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'code';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'code' => array(
			'notEmpty' => array(
				'rule' => array('isUnique'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)
	);

	public $hasMany = array(
		'Attachment' => array(
			'className'    => 'Attachment',
			'foreignKey'   => 'foreign_key',
			'dependent'    => false,
			'conditions'   => '',
			'fields'       => '',
			'order'        => '',
			'limit'        => '',
			'offset'       => '',
			'exclusive'    => '',
			'finderQuery'  => '',
			'counterQuery' => '',
		)
	);

	public $belongsTo = array(
		'Site' => array(
			'className'  => 'Code',
			'foreignKey' => 'site_id',
		),
		'Building' => array(
			'className'  => 'Code',
			'foreignKey' => 'building_id',
		),
		'Floor' => array(
			'className'  => 'Code',
			'foreignKey' => 'floor_id',
		),
		'Room' => array(
			'className'  => 'Code',
			'foreignKey' => 'room_id',
		)
	);

}
