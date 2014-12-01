{include file="header.tpl"}

{if $statut == ''}
<p class="center">Veuillez vous connecter pour accéder à cette page.</p>
{else}

<table align="center" width="80%"><tr>

{foreach $listeGaleries as $galerie}
	<th id="{$galerie['GAL_id']}"><a href="photos.php?galerie={$galerie['GAL_id']}">
	{if $contient[$galerie['GAL_id']] == 1}
	<img src="galeries/{$galerie['GAL_id']}/m/1.jpg" title="{$galerie['GAL_legende']}" />
	{else}
	<img src="design/vide.png" height="100" title="Galerie vide" />
	{/if}
	<br />
	{$galerie['GAL_nom']}</a>
	{if $statut == 'prof'} 
		<img src="design/editer.png" alt="Editer cette galerie" class="editergal"/>
		<img src="design/deco.png" alt="Déconnecter cette galerie de la classe" class="deconnectergal" />
		<img src="design/supprimer.png" alt="Supprimer cette galerie" class="supprimergal" />
	{/if}
	</th>
{/foreach}
</tr></table>

{if $statut == 'prof'}

<h2 class="center">Ajouter une nouvelle galerie</h2>
<form method="post" id="galerieFormulaire">
	<p class="center">
		<input type="hidden" id="idGalerie" name="idGalerie" />
		Nom de la galerie :<br />
		<input type="text" name="nomGalerie" id="nomGalerie" /><br /><br />
		Légende :<br />
		<textarea name="legendeGalerie" id="legendeGalerie"></textarea><br /><br />
		
		<input type="submit" value="Ajouter la galerie" id="galerieAjouter" />
	</p>
</form>

<h2 class="center">Connecter une galerie à la classe</h2>
<form method="post" id="formulaireConnecter">
	<p class="center">
		Nom de la galerie :<br />
		<select id="formulaireConnecterGalerie" name="formulaireConnecterGalerie">
			{foreach from=$galeriesAConnecter key=id item=galerieAConnecter}
			<option value="{$id}">{$galerieAConnecter}</option>
			{/foreach}
		</select>
	</p>
	<p class="center"><input type="submit" class="submit" value="Connecter cette galerie" name="formulaireConnecterAjouter" id="formulaireConnecterAjouter" /></p>
</form>

{/if}

{/if}

{include file="footer.tpl"}
