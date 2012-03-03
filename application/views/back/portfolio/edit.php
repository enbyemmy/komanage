<style type="text/css" rel="stylesheet">
	#portfolio-categories li {
		margin: 10px;
}

	#portfolio-categories li form.settings { display: none;}
</style>
<h2><?= $title ?></h2>
<form id="portfolio-edit" class="async" action="/admin/ajax/portfolio/edit/<?= @$portfolio->id ?>" method="post">
	<label>
		Name
		<input name="name" value="<?= @$portfolio->name ?>" type="text" />
	</label>
	<h3>Settings</h3>
	<?php foreach($settings_fields as $field => $value) { ?>
	<label>
		<span>

		</span>
		<input type="text" name="settings[<?= $field ?>]" value="<?= $settings[$field] ?>" />
	</label>
	<?php } ?>
	<input type="submit" value="Save" />
</form>
<?php if ($mode == 'edit') { ?>
<h3>Categories</h3>
<span>
	Portfolios can have categories to organize works into.
</span>
<form id="portfolio-categories-edit" action="" method="post">
	<input type="hidden" name="portfolio_id" value="<?= $portfolio->id ?>" />
	<label>
		Add New Category
		<input type="text" name="category" id="portfolio-category" placeholder="Photography"/> <input type="button" value="Add" id="button-add-category" />
	</label>
</form>
<ul id="portfolio-categories">
	<?php if ($totalcategories) { ?>
		<?php foreach($portfolio_categories as $category) { ?>
			<li id="category-<?= strtolower($category->category) ?>">
				<a class="toggle-settings"><?= $category->category ?></a>
				<?= @$interfaces_category_settings[$category->id] ?>
				<a href="#" id="add-work">Add Work</a>
				<div style="display: none;">
					<?= include Kohana::find_file('views', 'back/portfolio/interfaces/work'); ?>
				</div>
				
			</li>
		<?php } ?>
	<?php } else { ?>
			<li>You have not added any categories yet.</li>
	<?php } ?>
</ul>

<script>
$(function() {

	// add category
	$("#button-add-category").live('click', function() {
		// define params
		var category = $("#portfolio-category").val();
		var form = $(this).parents('form#portfolio-categories-edit');

		$.ajax({
			type: "post",
			url: "/admin/ajax/portfolio/category",
			data: form.serializeArray(),
			success: function(data) {
				alert(data);
				var li = '<li>'+category+'</li>';
				$("#portfolio-categories").append(li);
			}
		});
	});

	// edit category
	$("#portfolio-categories li a.toggle-settings").live('click', function() {
		var target = $(this).parents('li').attr('id').replace('category-', '');

		$("#category-settings-" + target).slideToggle();
	});

	// add work to this a category
	$("#portfolio-categories li #add-work").live('click', function() {
		var target = $(this).parent().attr('id').replace('category-', '');
		var content = $("#add-work-" + target).parents('div').html();

		$.colorbox({html:content});

	});

	// submit work form via ajax
	$(".add.work input[type=submit]").live('click', function() {

		$.ajax({
			type: "POST",
			url: "/admin/ajax/portfolio/work",
			data: $(this).parents('form').serializeArray(),
			success: function(data) {
				if (data == "true") {
					alert('Success');
				}
				else {
					alert('There was an error, reload this page and try again.  If this problem persists please contactd komanage at ethanmschaefer@gmail.com');
				}
			}
		});

		return false;
		});
	});


</script>
<?php } ?>
