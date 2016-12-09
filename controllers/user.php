<?php

require_once 'models/user_model.php';

class Controller_User{

	function UserController(){ //constructor
		
	}

	/* Add a new user in the database */
	public function inscription(){

		if(isset($_SESSION['connect'])){
			header('Location: '.BASEURL.'/index.php');
			exit();
		}
		switch($_SERVER['REQUEST_METHOD']) {
			case 'POST':
				if(isset($_POST['login'])
					&& isset($_POST['mdp'])
					&& isset($_POST['mdpCheck'])
					&& isset($_POST['nom'])
					&& isset($_POST['prenom'])
					&& isset($_POST['mail'])
					&& isset($_POST['date_naiss'])
					&& isset($_POST['adresse'])
					&& isset($_POST['code_postal'])
					&& isset($_POST['ville'])
					&& isset($_POST['pays'])) {
						$u = User::getByLogin($_POST['login']);

						if(is_null($u)){
							if($_POST['mdp'] == $_POST['mdpCheck']){
								User::create($_POST['login'], $_POST['mdp'], $_POST['nom'], $_POST['prenom'], $_POST['prenom'], $_POST['prenom'], $_POST['date_naiss'], $_POST['mail'], $_POST['adresse'], $_POST['code_postal'], $_POST['ville'], $_POST['pays']);
								
								//message('Utilisateur', 'User'.$_POST['login'].'cree avec succes');
								header('Location: '.BASEURL.'/index.php/user/connexion');
								exit();
								
							}
							
							else{
								//message('error', 'Les deux mots de passe ne correspondent pas');
								header('Location: '.BASEURL.'/index.php/user/inscription');
								exit();
							}
						}
						
						else{
							$_SESSION['danger'] = 'Login indisponible';
							header('Location: '.BASEURL.'/index.php/user/inscription');
							exit();
						}
				}
				
				else{
					http_response_code(400);
					include('views/400.php');
				}
				
				break;

			case 'GET':
				include 'views/inscription.php';
				break;
		}
	}

	public function connexion(){
		//echo "bonjour je suis le controller user";
		if(isset($_SESSION['connect'])){
			header('Location: '.BASEURL.'index.php');
			exit();
		}

		switch($_SERVER['REQUEST_METHOD']) {
			case 'POST':
				//echo "in the POST";
				if(isset($_POST['login']) && isset($_POST['mdp'])) {
					$u = User::getByLogin($_POST['login']);
					
					if(!is_null($u)) {
						$mdp = $_POST['mdp'];
						echo "MDP inserted $mdp	";
						
						if($u->mdp() == $_POST['mdp']) {
							$_SESSION['login'] = $u->login();
							$_SESSION['user_id'] = $u->id();
							$_SESSION['success'] = 'Utilisateur '.$u->login().' connecte';
							$_SESSION['connect'] = $u;
							//message('success', 'User'.$_POST['login'].' succesfully signed in');
							header('Location: '.BASEURL);
							exit();
						}
						
						else{
							//echo "Mdp incorrect";
							//message('error', 'Erreur connexion');
							$_SESSION['danger'] = 'Mot de passe incorrect';
							
							header('Location: '.BASEURL.'/index.php/user/connexion');
							exit();
						}
					}
					
					else{
						echo "Erreur connexion";
						//message('error', 'Erreur connexion');
						
						header('Location: '.BASEURL.'/index.php/user/connexion');
						exit;
					}
				}
				else{
					http_response_code(400);
					include('views/400.php');
				}
				break;

			case 'GET':
				include 'views/connexion.php';
				break;
		}
	}

	public function deconnexion(){
		if(isset($_SESSION['connect'])) {
			unset($_SESSION['connect']);
			$_SESSION['info'] = 'Vous avez ete deconnecte';
			header('Location: '.BASEURL);
			exit();
		}
	}
}

?>
