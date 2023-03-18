<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="UTF-8">
		
		<title><?= $site->title() ?> — <?= $page->title() ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta name="description" content="<?= ($page->description()->exists()) ? $page->description() : $site->description() ?>">
		
		<link href="assets/foundation.css" rel="stylesheet">
	</head>
	<body>
		<header></header>
		<main><?= $page->inhalt()->toBlocks() ?></main>
		<footer></footer>
	</body>
</html>
