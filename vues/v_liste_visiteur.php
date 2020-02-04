<?php
	 $idComptable = $_SESSION['idComptable'];
?>
<legend>Les visiteurs</legend>
<div id="contenu">
	
	<form method="post" action="index.php?uc=etatVisiteurs&action=ficheFraisComptable">
		<select id = "infos" name = "infos">
		
			<?php 
				$i=0;
				foreach ($lesVisiteurs as $key => $value){
					echo '<option>'.$value['nom'].' '.$value['prenom'].'</option>';	
				}
			?>	
			

			
		</select>
		<button type="hidden" type="submit" class="btn btn-primary btn-block btn-large">Valider </button>
	<form>
	
</div>
	
