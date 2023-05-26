<?php
	// Product Details table Block — Der Kinderarzt vom Bodensee
?>

<table class="productDetails">
	<thead>
		<tr>
			<th scope="col"><?= $block->cell1()->kirbytextinline() ?></th>
			<th scope="col"><?= $block->cell2()->kirbytextinline() ?></th>
			<th scope="col"><?= $block->cell3()->kirbytextinline() ?></th>
			<th scope="col"><?= $block->cell4()->kirbytextinline() ?></th>
		</tr>
	</thead>
	<tbody>
		<?= $block->rows()->toBlocks() ?>
	</tbody>
</table>