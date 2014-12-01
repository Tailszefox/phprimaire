<?php
require('include/include_init.php');

// Génération du bulletin en PDF

// Convertit les accents au format correct
function convert($texte)
{
	return iconv('UTF-8', 'windows-1252', $texte);
}

// Change le séparateur décimal
function virgule($nombre)
{
	return str_replace('.', ',', strval($nombre));
}

// Récupération des notes
$notes = SelectQueryMultiple('SELECT ELEVE.EL_id as eleve_id, EL_nom, EL_prenom, EP_titre, EP_coeff, EPN_note FROM ELEVE JOIN EPREUVE_NOTE ON EPREUVE_NOTE.EL_id = ELEVE.EL_id JOIN EPREUVE ON EPREUVE_NOTE.EP_id = EPREUVE.EP_id WHERE ELEVE.CL_id = ' . $_SESSION['classe'] . ' ORDER BY EL_nom, EL_prenom');

$classe = getClasse($_SESSION['classe']);
$prof = getProf($classe['PR_id']);

$eleves = array();

// Pour chaque note
foreach($notes as $note)
{
	// Informations sur l'élève
	$eleves[$note['eleve_id']]['nom'] = $note['EL_nom'];
	$eleves[$note['eleve_id']]['prenom'] = $note['EL_prenom'];
	
	// Chaque note est mise dans un tableau propre à chaque élève
	$eleves[$note['eleve_id']]['notes'][] = array(
		'epreuve' => $note['EP_titre'],
		'coefficient' => $note['EP_coeff'],
		'note' => $note['EPN_note']
		);
}

require('./include/fpdf16/fpdf.php');

// Création du PDF
$pdf=new FPDF();

// Pour chaque élève
foreach($eleves as $eleve)
{
	// Mise en page du PDF
	$pdf->AddPage();
	$pdf->SetFont('Arial');
	
	$pdf->MultiCell(90, 10, $eleve['prenom'] . ' ' . $eleve['nom'] . "\n" . $classe['CL_nom'], 1, 'L');
	$pdf->setY(10);
	$pdf->setX(110);
	$pdf->Cell(90, 20, 'Classe de ' . $prof['PR_civilite'] . ' ' . $prof['PR_nom'] , 1, 1, 'R');
	
	$pdf->Ln();
	
	$pdf->SetFont('Arial', 'B');
	$pdf->Cell(130, 7, convert('Matière'), 1, 0, 'C');
	$pdf->Cell(30, 7, convert('Coefficient'), 1, 0, 'C');
	$pdf->Cell(30, 7, convert('Note'), 1, 0, 'C');
	$pdf->SetFont('Arial');
	
	$i = 0;
	$moyenne = 0;
	$total = 0;
	$depart = $pdf->GetY();
	
	// Pour chaque note de l'élève
	foreach($eleve['notes'] as $note)
	{
		$pdf->Ln();
		$pdf->Cell(130, 7, convert($note['epreuve']), 1, 0, 'C');
		$pdf->Cell(30, 7, virgule($note['coefficient']), 1, 0, 'C');
		$pdf->Cell(30, 7, virgule($note['note']), 1, 0, 'C');
		
		$moyenne += floatval($note['note']) * floatval($note['coefficient']); 
		$total += $note['coefficient'];
		
		$i += 7;
	}
	$i += 7;
	
	$pdf->Rect(10, $depart + $i, 190, 160 - $i);
	$pdf->setY($depart + 160);
	
	$pdf->SetFont('Arial', 'B');
	$pdf->Cell(130, 7, convert('Moyenne générale'), 1, 0, 'C');
	$pdf->Cell(60, 7, virgule(round($moyenne / $total, 2)), 1, 0, 'C');
	$pdf->SetFont('Arial');
	
	$pdf->Rect(10, $depart + 160 + 20, 190, 50);
}

// Affichage du PDF
$pdf->Output();

?>
