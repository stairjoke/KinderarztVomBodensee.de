<?php snippet('head'); ?>
<main class="wide">
	<?= $page->blocks()->toBlocks() ?>
	<dl>
	<?php
		
		foreach($alphabetical as $letter => $list) :
			?>
		<div>
		<dt><?= $letter ?></dt>
			<?php
			foreach($list as $listItem) :
	?>
			<dd>
				<details>
					<summary><?= (isset($listItem['altTitle'])) ? $listItem['altTitle'] : $listItem['video']->title() ; ?></summary>
					<div class="details-video-card">
						<a href="<?= $listItem['video']->videoURL() ?>">
							<img src="<?= ($listItem['video']->hasImages()) ? $listItem['video']->image()->url() : 'placeholder' ?>" />
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
					<?= $listItem['video']->beschreibung()->kt() ?>
				</details>
			</dd>
	<?php
			endforeach; // Collection
	?>
		</div>
	<?php
		endforeach; // Alphabet
	?>	
	</dl>
	
</main>
<?php snippet('foot'); ?>