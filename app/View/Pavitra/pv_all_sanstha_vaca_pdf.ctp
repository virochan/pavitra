<?php
$global_ac_year = Configure::read('global_ac_year');
$sansthacode = $this->Session->read('user_id');
$date = date('d/m/Y');

$mpdf = new mPDF('utf-8', 'A4', '0', '0', '5','5');
$mpdf->autoScriptToLang = true;
$mpdf->baseScript = 1;
$mpdf->autoVietnamese = true;
$mpdf->autoArabic = true;
$mpdf->autoLangToFont = true;
$mpdf->defaultfooterline = 0;
ob_clean();
$html ='<html> 

';
$mpdf->SetHTMLHeader('
	
    <head > <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
       	<meta charset="utf-8" />
        <table style="width:100%;border-collapse:collapse">
            <tr>
                <td class="col-xs-8" align="Center" style="padding-left:100px;">
                    <span style="font-family:arial;font-weight:200;font-size:20px">School Education and Sports Department</span>
                </td>
                <td class="col-xs-4" align="right" style="font-family:arial;font-weight:400;font-size:20px">
                    Date : '.$date.'
                </td>
            </tr>
            <tr>
                <td class="col-xs-8" align="Center" style="padding-left:100px;padding-top:5px;">
                    <span style="font-family:arial;font-weight:200;font-size:20px">Vacancy Details For All Sanstha</span>
                </td>
                <td class="col-xs-4" align="right" style="font-family:arial;font-weight:400;font-size:20px;padding-top:5px;">
                    Page : {PAGENO} / {nbpg} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
        </table>
    </head>
');

$html.='


<div style="padding-top:35px !important;width:100%;">
    <table cellspacing="1" style="width:100%;border-collapse:collapse;">
        <thead>
            <tr>
                <th class="col-xs-1" rowspan="2" style="font-family:arial;border:0.2px solid #000;border-collapse:collapse; border-left:none;font-size:15px;font-weight:400;">Sr. <br>No.</th>
                <th class="col-xs-3" rowspan="2" colspan="3" style="font-family:arial;border:0.2px solid #000;border-collapse:collapse;font-size:15px;font-weight:400;">Sanstha Name</th>
                <th class="col-xs-2" rowspan="2" colspan="2" style="font-family:arial;border:0.2px solid #000;border-collapse:collapse;font-size:15px;font-weight:400;">School Name</th>
                <th class="col-xs-1" rowspan="2" style="font-family:arial;border:0.2px solid #000;border-collapse:collapse;font-size:15px;font-weight:400;">Medium</th>
                <th class="col-xs-1" rowspan="2" style="font-family:arial;border:0.2px solid #000;border-collapse:collapse;font-size:15px;font-weight:400;">Designation</th>
                <th class="col-xs-1" rowspan="2" style="font-family:arial;border:0.2px solid #000;border-collapse:collapse;font-size:15px;font-weight:400;">Aid Type</th>
                <th class="col-xs-1" rowspan="2" style="font-family:arial;border:0.2px solid #000;border-collapse:collapse;font-size:15px;font-weight:400;">Subject </th>
                <th class="col-xs-2" colspan="2" style="font-family:arial;border:0.2px solid #000;border-collapse:collapse;border-right:none;font-size:15px;font-weight:400;">Vacancy Positions</th>
            </tr>
            <tr>
                <th class="col-xs-1" style="font-family:arial;border:0.2px solid #000;border-collapse:collapse;font-size:12px;font-weight:400;">Left After Samayojan</th>
                <th class="col-xs-1" style="font-family:arial;border:0.2px solid #000;border-collapse:collapse;border-right:none;font-size:12px;font-weight:400;">Created During Oct-17 to Dec-17</th>
            </tr>
        </thead>';
        $name = '';
        $name1 = '';
        $ssname = '';
        $sname1 = '';
        $med = '';
        $med1 = '';
        $cnt= 0 ;
        for ($j = 0; $j < count($check); $j++) {
            $post_desc = $check[$j]['0']['post_desc'];
            $sname = $check[$j]['0']['sanstha_name'];
            $name = $check[$j]['0']['school_name'];
            $med = $check[$j]['0']['medinstr_desc'];
                $html.='<tbody>
            <tr>';
            if($j==0){
               $cnt = intval($j + 1);
               $sname = $check[$j]['0']['sanstha_name'];
               $name = $check[$j]['0']['school_name'];
               $med = $check[$j]['0']['medinstr_desc'];
               $html.='
                <td class="col-xs-1" align="center" style="font-family:arial;width:4%;font-size:15px">'.$cnt.'</td>';
            }
            else{
                

                if($sname==$sname1){
                    $sname='';
                     if($name==$name1){
                    $name='';
                     $med='';

                }
                     $html.='
                        <td class="col-xs-1" align="center" style="font-family:arial;width:4%;font-size:15px">&nbsp;</td>';

                }
                else{
                    $sname = $check[$j]['0']['sanstha_name'];
                     $name = $check[$j]['0']['school_name'];
                     $med = $check[$j]['0']['medinstr_desc'];
                     $cnt=  intval($cnt+1);
                      $html.='
                        <td class="col-xs-1" valign="top" align="center" style="font-family:arial;width:4%;font-size:15px">'.$cnt.'</td>';
                }
            }
            
       
                
                $html.='
                <td class="col-xs-3" colspan="3" valign="top" style="font-family:arial;width:28%;font-size:12px">' . $sname . '</td>
                <td class="col-xs-2" colspan="2" valign="top" style="font-family:arial;width:23%;font-size:12px">' . $name . '</td>
                <td class="col-xs-1" valign="top" align="center" style="font-family:arial;width:8%;font-size:12px">' . $med . '</td>
                <td class="col-xs-1" valign="top" style="font-family:arial;width:16%;font-size:12px">'.$post_desc.'</td>
                <td class="col-xs-1" valign="top" align="center" style="font-family:arial;width:8%;font-size:12px">' . $check[$j]['0']['code_text'] . '</td>
                <td class="col-xs-1" valign="top" align="center" style="font-family:arial;width:8%;font-size:12px">' . $check[$j]['0']['subject_group_desc'] . '</td>
                <td class="col-xs-1" colspan="1" valign="top" align="center" style="font-family:arial;width:8.5%;font-size:15px">' . $check[$j]['0']['shifted_tchr_cnt'] . '</td>
                <td class="col-xs-1" colspan="1" valign="top" align="center" style="font-family:arial;width:11.5%;font-size:15px">' . $check[$j]['0']['shifted_tchr_cnt'] . '</td>
            </tr>';
            $name1 = $check[$j]['0']['school_name'];
            $sname1 = $check[$j]['0']['sanstha_name'];
            $med1 = $check[$j]['0']['medinstr_desc'];
        }
        $html.='</tbody>
            </table>
            </div>
            <div align="center" style="font-family:arial;font-size:15px;text-align:center;padding-top:5px !important;width:100%;">
                <p><hr/></p>
                <p>-----***End Of Report***-----</p>
    </div>
</html>
';

$mpdf->WriteHTML($html);
ob_clean();
$mpdf->Output();
exit;
?>
