    <!-- Division pour le sommaire comptable -->
    <div id="menuGauche">
     <div id="infosUtil">
    
        <h2>
    
</h2>
    
      </div>  
        <ul id="menuList">
			<li >
				  Comptable :<br>
				<?php echo $_SESSION['prenomComptable']."  ".$_SESSION['nomComptable']  ?>
			</li>
			<li class="smenu">
              <a href="index.php?uc=etatVisiteurs&action=lesVisiteurs" title="Saisie fiche de frais ">Les visiteurs</a>
			<li class="smenu">
              <a href="index.php?uc=connexion&action=deconnexion" title="Se déconnecter">Déconnexion</a>
           </li>
        </ul>
        
    </div>