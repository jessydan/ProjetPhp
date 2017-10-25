<?php
session_start();
require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');




if(isset($_POST["fluxRss"])){

  // Si le flux RSS as été récupéré par le formulaire de la vue on l'ajoute.
  // Vérifie si la chaîne ressemble à une URL
  $url = $_POST["fluxRss"];
  if (filter_var($url, FILTER_VALIDATE_URL)) {
    // On ajoute le flux
    // Test si l'URL existe dans la BD
    $dao = new DAO();
    $rss = $dao->readRSSfromURL($url);
    if ($rss == NULL) {
      $rss = $dao->createRSS($url);
      // Mise à jour du flux
      $rss->update();
      $dao->updateRSS($rss);
      // Ajout du flux dans la base de donnée avec l'utilisateur actuel (abonneemnt)
      $login = $_SESSION['pseudo'];
      $id = $rss->id();
      $requete = "INSERT INTO abonnement (utilisateur_login, RSS_id) VALUES ('$login','$id')";

      $dao->db()->exec($requete);

      include('../view/ajouter_flux.view.php');
    } else {
      $login = $_SESSION['pseudo'];
      $requete = "SELECT id FROM RSS WHERE url='$url'";
      $q = ($dao->db())->query($requete);
      $idt = $q->fetch();
      $id = $idt[0];
      $requete = "INSERT INTO abonnement (utilisateur_login, RSS_id) VALUES ('$login','$id')";
      $dao->db()->exec($requete);
        include('../view/ajouter_flux.view.php');

    }
  } else {
    echo 'Cette URL a un format non adapté.';
  }
} else {
  // Sinon on redirige vers le formulaire
  include('../view/ajouter_flux.view.php');
}

?>
