<?php

class Content {
	private $db;
	private $menu_selectionne = 'accueil';
	private $selected_menu = '';
    public function __construct() {

		$this->db = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.'', DBUSER, DBPASS);
		
		$item = isset($_GET['item']) ? $_GET['item'] : $this->menu_selectionne;
		switch($item)
		{
			case 'accueil':
				$this->menu_selectionne='accueil';
				$this->selected_menu = 'accueil';
				break;
			case 'favoris':
				$this->menu_selectionne='favoris';
				$this->selected_menu = 'favoris';
				break;
			case 'identification':
				$this->menu_selectionne='identification';
				$this->selected_menu = 'compte';
				break;
			case 'creer_compte':
				$this->menu_selectionne='creer_compte';
				$this->selected_menu = 'compte';
				break;
			case 'mon_compte':
				$this->menu_selectionne='mon_compte';
				$this->selected_menu = 'compte';
				break;
			case 'rechercher':
				$this->menu_selectionne='rechercher';
				$this->selected_menu = 'rechercher';
				break;
			case 'resultats':
				$this->menu_selectionne='resultats';
				break;
			case 'detail':
				$this->menu_selectionne='detail';
				break;
			default:
				$this->menu_selectionne='accueil';
				$this->selected_menu = 'accueil';
		}
	}	
	
    public function generate() {
		$item = $this->menu_selectionne;
		switch($item)
		{
			case 'accueil':
				$this->accueil();
				break;
			case 'favoris':
				$this->favoris();
				break;
			case 'identification':
				$this->identification();
				break;
			case 'creer_compte':
				$this->creer_compte();
				break;
			case 'mon_compte':
				$this->mon_compte();
				break;
			case 'rechercher':
				$this->rechercher();
				break;
			case 'resultats':
				$this->resultats();
				break;
			case 'detail':
				$this->detail();
				break;
			default:
				$this->accueil();
		}
	}
	public function selection_menu() {
		return $this->selected_menu;
	}
	public function selection_item() {
		return $this->menu_selectionne;
	}
	
	public function accueil() {
		include('./include/accueil.php');
	}
	public function favoris() {

		$id_connecte = isset($_SESSION['id_connecte']) ? $_SESSION['id_connecte'] : 15;

		// Ajouter un favoris
		$add = isset($_GET['add']) ? $_GET['add'] : '';
		if(!empty($add)){
			// On teste si le favoris existe déjà
			$stmt = $this->db->prepare("SELECT id FROM favoris WHERE id_membre=:id_membre AND id_membre_favoris=:id_membre_favoris");
			$stmt->bindParam(':id_membre', $id_connecte, PDO::PARAM_INT);
			$stmt->bindParam(':id_membre_favoris', $add, PDO::PARAM_INT);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_OBJ);

			if(!$result){
				$stmt = $this->db->prepare("INSERT INTO favoris (id_membre, id_membre_favoris) VALUES (:id_membre, :id_membre_favoris)");
				$stmt->bindParam(':id_membre', $id_connecte, PDO::PARAM_INT);
				$stmt->bindParam(':id_membre_favoris', $add, PDO::PARAM_INT);
				$stmt->execute();
			}
		}

		// Supprimer un favoris
		$del = isset($_GET['del']) ? $_GET['del'] : '';
		if(!empty($del)){
			$stmt = $this->db->prepare("DELETE FROM favoris WHERE id=:favoris_id");
			$stmt->bindParam(':favoris_id', $del, PDO::PARAM_INT);
			$stmt->execute();
		}

		// Afficher les favoris
		$stmt = $this->db->prepare("SELECT *, favoris.id as favoris_id, `photos`.`nom` AS `nom_photo`
									FROM favoris, membre 
									LEFT JOIN `photos` ON `membre`.`id` = `photos`.`id_membre`
									WHERE favoris.id_membre_favoris = membre.id 
									AND favoris.id_membre = :id_membre");
		$stmt->bindParam(':id_membre', $id_connecte, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		include('./include/favoris.php');
	}
	public function identification() {

		$connect = false;
		$erreur = array();

		if(isset($_SESSION['id_connecte']) && !empty($_SESSION['id_connecte']))
			$connect = true;
		else{
			if(isset($_POST['email'])){

				$email = isset($_POST['email']) ? $_POST['email'] : '';
				$password = isset($_POST['password']) ? $_POST['password'] : '';

				$stmt = $this->db->prepare("SELECT *, `membre`.`id` AS `membre_id`, `photos`.`nom` AS `nom_photo` FROM membre
											LEFT JOIN `photos` ON `membre`.`id` = `photos`.`id_membre`
											WHERE `email`=:email AND `password`=:password");
				$stmt->bindParam(':email', $email, PDO::PARAM_STR);
				$stmt->bindParam(':password', $password, PDO::PARAM_STR);
				$stmt->execute();

				$result = $stmt->fetch(PDO::FETCH_OBJ);
				if(!$result){
					$erreur[] = 'Email ou mot de passe incorrect';	
				}else{
					$connect = true;
					$_SESSION['id_connecte'] = $result->membre_id;
					$_SESSION['connecte_photo'] = $result->nom_photo;
					$_SESSION['connecte_latitude'] = $result->latitude_fixe;
					$_SESSION['connecte_longitude'] = $result->longitude_fixe;
				}
			}
		}
		if($connect == true)
			include('./include/mon_compte.php');
		else
			include('./include/identification.php');
	}
	public function rechercher() {

		if(isset($_GET['new_s'])){
			$_SESSION['competance_transmettre'] = array();
			$_SESSION['competance_apprendre'] = array();
			$_SESSION['distance'] = 0;
		}

		$stmt = $this->db->prepare("SELECT * FROM competance");
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		include('./include/rechercher.php');
	}
	public function creer_compte() {

		$connect = false;

		if(isset($_SESSION['id_connecte']) && !empty($_SESSION['id_connecte']))
			$connect = true;

		if($connect == true)
			include('./include/mon_compte.php');
		else
			include('./include/creer_compte.php');
	}
	public function mon_compte() {
		if(isset($_GET['deco'])){
			unset($_SESSION['id_connecte']);
			unset($_SESSION['connecte_photo']);
			unset($_SESSION['connecte_latitude']);
			unset($_SESSION['connecte_longitude']);
			

			$erreur = array();
			include('./include/identification.php');
		}else{
			include('./include/mon_compte.php');
		}
	}
	public function resultats() {

		$id_connecte = isset($_SESSION['id_connecte']) ? $_SESSION['id_connecte'] : 15;

		// Selection des favoris
		$stmt = $this->db->prepare("SELECT id_membre_favoris FROM favoris where id_membre = :id_connecte");
		$stmt->bindParam(':id_connecte', $id_connecte, PDO::PARAM_INT);
		$stmt->execute();
		$favoris = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
		
		// Lister les membres en fonction de la recherche
		if(isset($_POST['distance'])){
			$competance_transmettre = isset($_POST['competance_transmettre']) ? $_POST['competance_transmettre'] : array();
			$competance_apprendre = isset($_POST['competance_apprendre']) ? $_POST['competance_apprendre'] : array();
			$distance = isset($_POST['distance']) && !empty($_POST['distance'])  ? $_POST['distance'] : 0;

			$_SESSION['competance_transmettre'] = $competance_transmettre;
			$_SESSION['competance_apprendre'] = $competance_apprendre;
			$_SESSION['distance'] = $distance;
		}else{
			$competance_transmettre = isset($_SESSION['competance_transmettre']) ? $_SESSION['competance_transmettre'] : array();
			$competance_apprendre = isset($_SESSION['competance_apprendre']) ? $_SESSION['competance_apprendre'] : array();
			$distance = isset($_SESSION['distance']) ? $_SESSION['distance'] : 0;
		}

		$distance = (empty($distance)) ? 100000 : $distance;

		
		$latitude_fixe  = isset($_SESSION['connecte_latitude']) ? $_SESSION['connecte_latitude'] : 49.461994;
		$longitude_fixe  = isset($_SESSION['connecte_longitude']) ? $_SESSION['connecte_longitude'] : 5.931017;

		$sql_requete = '';
		if(isset($_SESSION['competance_apprendre']) && !empty($_SESSION['competance_apprendre'])){
			foreach($_SESSION['competance_apprendre'] as $cle => $valeur){
				if(empty($sql_requete))
					$sql_requete.= "AND ( competance_transmettre LIKE '%".$valeur."%'";
				else
					$sql_requete.= " OR competance_transmettre LIKE '%".$valeur."%'";
			}
		}
		if(isset($_SESSION['competance_transmettre']) && !empty($_SESSION['competance_transmettre'])){
			foreach($_SESSION['competance_transmettre'] as $cle => $valeur){
				if(empty($sql_requete))
					$sql_requete.= "AND ( competance_apprendre LIKE '%".$valeur."%'";
				else
					$sql_requete.= " OR competance_apprendre LIKE '%".$valeur."%'";
			}
		}
		if(!empty($sql_requete))
		$sql_requete.= ")";

		$stmt = $this->db->prepare("SELECT *, `membre`.`id` AS `membre_id`, `photos`.`nom` AS `nom_photo`, `get_distance_metres`(:latitude, :longitude, latitude_fixe, longitude_fixe) AS `distance`
									from `membre`
									LEFT JOIN `photos` ON `membre`.`id` = `photos`.`id_membre`
									where `membre`.`id` != :id_connecte
									".$sql_requete."
									having `distance` < :distance_metre
									order by `distance` ASC");
		$stmt->bindParam(':latitude', $latitude_fixe, PDO::PARAM_STR);
		$stmt->bindParam(':longitude', $longitude_fixe, PDO::PARAM_STR);						
		$stmt->bindParam(':id_connecte', $id_connecte, PDO::PARAM_INT);
		$stmt->bindParam(':distance_metre', $distance, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		include('./include/resultats.php');
	}
	public function detail() {
		$id = isset($_GET['id']) ? $_GET['id'] : 0;

		$latitude_fixe  = isset($_SESSION['connecte_latitude']) ? $_SESSION['connecte_latitude'] : 49.461994;
		$longitude_fixe  = isset($_SESSION['connecte_longitude']) ? $_SESSION['connecte_longitude'] : 5.931017;

		$id_connecte = isset($_SESSION['id_connecte']) ? $_SESSION['id_connecte'] : 15;
		// Selection des favoris
		$stmt = $this->db->prepare("SELECT id_membre_favoris FROM favoris where id_membre = :id_connecte");
		$stmt->bindParam(':id_connecte', $id_connecte, PDO::PARAM_INT);
		$stmt->execute();
		$favoris = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

		$stmt = $this->db->prepare("SELECT *, `membre`.`id` AS `membre_id`, `photos`.`nom` AS `nom_photo`,`get_distance_metres`(:latitude, :longitude, latitude_fixe, longitude_fixe) AS `distance`
									FROM membre
									LEFT JOIN `photos` ON `membre`.`id` = `photos`.`id_membre`
									WHERE `membre`.`id`=:id");
		$stmt->bindParam(':latitude', $latitude_fixe, PDO::PARAM_STR);
		$stmt->bindParam(':longitude', $longitude_fixe, PDO::PARAM_STR);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_OBJ);

		$stmt = $this->db->prepare("SELECT *
									FROM competance_echangee, competance
									WHERE competance.id = competance_echangee.id_competance
									AND type_echange = 'a_transmettre'
									AND `id_membre`=:id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$transmettre = $stmt->fetch(PDO::FETCH_OBJ);

		$stmt = $this->db->prepare("SELECT *
									FROM competance_echangee, competance
									WHERE competance.id = competance_echangee.id_competance
									AND type_echange = 'a_acquerir'
									AND `id_membre`=:id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		$a_acquerir = $stmt->fetch(PDO::FETCH_OBJ);

		include('./include/detail.php');
	}
}
?>