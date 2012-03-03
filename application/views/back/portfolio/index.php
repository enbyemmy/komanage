<h3><a href="/admin/portfolio/edit">Add a new portfolio</a></h3>
<?php if (!$totalportfolios) { ?>

You have not created any portfolios yet.  
<?php } else { ?>

<ul id="portfolios">
	<?php foreach($portfolios as $portfolio) { ?>
	<li id="portfolio-<?= $portfolio->id ?>">
		<?= $portfolio-> name ?>
		<span class="actions">
			<a href="/admin/portfolio/edit/<?= $portfolio->id ?>">Edit</a>
			<a href="#" class="delete" id="delete-<?= $portfolio->id ?>">Delete</a>
		</span>
	</li>
	<?php } ?>
</ul>
<?php } ?>
<script>
$(function() {
	$(".delete").live('click', function() {
		// define the parameters
		var target = $(this).attr('id').replace('delete-', '');

		$.ajax({
		url: '/admin/ajax/portfolio/delete/'+target,
		success: function(data) {
			if (data) {
				$('#portfolios li#portfolio-'+target).addClass('deleted');
			}
			else {
				alert('There was an error please try again');
			}
		}
		});
	});
});
</script>