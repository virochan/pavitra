<?php

class SelectExcessTchrDets extends AppModel {

    public $useDbConfig = 'use_db_samayojan_data';
    var $name = "SelectExcessTchrDets";
    var $useTable = 'smj_excesstch_det'; //db=Teacher schema=master

    public function getPostListShiftEoExcess($eo_code) {
        $query = "SELECT SED.tchr_curr_desg_cd,TPM.post_desc
                FROM
                            samayojan.smj_excesstch_det as SED
                LEFT JOIN   master.tchr_post_master as TPM
                ON          SED.tchr_curr_desg_cd = TPM.post_id AND  TPM.post_type ='1'
                WHERE
                           SED.schl_id IN 
                           (
                            SELECT  DISTINCT(ESEV.schl_id) 
                            FROM samayojan.eo_sanstha_ex_vac as ESEV
                            WHERE ESEV.eo_code = '" . $eo_code . "'
                                AND eos_type= '1'
                           )
                           AND SED.tchr_curr_desg_cd IN (4,5,7)
                ORDER BY TPM.post_desc
                "; // posttype 1=Teaching 2=Non-Teaching  AND tch_master.asst_flag='U'
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

    public function getSanctionPostwiseBlock($eo_code, $post_id) {

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "  SELECT SED.tchr_id ,SED.sanstha_code,SBI.sanstha_name,SED.schl_id,SED.schl_name,SED.tchr_fname,SED.tchr_mname,SED.tchr_lname,SED.tchr_edu_entry_dt,SED.tchr_birth_dt,SED.tchr_curr_desg_cd
                    FROM samayojan.smj_excesstch_det as SED 
                     LEFT JOIN samayojan.sanstha_basic_info as SBI
                    ON SED.sanstha_code = SBI.sanstha_code  AND SBI.minority_sanstha IN $minority_type_cond
                    WHERE
                     SED.sanstha_code IN (
                            SELECT  DISTINCT(ESEV.sanstha_code) 
                            FROM samayojan.eo_sanstha_ex_vac as ESEV
                            WHERE ESEV.eo_code = '" . $eo_code . "'
                                AND eos_type= '1'
                                AND eos_desg_cd = $post_id
                           )
                           AND SED.tchr_curr_desg_cd = $post_id
                        ";
//        echo "" . $query; exit();// ,tchr_curr_sch_dt ASC
        $result = $this->query($query);
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getdesigexcnt($santha, $desig, $sch, $med) {
        $global_ac_year = Configure::read('global_ac_year');
        $qry = "SELECT count(tch_ex_id)
                FROM samayojan.smj_excesstch_det
                WHERE sanstha_code='" . $santha . "'
                AND tchr_curr_desg_cd='" . $desig . "'
                AND eos_medium_id='" . $med . "' 
                and ac_year='" . $global_ac_year . "'";

        $result = $this->query($qry);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getschseo($dist, $l, $h) {
        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');


        $qry = "SELECT DISTINCT(schl_id),schl_name
                  FROM samayojan.sanstha_basic_info sbi
                  RIGHT JOIN samayojan.smj_excesstch_det smd on sbi.sanstha_code=smd.sanstha_code AND sbi.minority_sanstha IN $minority_type_cond
                  WHERE distcd_reg='" . $dist . "'
                  AND asst_flag='F'    
                  AND ac_year='" . $global_ac_year . "'";

//        AND schl_id in(SELECT schcd from shala.shala_all_school
//                  WHERE lowest_class>=" . $l . " 
//                  AND highest_class<=" . $h . ")

        $result = $this->query($qry);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function ex_tchrdetail_eo($sanstha_code, $dist_cd, $schl_type, $eos_type, $desig_cd, $med_cd) {
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }
            $query = "SELECT SED.schl_id,SAS.school_name ,
                                SED.tch_ex_id,SED.tchr_fname,SED.tchr_mname,SED.tchr_lname,
                                SED.tchr_serv_entry_dt,SED.tchr_birth_dt,
                                SED.tq_adegree,SED.tq_adegname,
                                SED.tq_pdegree,SED.tq_pdegname,
                                SED.ts_subject_tot1,SED.ts_subjectdesc_tot1,
                                SED.ts_subject_tot2,SED.ts_subjectdesc_tot2,
                                SED.tchr_edu_entry_dt,SED.tchr_curr_desg_cd,SED.tchr_curr_desig_dt
                                FROM     samayojan.smj_excesstch_det as SED
                                LEFT JOIN  shala.shala_all_school as SAS
                                ON SED.schl_id = SAS.schcd  AND SAS.$schl_type_condition
                                WHERE SED.sanstha_code='" . $sanstha_code . "'
                                AND  SED.schl_id LIKE '" . $dist_cd . "%' 
                                AND SED.schl_id = SAS.schcd
                                AND  SED.tchr_curr_desg_cd = $desig_cd
                                AND  SED.eos_medium_id='" . $med_cd . "'
                                AND (SED.asst_flag ='E' or SED.asst_flag ='Z')";
//            echo "" . $query;
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

    public function ex_tchrdetail($sanstha_code, $dist_cd, $schl_type, $eos_type, $desig_cd, $med_cd) {
          $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }
            $query = "SELECT SED.schl_id,SAS.school_name ,
                                SED.tch_ex_id,SED.tchr_fname,SED.tchr_mname,SED.tchr_lname,
                                SED.tchr_serv_entry_dt,SED.tchr_birth_dt,
                                SED.tq_adegree,SED.tq_adegname,
                                SED.tq_pdegree,SED.tq_pdegname,
                                SED.ts_subject_tot1,SED.ts_subjectdesc_tot1,
                                SED.ts_subject_tot2,SED.ts_subjectdesc_tot2,
                                SED.tchr_edu_entry_dt,SED.tchr_curr_desg_cd,SED.tchr_curr_desig_dt
                                FROM     samayojan.smj_excesstch_det as SED
                                LEFT JOIN  shala.shala_all_school as SAS
                                ON SED.schl_id = SAS.schcd  AND SAS.$schl_type_condition
                                WHERE SED.sanstha_code='" . $sanstha_code . "'
                                AND  SED.schl_id LIKE '" . $dist_cd . "%' 
                                AND SED.schl_id = SAS.schcd
                                AND  SED.tchr_curr_desg_cd = $desig_cd
                                AND  SED.eos_medium_id='" . $med_cd . "'
                                AND (SED.asst_flag ='E')
                                AND SED.ac_year='".$global_ac_year."'";
//            echo "" . $query;
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

    public function ex_tchrdetailverif($sanstha_code, $dist_cd, $schl_type, $eos_type, $desig_cd, $med_cd) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }
            $query = "SELECT 
                                SED.schl_id,SED.schl_name ,
                                SED.tch_ex_id,SED.tchr_fname,SED.tchr_mname,SED.tchr_lname,
                                SED.tchr_serv_entry_dt,SED.tchr_birth_dt,
                                SED.tq_adegree,SED.tq_adegname,
                                SED.tq_pdegree,SED.tq_pdegname,
                                SED.ts_subject_tot1,SED.ts_subjectdesc_tot1,
                                SED.ts_subject_tot2,SED.ts_subjectdesc_tot2,
                                SED.tchr_edu_entry_dt,SED.tchr_curr_desg_cd,
                                SED.tchr_curr_desig_dt
                       FROM     samayojan.smj_excesstch_det as SED
		     LEFT JOIN  shala.shala_all_school as SAS
                             ON SED.schl_id = SAS.schcd  AND SAS.$schl_type_condition
  
		  WHERE      SED.sanstha_code='" . $sanstha_code . "'
			AND  SED.schl_id LIKE '" . $dist_cd . "%' 
                        AND SED.schl_id = SAS.schcd
                        AND  SED.tchr_curr_desg_cd = $desig_cd
                        AND  SED.eos_medium_id='" . $med_cd . "'   
                            AND SED.ac_year='" . $global_ac_year . "'
		        AND  (SED.asst_flag ='F' or SED.asst_flag ='C')
                         ";
//            echo "" . $query;
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

    public function getSamaExcessTchrInfo($eo_code, $teacher_id) {
        try {

            $query = "SELECT   *                              
                        FROM     samayojan.smj_excesstch_det as SED
                                LEFT JOIN  shala.shala_all_school as SAS
                                ON SED.schl_id = SAS.schcd
                                WHERE   SED.tch_ex_id = '" . $teacher_id . "' 
                                "; //  
//            echo "" . $query;
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

    public function repextchrdets($desig_cd, $med_cd, $user) {
         $global_ac_year = Configure::read('global_ac_year');
        try {
            $styp = substr($user, 6);
            $dist = substr($user, 0, 4);
            $query = "SELECT sm.sanstha_code,sanstha_name, tchr_fname, tchr_mname, tchr_lname, schl_name,schl_id, 
                            tchr_birth_dt,tchr_curr_desig_dt,asst_flag,
                            tc_categ_desc,tq_adegname,tq_pdegname, ts_subjectdesc_tot1, ts_subjectdesc_tot2
                       FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi
                       WHERE    tchr_curr_desg_cd = $desig_cd
                            AND eos_medium_id = '" . $med_cd . "'
                            AND sch_type = '" . $styp . "'    
                            AND bi.sanstha_code = sm.sanstha_code
                            AND bi.minority_sanstha in ('2','3')
                            AND sm.sanstha_code in (SELECT sanstha_code from samayojan.eo_sanstha_ex_vac
                            WHERE eo_code = '" . $user . "'
                            AND minority_sanstha in ('2','3'))
                            AND sm.ac_year = '" . $global_ac_year . "'
                            AND sm.schl_id like '" . $dist . "%'
                            ORDER BY sm.sanstha_code,schl_id
                         ";
//            echo "" . $query;
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

    public function repnextchrdets($desig_cd, $med_cd, $user) {
          $global_ac_year = Configure::read('global_ac_year');
        try {
            $styp = substr($user, 6);
            $dist = substr($user, 0, 4);
            $query = "SELECT sm.sanstha_code,sanstha_name, tchr_fname, tchr_mname, tchr_lname, schl_name,schl_id, 
                            tchr_birth_dt,tchr_curr_desig_dt,asst_flag,
                            tc_categ_desc,tq_adegname,tq_pdegname, ts_subjectdesc_tot1, ts_subjectdesc_tot2
                       FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi
                       WHERE tchr_curr_desg_cd=$desig_cd
                       AND eos_medium_id='" . $med_cd . "'
                       AND sch_type='" . $styp . "'    
                       AND bi.sanstha_code=sm.sanstha_code
                       AND bi.minority_sanstha in ('1')
                       AND sm.sanstha_code in (SELECT sanstha_code from samayojan.eo_sanstha_ex_vac
                       WHERE eo_code='" . $user . "'
                       AND minority_sanstha in ('1'))
                       and sm.schl_id like '" . $dist . "%'
                        and sm.ac_year='" . $global_ac_year . "'   
                       ORDER BY sm.sanstha_code,schl_id
                         ";
//            echo "" . $query;
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

    public function sjextchrdets($med_cd, $user, $minor) {
        try {
            $sch_type = substr($user, 6);
            if ($minor == 'Y') {
                $min = "in ('2','3')";
            } else if ($minor == 'N') {
                $min = "='1'";
            }

            $dist_code = substr($user, 0, 4);


            $query = "SELECT sm.sanstha_code,sanstha_name,tch_ex_id, tchr_fname,post_desc,
                       tchr_mname, tchr_lname, schl_name,schl_id,tchr_curr_desg_cd,
                        tchr_birth_dt,tchr_curr_desig_dt, tc_categ_desc,asst_flag,
                        tq_adegname,tq_pdegname, ts_subjectdesc_tot1, ts_subjectdesc_tot2 
                        FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master 
                        WHERE eos_medium_id='" . $med_cd . "' 
                         AND sch_type ='" . $sch_type . "'
                         AND schl_id like '" . $dist_code . "%'
                             AND asst_flag = 'A'
                        AND bi.sanstha_code=sm.sanstha_code
                        AND bi.minority_sanstha $min
                        AND sm.sanstha_code in 
                        (SELECT sanstha_code 
                        from samayojan.eo_sanstha_ex_vac
                          WHERE minority_sanstha $min )
                       AND post_type=1
                      AND post_id=tchr_curr_desg_cd   
                          ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname";

//             echo "" . $query;
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

    public function checkStaffDeailedFilledSanstha($sanstha_dist_cd_old, $option_schl_type_old, $eo_code_old, $sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old, $eos_type_old, $eos_online_posts_old, $eos_offline_posts_old, $eos_no_of_post_old, $option_subject_code_old, $asst_flag_old, $consider_vacancy_flag_old) {

        if ($option_subject_code_old == '')
            $option_subject_code_old_condition = 'IS NULL';
        else
            $option_subject_code_old_condition = '= ' . $option_subject_code_old;

        $global_ac_year = Configure::read('global_ac_year');

        try {
            $query = "SELECT * FROM samayojan.smj_excesstch_det sm
                         WHERE 
                                substr(schl_id, 1,4) ='" . $sanstha_dist_cd_old . "'
                            AND sch_type='" . $option_schl_type_old . "'
                            AND sanstha_code='" . $sanstha_code_old . "'
                            AND schl_id='" . $schl_id_old . "' 
                            AND eos_medium_id='" . $eos_medium_id_old . "'
                            AND tchr_curr_desg_cd = $eos_desg_cd_old
                                AND ac_year = '$global_ac_year'    
                     "; // AND  sm.tc_categ != 1
//              echo "" . $query;
//            exit();

            $result = $this->query($query);
            if ($result <> NULL) {
                return 1; //record Found
            } else {
                return 0; //record Not Found
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getSamaExcessTchrList($eo_code, $option_medium_type) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        try {

//            $query = "SELECT sm.sanstha_code,sanstha_name,tch_ex_id,tchr_fname,tchr_mname, tchr_lname,
//                            tchr_curr_desg_cd,post_desc,
//                            schl_id,schl_name,tchr_birth_dt,tchr_curr_desig_dt,
//                            tc_categ,tc_categ_desc, 
//                            tq_adegree,tq_adegname,tq_pdegree,tq_pdegname,
//                            ts_subject_tot1,ts_subjectdesc_tot1,ts_subject_tot2,ts_subjectdesc_tot2 ,
//                            ts_smj_schl_id,  ts_smj_eo_code , ts_smj_tch_sub , ts_smj_dtts, new_sanstha_code ,ts_smj_categ_cd,
//                            stg_flg1,stg_flg2,stg_flg3,stg_flg4,eos_medium_id
//                            
//                         FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master 
//                         WHERE eos_medium_id='" . $option_medium_type . "' 
//                         AND  sm.asst_flag = 'A'
//                         AND bi.sanstha_code=sm.sanstha_code 
//                         AND sm.sanstha_code in 
//                         (SELECT sanstha_code 
//                         from samayojan.eo_sanstha_ex_vac
//                          WHERE eo_code='" . $eo_code . "'
//                           AND minority_sanstha not in ('2','3') )
//                        AND post_type=1
//                       AND post_id=tchr_curr_desg_cd   
//                           ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
//                         "; // AND  sm.tc_categ != 1
//            echo "" . $query;
//            exit();

            $query = "SELECT sm.sanstha_code,sanstha_name,tch_ex_id,tchr_fname,tchr_mname, tchr_lname,
                            tchr_curr_desg_cd,post_desc,
                            schl_id,schl_name,tchr_birth_dt,tchr_curr_desig_dt,
                            tc_categ,tc_categ_desc, 
                            tq_adegree,tq_adegname,tq_pdegree,tq_pdegname,
                            ts_subject_tot1,ts_subjectdesc_tot1,ts_subject_tot2,ts_subjectdesc_tot2 ,
                            ts_smj_schl_id,ts_smj_eo_code,ts_smj_tch_sub,ts_smj_dtts,new_sanstha_code,ts_smj_categ_cd,
                            stg_flg1,stg_flg2,stg_flg3,stg_flg4,eos_medium_id,tchr_gender
                            
                         FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master 
                         WHERE      eos_medium_id='" . $option_medium_type . "' 
                                AND sch_type ='" . $sch_type . "'
                                AND schl_id like '" . $dist_id . "%'
                                AND sm.asst_flag = 'A'
                                AND sm.stg_flg0 = 'W'
                                AND sm.ac_year = '$global_ac_year'
                                AND bi.sanstha_code = sm.sanstha_code 
                                AND bi.minority_sanstha IN $minority_type_cond
                                AND sm.sanstha_code in 
                                (SELECT sanstha_code 
                                    FROM samayojan.eo_sanstha_ex_vac
                                        WHERE   eo_code = '" . $eo_code . "'
                                            AND asst_flag = 'A'
                                            AND minority_sanstha IN $minority_type_cond
                                )
                                AND post_type=1
                                AND ac_year = '$global_ac_year'
                                AND post_id = tchr_curr_desg_cd  
                                  ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
                         "; // AND  sm.tc_categ != 1
//              echo "" . $query;
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
    } //dd

    public function updateGeneralExcessTchrList($eo_code, $option_medium_type) {

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        try {

            $query = "UPDATE samayojan.smj_excesstch_det
                      SET stg_flg1='W' , stg_flg1_dtts= now()
                      WHERE tch_ex_id IN (
                        SELECT tch_ex_id                         
                         FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master 
                         WHERE eos_medium_id='" . $option_medium_type . "' 
                        AND  sm.tc_categ = 1
                        AND sm.asst_flag ='A'
                        AND stg_flg1 != 'W'
                         AND bi.sanstha_code=sm.sanstha_code 
                         AND bi.minority_sanstha IN $minority_type_cond
                         AND sm.sanstha_code in 
                         (SELECT sanstha_code 
                         from samayojan.eo_sanstha_ex_vac
                          WHERE eo_code='" . $eo_code . "'
                           AND minority_sanstha IN $minority_type_cond )
                        AND post_type=1
                       AND post_id=tchr_curr_desg_cd   
                           ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
                           )
                         ";

//            echo "" . $query;
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

    public function getSamaExcessTchrListRound2($eo_code, $option_medium_type) {
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        try {

//            $query = "SELECT sm.sanstha_code,sanstha_name,tch_ex_id,tchr_fname,tchr_mname, tchr_lname,
//                            tchr_curr_desg_cd,post_desc,
//                            schl_id,schl_name,tchr_birth_dt,tchr_curr_desig_dt,
//                            tc_categ,tc_categ_desc, 
//                            tq_adegree,tq_adegname,tq_pdegree,tq_pdegname,
//                            ts_subject_tot1,ts_subjectdesc_tot1,ts_subject_tot2,ts_subjectdesc_tot2 ,
//                            ts_smj_schl_id,  ts_smj_eo_code , ts_smj_tch_sub , ts_smj_dtts, new_sanstha_code ,ts_smj_categ_cd,
//                            stg_flg1,stg_flg2,stg_flg3,stg_flg4,eos_medium_id
//                            
//                         FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master 
//                         WHERE eos_medium_id='" . $option_medium_type . "' 
//                         AND bi.sanstha_code=sm.sanstha_code 
//                          AND  sm.asst_flag = 'A'
//                         AND   sm.stg_flg1 ='W'
//                         AND sm.sanstha_code in 
//                         (SELECT sanstha_code 
//                         from samayojan.eo_sanstha_ex_vac
//                          WHERE eo_code='" . $eo_code . "'
//                           AND minority_sanstha not in ('2','3') )
//                        AND post_type=1
//                        AND post_id=tchr_curr_desg_cd   
//                           ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
//                         ";
//
//            echo "" . $query;
//            exit();



            $query = "SELECT sm.sanstha_code,sanstha_name,tch_ex_id,tchr_fname,tchr_mname, tchr_lname,
                            tchr_curr_desg_cd,post_desc,
                            schl_id,schl_name,tchr_birth_dt,tchr_curr_desig_dt,
                            tc_categ,tc_categ_desc, 
                            tq_adegree,tq_adegname,tq_pdegree,tq_pdegname,
                            ts_subject_tot1,ts_subjectdesc_tot1,ts_subject_tot2,ts_subjectdesc_tot2 ,
                            ts_smj_schl_id,  ts_smj_eo_code , ts_smj_tch_sub , ts_smj_dtts, new_sanstha_code ,ts_smj_categ_cd,
                            stg_flg1,stg_flg2,stg_flg3,stg_flg4,eos_medium_id,tchr_gender
                            
                         FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master 
                         WHERE      sm.eos_medium_id = '" . $option_medium_type . "' 
                                AND sm.sch_type = '" . $sch_type . "'
                                AND sm.schl_id like '" . $dist_id . "%'
                                AND bi.sanstha_code=sm.sanstha_code 
                                AND bi.minority_sanstha IN $minority_type_cond
                                AND sm.asst_flag = 'A'
                                AND sm.stg_flg1 = 'W'
                                AND sm.ac_year = '$global_ac_year'
                                AND sm.sanstha_code in 
                                (SELECT sanstha_code 
                                   FROM samayojan.eo_sanstha_ex_vac
                                       WHERE     eo_code = '" . $eo_code . "'
                                             AND asst_flag = 'A'
                                             AND ac_year = '$global_ac_year'
                                             AND minority_sanstha IN $minority_type_cond
                                  )
                               AND post_type = 1
                               AND post_id = tchr_curr_desg_cd   
                           ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
                         ";

//            echo "" . $query;
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

    public function getSamaExcessTchrListRound3($eo_code, $option_medium_type) {

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        try {

//            $query = "SELECT sm.sanstha_code,sanstha_name,tch_ex_id,tchr_fname,tchr_mname, tchr_lname,
//                            tchr_curr_desg_cd,post_desc,
//                            schl_id,schl_name,tchr_birth_dt,tchr_curr_desig_dt,
//                            tc_categ,tc_categ_desc, 
//                            tq_adegree,tq_adegname,tq_pdegree,tq_pdegname,
//                            ts_subject_tot1,ts_subjectdesc_tot1,ts_subject_tot2,ts_subjectdesc_tot2 ,
//                            ts_smj_schl_id,  ts_smj_eo_code , ts_smj_tch_sub , ts_smj_dtts, new_sanstha_code ,ts_smj_categ_cd,
//                            stg_flg1,stg_flg2,stg_flg3,stg_flg4,eos_medium_id
//                            
//                         FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master 
//                         WHERE eos_medium_id='" . $option_medium_type . "' 
//                         AND bi.sanstha_code=sm.sanstha_code 
//                          AND  sm.asst_flag = 'A'
//                         AND   sm.stg_flg2 ='W'
//                         AND sm.sanstha_code in 
//                         (SELECT sanstha_code 
//                         from samayojan.eo_sanstha_ex_vac
//                          WHERE eo_code='" . $eo_code . "'
//                           AND minority_sanstha not in ('2','3') )
//                        AND post_type=1
//                        AND post_id=tchr_curr_desg_cd   
//                           ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
//                         ";
//
//            echo "" . $query;
//            exit();



            $query = "SELECT sm.sanstha_code,sanstha_name,tch_ex_id,tchr_fname,tchr_mname, tchr_lname,
                            tchr_curr_desg_cd,post_desc,
                            schl_id,schl_name,tchr_birth_dt,tchr_curr_desig_dt,
                            tc_categ,tc_categ_desc, 
                            tq_adegree,tq_adegname,tq_pdegree,tq_pdegname,
                            ts_subject_tot1,ts_subjectdesc_tot1,ts_subject_tot2,ts_subjectdesc_tot2 ,
                            ts_smj_schl_id,  ts_smj_eo_code , ts_smj_tch_sub , ts_smj_dtts, new_sanstha_code ,ts_smj_categ_cd,
                            stg_flg1,stg_flg2,stg_flg3,stg_flg4,eos_medium_id,tchr_gender
                            
                         FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master 
                         WHERE      eos_medium_id = '" . $option_medium_type . "' 
                                AND sch_type = '" . $sch_type . "'
                                AND schl_id like '" . $dist_id . "%'
                                AND sm.asst_flag = 'A'
                                AND sm.stg_flg2 = 'W'
                                AND bi.sanstha_code = sm.sanstha_code 
                                AND bi.minority_sanstha IN $minority_type_cond
                                AND sm.sanstha_code in 
                                (SELECT sanstha_code 
                                       FROM  samayojan.eo_sanstha_ex_vac
                                       WHERE     eo_code = '" . $eo_code . "'
                                             AND asst_flag = 'A'
                                             AND ac_year = '$global_ac_year'
                                             AND minority_sanstha IN $minority_type_cond 
                                 )
                               AND post_type = 1
                               AND post_id=tchr_curr_desg_cd   
                           ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
                         ";

//            echo "" . $query;
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

     public function getSamaExcessTchrListRound4($eo_code, $option_medium_type) {

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        try {
            $query = "SELECT sm.sanstha_code,sanstha_name,tch_ex_id,tchr_fname,tchr_mname, tchr_lname,
                            tchr_curr_desg_cd,post_desc,
                            schl_id,schl_name,tchr_birth_dt,tchr_curr_desig_dt,
                            tc_categ,tc_categ_desc, 
                            tq_adegree,tq_adegname,tq_pdegree,tq_pdegname,
                            ts_subject_tot1,ts_subjectdesc_tot1,ts_subject_tot2,ts_subjectdesc_tot2 ,
                            ts_smj_schl_id,  ts_smj_eo_code , ts_smj_tch_sub , ts_smj_dtts, new_sanstha_code ,ts_smj_categ_cd,
                            stg_flg1,stg_flg2,stg_flg3,stg_flg4,eos_medium_id,tchr_gender
                            
                         FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master 
                         WHERE      eos_medium_id='" . $option_medium_type . "' 
                                AND sch_type = '" . $sch_type . "'
                                AND schl_id like '" . $dist_id . "%'
                                AND sm.asst_flag = 'A'
                                AND sm.stg_flg3 = 'W'
                                AND ts_subject_tot2 is not NULL
                                AND bi.sanstha_code = sm.sanstha_code 
                                AND bi.minority_sanstha IN $minority_type_cond
                                AND sm.sanstha_code in 
                         (SELECT sanstha_code 
                            FROM samayojan.eo_sanstha_ex_vac
                                WHERE eo_code='" . $eo_code . "'
                                      AND asst_flag= 'A'
                                      AND ac_year = '$global_ac_year'
                                      AND minority_sanstha IN $minority_type_cond
                            )
                                AND post_type = 1
                                AND post_id = tchr_curr_desg_cd   
                           ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
                         ";

//            echo "" . $query;
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

    public function getSamaExcessTchrListRound5($eo_code, $option_medium_type) {

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        try {
            $query = "SELECT sm.sanstha_code,sanstha_name,tch_ex_id,tchr_fname,tchr_mname, tchr_lname,
                            tchr_curr_desg_cd,post_desc,
                            schl_id,schl_name,tchr_birth_dt,tchr_curr_desig_dt,
                            tc_categ,tc_categ_desc, 
                            tq_adegree,tq_adegname,tq_pdegree,tq_pdegname,
                            ts_subject_tot1,ts_subjectdesc_tot1,ts_subject_tot2,ts_subjectdesc_tot2 ,
                            ts_smj_schl_id,  ts_smj_eo_code , ts_smj_tch_sub , ts_smj_dtts, new_sanstha_code ,ts_smj_categ_cd,
                            stg_flg1,stg_flg2,stg_flg3,stg_flg4,eos_medium_id,stg_flg5,stg_flg6,tchr_gender
                            
                         FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master 
                         WHERE      eos_medium_id='" . $option_medium_type . "' 
                                AND sch_type ='" . $sch_type . "'
                                AND schl_id like '" . $dist_id . "%'
                                AND sm.asst_flag = 'A'
                                AND sm.stg_flg4 = 'W'
                                AND ts_subject_tot2 is not NULL
                                AND bi.sanstha_code = sm.sanstha_code 
                                AND bi.minority_sanstha IN $minority_type_cond
                                AND sm.sanstha_code in 
                         (SELECT sanstha_code 
                            FROM samayojan.eo_sanstha_ex_vac
                                WHERE eo_code='" . $eo_code . "'
                                      AND asst_flag= 'A'
                                      AND ac_year = '$global_ac_year'
                                      AND minority_sanstha IN $minority_type_cond
                          )
                                AND post_type = 1
                                AND post_id = tchr_curr_desg_cd   
                           ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
                         ";

//            echo "" . $query;
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
    
    public function getSamaExcessTchrListRound6($eo_code, $option_medium_type) {

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        try {
            $query = "SELECT sm.sanstha_code,sanstha_name,tch_ex_id,tchr_fname,tchr_mname, tchr_lname,
                            tchr_curr_desg_cd,post_desc,
                            schl_id,schl_name,tchr_birth_dt,tchr_curr_desig_dt,
                            tc_categ,tc_categ_desc, 
                            tq_adegree,tq_adegname,tq_pdegree,tq_pdegname,
                            ts_subject_tot1,ts_subjectdesc_tot1,ts_subject_tot2,ts_subjectdesc_tot2 ,
                            ts_smj_schl_id,  ts_smj_eo_code , ts_smj_tch_sub , ts_smj_dtts, new_sanstha_code ,ts_smj_categ_cd,
                            stg_flg1,stg_flg2,stg_flg3,stg_flg4,eos_medium_id,stg_flg5,stg_flg6,tchr_gender
                            
                         FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master 
                         WHERE      eos_medium_id='" . $option_medium_type . "' 
                                AND sch_type ='" . $sch_type . "'
                                AND schl_id like '" . $dist_id . "%'
                                AND sm.asst_flag = 'A'
                                AND sm.stg_flg5 = 'W'
                                AND ts_subject_tot2 is not NULL
                                AND bi.sanstha_code = sm.sanstha_code 
                                AND bi.minority_sanstha IN $minority_type_cond
                                AND sm.sanstha_code in 
                                    (SELECT sanstha_code 
                                        FROM samayojan.eo_sanstha_ex_vac
                                         WHERE eo_code = '" . $eo_code . "'
                                               AND asst_flag = 'A'
                                               AND ac_year = '$global_ac_year'
                                               AND minority_sanstha IN $minority_type_cond
                                       )
                                AND post_type = 1
                                AND post_id = tchr_curr_desg_cd   
                           ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
                         ";

//            echo "" . $query;
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

    public function getExcessTchrListDydRound($eo_code, $option_medium_type) {
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        try {


            $query = "SELECT sm.sanstha_code,sanstha_name,tch_ex_id,tchr_fname,tchr_mname, tchr_lname,
                            tchr_curr_desg_cd,post_desc,
                            schl_id,schl_name,tchr_birth_dt,tchr_curr_desig_dt,
                            tc_categ,tc_categ_desc, 
                            tq_adegree,tq_adegname,tq_pdegree,tq_pdegname,
                            ts_subject_tot1,ts_subjectdesc_tot1,ts_subject_tot2,ts_subjectdesc_tot2 ,
                            ts_smj_schl_id,  ts_smj_eo_code , ts_smj_tch_sub , ts_smj_dtts, new_sanstha_code ,ts_smj_categ_cd,
                            stg_flg1,stg_flg2,stg_flg3,stg_flg4,eos_medium_id,sd.distname
                            
                         FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master,shala_live.shala_district as sd 
                         WHERE substr(sm.schl_id,1,4) = sd.distcd           
                                AND eos_medium_id='" . $option_medium_type . "' 
                                AND sch_type ='" . $sch_type . "'
                                AND schl_id like '" . $dist_id . "%'
                                AND sm.asst_flag = 'A'
                                AND sm.stg_flg3 ='W'
                                AND bi.sanstha_code=sm.sanstha_code 
                                AND bi.minority_sanstha IN $minority_type_cond
                                AND sm.ac_year = '$global_ac_year'
                                AND sm.sanstha_code 
                                  IN(SELECT sanstha_code 
                                     FROM samayojan.eo_sanstha_ex_vac
                                     WHERE 
                                             eo_code='" . $eo_code . "'
                                        AND asst_flag= 'A'
                                        AND minority_sanstha IN $minority_type_cond  )
                                        AND post_type=1
                                        AND ac_year = '$global_ac_year'
                                        AND post_id=tchr_curr_desg_cd   
                                  ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
                         ";

//            echo "" . $query;
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

    public function ex_tchrdetailreturn($sanstha_code, $dist_cd, $schl_type, $eos_type, $desig_cd, $med_cd) {
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }
            $query = "SELECT 
                                SED.schl_id,SED.schl_name ,
                                SED.tch_ex_id,SED.tchr_fname,SED.tchr_mname,SED.tchr_lname,
                                SED.tchr_serv_entry_dt,SED.tchr_birth_dt,
                                SED.tq_adegree,SED.tq_adegname,
                                SED.tq_pdegree,SED.tq_pdegname,
                                SED.ts_subject_tot1,SED.ts_subjectdesc_tot1,
                                SED.ts_subject_tot2,SED.ts_subjectdesc_tot2                                
                                
                       FROM     samayojan.smj_excesstch_det as SED
		     LEFT JOIN  shala.shala_all_school as SAS
                             ON SED.schl_id = SAS.schcd  AND SAS.$schl_type_condition
  
		  WHERE      SED.sanstha_code='" . $sanstha_code . "'
			AND  SED.schl_id LIKE '" . $dist_cd . "%' 
                        AND SED.schl_id = SAS.schcd
                        AND  SED.tchr_curr_desg_cd = $desig_cd
                        AND  SED.eos_medium_id='" . $med_cd . "'   
		        AND  (SED.asst_flag ='V')
                         ";
//            echo "" . $query;
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

    public function getMediumComplaintVerificationEo($eo_code, $sch_type, $dist_id) {
        try {

            $query = "SELECT DISTINCT(SED.eos_medium_id),SM.medinstr_desc
                        FROM samayojan.smj_excesstch_det SED
                        LEFT JOIN master.shala_medinstr as SM ON SED.eos_medium_id = SM.medinstr_id 
                        WHERE SED.asst_flag='A'
                        AND SED.schl_id like '$dist_id%'
                        AND SED.sch_type='$sch_type'";


//            $query = "SELECT DISTINCT(ECR.eos_medium_id),SM.medinstr_desc
//                        FROM samayojan.eo_complaints_reg as ECR
//                        LEFT JOIN master.shala_medinstr as SM ON ECR.eos_medium_id = SM.medinstr_id 
//                        WHERE ECR.eo_code='$eo_code' ";
//            echo "" . $query;
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

    public function getSansthaComplaintVerificationEoList($eo_code, $option_medium_type) {
        try {
            $dist_id = substr($eo_code, 0, 4);
            $sch_type = substr($eo_code, 6, 8);

//            $query = "select tmp.sanstha_code,sanstha_name,sum(tmp.excess) excess,sum(tmp.vacant)vacant,sum(tmp.total_staff)total_stafffrom from (
//                    select tmp.sanstha_code,tmp.excess,tmp.vacant,0 as total_staff from (
//                    select sanstha_code,sum(eos_no_of_post) excess,0 as vacant from samayojan.eo_sanstha_ex_vac where dist_code='$dist_id'
//                             and asst_flag='A' and schl_type='$sch_type' and eos_type='1' and eos_medium_id='$option_medium_type' and minority_sanstha='1' 
//                    group by sanstha_code,eos_type
//                    union 
//                    select sanstha_code,0 as excess,sum(eos_no_of_post) vacant from samayojan.eo_sanstha_ex_vac where dist_code='$dist_id'  
//                      and asst_flag='A' and schl_type='$sch_type' and eos_type='2' and eos_medium_id='$option_medium_type' and minority_sanstha='1'  
//                    group by sanstha_code,eos_type)tmp
//                    union
//                    select smj.sanstha_code,0 as excess,0 as vacant,count(tch_ex_id) total_staff from samayojan.smj_excesstch_det smj  ,
//                    samayojan.sanstha_basic_info sbi                                                    
//                    where substr(schl_id,1,4)='$dist_id' and  sbi.sanstha_code=smj.sanstha_code and minority_sanstha='1' and asst_flag='A'    
//                     and sch_type='$sch_type' and eos_medium_id='$option_medium_type' 
//                    group by smj.sanstha_code order by sanstha_code)tmp
//                    LEFT JOIN samayojan.sanstha_basic_info sbi on sbi.sanstha_code=tmp.sanstha_code
//                    group by tmp.sanstha_code,sanstha_name order by sanstha_name";


            $query = "SELECT tmp.sanstha_code,sanstha_name,SUM(tmp.excess)as excess_declared,SUM(tmp.vacant) as vacant_declared,
                             SUM(tmp.total_staff) as excess_staff_filled
                     FROM (
                            SELECT tmp.sanstha_code,tmp.excess,tmp.vacant,0 as total_staff 
                            FROM (                 
                                    (SELECT sanstha_code,SUM(eos_no_of_post) excess,0 as vacant 
                                        FROM samayojan.eo_sanstha_ex_vac 
                                        WHERE dist_code='$dist_id' AND asst_flag='A' AND schl_type='$sch_type' AND eos_type='1' AND eos_medium_id='$option_medium_type' 
                                              AND minority_sanstha='1' 
                                         GROUP BY sanstha_code,eos_type
                                    )
                                    UNION 
                                    (SELECT sanstha_code,0 as excess,SUM(eos_no_of_post) vacant 
                                        FROM samayojan.eo_sanstha_ex_vac
                                        WHERE dist_code='$dist_id'  AND asst_flag='A' AND schl_type='$sch_type' AND eos_type='2' AND eos_medium_id='$option_medium_type' 
                                              AND  minority_sanstha='1'  
                                        GROUP BY sanstha_code,eos_type
                                    )
                                 )tmp
                    UNION
                          (
                            SELECT smj.sanstha_code,0 as excess,0 as vacant,count(tch_ex_id) total_staff 
                            FROM samayojan.smj_excesstch_det smj,samayojan.sanstha_basic_info sbi                                                
                            WHERE substr(schl_id,1,4)='$dist_id' AND  sbi.sanstha_code=smj.sanstha_code AND minority_sanstha='1' AND asst_flag='A' 
                                  AND sch_type='$sch_type' AND eos_medium_id='$option_medium_type' 
                            GROUP BY smj.sanstha_code ORDER BY sanstha_code
                          )
                    )tmp
                    LEFT JOIN samayojan.sanstha_basic_info as sbi ON sbi.sanstha_code=tmp.sanstha_code
                   
                    GROUP BY tmp.sanstha_code,sanstha_name ORDER BY sanstha_name"; // RIGHT JOIN  samayojan.eo_complaints_reg as ecr ON ecr.sanstha_code = tmp.sanstha_code
//            echo "" . $query;
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

    public function checkIncompleteRoundsTchrInfoRevertSamayojan($option_schl_type, $dist_cd_revert, $medium_cd_revert) {

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        try {
            $query = "SELECT sm.sanstha_code,sanstha_name,tch_ex_id,tchr_fname,tchr_mname, tchr_lname,
                            tchr_curr_desg_cd,post_desc,
                            schl_id,schl_name,tchr_birth_dt,tchr_curr_desig_dt,
                            tc_categ,tc_categ_desc, 
                            tq_adegree,tq_adegname,tq_pdegree,tq_pdegname,
                            ts_subject_tot1,ts_subjectdesc_tot1,ts_subject_tot2,ts_subjectdesc_tot2 ,
                            ts_smj_schl_id,  ts_smj_eo_code , ts_smj_tch_sub , ts_smj_dtts, new_sanstha_code ,ts_smj_categ_cd,
                            stg_flg1,stg_flg2,stg_flg3,stg_flg4,eos_medium_id,sch_type
                            
                         FROM samayojan.smj_excesstch_det sm,samayojan.sanstha_basic_info bi,master.tchr_post_master 
                         WHERE  eos_medium_id='" . $medium_cd_revert . "' 
                            AND sch_type ='" . $option_schl_type . "'
                            AND schl_id like '" . $dist_cd_revert . "%'
                            AND sm.asst_flag = 'A'
                            AND bi.sanstha_code=sm.sanstha_code 
                            AND bi.minority_sanstha IN $minority_type_cond
                            AND post_type=1
                            AND post_id=tchr_curr_desg_cd   
                            AND ( stg_flg1  !='N' OR stg_flg2  !='N' OR stg_flg3  !='N' )
                           ORDER BY tchr_curr_desig_dt desc,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
                         ";
//            echo "" . $query;
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

}
