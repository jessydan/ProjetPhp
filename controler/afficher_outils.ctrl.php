<?php

session_start();

if (isset($_POST['color'])){
  $_SESSION['color'] = $_POST['color'];
  session_write_close();
include('../view/afficher_outils.view.php');
} else {
include('../view/afficher_outils.view.php');
}


 ?>
