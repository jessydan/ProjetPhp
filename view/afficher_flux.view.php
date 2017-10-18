
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Affichage des flux</title>
  <link rel="stylesheet" type="text/css" href="../view/menu.css">
  <style media="screen">
  <?php if (isset($_SESSION['color'])) { ?>
    <?php $color = $_SESSION['color']; ?>
    nav {  background: <?php echo $color ?>;  }
    div > header{  background-color: <?php echo $color ?>;}
    .formMenu > button{  background: <?php echo $color ?>;}
    .formMenu > button:hover{  background: <?php echo $color ?>;}
    .divRecherche > form > button{  background:  <?php echo $color ?>;}
    <?php } ?>
    </style>
  </head>
  <body>
    <nav id="navigation">
      <ul>
        <li class="navigation"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/controler/afficher_flux.ctrl.php"><b>Menu</b></a></li>
        <!-- Si l'utilisateur est l'administrateur on affiche les sections pour ajouter et supprimer un flux -->
        <?php if (isset($_SESSION['pseudo'])  && $_SESSION['pseudo'] == 'admin') { ?>
          <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/controler/ajouter_flux.ctrl.php"><b>Ajouter un flux</b></a></li>
          <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/controler/vider_flux.ctrl.php"><b>Supprimer un flux</b></a></li>
        <?php } ?>
        <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/controler/afficher_nouvelles_img.ctrl.php"><b>Mosaique d'image</b></a></li>
        <?php if (isset($_SESSION['pseudo'])){ ?>
          <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/controler/afficher_nouvelles_abo.ctrl.php"><b>Mes News</b></a></li>
          <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/controler/afficher_outils.ctrl.php"><b>Outils</b></a></li>
        <?php } ?>
        <?php if (isset($_SESSION['pseudo'])) {?>
          <li class="boutondroite"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/controler/deconnection.ctrl.php"><b>Se déconnecter (<?php echo $_SESSION['pseudo'];?>)</b></a></li>
        <?php } else { ?>
          <li class="boutondroite"><a href="#"><b>Connection</b></a>
            <ul class="submenu">
              <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/view/connexion.view.php"><b>Se connecter</b></a></li>
              <li class="bouton"><a href="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/view/inscription.view.php"><b>S'inscrire</b></a></li>
            <?php } ?>
          </ul>
        </li>
      </ul>
    </nav>
    <br>
    <div class="divRecherche">
      <header>
        Recherche par mot clé
      </header>
      <form class="" action="../controler/recherche_menu.ctrl.php" method="post">
        <input type="text" name="motcle" value="">
        <button class="buttonMenu">Rechercher</button>
      </form>
    </div>

    <?php foreach ($listeRSS as $key => $value) {?>
      <br>
      <div class="divMenu">
        <header>
          Titre du flux : <?php echo $value->titre(); ?>
        </header>
        <p><?php echo $value->description(); ?></p>
        <p>Date de dernière mise a jour : <?php echo $value->date(); ?></p>
        <?php $idFlux = $value->id(); ?>
        <!--  Affichage du bouton 'Voir les nouvelles de ce flux' qui redirige sur la page afficher_nouvelles.ctrl avec l'idFlux en paramètre hidden  -->
        <form class="formMenu" action="../controler/afficher_nouvelles.ctrl.php" method="post">
          <button class="buttonMenu">Voir les nouvelles de ce flux</button>
          <input type="hidden" name="idFlux" value="<?php echo $idFlux ?>">
        </form>
        <!--  Si un utilisateur est connecté et que le flux n'es pas dans ses abonnement affichage du bouton S'abonner -->

        <?php if (  (isset($_SESSION['pseudo'])) && !in_array($idFlux,$listeAbo)   ) {?>
          <form class="formMenu" action="../controler/ajouter_abonnement.ctrl.php" method="post">
            <button class="buttonMenu">S'abonner au flux</button>
            <input type="hidden" name="idFlux" value="<?php echo $idFlux ?>">
            <?php $pseudo = $_SESSION['pseudo']; ?>
            <input type="hidden" name="pseudo" value="<?php echo $pseudo ?>">
          </form>
        <?php } ?>
        <!--  Si un utilisateur est connecté et que le flux est dans ses abonnements afffichage du bouton se désabonner -->
        <?php if (  (isset($_SESSION['pseudo'])) && in_array($idFlux,$listeAbo)   ) {?>
          <form class="formMenu" action="../controler/supprimer_abonnement.ctrl.php" method="post">
            <button style="background: #4cb7ff;" class="buttonMenu">Se désabonner du flux</button>
            <input type="hidden" name="idFlux" value="<?php echo $idFlux ?>">

            <?php $pseudo = $_SESSION['pseudo']; ?>
            <input type="hidden" name="pseudo" value="<?php echo $pseudo ?>">
          </form>
        <?php } ?>



      </div>
    <?php  } ?>

  </body>
  </html>
