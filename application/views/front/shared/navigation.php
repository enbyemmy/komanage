<ul id="navigation">
	<?php foreach($pages as $page): ?>
	<li>
		<a href="<?= $page->uri ?>">
			<?= $page->name ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
