<form action="/admin/block/edit/<?= (isset($content->id)) ? $content->id : ''; ?>" class="async">
<input type="hidden" value="<?= $page_id ?>" name="page_id" />
<label>
	Block Type
	<select name="type" class="interface-switch">
		<option value="">
			(Select a block type)
		</option>
		<option <?= (isset($block->type) && $block->type == 'content') ? 'selected="selected"' : ''?> value="content">
			Content
		</option>
	</select>
</label>
<div id="interface_content" class="interface">
<?php include Kohana::find_file('views', 'back/content/interfaces/edit'); ?>
</div>

</form>
<script>
$(function() {

	var initswitch = $('select.interface-switch').val();
	$('#interface_'+initswitch).show();

	$('select.interface-switch').change(function() {
		if ($(this).val()) {

			var target = $(this).val();
			$('#interface_'+target).show();

		}
		else {
			$('.interface').hide();
		}
	});

});
</script>
