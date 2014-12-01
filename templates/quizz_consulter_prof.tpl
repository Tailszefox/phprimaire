{include file="header.tpl"}

<h2 class="center">Notes des élèves pour {$quizz['QZ_nom']}</h2>

{foreach $notes as $note}
	<p class="center">{$note['EL_prenom']} {$note['EL_nom']} : {$note['NT_note']}/20</p>
{/foreach}

{include file="footer.tpl"}
