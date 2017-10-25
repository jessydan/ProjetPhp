<?php

require_once('/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/DAO.class.php');
$dao = new DAO();
$idFlux = $_POST['idFlux'];

$requete = "SELECT * FROM RSS WHERE id='$idFlux'";
$q = $dao->db()->query($requete);
$result = $q->fetch(PDO::FETCH_ASSOC);

$RSS = new RSS($result["url"],$result["id"]);
$RSS->update();
$dao->updateRSS($RSS);

include('../controler/afficher_flux.ctrl.php');
 ?>
