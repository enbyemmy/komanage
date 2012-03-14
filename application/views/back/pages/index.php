<style type="text/css" rel="stylesheet">

</style>
<ul id="pages" class="list">
	<li>
		<h3>
			<a href="/admin/pages/edit">New Page</a>
		</h3>
	</li>
	<?php foreach($pages as $page): ?>
	<li>
		<span class="controls"><a href="/admin/pages/delete/<?= $page->id ?>" title="<?= $page->name ?>" class="delete">x</a></span>
		<h3>
			<a href="/admin/pages/edit/<?= $page->id ?>">
				<?= $page->name ?> <span class="aside"><?= $page->uri ?></span>
			</a>
		</h3>
		<p>
			Contains <?= $page->blocks->where('deleted', '=', '')->count_all() ?> <?= Inflector::singular('blocks', $page->blocks->where('deleted', '=', '')->count_all()) ?>
			<br />
			<?php $content = $page->blocks->where('deleted', '=', '')->find()->content->find(); ?>
				<?php if ($content->name): ?>
					<strong>
						<?= $content->name ?> &ndash;
					</strong>
				<?php endif; ?>
			<?= Text::limit_words($content->content, 5, '...') ?>		
		</p>
	</li>
	<?php endforeach; ?>
</table>
