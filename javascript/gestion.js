$(document).ready(function(){
		
		// L'attribut "modifie" passe à 1 en cas de changement
		$('.champ').live('change', function(){
				$(this).parent().children('.modifie').val('1');
		});
		
		// Suppression d'un élève
		$('.supprimerEleve').live('click', function(){
				if(confirm('Voulez-vous vraiment supprimer cet élève ?'))
				{
					$(this).parent().children('.gestionPrenom').val('');
					$(this).parent().children('.gestionNom').val('');
					$(this).parent().children('.modifie').val('1');
					$(this).parent().hide();
				}
		});
		
		// Ajout d'un nouvel élève
		$('.new').live('change', function(){
				
				if($(this).parent().children('.gestionPrenom').val() != ''
					&& $(this).parent().children('.gestionNom').val() != '')
				{
					// Ajout d'un nouveau champ
					var copie = $(this).parent().clone();
					
					var supprimer = document.createElement('img');
					$(supprimer).attr('src', 'design/supprimer.png');
					$(supprimer).addClass('supprimerEleve');
					$(this).parent().append(supprimer);
					
					$(this).parent().children('.champ').removeClass('new');
					
					$(copie).children('.champ').val('');
					$(copie).children('.modifie').val('0');
					
					$(this).parent().parent().append(copie);
					$(copie).children('.champ').eq(0).focus();
				}
		});
		
		// Envoi du formulaire
		$('form').submit(function(){
				// Vérification des informations de chaque élève
				$('.eleve').each(function(){
						if(($(this).children('.gestionPrenom').val() == '' && $(this).children('.gestionNom').val() != '') ||
							($(this).children('.gestionPrenom').val() != '' && $(this).children('.gestionNom').val() == ''))
						{
							alert('Vous n\'avez pas renseigné le nom ou le prénom d\'un élève');
							$(this).children('.gestionPrenom').focus();
							return false;
						}
				});
				
				return true;
		});
});
