{include file="header.tpl"}

{if $statut == ''}
<p class="center">Veuillez vous connecter pour accéder à cette page.</p>
{else}

<h2 class="center">Liste des quizz</h2>

{foreach $listeQuizz as $quizz}
	<p class="center" id="{$quizz['QZ_id']}"><a href="quizz_consulter.php?id={$quizz['QZ_id']}">{$quizz['QZ_nom']}</a>
	{if $statut == 'prof'}
	<img src="design/editer.png" alt="Éditer ce quizz" class="editer editerQuizz"/>
	<img src="design/supprimer.png" alt="Supprimer ce quizz" class="supprimer supprimerQuizz" />
	{/if}
	</p>
{/foreach}

{if $statut == 'prof'}

<h2 class="center">Ajouter un nouveau quizz</h2>
<form method="post" id="quizzFormulaire">
	<p class="center">Nom du quizz<br /><input type="text" name="nomQuizz" id="nomQuizz" />
	<p class="center">Temps limite<br />
	<span class="explication">Laissez vide pour ne pas imposer de limite de temps.</span></p>
	<p class="center"><input type="text" name="minuteQuizz" id="minuteQuizz"> minutes et <input type="text" name="secondeQuizz" id="secondeQuizz" /> secondes</p>
	</p>
	<p class="center explication">Vous serez amené à la page d'édition des questions une fois le quizz ajouté.</p>
	<p class="center"><input type="submit" value="Ajouter le quizz" id="ajouterQuizz" /></p>
	</p>
</form>

{/if}

{/if}

{include file="footer.tpl"}
