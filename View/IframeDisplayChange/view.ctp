<?php
/**
 * iframe display change view template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->element('manage_tab_header', array('tab' => 'displayChange')); ?>

<div class="modal-body">
	<div class="tab-content">
		<div id="nc-iframes-display-change-<?php echo $frameId; ?>" class="tab-pane active">
			<div>
				<form action="/iframes/iframe_display_change/view/<?php echo $frameId; ?>/"
					  id="IframeDisplayChangeForm<?php echo $frameId; ?>" name="iframeDisplayChange" novalidate>

					<?php echo $this->element('IframeDisplayChange/display_change_form'); ?>
				</form>
			</div>

			<?php echo $this->element('IframeDisplayChange/button'); ?>
		</div>
	</div>
</div>