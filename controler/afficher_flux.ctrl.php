<?php
session_start();

require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');

// Liste des id de RSS dont l'utilisateur est abonnée
$listeRSS = $dao->listeRSS();
$listeAbo = array();
/*
if (isset($_SESSION['pseudo'])){
  $pseudo = $_SESSION['pseudo'];
  // Récupère tous les flux RSS de la base de donnée.
  // On récupère le nombre de flux RSS a récuperer.
  $query = $dao->db()->prepare("SELECT COUNT(utilisateur_login) FROM abonnement WHERE utilisateur_login='$pseudo'");
  $query->execute();
  $nbAbo = $query->fetchColumn();


  if($nbAbo>0){
      $requete = "SELECT RSS_id FROM abonnement WHERE utilisateur_login='$pseudo'";
      $q = ($dao->db())->query($requete);
      $liste = $q->fetchAll();
      foreach ($liste as $key => $value) {
          $listeAbo[] = $value[0];
        }

}

}
*/
include('../view/afficher_flux.view.php');




 ?>
