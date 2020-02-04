<?php
if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch($action){
	
	case 'demandeConnexion':{
		include("vues/v_connexion.php");
		break;
	}
	
	case 'valideConnexion':{
		$login = $_REQUEST['login'];
		$mdp = $_REQUEST['mdp'];
		if(preg_match('`#`',$login)) { 
			ajouterErreur("Saisie erronée"); 
			include("vues/v_erreurs.php");
			include("vues/v_connexion.php");
		}
		else {
			if(preg_match('`#`',$mdp)) {
				ajouterErreur("Saisie erronée"); 
				include("vues/v_erreurs.php");
				include("vues/v_connexion.php");
			}
			else {
				$visiteur = $pdo->getInfosVisiteur($login,$mdp);
				if(!is_array( $visiteur)){
					$comptable = $pdo->getInfosComptable($login,$mdp);
					if(!is_array( $comptable)){
						ajouterErreur("Login ou mot de passe incorrect");
						include("vues/v_erreurs.php");
						include("vues/v_connexion.php");
					}
					else {
						$id = $comptable['id'];
						$nom =  $comptable['nom'];
						$prenom = $comptable['prenom'];
						connecterComptable($id,$nom,$prenom);
						include("vues/v_sommaire_comptable.php");
					}
				}
				else {
					$id = $visiteur['id'];
					$nom =  $visiteur['nom'];
					$prenom = $visiteur['prenom'];
					connecter($id,$nom,$prenom);
					include("vues/v_sommaire.php");
				}
			}
		}
		break;
	}
	default :{
		include("vues/v_connexion.php");
		break;
	}
}
?>