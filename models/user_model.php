<?php

require_once 'models/model.php';

class User extends Model_Base{

	private $login;
	private $mdp;
	private $nom;
	private $prenom;
	private $date_naiss;
	private $mail;
	private $newsletter;
	private $adresse;
	private $code_postal;
	private $ville;
	private $pays;

	/* Constructor */
	function __construct($id=null, $login, $mdp, $nom, $prenom, $date_naiss, $mail, $newsletter, $adresse, $code_postal, $ville, $pays){
		$this->set_login($login);
		$this->set_mdp($mdp);
		$this->set_nom($nom);
		$this->set_prenom($prenom);
		$this->set_date_naiss($date_naiss);
		$this->set_mail($mail);
		$this->set_newsletter($newsletter);
		$this->set_adresse($adresse);
		$this->set_code_postal($code_postal);
		$this->set_ville($ville);
		$this->set_pays($pays);
	}

	
	/* Add a new user */
	public function create($login, $mdp, $nom, $prenom, $date_naiss, $mail, $newsletter, $adresse, $code_postal, $ville, $pays){

		$u = new User(0, $login, $mdp, $nom, $prenom, $date_naiss, $mail, $newsletter, $adresse, $code_postal, $ville, $pays);

		$q = self::$_db->prepare('INSERT INTO Utilisateur
						(login, mdp, nom, prenom, date_naiss, mail, newsletter, adresse, code_postal, ville, pays)
						VALUES (:l, :m, :n, :p, :d, :e, :ns, :a, :c, :v, :py)');
						
		$q->bindParam(':l', $login);
		$q->bindParam(':m', $mdp);
		$q->bindParam(':n', $nom);
		$q->bindParam(':p', $prenom);
		$q->bindParam(':d', $date_naiss;
		$q->bindParam(':e', $mail);
		$q->bindParam(':ns', $newsletter);
		$q->bindParam(':a', $adresse);
		$q->bindParam(':c', $code_postal);
		$q->bindParam(':v', $ville);
		$q->bindParam(':py', $pays);

		if($q->execute()){
			//echo "	last_id: $last_id	";
			//$u->set_id($last_id);
			$q->CloseCursor();
			return $u;
		}

		else{
			$q->CloseCursor();
			return null;
		}
	}

	
	/* Fonction qui sert a se connecter */
	public static function getByLogin($l){
		if(is_string($l)){
			$q = self::$_db->prepare('SELECT * FROM Utilisateur WHERE login = :l');
			$q->bindValue(':l', $l, PDO::PARAM_STR);
			$q->execute();

			if($data = $q->fetch(PDO::FETCH_ASSOC)){
				$u = new User(
						$data['LOGIN'],
						$data['MDP'],
						$data['NOM'],
						$data['PRENOM'],
						$data['DATE_NAISS'],
						$data['MAIL']);
						$data['NEWSLETTER']);
						$data['ADRESSE']);
						$data['CODE_POSTAL']);
						$data['VILLE']);
						$data['PAYS']);
				$q->CloseCursor();
				return $u;
			}
			else{
				$q->CloseCursor();
				return ;
			}
		}
		else{
			return null;
		}
	}

	public static function getById($id){
		$id = (int) $id;

		$q = self::$_db->prepare('SELECT * FROM Utilisateur WHERE idUtilisateur = :id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->xecute();

		if($data = $q->fetch(PDO::FETCH_ASSOC)){
			$u = new User($data['LOGIN'],
					$data['IDUTILISATEUR'],
					$data['MDP'],
					$data['MAIL'],
					$data['NOM'],
					$data['PRENOM']);

			oci_free_statement($q);
			return $u;
		}
		else{
			oci_free_statement($q);
			return null;
		}
	}
	
	
	/* SETTERS */
	public function set_login($login){
		if(is_string($login))
			$this->login = $login;

		else
			$this->login = '';
	}
	
	public function set_id($id){
		$id = (int)$id;
		$this->id = $id;
	}

	public function set_mdp($mdp){
		///if(is_string($mdp))
			//echo "		this is the mdp in the setter:	$mdp	";
			$this->mdp = $mdp;
			//echo "this the mdp after the setter:	$mdp	";

		//else
			//$this->mdp = '';
	}
	
	public function set_nom($nom){
		if(is_string($nom))
			$this->nom = $nom;

		else
			$this->nom = '';
	}
	
	public function set_prenom($prenom){
		if(is_string($prenom))
			$this->prenom = $prenom;

		else
			$this->prenom = '';
	}
	
	public function set_date_naiss($date_naiss){
		if(is_string($date_naiss))
			$this->date_naiss = $date_naiss;

		else
			$this->date_naiss = '';
	}
	
	public function set_mail($mail){
		if(is_string($mail))
			$this->mail = $mail;

		else
			$this->mail = '';
	}
	
	
	public function set_newsletter($newsletter){
		if(is_string($newsletter))
			$this->newsletter = $newsletter;

		else
			$this->newsletter = '';
	}
	
	public function set_adresse($adresse){
		if(is_string($adresse))
			$this->adresse = $adresse;

		else
			$this->adresse = '';
	}
	
	public function set_code_postal($code_postal){
		if(is_string($code_postal))
			$this->code_postal = $code_postal;

		else
			$this->code_postal = '';
	}
	
	public function set_ville($ville){
		if(is_string($ville))
			$this->ville = $ville;

		else
			$this->ville = '';
	}

	public function set_pays($pays){
		if(is_string($pays))
			$this->pays = $pays;

		else
			$this->pays = '';
	}
	
	
	/* GETTERS */
	public function login(){
		return $this->login;
	}

	public function mdp(){
		return $this->mdp;
	}

	public function nom(){
	return $this->nom;
	}

	public function prenom(){
		return $this->prenom;
	}

	public function date_naiss(){
		return $this->date_naiss;
	}

	public function mail(){
		return $this->mail;
	}
	
	public function newsletter(){
		return $this->newsletter;
	}
	
	public function adresse(){
		return $this->adresse;
	}
	
	public function code_postal(){
		return $this->code_postal;
	}
	
	public function ville(){
		return $this->ville;
	}
	
	public function pays(){
		return $this->pays;
	}
	
	public function id(){
		return $this->id;
	}
}

?>