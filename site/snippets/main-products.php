<main>
	<?= $page->blocks()->toBlocks() ?>
	<?php foreach($page->children()->listed() as $product) : ?>
		<article class="hasSidecar product">
			<aside>
				<?= $productImage = $product->files()->first() ?>
			</aside>
			<main>
				<h2><a href="<?= $product->url() ?>"><?= $product->title() ?></a></h2>
				<?= $product->summary()->kirbytext() ?>
			</main>
		</article>
	<?php endforeach ?>
</main>