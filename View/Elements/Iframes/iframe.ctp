<div id="nc-iframes-iframe-<?php echo (int)$frameId; ?>">
	<?php if (isset($iframe['Iframe']['url']) &&
				$iframe['Iframe']['url'] !== '' &&
				isset($iframeFrameSetting['IframeFrameSetting']['height']) &&
				isset($iframeFrameSetting['IframeFrameSetting']['display_scrollbar']) &&
				isset($iframeFrameSetting['IframeFrameSetting']['display_frame'])) : ?>
		<iframe
			src="<?php echo h($iframe['Iframe']['url']); ?>"
			height="<?php echo (int)$iframeFrameSetting['IframeFrameSetting']['height']; ?>"
			width="100%"
			scrolling="<?php echo $iframeFrameSetting['IframeFrameSetting']['display_scrollbar'] ? 'yes' : 'no'; ?>"
			frameborder="<?php echo $iframeFrameSetting['IframeFrameSetting']['display_frame'] ? 1 : 0; ?>">
		</iframe>

	<?php else : ?>
		<p><?php echo __d('iframes', 'Non registered url'); ?></p>

	<?php endif; ?>

</div>
