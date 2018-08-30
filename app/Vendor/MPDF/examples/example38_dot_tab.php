<?php


$html = "<html><body><input type='text' name='txt_name'></body></html";


include("../mpdf.php");

$mpdf=new mPDF(); 

$mpdf->WriteHTML($html);

$mpdf->Output(); 

exit;



?>