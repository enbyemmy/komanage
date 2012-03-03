<form id="category-settings-<?= strtolower($category->category) ?>" class="settings" action="" method="post">
	<label>
		<input type="text" name="category" value="<?= @$category->category ?>" />
	</label>
	<label>
		<input type="submit" value="Save" />
	</label>
</form>