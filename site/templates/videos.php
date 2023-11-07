<?php snippet('head'); ?>
<main class="wide">
	<?= $page->blocks()->toBlocks() ?>
	<dl>
	<?php
		foreach($alphabetical as $letter => $list) :
			$list = $list->sortBy('title', 'asc');
			?>
		<dt><?= $letter ?></dt>
			<?php
			foreach($list as $video) :
	?>
		<dd>
			<details open>
				<summary><?= $video->title() ?></summary>
				<div class="details-video-card">
					<a href="<?= $video->videoURL() ?>">
						<img src="<?= ($video->hasImages()) ? $video->image()->url() : 'placeholder' ?>" />
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
				<?= $video->beschreibung()->kt() ?>
			</details>
		</dd>
	<?php
			endforeach; // Collection
		endforeach; // Alphabet
	?>	
	</dl>
	
</main>
<?php snippet('foot'); ?>