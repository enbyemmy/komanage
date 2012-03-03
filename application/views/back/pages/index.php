<h3>
	<a href="/admin/pages/edit">Click Here to add a page</a>
</h3>
<?php if (!$totalpages) { ?>
}
<p>
	You haven't created any pages yet, what's with the procrastination?<br />
</p>
<?php } else {?>
<table>
	<thead>
	<th>
		Page ID
	</th>
	<th>
		Name
	</th>
	<th>
		URI
	</th>
	<th>
		Last Modified
	</th>
	<th>
		Actions
	</th>
	</thead>
	<?php foreach($pages as $page) { ?>
	<tr>
		<td>
			<?= $page->id ?>
		</td>
		<td>
			<?= $page->name ?>
		</td>
		<td>
			<?= $page->uri ?>
		</td>
		<td>
			<?= (isset($page->modified)) ? date('Y-m-d', $page->modified) : 'Unmodified' ?>
		</td>
		<td>
			<a href="/admin/pages/edit/<?= $page->id ?>">Edit</a> <a href="/admin/pages/delete/<?= $page->id ?>">Delete</a>
		</td>
	</tr>
	<?php } ?>
</table>
<?php } ?>
