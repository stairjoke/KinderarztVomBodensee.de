		<footer>
			<div class="contain">
				<main>
					<?= $site->photo()->toFile() ?>
					<?= $site->vita()->toBlocks() ?>
				</main>
				<aside>
					<?= $site->links()->toBlocks() ?>
				</aside>
			</div>
		</footer>
		
	</body>
</html>
