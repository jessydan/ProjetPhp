<?php
session_start();
require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');

$idFlux = $_POST['idFlux'];


// On récupère le nombre de nouvelles a récuperer pour un flux rss donné.
$test = ($dao->db())->query("SELECT count(*) FROM nouvelle WHERE RSS_id='$idFlux'");
$nbNouvelle = intval($test->fetch()[0]);


// Récupère l'id de la première nouvelle du flux RSS de la base de donnée (Ce n'est pas 1 y'a des bugs avec l'autoincrément)
$requete = ($dao->db())->query("SELECT id FROM nouvelle WHERE RSS_id='$idFlux' LIMIT 1");
$idMin = intval($requete->fetch()[0]);


// Crée la liste qui contiendra toute les nouvelles
$listeNouvelle = array();
// On parcours toute les nouvelles
for ($i=$idMin; $i < $idMin+$nbNouvelle; $i++) {
  // Pour chaque itération on crée un RSS avec ce que l'on récupère dans la bdd.
  $nouvelle = new Nouvelle();
  $requete = "SELECT * FROM nouvelle WHERE id='$i'";
  $q = ($dao->db())->query($requete);
  $q->setFetchMode(PDO::FETCH_CLASS, 'Nouvelle');
  $nouvelle = $q->fetch();
  $listeNouvelle[] = $nouvelle;
}

include('../view/afficher_nouvelles.view.php');

 ?>
