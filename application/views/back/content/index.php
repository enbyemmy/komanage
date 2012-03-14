<?php if (!$totalblocks) { ?>
}
<p>
	You haven't created any content yet, what's with the procrastination?<br />
</p>
<?php } else {?>
	<ul class="list" id="content-blocks">
	<li>
		<h3>
			<a href="/admin/content/edit" class="modal">Add a new content block</a>
		</h3>	
	</li>
	<?php foreach($content as $content) { ?>
		<li>
			<h3>
				<a href="/admin/content/edit/<?= $content->id ?>" class="modal">
					<?= $content->name ?>
				</a>
			</h3>
			<p>
				<?= Text::limit_words($content->content, 6, '...') ?>
			</p>
		</li>
	<?php } ?>
	</ul>
</table>
<?php } ?>
