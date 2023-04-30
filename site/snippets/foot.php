		<footer>
			<div class="contain">
				<main>
					<img src="<?= $site->photo()->toFile()->url() ?>" alt="<?= $site->photo()->toFile()->alt() ?>" class="portraitphoto" />
					<?= $site->vita()->toBlocks() ?>
				</main>
				<aside>
					<?= $site->links()->toBlocks() ?>
				</aside>
			</div>
		</footer>
		
	</body>
</html>
