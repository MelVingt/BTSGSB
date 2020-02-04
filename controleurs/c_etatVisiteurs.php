<?php
include("vues/v_sommaire_comptable.php");
$idComptable = $_SESSION['idComptable'];
$action = $_REQUEST['action'];

if (isset($_POST['infos'])) {
	$str = $_POST['infos'];
	$chaine = explode(" ",$str);
	$_SESSION['nomUt']	= $chaine[0];
	$_SESSION['prenomUt'] = $chaine[1];
}
if (isset($_SESSION['nomUt']) && isset($_SESSION['prenomUt'])) {
	$nom = $_SESSION['nomUt'];
	$prenom = $_SESSION['prenomUt'];	
	$infosVisiteur = $pdo->getVisiteurWithID($nom,$prenom);
}
		
if (isset($_REQUEST['lstMois'])) {
	$chaine = $_REQUEST['lstMois'];
	$_SESSION['mois'] = $chaine;
	$leMois = $_SESSION['mois'];
	$_SESSION['AffAnnee'] =substr( $leMois,0,4);
	$_SESSION['Affmois'] =substr( $leMois,4,2);
}

switch($action)
{
	case 'lesVisiteurs' : 
	{
		
		$lesVisiteurs=$pdo->getVisiteur();
		include("vues/v_liste_visiteur.php");
		
		break;
	}
	case 'ficheFraisComptable' :
	{	
	
		$lesMois=$pdo->getLesMoisDisponibles($infosVisiteur['id']);
		$lesCles = array_keys( $lesMois );
		include("vues/v_listeMoisComptable.php");
		
		break;
	}
	case 'voirFicheDeFraisComptable' :
	{	
		
		$lesMois=$pdo->getLesMoisDisponibles($infosVisiteur['id']);
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($infosVisiteur['id'],$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($infosVisiteur['id'],$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($infosVisiteur['id'],$leMois);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montant = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		$etatFiche = $lesInfosFicheFrais['idEtat'];
		$infoPrix = $pdo->getMontantFraisForfait();
		$infoNb =  $pdo->getNbFraisForfait($infosVisiteur['id'],$leMois);
		$montant = getMontantValide ($infoPrix, $infoNb,$lesFraisHorsForfait );
		include("vues/v_listeMoisComptable.php");
		include("vues/v_listeFraisComptable.php");
	
		break;	
	}
	case 'valideFicheFrais' : 
	{
		
		$infosVisiteur = $pdo->getVisiteurWithID($nom,$prenom);
		$leMois = $_SESSION['mois'];
		$lesMois=$pdo->getLesMoisDisponibles($infosVisiteur['id']);
		$etat = "VA";
		$pdo->majEtatFicheFrais($infosVisiteur['id'],$leMois,$etat);
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($infosVisiteur['id'],$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($infosVisiteur['id'],$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($infosVisiteur['id'],$leMois);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montant = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		$etatFiche = $lesInfosFicheFrais['idEtat'];
		$infoPrix = $pdo->getMontantFraisForfait();
		$infoNb =  $pdo->getNbFraisForfait($infosVisiteur['id'],$leMois);
		$montant = getMontantValide ($infoPrix, $infoNb,$lesFraisHorsForfait );
		$pdo->updateMontant($montant, $leMois, $infosVisiteur['id']);
		include("vues/v_listeMoisComptable.php");
		include("vues/v_listeFraisComptable.php");
		
		break;
	}
	case 'clotureFicheFrais' : 
	{
		
		$infosVisiteur = $pdo->getVisiteurWithID($nom,$prenom);
		$leMois = $_SESSION['mois'];
		$lesMois=$pdo->getLesMoisDisponibles($infosVisiteur['id']);
		$etat = "CL";
		$pdo->majEtatFicheFrais($infosVisiteur['id'],$leMois,$etat);
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($infosVisiteur['id'],$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($infosVisiteur['id'],$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($infosVisiteur['id'],$leMois);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montant = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		$etatFiche = $lesInfosFicheFrais['idEtat'];
		$infoPrix = $pdo->getMontantFraisForfait();
		$infoNb =  $pdo->getNbFraisForfait($infosVisiteur['id'],$leMois);
		$montant = getMontantValide ($infoPrix, $infoNb,$lesFraisHorsForfait );
		include("vues/v_listeMoisComptable.php");
		include("vues/v_listeFraisComptable.php");
		
		break;
	}
	case 'rembourseFicheFrais':
	{
			
		$infosVisiteur = $pdo->getVisiteurWithID($nom,$prenom);
		$leMois = $_SESSION['mois'];
		$lesMois=$pdo->getLesMoisDisponibles($infosVisiteur['id']);
		$etat = "RB";
		$pdo->majEtatFicheFrais($infosVisiteur['id'],$leMois,$etat);
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($infosVisiteur['id'],$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($infosVisiteur['id'],$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($infosVisiteur['id'],$leMois);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montant = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		$etatFiche = $lesInfosFicheFrais['idEtat'];
		$infoPrix = $pdo->getMontantFraisForfait();
		$infoNb =  $pdo->getNbFraisForfait($infosVisiteur['id'],$leMois);
		$montant = getMontantValide ($infoPrix, $infoNb,$lesFraisHorsForfait );
		include("vues/v_listeMoisComptable.php");
		include("vues/v_listeFraisComptable.php");
		
		break;
		
	}
	case 'refuseFicheFrais':
	{
			
		$infosVisiteur = $pdo->getVisiteurWithID($nom,$prenom);
		$leMois = $_SESSION['mois'];
		$lesMois=$pdo->getLesMoisDisponibles($infosVisiteur['id']);
		$etat = "RF";
		$pdo->majEtatFicheFrais($infosVisiteur['id'],$leMois,$etat);
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($infosVisiteur['id'],$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($infosVisiteur['id'],$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($infosVisiteur['id'],$leMois);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$montant = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		$etatFiche = $lesInfosFicheFrais['idEtat'];
		$infoPrix = $pdo->getMontantFraisForfait();
		$infoNb =  $pdo->getNbFraisForfait($infosVisiteur['id'],$leMois);
		$montant = getMontantValide ($infoPrix, $infoNb,$lesFraisHorsForfait );
		include("vues/v_listeMoisComptable.php");
		include("vues/v_listeFraisComptable.php");
		
		break;
		
	}
	case 'supprimerFrais':
	{
		
		$idFrais = $_REQUEST['idFrais'];
		$pdo->supprimerFraisHorsForfait($idFrais);
		$infosVisiteur = $pdo->getVisiteurWithID($nom,$prenom);
		$leMois = $_SESSION['mois'];
		$lesMois=$pdo->getLesMoisDisponibles($infosVisiteur['id']);
		$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($infosVisiteur['id'],$leMois);
		$lesFraisForfait= $pdo->getLesFraisForfait($infosVisiteur['id'],$leMois);
		$lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($infosVisiteur['id'],$leMois);
		$libEtat = $lesInfosFicheFrais['libEtat'];
		$etatFiche = $lesInfosFicheFrais['idEtat'];
		$montant = $lesInfosFicheFrais['montantValide'];
		$nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
		$dateModif =  $lesInfosFicheFrais['dateModif'];
		$dateModif =  dateAnglaisVersFrancais($dateModif);
		include("vues/v_listeMoisComptable.php");
		include("vues/v_listeFraisComptable.php");
		
		break;
	}
}

?>