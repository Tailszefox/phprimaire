<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" type="image/png" href="favicon.ico" />
	
	<title>PHPrim - Installation</title>
	
	<link rel="stylesheet" type="text/css" href="design/installation.css" media="screen, projection"/>
	
	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/jquery-ui.js"></script>
	<script type="text/javascript" src="javascript/installation.js"></script>
</head>
<body>

<h1 class="center">PHPrim - Installation</h1>

{* Première connexion ou erreur de connexion *}
{if $statut == 'debut' || $statut == 'erreur'}

{if $statut == 'debut'}<p class="center">Bienvenue dans le système d'installation de PHPrim.<br />Cet assistant vous aidera à vous connecter à la base de données, créer les tables nécessaires et mettre en place le compte de l'administrateur</p>

<p class="center">Tout d'abord, veuillez renseigner les paramètres d'installation dans les champs ci-dessous.</p>
{elseif $statut == 'erreur'}
<p class="center">Il a été impossible de se connecter à la base avec ces paramètres. Merci de les corriger et de réessayer.<br />
L'erreur retournée par le gestionnaire de connexion est la suivante :<br />
{$erreur}
</p>
{/if}

<form method="post">
	<p class="center">
		Adresse du serveur de base de données :<br />
		<input type="text" name="installationBaseAdresse" id="installationBaseAdresse" value="{$adresse}"/>
	</p>
	
	<p class="center">
		Nom d'utilisateur :<br />
		<input type="text" name="installationBaseUsername" id="installationBaseUsername" value="{$username}" />
	</p>
	
	<p class="center">
		Mot de passe :<br />
		<input type="password" name="installationBasePassword" id="installationBasePassword" value="{$password}" />
	</p>
	
	<p class="center">
		Base de données :<br />
		<input type="text" name="installationBaseBase" id="installationBaseBase" value="{$base}" />
	</p>
	
	<p class="center"><input type="submit" value="Tester la connexion" name="installationBaseTester" /></p>
</form>
{* Création du compte administrateur *}
{else if $statut == 'creation'}
<p class="center">La connexion a été établie et les tables ont été créées.</p>

<p class="center">Vous devez maintenant créer le compte de l'administrateur.<br />L'administrateur a la possibilité d'accéder à une page supplémentaire permettant de gérer les professeurs et les classes.<br />
Notez que l'administrateur peut aussi être un professeur auquel une classe pourra être attribuée par la suite.<br />Une fois l'installation terminée, vous pourrez ajouter de nouveaux comptes administrateurs si vous le désirez.</p>

<form method="post" id="formulaireAdministrateur">
	<p class="center">Nom de l'école :<br />
	<input type="text" name="formulaireAdministrateurEcole" id="formulaireAdministrateurEcole" /><br />
	Le nom de l'école apparaitra sur toutes les pages. Vous aurez la possibilité de le changer ultérieurement si nécessaire.
	</p>

	<p class="center">Prénom et nom de l'administrateur :<br />
	<select id="formulaireAdministrateurCivilite" name="formulaireAdministrateurCivilite">
		<option value="Mme">Mme</option>
		<option value="Mlle">Mlle</option>
		<option value="M.">M.</option>
	</select>
	<input type="text" id="formulaireAdministrateurPrenom" name="formulaireAdministrateurPrenom" />
	<input type="text" id="formulaireAdministrateurNom" name="formulaireAdministrateurNom" />
	</p>
	<p class="center">Mot de passe :<br />
	<input type="password" id="formulaireAdministrateurPassword" name="formulaireAdministrateurPassword" />
	</p>
	
	<p class="center">Insérer des enregistrements : <input type="checkbox" name="formulaireAdministrateurInserer" id="formulaireAdministrateurInserer" checked="checked" />
	<br />Cochez cette case pour insérer des enregistrements d'exemple afin de pouvoir tester l'application.</p>
	<p class="center"><input type="submit" class="submit" value="Créer l'administrateur" name="formulaireAdministrateurAjouter" id="formulaireAdministrateurAjouter" /></p>
</form>
{* Installation terminée *}
{else if $statut == 'termine'}
<p class="center">Félicitations ! L'installation est maintenant terminée.</p>

<p class="center">Une fois sur la page d'accueil de l'application, cliquez sur le bouton "Se connecter" en haut à droite de la page pour vous connecter avec le compte que vous venez de créer. Vous pourrez alors commencer à utiliser l'application et créer de nouvelles classes et des professeurs.</p>

<p class="center">Merci d'utiliser PHPrim !</p>

<p class="center"><a href="index.php">Accéder à l'application</a></p>
{/if}
</body>
</html>
