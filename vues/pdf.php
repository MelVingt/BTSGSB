<?php

require("include/invoice.php");
ob_get_clean();
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( "GSB",
                  "MonAdresse\n" .
                  "75000 PARIS\n".
                  "R.C.S. PARIS B 000 000 007\n" .
                  "Capital : 18000 " . EURO );
$pdf->fact_dev( "Fiches de frais" );
$pdf->addDate($leMois);
$pdf->addClient($etatFiche);
$pdf->addPageNumber("1");
$pdf->addClientAdresse("Nom : ".$nom."\nPrenom : ".$prenom);

$cols=array( "REFERENCE"    => 23,
             "DESIGNATION"  => 78,
             "QUANTITE"     => 22,
             "P.U. HT"      => 26);
$pdf->addCols( $cols);
$cols=array( "REFERENCE"    => "L",
             "DESIGNATION"  => "L",
             "QUANTITE"     => "C",
             "P.U. HT"      => "R");
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
foreach (  $lesFraisForfait as $unFraisForfait  ) 
	{
		$quantite[] = $unFraisForfait['quantite'];
	}

	$y    = 109;
	$line = array( "REFERENCE"    => "Forfait",
				   "DESIGNATION"  => "Forfait Etape",
				   "QUANTITE"     => $quantite[0],
				   "P.U. HT"      => "110.00");
	$size = $pdf->addLine( $y, $line );
	$y   += $size + 2;$line = array( "REFERENCE"    => "Forfait",
				   "DESIGNATION"  => "Frais Kilométrique",
				   "QUANTITE"     => $quantite[1],
				   "P.U. HT"      => "0.62");
	$size = $pdf->addLine( $y, $line );
	$y   += $size + 2;$line = array( "REFERENCE"    => "Forfait",
				   "DESIGNATION"  => "Nuitée Hôtel",
				   "QUANTITE"     => $quantite[2],
				   "P.U. HT"      => "80.00");
	$size = $pdf->addLine( $y, $line );
	$y   += $size + 2;
	$line = array( "REFERENCE"    => "Forfait",
				   "DESIGNATION"  => "Repas Restaurant",
				   "QUANTITE"     => $quantite[3],
				   "P.U. HT"      => "25.00");
	$size = $pdf->addLine( $y, $line );
	$y   += $size + 10;
	
	
foreach( $lesFraisHorsForfait as $unFraisHorsForfait) 
	{
		$libelle = $unFraisHorsForfait['libelle'];
		$date = $unFraisHorsForfait['date'];
		$montant=$unFraisHorsForfait['montant'];
		$id = $unFraisHorsForfait['id'];
		
		$line = array( "REFERENCE"    => "HorsForfait",
					   "DESIGNATION"  => $libelle,
					   "QUANTITE"     => "1",
					   "P.U. HT"      => $montant);
		$size = $pdf->addLine( $y, $line );
		$y   += $size + 2;
	}
		$y   += $size + 8;
		$line = array( "REFERENCE"    => "Total",
					   "DESIGNATION"  => " ",
					   "QUANTITE"     => " ",
					   "P.U. HT"      => $montantValide);
		$size = $pdf->addLine( $y, $line );
		$y   += $size + 2;

$pdf->Output();
?>
