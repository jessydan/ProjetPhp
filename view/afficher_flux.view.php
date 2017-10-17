
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Affichage des flux</title>
    <link rel="stylesheet" type="text/css" href="../view/menu.css">
    <style media="screen">
      input{
        display: inline-block;
      }
      form {
        display: inline-block;
      }
    </style>
  </head>
  <body>
    <nav id="navigation">
      <ul>
          <li class="navigation"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/controler/afficher_flux.ctrl.php"><b>Menu</b></a></li>
          <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/controler/ajouter_flux.ctrl.php"><b>Ajouter un flux</b></a></li>
          <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/controler/vider_flux.ctrl.php"><b>Supprimer un flux</b></a></li>
          <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/controler/afficher_nouvelles_img.ctrl.php"><b>Mosaique d'image</b></a></li>

              <?php if (isset($_SESSION['pseudo'])) {?>
              <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/controler/deconnection.ctrl.php"><b><?php echo $_SESSION['pseudo']; ?> Se déconnecter</b></a></li>
            <?php } else { ?>
              <li class="bouton"><a href="#"><b>Connection</b></a>
                <ul class="submenu">
              <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/view/connexion.view.php"><b>Se connecter</b></a></li>
              <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/view/inscription.view.php"><b>S'inscrire</b></a></li>

            <?php } ?>
            </ul>



          </li>


      </ul>
    </nav>


    <?php foreach ($listeRSS as $key => $value) {?>
      <div class="">
  <h2>Titre du flux : <?php echo $value->titre(); ?> </h2>
  <p><?php echo $value->description(); ?></p>
  <p>Date de dernière mise a jour : <?php echo $value->date(); ?></p>
  <?php $idFlux = $value->id(); ?>
  <!--  Affichage du bouton 'Voir les nouvelles de ce flux' qui redirige sur la page afficher_nouvelles.ctrl avec l'idFlux en paramètre hidden  -->
  <form class="formMenu" action="../controler/afficher_nouvelles.ctrl.php" method="post">
    <button>Voir les nouvelles de ce flux</button>
    <input type="hidden" name="idFlux" value="<?php echo $idFlux ?>">
  </form>
    <!--  Si un utilisateur est connecté et que le flux n'es pas dans ses abonnement affichage du bouton S'abonner -->

  <?php if (  (isset($_SESSION['pseudo'])) && !in_array($idFlux,$listeAbo)   ) {?>
  <form class="formMenu" action="../controler/ajouter_abonnement.ctrl.php" method="post">
    <button>S'abonner au flux</button>
    <input type="hidden" name="idFlux" value="<?php echo $idFlux ?>">
    <?php $pseudo = $_SESSION['pseudo']; ?>
    <input type="hidden" name="pseudo" value="<?php echo $pseudo ?>">
  </form>
  <?php } ?>
  <!--  Si un utilisateur est connecté et que le flux est dans ses abonnements afffichage du bouton se désabonner -->
  <?php if (  (isset($_SESSION['pseudo'])) && in_array($idFlux,$listeAbo)   ) {?>
  <form class="formMenu" action="../controler/supprimer_abonnement.ctrl.php" method="post">
    <button>Se désabonner du flux</button>
    <input type="hidden" name="idFlux" value="<?php echo $idFlux ?>">

    <?php $pseudo = $_SESSION['pseudo']; ?>
    <input type="hidden" name="pseudo" value="<?php echo $pseudo ?>">
  </form>
  <?php } ?>



</div>
  <?php  } ?>

  </body>
</html>
