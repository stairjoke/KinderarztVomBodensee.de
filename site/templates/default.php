<!DOCTYPE html>
<html lang="de-DE">
	<head>
		<meta charset="UTF-8">
		
		<title><?= $site->title() ?> — <?= $page->title() ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta name="description" content="<?= ($page->description()->exists()) ? $page->description() : $site->description() ?>">
		<meta property="og:title" content="<?= $page->title() ?>">
		<meta property="og:site_name" content="<?= $site->title() ?>">
		<meta property="og:image" content="<?= ($page->ogImage()->exists()) ? $page->ogImage()->files()->first()->toFile()->url() : $site->ogImage()->files()->first()->toFile()->url() ?>">
		<meta property="og:url" content="<?= $page->url() ?>">
		<meta property="og:locale" content="de_DE">
		
		<meta name="roboty" content="inxed, follow">
		
		<link href="assets/foundation.css" rel="stylesheet">
	</head>
	<body>
		<header></header>
		<main><?= $page->inhalt()->toBlocks() ?></main>
		<footer></footer>
	</body>
</html>
