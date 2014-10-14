<div class="text-right">

	<?php if ($contentPublishable) : ?>
		<button class="btn btn-danger ng-hide"
				ng-show="label.approval" ng-click="post('Publish')" ng-disabled="sendLock">
			<span class="glyphicon glyphicon-share-alt">
				<?php echo __d('iframes', 'Publish'); ?>
			</span>
		</button>
	<?php endif; ?>

	<?php if ($contentEditable) : ?>
		<button class="btn btn-primary"
				ng-click="showManageModal()" ng-disabled="sendLock">
			<span class="glyphicon glyphicon-cog" title="<?php echo __d('iframes', 'Manage'); ?>">
			</span>
		</button>
	<?php endif; ?>

</div>

<br />