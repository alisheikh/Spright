<?php
App::uses('AppModel', 'Model');
/**
 * Skill Model
 *
 * @property Jobtask $Jobtask
 */
class Skill extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'code';
	//var $hasAndBelongsToMany = array('User');

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Jobtask' => array(
			'className' => 'Jobtask',
			'foreignKey' => 'skill_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
	);
}
