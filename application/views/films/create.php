<h2 class="display-3"><?= $titre; ?></h2>
<?= form_open("films/create") ?>
	Title : <input class="form-control" type="text" name="title" value="<?=set_value("title")?>">
	<?=form_error("title")?>
	<br>
	Description : <textarea class="form-control" name="description"><?=set_value("description")?></textarea>
	<?=form_error("description")?>
	<br>
	<select class="form-control" name="idRealisateur">
		<?php
			foreach ($realisateur as $real)
			{
				echo "<option value='{$real['id']}'".set_select('idRealisateur',$real['id']).">{$real['prenom']} {$real['nom']}</option>";
			}
		?>
	</select>
	<br>
	<input class="btn btn-primary" type="submit" value="Create the movie">
</form>
<br>
<a class="badge badge-pill badge-light px-3 py-2" href="<?= site_url("films/")?>"> Cancel</a>
