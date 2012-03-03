<div id="configuration">
	<h1>Preferences</h1>
	<form action="" method="POST".
		<?php foreach($fields as $field => $array) { ?>
		<label>
			<h3>
				<?= $array['label'] ?>
			</h3>
			<span class="bit">
				<?= $array['bit'] ?>
			</span>
			<input type="text" value="<?= Arr::get($prefs, $field) ?>" name="<?= $field ?>" />
		</label>
		<?php } ?>
		<label>
			<input type="submit" value="Save" />
		</label>
	</form>
</div>