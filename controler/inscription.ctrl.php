<?php
$pseudo = $_POST["Pseudo"];
$MDP = $_POST["MDP"];
$MDPverif = $_POST["MDPVerif"];

require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');
$dao = new DAO();
if ($MDP == $MDPverif){
  $requete = "INSERT INTO utilisateur VALUES('$pseudo','$MDP')";
  $q = ($dao->db())->exec($requete);
}

include('../view/connexion.view.php');

 ?>
