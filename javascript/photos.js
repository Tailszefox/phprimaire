$(document).ready(function(){
		// Création d'une galerie
		$('#galerieFormulaire').submit(function(){
				// Vérification des champs
				if($('#nomGalerie').val().trim() == "")
				{
					alert('Attention : le nom de la galerie n\'a pas été renseigné.');
					return false;
				}
				
				
				return true;
		});
		
		// Raccordement d'une galerie
		$('#formulaireConnecter').submit(function(){		
				
				return true;
		});
		
		//Création d'une photo
		$('#photoFormulaire').submit(function(){
				// Vérification des champs
				if($('#nomPhoto').val().trim() == "")
				{
					alert('Attention : le nom de fichier de la photo n\'a pas été renseigné.');
					return false;
				}
				
				if($('#miniPhoto').val().trim() == "")
				{
					alert('Attention : le nom de fichier de la miniature n\'a pas été renseigné.');
					return false;
				}
				
				return true;
		});
		

		// Suppression d'une photo
		$('.supprimer').click(function(){
				if(confirm("Voulez-vous vraiment supprimer cette photo ?"))
				{
					var id = $(this).parent('th').attr('id');
					window.location = 'photos.php?supprimerph=' + id;
				}
		});
		
		// Déconnexion d'une galerie
		$('.deconnectergal').click(function(){
				if(confirm("Voulez-vous vraiment déconnecter cette galerie de la classe ?"))
				{
					var id = $(this).parent('th').attr('id');
					window.location = 'photos.php?deconnectergal=' + id;
				}
		});
		
		// Suppression d'une galerie
		$('.supprimergal').click(function(){
				if(confirm("Voulez-vous vraiment supprimer cette galerie ?"))
				{
					var id = $(this).parent('th').attr('id');
					window.location = 'photos.php?supprimergal=' + id;
				}
		});
		
		// Édition d'une galerie
		$('.editergal').click(function(){
				var id = $(this).parent('th').attr('id');
				var titre = $(this).parent('th').children('a').text();
				
				// Récupération du texte du sujet
				/*$.get('rendus_consulter.php', {'ajax' : 'true', 'id' : id}, function(retour){
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
				});*/
		});

});
