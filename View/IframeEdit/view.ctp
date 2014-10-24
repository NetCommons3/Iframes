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

<?php echo $this->element('manage_tab_header', array('tab' => 'edit')); ?>

<div class="modal-body">
	<div class="tab-content">
		<div id="nc-iframes-edit-<?php echo $frameId; ?>" class="tab-pane active">
			<div>
				<form action="/iframes/iframe_edit/view/<?php echo $frameId; ?>/"
					  id="IframeEditForm<?php echo $frameId; ?>" name="iframeEdit" novalidate>

					<?php echo $this->element('IframeEdit/edit_form'); ?>
					<?php echo $this->element('IframeEdit/common_form'); ?>

				</form>
			</div>

			<?php echo $this->element('IframeEdit/button'); ?>

		</div>
	</div>
</div>