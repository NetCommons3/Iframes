<?php
/**
 * iframes view template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->Html->script('/iframes/js/iframes.js'); ?>

<?php if ($contentEditable) : ?>
	<div id="nc-iframes-<?php echo (int)$frameId; ?>"
		 ng-controller="Iframes"
		 ng-init="initialize(<?php echo (int)$frameId; ?>,
					<?php echo h(json_encode($iframe)); ?>,
					<?php echo h(json_encode($iframeFrameSetting)); ?>)">

		<p class="text-right">
			<?php if ($contentPublishable) : ?>
				<button type="button" class="btn btn-primary"
						tooltip="<?php echo __d('net_commons', 'Accept'); ?>"
						ng-controller="Iframes.edit"
						ng-hide="(iframe.Iframe.status !== '<?php echo NetCommonsBlockComponent::STATUS_APPROVED ?>')"
						ng-click="initialize(); save('<?php echo NetCommonsBlockComponent::STATUS_PUBLISHED ?>')">

					<span class="glyphicon glyphicon-ok"></span>
				</button>
			<?php endif; ?>

			<button class="btn btn-primary"
					tooltip="<?php echo __d('net_commons', 'Manage'); ?>"
					ng-click="showManage()">

				<span class="glyphicon glyphicon-cog"> </span>
			</button>
		</p>

		<div class="iframe">
			<?php echo $this->element('Iframes/display_iframe'); ?>
		</div>

		<p class="text-left">
			<?php echo $this->element('Iframes/status_label'); ?>
		</p>
	</div>

<?php else : ?>
	<?php echo $this->element('Iframes/display_iframe'); ?>

<?php endif;
