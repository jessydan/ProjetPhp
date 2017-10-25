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
      form > #conteneur > .element > button{  background: <?php echo $color ?>;}
      form > button:hover{  background: <?php echo $color ?>;}
      form > #conteneur > .element > label{ color:  <?php echo $color ?>;}

      <?php } ?>

      div > .element{
        width: 49.9%;
        height: 50px;

      }
      form > #conteneur > .element > button{
        width : 30%;
        margin: 0 auto;
        margin-top: 7px;

      }
      form > #conteneur > .element > label{
        width : 90%;
        margin: 0px;
        margin-top: 12px;


      }
      #conteneur
      {
          display: flex;
          margin:auto;

      }
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

    <?php foreach ($listeRSS as $key => $value) {?>

      <form class="" action="../controler/vider_flux.ctrl.php" method="post">
        <div id="conteneur">
          <div class="element"><label><?php echo $value["titre"]; ?></label></div>
          <div class="element">
            <button name="button" value="supprimer">Supprimer le flux</button>
            <button name="button" value="vidanger">Vidanger le flux</button>
            <?php $id = $value["id"]; ?>
            <input type="hidden" name="idFlux" value="<?php echo $id ?>">
            </div>
        </div>


      </form>


      <br>

  <?php  } ?>
  </body>
</html>
