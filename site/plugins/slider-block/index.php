<?php
	// Slider block plugin
	
	Kirby::plugin('wenzels-design/slider-block', [
		'snippets' => [
			'blocks/slider-block' => __DIR__ . '/snippets/blocks/slider-block.php'
		],
		'blueprints' => [
			'blocks/slider-block' => __DIR__ . '/blueprints/blocks/slider-block.yml',
			'files/slider-image' => __DIR__ . '/blueprints/files/slider-image.yml'
		]
	]);
	
	/* https://getkirby.com/docs/reference/plugins/extensions/icons?cmdf=kirby+add+custom+icon+to+blueprint */
?>