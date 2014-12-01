{include file="header.tpl"}

{if $statut == ''}
<p class="center">Veuillez vous connecter pour accéder à cette page.</p>
{else}

<h2 class="center">Liste des devoirs</h2>

{foreach $listeDevoirs as $devoir}
	<p class="center" id="{$devoir['RS_id']}"><a href="rendus_consulter.php?id={$devoir['RS_id']}">{$devoir['RS_titre']}</a>
	{if $statut == 'prof'}
	<img src="design/editer.png" alt="Éditer ce devoir" class="editer"/>
	<img src="design/supprimer.png" alt="Supprimer ce devoir" class="supprimer" />
	{/if}
	</p>
{/foreach}

{if $statut == 'prof'}

<h2 class="center">Ajouter un nouveau devoir</h2>
<form method="post" id="sujetFormulaire">
	<p class="center">
		<input type="hidden" id="idRendu" name="idRendu" />
		Titre :<br />
		<input type="text" name="titreRendu" id="titreRendu" /><br /><br />
		Sujet :<br />
		<textarea name="sujetRendu" id="sujetRendu"></textarea><br /><br />
		<input type="submit" value="Ajouter le sujet" id="sujetAjouter" />
	</p>
</form>

{/if}

{/if}

{include file="footer.tpl"}
