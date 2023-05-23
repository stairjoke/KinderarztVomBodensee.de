<?php
	// Use set layout and number of images top calculate how many bullets / page-steps to display below the images
	$numberOfImages = $block->images()->toFiles()->count();
	$numberOfImagesPerPage = 2;
	$numberOfBullets = 0;
	
	switch ($block->layout()) {
		case 'two';
			$numberOfImagesPerPage = 2;
			break;
		default; // 'three'
			$numberOfImagesPerPage = 3;
			break;
	}
	
	if($numberOfImages > $numberOfImagesPerPage) {
		$numberOfBullets = ceil($numberOfImages / $numberOfImagesPerPage);
	}
?>

<div class="slider-block" <?php echo("data-items-per-page=$numberOfImagesPerPage"); ?>>
	<div role="marquee" class="slider-block-elements <?= $block->layout() ?>">
		<?php
			// Get the elements for the slider block and set the element-on-page-index to zero
			// The element-on-page-index counts the current element within the slider page
			$elements = $block->images()->toFiles();
			$currentElementOnPageIndex = 0;
			
			// Package images in DIVs to scroll-snap them according to their layout
			// Iterate through all elements of the slider
			foreach($elements as $element) {
				
				// If this is the first element on a slider-page open the page
				if($currentElementOnPageIndex == 0){
					echo("<div class=slider-page>");
				}
				
				// If this is just another element on the slider-page echo the element and count up
				if($currentElementOnPageIndex < $numberOfImagesPerPage){
					echo($element);
					$currentElementOnPageIndex++;
				}
				
				// If this is the last element on the page, close the page
				if($currentElementOnPageIndex == $numberOfImagesPerPage || $element === $elements->last()){
					echo("</div>");
					$currentElementOnPageIndex = 0;
				}
			}
		?>
	</div>
	<?php if ($numberOfBullets > 0) : ?>
		<div class="slider-block-controls" data-number-of-pages="<?= $numberOfBullets ?>">
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