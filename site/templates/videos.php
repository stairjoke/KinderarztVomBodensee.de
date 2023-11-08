<?php snippet('head'); ?>
<main class="wide">
	<?= $page->blocks()->toBlocks() ?>
	<dl>
		<div class=column-block>
	<?php
		$separateVideosIntoBlocksOfN = ceil($numberOfVideos / 3);
		$separateVideosIntoBlocksOfNCurrentCount = 0;
		
		foreach($alphabetical as $letter => $list) :
			
			if($separateVideosIntoBlocksOfNCurrentCount >= $separateVideosIntoBlocksOfN) {
				$separateVideosIntoBlocksOfNCurrentCount = 0;
				echo ('</div><div class=column-block>');
			}
			
			echo("<dt>$letter</dt>");
			
			foreach($list as $listItem) :
				$separateVideosIntoBlocksOfNCurrentCount++;
	?>
			<dd>
				<details>
					<summary><?= (isset($listItem['altTitle'])) ? $listItem['altTitle'] : $listItem['video']->title() ; ?></summary>
					<div class="details-video-card">
						<a href="<?= $listItem['video']->videoURL() ?>" target="_blank">
							<?php
								if($listItem['video']->hasImages()){
									echo("<img alt='{$listItem['video']->image()->alt()}' src='{$listItem['video']->image()->url()}' />");
								}else{
									echo("<img />");
								}
							?>
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
		endforeach; // Alphabet
	?>
		</div>
	</dl>
	
</main>
<?php snippet('foot'); ?>