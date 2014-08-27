<?php
/**
 * IframeFrame Model
 *
 * @property Iframe $Iframe
 * @property Frame $Frame
 *
 * @author      Noriko Arai <arai@nii.ac.jp>
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link        http://www.netcommons.org NetCommons Project
 * @license     http://www.netcommons.org/license.txt NetCommons License
 * @copyright   Copyright 2014, NetCommons Project
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Model
 */

App::uses('AppModel', 'Model');

/**
 * IframeFrame Model
 *
 * @property Iframe $Iframe
 * @property Frame $Frame
 *
 * @author      Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since       NetCommons 3.0.0.0
 * @package     app.Plugin.Iframes.Model
 */
class IframeFrame extends AppModel {

/**
 * table name
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @var     string
 */
	public $useTable = 'frames';

/**
 * model name
 *
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @var     string
 */
	public $name = 'IframeFrame';

/**
 * Get blockId from frameId
 *
 * @param int $frameId frames.id
 * @author  Kotaro Hokada <kotaro.hokada@gmail.com>
 * @since   NetCommons 3.0.0.0
 * @return  int blocks.id
 */
	public function getBlockId($frameId) {
		if (! $frameId) {
			return null;
		}
		$frame = $this->findById($frameId);
		if ($frame && $frame[$this->name]['block_id']) {
			return $frame[$this->name]['block_id'];
		}
		return null;
	}
}