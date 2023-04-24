<?php
	// Self-hosted video block plugin
	
	Kirby::plugin('wenzels-design/self-hosted-video-block', [
		'snippets' => [
			'blocks/self-hosted-video-block' => __DIR__ . '/snippets/blocks/self-hosted-video-block.php',
		],
		'blueprints' => [
			'blocks/self-hosted-video-block' => __DIR__ . '/blueprints/blocks/self-hosted-video-block.yml',
			'files/subtitle-file' => __DIR__ . '/blueprints/files/subtitle-file.yml',
		],
		'fileTypes' => [
			'vtt' => [
				'type' => 'document'
			]
		]
	]);
?>
