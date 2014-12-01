{include file="header.tpl"}

<!-- Professeurs -->
<h2 class="center">Gestion des professeurs</h2>

{foreach $listeProfs as $prof}
	<p class="center" id="prof_{$prof['PR_id']}">
	<span class="profCivilite">{$prof['PR_civilite']}</span> <span class="profPrenom">{$prof['PR_prenom']}</span> <span class="profNom">{$prof['PR_nom']}</span>
	<span class="profAdmin hidden">{$prof['PR_admin']}</span>
	<img src="design/editer.png" alt="Éditer ce professeur" class="editer editerProf"/>
	{if $prof['PR_id'] != $id}<img src="design/supprimer.png" alt="Supprimer ce professeur" class="supprimer supprimerProf" />{/if}
	</p>
{/foreach}

<p class="center explication">Utilisez ce formulaire pour ajouter un nouveau professeur, ou cliquez sur l'icône du crayon pour en modifier un.</p>
<form method="post" id="formulaireProf">
	<p class="center">Prénom et nom du professeur :<br />
	<select id="formulaireProfCivilite" name="formulaireProfCivilite">
		<option value="Mme">Mme</option>
		<option value="Mlle">Mlle</option>
		<option value="M.">M.</option>
	</select>
	<input type="text" id="formulaireProfPrenom" name="formulaireProfPrenom" />
	<input type="text" id="formulaireProfNom" name="formulaireProfNom" />
	</p>
	<p class="center">Mot de passe :<br />
	<span id="explicationPassword" class="explication hidden">Laissez blanc pour ne pas modifier le mot de passe actuel<br /></span>
	<input type="password" id="formulaireProfPassword" name="formulaireProfPassword" />
	</p>
	<p class="center">Administrateur : <input type="checkbox" id="formulaireProfAdmin" name="formulaireProfAdmin"><br />
	<span class="explication">Cochez cette case pour indiquer que ce professeur est un administrateur. Un administrateur pour agir sur toutes les classes et peut accéder à cette page.</span>
	</p>
	<input type="hidden" id="formulaireProfId" name="formulaireProfId" />
	<p class="center"><input type="submit" class="submit" value="Ajouter ce professeur" name="formulaireProfAjouter" id="formulaireProfAjouter" /></p>
</form>

<!-- Classes -->
<h2 class="center">Gestion des classes</h2>

{foreach $listeClasses as $classe}
	<p class="center" id="classe_{$classe['CL_id']}">
	Classe de <span class="classeNom">{$classe['CL_nom']}</span> de l'année <span class="classeAnnee">{$classe['annee']}</span>
	<img src="design/editer.png" alt="Éditer cette classe" class="editer editerClasse"/>
	<img src="design/supprimer.png" alt="Supprimer cette classe" class="supprimer supprimerClasse" />
	<br />
	Enseignant : <span class="classeProf" id="classeProf_{$classe['PR_id']}"> {$profsNom[$classe['PR_id']]}</span>
	<span class="classeAffichage hidden">{$classe['CL_affichage']}</span>
	</p>
{/foreach}

<p class="center explication">Utilisez ce formulaire pour ajouter une nouvelle classe, ou cliquez sur l'icône du crayon pour en modifier une.</p>
<form method="post" id="formulaireClasse">
	<p class="center">Nom de la classe :<br />
	<input type="text" id="formulaireClasseNom" name="formulaireClasseNom" />
	</p>
	<p class="center">Année :<br />
	<span class="explication">Par exemple : 2010 - 2011</span><br />
	<input type="text" id="formulaireClasseAnneeDebut" name="formulaireClasseAnneeDebut" /> - <input type="text" id="formulaireClasseAnneeFin" name="formulaireClasseAnneeFin" />
	<p class="center">Professeur :<br />
	<span class="explication">Utilisez le formulaire ci-dessus pour ajouter ou modifier les professeurs apparaissant dans cette liste</span><br />
	<select id="formulaireClasseProf" name="formulaireClasseProf">
		{foreach from=$profsNom key=id item=prof}
		<option value="{$id}">{$prof}</option>
		{/foreach}
	</select>
	</p>
	<p class="center">Afficher les liens sous forme de vignette : <input type="checkbox" id="formulaireClasseAffichage" name="formulaireClasseAffichage"><br />
	</p>
	<input type="hidden" id="formulaireClasseId" name="formulaireClasseId" />
	<p class="center"><input type="submit" class="submit" value="Ajouter cette classe" name="formulaireClasseAjouter" id="formulaireClasseAjouter" /></p>
</form>

<!-- Nom de l'école -->
<h2 class="center">Nom de l'école</h2>
<form method="post" id="formulaireNomEcole">
<p class="center explication">Vous pouvez ici modifier le nom de l'école apparaissant en haut de chaque page</p>
<p class="center">
<input type="text" name="nomEcoleChamp" id="nomEcoleChamp" value="{$nomEcole}"/><br />
<input type="submit" value="Modifier le nom de l'école">
</p>
</form>

{include file="footer.tpl"}
