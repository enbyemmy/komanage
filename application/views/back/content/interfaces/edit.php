<form action="/admin/content/edit/<?= (isset($content->id)) ? $content->id : ''; ?>" class="async">
<label>
	Name
	<span class="bit">
	This is content block name, it will be used as a header for your content block and also for labeling purposes in the admin section.
	</span>
	<input type="text" name="name" placeholder="Name this content block..." />
</label>
<label>
	Content
	<span class="bit">
		This is the text that will be displayed in the content block.
	</span>
	<textarea name="content">
		Add your content...
	</textarea>
</label>
<label>
	<span class="bit">
		Don't forget!
	</span>
	<input type="submit" value="Save!" />
</label>

</form>
