<?php
require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');
$pseudo = $_POST["pseudo"];
$RSS_id = $_POST["idFlux"];

$dao = new DAO();
$requete = "DELETE FROM abonnement WHERE RSS_id='$RSS_id'";
$dao->db()->exec($requete);
include('../controler/afficher_flux.ctrl.php');



 ?>
