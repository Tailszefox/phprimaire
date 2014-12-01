$(document).ready(function(){
		$('#formulaireAdministrateur').submit(function(){
				if($('#formulaireAdministrateurPrenom').val().trim() == "" || $('#formulaireAdministrateurNom').val().trim() == "")
				{
					alert('Merci de renseigner le prénom et le nom de l\'administrateur');
					return false;
				}
				
				if($('#formulaireAdministrateurPassword').val().trim() == "")
				{
					alert('Merci de renseigner le mot de passe de l\'administrateur. Par mesure de sécurité, ce mot de passe ne peut être vide.');
					return false;
				}
				
				return true;
		});
});
