$(document).ready(function(){
		// Clic sur le bouton d'affichage du menu
		$('#menuTopMontrer').click(function(){
				// Menu affiché, le cacher
				if($('#menuTopElements:visible').length)
				{
					$('#menuTopMontrer').html('&lt;=');
					$('#menuTopElements').hide('slow');
				}
				// Menu caché, l'afficher
				else
				{
					$('#menuTopMontrer').html('=&gt;');
					$('#menuTopElements').show('slow');
				}
		});
		
		// Clic sur le bouton de connexion
		$('#boutonConnexion').click(function() {
				// Création des éléments du dialog de connexion
				var fondConnexion = document.createElement('div');
				var divConnexion = document.createElement('div');
				var fermerConnexion = document.createElement('div');
				var boutonFermerConnexion = document.createElement('span');
				
				$(fondConnexion).attr('id', 'fondConnexion');
				$(divConnexion).attr('id', 'divConnexion');
				$(fermerConnexion).attr('id', 'fermerConnexion');
				$(boutonFermerConnexion).attr('id', 'boutonFermerConnexion');
				$(boutonFermerConnexion).html('X');
				
				// Fermeture du dialog si clic sur le bouton de fermeture
				$(boutonFermerConnexion).click(function(){
						$('#fondConnexion').remove();
				});
				
				// Ajout des éléments à la page
				$(fermerConnexion).append(boutonFermerConnexion);
				$(fondConnexion).append(divConnexion);
				$(fondConnexion).append(fermerConnexion);
				$('body').append(fondConnexion);
				
				// Chargement de la page de connexion
				$(divConnexion).load('ajax_connexion.php', function(){
						
						// Choix prof ou élève
						$('.choixStatut').click(function(){
								$('#promptStatut').slideUp();
								
								if($(this).attr('id') == 'eleve')
									$('#promptClasse').slideDown();
								else
									$('#promptNomProf').slideDown();
						});
						
						// Choix de la classe
						$('.choixClasse').click(function(){
								$('#promptClasse').slideUp();
								
								// Ouverture de la liste des élèves de la classe choixie
								$('#liste_' + $(this).attr('id')).show();
								$('#promptNomEleve').slideDown();
						});
						
						// Choix du nom de l'élève
						$('.choixEleve').click(function(){
								var id = $(this).attr('id');
								
								// Connexion
								$.post('ajax_connexion_faire.php', {id: id, type: "eleve"}, function(data){
										location.reload();
								});
						});
						
						// Choix du nom de prof
						$('.choixProf').click(function(){
								// Affichage de la demande de mot de passe
								$('#promptNomProf').slideUp();
								$('#promptPasswordProf').slideDown(function()	{
										$('#passwordProf').focus();
								});
								
								var id = $(this).attr('id');
								$('#passwordProfId').val(id);
						});
						
						// Mot de passe prof entré
						$('#formPasswordProf').submit(function(){
								var id = $('#passwordProfId').val();
								var mdp = $('#passwordProf').val();
								
								$.post('ajax_connexion_faire.php', {id: id, type: "prof", mdp: mdp}, function(data){
										// Mot de passe correct
										if(data == '1')
										{
											location.reload();
										}
										// Mot de passe incorrect
										else
										{
											alert('Désolé, le mot de passe entré est incorrect.');
										}
								});
								
								return false;
						});
						
						// Demande de déconnexion
						$('.choixDeconnexion').click(function(){
								$.post('ajax_connexion_defaire.php', {}, function(data){
										window.location = 'index.php';
								});
						});
				});
		});
		
		// Changement de classe
		$('#boutonClasse').change(function(){
				// Création d'un formulaire pour faire la demande
				var form = document.createElement('form');
				$(form).attr('method', 'post');
				
				var input = document.createElement('input');
				$(input).attr('name', 'changerClasse');
				$(input).val($(this).val());
				$(form).append(input);
				
				$('body').append(form);
				$(form).hide();
				$(form).submit();
		});
});
