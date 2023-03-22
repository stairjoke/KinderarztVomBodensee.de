<!DOCTYPE html>
<html lang="de-DE">
	<head>
		<meta charset="UTF-8">
		
		<title><?= $site->title() ?> — <?= $page->title() ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta name="description" content="<?= ($page->description()->exists()) ? $page->description() : $site->description() ?>">
		<meta property="og:title" content="<?= $page->title() ?>">
		<meta property="og:site_name" content="<?= $site->title() ?>">
		<meta property="og:image" content="<?= ($page->ogImage()->exists()) ? $page->ogImage()->toFiles()->first()->url() : $site->ogImage()->toFiles()->first()->url() ?>">
		<meta property="og:url" content="<?= $page->url() ?>">
		<meta property="og:locale" content="de_DE">
		
		<meta name="roboty" content="inxed, follow">
		
		<link href="assets/foundation.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<!-- Welle -->
			<picture aria-hidden="true" class=welle>
				<!-- browsers will use the first source that is "true" -->
				<source media="(min-width: 1729px)" srcset="/assets/images/welle-2560@2x.jpg" />
				<source media="(min-width: 1281px)" srcset="/assets/images/welle-1728@2x.jpg" />
				<source media="(min-width: 1025px)" srcset="/assets/images/welle-1280@2x.jpg" />
				<source media="(min-width: 415px)"  srcset="/assets/images/welle-1024@2x.jpg" />
				<source media="(max-width: 414px)"  srcset="/assets/images/welle-414@2x.jpg" />
				
				<!-- fallback if no condition is met — IE will always use this -->
				<img src="/assets/images/welle-1280@2x.jpg" alt="" aria-hidden="true" />
			</picture>
			<div class="contain">
				<picture class="logo">
					<source media="(max-width: 1023px)" srcset="<?= $site->navImage()->toFiles()->nth(1)->url() ?>" />
					<source media="(min-width: 1024px)" srcset="<?= $site->navImage()->toFiles()->nth(0)->url() ?>" />
					
					<!-- fallback if no condition is met — IE will always use this -->
					<img src="<?= $site->navImage()->toFiles()->nth(0)->url() ?>" alt="Der Kinderarzt vom Bodensee. Dr. med. Christof Metzler, Kinder- und Jugendarzt" />
				</picture>
				<nav>
					<ol>
						<?php
							// List all public pages that are immediate children of home in the navigation
							foreach($site->children()->listed() as $navItem){
								// Make $item string and start the LI-element for the nav item in it
								$item = "<li><a href='{$navItem->url()}'";
								// if the current page is the page linked to in this nav item
								if($page->is($navItem)) {
									// add CSS class "current"
									$item .= " class='current'";
								}
								// close the LI-HTML item
								$item .= ">{$navItem->title()}</a></li>";
								// return HTML item to page
								echo($item);
							}
						?>
					</ol>
				</nav>
			</div>
		</header>
		<main><?= $page->inhalt()->toBlocks() ?></main>
		<footer>
			Footer
		</footer>
	</body>
</html>
