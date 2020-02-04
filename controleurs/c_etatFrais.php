<?php
include("vues/v_sommaire.php");
$action = $_REQUEST['action'];
$idVisiteur = $_SESSION['idVisiteur'];

if (isset($_REQUEST['lstMois'])) {
	$chaine = $_REQUEST['lstMois'];
	$_SESSION['mois'] = $chaine;
	$leMois = $_SESSION['mois'];
	$_SESSION['AffAnnee'] =substr( $leMois,0,4);
	$_SESSION['Affmois'] =substr( $leMois,4,2);
}

switch($action){
	case 'selectionnerMois':{
		$lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
		// Afin de sélectionner par défaut le dernier mois dans la zone de liste
		// on demande toutes les clés, et on prend la première,
		// les mois étant triés décroissants
		$lesCles = array_keys( $lesMois );
		$moisASelectionner = $lesCles[0];
		include("vues/v_listeMois.php");
		break;
	}
	case 'voirEtatFrais':{
		$infosVisiteur = $pdo->getVisiteurWithID($_SESSION['prenom'],$_SESSION['nom']);
		$leMois = $_REQUEST['lstMois']; 
		$lesMois=$pdo->getLesMoisDisponibles($idVisiteur);
		$moisASelectionner = $leMois;
		include("vues/v_listeMois.php");
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur,$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($idVisiteur,$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur,$leMois);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montantValide = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		
		if ($lesInfosFicheFrais['id'] = "VA" || $lesInfosFicheFrais['id'] = "RB" ){
			$infoPrix = $pdo->getMontantFraisForfait();
			$infoNb =  $pdo->getNbFraisForfait($idVisiteur,$leMois);
			$montantValide = getMontantValide ($infoPrix, $infoNb,$lesFraisHorsForfait );
		}
		
		include("vues/v_etatFrais.php");
	}
}
?>