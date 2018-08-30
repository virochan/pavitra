<?php

//pr($newschooldata);exit;
//pr($check_grid);exit;

$global_ac_year = Configure::read('global_ac_year');
$sansthacode = $this->Session->read('user_id');
$date = date('d-m-Y');
if($roster_edn_level=='P'){
    $mname='प्राथमिक';
}
else{
    $mname='माध्यमिक';
}

if($check_grid['0']['0']['asst_flag']=='E'){
   $err_msg='Advertisement has not been approved by the EO';
}
else{
    $err_msg='';
}

$html='<html> 
    <head> 
    <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
    <meta charset="utf-8" />
    
    <style>
    .table-content{width:100%; border-collapse:collapse;}
    .table-content thead tr th{font-size:14px;border:1px solid #000;padding:3px;font-weight:500;}
    .table-content tbody tr td{font-size:12px;border:1px solid #000;padding:3px;}
    .table-content2{width:100%; border-collapse:collapse;}
    .table-content2 thead tr th{font-size:14px;border:1px solid #000;padding:3px;text-align:center;font-weight:500;}
    .table-content2 tbody tr td{font-size:12px;border:1px solid #000;padding:3px;text-align:center;font-weight:500;}
    </style>
    </head>
    <body>
     
        <h2><p align="center" style="font-family:arial;font-weight:500">जाहिरातीचा मसुदा</p></h2>
        <p align="right" style="font-family:arial;">दिनांक : '.$date.'</p>
        <p align="left" style="font-family:arial;">संस्थेचे नाव : ('.$sansthacode.')'.$sanstha_name.'</p>
        <p style="font-family:arial;">वरील संस्थेच्या सर्व '.$mname.'(अनुदानित/विनानुदानित) शाळेचा खालील पदांची चालू शैक्षणिक वर्ष (2018-2019 ) करीता नेमणुका करावयाच्या आहेत.</p>
        <p align="center" style="color:red;font-family:arial;font-weight:500">'.$err_msg.'</p>
        <h3><p align="center" style="font-family:arial;font-weight:500">पदांचा तपशील खालीलप्रमाणे</p></h3>
        <table class="table-content" cellspacing="1" cellpadding="1">
            <thead>
                <tr>
                    <th class="col-xs-1" style="font-family:arial;">अ.क्र</th>
                    <th class="col-xs-2" style="font-family:arial;">पद</th>
                    <th class="col-xs-1" style="font-family:arial;">वेतनश्रेणी</th>
                    <th class="col-xs-1" style="font-family:arial;">एकूण पदे </th>
                    <th class="col-xs-1" style="font-family:arial;">अनुदान प्रकार</th>
                    <th class="col-xs-2" style="font-family:arial;">माध्यम</th>
                    <th class="col-xs-2" style="font-family:arial;">विषय</th>
                    <th class="col-xs-1" style="font-family:arial;">शैक्षणिक पात्रता </th>
                    <th class="col-xs-1" style="font-family:arial;">व्यावसायिक पात्रता </th>
                 
                </tr>
            </thead>';
            

                for ($j = 0; $j < count($check_grid); $j++) {
            
                    $sub1=$check_grid[$j]['0']['subject_group_desc'];
                    $sub2=$check_grid[$j]['0']['subject_name'];
                    if(!empty($sub1)){
                        $subj=$sub1;
                    }
                    else{
                        $subj=$sub2;
                    }
                    $post_desc = $check_grid[$j]['0']['post_desc'];
                    $html.='<tbody>
                        <tr>
                           <td class="col-xs-1" align="center" style="font-family:arial;">
                            ' . intval($j + 1) . '
                           </td>
                           <td class="col-xs-2" align="center" style="font-family:arial;">
                            ' . $post_desc . '
                           </td>
                            <td class="col-xs-1" align="center" style="font-family:arial;">
                            ' . $check_grid[$j]['0']['psc_dscr'] . '(Rs.
                                '.$check_grid[$j]['0']['psc_up_limit'].')
                           </td>
                            <td class="col-xs-1" align="center" style="font-family:arial;">'.$check_grid[$j]['0']['pv_no_of_post'].'</td>
                           <td class="col-xs-1" align="center" style="font-family:arial;">'.$check_grid[$j]['0']['code_text'].'</td>
                           <td class="col-xs-2" align="center" style="font-family:arial;">'.$check_grid[$j]['0']['medinstr_desc'].'</td>
                           <td class="col-xs-2" align="center" style="font-family:arial;">'.$subj .'</td>
                           <td class="col-xs-1" align="center" style="font-family:arial;">'.$check_grid[$j]['0']['acad'].'</td>
                           <td class="col-xs-1" align="center" style="font-family:arial;">'.$check_grid[$j]['0']['prof'].'</td>




                       </tr>';
               }
$html.=
        '
             
            </tbody>
        </table>

        <h3><p align="center" style="font-family:arial;font-weight:500">संस्थेचा प्रवर्गनिहाय अनुशेष खालीलप्रमाणे </p></h3>
        <table class="table-content2" cellspacing="1" cellpadding="0">
            <thead>
                <tr>
                    <th class="col-xs-2" style="font-family:arial;">प्रवर्ग</th>
                    <th class="col-xs-1" style="font-family:arial;">अनुसूचित जाती</th>
                    <th class="col-xs-1" style="font-family:arial;">अनुसूचित जमाती</th>
                    <th class="col-xs-1" style="font-family:arial;">वी.जा.अ</th>
                    <th class="col-xs-1" style="font-family:arial;">भ.ज.ब</th>
                    <th class="col-xs-1" style="font-family:arial;">भ.ज.क</th>
                    <th class="col-xs-1" style="font-family:arial;">भ.ज.ड</th>
                    <th class="col-xs-1" style="font-family:arial;">विशेष मागास प्रवर्ग</th>
                    <th class="col-xs-1" style="font-family:arial;">इतर मागास प्रवर्ग</th>
                    <th class="col-xs-2" style="font-family:arial;">सर्वसाधारण</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="col-xs-2" style="font-family:arial;">अनुशेष</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['ca_sc_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['ca_st_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['ca_vja_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['ca_ntb_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['ca_ntc_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['ca_ntd_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['ca_obc_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['ca_sbc_tot'].'</td>
                    <td class="col-xs-2" style="font-family:arial;">'.$check['0']['0']['ca_gen_tot'].'</td>
                </tr>
            </tbody>
        </table>
        
        <h3><p align="center" style="font_family:arial;font-weight:500">सामाजिक आरक्षणाचा तपशील खालीलप्रमाणे </p></h3>
        <table class="table-content2" cellspacing="1" cellpadding="0">
            <thead>
                <tr>
                    <th class="col-xs-2" rowspan="2" style="font-family:arial;">प्रवर्ग</th>
                    <th class="col-xs-1" rowspan="2" style="font-family:arial;">महिला</th>
                    <th class="col-xs-1" rowspan="2" style="font-family:arial;">स्वातंत्र्य सैनिक</th>
                    <th class="col-xs-1" rowspan="2" style="font-family:arial;">प्रकल्पग्रस्त</th>
                    <th class="col-xs-1" rowspan="2" style="font-family:arial;">माजी सैनिक </th>
                    <th class="col-xs-1" rowspan="2" style="font-family:arial;">भूकंपग्रस्त </th>
                    <th class="col-xs-3" colspan="3" style="font-family:arial;">शारीरिक अपंगत्व</th>
                    <th class="col-xs-1" rowspan="2" style="font-family:arial;">क्रीडा</th>
                    <th class="col-xs-1" rowspan="2" style="font-family:arial;">अंशकालीन</th>
                  
                </tr>
                <tr>
                    <th class="col-xs-1" style="font-family:arial;">अंध</th>
                    <th class="col-xs-1" style="font-family:arial;">मुकबधीर</th>
                    <th class="col-xs-1" style="font-family:arial;">अस्थिव्यंग</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="col-xs-2" style="font-family:arial;">राखीव जागा</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['soc_women_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['soc_ff_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['soc_proj_afct_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['soc_ex_srvc_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['soc_earth_qk_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['soc_pdb_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['soc_pdd_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['soc_pdo_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['soc_sports_tot'].'</td>
                    <td class="col-xs-1" style="font-family:arial;">'.$check['0']['0']['soc_anshk_tot'].'</td>
                    
                </tr>
            </tbody>
        </table>
        <br>
        <br>
 
       
       
        <h3 style="font-weight:500">सुचना :</h3>
        <p align="justify" style="font-family:arial;">
            1)	अनुदानित पदावरील नियुक्त केलेल्या शिक्षकास त्या पदानुसार शिक्षण सेवक योजना लागू राहील.<br>
            2)	विनानुदानित व अंशतः पदावरील नियुक्त केलेल्या शिक्षकास त्या त्या पदानुसार वेतनश्रेणी लागू राहील.<br>
            3)	इ.१ ली ते ८ वी च्या इयत्तांसाठी शिकविणाऱ्या शिक्षकांना TET (शिक्षक पात्रता परीक्षा) उत्तीर्ण असणे व अभियोग्यता व बुद्धिमत्ता परीक्षा दिलेली असणे आवश्यक आहे.<br>
            4)	इ.९ वी ते १२ वी च्या इयत्तांसाठी शिकविणाऱ्या शिक्षकांना अभियोग्यता व बुद्धिमत्ता परीक्षा दिलेली असणे आवश्यक आहे.<br>
            5)	इच्छुक व अर्हता प्राप्त उमेदवार जाहिरातीच्या अनुषंगाने आपल्या अभियोग्यता चाचणी मधील प्राप्त गुणांसह अर्ज करतील.<br>
            6)	वयोमर्यादा : <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A) प्राथमिक शिक्षक पदांसाठी : उमेदवार ज्या दिवशी अर्ज भरेल त्या दिवशी उमेदवाराचे किमान वय १८ वर्ष व कमाल वय ३८ वर्ष 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;राहील.मागासवर्ग उमेदवारांसाठी वयांची अट नियमानुसार शिथिल राहील.स्वातंत्र्य सैनिक,प्रकल्पग्रस्त,भूकंपग्रस्त,अंशकालीन 
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;उमेदवारांच्या बाबतीत वयोमर्यादा शासन निर्णयाचे तरतुदीनुसार शिथिलक्षम  राहील.<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B) माध्यामिक शिक्षक पदांसाठी : उमेदवार ज्या दिवशी अर्ज भरेल त्या दिवशी उमेदवाराचे किमान वय १८ वर्ष राहील.<br>
            7)	उच्च प्राथमिक व माध्यमिक शाळेतील गणित विषयांसाठी  भौतिक शास्त्र,गणित,रसायनशास्त्र (A ग्रुप),संख्याशास्त्र या विषयातील पदवीधर उमेदवार अर्ज करू शकतील.<br>
            8)	उच्च प्राथमिक व माध्यमिक शाळेतील  सामाजिक  शास्त्र या विषयासाठी इतिहास अथवा भूगोल या विषयातील पदवीधर उमेदवार अर्ज करु शकतील.<br>
            9)	अभियोग्यता व बुद्धिमत्ता चाचणीस गैरहजर असलेले तसेच चाचणीस ० गुण मिळालेल्या उमेदवाराला अर्ज करता येणार नाही.<br>

            </p>   
        

            <h3><p align="right" style="font-family:arial;font-weight:300;"><br><br><br>
            सही व दिनांक <br>
           (संस्थे करीता)
            </p></h3>
       
      
        

    </body>
</html>';





$mpdf = new mPDF('utf-8', 'A4', '0', '0', '30');
$mpdf->watermarkTextAlpha = 0.150;
//$mpdf->SetWatermarkText('Pavitra'.$global_ac_year.'');
$mpdf->showWatermarkText = true;



//$mpdf->SetWatermarkImage('../images/image.png');

$mpdf->showWatermarkImage = true;
$mpdf->autoScriptToLang = true;
$mpdf->baseScript = 1;
$mpdf->autoVietnamese = true;
$mpdf->autoArabic = true;
$mpdf->autoLangToFont = true;


$mpdf->WriteHTML($html);
ob_clean(); 
$mpdf->Output();
exit;
?>