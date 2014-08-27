<?php
/**
 * Iframe Model
 *
 * @property Block $Block
 * @property Language $Language
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Model
 */

App::uses('IframesAppModel', 'Iframes.Model');

/**
 * Iframe Model
 *
 * @property Block $Block
 * @property Language $Language
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Model
 */
class Iframe extends IframesAppModel {

/**
 * Validation rules
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @var     array
 */
	public $validate = array(
		'block_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'created_user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'modified_user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);

/**
 * belongsTo associations
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com
 * @since   NetCommons 3.0.0.0
 * @var     array
 */
	public $belongsTo = array(
		'Block' => array(
			'className' => 'Block',
			'foreignKey' => 'block_id',
			'conditions' => '',
			'type' => 'inner',
			'fields' => '',
			'order' => ''
		),
	);

/**
 * getByBlockId
 *
 * @param int $blockId blocks.id
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return null or int
 */
	public function getByBlockId($blockId) {
		$dd = $this->find(
			'first',
			array(
				'conditions' => array('Iframe.block_id' => $blockId)
			)
		);
		if (isset($dd['Iframe'])
			&& isset($dd['Iframe']['id'])
			&& $dd['Iframe']['id']
		) {
			return $dd['Iframe']['id'];
		}
		return null;
	}
}
