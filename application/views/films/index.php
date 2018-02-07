<h1 class="display-1">Tous les films</h1>
<br>
<ul class="list-group">
	<?php 
	foreach ($films as $f):
	?>
		<li class="list-group-item"><?= $f["titre"] ?>
			&nbsp<a href="<?= site_url("films/" . $f["id"]); ?>">Fiche descriptive</a>	
		</li>
	<?php 
	endforeach 
	?>
</ul>
<br>
<a class="btn btn-primary" href="<?= site_url("films/create"); ?>">Add a movie</a>