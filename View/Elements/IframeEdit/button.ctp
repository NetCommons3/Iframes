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

<p class="text-center">
	<button type="button" class="btn btn-default" ng-click="cancel()" ng-disabled="sending">
		<span class="glyphicon glyphicon-remove"></span>
		<?php echo __d('net_commons', 'Cancel'); ?>
	</button>

	<?php if (isset($iframe['Iframe']) && $contentPublishable &&
				$iframe['Iframe']['status'] === NetCommonsBlockComponent::STATUS_APPROVED) : ?>
		<button type="button" class="btn btn-danger" ng-disabled="sending || iframeEdit.$invalid"
				ng-hide="iframe.Iframe.status !== '<?php echo (NetCommonsBlockComponent::STATUS_APPROVED); ?>'"
			<?php echo __d('net_commons', 'Disapproval'); ?>
		</button>

	<?php else : ?>
		<button type="button" class="btn btn-default" ng-disabled="sending || iframeEdit.$invalid"
				ng-click="save('<?php echo NetCommonsBlockComponent::STATUS_DRAFTED ?>')">
			<?php echo __d('net_commons', 'Save temporally'); ?>
		</button>

	<?php endif; ?>

	<?php if ($contentPublishable) : ?>
		<button type="button" class="btn btn-primary" ng-disabled="sending || iframeEdit.$invalid"
				ng-click="save('<?php echo NetCommonsBlockComponent::STATUS_PUBLISHED ?>')">
			<?php echo __d('net_commons', 'OK'); ?>
		</button>

	<?php else : ?>
		<button type="button" class="btn btn-primary" ng-disabled="sending || iframeEdit.$invalid"
				ng-click="save('<?php echo NetCommonsBlockComponent::STATUS_APPROVED ?>')">
			<?php echo __d('net_commons', 'Approval'); ?>
		</button>

	<?php endif; ?>
</p>
