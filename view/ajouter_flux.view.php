<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
        <link rel="stylesheet" type="text/css" href="../view/menu.css">
        <style media="screen">
        <?php if (isset($_SESSION['color'])) { ?>
          <?php $color = $_SESSION['color']; ?>
          nav {  background: <?php echo $color ?>;  }
          form > label{  color: <?php echo $color ?>;}
          form > header{  background-color: <?php echo $color ?>;}
          form > button{  background: <?php echo $color ?>;}
          form > button:hover{  background: <?php echo $color ?>;}
          .divRecherche > form > button{  background:  <?php echo $color ?>;}
          <?php } ?>
          </style>
  </head>
  <body>
    <nav id="navigation">
      <ul>
        <li class="navigation"><a href="../controler/afficher_flux.ctrl.php"><b>Menu</b></a></li>
        <!-- Si l'utilisateur est connecté on affiche les sections pour ajouter et supprimer un flux -->
        <?php if (isset($_SESSION['pseudo'])) { ?>
          <li class="bouton"><a href="../controler/ajouter_flux.ctrl.php"><b>Ajouter un flux</b></a></li>
          <li class="bouton"><a href="../controler/vider_flux.ctrl.php"><b>Supprimer un flux</b></a></li>
          <li class="bouton"><a href="../controler/afficher_nouvelles_img.ctrl.php"><b>Mosaique d'image</b></a></li>
          <li class="bouton"><a href="../controler/afficher_nouvelles_abo.ctrl.php"><b>Mes News</b></a></li>
          <li class="bouton"><a href="../controler/afficher_outils.ctrl.php"><b>Outils</b></a></li>
          <li class="boutondroite"><a href="../controler/deconnection.ctrl.php"><b>Se déconnecter (<?php echo $_SESSION['pseudo'];?>)</b></a></li>
        <?php } else { ?>
          <li class="boutondroite"><a href="#"><b>Connection</b></a>
            <ul class="submenu">
              <li class="bouton"><a href="../view/connexion.view.php"><b>Se connecter</b></a></li>
              <li class="bouton"><a href="../view/inscription.view.php"><b>S'inscrire</b></a></li>
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
