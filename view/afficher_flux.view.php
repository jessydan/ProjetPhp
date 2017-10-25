
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

    <div class="divRecherche">
      <header>
        Recherche par mot clé
      </header>
      <form class="" action="../controler/recherche_menu.ctrl.php" method="post">
        <input type="text" name="motcle" value="">
        <button class="buttonMenu">Rechercher</button>
        <input type="hidden" name="page" value="menu">
      </form>
    </div>
    <?php if(isset($_SESSION['test'])) { ?>
      <img src="<?php echo $urlImage ?>" alt="">
      <?php unset($_SESSION['test']) ?>
    <?php  } ?>
    <?php foreach ($listeRSS as $key => $value) {?>

      <br>
      <div class="divMenu">
        <header>
          <?php $url = "../controler/afficher_mosaiqueFlux.php?idFlux=".$value["id"]; ?>
          Titre du flux : <?php echo $value["titre"]; ?> <a href="<?php echo $url ?>"><img src="../view/iconMosaique.png" alt="iconMosaique.png" width=20px height=20px;></a>
        </header>
        <p><?php echo $value["description"]; ?></p>
        <p>Date de dernière mise a jour : <?php echo $value["date"]; ?></p>
        <?php $idFlux = $value["id"]; ?>
        <!--  Affichage du bouton 'Voir les nouvelles de ce flux' qui redirige sur la page afficher_nouvelles.ctrl avec l'idFlux en paramètre hidden  -->
        <form class="formMenu" action="../controler/afficher_nouvelles.ctrl.php" method="post">
          <button class="buttonMenu">Voir les nouvelles de ce flux</button>

          <input type="hidden" name="idFlux" value="<?php echo $idFlux ?>">
        </form>
        <form class="formMenu" action="../controler/update_flux.ctrl.php" method="post">
          <button class="buttonMenu">Update</button>

          <input type="hidden" name="idFlux" value="<?php echo $idFlux ?>">
        </form>



      </div>
    <?php  } ?>

  </body>
  </html>
