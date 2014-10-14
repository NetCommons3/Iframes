<span class="error"
	  ng-show="iframeFrameSetting['data[IframeFrameSetting][height]'].$valid">
	<br />
</span>
<span class="error"
	  ng-show="iframeFrameSetting['data[IframeFrameSetting][height]'].$error.required &&
				!iframeFrameSetting['data[IframeFrameSetting][height]'].$error.number">
	<?php  echo __d('iframes', 'Required field.');?>
</span>
<span class="error"
	  ng-show="iframeFrameSetting['data[IframeFrameSetting][height]'].$error.number ||
				iframeFrameSetting['data[IframeFrameSetting][height]'].$error.min ||
				iframeFrameSetting['data[IframeFrameSetting][height]'].$error.max">
	<?php echo __d('iframes', 'The input frame height must be a number bigger than 1 and less than 2000.');?>
</span>