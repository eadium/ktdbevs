<?PHP

require('fpdf/fpdf.php');   //Подключение класса FPDF
$pdf=new FPDF();   //Создание экземпляра класса FPDF
$pdf->AddFont('TimesNewRomanPSMT', '', '5eaaf5b2054a9ced24525c8fbe3bebfa_times.php');   //Добавление шрифта Times New Roman
$pdf->AddPage();   //Добавление новой страницы
$pdf->Image('mmap.png', 0, 0, 210, 297);
$pdf->SetFont('TimesNewRomanPSMT', '', 10); 

	INCLUDE "../connect.php";
	
	$massiv = $_POST[name];

	$sem = implode (',', $massiv);


	$selec="SELECT ope_id, ope_type, ope_dur, ope_cost
			FROM operacii
			WHERE ope_id IN (".$sem.")
			ORDER BY ope_id " ;
	
	/*$selec="SELECT ope_id, ope_type, ope_dur, ope_cost
					FROM operacii 
					ORDER BY ope_id " ;*/
					
	$sp = OCIParse($c , $selec); 
	OCIExecute($sp , OCI_DEFAULT); 
	

	$j=0;
	$i=1;
	$pdf->Text(10, 67+round($j*7.4), $i);
	WHILE (OCIFetch($sp)) {
		$pdf->Text(10, 67+round($j*7.4), $i);
		$ope_id = OCIResult($sp , "OPE_ID");
		$ope_type =ucfirst(strtolower( OCIResult($sp , "OPE_TYPE")));
		$ope_cost = ucfirst(strtolower(OCIResult($sp , "OPE_COST")));
		$ope_dur = ucfirst(strtolower(OCIResult($sp , "OPE_DUR")));
		$pdf->Text(27, 67+round($j*7.4), $ope_type);
		$pdf->Text(160, 67+round($j*7.4), $ope_dur);
		$pdf->Text(178, 67+round($j*7.4), $ope_cost);
		$pdf->Ln(); 
		$i++;
		$j++;
		IF ($j>26){
			$pdf->AddPage();   //Добавление новой страницы
			$pdf->Image('mmap.png', 0, 0, 210, 297);
		$j=0;
		}
						
	}

$pdf->Output();   //Запись PDF документа на диск (в корневую директорию проекта)
//Вывод сообщения об успешном создании PDF файла
//echo 'Р¤Р°Р№Р» <b>test2.pdf</b> успешно сгенерирован';
INCLUDE "disconnect.php";
?>