<?php
	$emoji = null;
	$alt = null;
	$image = null;
	if($block->emoji()->isNotEmpty()) {
		$emoji = $block->emoji();
	}elseif($block->itemImage()->isNotEmpty()) {
		$image = $block->itemImage()->toFile();
		$alt = $image->alt();
	}
?>

<li>
	<?php if(isset($image)) : ?>
		<inline-icon style="background-image: url(<?= $image->url() ?>)" alt="<?= $image->alt() ?>"></inline-icon>
	<?php elseif(isset($emoji)) : ?>
		<emoji-icon><?= $emoji ?></emoji-icon>
	<?php endif; ?>
	<?= $block->text()->kirbytextinline() ?>
</li>