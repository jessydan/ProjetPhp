<?php
session_start();
require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');

// Ouvre la base de donnée
$dao = new DAO();
// Récupère toutes les nouvelles de la base de donnée.

// On récupère le nombre de nouvelles a récuperer.
$test = ($dao->db())->query("SELECT count(*) FROM nouvelle");
$nbNouvelle = intval($test->fetch()[0]);
// Récupère l'id de la première nouvelle de la base de donnée (Ce n'est pas 1 y'a des bugs avec l'autoincrément)
$requete = ($dao->db())->query("SELECT id FROM nouvelle LIMIT 1");
$idMin = intval($requete->fetch()[0]);


// Crée la liste qui contiendra toute les nouvelles
$listeNouvelle = array();
// On parcours toute les nouvelles
for ($i=$idMin; $i < $idMin+$nbNouvelle; $i++) {
  // Pour chaque itération on récupère le nom de l'image lié a la nouvelle d'id i.
  $requete = "SELECT * FROM nouvelle WHERE id='$i'";
  $q = ($dao->db())->query($requete);
  $q->setFetchMode(PDO::FETCH_CLASS, 'Nouvelle');
  $nouvelle = $q->fetch();


  $listeNouvelle[] = $nouvelle;
}
//var_dump($listeNouvelle);


include('../view/afficher_nouvelles_img.view.php');





 ?>
