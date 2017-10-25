<?php

require_once('Nouvelle.class.php');
require_once('DAO.class.php');

class RSS {
  private $titre; // Titre du flux
  private $url;   // Chemin URL pour télécharger un nouvel état du flux
  private $date;  // Date du dernier téléchargement du flux
  private $description; // J'ai ajouté une description puisqu'il y en a une dans les flux RSS.
  private $id; // Id du flux dans la base de donnée (Rajouté par moi même pour simplifier les choses)
  private $nouvelles; // Liste des nouvelles du flux dans un tableau d'objets Nouvelle


  // Contructeur j'ai rajouté l'id directement ici pour que ce soit plus simple par la suite.
  function __construct($url, $id) {
    $this->url = $url;
    $this->id = $id;
    $this->nouvelles = array();
  }

  // Fonctions getter
  function titre() {
    return $this->titre;
  }
  function url(){
    return $this->url;
  }
  function date(){
    return $this->date;
  }
  function nouvelles(){
    return $this->nouvelles;
  }
  function id(){
    return $this->id;
  }
  function description(){
    return $this->description;
  }


  // Récupère un flux à partir de son URL
  function update() {
    date_default_timezone_set('Europe/Paris');
    // Crée un nouvel objet avec la base de donnée rss.db
    $dao = new DAO();
    // Cree un objet pour accueillir le contenu du RSS : un document XML
    $doc = new DOMDocument;
    //Telecharge le fichier XML dans $rss
    $doc->load($this->url);
    // Recupère la liste (DOMNodeList) de tous les elements de l'arbre 'title'
    $nodeList = $doc->getElementsByTagName('title');
    // Met à jour le titre dans l'objet
    $this->titre = $nodeList->item(0)->textContent;
    // Met a jour la description
    $this->description = $doc->getElementsByTagName('description')->item(0)->textContent;
    // Change la date de modification a la date actuelle
    $this->date = date('l jS \of F Y h:i:s A');
    // Récupère tous les items(Nouvelles) du flux RSS
    
    foreach ($doc->getElementsByTagName('item') as $node) {
      // Création d'un objet Nouvelle à conserver dans la liste $this->nouvelles
      $nouvelle = new Nouvelle();
      // Modifie cette nouvelle avec l'information téléchargée
      $nouvelle->update($node);
      // Crée la nouvelle dans la base de donnée avec l'id du RSS courant.
      $dao->createNouvelle($nouvelle,$this->id);
      // Récupère l'url de la nouvelle
      $urlDownload = $nouvelle->url();
      // Requete sql pour récupérer l'id de la nouvelle crée.
      $requete = "SELECT id FROM nouvelle WHERE url='$urlDownload'";
      $q = $dao->db()->query($requete);
      $idImg = $q->fetch();
      // Download l'image de la nouvelle courrante, et la renomme en RSSID_NOUVELLEID.jpg
      $nouvelle->downloadImage($node,$this->id."_".$idImg[0]);
      // Place la nouvelle dans la liste de nouvelles
      $this->nouvelles[] = ($nouvelle);
    }
  }
}
?>
