<!--
	Fields:
	- files
	- mp4
	- webm
	- subtitles: list of files "de.vtt", "en.vtt", etc.
-->

<video controls poster="<?= $block->files()->toFile()->url() //Take the first file in the files-field and echo the URL into the poster-property ?>" preload="metadata">
	<!-- MP4 -->
	<?php if($block->mp4()->isNotEmpty()) : ?>
		<source src="<?= $block->mp4() ?>" />
	<?php endif ?>
	
	<!-- WebM -->
	<?php if($block->webm()->isNotEmpty()) : ?>
		<source src="<?= $block->webm() ?>" />
	<?php endif ?>
	
	<!-- Subtitles-->
	<?php if($block->subtitles()->isNotEmpty()) :
		foreach($block->subtitles() as $track) : ?>
			<track src="<?= $track()->url() ?>" kind="subtitles" srclang="<?= $track()->name() ?>" />
		<?php
		endforeach;
	endif; ?>
	
</video>