<?php
    echo form_open('Usagers/inscription');
?>
<section id="inscription-form">
	<div class="form-group">
        <?php
        echo form_label('Choisissez votre username', 'username');
        $nomUsager= array(

            'name'=>'nomUsager',
            'id'=>'username',
            'class'=>'form-control',
            'placeholder'=>'Unique, il ne pourra être changé'

        );
        echo form_input($nomUsager);
        ?>
	  <!--<label for="username">Choisissez votre username</label>
	  <input type="text" class="form-control" name="nomUsager" id="username" aria-describedby="username" placeholder="Unique, il ne pourra être changé">-->
	  <div class="valid-feedback"></div>
	  <div class="invalid-feedback"></div>
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
	  <input type="password" class="form-control" id="password" name="motDePasse">-->
	  <div class="valid-feedback"></div>
	  <div class="invalid-feedback"></div>
    </div>
	<div class="form-group">
        <?php
        echo form_label('Confirmez le mot de passe', 'password_confirm');
        $motDePasse= array(

            'type'=>'password',
            'name'=>'motDePasse',
            'id'=>'password_confirm',
            'class'=>'form-control'
        );
        echo form_input($motDePasse);
        ?>
        <!-- <label for="password_confirm">Confirmez le mot de passe</label>
	  <input type="password" class="form-control" id="password_confirm">-->
	  <div class="valid-feedback"></div>
	  <div class="invalid-feedback"></div>
	</div>
	<div class="form-group">
       <?php
        echo form_label('Indiquez votre courriel', 'courriel');
        $motDePasse= array(

            'type'=>'mail',
            'name'=>'courriel',
            'id'=>'courriel',
            'class'=>'form-control'
        );
        echo form_input($motDePasse);
        ?> 
<!--	  <label for="courriel">Indiquez votre courriel</label>
	  <input type="mail" class="form-control" id="courriel" name="courriel">-->
	  <div class="valid-feedback"></div>
	  <div class="invalid-feedback"></div>
	</div>
	<div class="d-flex flex-wrap justify-content-end">
		<a href="#" id="cancel" class="d-block py-2 px-3 text-white">Annuler</a>
		<!--<button id="inscription-submit" class="btn btn-primary">M'inscrire</button>-->
        <?php 
        $button= array(
            'id'=>'connexion-submit',
            'class'=>'btn btn-primary',
            'value'=>"M'inscrire"
        );
        echo form_submit($button);
        ?>
	</div>
</section>
<?php
    echo form_close();
?>