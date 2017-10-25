<?php
session_start();
require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');
// On récupère l'id du Flux
$idFlux = $_GET['idFlux'];
// Ouvre la base de donnée
$dao = new DAO();
// Crée la liste qui contiendra toute les nouvelles
$listeNouvelle = array();
  // On fais une liste avec l'id et l'image des nouvelles lié au flux d'id idFlux
  $requete = "SELECT image,id FROM nouvelle WHERE RSS_id='$idFlux'";
  $q = $dao->db()->query($requete);
  $nouvelle = $q->fetchAll();
  $listeNouvelle[] = $nouvelle;

include('../view/afficher_mosaiqueFlux.view.php');






 ?>
