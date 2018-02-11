<?php
    echo form_open('Usagers/connexion');
?>

<section id="connexion-form">
	<div class="form-group">
        <?php
        echo form_label('Votre username', 'nomUsager');
        $nomUsager= array(

            'name'=>'nomUsager',
            'id'=>'username',
            'class'=>'form-control'

        );
        echo form_input($nomUsager);
        ?>
	  <!--<label for="username">Votre username</label>
	  <input type="text" class="form-control" name="nomUsager" id="username" aria-describedby="username">-->
	</div>
	<div class="form-group">
        <?php
        echo form_label('Votre mot de passe', 'password');
        $motDePasse= array(
            'type'=>'password',
            'name'=>'motDePasse',
            'id'=>'password',
            'class'=>'form-control'
        );
        echo form_input($motDePasse);
        ?>
	  <!--<label for="password">Votre mot de passe</label>
	  <input type="password" class="form-control" name="motDePasse" id="password">-->
	</div>
	<div class="d-flex flex-wrap justify-content-end">
		<a href="#" id="cancel" class="d-block py-2 px-3 text-white">Annuler</a>
		<!--<button id="connexion-submit" class="btn btn-primary">Connexion</button>-->
        <?php 
        $button= array(
            'id'=>'connexion-submit',
            'class'=>'btn btn-primary',
            'value'=>'Connexion'
        );
        echo form_submit($button);
        ?>
	</div>
</section>
<?php
    echo form_close();
?>