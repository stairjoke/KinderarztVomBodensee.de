<?php
	// Self-hosted video block plugin
	
	Kirby::plugin('wenzels-design/picture-list-block', [
		'snippets' => [
			'blocks/picture-list-block' => __DIR__ . '/snippets/blocks/picture-list-block.php',
			'blocks/picture-list-element' => __DIR__ . '/snippets/blocks/picture-list-element.php',
		],
		'blueprints' => [
			'blocks/picture-list-block' => __DIR__ . '/blueprints/blocks/picture-list-block.yml',
			'blocks/picture-list-element' => __DIR__ . '/blueprints/blocks/picture-list-element.yml',
			'files/picture-list-block-image' => __DIR__ . '/blueprints/files/picture-list-block-image.yml'
		]
	]);
?>
