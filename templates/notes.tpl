{include file="header.tpl"}

<h2 class="center">Liste des épreuves</h2>

{foreach $listeEpreuves as $epreuve}
	<p class="center" id="{$epreuve['EP_id']}"><a href="notes_consulter.php?id={$epreuve['EP_id']}"><span class="intituleListe">{$epreuve['EP_titre']}</span> - Coefficient <span class="coefficientListe">{$epreuve['EP_coeff']|replace:'.':','}</span></a>
	{if $statut == 'prof'}
	<img src="design/editer.png" alt="Éditer cette épreuve" class="editer"/>
	<img src="design/supprimer.png" alt="Supprimer cette épreuve" class="supprimer" />
	{/if}
	</p>
{/foreach}

<h2 class="center">Ajouter une nouvelle épreuve</h2>
<form method="post" id="epreuveFormulaire">
		<input type="hidden" id="idEpreuve" name="idEpreuve" />
		<div class="divIntitule">Intitulé</div> <div class="divCoefficient">Coefficient</div>
		
		<div class="divIntitule"><input type="text" name="titreEpreuve" id="titreEpreuve" /></div>
		<div class="divCoefficient"><input type="text" name="coefficientEpreuve" id="coefficientEpreuve" /></div>
		<p class="center">
		<input type="submit" value="Ajouter l'épreuve" id="epreuveAjouter" class="submit" />
		</p>
</form>

<p id="paragrapheGenerer"><span id="lienGenerer">Générer les bulletins</span></p>
{include file="footer.tpl"}
