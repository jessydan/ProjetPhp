<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Nouvelle</title>
        <link rel="stylesheet" type="text/css" href="../view/menu.css">
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

      <h1>Voici la nouvelle d'id : <?php echo $idNouvelle; ?></h1>
    <?php // récupère l'url pour acceder a l'image de notre nouvelle
      $url = "http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/view/images/".$nouvelle->image.".jpg";
       ?>

    <div class="">
      <img src="<?php echo $url; ?>" alt="<?php echo $url; ?>">
      <h2><?php echo $nouvelle->titre(); ?></h2>
      <p><?php echo $nouvelle->description(); ?></p>

      <a href="<?php echo $nouvelle->url() ?>"> Acceder a la nouvelle entière</a>
    </div>
  </body>
</html>