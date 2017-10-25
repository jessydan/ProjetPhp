<?php

class Nouvelle {
  private $titre;   // Le titre
  private $date;    // Date de publication
  private $description; // Contenu de la nouvelle
  private $url;         // Le lien vers la ressource associée à la nouvelle
  private $urlImage;    // URL vers l'image

  // Contructeur
  function __construct() {
  }

  // Fonctions getter
  function titre() {
    return $this->titre;
  }
  function date() {
    return $this->date;
  }
  function description() {
    return $this->description;
  }
  function url() {
    return $this->url;
  }
  function urlImage() {
    return $this->urlImage;
  }

  function downloadImage(DOMElement $item, $imageId) {
    // On suppose que $node est un objet sur le noeud 'enclosure' d'un flux RSS
    // On tente d'accéder à l'attribut 'url'
    $nodeList = $item->getElementsByTagName('enclosure')->item(0);
    if ($nodeList != NULL) {
      $test = $nodeList->attributes->getNamedItem('url');
      // L'attribut url a été trouvé : on récupère sa valeur, c'est l'URL de l'image
      $url = $test->nodeValue;
      // On construit un nom local pour cette image : on suppose que $nomLocalImage contient un identifiant unique
      $this->image = '../view/images/'.$imageId.'.jpg';
      if (file_exists($this->image)){
        // Si le fichier existe déjà on ne fais rien
      } else {
        // On télécharge l'image à l'aide de son URL, et on la copie localement.
        file_put_contents($this->image, file_get_contents($url));
      }

    } else {
      // si le noeud enclosure est inexistant alors pas d'image, on met une image par défaut indiquant a l'utilisateur
      // qu'il n'y a pas d'image disponible pour cette nouvelle.
      $url = "http://event.dag-system.com/bundles/dagcore/images/null.jpg";
      file_put_contents($this->image, file_get_contents($url));
    }
  }

  // Charge les attributs de la nouvelle avec les informations du noeud XML
  function update(DOMElement $item) {
    // Met a jour le titre, date, description et url avec ce qu'on récupère dans l'item.
    $this->titre = $item->getElementsByTagName('title')->item(0)->textContent;
    $this->date = $item->getElementsByTagName('pubDate')->item(0)->textContent;
    $this->description = $item->getElementsByTagName('description')->item(0)->textContent;
    $this->url = $item->getElementsByTagName('link')->item(0)->textContent;

    // Vérifie si le noeud enclosure est présent.
    $nodeList = $item->getElementsByTagName('enclosure')->item(0);
    if ($nodeList != NULL) {
      // L'attribut url a été trouvé : on récupère sa valeur, c'est l'URL de l'image
      $test = $nodeList->attributes->getNamedItem('url');
      $url = $test->nodeValue;
      // Met a jour l'url de l'image.
      $this->urlImage = $url;
    } else {
      // Pas d'image
      $this->urlImage = "";
    }



  }
}
?>
