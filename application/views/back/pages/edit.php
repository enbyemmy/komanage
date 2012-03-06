<style type="text/css">

.application-instances, #application-options {
	display: none;
}

label#application, #instance, #new-instance {
	display: inline-block;
	width: auto;
}
</style>
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
<?= $page->name ?>
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

		</span>
		<input type="checkbox" id="application-bool" /> Link this URI to an application?
	</label>
	<label id="application" style="display: none;">
		Application
		<span class="bit">
			The application that this url is routed to.
		</span>
		<select name="application">
			<option value="">(Select an application)</option>
			<?php foreach($applications as $value => $object) { ?>
				<option value="<?= $value ?>">
					<?= ucfirst($value) ?>
				</option>
			<?php } ?>
		</select>
	</label>
	<span id="application-options">
		<label id="instance">
			Instance Name
			<span class="bit">
				This is the instance of the selected application.
			</span>
			<span id="instance-slot">

			</span>
		</label>
		<label id="new-instance">
			<input type="button" id="add-new-instance" class="" value="Create New" />
		</label>
	</span>
	<?php foreach($applications as $value => $object): ?>
	<div id="<?= $value ?>" class="application-instances">
		<select name="instances_<?= $value ?>">
			<?php foreach($object as $instance): ?>
			<option value="<?= $instance->id ?>">
				<?= $instance->name ?>
			</option>
			<?php endforeach; ?>
		</select>
	</div>
	<?php endforeach; ?>


	<!-- content blocks -->


	<label>
		<span class="bit">
			Don't forget
		</span>
		<input type="submit" value="Save!" />
	</label>
</form>

<div id="content-blocks">
	<a id="new-content-block" href="/admin/content/edit">Add new content block</a>
</div>
<script>
	$(function() {
		$("#application-bool").click(function() {
			if ($(this).is(':checked')) {
				$("#application, #application-options").show();
				$("label#content-blocks").hide();
			}
			else {
				$("#application, #application-options").hide();
				$("label#content-blocks").show();
			}
		});

		$("select[name=application]").change(function() {

			var target = $(this).val();
			var content = $("#"+ target).html();

			if (target == '') {
				$("#application-options").hide();
				return false;
<label>
	Name
	<span class="bit">
	This is content block name, it will be used as a header for your content block and also for labeling purposes in the admin section.
	</span>
	<input type="text" name="name" placeholder="Name this content block..." />
</label>
			}

			$("#application-options").show();

			$("#application-options input").attr('class', target).val('Create new ' + target);
			$("#instance-slot").html(content);

		});

		// init new application pop up
		$("#add-new-instance").live('click', function() {
			var application = $(this).attr('class');
			var url = '/admin/' + application + '/edit';

			$.colorbox({href:url});

		});


		// add new content block
		$("#new-content-block").click(function() {
			var href = $(this).attr('href');
			$.colorbox({href:href});
			return false;
		});

	});

</script>
