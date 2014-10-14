<p>
	<span class="label label-success ng-hide"
		ng-init="label.publish=<?php echo ($iframe['Iframe']['status'] === Iframe::STATUS_PUBLISHED ? 'true' : 'false'); ?>"
		ng-show="label.publish">
		<?php echo __d('iframes', 'Publishing'); ?>
	</span>

	<span class="label label-danger ng-hide"
		ng-init="label.approval=<?php echo ($iframe['Iframe']['status'] === Iframe::STATUS_APPROVED ? 'true' : 'false'); ?>"
		ng-show="label.approval">
		<?php echo __d('iframes', 'Approving'); ?>
	</span>

	<span class="label label-info ng-hide"
		ng-init="label.draft=<?php echo ($iframe['Iframe']['status'] === Iframe::STATUS_DRAFTED ? 'true' : 'false'); ?>"
		ng-show="label.draft">
		<?php echo __d('iframes', 'Drafting'); ?>
	</span>

	<span class="label label-warning ng-hide"
		ng-init="label.disapproval=<?php echo ($iframe['Iframe']['status'] === Iframe::STATUS_DISAPPROVED ? 'true' : 'false'); ?>"
		ng-show="label.disapproval">
		<?php echo __d('iframes', 'Disapprovign'); ?>
	</span>

</p>