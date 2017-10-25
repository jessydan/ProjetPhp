<?php
// Ce fichier doit renvoyer une liste de RSS contenant le mot clé dans leur titre ou description
session_start();
$mot = $_POST["motcle"];

require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');

$login = $_SESSION['pseudo'];

if ($_POST["page"]=="menu"){


  // Crée la liste qui contiendra toute les RSS
  $listeRSS = $dao->listeRSSabo($login);
  // Pour chaque RSS de la liste on regarde si le  mot clé est présent dans le titre ou dans la description
  foreach ($listeRSS as $key => $value) {
    // Si le mot clé est trouvé dans la description ou le titre alors on ne fais rien.
    $patern = '/'.$mot.'/';
    if (  (preg_match($patern, $value["titre"]))==1 || (preg_match($patern, $value["description"]))==1) {
      // Rien ici
    } else { // Si le mot clé n'est pas trouvé alors on supprime le RSS de la liste.
      unset($listeRSS[$key]);
    }
  }
  include('../view/afficher_flux.view.php');
}

if ($_POST["page"]=="nouvelles"){
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
  foreach ($listeNouvelle as $key => $value) {
    // Si le mot clé est trouvé dans la description ou le titre alors on ne fais rien.
    $patern = '/'.$mot.'/';
    if (  (preg_match($patern, $value->titre()))==1 || (preg_match($patern, $value->description()))==1) {
      // Rien ici
    } else { // Si le mot clé n'est pas trouvé alors on supprime le RSS de la liste.
      unset($listeNouvelle[$key]);
    }
  }

  if (empty($listeNouvelle)){
      $listeNouvelle = array();
  }

  include('../view/afficher_nouvelles.view.php');
}








 ?>
