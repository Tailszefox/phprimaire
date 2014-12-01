<?php

// Gestion des erreurs
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
// Tentation de connexion
try
{
	$bd = new PDO('mysql:host='.$db_adresse.';dbname=' . $db_nom, $db_user, $db_password, $pdo_options);
}
catch(Exception $e)
{
	header('Location: installation.php');
}

// Applique les protections usuelles sur les éléments d'un tableau
// @html : Applique ou non htmlspecialchars
function protect($array, $html = true)
{
	if(get_magic_quotes_gpc())
	{
		$array = array_map('stripslashes', $array);
	}
	if($html)
		$array = array_map('htmlspecialchars', $array);
	$array = array_map('mysql_real_escape_string', $array);
	$array = array_map('trim', $array);
	return $array;
}

// Requête de sélection unique
// Renvoie un tableau de colonnes
function SelectQuery($query, $display = FALSE)
{
	global $bd;
	
	if($display == TRUE)
		echo $query;
	
	try
	{
		$result = $bd->query($query);
	}
	catch(Exception $e)
	{
		die('Erreur de traitement de la requête : ' . $e->getMessage());
	}
	
	$arrayResult = $result->fetch(PDO::FETCH_ASSOC);
	$result->closeCursor();
	
	return $arrayResult;
}

// Requête de sélection multiples
// Renvoie un tableau de lignes
function SelectQueryMultiple($query, $display = FALSE)
{
	global $bd;
	
	if($display == TRUE)
		echo $query;
	
	try
	{
		$result = $bd->query($query);
	}
	catch(Exception $e)
	{
		die('Erreur de traitement de la requête : ' . $e->getMessage());
	}
	
	$arrayResult = array();
	while($row = $result->fetch(PDO::FETCH_ASSOC))
	{
		$arrayResult[] = $row;
	}
	
	$result->closeCursor();
	return $arrayResult;
}

// Requête d'insertion
// Renvoie le nouvel ID
function InsertQuery($query, $display = FALSE)
{
	global $bd;
	
	if($display == TRUE)
		echo $query;
	
	try
	{
		$bd->exec($query);
	}
	catch(Exception $e)
	{
		die('Erreur de traitement de la requête : ' . $e->getMessage());
	}
	
	return $bd->lastInsertId();
}

// Requête de remplacement
function ReplaceQuery($query, $display = FALSE)
{
	global $bd;
	
	if($display == TRUE)
		echo $query;
	
	try
	{
		$bd->exec($query);
	}
	catch(Exception $e)
	{
		die('Erreur de traitement de la requête : ' . $e->getMessage());
	}
}

// Requête de mise à jour
// Renvoie de le nombre de lignes affectées
function UpdateQuery($query, $display = FALSE)
{
	global $bd;
	
	if($display == TRUE)
		echo $query;
	
	try
	{
		$total = $bd->exec($query);
	}
	catch(Exception $e)
	{
		die('Erreur de traitement de la requête : ' . $e->getMessage());
	}
	
	return $total;
}

// Requête de suppression
// Renvoie de le nombre de lignes affectées
function DeleteQuery($query, $display = FALSE)
{
	global $bd;
	
	if($display == TRUE)
		echo $query;
	
	try
	{
		$total = $bd->exec($query);
	}
	catch(Exception $e)
	{
		die('Erreur de traitement de la requête : ' . $e->getMessage());
	}
	
	return $total;
}


?>
