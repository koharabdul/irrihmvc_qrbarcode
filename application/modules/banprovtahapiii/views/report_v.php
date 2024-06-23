<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).



// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

	//Page header
	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'Ako.png';
		$this->Image($image_file, 15, 10, 23, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);

		// Set font
		$this->SetFont('times', 'B', 13);

		// Title
		// $this->Cell(0, 15, "Abdul Kohar aku juga", 0, false, 'C', 0, '', 0, false, 'M', 'M');
		$this->Multicell(0, 15, "PUSAT KESEJAHTERAAN SOSIAL (PUSKESOS SAUYUNAN)\nDESA NANJUNG MEKAR KECAMATAN RANCAEKEK\nKABUPATEN BANDUNG 40394 TAHUN 2020\n", 0, 'C',false);
		$html = '<table class="table table-responsive" border="1" widht="100%" style="height:1px;font-size:1px;margin-top:10px;padding-bottom:3px; border-top:2;"><tr><td></td></tr></table>';
		$this->writeHTML($html, true, false, true, false, '');

	}

	// Page footer
	// public function Footer() {
	// 	// Position at 15 mm from bottom
	// 	$this->SetY(-15);
	// 	// Set font
	// 	$this->SetFont('helvetica', 'I', 9);
	// 	// Page number
	// 	$this->Cell(0, 1, 'Page '.$this->getAliasNumPage(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	
	// 	$html = '<hr widht="100%">';
	// 	$this->writeHTML($html, true, false, true, false, '');
		
	// }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Abdul Kohar');
$pdf->SetTitle($subtitle.' | '.'Report');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(12, 35, 12);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

$pdf->setBarcode(date('Y-m-d H:i:s'));

// set font
$pdf->AddPage();


// print a message
$pdf->Image(base_url().'tes.png', 177, 31, '', '', 'PNG');
// -----------------------------------------------------------------------------

$pdf->SetFont('times', 'R', 10);

$pdf->ln(8);
$heading = <<<EOD
<h3>Daftar Nama-nama Pengerima Bansos Provinsi Tahap II</h3>

EOD;
$pdf->writeHTMLCell(0, 0, '', '', $heading, 0, 1, 0, true, 'C', true);




$pdf->ln(5);
$table = '<table border="1" style="padding-left:3px; padding-right:3px; margin-top: 5px; vertical-align:middle;" width="100%">';
$table .= '<tr>
			<th width="7%" height="20px">NO.</th>
			<th width="27%">NAMA LENGKAP</th>
			<th width="18%">NIK</th>
			<th width="12%">NO. URUT</th>
			<th width="8%">RT</th>
			<th width="8%">RW</th>
			<th width="20%">WAKTU PENGAMBILAN</th>
		  </tr>';
$no = 1;
foreach ($pageresult as $record) {
	$table .= '<tr>
				<td height="15px">'.$no.'</td>
				<td align="left">'.$record->nm_lengkap.'</td>
				<td align="center">'.$record->nik.'</td>
				<td align="center">'.$record->no_urut.'</td>
				<td align="center">'.$record->rt.'</td>
				<td align="center">'.$record->rw.'</td>
				<td >'.$record->date_modified.'</td>
			   </tr>';
			   $no++;
}
$table .= '</table>';
$pdf->writeHTMLCell(0, 0, '', '', $table, 0, 1, 0, true, 'C', true);



ob_end_clean();//this is new for the error Some data has already been output, can't send PDF file

//Close and output PDF document
$pdf->Output($subtitle.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

 				