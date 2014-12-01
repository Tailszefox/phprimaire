{include file="header.tpl"}

{if $statut == ''}
<p class="center">Veuillez vous connecter pour accéder à cette page.</p>
{else}

<table align="center"><tr>

{*<th><a href="photos.php?photo={$photo['PH_id']}"><img src="design/gauche.jpg" title="Photo précédente" /></a></th>*}
<th><a href="photos.php?galerie={$photo['GAL_id']}"><img src="design/haut.jpg" title="Retour à la galerie" /></a></th>
{*<th><a href="photos.php?photo={$photo['PH_id']}"><img src="design/droite.jpg" title="Photo suivante" /></a></th>*}

</tr></table>

<p class="center">
{$photo['PH_legende']}
</p>

<p class="center">
<a href="galeries/{$photo['GAL_id']}/{$photo['PH_photo']}"><img src="galeries/{$photo['GAL_id']}/{$photo['PH_photo']}" height="300" border="1" /></a>
</p>


{/if}

{include file="footer.tpl"}