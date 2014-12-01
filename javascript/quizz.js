var intervalDecompte;

$(document).ready(function(){
		// Décompte du temps restant
		if($('#tempsRestant').size())
		{
			intervalDecompte = setInterval(decompte, 1000);
			$('input:checked').removeAttr("checked");
		}
		
		// Envoi du formulaire d'ajout de quizz
		$('#quizzFormulaire').submit(function(){
				// Vérification du champ de nom
				if($('#nomQuizz').val().trim() == "")
				{
					alert('Attention : le titre du quizz n\'a pas été renseigné.');
					return false;
				}
				
				if($('#minuteQuizz').val().trim() != "" && $('#secondeQuizz').val().trim() == "")
				{
					$('#secondeQuizz').val('0');
				}
				else if($('#secondeQuizz').val().trim() != "" && $('#minuteQuizz').val().trim() == "")
				{
					$('#minuteQuizz').val('0');
				}
				
				return true;
		});
		
		// Suppression d'un quizz
		$('.supprimerQuizz').click(function(){
				if(confirm("Voulez-vous vraiment supprimer ce quizz ?"))
				{
					var id = $(this).parent('p').attr('id');
					window.location = 'quizz.php?supprimer=' + id;
				}
		});
		
		// Édition d'un quizz
		$('.editerQuizz').click(function(){
				var id = $(this).parent('p').attr('id');
				window.location = 'quizz_editer.php?id=' + id;
		});
		
		// Envoi du formulaire d'ajout de question
		$('#quizzFormulaireQuestion').submit(function(){
				// Vérification du champ de nom
				if($('#formulaireQuestion').val().trim() == "")
				{
					alert('Vous ne posez aucune question !');
					return false;
				}
				
				if($('#formulaireChoix1').val().trim() == "" && $('#formulaireChoix2').val().trim() == "")
				{
					alert('Les choix 1 et 2 de la question doivent être renseignés');
					return false;
				}
				
				var correct = $('#formulaireCorrect').val();
				
				if($('#formulaireChoix' + correct).val().trim() == "")
				{
					alert('La réponse ' + correct + ' est signalée comme correcte, mais elle n\'a pas été renseignée !');
					return false;
				}
				
				return true;
		});
		
		// Suppression d'une question
		$('.supprimerQuestion').click(function(){
				if(confirm("Voulez-vous vraiment supprimer cette question ?"))
				{
					var idQuizz = $('#idQuizz').val();
					var idQuestion = $(this).parent('p').attr('id').replace('question_', '');
					window.location = 'quizz_editer.php?id='+ idQuizz + '&supprimer=' + idQuestion;
				}
		});
		
		// Edition d'une question
		$('.editerQuestion').click(function(){
				var id = $(this).parent('p').attr('id').replace('question_', '');
				var question = $(this).parent('p').children('.questionQuestion').text(); 
				var choix1 = $(this).parent('p').children('.questionChoix1').text();
				var choix2 = $(this).parent('p').children('.questionChoix2').text();
				var choix3 = $(this).parent('p').children('.questionChoix3').text();
				var choix4 = $(this).parent('p').children('.questionChoix4').text();
				var image = $(this).parent('p').children('.questionImage').text();
				var correct = $(this).parent('p').children('.questionCorrect').text();
				
				// Informations mises dans le formulaire
				$('#formulaireQuestion').val(question);
				$('#formulaireImage').val(image);
				$('#formulaireChoix1').val(choix1);
				$('#formulaireChoix2').val(choix2);
				$('#formulaireChoix3').val(choix3);
				$('#formulaireChoix4').val(choix4);
				$('#formulaireCorrect').val(correct);
				$('#formulaireIdQuestion').val(id);
				
				// Bouton d'édition
				$('#ajouterQuestion').val('Éditer la question');
				$('#ajouterQuestion').addClass('boutonEditer');
				
				// Bouton d'annulation
				var annuler = document.createElement('input');
				$(annuler).attr('id', 'questionAnnuler');
				$(annuler).addClass('boutonEditer');
				$(annuler).attr('type', 'button');
				$(annuler).val('Annuler l\'édition');
				
				// Si clic sur bouton d'annulation
				$(annuler).click(function(){
						$('#formulaireQuestion').val("");
						$('#formulaireImage').val("");
						$('#formulaireChoix1').val("");
						$('#formulaireChoix2').val("");
						$('#formulaireChoix3').val("");
						$('#formulaireChoix4').val("");
						$('#formulaireCorrect').val("1");
						$('#formulaireIdQuestion').val("");
						
						$('#ajouterQuestion').val('Ajouter la question');
						$('#ajouterQuestion').removeClass('boutonEditer');
						
						$('.editer').show();
						
						$(this).remove();
				});
					
				$('.editer').hide();
				$('#quizzFormulaireQuestion').children('p').last().append(annuler);
				$('#formulaireQuestion').focus();
		});
});

function decompte()
{
	var minutes = parseInt($('#tempsRestantMinute').text(), 10);
	var secondes = parseInt($('#tempsRestantSeconde').text(), 10);
	
	if(secondes == 0 && minutes == 0)
	{
		clearInterval(intervalDecompte);
		$('#quizzRepondreValider').click();
	}
	else
	{		
		if(secondes == 0)
		{
			secondes = 60
			minutes--;
		}
		else if(secondes == 30 && minutes == 0)
		{
			$('#tempsRestantTemps').addClass('rouge');
		}
		
		secondes--;
		
		$('#tempsRestantSeparateur').toggleClass('cache');
		
		$('#tempsRestantMinute').text(minutes);
		
		if(secondes >= 10)
			$('#tempsRestantSeconde').text(secondes)
		else
			$('#tempsRestantSeconde').text('0' + secondes)
	}
}
