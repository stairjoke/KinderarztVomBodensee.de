<?php
return [
	'debug' => true,
	'url' => '/',/* set url() to use relative paths */
	'blocks' => [
		'fieldsets' => [
			'layouts' => [
				'label' => 'Layouts',
				'type' => 'group',
				'fieldsets' => [
					'article-with-sidecar-block'
				]
			],
			'text' => [
				'label' => 'Text',
				'type' => 'group',
				'fieldsets' => [
					'text', 'heading', 'list', 'picture-list-block', 'product-details-block'
				]
			],
			'media' => [
				'label' => 'Medien',
				'type' => 'group',
				'fieldsets' => [
					'image', 'self-hosted-video-block', 'slider-block'
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