<h3>
	<a href="/admin/content/edit">Click Here to add a content</a>
</h3>
<?php if (!$totalblocks) { ?>
}
<p>
	You haven't created any content yet, what's with the procrastination?<br />
</p>
<?php } else {?>
<table>
	<thead>
	<th>
		Block ID
	</th>
	<th>
		Name
	</th>
	<th>
		Content	
	</th>
	<th>
		Last Modified
	</th>
	<th>
		Actions
	</th>
	</thead>
	<?php foreach($content as $content) { ?>
	<tr>
		<td>
			<?= $content->id ?>
		</td>
		<td>
			<?= $content->name ?>
		</td>
		<td>
			<?= $content->content ?>
		</td>
		<td>
			<?= (isset($content->modified)) ? date('Y-m-d', $content->modified) : 'Unmodified' ?>
		</td>
		<td>
			<a href="/admin/content/edit/<?= $content->id ?>">Edit</a> <a href="/admin/content/delete/<?= $content->id ?>">Delete</a>
		</td>
	</tr>
	<?php } ?>
</table>
<?php } ?>
