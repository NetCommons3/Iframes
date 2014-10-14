<div class="text-center">
	<button type="button" class="btn btn-default" data-dismiss="modal"
			ng-disabled="sendLock">
		<span> <?php echo __d('iframes', 'Cancel'); ?> </span>
	</button>

	<button class="btn btn-primary"
			ng-click="postIframeFrameSetting()"
			ng-disabled="sendLock || iframeFrameSetting.$invalid">
		<span class="glyphicon glyphicon-share-alt"></span>
		<span><?php echo __d('iframes', 'Setting'); ?></span>
	</button>

</div>