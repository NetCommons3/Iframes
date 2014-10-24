<?php
/**
 * iframe edit view template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div class="alert" align="center"
		id="nc-iframes-display-change-message-<?php echo (int)$frameId; ?>"
		ng-show="visibleDisplayChangeMsg">
	<span class="message">  </span>
</div>