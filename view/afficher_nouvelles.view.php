<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Liste nouvelle d'un flux</title>
    <link rel="stylesheet" type="text/css" href="../view/menu.css">
    <style media="screen">
    <?php if (isset($_SESSION['color'])) { ?>
      <?php $color = $_SESSION['color']; ?>
      nav {  background: <?php echo $color ?>;  }
      form > header{  background-color: <?php echo $color ?>;}
      form > header > a {
        padding-left: 10px;
      }
      form > button{  background: <?php echo $color ?>;}
      form > button:hover{  background: <?php echo $color ?>;}
      div{  color:  <?php echo $color ?>;}
      div > header{  background:  <?php echo $color ?>;}
      <?php } ?>

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
#conteneur > .element{
  color : black;
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
        <input type="hidden" name="page" value="nouvelles">

      </form>
    </div>
    <br>
    <?php foreach ($listeNouvelle as $key => $value) {?>
    <form>
    <header class="headernouvelle">
    <a href="<?php echo $value->url(); ?>"><?php echo $value->titre(); ?></a> <p class="help"><?php echo $value->date(); ?></p>
    </header>
    <div id="conteneur">
      <div class="element">   <?php echo $value->description(); ?>      </div>
      <div class="element">
        <?php $urlImage = "http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/view/images/".$value->image.".jpg"; ?>

        <a href="<?php echo $urlImage; ?>"><img src="http://www-etu-info.iut2.upmf-grenoble.fr/~chenavje/ProgWeb/ProjetPhp/view/iconImage.png" alt="iconImage.png" width=50px height=50px></a>
        </div>
    </div>
    </form>
    <br>
    <?php  } ?>












  </body>
</html>
