<?php
/**
 * iframes edit template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

$tokens = $this->Token->getToken($tokenFields, $hiddenFields);
$results['iframe'] += $tokens;

echo $this->element('NetCommons.json',
		array('results' => $results));