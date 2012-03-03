<div id="configuration">
	<h2>Configuration</h2>
	<form action="" method="POST">
		<?php foreach($fields as $field => $array) { ?>
		<label>
			<h3>
				<?= $array['label'] ?>
			</h3>
			<span class="bit">
				<?= $array['bit'] ?>
			</span>
			<input type="text" value="<?= Arr::get($config, $field) ?>" name="<?= $field ?>" />
		</label>
		<?php } ?>
		<label>
			<input type="submit" value="Save" />
		</label>
	</form>
</div>