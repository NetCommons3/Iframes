<div class="text-center">
	<button type="button" class="btn btn-default" data-dismiss="modal"
			ng-disabled="sendLock">
		<span> <?php echo __d('iframes', 'Cancel'); ?> </span>
	</button>

	<button class="btn btn-default"
			ng-click="postIframe(<?php echo Iframe::STATUS_DRAFTED; ?>)"
			ng-hide="label.approval"
			ng-disabled="sendLock || iframeUrl.$invalid">

		<span class="glyphicon glyphicon-pencil"></span>
		<span><?php echo __d('iframes', 'Draft'); ?></span>
	</button>

	<button class="btn btn-default"
			ng-click="postIframe(<?php echo Iframe::STATUS_DISAPPROVED; ?>)"
			ng-show="label.approval"
			ng-disabled="sendLock || iframeUrl.$invalid">

		<span class="glyphicon glyphicon-pencil"></span>
		<span><?php echo __d('iframes', 'Disapproval'); ?></span>
	</button>

	<?php if (! $contentPublishable) : ?>
		<button class="btn btn-primary"
				ng-click="postIframe(<?php echo Iframe::STATUS_APPROVED; ?>)"
				ng-disabled="sendLock || iframeUrl.$invalid">
			<span class="glyphicon glyphicon-share-alt"></span>
			<span><?php echo __d('iframes', 'Approval'); ?></span>
		</button>

	<?php else : ?>
		<button class="btn btn-primary"
				ng-click="postIframe(<?php echo Iframe::STATUS_PUBLISHED; ?>)"
				ng-disabled="sendLock || iframeUrl.$invalid">
			<span class="glyphicon glyphicon-share-alt"></span>
			<span><?php echo __d('iframes', 'Publish'); ?></span>
		</button>

	<?php endif; ?>

</div>