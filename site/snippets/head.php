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
		
		<meta name="robots" content="inxed, follow">
		
		<?= css([
			'/media/plugins/wenzels-design/picture-list-block/css/picture-list-plugin.css',
			'/media/plugins/wenzels-design/slider-block/css/slider-block.css',
			'assets/css/foundation.css',
			'@auto'
		]) ?>
		
		<?=
			js('/media/plugins/wenzels-design/slider-block/js/slider-block.js');
		?>
		
		<!--
		/**
		* @license
		* MyFonts Webfont Build ID 601285
		*
		* The fonts listed in this notice are subject to the End User License
		* Agreement(s) entered into by the website owner. All other parties are
		* explicitly restricted from using the Licensed Webfonts(s).
		*
		* You may obtain a valid license from one of MyFonts official sites.
		* http://www.fonts.com
		* http://www.myfonts.com
		* http://www.linotype.com
		*
		*/
		-->
		<link rel="stylesheet" type="text/css" href="/assets/fonts/Der_Kinderarzt_vom_Bodensee.css">
		
		<meta name="theme-color" media="(prefers-color-scheme: light)" content="#ffe587" />
		<meta name="theme-color" media="(prefers-color-scheme: dark)" content="#084CB5" />
		
		<script>
			window.onload = (event) => {
				document.body.classList.remove('no-js');
				document.body.classList.add('loaded');
			}
			window.onpageshow = (event) => {
				if(document.getElementById('nav-toggle').checked) {
					document.getElementById('nav-toggle').click();
				}
			}
		</script>
	</head>
	<body class="no-js">
		<div aria-hidden="true" id="overlay-dimmer"></div>
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
			<div class="header-layout">
				<div class="logo-container">
					<picture>
						<source media="(max-width: 1023px)" srcset="/assets/images/logo-and-slogan-mobile@2x.jpg" />
						<source media="(min-width: 1024px)" srcset="/assets/images/logo-and-slogan-desktop@2x.jpg" />
						
						<!-- fallback if no condition is met — IE will always use this -->
						<img src="/assets/images/logo-and-slogan-desktop@2x.jpg" alt="Der Kinderarzt vom Bodensee. Dr. med. Christof Metzler, Kinder- und Jugendarzt" class="logo" />
					</picture>
				</div>
				
				<input type="checkbox" id="nav-toggle">
				<label for="nav-toggle" class="triggered-by-nav-toggle">
					<svg class="icon" id="menu" aria-label="Open menu">
						<use href="/assets/images/iconSprite.svg#menu"></use>
					</svg>
					<svg class="icon" id="close" aria-label="Close menu">
						<use href="/assets/images/iconSprite.svg#cross"></use>
					</svg>
				</label>
				
				<nav class="triggered-by-nav-toggle">
					<ol>
						<?php
							// List all public pages that are immediate children of home in the navigation
							foreach($site->children()->listed() as $navItem){
								// Make $item string and start the LI-element for the nav item in it
								$item = "<li><a href='{$navItem->url()}'";
								// if the current page is the page linked to in this nav item
								if($navItem->isActive()) {
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