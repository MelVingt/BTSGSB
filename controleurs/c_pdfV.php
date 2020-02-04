<?php 
$leMois = $_SESSION['mois'];
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];

	$infosVisiteur = $pdo->getVisiteurWithID($_SESSION['nom'],$_SESSION['prenom']);
	$lesMois=$pdo->getLesMoisDisponibles($infosVisiteur['id']);
	$moisASelectionner = $_SESSION['mois'];
	$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($infosVisiteur['id'],$_SESSION['mois']);
	$lesFraisForfait= $pdo->getLesFraisForfait($infosVisiteur['id'],$_SESSION['mois']);
	$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($infosVisiteur['id'],$_SESSION['mois']);
	$libEtat = $lesInfosFicheFrais['libEtat'];
	$montantValide = $lesInfosFicheFrais['montantValide'];
	$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
	$dateModif =  $lesInfosFicheFrais['dateModif'];
	$dateModif =  dateAnglaisVersFrancais($dateModif);
	$infoPrix = $pdo->getMontantFraisForfait();
	$infoNb =  $pdo->getNbFraisForfait($infosVisiteur['id'],$_SESSION['mois']);
	$montantValide = getMontantValide ($infoPrix, $infoNb,$lesFraisHorsForfait );
	$etatFiche = $lesInfosFicheFrais['idEtat'];
	$annee =substr( $leMois,0,4);
	$mois =substr( $leMois,4,2);
	$leMois = $mois."/".$annee;
	
include("vues/pdf.php");
?> 
