<?php
/**
 * display iframe template elements
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Kotaro Hokada <kotaro.hokada@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php if ($iframe['Iframe']['url'] !== '' &&
			isset($iframeFrameSetting['IframeFrameSetting']['height']) &&
			isset($iframeFrameSetting['IframeFrameSetting']['display_scrollbar']) &&
			isset($iframeFrameSetting['IframeFrameSetting']['display_frame'])) : ?>

	<iframe width="100%" src="<?php echo h($iframe['Iframe']['url']); ?>"
			height="<?php echo (int)$iframeFrameSetting['IframeFrameSetting']['height']; ?>"
			scrolling="<?php echo $iframeFrameSetting['IframeFrameSetting']['display_scrollbar'] ? 'yes' : 'no'; ?>"
			frameborder="<?php echo $iframeFrameSetting['IframeFrameSetting']['display_frame'] ? 1 : 0; ?>">
	</iframe>

<?php else : ?>
		<p><?php echo __d('iframes', 'Non registered url'); ?></p>

<?php endif;
