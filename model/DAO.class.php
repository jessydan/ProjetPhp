<?php
require_once('RSS.class.php');
require_once('Nouvelle.class.php');
class DAO {
  private $db; // L'objet de la base de donnée

  // Ouverture de la base de donnée
  function __construct() {
    $dsn = 'sqlite:/users/info/etu-s3/chenavje/public_html/ProgWeb/ProjetPhp/model/data/rss.db'; // Data source name
    try {
      $this->db = new PDO($dsn);

    } catch (PDOException $e) {
      exit("Erreur ouverture BD : ".$e->getMessage());
    }
  }

  function db(){
    return $this->db;
  }
  //////////////////////////////////////////////////////////
  // Methodes CRUD sur RSS
  //////////////////////////////////////////////////////////

  // Crée un nouveau flux à partir d'une URL
  // Si le flux existe déjà on ne le crée pas
  function createRSS($url) {
    $rss = $this->readRSSfromURL($url);
    if ($rss == NULL) {
      try {
        $q = "INSERT INTO RSS (url) VALUES ('$url')";

        $r = $this->db->exec($q);
        if ($r == 0) {
          die("createRSS error: no rss inserted\n");
        }
        return $this->readRSSfromURL($url);
      } catch (PDOException $e) {
        die("PDO Error :".$e->getMessage());
      }
    } else {
      // Retourne l'objet existant
      return $rss;
    }
  }

  // Acces à un objet RSS à partir de son URL
  function readRSSfromURL($url) {
    // On regarde s'il y a un RSS correspondant a notre URL.
    $query = $this->db->prepare("SELECT COUNT(id) FROM RSS WHERE url = :url");
    $query->bindValue('url', $url, PDO::PARAM_STR);
    $query->execute();
    $num_row = $query->fetchColumn();
    // Si non on retourne NULL;
    if ($num_row == 0){
      return NULL;
    }
    // Si oui on récupère les données et on créer un RSS avec.
    else {
      // On récupère l'id (Un RSS se créer avec un URL et un ID)
      $requete = "SELECT id FROM RSS WHERE url='$url'";
      $q = ($this->db)->query($requete);
      $id = $q->fetch();
      // On crée un RSS avec l'url et l'id. Et on le return.
      $rss = new RSS($url, intval($id[0]));
      return $rss;
    }
  }


  // Met à jour un flux
  function updateRSS(RSS $rss) {
    // Met à jour uniquement le titre et la date
    $titre = $this->db->quote($rss->titre());
    $q = "UPDATE RSS SET titre=$titre, date='".$rss->date()."' WHERE url='".$rss->url()."'";
    try {
      $r = $this->db->exec($q);
      if ($r == 0) {
        die("updateRSS error: no rss updated\n");
      }
    } catch (PDOException $e) {
      die("PDO Error :".$e->getMessage());
    }
  }

  function listeRSS(){
    // Crée la liste qui contiendra toute les RSS
    $listeRSS = array();
    // Récupère tous les flux RSS de la base de donnée.
    // On récupère le nombre de flux RSS a récuperer.
    $query = $this->db->prepare("SELECT COUNT(id) FROM RSS");
    $query->execute();
    $nbRSS = $query->fetchColumn();
    if($nbRSS>0){
      // Récupère l'id du premier flux RSS de la base de donnée (Ce n'est pas 1 y'a des bugs avec l'autoincrément)
      $requete = ($this->db())->query("SELECT id FROM RSS LIMIT 1");
      $idMin = intval($requete->fetch()[0]);
      // On parcours tous les RSS
      for ($i=$idMin; $i < $idMin+$nbRSS; $i++) {
        // Pour chaque itération on crée un RSS avec ce que l'on récupère dans la bdd.
        // On récupère l'url du RSS d'id i
        $requete = "SELECT url FROM RSS WHERE id='$i'";
        $q = ($this->db())->query($requete);
        $urlRss = $q->fetch();
        // On crée le RSS avec l'url récupéré et l'id i
        $RSS = new RSS($urlRss[0],$i);
        // On update le RSS pour intialiser ses nouvelles
        $RSS->update();
        // On ajoute le RSS dans la liste de RSS
        $listeRSS[] = $RSS;
      }
    }
    return $listeRSS;
  }
  //////////////////////////////////////////////////////////
  // Methodes CRUD sur Nouvelle
  //////////////////////////////////////////////////////////

  // Acces à une nouvelle à partir de son titre et l'ID du flux
  function readNouvellefromTitre($titre,$RSS_id) {
    // On regarde s'il y a une Nouvelle correspondant a notre titre.
    $query = $this->db->prepare("SELECT COUNT(id) FROM nouvelle WHERE titre = :titre");
    $query->bindValue('titre', $titre, PDO::PARAM_STR);
    $query->execute();
    $num_row = $query->fetchColumn();
    // Si non on retourne NULL;

    if ($num_row == 0){
      return NULL;
    } // Si oui on crée une nouvelle avec ce qu'on récupère dans la BDD. Et on la return.
    else {

      $titreEscape= SQLite3::escapeString($titre);
      $requete = "SELECT * FROM nouvelle WHERE titre='$titreEscape'";
      $q = $this->db->query($requete);
      $q->setFetchMode(PDO::FETCH_CLASS, 'Nouvelle');
      $nouvelle = $q->fetch();
      return $nouvelle;
    }
  }


  // Crée une nouvelle dans la base à partir d'un objet nouvelle
  // et de l'id du flux auquelle elle appartient
  function createNouvelle(Nouvelle $n, $RSS_id) {
    // On vérifie si une nouvelle n'existe pas avec les même paramètres.
    if ($this->readNouvellefromTitre($n->titre(),$RSS_id) == NULL){
      // Si elle n'existe pas on insère une nouvelle avec les paramètres donnés.
      $date = $n->date();
      $titre = SQLite3::escapeString($n->titre()); // Le escapeString permet d'éviter le problème des quote
      $description = SQLite3::escapeString($n->description());
      $url = SQLite3::escapeString($n->url());
      $urlImage = SQLite3::escapeString($n->urlImage());
      // Requete insert.
      $requete = "INSERT INTO nouvelle(date,titre,description,url,image,RSS_id) VALUES('$date','$titre','$description','$url','$urlImage',$RSS_id)";
      $this->db->exec($requete);
      // Récupère l'id de la nouvelle crée (Il est crée en autoincrement).
      $requete = "SELECT id FROM nouvelle WHERE url='$url'";
      $q = $this->db->query($requete);
      $idImg = $q->fetch();
      // Utilise cet ID pour donner un nom aux images (cohérent avec celles téléchargées) qui est IDRSS_IDNOUVELLE.
      $image = $RSS_id."_".$idImg[0];
      // Requête update qui modifie l'image en IDRSS_IDNOUVELLE.
      $requete = "UPDATE nouvelle SET image='$image' WHERE url='$url'";
      $q = $this->db->exec($requete);

    } else {
      // Si elle existe déjà on ne fais rien.
    }
  }
}
$dao = new DAO();
?>
