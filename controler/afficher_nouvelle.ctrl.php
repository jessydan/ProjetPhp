<?php
session_start();
require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');

$dao = new DAO();
// Récupère l'id de la nouvelle passé en paramètre
$idNouvelle = $_GET['idNouvelle'];
// Crée la nouvelle en la récupérant dans la bdd grâce a son id
$nouvelle = new Nouvelle();
$requete = "SELECT * FROM nouvelle WHERE id='$idNouvelle'";
$q = ($dao->db())->query($requete);
$q->setFetchMode(PDO::FETCH_CLASS, 'Nouvelle');
$nouvelle = $q->fetch();

include('../view/afficher_nouvelle.view.php');
 ?>
