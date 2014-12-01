{include file="header.tpl"}

<h2 class="center">{$intituleEpreuve}</h2>

<form method="post">
{foreach $notes as $note}
	<div class="nomPrenomConsulter">
	{$note['EL_prenom']} {$note['EL_nom']}
	</div>
	
	<div class="noteConsulter">
	<input type="text" value="{$note['EPN_note']|replace:'.':','}" name="notes[]" class="noteEleve" />
	</div>
	
	<input type="hidden" value="{$note['EL_id']}" name="ids[]" />
{/foreach}

<input type="hidden" value="{$idEpreuve}" />
<p class="center"><input type="submit" value="Enregistrer les notes" class="submit" /></p>

{include file="footer.tpl"}
