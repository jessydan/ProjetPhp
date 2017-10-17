<?php
session_start();
require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');

if(isset($_POST["fluxRss"])){
  $etat = 0;
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
