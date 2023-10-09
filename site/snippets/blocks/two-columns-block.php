<?php
	// Two Columns Block — Der Kinderarzt vom Bodensee
?>

<div class="two-columns-block">
	<div><?= $block->leftColumn()->Text() ?></div>
	<div><?= $block->rightColumn()->toBlocks() ?></div>
</div>