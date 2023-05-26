<?php
	// Product Details table Block — Der Kinderarzt vom Bodensee
?>

<table class="productDetails tablet desktop" data-id="<?= $block->id() ?>">
	<colgroup>
		<col class="<?php
			foreach($block->cell1options()->split() as $option){
				echo("$option ");
			}
		?>" />
		<col />
		<col />
		<col />
	</colgroup>
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

<div class="mobile" data-id="<?= $block->id() ?>">ℹ️ Um die Produktdetails auf besonders kleinen Geräten darzustellen, aktivieren Sie bitte JavaScript.</div>