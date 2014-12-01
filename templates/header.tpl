<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" type="image/png" href="favicon.ico" />
	
	<title>{$nomEcole} - {$section}</title>
	
	<link rel="stylesheet" type="text/css" href="design/style.css" media="screen, projection"/>
	{* Feuilles de style supplémentaires *}
	{$moreCss}
	
	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/jquery-ui.js"></script>
	<script type="text/javascript" src="javascript/main.js"></script>
	{* Fichiers Javascript supplémentaires *}
	{$moreJs}
	
</head>
<body>

<div id="menuTop">
	<span id="menuTopMontrer">&lt;=</span>
	<div id="menuTopElements">
		<span class="menuTopLien"><a href="./liens.php">Liens</a></span> |
		<span class="menuTopLien"><a href="./photos.php">Photos</a></span> |
		<span class="menuTopLien"><a href="./rendus.php">Rendus</a></span> |
		<span class="menuTopLien"><a href="./quizz.php">Quizz</a></span> |
		{if $statut == 'prof'}
		 <span class="menuTopLien"><a href="./notes.php">Notes</a></span> |
		<span class="menuTopLien"><a href="./gestion.php">Gestion des élèves</a></span> |
		{if $admin == '1'}
		<span class="menuTopLien"><a href="./administration.php">Administration générale</a></span> |
		{/if}
		{/if}
	</div>
	<span class="menuTopLien"><span id="boutonConnexion">{if $statut == ''}Se connecter{else}{$prenom} {$nom}{/if}</span></span>
	{* Si admin, possibilité de gérer toutes les classes *}
	{if $admin == '1'}
	| <span class="menuTopLien"><span id="boutonConnexion">Classe
		<select id="boutonClasse" size="1">
			{foreach $listeClassesAdmin as $classeListe}
				{if $classeListe['CL_id'] == $classe}
					<option value="{$classeListe['CL_id']}" selected>{$classeListe['CL_nom']}</option>
				{else}
					<option value="{$classeListe['CL_id']}">{$classeListe['CL_nom']}</option>
				{/if}
			{/foreach}
		</select>
	</span></span>
	{/if}
</div>

<div id="titre">
<p><span id="titreNom">{$nomEcole}</span><br /><span id="titreSection">{$section}</span>
{if isset($retour)}<p id="lienRetour"><a href="{$retour}" id="retourSection">Retour</a></p>{/if}
</p>
</div>

<div id="corps">

