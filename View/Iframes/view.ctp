<?php
/**
 * iframe表示view
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<article>
	<?php if (isset($iframe['url']) &&
		! empty($iframe['url'])) : ?>
		<iframe width="100%" src="<?php echo h($iframe['url']); ?>"
				height="<?php echo (int)$iframeFrameSetting['height']; ?>"
				scrolling="<?php echo $iframeFrameSetting['display_scrollbar'] ? 'yes' : 'no'; ?>"
				frameborder="<?php echo $iframeFrameSetting['display_frame'] ? '1' : '0'; ?>">
		</iframe>
	<?php endif; ?>
</article>
