<main>
	<?= $page->blocks()->toBlocks() ?>
	<?php foreach($page->children()->listed() as $product) : ?>
		<article class="hasSidecar product">
			<aside>
				<?= $productImage = $product->files()->first() ?>
			</aside>
			<main>
				<a href="<?= $product->url() ?>"><h2><?= $product->title() ?></h2></a>
				<?= $product->summary()->kirbytext() ?>
			</main>
		</article>
	<?php endforeach ?>
</main>