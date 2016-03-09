<?php
require('include/include_init.php');

// Pas d'ID 
if(!isset($_GET['id']) || !isset($_SESSION['statut']) || $_SESSION['statut'] == '')
{
	header('Location: quizz.php');
}

// Récupération du quizz
$quizz = SelectQuery('SELECT * FROM QUIZ WHERE QZ_id = "'.$_GET['id'].'"');
$questions = SelectQueryMultiple('SELECT * FROM QUESTIONS WHERE QZ_id = "'.$_GET['id'].'" ORDER BY QU_id'); 

// Quizz inexistant
if(empty($quizz))
	header('Location: quizz.php');

$s->assign(array(
	'section' => 'Quizz',
	'retour' => 'quizz.php',
	'moreCss' => '<link rel="stylesheet" type="text/css" href="design/quizz.css" media="screen, projection"/>',
	'moreJs' => '<script type="text/javascript" src="javascript/quizz.js"></script>',
	'quizz' => $quizz,
	'temps' => $quizz['QZ_temps'],
	'tempsMinute' => floor($quizz['QZ_temps'] / 60),
	'tempsSeconde' => $quizz['QZ_temps'] % 60,
	'questions' => $questions,
)); 

// Si un élève consulte
if($_SESSION['statut'] == 'eleve')
{	
	// L'élève vient de répondu au quizz
	if(isset($_POST['quizzRepondreValider']))
	{
		$listeBonnesReponses = array();
		$reponsesCorrectes = 0;
		
		foreach($questions as $question)
		{
			$listeBonnesReponses[$question['QU_id']] = $question['QU_correct'];
		}
		
		// Pour chaque question du quizz
		foreach($_POST['ids'] as $id)
		{
			// Si l'élève a bien répondu a cette question
			if(isset($_POST['reponse_' . $id]) && strpos($listeBonnesReponses[$id], strval($_POST['reponse_' . $id])) !== FALSE)
			{
				$reponsesCorrectes++;
			}
		}
		
		$note = ceil((20 * $reponsesCorrectes) / sizeof($questions));
		
	InsertQuery('REPLACE INTO NOTE(EL_id, QZ_id, NT_note) VALUES('.$_SESSION['id'].', '.$_GET['id'].', '.$note.')');
		
		$s->assign(array('note' => $note));
	}
	// On regarde si l'élève a déjà répondu au quizz
	else
	{
		$note = SelectQuery('SELECT NT_note FROM NOTE WHERE EL_id = '.$_SESSION['id'].' AND QZ_id = '.$_GET['id']);
		if(empty($note))
			$s->assign(array('note' => -1));
		else
			$s->assign(array('note' => $note['NT_note']));
	}
	
	// Affichage du template élève
	$s->display('templates/quizz_consulter_eleve.tpl');
}
// Si un prof consulte
else if($_SESSION['statut'] == 'prof')
{
	
	// Récupération des notes des élèves
	$notes = SelectQueryMultiple('SELECT EL_nom, EL_prenom, NT_note FROM NOTE JOIN ELEVE ON NOTE.EL_id = ELEVE.EL_id WHERE QZ_id = '.$_GET['id']);
	
	$s->assign(array(
		'notes' => $notes,
		));
	
	// Affichage du template prof
	$s->display('templates/quizz_consulter_prof.tpl');
}
?>
