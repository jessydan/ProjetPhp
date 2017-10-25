<?php
session_start();
require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');

// Ouvre la base de donnée
$dao = new DAO();
// Récupère toutes les nouvelles de la base de donnée dont le RSS id est dans la liste de RSS de la personne.
if (isset($_SESSION['pseudo'])){
$login = $_SESSION['pseudo'];
$listeNouvelle = $dao->listeNouvelleAbo($login);
} else {
  $listeNouvelle = array();
}


include('../view/afficher_nouvelles_img.view.php');


 ?>
