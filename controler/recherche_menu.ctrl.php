<?php
// Ce fichier doit renvoyer une liste de RSS contenant le mot clé dans leur titre ou description
$mot = $_POST["motcle"];

require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');


// Crée la liste qui contiendra toute les RSS
$listeRSS = $dao->listeRSS();
// Pour chaque RSS de la liste on regarde si le  mot clé est présent dans le titre ou dans la description
foreach ($listeRSS as $key => $value) {
  // Si le mot clé est trouvé dans la description ou le titre alors on ne fais rien.
  $patern = '/'.$mot.'/';
  if (  (preg_match($patern, $value->titre()))==1 || (preg_match($patern, $value->description()))==1) {
    // Rien ici
  } else { // Si le mot clé n'est pas trouvé alors on supprime le RSS de la liste.
    unset($listeRSS[$key]);
  }
}
include('../view/afficher_flux.view.php');






 ?>
