<?php


$html = "<input type='text' name='txt_1' id='txt_1'/>";

//==============================================================
//==============================================================
//==============================================================
include("../mpdf.php");
$mpdf=new mPDF('c'); 

$mpdf->mirrorMargins = true;

$mpdf->SetDisplayMode('fullpage','two');

$mpdf->WriteHTML($html);

$mpdf->Output();
exit;
//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================


?>