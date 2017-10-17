<?php
// Test de la classe DAO
       require_once('DAO.class.php');

       // Test si l'URL existe dans la BD
       $url ='http://www.france24.com/fr/europe/rss';
       $dao = new DAO();
       $rss = $dao->readRSSfromURL($url);
       if ($rss == NULL) {
         echo $url." n'est pas connu\n";
         echo "On l'ajoute ... \n";
         $rss = $dao->createRSS($url);
       }
       // Mise à jour du flux
       $rss->update();

       $url = 'http://www.lemonde.fr/m-actu/rss_full.xml';
       $dao = new DAO();
       $rss = $dao->readRSSfromURL($url);
       if ($rss == NULL) {
         echo $url." n'est pas connu\n";
         echo "On l'ajoute ... \n";
         $rss = $dao->createRSS($url);

       }

       // Mise à jour du flux
       $rss->update();
       var_dump($rss);
 ?>
