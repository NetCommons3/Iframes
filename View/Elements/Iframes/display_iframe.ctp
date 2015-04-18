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
	<?php if (isset($iframe['url'])) : ?>
		<iframe width="100%" src="<?php echo h($iframe['url']); ?>"
				height="<?php echo (int)$iframe['height']; ?>"
				scrolling="<?php echo $iframe['displayScrollbar'] ? 'yes' : 'no'; ?>"
				frameborder="<?php echo $iframe['displayFrame'] ? '1' : '0'; ?>">
		</iframe>
	<?php endif; ?>
</div>
