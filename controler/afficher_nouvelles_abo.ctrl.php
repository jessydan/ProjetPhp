<?php
session_start();
require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');
$login = $_SESSION['pseudo'];
$dao = new DAO();
// On récupère les RSS auquel l'utilisateur est abonné.
$requete = "SELECT RSS_id FROM abonnement WHERE utilisateur_login='$login'";
$q = ($dao->db())->query($requete);
$liste = $q->fetchAll();

$listeRssAbo = array();
foreach ($liste as $key => $value) {
  $listeRssAbo[] = $liste[$key][0];
}


  $listeNouvelle = array();
// Pour chaque flux RSS auquel il est abonné on récupère l'id de la première nouvelle et on crée les nouvelles associé au flux
foreach ($listeRssAbo as $key => $value) {
  $test = ($dao->db())->query("SELECT count(*) FROM nouvelle WHERE RSS_id='$value'");
  $nbNouvelle = (intval($test->fetch()[0]));

  // Récupère l'id de la première nouvelle du flux RSS de la base de donnée (Ce n'est pas 1 y'a des bugs avec l'autoincrément)
  $requete = ($dao->db())->query("SELECT id FROM nouvelle WHERE RSS_id='$value' LIMIT 1");
  $idMin = intval($requete->fetch()[0]);


  // Crée la liste qui contiendra toute les nouvelles

  // On parcours toute les nouvelles
  for ($i=$idMin; $i < $idMin+$nbNouvelle; $i++) {
    // Pour chaque itération on crée une nouvelle avec ce que l'on récupère dans la bdd.
    $nouvelle = new Nouvelle();
    $requete = "SELECT * FROM nouvelle WHERE id='$i'";
    $q = ($dao->db())->query($requete);
    $q->setFetchMode(PDO::FETCH_CLASS, 'Nouvelle');
    $nouvelle = $q->fetch();
    $listeNouvelle[] = $nouvelle;
  }

}
if (empty($listeNouvelle)){
    $listeNouvelle = array();
}


include('../view/afficher_nouvelles.view.php');

 ?>
