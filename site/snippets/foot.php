		<footer>
			<div class="contain">
				<main>
					<?php
						if($image = $site->photo()->toFile()):
					?>
						<img src="<?= $image->url() ?>" alt="<?= $image->alt() ?>" width="<?= $image->width() ?>" height="<?= $image->height() ?>" class="portraitphoto" />
					<?php
						endif;
					?>
					<div><?= $site->vita()->toBlocks() ?></div>
				</main>
				<aside>
					<?= $site->links()->toBlocks() ?>
				</aside>
			</div>
		</footer>
		
	</body>
</html>
