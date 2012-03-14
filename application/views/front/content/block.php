<div class="block" id="block-<?= $block->id ?>">
<?php foreach($block->content->find_all() as $content): ?>
	<h3><?= $content->name ?></h3>
	<p>
		<?= $content->content ?>
	</p>
<?php endforeach;?>
</div>
