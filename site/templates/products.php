<?php snippet('head'); ?>
<main>
	<?= $page->blocks()->toBlocks() ?>
	<?php foreach($page->children()->listed() as $product) : ?>
		<article class="hasSidecar productCard">
			<h2 class="mobile"><a href="<?= $product->url() ?>"><?= $product->title() ?></a></h2>
			<aside><?= $product->hero()->toFile() ?></aside>
			<main>
				<h2 class="desktop"><a href="<?= $product->url() ?>"><?= $product->title() ?></a></h2>
				<?= $product->summary()->kirbytext() ?>
			</main>
		</article>
	<?php endforeach ?>
</main>
<?php snippet('foot'); ?>
