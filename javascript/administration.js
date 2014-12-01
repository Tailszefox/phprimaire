$(document).ready(function(){
		$('#formulaireProf').submit(function(){
				if($('#formulaireProfPrenom').val().trim() == "" || $('#formulaireProfNom').val().trim() == "")
				{
					alert('Merci de renseigner le prénom et le nom du professeur');
					return false;
				}
				
				if($('#formulaireProfId').val().trim() == "" && $('#formulaireProfPassword').val().trim() == "")
				{
					alert('Merci de renseigner le mot de passe du professeur. Par mesure de sécurité, ce mot de passe ne peut être vide.');
					return false;
				}
				
				return true;
		});
		
		$('.supprimerProf').click(function(){
				if(confirm("Voulez-vous vraiment supprimer ce professeur ? La classe qui lui est attribué sera également supprimée !"))
				{
					var id = $(this).parent('p').attr('id').replace('prof_', '');
					window.location = 'administration.php?supprimerProf=' + id;
				}
		});
		
		$('.editerProf').click(function(){
				var id = $(this).parent('p').attr('id').replace('prof_', '');
				var prenom = $(this).parent('p').children('.profPrenom').text(); 
				var nom = $(this).parent('p').children('.profNom').text();
				var civilite = $(this).parent('p').children('.profCivilite').text();
				var admin = $(this).parent('p').children('.profAdmin').text();
				
				// Informations mises dans le formulaire
				$('#formulaireProfPrenom').val(prenom);
				$('#formulaireProfNom').val(nom);
				$('#formulaireProfCivilite').val(civilite);
				$('#formulaireProfId').val(id);
				
				if(admin == "1")
					$('#formulaireProfAdmin').attr('checked', true);
				else
					$('#formulaireProfAdmin').attr('checked', false);
				
				// Bouton d'édition
				$('#formulaireProfAjouter').val('Éditer le professeur');
				$('#formulaireProfAjouter').addClass('boutonEditer');
				
				// Bouton d'annulation
				var annuler = document.createElement('input');
				$(annuler).attr('id', 'profAnnuler');
				$(annuler).addClass('boutonEditer');
				$(annuler).attr('type', 'button');
				$(annuler).val('Annuler l\'édition');
				
				// Si clic sur bouton d'annulation
				$(annuler).click(function(){
						$('#formulaireProfPrenom').val("");
						$('#formulaireProfNom').val("");
						$('#formulaireProfPassword').val("");
						$('#formulaireProfId').val("");
						$('#formulaireProfAdmin').attr('checked', false);
						
						$('#formulaireProfAjouter').val('Ajouter le professeur');
						$('#formulaireProfAjouter').removeClass('boutonEditer');
						
						$('.editer').show();
						$('#explicationPassword').hide();
						
						$(this).remove();
				});
					
				$('.editer').hide();
				$('#explicationPassword').show();
				$('#formulaireProf').children('p').last().append(annuler);
		});
		
		$('#formulaireClasse').submit(function(){
				if($('#formulaireClasseNom').val().trim() == "" || $('#formulaireClasseAnneeDebut').val().trim() == "" || $('#formulaireClasseAnneeFin').val().trim() == "")
				{
					alert('Merci de remplir tous les champs du formulaire.');
					return false;
				}
				
				return true;
		});
		
		$('.supprimerClasse').click(function(){
				if(confirm("Voulez-vous vraiment supprimer cette classe ? Tous les élèves rattachés seront aussi supprimés !"))
				{
					var id = $(this).parent('p').attr('id').replace('classe_', '');
					window.location = 'administration.php?supprimerClasse=' + id;
				}
		});
		
		$('.editerClasse').click(function(){
				var id = $(this).parent('p').attr('id').replace('classe_', '');
				var nom = $(this).parent('p').children('.classeNom').text(); 
				var annee = $(this).parent('p').children('.classeAnnee').text();
				var prof = $(this).parent('p').children('.classeProf').attr('id').replace('classeProf_', '');
				var affichage = $(this).parent('p').children('.classeAffichage').text();
				
				// Informations mises dans le formulaire
				$('#formulaireClasseNom').val(nom);
				$('#formulaireClasseProf').val(prof);
				$('#formulaireClasseId').val(id);
				
				var anneeArray = annee.split('-');
				$('#formulaireClasseAnneeDebut').val(anneeArray[0]);
				$('#formulaireClasseAnneeFin').val(anneeArray[1]);
				
				if(affichage == "1")
					$('#formulaireClasseAffichage').attr('checked', true);
				else
					$('#formulaireClasseAffichage').attr('checked', false);
				
				// Bouton d'édition
				$('#formulaireClasseAjouter').val('Éditer la classe');
				$('#formulaireClasseAjouter').addClass('boutonEditer');
				
				// Bouton d'annulation
				var annuler = document.createElement('input');
				$(annuler).attr('id', 'classeAnnuler');
				$(annuler).addClass('boutonEditer');
				$(annuler).attr('type', 'button');
				$(annuler).val('Annuler l\'édition');
				
				// Si clic sur bouton d'annulation
				$(annuler).click(function(){
						$('#formulaireClasseNom').val("");
						$('#formulaireClasseAffichage').attr('checked', false);
						
						$('#formulaireClasseAnneeDebut').val("");
						$('#formulaireClasseAnneeFin').val("");
						
						$('#formulaireClasseAjouter').val('Ajouter la classe');
						$('#formulaireClasseAjouter').removeClass('boutonEditer');
						
						$('#formulaireClasseId').val("");
						
						$('.editer').show();
						
						$(this).remove();
				});
					
				$('.editer').hide();
				$('#formulaireClasse').children('p').last().append(annuler);
		});
});