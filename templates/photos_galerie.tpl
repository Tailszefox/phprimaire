{include file="header.tpl"}

{if $statut == ''}
<p class="center">Veuillez vous connecter pour accéder à cette page.</p>
{else}

{if $afficher == '0'}
<p class="center">Aucune photo dans cette galerie.</p>
{else}

<table align="center" width="80%"><tr>

{foreach $listePhotos as $photo}
	<th id="{$photo['PH_id']}"><a href="photos.php?photo={$photo['PH_id']}">
	<img src="galeries/{$galerie['GAL_id']}/{$photo['PH_mini']}" height="100" title="{$photo['PH_legende']}" /></a>
	{if $statut == 'prof'}
		<br />
		<img src="design/editer.png" alt="Editer cette photo" class="editer"/>
		<img src="design/supprimer.png" alt="Supprimer cette photo" class="supprimer" />
	{/if}
	</th>
{/foreach}
</tr></table>

{/if}

{if $statut == 'prof'}

<h2 class="center">Ajouter une nouvelle photo</h2>
<form method="post" id="photoFormulaire">
	<p class="center">
		<input type="hidden" id="idPhoto" name="idPhoto" />
		<input type="hidden" id="idGalerie" name="idGalerie" value="{$galerie['GAL_id']}"/>
		Nom de fichier de la photo :<br />
		<input type="text" name="nomPhoto" id="nomPhoto" /><br /><br />
		Légende :<br />
		<textarea name="legendePhoto" id="legendePhoto"></textarea><br /><br />
		Nom de fichier de la miniature :<br />
		<input type="text" name="miniPhoto" id="miniPhoto" /><br /><br />
		
		<input type="submit" value="Ajouter la photo" id="photoAjouter" />
	</p>
</form>

{/if}

{/if}

{include file="footer.tpl"}