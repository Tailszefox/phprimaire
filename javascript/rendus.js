$(document).ready(function(){
		// Envoi du formulaire
		$('#sujetFormulaire').submit(function(){
				// Vérification des champs
				if($('#titreRendu').val().trim() == "")
				{
					alert('Attention : le titre du devoir n\'a pas été renseigné.');
					return false;
				}
				
				if($('#sujetRendu').val().trim() == "")
				{
					alert('Attention : le sujet du devoir n\'a pas été renseigné.');
					return false;
				}
				
				return true;
		});
		
		// Suppression d'un sujet
		$('.supprimer').click(function(){
				if(confirm("Voulez-vous vraiment supprimer ce sujet ?"))
				{
					var id = $(this).parent('p').attr('id');
					window.location = 'rendus.php?supprimer=' + id;
				}
		});
		
		// Édition d'un sujet
		$('.editer').click(function(){
				var id = $(this).parent('p').attr('id');
				var titre = $(this).parent('p').children('a').text();
				
				// Récupération du texte du sujet
				$.get('rendus_consulter.php', {'ajax' : 'true', 'id' : id}, function(retour){
						var sujet = retour;
						
						$('#titreRendu').val(titre);
						$('#sujetRendu').val(sujet);
						$('#idRendu').val(id);
						
						$('#sujetAjouter').val('Éditer le sujet');
						$('#sujetAjouter').addClass('boutonEditer');
						
						var annuler = document.createElement('input');
						$(annuler).attr('id', 'sujetAnnuler');
						$(annuler).addClass('boutonEditer');
						$(annuler).attr('type', 'button');
						$(annuler).val('Annuler l\'édition');
						
						$(annuler).click(function(){
								$('#titreRendu').val("");
								$('#sujetRendu').val("");
								$('#idRendu').val("");
								
								$('#sujetAjouter').val('Ajouter le sujet');
								$('#sujetAjouter').removeClass('boutonEditer');
								
								$('.editer').show();
								
								$(this).remove();
						});
						
						$('.editer').hide();
						$('#sujetFormulaire').children('p').append(annuler);
				});
		});
});
