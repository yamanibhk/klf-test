<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="p-2 p-md-4 p-lg-5">
  <div class="row">
    <?php
    foreach ($usagers as $usager) {
      // echo "<pre>";
      // var_dump($usager);
      // echo "</pre>";
      ?>
      <div class="col-lg-6 col-xl-4 p-3">
        <div class="card">
          <div class="card-body">
            <small class='float-right text-muted'>
              <?php
              //Statut de l'usager (banni, valide ou invalide)
              if($usager->estBanni == true) {
                echo "Banni<i class='fas fa-times-circle ml-2 text-danger'></i></i>";
              } else {
                if($usager->estValide == true){
                  echo "Validé<i class='fas fa-check-circle ml-2 text-success'></i>";
                } else {
                  echo "Non-validé<i class='fas fa-exclamation-circle ml-2 text-warning'></i>";
                }
              }
              ?>
            </small>
            <h5 class="card-title mb-1"><?=$usager->nomUsager?><small class="blockquote-footer d-inline ml-2"><?=$usager->Prenom." ".$usager->Nom?></small></h5>
            <small class="text-muted">
              <?php
              //Type d'usager, admin, superadmin ou usager
              if($usager->idRole > 1) {
                echo "Membre";
              } else {
                if($usager->idRole == 1){
                  echo "Administrateur";
                } else {
                  echo "Super-administrateur";
                }
              }
              ?>
            </small>
            <hr class='my-2'>
            <section class="p-2">
              <div class="d-flex flex-wrap justify-content-start mb-2">
                <div class="mr-4" data-toggle="tooltip" data-placement="top" title="Nombre de logements appartenant à cet usager">
                  <i class="fas fa-home text-muted mr-2"></i>
                  <span>Logements : <?php echo ($usager->NbreAppart != null ? $usager->NbreAppart : "0")?></span>
                </div>
                <div data-toggle="tooltip" data-placement="top" title="Nombre de locations effectuées par cet usager">
                  <i class="far fa-handshake text-muted mr-2"></i>
                  Locations : <?php echo ($usager->NbreLocat != null ? $usager->NbreLocat : "0") ?>
                </div>
              </div>
              <div class="mr-4 mb-2">
                <i class="far fa-calendar-alt text-muted mr-2"></i>Membre depuis : <span><?=$usager->dateCreationCompte?></span>
              </div>
            </section>
            <div class="btn-group dropright">
              <?php
              if($usager->nomUsager == $utilisateur['nomUsager']){
                ?>
                <button type="button" class="btn btn-outline-secondary dropdown-toggle" disabled="disabled" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Actions
                </button>
                <?php
              } else {
                ?>
                <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Actions
                </button>
                <?php
              }
              ?>
              <div class="dropdown-menu p-0">
                <?php
                if($usager->estBanni == true) {
                  echo "<a id='btn_gracier' class='dropdown-item py-2' href='#' onclick='return false'>Gracier</a>";
                } else {
                  //Si l'usager est valide, on pourra le bannir
                  if($usager->estValide == true) {
                    //Si l'usager actif est super admin il pourra toujours bannir
                    if($utilisateur['idRole'] < 1) {
                      echo "<a id='btn_bannir' class='dropdown-item py-2' href='#' onclick='return false'>Bannir</a>";
                    } else {
                      //Si l'usager qu'on veut bannir est un autre admin, il ne sera pas possible de le faire
                      if($usager->idRole < 2) {
                        echo "<a id='btn_bannir' class='dropdown-item disabled py-2' href='#' onclick='return false' disabled='disabled'>Bannir</a>";
                      } else {
                        echo "<a id='btn_bannir' class='dropdown-item py-2' href='#' onclick='return false'>Bannir</a>";
                      }
                    }
                  } else {
                    echo "<a id='btn_valider' class='dropdown-item py-2' href='#' onclick='return false'>Valider</a>";
                  }
                }
                //Si l'utilisateur avec la session active est super-admin il pourra faire de nouveaux admin
                if($utilisateur['idRole'] < 1) {
                  echo "<a id='btn_nouv_admin' class='dropdown-item py-2' href='#' onclick='return false'>Nouvel administrateur</a>";
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php
    }
    ?>
  </div>
</div>