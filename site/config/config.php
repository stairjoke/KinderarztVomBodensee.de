<?php
return [
	'debug' => true,
	'languages' => true,
	'blocks' => [
		'fieldsets' => [
			'layouts' => [
				'label' => 'Layouts',
				'type' => 'group',
				'fieldsets' => [
					'article-with-sidecar-block', 'two-columns-block'
				]
			],
			'text' => [
				'label' => 'Text',
				'type' => 'group',
				'fieldsets' => [
					'text', 'textarea', 'heading', 'list', 'picture-list-block', 'product-details-block'
				]
			],
			'media' => [
				'label' => 'Medien',
				'type' => 'group',
				'fieldsets' => [
					'image', 'audio-sample', 'self-hosted-video-block', 'slider-block', 'featured-video'
				]
			],
			'code' => [
				'label' => 'Code',
				'type' => 'group',
				'open' => false,
				'fieldsets' => [
					'markdown', 'code'
				]
			]
		]
	]
];
?>