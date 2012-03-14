<?php if (@$error) { ?>
}
<div id="error">
	<?= $error ?>
</div>
<?php } ?>
<?php if (@$message) { ?>
<div id="message">
	<?= $message ?>
</div>
<?php } ?>
<h1>
	<?= $page->name ?>
</h1>
<h2>
	Settings
</h2>
<form class="async" action="/ajax/page/edit/<?= (isset($page->id)) ? $page->id : '' ?>" method="POST">
	<label>
		Page Name
		<span class="bit">
			Required for admin labeling purposes only
		</span>
		<input name="name" type="text" <?= (isset($page->name)) ? "value=\"$page->name\" " : "" ?>placeholder="Page Name" />
	</label>
	<label>
		Page URI
		<span class="bit">
			The page url (example http://<?= $_SERVER['SERVER_NAME']; ?>/{page uri}
		</span>
		<input name="uri" type="text" <?= (isset($page->uri)) ? "value=\"$page->uri\" " : "" ?>placeholder="Page URI" />
	</label>
	<label>
		<span class="bit">
			Don't forget
		</span>
		<input type="submit" value="Save!" />
	</label>
</form>
<h1>Blocks</h1>
<!-- move this outside this view -->
<ul id="blocks" class="list">
	<li>
		<h3>
			<a class="modal" href="/admin/block/edit">New Block</a>
		</h3>
	</li>
	<?php foreach($page->blocks->where('deleted', '=', '')->find_all() as $block): ?>
	<li>
		<span class="controls"><a href="/admin/block/delete/<?= $block->id ?>" title="this block" class="delete">x</a></span>
		<?php foreach($block->content->find_all() as $content): ?>
			<h3>
				<a href="/admin/block/edit/<?= $block->id ?>" class="modal"><?= ($content->name) ? $content->name : 'Untitled block' ?></a>
			</h3>
			<p>
				<?= $content->content ?>
			</p>
		<?php endforeach; ?>
	</li>
	<?php endforeach; ?>
</ul>
