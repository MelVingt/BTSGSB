	<h3>Fiche de frais du mois <?php echo $_SESSION['Affmois']."-".$_SESSION['AffAnnee']?> : 
    </h3>
    <div class="encadre">
    <p>
        Etat : <?php echo $libEtat?> depuis le <?php echo $dateModif?> <br> Montant total de la fiche: <?php echo $montant?> €
              
                     
    </p>
  	<table class="listeLegere">
  	   <caption>Eléments forfaitisés </caption>
        <tr>
         <?php
         foreach ( $lesFraisForfait as $unFraisForfait ) 
		 {
			$libelle = $unFraisForfait['libelle'];
		?>	
			<th> <?php echo $libelle?></th>
		 <?php
        }
		?>
		</tr>
        <tr>
        <?php
          foreach (  $lesFraisForfait as $unFraisForfait  ) 
		  {
				$quantite = $unFraisForfait['quantite'];
		?>
                <td class="qteForfait"><?php echo $quantite?> </td>
		 <?php
          }
		?>
		</tr>
	</table>
	<br>
	<table class="listeLegere">
  	   <caption>Descriptif des éléments hors forfait
       </caption>
             <tr>
                <th class="date">Date</th>
				<th class="libelle">Libellé</th>  
                <th class="montant">Montant</th>  
                <th class="action">&nbsp;</th>              
             </tr>
          
    <?php    
	    foreach( $lesFraisHorsForfait as $unFraisHorsForfait) 
		{
			$libelle = $unFraisHorsForfait['libelle'];
			$date = $unFraisHorsForfait['date'];
			$montant=$unFraisHorsForfait['montant'];
			$id = $unFraisHorsForfait['id'];
	?>		
            <tr>
                <td> <?php echo $date ?></td>
                <td><?php echo $libelle ?></td>
                <td><?php echo $montant ?>€</td>
				<td>
			<?php
				if ($etatFiche == "CL") {
			?>
                <a href="index.php?uc=etatVisiteurs&action=supprimerFrais&idFrais=<?php echo $id ?>" 
				onclick="return confirm('Voulez-vous vraiment supprimer ce frais?');">Supprimer ce frais</a>
			 <?php		 
				}
				else {
			?>	
				Suppression de frais indisponible
			<?php		 
				}
			?>
				</td>
			</tr>
	<?php		 
          
          }
	?>	  
	
	<!-- Les actions disponible si la fiche est cloturée -->
    <?php
		if ($etatFiche == "CL") {
	?>
	</table>
	 <br>
	<table class="listeLegere">
		<tr>
			<th colspan = 4> <center>Action</center> </th>
		</tr>
		<tr>
			<td>
				<form method="POST" action="index.php?uc=etatVisiteurs&action=valideFicheFrais">
					<input type="submit" value="Valider la Fiche" name="valider" onclick="return confirm('Voulez-vous vraiment valider cette fiche?');">
				</form>
			</td>			
			
			<td>
				<form method="POST" action="index.php?uc=etatVisiteurs&action=refuseFicheFrais">
					<input type="submit" value="Refuser la Fiche" name="refuser" onclick="return confirm('Voulez-vous vraiment refuser cette fiche?');">
				</form>
			</td>
		</tr>
	</table>
	<?php
		}
	?>
	
	<!-- Les actions disponible si la fiche est en "saisie en cours" -->
	<?php
		if ($etatFiche == "CR") {
	?>
	</table>
	 <br>
	<table class="listeLegere">
		<tr>
			<th colspan = 4> <center>Action</center> </th>
		</tr>
		<tr>
			<td>
				<form method="POST" action="index.php?uc=etatVisiteurs&action=clotureFicheFrais">
					<input type="submit" value="Saisie cloturée" name="cloture" onclick="return confirm('Voulez-vous vraiment clôturer cette fiche?');">
				</form>
			</td>
		</tr>
	</table>
	<?php
		}
	?>
	
	<!-- Les actions disponible si la fiche est validée -->
	<?php
		if ($etatFiche == "VA") {
	?>
	</table>
	 <br>
	<table class="listeLegere">
		<tr>
			<th colspan = 4> <center>Action</center> </th>
		</tr>
		<tr>
			<td>
				<form method="POST" action="index.php?uc=etatVisiteurs&action=rembourseFicheFrais">
					<input type="submit" value="Rembourser la Fiche" name="rembourse" onclick="return confirm('Voulez-vous vraiment rembourser cette fiche?');">
				</form>
			</td>
		</tr>
	</table>
	<?php
		}
	?>
	<!-- Les actions disponible si la fiche est remboursée ou refusée -->
	<?php
		if ($etatFiche == "RB" || $etatFiche == "RF") {
	?>
	</table>
	 <br>
	<table class="listeLegere">
		<tr>
			<th colspan = 4> <center>Action</center> </th>
		</tr>
		<tr>
			<td>
				En raison de l'état de la fiche aucune action n'est disponible
			</td>
		</tr>
	</table>
	<?php
		}
	?>
	<!-- Le bouton qui ouvre une nouvelle page avec un PDF de la fiche -->
	<table class="listeLegere">
	<caption>PDF
       </caption>
		<tr>
			<th colspan = 4> <center>Action</center> </th>
		</tr>
		<tr>
			<td>
				<form method="POST" action="index.php?uc=pdf&mois='<?php echo $leMois ;?>'&nomV='<?php echo $nom ;?>'&prenomV='<?php echo $prenom ;?>'" target="_blank">
					<input type="submit" value="Afficher le PDF" name="valider" onclick="return confirm('Voulez-vous vraiment afficher le PDF ?');">
				</form>
			</td>
		</tr>
	</table>
  </div>