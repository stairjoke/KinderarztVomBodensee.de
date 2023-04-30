<?php
return [
	'debug' => true,
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
					'text', 'heading', 'list', 'picture-list-block'
				]
			],
			'media' => [
				'label' => 'Medien',
				'type' => 'group',
				'fieldsets' => [
					'image', 'self-hosted-video-block'
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