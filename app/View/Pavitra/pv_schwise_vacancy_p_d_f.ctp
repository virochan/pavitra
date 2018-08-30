<?php

$global_ac_year = Configure::read('global_ac_year');
$sansthacode = $this->Session->read('user_id');
$date = date('d/m/Y');
$mpdf = new mPDF('utf-8', 'A4', '0', '0', '5', '5');
$mpdf->autoScriptToLang = true;
$mpdf->baseScript = 1;
$mpdf->autoVietnamese = true;
$mpdf->autoArabic = true;
$mpdf->autoLangToFont = true;
$mpdf->defaultfooterline = 0;
ob_clean();
$html = '<html>';
$mpdf->SetHTMLHeader('<head > <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
       	<meta charset="utf-8" />
        <table style="width:100%;border-collapse:collapse">
            <tr>
                <td class="col-xs-8" align="Center" style="padding-left:100px;">
                    <span style="font-family:arial;font-weight:200;font-size:20px">School Education and Sports Department</span>
                </td>
                <td class="col-xs-4" align="right" style="font-family:arial;font-weight:400;font-size:20px">
                    Date : ' . $date . '
                </td>
            </tr>
            <tr>
                <td class="col-xs-8" align="Center" style="padding-left:100px;padding-top:5px;">
                    <span style="font-family:arial;font-weight:200;font-size:20px">School Wise Vacancy Details For Particular Sanstha</span>
                </td>
                <td class="col-xs-4" align="right" style="font-family:arial;font-weight:400;font-size:20px;padding-top:5px;">
                    Page : {PAGENO} / {nbpg} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
        </table>
    </head>
');
$html.='<div style="padding-top:40px !important;width:100%;">
    <table style="width:100%">
        <tr>
        <td style="font-family:arial;font-size:18px;font-weight:400;width:12%">Sanstha : </td>
        <td style="font-family:arial;font-size:16px;font-weight:400;width:56%">' . $sanstha_name . '</td>
       
        <td style="font-family:arial;font-size:18px;font-weight:400;width:12%">District : </td>
        <td style="font-family:arial;font-size:16px;font-weight:400;width:18%;">' . $dist_name . '</td>
        </tr>
    </table>
</div>

<div style="padding-top:5px !important;width:100%;">
    <table cellspacing="1" style="width:100%;border-collapse:collapse;">
        <thead>
            <tr>
                <th class="col-xs-1" rowspan="2" style="font-family:arial;border:0.2px solid #000;border-collapse:collapse; border-left:none;font-size:15px;font-weight:400;">Sr. <br>No.</th>
                <th class="col-xs-5" rowspan="2" colspan="5" style="font-family:arial;border:0.2px solid #000;border-collapse:collapse;font-size:15px;font-weight:400;">School Name</th>
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
$cnt = 0;
for ($j = 0; $j < count($check); $j++) {
    $post_desc = $check[$j]['0']['post_desc'];
    $aft_smj = ($check[$j]['0']['eos_sm_posts'] - ($check[$j]['0']['eos_online_posts']+$check[$j]['0']['shifted_tchr_cnt']));
    $name = $check[$j]['0']['school_name'];
    $html.='<tbody>
            <tr>';
    if ($j == 0) {
        $cnt = intval($j + 1);
        $name = $check[$j]['0']['school_name'];
        $html.='
                <td class="col-xs-1" align="center" style="font-family:arial;width:5%;font-size:15px">' . $cnt . '</td>';
    } else {

        if ($name == $name1) {
            $name = '';
            $html.='
                        <td class="col-xs-1" align="center" style="font-family:arial;width:5%;font-size:15px">&nbsp;</td>';
        } else {
            $name = $check[$j]['0']['school_name'];
            $cnt = intval($cnt + 1);
            $html.='
                        <td class="col-xs-1" align="center" style="font-family:arial;width:5%;font-size:15px">' . $cnt . '</td>';
        }
    }

    $html.='<td class="col-xs-5" colspan="5" valign="middle" style="font-family:arial;width:25%;font-size:13.5px">' . $name . '</td>
                <td class="col-xs-1" align="center" style="font-family:arial;width:9%;font-size:15px">' . $check[$j]['0']['medinstr_desc'] . '</td>
                <td class="col-xs-1" style="font-family:arial;width:23%;font-size:14px">' . $post_desc . '</td>
                <td class="col-xs-1" align="center" style="font-family:arial;width:9%;font-size:15px">' . $check[$j]['0']['code_text'] . '</td>
                <td class="col-xs-1" align="center" style="font-family:arial;width:9%;font-size:15px">' . $check[$j]['0']['subject_group_desc'] . '</td>
                <td class="col-xs-1" colspan="1" align="center" style="font-family:arial;width:8.5%;font-size:15px">' . $aft_smj . '</td>
                <td class="col-xs-1" colspan="1" align="center" style="font-family:arial;width:11.5%;font-size:15px">' . $check[$j]['0']['vac_crd_aft_smj'] . '</td>
            </tr>';
    $name1 = $check[$j]['0']['school_name'];
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