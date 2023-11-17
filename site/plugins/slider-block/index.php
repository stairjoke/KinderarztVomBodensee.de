<?php
	// Slider block plugin
	
	Kirby::plugin('wenzels-design/slider-block', [
		'snippets' => [
			'blocks/slider-block' => __DIR__ . '/snippets/blocks/slider-block.php'
		],
		'blueprints' => [
			'blocks/slider-block' => __DIR__ . '/blueprints/blocks/slider-block.yml'
		],
		'js' => [
			'assets/js/slider-block' => __DIR__ . '/assets/js/slider-block.js'
		]
	]);
	
	/* https://getkirby.com/docs/reference/plugins/extensions/icons?cmdf=kirby+add+custom+icon+to+blueprint */
?>