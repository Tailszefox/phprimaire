<link rel="stylesheet" type="text/css" href="design/connexion.css" media="screen, projection"/>

<div id="promptStatut">
	<div class="titrePrompt"><p>Je suis</p></div>
	
	<p class="choix choixStatut" id="eleve"><span>Un élève</span></p>
	<p class="choix choixStatut" id="professeur"><span>Un professeur</span></p>
</div>

{* Demande du nom du prof *}
<div id="promptNomProf">
	<div class="titrePrompt"><p>Mon nom est</p></div>
	
	{foreach $listeProfs as $prof}
	<p class="choix choixProf" id="prof_{$prof['PR_id']}"><span>{$prof['PR_prenom']} {$prof['PR_nom']}</span></p>
	{/foreach}
</div>

{* Demande de mot de passe du prof *}
<div id="promptPasswordProf">
	<form id="formPasswordProf">
	<div class="titrePrompt"><p>Veuillez entrer votre mot de passe</p></div>
	
	<p class="center">
	<input type="hidden" id="passwordProfId" />
	<input type="password" id="passwordProf" /></p>
	<p class="center"><input type="submit" value="Se connecter" id="passwordProfSubmit" /></p>
	</p>
	</form>
</div>

{* Demande de la classe *}
<div id="promptClasse">
	<div class="titrePrompt"><p>Je suis en</p></div>
	
	{foreach $listeClasses as $classe}
	<p class="choix choixClasse" id="classe_{$classe['CL_id']}"><span>{$classe['CL_nom']}</span> {if ! isset($listeEleves[$classe['CL_id']])}(aucun élève){/if}</p>
	{/foreach}
</div>

{* Demande du nom élève *}
<div id="promptNomEleve">
	<div class="titrePrompt"><p>Mon nom est</p></div>
	
	{foreach $listeClasses as $classe}
		<div class="listeElevesClasse" id="liste_classe_{$classe['CL_id']}">
		{if isset($listeEleves[$classe['CL_id']])}
			{foreach $listeEleves[$classe['CL_id']] as $eleve}
				<p class="choix choixEleve" id="eleve_{$eleve['EL_id']}"><span>{$eleve['EL_prenom']} {$eleve['EL_nom']}</span></p>
			{/foreach}
		{else}
			<p>Cette classe ne comporte aucun élève.</p>
		{/if}
		</div>
	{/foreach}
</div>
