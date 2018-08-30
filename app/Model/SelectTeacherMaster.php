<?php

class SelectTeacherMaster extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "SelectTeacherMaster";
    var $useTable = 'tch_master'; //db=Teacher schema=master
    public $virtualFields = array('tech_id_sch_id' => 'CONCAT(tchr_id|| \'-\' ||schl_cd_udise|| \'-\' ||tchr_cd_shalarath|| \'-\' ||tchr_cd_udise)'); //Cddir.=model name
    public $virtualField = array('tchr_full_name' => 'CONCAT(tch_master.tchr_fname|| \'-\' ||tch_master.tchr_mname|| \'-\' ||tch_master.tchr_lname)'); //Cddir.=model name

    public function getTeacherAllInformation1234($beo_code, $seletedSchoolCdUnderPost, $post_id, $post_type) {
        $query = " SELECT *  
                 FROM      master.tch_master     
                 LEFT JOIN master.tchr_post_master
ON
                     tch_master.tchr_type=tchr_post_master.post_type
                 AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id  
                 
                 LEFT JOIN stat_data.st_samayojan
ON
                 tch_master.tchr_type=st_samayojan.posttype
            AND  tch_master.schl_id =st_samayojan.schcd
             AND tch_master.tchr_curr_desg_cd = st_samayojan.postid  

             WHERE  schl_id='" . $seletedSchoolCdUnderPost . "'   AND tch_master.tchr_curr_desg_cd = $post_id
                 AND  tch_master.tchr_type = " . $post_type . "
                 AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
        ORDER BY tchr_edu_entry_dt  DESC
                 ";
//          where schl_id='" . $schl_id . "'
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getTchrInfoPersonal($tchr_mst_id, $schl_cd_shalarath, $tchr_type_master) {
        $query = "SELECT *
                 FROM master.tch_master,master.tchr_post_master
                 where schl_id='" . $schl_cd_shalarath . "'
                 AND tchr_id='" . $tchr_mst_id . "'
                 AND tchr_post_master.post_type ='" . $tchr_type_master . "'  
                 AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
                 "; // posttype 1=Teaching 2=Non-Teaching
//        echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function duplicateRecruitmentTchr($tchr_fname = '', $tchr_mname = '', $tchr_lname = '', $tchr_birth_dt = '', $tchr_gender = '', $tchr_type = '') {
        $query = "SELECT * FROM master.tch_master
              where (
                 (lower(tchr_fname) like '$tchr_fname%')
             and  (lower(tchr_mname) like '$tchr_mname%')
             and  (lower(tchr_lname) like '$tchr_lname%'))
              and tchr_birth_dt = '$tchr_birth_dt'
              and tchr_gender ='$tchr_gender'
                   and tchr_type = $tchr_type
                 "; // posttype 1=Teaching 2=Non-Teaching
//        echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPay($tchr_mst_id, $schl_cd, $tchr_type_master) {
        $query = "SELECT *
                 FROM master.tch_master,master.tchr_post_master,master.tchr_pay_pf_gis
                 where schl_id='" . $schl_cd . "'
                 AND tch_master.tchr_id='" . $tchr_mst_id . "'
                 AND tchr_post_master.post_type ='" . $tchr_type_master . "'  
                 AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
                 AND  tch_master.tchr_id = tchr_pay_pf_gis.tchr_id
                 "; // posttype 1=Teaching 2=Non-Teaching
// echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

//    public function getTchrInfoPersonalPay($tchr_mst_id, $tchr_type_master) {
//        $query = "Select tch_master.*,tchr_post_master.post_desc,tchr_pay_pf_gis.*,pay_scale.*,master.pf_agency_mast.*,tchr_pay_pf_gis.asst_flag as asst,
//                cddir_1.code_text as Current_Posting_Mode ,cddir_2.code_text as Pay_Commission, cddir_3.code_text as GIS_Applicable , cddir_4.code_text as Current_GIS_Group
//         FROM
//                         master.tch_master
//         LEFT JOIN    master.tchr_post_master
//          ON        tch_master.tchr_type=tchr_post_master.post_type
//                    AND tchr_post_master.post_type ='" . $tchr_type_master . "'  
//                     AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
//
//         LEFT JOIN    master.tchr_pay_pf_gis
//          ON         tch_master.tchr_id=tchr_pay_pf_gis.tchr_id  
//
//         LEFT JOIN  master.pay_scale
//         ON      tchr_pay_pf_gis.tp_pay_scale_cd = pay_scale.psc_scale_cd
//             AND tchr_pay_pf_gis.tp_pay_com_cd = pay_scale.psc_paycomm_cd
//
//         LEFT JOIN master.pf_agency_mast
//         ON   (tchr_pay_pf_gis.tp_acct_type = pf_agency_mast.pf_type)
//         AND   (tchr_pay_pf_gis.tp_acct_maint = pf_agency_mast.pf_agency)
//
//         LEFT JOIN master.cddir as cddir_1
//         ON (tch_master.tchr_curr_post_mode=cddir_1.code_value and cddir_1.code_type='MP')
//
//         LEFT JOIN master.cddir as cddir_2
//         ON (tchr_pay_pf_gis.tp_pay_com_cd=CAST(cddir_2.code_value as numeric) and cddir_2.code_type='PC')
//
//         LEFT JOIN master.cddir as cddir_3
//         ON (tchr_pay_pf_gis.tp_gis_appl=cddir_3.code_value and cddir_3.code_type='GA')
//         
//         LEFT JOIN master.cddir as cddir_4
//         ON (tchr_pay_pf_gis.tp_gis_group=cddir_4.code_value  and cddir_4.code_type='GG')
//
//         WHERE
//         
//                 tch_master.tchr_id='" . $tchr_mst_id . "'
//         order by tch_master.tchr_id"; // posttype 1=Teaching 2=Non-Teaching AND tch_master.asst_flag='F'
////        echo $query;exit();
//        $result = $this->query($query);
//        if ($result <> NULL) {
//            return $result;
//        } else {
//            return 0;
//        }
//    }

    public function getTchrInfoPersonalPay($tchr_mst_id, $tchr_type_master) {
        $query = "Select tch_master.*,tchr_post_master.post_desc
         FROM
                         master.tch_master
         LEFT JOIN    master.tchr_post_master
          ON        tch_master.tchr_type=tchr_post_master.post_type
                    AND tchr_post_master.post_type ='" . $tchr_type_master . "'  
                     AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
         WHERE
                 tch_master.tchr_id='" . $tchr_mst_id . "'
                     and  tch_master.asst_flag='F'
         order by tch_master.tchr_id"; // posttype 1=Teaching 2=Non-Teaching AND tch_master.asst_flag='F'
//        echo $query;exit();
        $result = $this->query($query);
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getTchrInfoPersonalPayT($tchr_mst_id, $tchr_type_master) {
        $query = "Select tch_master.*,tchr_post_master.post_desc,tchr_pay_pf_gis.*,pay_scale.*,master.pf_agency_mast.*,tchr_pay_pf_gis.asst_flag as asst,
                cddir_1.code_text as Current_Posting_Mode ,cddir_2.code_text as Pay_Commission, cddir_3.code_text as GIS_Applicable , cddir_4.code_text as Current_GIS_Group
         FROM
                         master.tch_master
         LEFT JOIN    master.tchr_post_master
          ON        tch_master.tchr_type=tchr_post_master.post_type
                    AND tchr_post_master.post_type ='" . $tchr_type_master . "'  
                     AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id

         LEFT JOIN    master.tchr_pay_pf_gis
          ON         tch_master.tchr_id=tchr_pay_pf_gis.tchr_id  

         LEFT JOIN  master.pay_scale
         ON      tchr_pay_pf_gis.tp_pay_scale_cd = pay_scale.psc_scale_cd
             AND tchr_pay_pf_gis.tp_pay_com_cd = pay_scale.psc_paycomm_cd

         LEFT JOIN master.pf_agency_mast
         ON   (tchr_pay_pf_gis.tp_acct_type = pf_agency_mast.pf_type)
         AND   (tchr_pay_pf_gis.tp_acct_maint = pf_agency_mast.pf_agency)

         LEFT JOIN master.cddir as cddir_1
         ON (tch_master.tchr_curr_post_mode=cddir_1.code_value and cddir_1.code_type='MP')

         LEFT JOIN master.cddir as cddir_2
         ON (tchr_pay_pf_gis.tp_pay_com_cd=CAST(cddir_2.code_value as numeric) and cddir_2.code_type='PC')

         LEFT JOIN master.cddir as cddir_3
         ON (tchr_pay_pf_gis.tp_gis_appl=cddir_3.code_value and cddir_3.code_type='GA')
         
         LEFT JOIN master.cddir as cddir_4
         ON (tchr_pay_pf_gis.tp_gis_group=cddir_4.code_value  and cddir_4.code_type='GG')

         WHERE
         
                 tch_master.tchr_id='" . $tchr_mst_id . "'
         order by tch_master.tchr_id"; // posttype 1=Teaching 2=Non-Teaching AND tch_master.asst_flag='F'
//        echo $query;exit();
        $result = $this->query($query);
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

//    public function getTchrInfoPersonalPayFwd($schcd) {
//// //AND  tchr_type='1'
//        $query = "Select tch_master.*,tchr_post_master.post_desc,tchr_pay_pf_gis.*,pay_scale.*,master.pf_agency_mast.*,
//       cddir_1.code_text as Current_Posting_Mode ,cddir_2.code_text as Pay_Commission, cddir_3.code_text as GIS_Applicable
//FROM
//        master.tch_master
//LEFT JOIN    master.tchr_post_master
// ON        tch_master.tchr_type=tchr_post_master.post_type
//        AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
//
//LEFT JOIN    master.tchr_pay_pf_gis
// ON         tch_master.tchr_id=tchr_pay_pf_gis.tchr_id  
//
//LEFT JOIN  master.pay_scale
//ON      tchr_pay_pf_gis.tp_pay_scale_cd = pay_scale.psc_scale_cd
//    AND tchr_pay_pf_gis.tp_pay_com_cd = pay_scale.psc_paycomm_cd
//
//LEFT JOIN master.pf_agency_mast
//ON   (tchr_pay_pf_gis.tp_acct_type = pf_agency_mast.pf_type)
//AND   (tchr_pay_pf_gis.tp_acct_maint = pf_agency_mast.pf_agency)
//
//LEFT JOIN master.cddir as cddir_1
//ON (tch_master.tchr_curr_post_mode=cddir_1.code_value and cddir_1.code_type='MP')
//
//LEFT JOIN master.cddir as cddir_2
//ON (tchr_pay_pf_gis.tp_pay_com_cd=CAST(cddir_2.code_value as numeric) and cddir_2.code_type='PC')
//
//LEFT JOIN master.cddir as cddir_3
//ON (tchr_pay_pf_gis.tp_gis_appl=cddir_3.code_value and cddir_3.code_type='GA')
//
//WHERE
//    tch_master.schl_id='" . $schcd . "'
//            AND tchr_pay_pf_gis.asst_flag='E'  AND tch_master.asst_flag='U' AND tch_master.tchr_serv_entry_dt is not null AND tchr_pay_pf_gis.tp_pay_com_cd is not null
//order by tch_master.tchr_id"; // posttype 1=Teaching 2=Non-Teaching  AND tch_master.asst_flag='U'
////        echo "" . $query; exit();
//        $result = $this->query($query);
//        if ($result <> NULL)
//            return $result;
//        else {
////$result=0;
//            return 0;
//        }
//    }



    public function getTchrInfoPersonalPayFwd($schcd) {
// //AND  tchr_type='1'
        $query = "Select tch_master.*,tchr_post_master.post_desc
FROM
        master.tch_master
LEFT JOIN    master.tchr_post_master
 ON        tch_master.tchr_type=tchr_post_master.post_type
        AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
 
WHERE
    tch_master.schl_id='" . $schcd . "'  AND  tch_master.asst_flag='U' AND tch_master.tchr_serv_entry_dt is not null
order by tch_master.tchr_fname"; // posttype 1=Teaching 2=Non-Teaching  AND tch_master.asst_flag='U'
//        echo "" . $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportTypeM($schl_id = '', $tchr_type = '') {
        $query = "SELECT *
                FROM master.tch_master
                WHERE schl_id='" . $schl_id . "'
                AND tch_master.tchr_type='" . $tchr_type . "'
                AND tch_master.asst_flag='M'
                 "; // posttype 1=Teaching 2=Non-Teaching
//        echo "" . $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportAllM($schl_id = '') {
        $query = "SELECT *
                 FROM master.tch_master
                 WHERE schl_id='" . $schl_id . "'
                     AND tch_master.asst_flag='M'
                 "; // posttype 1=Teaching 2=Non-Teaching
//        echo "" . $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportTypeUFV($schl_id = '', $tchr_type = '', $asst_flag = '') {
        $query = "SELECT *
                 FROM master.tch_master,master.tchr_post_master
                 where schl_id='" . $schl_id . "'
                     AND tch_master.tchr_type='" . $tchr_type . "'
                 AND tchr_post_master.post_type ='" . $tchr_type . "'
                 AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
                 AND tch_master.asst_flag='" . $asst_flag . "'
                 "; // posttype 1=Teaching 2=Non-Teaching
//        echo "" . $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportTypeMHeadMaster($schl_id = '', $tchr_type = '') {
        $query = "SELECT *
                FROM master.tch_master
                WHERE schl_id='" . $schl_id . "'
                AND tch_master.tchr_type='" . $tchr_type . "'
                AND tch_master.asst_flag='M'
                 "; // posttype 1=Teaching 2=Non-Teaching
//        echo "" . $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportTypeUFVHeadMaster($schl_id = '', $tchr_type = '', $asst_flag = '') {
        $query = "SELECT *
                 FROM master.tch_master,master.tchr_post_master
                 where schl_id='" . $schl_id . "'
                     AND tch_master.tchr_type='" . $tchr_type . "'
                 AND tchr_post_master.post_type ='" . $tchr_type . "'
                 AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
                 AND tch_master.asst_flag='" . $asst_flag . "'
                 "; // posttype 1=Teaching 2=Non-Teaching
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportTypeUFVHeadMasterWR($schl_id = '', $tchr_type = '', $asst_flag = '') {

        $query1 = "SELECT *
                 FROM master.tch_master,master.tchr_post_master
                 where schl_id='" . $schl_id . "'
                     AND tch_master.tchr_type='" . $tchr_type . "'
                 AND tchr_post_master.post_type ='" . $tchr_type . "'
                 AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
                 AND tch_master.asst_flag = 'R'
                 "; // posttype 1=Teaching 2=Non-Teaching
        $query2 = "SELECT *
                FROM master.tch_master
                WHERE schl_id='" . $schl_id . "'
                AND tch_master.tchr_type='" . $tchr_type . "'
                AND tch_master.asst_flag='W'
                 "; // posttype 1=Teaching 2=Non-Teaching
//        echo "<br>" . $query1;
//        echo "<br>" . $query2;
//        exit();
        $result1 = $this->query($query1);
        $result2 = $this->query($query2);
        $result = (array_merge($result1, $result2));

        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportAllUFV($schl_id = '', $asst_flag = '') {
        $query = "SELECT *
                 FROM master.tch_master,master.tchr_post_master
                 where schl_id='" . $schl_id . "'
                     AND tch_master.asst_flag='" . $asst_flag . "'
                      AND tch_master.tchr_type=tchr_post_master.post_type
                        AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
                 "; // posttype 1=Teaching 2=Non-Teaching
//  AND tchr_post_master.post_type ='" . $tchr_type . "'
//        echo "" . $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportTypeMUFVAll($schl_id = '', $tchr_type = '') {
        $query = "SELECT  *
            FROM master.tch_master
            LEFT JOIN master.tchr_post_master
            ON tch_master.tchr_type=tchr_post_master.post_type
            AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
            WHERE  schl_id='" . $schl_id . "'
             AND tch_master.tchr_type='" . $tchr_type . "'
            AND tch_master.asst_flag IN('M','W','U','F','R','V')
            order by tchr_type";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportAllMUFVAll($schl_id = '') {
        $query = "SELECT  *
            FROM master.tch_master
            LEFT JOIN master.tchr_post_master
            ON tch_master.tchr_type=tchr_post_master.post_type
            AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
            WHERE  schl_id='" . $schl_id . "'
            AND tch_master.asst_flag IN('M','W','U','F','R','V')
            order by tchr_type";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportTypeMUFVAllHeadMaster($schl_id = '', $tchr_type = '') {
        $query = "SELECT  *
            FROM master.tch_master
            LEFT JOIN master.tchr_post_master
            ON tch_master.tchr_type=tchr_post_master.post_type
            AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
            WHERE  schl_id='" . $schl_id . "'
             AND tch_master.tchr_type='" . $tchr_type . "'
            AND tch_master.asst_flag IN('M','W','U','F','R','V')
            order by tchr_type";
//        echo "" . $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportAllMUFVAllHeadMaster($schl_id = '') {
        $query = "SELECT  *
            FROM master.tch_master
            LEFT JOIN master.tchr_post_master
            ON tch_master.tchr_type=tchr_post_master.post_type
            AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
            WHERE  schl_id='" . $schl_id . "'
            AND tch_master.asst_flag IN('M','W','U','F','R','V')
            order by tchr_type";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportType($schl_id = '', $tchr_type = '', $asst_flag = '') {
        $query = "SELECT *
                 FROM master.tch_master,master.tchr_post_master
                 where schl_id='" . $schl_id . "'
                     AND tch_master.tchr_type='" . $tchr_type . "'
                 AND tchr_post_master.post_type ='" . $tchr_type . "'
                 AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
                 AND tch_master.asst_flag='" . $asst_flag . "'
                 "; // posttype 1=Teaching 2=Non-Teaching
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalReportAll($schl_id = '', $asst_flag = '') {
        $query = "SELECT *
                 FROM master.tch_master,master.tchr_post_master
                 where schl_id='" . $schl_id . "'
                     AND tch_master.asst_flag='" . $asst_flag . "'
                      AND tch_master.tchr_type=tchr_post_master.post_type
                        AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
                 "; // posttype 1=Teaching 2=Non-Teaching
//  AND tchr_post_master.post_type ='" . $tchr_type . "'
//        echo "" . $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPersonalFwdAll($tchr_mst_id, $tchr_type_master) {
        $query = "SELECT *
                 FROM master.tch_master,master.tchr_post_master
                 where  tchr_id='" . $tchr_mst_id . "'
                 AND tchr_post_master.post_type ='" . $tchr_type_master . "'  
                 AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
                 "; // posttype 1=Teaching 2=Non-Teaching
//        echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getTchrInfoPayPfFwdAll($tchr_mst_id, $tchr_type_master) {
        $query = "Select tch_master.*,tchr_post_master.post_desc,tchr_pay_pf_gis.*,pay_scale.*,master.pf_agency_mast.*,
                cddir_1.code_text as Current_Posting_Mode ,cddir_2.code_text as Pay_Commission, cddir_3.code_text as GIS_Applicable , cddir_4.code_text as Current_GIS_Group
         FROM
                         master.tch_master
         LEFT JOIN    master.tchr_post_master
          ON        tch_master.tchr_type=tchr_post_master.post_type
                    AND tchr_post_master.post_type ='" . $tchr_type_master . "'  
                     AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id

         LEFT JOIN    master.tchr_pay_pf_gis
          ON         tch_master.tchr_id=tchr_pay_pf_gis.tchr_id  

         LEFT JOIN  master.pay_scale
         ON      tchr_pay_pf_gis.tp_pay_scale_cd = pay_scale.psc_scale_cd
             AND tchr_pay_pf_gis.tp_pay_com_cd = pay_scale.psc_paycomm_cd

         LEFT JOIN master.pf_agency_mast
         ON   (tchr_pay_pf_gis.tp_acct_type = pf_agency_mast.pf_type)
         AND   (tchr_pay_pf_gis.tp_acct_maint = pf_agency_mast.pf_agency)

         LEFT JOIN master.cddir as cddir_1
         ON (tch_master.tchr_curr_post_mode=cddir_1.code_value and cddir_1.code_type='MP')

         LEFT JOIN master.cddir as cddir_2
         ON (tchr_pay_pf_gis.tp_pay_com_cd=CAST(cddir_2.code_value as numeric) and cddir_2.code_type='PC')

         LEFT JOIN master.cddir as cddir_3
         ON (tchr_pay_pf_gis.tp_gis_appl=cddir_3.code_value and cddir_3.code_type='GA')
         
         LEFT JOIN master.cddir as cddir_4
         ON (tchr_pay_pf_gis.tp_gis_group=cddir_4.code_value  and cddir_4.code_type='GG')

         WHERE
                 tch_master.tchr_id='" . $tchr_mst_id . "'
         order by tch_master.tchr_id"; // posttype 1=Teaching 2=Non-Teaching AND tch_master.asst_flag='F'
// posttype 1=Teaching 2=Non-Teaching  AND tch_master.asst_flag='U'

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function get() {
        $query = "Select MAX(CAST(tchr_id  as integer)) from master.tch_master";

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getflag() {
        $flag = $this->query("SELECT schl_id FROM  master.tch_master where asst_flag='F';");
        return($flag);
    }

    public function getschcodeAllCluster($clucd) {
        $query = "SELECT distinct(schl_id) FROM  master.tch_master where asst_flag='T' and schl_id like '$clucd%'";
//        echo "" . $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getschcodeAllT($clucd) {
        $query = "Select distinct(tch_master.schl_id),shala_all_school.school_name
         FROM
                         master.tch_master
         LEFT JOIN    shala.shala_all_school
          ON         tch_master.schl_id=shala_all_school.schcd   
         WHERE
                 shala_all_school.clucd='$clucd'
                    AND  tch_master.asst_flag='T'
                     order by shala_all_school.school_name";

//        $query = "SELECT distinct(schl_id), FROM  master.tch_master where asst_flag='T' and schl_id like '$clucd%'";
//        echo "" . $query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getflagall($clucd) {
        $clucd = substr($clucd, 0, 6);
        $query = "SELECT DISTINCT schl_id FROM  master.tch_master where asst_flag='F' and schl_id like '$clucd%'";
//         echo  " ".$query; exit();
        $flag = $this->query($query);
        if ($flag <> NULL)
            return $flag;
        else {
            return 0;
        }
    }

    public function getflagPayPf() {
        $flag = $this->query("SELECT schl_id FROM  master.tch_master where asst_flag='F';");
        return($flag);
    }

    public function chkflag($test) {
        $chkdata = $this->query("SELECT schl_cd_udise FROM  master.tch_master where asst_flag='F'  AND schl_cd_udise LIKE '$test%';");
        return($chkdata);
    }

    public function chkw($id) {
        $flag = $this->query("SELECT schl_cd_udise FROM  master.tch_master where asst_flag='W' ;");
        return($flag);
    }

    public function getschcode() {
        $schcodeudise = $this->query("SELECT schl_cd_udise FROM  master.tch_master where asst_flag='F';");
        return( $schcodeudise);
    }

    public function getschcodeall() {
        $schcodeudise = $this->query("SELECT asst_auth FROM  master.tch_master where asst_flag='F';");
        return( $schcodeudise);
    }

    public function getschwcode() {
        $wschcodeudise = $this->query("SELECT schl_cd_udise FROM  master.tch_master where asst_flag='W';");
        return( $wschcodeudise);
    }

    public function gettchpersonallist($tchcdw) {
//echo "".$tchcdw;exit();
        $teachrwdata = $this->query("SELECT tchr_pay_pf_gis.*,tch_master.*  FROM master.tch_master JOIN master.tchr_pay_pf_gis ON tch_master.tchr_id = tchr_pay_pf_gis.tchr_id AND tch_master.schl_id='$tchcdw' AND tchr_pay_pf_gis.asst_flag='F';");
        return($teachrwdata);
    }

    public function gettchpersonallist1($tchcdw) {
//echo "".$tchcdw;exit();
        $teachrwdata = $this->query("SELECT * FROM master.tch_master where schl_id='$tchcdw' AND asst_flag='F' and tchr_serv_entry_dt is not null;");
        return($teachrwdata);
    }

    public function getflagT() {
        $clucd = substr($clucd, 0, 6);
//        $query = "SELECT schl_id FROM  master.tch_master where worked_as_para='Y' and  schl_id like '$clucd%'";
        $query = "SELECT schl_id FROM  master.tch_master where asst_flag='T'";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }

        $flag = $this->query(";");
        return($flag);
    }

    public function gettchllist($tchcdw) {
        try {
            $query = "SELECT tchr_pay_pf_gis.*,tch_master.*  FROM master.tch_master JOIN master.tchr_pay_pf_gis ON tch_master.tchr_id = tchr_pay_pf_gis.tchr_id AND tch_master.schl_id='$tchcdw' AND tch_master.asst_flag='F'";
            $teachrwdata = $this->query($query);
            if ($teachrwdata <> NULL)
                return $teachrwdata;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function selectteacher($tchr_id) {
        $flag = $this->query("SELECT * FROM  master.tch_master where tchr_id='$tchr_id';");
        return($flag);
    }

    public function gettchwdata($tchcdw) {
        $teachrwdata = $this->query("SELECT tchr_fname,tchr_mname,tchr_lname,tchr_id,schl_id,tchr_slno_udise,tchr_sanch_year,schl_cd_udise,tchr_cd_shalarath FROM  master.tch_master where asst_flag='W' AND schl_cd_udise LIKE '$tchcdw%';");
        return($teachrwdata);
    }

    public function checkPersonalFowardCondition($schcd, $tchr_id) {
        try {
            $query = "SELECT *
                FROM master.tch_master,master.tchr_entry_status
                where
            tch_master.tchr_id = tchr_entry_status.tchr_id
            AND tch_master.schl_id='" . $schcd . "'
            AND tch_master.tchr_id='" . $tchr_id . "'
            AND tch_master.asst_flag = 'U'
            AND tchr_serv_entry_dt is not null
              AND tchr_entry_status.de_personal = 'Y'
                "; // posttype 1=Teaching 2=Non-Teaching
//        echo "".$query;exit();
            $result = $this->query($query);
            if ($result != NULL)
                return 1;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function listForVerify() {
        try {
            $query = "SELECT *
                FROM master.tch_master ,tchr_entry_status
                where tchr_entry_status.de_cluster_fwd = 'F'
                AND tch_master.tchr_id= tchr_entry_status.tchr_id"; // posttype 1=Teaching 2=Non-Teaching
//            echo "" . $query;   tch_master.asst_flag = 'F'  
//                AND
//            exit();

            $result = $this->query($query);

            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

//    public function getschcodeforpara($clucd) {
//        $clucd = substr($clucd, 0, 6);
//        $query = "SELECT schl_id FROM  master.tch_master where worked_as_para='Y' and  schl_id like '$clucd%'";
////         echo  " ".$query; exit();
//        $schcodeudise = $this->query($query);
//        if ($schcodeudise <> NULL)
//            return($schcodeudise);
//        else {
//            return 0;
//        }
//    }
//
//    public function getparateacherlist($schl_id) {
//        $query = "SELECT * FROM master.tch_master where schl_id='$schl_id' AND worked_as_para='Y'";
////         echo  " ".$query; exit();
//        $teachrwdata = $this->query($query);
//        if ($teachrwdata <> NULL)
//            return($teachrwdata);
//        else {
//            return 0;
//        }
//    }
//    
//    
//    
//     public function getParaTecherInfo($tchr_id, $tchr_type) {
//        
//           $query = "SELECT *
//                 FROM master.tch_master,master.tchr_post_master
//                 where tchr_id='" . $tchr_id . "'
//                 AND tchr_post_master.post_type ='" . $tchr_type . "'  
//                 AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id
//                 "; // posttype 1=Teaching 2=Non-Teaching
////        echo "".$query;exit();
//        $result = $this->query($query);
//        if ($result <> NULL)
//            return $result;
//        else {
//            return 0;
//        }
//    }

    public function getschcodeforpara($clucd) {

        $query = "Select tch_master.*,tchr_post_master.post_desc,
                    shala_all_school.school_name,shala_all_school.schcd
         FROM
                         master.tch_master
         LEFT JOIN    master.tchr_post_master
          ON        tch_master.tchr_type=tchr_post_master.post_type  
                     AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id

         LEFT JOIN    shala.shala_all_school
          ON         tch_master.schl_id=shala_all_school.schcd   
         WHERE
                 shala_all_school.clucd='$clucd'
                    AND  tch_master.worked_as_para='Y'
                     order by shala_all_school.school_name "; // posttype 1=Teaching 2=Non-Teaching
//        echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getschtotalforparacluster($clucd) {

        $query = "Select  count(tch_master.tchr_id) as totalParaTeacherCluster
         FROM
                         master.tch_master
         LEFT JOIN    master.tchr_post_master
          ON        tch_master.tchr_type=tchr_post_master.post_type  
                     AND tch_master.tchr_curr_desg_cd = tchr_post_master.post_id

         LEFT JOIN    shala.shala_all_school
          ON         tch_master.schl_id=shala_all_school.schcd   
         WHERE
                 shala_all_school.clucd='$clucd'
                    AND  tch_master.worked_as_para='Y' "; // posttype 1=Teaching 2=Non-Teaching
//        echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getschcodeforparabeo($cluCd) {
        $query = "SELECT schl_id FROM  master.tch_master where worked_as_para='Y' and  schl_id like '$cluCd%'";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getschtotalforparabeo($cluCd) {
        $query = "SELECT count(tchr_id) as totalParaTeacherBeo FROM  master.tch_master where worked_as_para='Y' and  schl_id like '$cluCd%'";
//        echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getschcodeforparaeoprimary($eoCd) {
        $query = "SELECT distinct(schl_id) FROM  master.tch_master where worked_as_para='Y' and  schl_id like '$eoCd%'";
//            echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getschtotalforparaeoprimary($eoCd) {
        $query = "SELECT count(tchr_id) as totalParaTeacherEoPrimary FROM master.tch_master where worked_as_para='Y' and  schl_id like '$eoCd%'";
//        echo "".$query;exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function reject_return_pay_pf_tchr_list_beo($school_code) {
        try {
            $query = "select distinct(tchr_id),tchr_type,tchr_fname,tchr_mname,tchr_lname,asst_flag
                        from master.tch_master
                        where schl_id='" . $school_code . "'
                        and  asst_flag='T'  
                        order by tchr_fname";
//        echo "".$query;exit();
            $result = $this->query($query);
            if ($result != NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getAllSchoolWithTFlag($beo_cd) {
        try {
            $query = "SELECT schl_id FROM  master.tch_master where asst_flag='T' and schl_id like '$beo_cd%'";
//        echo "".$query;exit();
            $result = $this->query($query);
            if ($result != NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function gettchs($typ, $schcd) {
        try {
            $query = "SELECT tchr_id, tchr_fname,
                      tchr_mname, tchr_lname
                      FROM master.tch_master
                      where tchr_type='" . $typ . "'
                      and schl_id='" . $schcd . "'
                      and tchr_id not in (select tchr_id from master.change_mast where change_type='ST');";

            $result = $this->query($query);

            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getPostwiseInfoForAcceptAndExcess($schcd) {
        try {
            $query = "SELECT schl_id,posttype,postid,post_desc 
            FROM(
            (SELECT   ssp.schcd as schl_id,ssp.posttype, ssp.postid,  spm.post_desc     
                                  
             FROM udise.sanch_sanction_post as ssp
             LEFT JOIN udise.shala_post_master as spm ON  ssp.posttype =spm.post_type AND  ssp.postid =spm.post_id
             WHERE  schcd = '" . $schcd . "'  and ac_year='2016-17'

                           UNION
                   (SELECT   tm.schl_id,tm.tchr_type,tm.tchr_curr_desg_cd,tpm.post_desc 
                     FROM master.tch_master  as tm
                     LEFT JOIN    master.tchr_post_master as tpm   ON  tm.tchr_type=tpm.post_type     AND tm.tchr_curr_desg_cd = tpm.post_id
                     WHERE   tm.schl_id = '" . $schcd . "'
                     GROUP BY tm.tchr_type , tm.tchr_curr_desg_cd, tpm.post_desc,tm.schl_id)
                     ) as tmp
                     GROUP BY posttype,postid,post_desc,schl_id
                     order by posttype,postid";

//            echo "".$query;exit();
//count(tm.tchr_id) as tot_master

            $result = $this->query($query);
            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getPerticularPostwiseInfoForAcceptAndExcess($schl_id, $tchr_type, $designation_cd) {
        try {
            $query = "SELECT schl_id,posttype,postid,post_desc,  
                                 SUM(samayojan_flag_master)samayojan_flag_master                                 
            FROM(
                            (SELECT   ssp.schcd as schl_id,ssp.posttype, ssp.postid,  spm.post_desc,    
                                        0 as samayojan_flag_master
                                    FROM udise.sanch_sanction_post as ssp
                                    LEFT JOIN udise.shala_post_master as spm ON  ssp.posttype =spm.post_type AND  ssp.postid =spm.post_id
                                    WHERE  schcd = '" . $schl_id . "' AND ssp.posttype = $tchr_type AND postid = $designation_cd  AND ac_year = '2016-17'
                             )

                           UNION
                   (SELECT   tm.schl_id,tm.tchr_type,tm.tchr_curr_desg_cd,tpm.post_desc,  
                           sum( CASE WHEN samayojan_flag ='A' THEN 1 ELSE 0 END)as samayojan_flag_master
                     FROM master.tch_master  as tm
                     LEFT JOIN    master.tchr_post_master as tpm   ON  tm.tchr_type=tpm.post_type     AND tm.tchr_curr_desg_cd = tpm.post_id
                     WHERE   tm.schl_id = '" . $schl_id . "' AND tm.tchr_type = $tchr_type AND tm.tchr_curr_desg_cd = $designation_cd
                     GROUP BY tm.tchr_type,tm.tchr_curr_desg_cd,tpm.post_desc,tm.schl_id)
                     ) as tmp
                     GROUP BY posttype,postid,post_desc,schl_id
                     order by posttype,postid";

//            echo "".$query;exit();
//count(tm.tchr_id) as tot_master

            $result = $this->query($query);
            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getteacherListForAcceptAndExcess($schl_id, $tchr_type, $designation_cd, $post_managment_type, $tchr_TotalSanctioned_post, $tchr_TotalWorking_post) {
        try {
            $query = "SELECT *  FROM master.tch_master as tm
                    LEFT JOIN    master.tchr_post_master as tpm
                    ON  tm.tchr_type=tpm.post_type AND tm.tchr_curr_desg_cd = tpm.post_id
                     LEFT JOIN master.cddir as cdd
                    ON (tm.tchr_mgmt_type = CAST(cdd.code_value as integer)  and cdd.code_type='TM')
                    WHERE tm.schl_id = '" . $schl_id . "'
                        AND tm.tchr_type = '" . $tchr_type . "'
                        AND tm.tchr_curr_desg_cd = '" . $designation_cd . "'
                        AND tm.tchr_mgmt_type = $post_managment_type ";
//            echo "" . $query;  exit();

            $result = $this->query($query);
            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getAcceptedSurplusTeacherMaster($schcd) {
        $query = "Select tm.*,tpm.post_desc
                FROM
                            master.tch_master as tm
                LEFT JOIN   master.tchr_post_master as tpm
                ON       tm.tchr_type=tpm.post_type
                      AND  tm.tchr_curr_desg_cd = tpm.post_id
                WHERE
                           tm.schl_id='" . $schcd . "'  
                      AND  tm.tchr_serv_entry_dt is not null
                      AND  tm.samayojan_flag = 'A'
                ORDER BY tpm.post_desc"; // posttype 1=Teaching 2=Non-Teaching  AND tch_master.asst_flag='U'
        echo "" . $query;
        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getAllPostwiseInfoForAcceptAndExcess($schl_id, $tchr_type = 1) {
        try {
            $query = "SELECT schl_id,posttype,postid,post_desc,  
                                 SUM(aided_samayojan_flag_master)aided_samayojan_flag_master,
                                  SUM(partpaided_samayojan_flag_master)partpaided_samayojan_flag_master,
                                   SUM(unaided_samayojan_flag_master)unaided_samayojan_flag_master,
                                    SUM(perunaided_samayojan_flag_master)perunaided_samayojan_flag_master,
                                     SUM(sf_samayojan_flag_master)sf_samayojan_flag_master,
                                    SUM(aided_samayojan_fwd_flag_master)aided_samayojan_fwd_flag_master,
                                    SUM(partpaided_samayojan_fwd_flag_master)partpaided_samayojan_fwd_flag_master,
                                    SUM(unaided_samayojan_fwd_flag_master)unaided_samayojan_fwd_flag_master,
                                    SUM(perunaided_samayojan_fwd_flag_master)perunaided_samayojan_fwd_flag_master,
                                    SUM(sf_samayojan_fwd_flag_master)sf_samayojan_fwd_flag_master
                     FROM(
                     (SELECT   ssp.schcd as schl_id,ssp.posttype, ssp.postid,  spm.post_desc,  
                                        0 as aided_samayojan_flag_master,0 as partpaided_samayojan_flag_master,0 as unaided_samayojan_flag_master,0 as perunaided_samayojan_flag_master,0 as sf_samayojan_flag_master,
                                        0 as  aided_samayojan_fwd_flag_master,0 as partpaided_samayojan_fwd_flag_master,0 as unaided_samayojan_fwd_flag_master,0 as perunaided_samayojan_fwd_flag_master,0 as sf_samayojan_fwd_flag_master
                                    FROM udise.sanch_sanction_post as ssp
                                    LEFT JOIN udise.shala_post_master as spm ON  ssp.posttype =spm.post_type AND  ssp.postid =spm.post_id
                                    WHERE  schcd = '" . $schl_id . "' AND ssp.posttype = $tchr_type AND ac_year = '2016-17'
                                    )

                           UNION
                   (SELECT   tm.schl_id,tm.tchr_type,tm.tchr_curr_desg_cd,tpm.post_desc,      
                           sum( CASE WHEN samayojan_flag ='A' AND tchr_mgmt_type =1 THEN 1 ELSE 0 END)as aided_samayojan_flag_master,
                            sum( CASE WHEN samayojan_flag ='A' AND tchr_mgmt_type =2 THEN 1 ELSE 0 END)as partpaided_samayojan_flag_master,
                             sum( CASE WHEN samayojan_flag ='A' AND tchr_mgmt_type =3 THEN 1 ELSE 0 END)as unaided_samayojan_flag_master,
                              sum( CASE WHEN samayojan_flag ='A' AND tchr_mgmt_type =4 THEN 1 ELSE 0 END)as perunaided_samayojan_flag_master,
                               sum( CASE WHEN samayojan_flag ='A' AND tchr_mgmt_type =5 THEN 1 ELSE 0 END)as sf_samayojan_flag_master,
                               sum( CASE WHEN samayojan_fwd_flag ='F' AND tchr_mgmt_type =1 THEN 1 ELSE 0 END)as aided_samayojan_fwd_flag_master,
                               sum( CASE WHEN samayojan_fwd_flag ='F' AND tchr_mgmt_type =2 THEN 1 ELSE 0 END)as partpaided_samayojan_fwd_flag_master,
                               sum( CASE WHEN samayojan_fwd_flag ='F' AND tchr_mgmt_type =3 THEN 1 ELSE 0 END)as unaided_samayojan_fwd_flag_master,
                               sum( CASE WHEN samayojan_fwd_flag ='F' AND tchr_mgmt_type =4 THEN 1 ELSE 0 END)as perunaided_samayojan_fwd_flag_master,
                              sum( CASE WHEN samayojan_fwd_flag ='F' AND tchr_mgmt_type =5 THEN 1 ELSE 0 END)as sf_samayojan_fwd_flag_master
                               
                     FROM master.tch_master  as tm
                     LEFT JOIN    master.tchr_post_master as tpm   ON  tm.tchr_type=tpm.post_type     AND tm.tchr_curr_desg_cd = tpm.post_id
                     WHERE   tm.schl_id = '" . $schl_id . "' AND tm.tchr_type = $tchr_type  
                     GROUP BY tm.tchr_type,tm.tchr_curr_desg_cd,tpm.post_desc,tm.schl_id)
                     ) as tmp
                     GROUP BY posttype,postid,post_desc,schl_id
                     order by posttype,postid";

//            echo "".$query;exit();
//count(tm.tchr_id) as tot_master

            $result = $this->query($query);
            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getPostListBeoExcess($beo_code) {
        $query = "Select tm.tchr_id,tm.tchr_curr_desg_cd,tpm.post_desc
                FROM
                            master.tch_master as tm
                LEFT JOIN   master.tchr_post_master as tpm
                ON       tm.tchr_type=tpm.post_type
                      AND  tm.tchr_curr_desg_cd = tpm.post_id
                WHERE
                           tm.schl_id like '" . $beo_code . "%'  
                      AND  tm.tchr_serv_entry_dt is not null
                      AND  tm.tchr_surplus = 'Y'
                      AND tm.tchr_type = 1
                ORDER BY tpm.post_desc"; // posttype 1=Teaching 2=Non-Teaching  AND tch_master.asst_flag='U'
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getExcessMgmtPostList($beo_code, $excess_post_desg_cd) {
        $query = "SELECT tm.tchr_id,tm.tchr_curr_desg_cd,tm.tchr_mgmt_type,cdd.code_text,cdd.code_value
                    FROM        master.tch_master as tm
                    LEFT JOIN   master.cddir as cdd
                    ON (tm.tchr_mgmt_type = CAST(cdd.code_value as integer)  and cdd.code_type='TM')
                    WHERE  tm.schl_id like '" . $beo_code . "%'
                        AND tm.tchr_type = 1
                        AND tm.tchr_curr_desg_cd = '" . $excess_post_desg_cd . "'
                         AND  tm.tchr_surplus = 'Y' ";

//        echo "" . $query;  exit();


        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getExcessPostMgmtSchoolwiseListPrint($beo_code, $post_id, $mgmt_id) {
        $query = " SELECT   TM.tchr_id,TM.tchr_fname,TM.tchr_mname,TM.tchr_lname,TM.schl_id,TM.tchr_gender,TM.tchr_birth_dt,TM.tchr_type,
                   TM.tchr_sch_entry_dt,TM.tchr_curr_sch_dt,TM.tchr_curr_desg_cd,TM.tchr_serv_entry_dt,TM.tchr_edu_entry_dt,TM.tchr_block_entry_dt,
                   TM.tchr_super_annuation_dt,TM.tchr_surplus,
                   TPM.post_desc,
                            age(current_date , tchr_birth_dt) as age,
                            date_part('year',age(current_date, tchr_birth_dt)) as year,
                            date_part('month',age(current_date, tchr_birth_dt)) as month,
                            date_part('day',age(current_date, tchr_birth_dt)) as day ,
                    SAS.school_name,
                    TSOD.tm_priority,
                    CD.code_text
                   FROM         master.tch_master as TM
                   LEFT JOIN    master.tchr_post_master as TPM
                    ON        TM.tchr_type = TPM.post_type
                            AND TM.tchr_curr_desg_cd = TPM.post_id
                            
                    LEFT JOIN    shala.shala_all_school as SAS
                    ON        TM.schl_id = SAS.schcd
                    
                    INNER JOIN     master.tchr_samyjn_other_det as TSOD
                    ON        TM.tchr_id = TSOD.tchr_id
                    
                    INNER JOIN     master.cddir as CD
                    ON        TSOD.tm_priority = CAST(CD.code_value as numeric ) AND CD.code_type = 'PR'  

                    WHERE
                                TM.schl_id like '" . $beo_code . "%'
                            AND SAS.schcd like '" . $beo_code . "%'
                            AND TM.tchr_type = 1
                            AND TM.tchr_curr_desg_cd = $post_id
                            AND TPM.post_type = 1   
                            AND TPM.post_id = $post_id
                            AND TM.tchr_mgmt_type = $mgmt_id
                            AND TM.tchr_surplus = 'Y'  
                    ORDER BY TSOD.tm_priority  ASC,tchr_curr_sch_dt  DESC
                    
                 ";
//        echo "" . $query;
//        exit(); // ,tchr_curr_sch_dt ASC
        $result = $this->query($query);
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getExcessMgmtPostListShiftEo($beo_code, $excess_post_desg_cd_shift_eo) {
        $query = "SELECT tm.tchr_id,tm.tchr_curr_desg_cd,tm.tchr_mgmt_type,cdd.code_text,cdd.code_value
                    FROM        master.tch_master as tm
                    LEFT JOIN   master.cddir as cdd
                    ON (tm.tchr_mgmt_type = CAST(cdd.code_value as integer)  and cdd.code_type='TM')
                    WHERE  tm.schl_id like '" . $beo_code . "%'
                        AND tm.tchr_type = 1
                        AND tm.tchr_curr_desg_cd = '" . $excess_post_desg_cd_shift_eo . "'
                         AND  tm.tchr_surplus = 'Y' ";

//        echo "" . $query;  exit();


        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
//$result=0;
            return 0;
        }
    }

    public function getExcessPostMgmtSchoolwiseListShiftEo($beo_code, $post_id, $mgmt_id) {
        $query = " SELECT   TM.tchr_id,TM.tchr_fname,TM.tchr_mname,TM.tchr_lname,TM.schl_id,TM.tchr_gender,TM.tchr_birth_dt,TM.tchr_type,
                   TM.tchr_sch_entry_dt,TM.tchr_curr_sch_dt,TM.tchr_curr_desg_cd,TM.tchr_serv_entry_dt,TM.tchr_edu_entry_dt,TM.tchr_block_entry_dt,
                   TM.tchr_super_annuation_dt,TM.tchr_surplus,TM.tchr_mgmt_type,
                   TPM.post_desc,
                            age(current_date , tchr_birth_dt) as age,
                            date_part('year',age(current_date, tchr_birth_dt)) as year,
                            date_part('month',age(current_date, tchr_birth_dt)) as month,
                            date_part('day',age(current_date, tchr_birth_dt)) as day ,
                    SAS.school_name,
                    TSOD.tm_priority,
                    CD.code_text,
                    ES.new_trans_schl_id,
                    SAS_NEW.school_name as new_school_name
                    
                   FROM         master.tch_master as TM
                   LEFT JOIN    master.tchr_post_master as TPM
                    ON        TM.tchr_type = TPM.post_type
                            AND TM.tchr_curr_desg_cd = TPM.post_id
                            
                    LEFT JOIN    shala.shala_all_school as SAS
                    ON        TM.schl_id = SAS.schcd
                    
                    INNER JOIN     master.tchr_samyjn_other_det as TSOD
                    ON        TM.tchr_id = TSOD.tchr_id
                    
                    INNER JOIN     master.cddir as CD
                    ON        TSOD.tm_priority = CAST(CD.code_value as numeric ) AND CD.code_type = 'PR'
                    
                    LEFT JOIN      samayojan.excess_shift as ES        
                    ON          TM.tchr_id = ES.tchr_id  
                       
                    LEFT JOIN       shala.shala_all_school as SAS_NEW     
                    ON          SAS_NEW.schcd = ES.new_trans_schl_id  
                    
                    WHERE
                                TM.schl_id like '" . $beo_code . "%'
                            AND SAS.schcd like '" . $beo_code . "%'
                            AND TM.tchr_type = 1
                            AND TM.tchr_curr_desg_cd = $post_id
                            AND TPM.post_type = 1   
                            AND TPM.post_id = $post_id
                            AND TM.tchr_mgmt_type = $mgmt_id
                            AND TM.tchr_surplus = 'Y'   
                    ORDER BY TM.tchr_block_entry_dt ,TSOD.tm_priority
                    
                 "; //ASC,TSOD.tm_priority  ASC
//        echo "" . $query; exit();// ,tchr_curr_sch_dt ASC
        $result = $this->query($query);
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getinfo($tchr_id) {
        try {
            $query = "SELECT tchr_id,tchr_fname,
                      tchr_mname, tchr_lname,tchr_birth_dt,tchr_type,post_desc , tchr_curr_sch_dt,tchr_gender
                      FROM master.tch_master,master.tchr_post_master  
                      where tchr_id='" . $tchr_id . "'
                      and tchr_type=post_type
                      and post_id=tchr_curr_desg_cd;";

            $result = $this->query($query);

            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getshikshansevaks($schcd) {
        $qry = "select tchr_id,tchr_fname,tchr_mname,tchr_lname,tchr_serv_entry_dt,tchr_appt_end_dt,post_desc
from master.tch_master tm
LEFT JOIN master.tchr_post_master po on po.post_type=tm.tchr_type and po.post_id=tm.tchr_curr_desg_cd
where
                CURRENT_DATE>=(tchr_serv_entry_dt + interval  '3 year'):: date
                and tchr_sch_flag='1'
                and schl_id='" . $schcd . "'";


        $result = $this->query($qry);

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getSanctionPostMgmtwiseBlock($beo_code, $post_id, $mgmt_id) {
        if ($mgmt_id == 1) {
            $sanch_mgmt_type = 'SSP.aided_pyear';
        } else if ($mgmt_id == 2) {
            $sanch_mgmt_type = 'SSP.partpaided_pyear';
        } else if ($mgmt_id == 3) {
            $sanch_mgmt_type = 'SSP.unaided_pyear';
        } else if ($mgmt_id == 4) {
            $sanch_mgmt_type = 'SSP.perunaided_pyear';
        } else if ($mgmt_id == 5) {
            $sanch_mgmt_type = 'SSP.sf_pyear';
        } else {
            $sanch_mgmt_type = 0;
        }

        $query = " SELECT SUM(EXCESS) as excess_within_block ,SUM(VACANT) as vacant_within_block ,block_code,SUM(total_eo_shifted_staff) as total_eo_shifted_staff
                    FROM
                        (SELECT
                            CASE
                                WHEN (SUM(tmp.total_filled_staff) > SUM(tmp.sanch_sanction_staff) )
                                THEN (SUM(tmp.total_filled_staff) - SUM(tmp.sanch_sanction_staff ) )
                                ELSE  0
                            END AS EXCESS,
                            CASE
                                WHEN (SUM(tmp.total_filled_staff) < SUM(tmp.sanch_sanction_staff) )
                                THEN (SUM(tmp.sanch_sanction_staff) - SUM(tmp.total_filled_staff ))
                                ELSE  0
                            END AS VACANT ,
                            block_code ,schl_id,total_eo_shifted_staff
                         FROM (
                                 (SELECT  count(tchr_id) as total_filled_staff,0 as sanch_sanction_staff ,substring(schl_id,1,6) as block_code,schl_id,0 as total_eo_shifted_staff
                                  FROM master.tch_master
                                  WHERE schl_id like '" . $beo_code . "%' AND tchr_type = 1 AND tchr_curr_desg_cd = $post_id AND tchr_mgmt_type = $mgmt_id    
                                   GROUP BY substring(schl_id,1,6) ,schl_id
                                 )
                                 UNION
                                ( SELECT  0 as  total_filled_staff  ,SUM(" . $sanch_mgmt_type . ") as sanch_sanction_staff,substring(schcd,1,6) as block_code ,schcd as schl_id,0 as total_eo_shifted_staff
                                    FROM    udise.sanch_sanction_post as SSP
                                 WHERE   SSP.schcd like '" . $beo_code . "%' AND SSP.posttype = 1 AND SSP.postid = $post_id  
                                   GROUP BY substring(schcd,1,6) ,schcd
                                 )
                                 UNION
                                 (
                                 SELECT   0 as  total_filled_staff,0 as sanch_sanction_staff,substring(schl_id,1,6) as block_code,schl_id,count(tchr_id) as total_eo_shifted_staff
                                    FROM   samayojan.excess_shift as ES
                                 WHERE   ES.schl_id like '" . $beo_code . "%' AND ES.tchr_type = 1 AND ES.tchr_curr_desg_cd = $post_id AND ES.tchr_mgmt_type = $mgmt_id    
                                    GROUP BY substring(schl_id,1,6) ,schl_id
                                 )
                        )as tmp  GROUP BY block_code ,schl_id,total_eo_shifted_staff
                        ) as tmp1 GROUP BY block_code
                        ";
//        echo "" . $query; exit();// ,tchr_curr_sch_dt ASC
        $result = $this->query($query);
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getPerticularSchoolsPostwiseInfoForAcceptAndExcessSanstha($schl_id, $tchr_type, $school_medium_code, $option_schl_type) {
        $global_ac_year = Configure::read('global_ac_year');
        if ($option_schl_type == '02') {
            $postid = "postid IN(4,5,7)";
        }
        if ($option_schl_type == '01') {
            $postid = "postid IN(7,5)";
        }
        try {
            $query = "SELECT 
                            schl_id,posttype,postid,post_desc,
                            SUM(aided_cyear_sanch)aided_cyear_sanch,lowest_class,highest_class 
                        FROM
                        (
                             (SELECT   
                                    ssp.schcd as schl_id,ssp.posttype,ssp.postid,spm.post_desc,
                                    aided_pyear as aided_cyear_sanch,sas.lowest_class,sas.highest_class
                              FROM
                                        udise.sanch_sanction_post as ssp
                            LEFT JOIN   udise.shala_post_master as spm 
                                   ON   ssp.posttype =spm.post_type AND  ssp.postid =spm.post_id
                                   LEFT JOIN shala.shala_all_school sas ON sas.schcd=ssp.schcd
                             WHERE  
                                    ssp.schcd = '" . $schl_id . "' 
                                AND ssp.posttype = 1 
                                AND ssp.medium =   '" . $school_medium_code . "' 
                                AND ac_year = '$global_ac_year'
                                AND    ((aided_pyear) >= 0)
                                AND $postid)
                         ) as tmp
                     GROUP BY posttype,postid,post_desc,schl_id,lowest_class,highest_class
                     order by posttype,postid";

//               echo "".$query;exit();

            $result = $this->query($query);
            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getPerticularSchoolsPostwiseInfoForAcceptAndExcessSansthaDydSanstha($schl_id, $tchr_type, $school_medium_code) {

        $global_ac_year = Configure::read('global_ac_year');
        try {
            $query = "SELECT 
                            schl_id,posttype,postid,post_desc,
                            SUM(aided_cyear_sanch)aided_cyear_sanch 
                        FROM
                        (
                             (SELECT   
                                    ssp.schcd as schl_id,ssp.posttype,ssp.postid,spm.post_desc,
                                    aided_pyear as aided_cyear_sanch 
                              FROM
                                        udise.sanch_sanction_post as ssp
                            LEFT JOIN   udise.shala_post_master as spm 
                                   ON   ssp.posttype =spm.post_type AND  ssp.postid =spm.post_id
                             WHERE  
                                     schcd = '" . $schl_id . "' 
                                 AND ssp.posttype = 1 
                                 AND ac_year = '$global_ac_year'
                                 AND ssp.medium  = $school_medium_code 
                                 AND     ((aided_pyear) >= 0)
                                 AND postid IN(4,5,7))
                         ) as tmp
                     GROUP BY posttype,postid,post_desc,schl_id
                     order by posttype,postid";

            echo "" . $query;
            exit();

            $result = $this->query($query);
            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getPerticularPostwiseInfoForAcceptAndExcessSanstha($schl_id, $tchr_type, $school_posts_code, $school_medium_code) {
        $global_ac_year = Configure::read('global_ac_year');

        try {
            $query = "SELECT 
                            schl_id,posttype,postid,post_desc,
                            SUM(aided_cyear_sanch)aided_cyear_sanch  
                        FROM
                        (
                             (SELECT   
                                    ssp.schcd as schl_id,ssp.posttype,ssp.postid,spm.post_desc,
                                    aided_pyear as aided_cyear_sanch 
                              FROM
                                        udise.sanch_sanction_post as ssp
                            LEFT JOIN   udise.shala_post_master as spm 
                                   ON   ssp.posttype =spm.post_type AND  ssp.postid =spm.post_id
                             WHERE  
                                    schcd = '" . $schl_id . "' 
                                AND ssp.posttype = 1 
                                AND postid = $school_posts_code  
                                AND ssp.medium = '$school_medium_code'
                                AND ac_year = '$global_ac_year'
                                AND     ((aided_pyear) >= 0) 
                                AND postid IN(4,5,7))
                         ) as tmp
                     GROUP BY posttype,postid,post_desc,schl_id
                     order by posttype,postid";

//            echo "".$query;exit();
//count(tm.tchr_id) as tot_master

            $result = $this->query($query);
            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getPerticularPostwiseInfoForAcceptAndExcessSansthaDydSanstha($schl_id, $tchr_type, $school_posts_code, $school_medium_code) {

        $global_ac_year = Configure::read('global_ac_year');
        try {
            $query = "SELECT 
                            schl_id,posttype,postid,post_desc,
                            SUM(aided_cyear_sanch)aided_cyear_sanch 
                        FROM
                        (
                             (SELECT   
                                    ssp.schcd as schl_id,ssp.posttype,ssp.postid,spm.post_desc,
                                    aided_pyear as aided_cyear_sanch 
                              FROM
                                        udise.sanch_sanction_post as ssp
                            LEFT JOIN   udise.shala_post_master as spm 
                                   ON   ssp.posttype =spm.post_type AND  ssp.postid =spm.post_id
                             WHERE  
                                    schcd = '" . $schl_id . "' 
                                AND ssp.posttype = 1 
                                AND postid = $school_posts_code  
                                     AND ssp.medium = $school_medium_code 
                                 AND ac_year = '$global_ac_year'
                                AND     ((aided_pyear) >= 0)
                                AND postid IN(4,5,7))
                         ) as tmp
                     GROUP BY posttype,postid,post_desc,schl_id
                     order by posttype,postid";

//            echo "".$query;exit();
//count(tm.tchr_id) as tot_master

            $result = $this->query($query);
            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

}
