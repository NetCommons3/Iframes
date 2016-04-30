<?php
/**
 * ブロック編集view
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<article class="block-setting-body">
	<?php echo $this->BlockTabs->main(BlockTabsHelper::MAIN_TAB_BLOCK_INDEX); ?>

	<div class="tab-content">
		<?php echo $this->BlockTabs->block(BlockTabsHelper::BLOCK_TAB_SETTING); ?>

		<?php echo $this->BlockForm->displayEditForm(array(
				'model' => 'Iframe',
				'callback' => 'Iframes.IframeBlocks/edit_form',
				'cancelUrl' => NetCommonsUrl::backToIndexUrl('default_setting_action'),
			)); ?>

		<?php echo $this->BlockForm->displayDeleteForm(array(
				'callback' => 'Iframes.IframeBlocks/delete_form',
			)); ?>
	</div>
</article>
