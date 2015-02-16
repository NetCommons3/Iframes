<?php
/**
 * iframes display iframe element template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<div class="nc-iframes-display-iframe">
	<?php if (isset($iframes['url']) &&
				isset($iframeFrameSettings['height']) &&
				isset($iframeFrameSettings['display_scrollbar']) &&
				isset($iframeFrameSettings['display_frame'])) : ?>

		<iframe width="100%" src="<?php echo h($iframes['url']); ?>"
				height="<?php echo (int)$iframeFrameSettings['height']; ?>"
				scrolling="<?php echo $iframeFrameSettings['display_scrollbar'] ? 'yes' : 'no'; ?>"
				frameborder="<?php echo $iframeFrameSettings['display_frame'] ? '1' : '0'; ?>">
		</iframe>

	<?php else : ?>
		<p><?php echo __d('iframes', 'Non registered url'); ?></p>

	<?php endif; ?>
</div>