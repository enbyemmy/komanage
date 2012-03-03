<style type="text/css" rel="stylesheet">
</style>
<form id="add-work-<?= strtolower($category->category) ?>" class="add work" action="" method="post">
	<input type="hidden" name="category_id" value="<?= $category->id ?>" />
	<label>
		Name
		<span class="bit">
			Give this work a name.
		</span>
		<input name="name" type="text" />
	</label>
	<label>
		Description
		<span class="bit">
			Describe this work.
		</span>
		<textarea name="description">

		</textarea>
	</label>
	<label>
		Date
		<span class="bit">
			When did you create this?
		</span>
		<input name="name" type="text" />
	</label>
	<label>
		Tags
		<span class="bit">
		Label this item with keywords for sorting purposes (Used in the front end)
		</span>
		<select name="tags" data-placeholer="Start typing a tag.." class="chzn-select">
			<?php foreach($tags as $tag): ?>
				<option value="<?= $tag ?>"><?= ucfirst($tag) ?></option>
			<?php endforeach; ?>
		</select>
	</label>
	<label>
		Add Photos
		<input type="file" name="image" />
		<input type="text" name="caption" placeholder="Add a caption"/>
		<input type="button" name="add-photo" value="Add Photo" />
	</label>
	<label>
		<input type="submit" value="Save" />
	</label>
</form>
