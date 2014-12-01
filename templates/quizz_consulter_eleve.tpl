{include file="header.tpl"}

<h2 class="center">{$quizz['QZ_nom']}</h2>

{if $note >= 0}

	<p class="center">Vous avez obtenu la note de {$note}/20 pour ce quizz.</p>

{else if $tempsMinute > 0 || $tempsSeconde > 0}
	
	<p class="center">Attention, ce quizz est en temps limité !</p>

	<p id="tempsRestant">Temps restant :
	<span id="tempsRestantTemps">
	<span id="tempsRestantMinute">{$tempsMinute}</span><span id="tempsRestantSeparateur">:</span><span id="tempsRestantSeconde">{if $tempsSeconde < 10}0{/if}{$tempsSeconde}</span>
	</span>
	</p>
{/if}

<form method="post" id="quizzRepondre">
{foreach $questions as $question}
	<div class="uneQuestion clear">
		<input type="hidden" value="{$question['QU_id']}" name="ids[]" class="quizzRepondreId">
		
		{if $question['QU_photo'] ne ''}
			<div class="quizzRepondreImage"><img class="quizzRepondreImageImage" src="{$question['QU_photo']}" /></div>
			<div class="uneQuestionMoitie">
		{else}
			<div class="uneQuestionEntiere">
		{/if}
		
		<p class="center">{$question['QU_question']}</p>
		
		<p class="center quizzRepondreCase"><input type="radio" id="reponse_{$question['QU_id']}_1" name="reponse_{$question['QU_id']}" value="1"/></p>
		<p class="center quizzRepondreReponse"><label for="reponse_{$question['QU_id']}_1">{$question['QU_choix1']}</label></p>
		<p class="clear" />
		<p class="center quizzRepondreCase"><input type="radio" id="reponse_{$question['QU_id']}_2" name="reponse_{$question['QU_id']}" value="2"/></p>
		<p class="center quizzRepondreReponse"><label for="reponse_{$question['QU_id']}_2">{$question['QU_choix2']}</label></p>
		<p class="clear" />
		{if $question['QU_choix3'] ne ''}
		<p class="center quizzRepondreCase"><input type="radio" id="reponse_{$question['QU_id']}_3" name="reponse_{$question['QU_id']}" value="3"/></p>
		<p class="center quizzRepondreReponse"><label for="reponse_{$question['QU_id']}_3">{$question['QU_choix3']}</label></p>
		<p class="clear" />
		{/if}
		{if $question['QU_choix4'] ne ''}
		<p class="center quizzRepondreCase"><input type="radio" id="reponse_{$question['QU_id']}_4" name="reponse_{$question['QU_id']}" value="4"/></p>
		<p class="center quizzRepondreReponse"><label for="reponse_{$question['QU_id']}_4">{$question['QU_choix4']}</label></p>
		<p class="clear" />
		{/if}
		</div>
		<p class="clear" />
	</div>
{/foreach}

{if $note < 0}

<p class="center">Relisez-vous bien, vous ne pourrez pas revenir pour modifier vos réponses !</p>
<p class="center"><input type="submit" id="quizzRepondreValider" name="quizzRepondreValider" value="Envoyer les réponses"/></p>

{/if}

</form>

{include file="footer.tpl"}
