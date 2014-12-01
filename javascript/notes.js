$(document).ready(function(){
		// Validation du formulaire d'ajout d'épreuve
		$('#epreuveFormulaire').submit(function(){
				// Vérification des champs
				if($('#titreEpreuve').val().trim() == "")
				{
					alert('Attention : l\'intitulé de l\'épreuve n\'a pas été renseigné.');
					return false;
				}
				
				if($('#coefficientEpreuve').val().trim() == "")
				{
					alert('Attention : le coefficient de l\'épreuve n\'a pas été renseigné.');
					return false;
				}
				
				if(isNaN($('#coefficientEpreuve').val().replace(',', '.')))
				{
					alert('Attention : le coefficient de l\'épreuve doit être un nombre.');
					return false;
				}
				
				return true;
		});
		
		// Clic sur bouton de suppression
		$('.supprimer').click(function(){
				if(confirm("Voulez-vous vraiment supprimer cette épreuve ?"))
				{
					var id = $(this).parent('p').attr('id');
					window.location = 'notes.php?supprimer=' + id;
				}
		});
		
		// Clic sur bouton d'édition
		$('.editer').click(function(){
				var id = $(this).parent('p').attr('id');
				var intitule = $(this).parent('p').children('a').children('.intituleListe').text();
				var coefficient = $(this).parent('p').children('a').children('.coefficientListe').text();
				
				// Informations mises dans le formulaire
				$('#titreEpreuve').val(intitule);
				$('#coefficientEpreuve').val(coefficient);
				$('#idEpreuve').val(id);
				
				// Bouton d'édition
				$('#epreuveAjouter').val('Éditer l\'épreuve');
				$('#epreuveAjouter').addClass('boutonEditer');
				
				// Bouton d'annulation
				var annuler = document.createElement('input');
				$(annuler).attr('id', 'epreuveAnnuler');
				$(annuler).addClass('boutonEditer');
				$(annuler).attr('type', 'button');
				$(annuler).val('Annuler l\'édition');
				
				// Si clic sur bouton d'annulation
				$(annuler).click(function(){
						$('#titreEpreuve').val("");
						$('#coefficientEpreuve').val("");
						$('#idEpreuve').val("");
						
						$('#epreuveAjouter').val('Ajouter le sujet');
						$('#epreuveAjouter').removeClass('boutonEditer');
						
						$('.editer').show();
						
						$(this).remove();
				});
					
				$('.editer').hide();
				$('#epreuveFormulaire').children('p').append(annuler);
		});
		
		// Clic sur bouton de génération des bulletins
		$('#paragrapheGenerer').click(function(){
				window.open('notes_generer.php');
		});
});
