<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
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

    <br>
    <br>
    <form  class="" action="../controler/ajouter_flux.ctrl.php" method="post">
      <header>
        Vous pouvez ajouter un flux RSS a partir de son URL
      </header>
        <label>Url du flux RSS</label>
        <input type="text" name="fluxRss" value="">
        <button>Ajouter</button>
        <?php if (isset($rss)){?>
        <header>
          <?php echo "Le flux rss de titre ".$rss->titre()." as été ajouté a la base."; ?>
        </header>
      <?php } ?>

    </form>

  </body>
</html>
