{include file="header.tpl"}

<h2 class="center">Édition du quizz {$quizz['QZ_nom']}</h2>
<form method="post" id="quizzFormulaire">
	<input type="hidden" value="{$quizz['QZ_id']}" name="idQuizz" id="idQuizz" />
	<p class="center">Nom du quizz<br /><input type="text" name="nomQuizz" id="nomQuizz" value="{$quizz['QZ_nom']}"/></p>
	<p class="center">Temps limite<br />
	<span class="explication">Laissez vide pour ne pas imposer de limite de temps.</span></p>
	<p class="center"><input type="text" name="minuteQuizz" id="minuteQuizz" value="{if $tempsMinute > 0 or $tempsSeconde > 0}{$tempsMinute}{/if}"> minutes et <input type="text" name="secondeQuizz" id="secondeQuizz" value="{if $tempsMinute > 0 or $tempsSeconde > 0}{$tempsSeconde}{/if}" /> secondes</p>
	
	<p class="center"><input type="submit" value="Éditer le quizz" id="editerQuizz" name="editerQuizz" class="submit" /></p>
	</p>
</form>
	
	{if $nbQuestions > 0}
	<h3 class="center">Liste des questions</h3>
	
	{foreach $questions as $question}
			<p class="center" id="question_{$question['QU_id']}">
			<span class="questionQuestion">{$question['QU_question']}</span>
			<span class="hidden questionChoix1">{$question['QU_choix1']}</span>
			<span class="hidden questionChoix2">{$question['QU_choix2']}</span>
			<span class="hidden questionChoix3">{$question['QU_choix3']}</span>
			<span class="hidden questionChoix4">{$question['QU_choix4']}</span>
			<span class="hidden questionImage">{$question['QU_photo']}</span>
			<span class="hidden questionCorrect">{$question['QU_correct']}</span>
			<img src="design/editer.png" alt="Éditer cette question" class="editer editerQuestion"/>
			<img src="design/supprimer.png" alt="Supprimer cette question" class="supprimer supprimerQuestion" />
			</p>
	{/foreach}
	{/if}

<form method="post" id="quizzFormulaireQuestion">
	<h3 class="center">Ajouter un nouvelle question</h3>
	<input type="hidden" name="formulaireIdQuestion" id="formulaireIdQuestion" />
	<p class="center">Question<br /><input type="text" name="question" id="formulaireQuestion" /></p>
	<p class="center">Illustration<br /><span class="explication">Adresse Internet vers une image, laissez vide pour ne pas ajouter d'illustration</span><br />
	<input type="text" name="image" id="formulaireImage" /></p>
	
	<p class="center">
	<span class="explication">Entrez les réponses que l'élève pourra choisir. Laissez les autres choix vide pour ajuster le nombre de réponses possibles</span></p>
	<p class="center">
	Choix 1 : <input type="text" name="choix1" class="choixQuizz" id="formulaireChoix1"> <input type="checkbox" name="formulaireCorrect[]" class="formulaireCorrect" value="1"><br />
	Choix 2 : <input type="text" name="choix2" class="choixQuizz" id="formulaireChoix2"> <input type="checkbox" name="formulaireCorrect[]" class="formulaireCorrect" value="2"><br />
	Choix 3 : <input type="text" name="choix3" class="choixQuizz" id="formulaireChoix3"> <input type="checkbox" name="formulaireCorrect[]" class="formulaireCorrect" value="3"><br />
	Choix 4 : <input type="text" name="choix4" class="choixQuizz" id="formulaireChoix4"> <input type="checkbox" name="formulaireCorrect[]" class="formulaireCorrect" value="4"><br />
	</p>
	
	<p class="center">Cochez la case à droite d'une réponse pour indiquer qu'elle est correcte. Vous pouvez cocher plusieurs réponses.</p>
	
	<p class="center"><input type="submit" value="Ajouter la question" id="ajouterQuestion" name="ajouterQuestion" class="submit" /></p>
</form>

{include file="footer.tpl"}
