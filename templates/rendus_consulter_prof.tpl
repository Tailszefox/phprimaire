{include file="header.tpl"}

<h2 class="center">{$titreDevoir}</h2>

<p class="center">{$sujetDevoir|nl2br}</h2>

{* Affichage du rendu de chaque élève *}
{foreach $rendus as $rendu}
	<p class="center"><strong>{$rendu['EL_prenom']} {$rendu['EL_nom']}</strong></p>
	<div class="renduDeEleve">
		{$rendu['RE_rendu']|nl2br}
	</div>
{/foreach}

{include file="footer.tpl"}
