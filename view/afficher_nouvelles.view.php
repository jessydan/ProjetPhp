<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Liste nouvelle d'un flux</title>
    <link rel="stylesheet" type="text/css" href="../view/menu.css">
    <style media="screen">
      body{

    margin: 0;
    padding: 0 3em;
    color: -moz-fieldText;
    font: message-box;

      }
      .image {
    border: 1px solid THreeDShadow;
    padding: 1em;
    margin: 1em auto;
    background: -moz-Dialog;
}
#conteneur
{
    display: flex;
    justify-content: space-between;

}
.element:nth-child(2) /* On prend le deuxième bloc élément */
{
    align-self: flex-end; /* Seul ce bloc sera aligné à la fin */
}
.element:nth-child(1) /* On prend le deuxième bloc élément */
{
    align-self: flex-start; /* Seul ce bloc sera aligné à la fin */
}
h3{
  margin-bottom: 0px;
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

    <?php foreach ($listeNouvelle as $key => $value) {?>
      <h3><a href="<?php echo $value->url(); ?>"><?php echo $value->titre(); ?></a></h3>
      <?php echo $value->date(); ?>

      <div id="conteneur">
        <div class="element">   <?php echo $value->description(); ?>      </div>
        <div class="element">
          <?php $urlImage = "http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/view/images/".$value->image.".jpg"; ?>

          <a href="<?php echo $urlImage; ?>"><img src="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/view/iconImage.png" alt="iconImage.png" width=50px height=50px></a>
          </div>


      </div>







  <?php  } ?>
  </body>
</html>
