<?php
/*
	Fields:
		- layout: ['two', 'three']
		- images: files
*/
?>

<div class="slider-block">
	<div role="marquee" class="slider-block-elements <?= $block->layout() ?>">
		<?php foreach($block->images()->toFiles() as $image) : ?>
		<?= $image ?>
		<?php endforeach; ?>
	</div>
	<?php
		// Use set layout and number of images top calculate how many bullets / page-steps to display below the images
		$numberOfImages = $block->images()->toFiles()->count();
		$numberOfBullets = 0;
		switch ($block->layout()) {
			case 'two';
				$numberOfBullets = ceil($numberOfImages / 2);
				break;
			default; // 'three'
				$numberOfBullets = ceil($numberOfImages / 3);
				break;
		}
	?>
	<?php if ($numberOfBullets > 0) : ?>
		<div class="slider-block-controls">
			<noscript><p>← scroll →</p></noscript>
			<nav aria-label="Produktbilder scrollen"><ol>
				<?php for($index = 1; $index <= $numberOfBullets; $index++) : ?>
					<li role="menuitemradio">Seite <?= $index ?></li>
				<?php endfor; ?>
			</ol></nav>
			<img class="slider-block-stepper-button slider-block-stepper-button-previous" role="button" aria-hidden="true" src="/media/plugins/wenzels-design/slider-block/img/button.svg" />
			<img class="slider-block-stepper-button slider-block-stepper-button-next" role="button" aria-hidden="true" src="/media/plugins/wenzels-design/slider-block/img/button.svg" />
		</div>
	<?php endif; ?>
</div>