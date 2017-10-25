<?php
session_start();

require_once('../model/DAO.class.php');
if (isset($_SESSION['pseudo'])){
$login = $_SESSION['pseudo'];
$listeRSS = $dao->listeRSSAbo($login);
} else {
  $listeRSS = array();
}
include('../view/afficher_flux.view.php');




 ?>
