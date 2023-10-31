<main>
	<?= $page->blocks()->toBlocks() ?>
	<dl>
	<?php
		foreach($alphabetical as $letter => $collection) :
			print_r($collection);
			$collection = $collection->sortBy('title', 'asc');
			?>
		<dt><?= $letter ?></dt>
			<?php
			foreach($collection as $page) :
	?>
		<dd>
			<details>
				<summary>Video Titel</summary>
				<div class="details-video-card">
					<a href="youtube.com">
						<img src="https://placehold.co/1080x720" />
						<div class="details-video-card-youtube-banner">
							<div>
								<svg class="icon inline" aria-label="YouTube Logo">
									<use href="/assets/images/iconSprite.svg#youtube"></use>
								</svg>
								<span>Auf YouTube ansehen</span>
								<svg class="icon inline" aria-label="Externe Verlinkung">
									<use href="/assets/images/iconSprite.svg#ext"></use>
								</svg>
							</div>
						</div>
					</a>
				</div>
				<p>
					Beschreibung. Cras mattis consectetur purus sit amet fermentum. Nullam quis risus eget urna mollis ornare vel eu leo. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
				</p>
			</details>
		</dd>
	<?php
			endforeach; // Collection
		endforeach; // Alphabet
	?>	
	</dl>
	
</main>