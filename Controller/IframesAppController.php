<?php
/**
 * IframesApp Controller
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
App::uses('AppController', 'Controller');
App::uses('NetCommonsFrameAppController', 'NetCommons.Controller');

/**
 * IframesApp Controller
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @package NetCommons\Iframes\Controller
 */
class IframesAppController extends NetCommonsFrameAppController {

/**
 * Component name
 *
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @var array
 */
	public $components = array(
		'Security'
	);

}
