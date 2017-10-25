<?php
session_start();
require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');
// Si on a appuyé sur un bouton le 'idFlux' sera l'id du flux a supprimer.

if(isset($_POST["idFlux"])){
  $idFlux = $_POST["idFlux"];
  $dao = new DAO();
  if($_POST["button"]=="supprimer"){
    // Supprimer toutes nouvelles avec un RSS_id qui vaut 'idFlux'
    $requete = "DELETE FROM nouvelle WHERE RSS_id='$idFlux'";
    $q = $dao->db()->exec($requete);

    // Supprimer le RSS d'id idFlux
    $requete = "DELETE FROM RSS WHERE id='$idFlux'";
    $q = $dao->db()->exec($requete);
    $requete = "DELETE FROM abonnement WHERE RSS_id='$idFlux'";
    $q = $dao->db()->exec($requete);
    // Supprimer toute les images dont le nom est idFlux_*
    $urlImage = "../view/images/".$idFlux."*";
    // Crée une liste avec le nom de toute les images
    $listeImageDelete = glob($urlImage);
    // Pour chaque image on la supprime avec unlink().

    foreach ($listeImageDelete as $key => $value) {
      unlink($value);
    }
    // Notifier l'utilisateur que le Rss as été supprimé.
    $login = $_SESSION['pseudo'];
    $listeRSS = $dao->listeRSSAbo($login);

    include('../view/vider_flux.view.php');
  }

  else if($_POST["button"]=="vidanger"){
    // Supprimer toutes nouvelles avec un RSS_id qui vaut 'idFlux'
    $requete = "DELETE FROM nouvelle WHERE RSS_id='$idFlux'";
    $q = $dao->db()->exec($requete);
    echo "on supprime le RSS d'id : ".$idFlux;
    // Supprimer le RSS d'id idFlux
    $requete = "SELECT url FROM RSS WHERE id='$idFlux'";
    $q = $dao->db()->query($requete);
    $urlRss = $q->fetch();

    $requete = "DELETE FROM RSS WHERE id='$idFlux'";
    $q = $dao->db()->exec($requete);
    $requete = "DELETE FROM abonnement WHERE RSS_id='$idFlux'";
    $q = $dao->db()->exec($requete);
    // Supprimer toute les images dont le nom est idFlux_*
    $urlImage = "../view/images/".$idFlux."*";
    // Crée une liste avec le nom de toute les images
    $listeImageDelete = glob($urlImage);
    // Pour chaque image on la supprime avec unlink().
    var_dump($listeImageDelete);
    foreach ($listeImageDelete as $key => $value) {
      unlink($value);
    }

      $rss = $dao->createRSS($urlRss[0]);
      // Mise à jour du flux
      $rss->update();
      $dao->updateRSS($rss);
      // Ajout du flux dans la base de donnée avec l'utilisateur actuel (abonneemnt)
      $login = $_SESSION['pseudo'];
      $id = $rss->id();
      $requete = "INSERT INTO abonnement (utilisateur_login, RSS_id) VALUES ('$login','$id')";

      $dao->db()->exec($requete);
      $listeRSS = $dao->listeRSSAbo($login);

    include('../view/vider_flux.view.php');
  }



} else { // Sinon on renvoie sur la vue pour choisir quel flux supprimer.
  // Tout le bordel pour créer la liste de RSS pour pouvoir les affichers
  // Apelle la fonction de DAO pour créer une liste des RSS.
  $login = $_SESSION['pseudo'];
  $listeRSS = $dao->listeRSSAbo($login);
  include('../view/vider_flux.view.php');
}






?>
