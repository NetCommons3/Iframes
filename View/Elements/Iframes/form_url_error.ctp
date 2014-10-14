<span class="error"
	  ng-show="iframeEdit['data[Iframe][url]'].$valid">
	<br />
</span>
<span class="error"
	  ng-show="iframeEdit['data[Iframe][url]'].$error.required">
	<?php echo __d('iframes', 'Required field.');?>
</span>
<span class="error"
	  ng-show="iframeEdit['data[Iframe][url]'].$error.pattern">
	<?php echo __d('iframes', 'Invalid input.');?>
</span>