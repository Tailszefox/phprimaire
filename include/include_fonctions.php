<?php
/* ÉLÈVES */

// Retourne les informations d'un élève grâce à son ID
function getEleve($id)
{
	return SelectQuery('SELECT * FROM ELEVE WHERE EL_id = "'.$id.'"');
}

// Retourne un tableau d'élèves
// @classes : Si non-vide, retourne les élèves appartenant aux classes voulues
function listeEleves($classes = NULL)
{
	if(empty($classes))
		return SelectQueryMultiple('SELECT * FROM ELEVE ORDER BY EL_nom, EL_prenom');
	
	if(!is_array($classes))
		$classes = array($classes);
	
	// Construction de la clause
	$where = 'CL_id = ' . $classes[0];
	for($i = 1; $i < sizeof($classes); $i++)
	{
		$where .= ' OR CL_id = ' . $classes[$i];
	}
	
	return SelectQueryMultiple('SELECT * FROM ELEVE WHERE ' . $where . ' ORDER BY EL_nom, EL_prenom');
}

// Range le tableau d'élève dans un tableau assocatif de classes
// @eleves : Liste d'élèves
function rangerParClasse($listeEleves)
{
	$listeElevesParClasse = array();
	foreach($listeEleves as $eleve)
	{
		$listeElevesParClasse[$eleve['CL_id']][] = $eleve;
	}
	
	return $listeElevesParClasse;
}


/* PROFS */

// Retourne les informations d'un prof grâce à son ID
function getProf($id)
{
	return SelectQuery('SELECT * FROM PROF WHERE PR_id = "'.$id.'"');
}

// Retourne l'ID de la classe dont un professeur s'occupe
function getClasseDeProf($id)
{
	$classe = SelectQuery('SELECT CL_id FROM CLASSE WHERE PR_id = "'.$id.'"');
	return $classe['CL_id'];
}

// Retourne un tableau de profs
function listeProfs()
{
	return SelectQueryMultiple('SELECT * FROM PROF ORDER BY PR_nom, PR_prenom');
}

/* CLASSES */

// Retourne les informations d'une classe grâce à son ID
function getClasse($id)
{
	$classe = SelectQuery('SELECT * FROM CLASSE WHERE CL_id = "'.$id.'"');
	return $classe;
}

// Retourne une tableau de classes
// @actuelles : Si True, retourne uniquement les classes de l'année actuelle
function listeClasses($actuelles = True)
{
	if(!$actuelles)
		return SelectQueryMultiple('SELECT * FROM CLASSE');
	
	// Si nous sommes entre septembre et décembre
	if(intval(date('n')) >= 9 && intval(date('n')) <= 12)
		$anneeRecherche = intval(date('Y'));
	// Si nous sommes entre janvier et août
	else
		$anneeRecherche = intval(date('Y')) - 1;
		
	return SelectQueryMultiple('SELECT * FROM CLASSE WHERE annee LIKE "' . $anneeRecherche .'-%"');
}

/* PARAMÈTRES */

// Écrit les paramètres dans le fichier des paramètres
function ecrireParametres($nomEcole, $db_adresse, $db_user, $db_password, $db_nom, $installed = true)
{
	file_put_contents('./include/include_parametres.php', '<?php
	$nomEcole = \''.$nomEcole.'\';
	$db_adresse = \''.$db_adresse.'\';
	$db_user = \''.$db_user.'\';
	$db_password = \''.$db_password.'\';
	$db_nom = \''.$db_nom.'\';
	$installed = \''.$installed.'\';
?>');
}

?>
