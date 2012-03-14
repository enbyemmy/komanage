<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
<meta name="description" content="<?= $config['meta-description'] ?>" /> 
<meta name="keywords" content="<?= $config['meta-keywords'] ?>" />
<title><?= $config['title'] ?></title> 
<style type="text/css">
.error {
    color: red;
}
.message {
    padding: 10px;
    background-color: yellow;
}
</style>
</head> 
<body>
	<header>
		<h1><?= $config['title'] ?></h1>
		<nav>
			<?php include Kohana::find_file('views', 'front/shared/navigation'); ?>
		</nav>
	</header>
    <div id="content">
	<?php foreach($blocks as $block): ?>
		<?php include Kohana::find_file('views', 'front/content/block'); ?>
	<?php endforeach; ?>
    </div>
</body>
</html>
