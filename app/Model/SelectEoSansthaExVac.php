<?php

class SelectEoSansthaExVac extends AppModel {

    public $useDbConfig = 'use_db_pavitra_data';
    var $name = "SelectEoSansthaExVac";
    var $useTable = 'pv_eo_sanstha_ex_vac'; //db=Teacher schema=pavitra

    public function getPerticularPostwiseInfoForAcceptAndExcessSansthaDeclared($schl_id, $school_posts_code) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            $query = "SELECT SUM(eos_no_of_post) as eos_no_of_post
                      FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                      WHERE  
                            ESEV.schl_id='" . $schl_id . "' 
                                 AND ESEV.ac_year = '$global_ac_year'
                        AND ESEV.eos_desg_cd='" . $school_posts_code . "'
                "; // posttype 1=Teaching 2=Non-Teaching
//        echo "".$query;exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function findFilledDataInfo_find_sucuess_ex_vac($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            $query = "SELECT  DISTINCT ESEV.eos_type                               
                        FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                            LEFT JOIN shala_live.shala_district as SD ON ESEV.dist_code = SD.distcd
                            LEFT JOIN shala.shala_all_school as SAS ON ESEV.schl_id = SAS.schcd
                            LEFT JOIN master.tchr_post_master as TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                            LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id
                           LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                        WHERE  ESEV.sanstha_code='" . $sanstha_code . "'
                          AND ESEV.schl_id='" . $schl_id . "' 
                          AND ESEV.eos_medium_id='" . $eos_medium_id . "' 
                          AND ESEV.ac_year = '$global_ac_year'    
                          AND ESEV.eos_desg_cd='" . $eos_desg_cd . "' 
                ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL) {
                return $result;
            } else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function findFilledDataInfo_find_sucuess($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type, $option_subject_code) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($option_subject_code == '')
                $option_subject_code_condition = 'IS NULL';
            else
                $option_subject_code_condition = '= ' . $option_subject_code;

            $query = "SELECT
                            ESEV.dist_code,
                            SD.distname,
                            ESEV.schl_type,
                            ESEV.eo_code, 
                            ESEV.sanstha_code,
                            ESEV.schl_id,
                            trim(SAS.school_name) as school_name,
                            ESEV.eos_medium_id,
                            SM.medinstr_desc,
                            ESEV.eos_desg_cd,
                            TPM.post_desc,
                            ESEV.eos_online_posts,
                            ESEV.eos_offline_posts,
                            ESEV.eos_type,
                            ESEV.eos_no_of_post,
                            ESEV.eos_subject_cd,
                            sis.subject_group_desc as code_text,
                            ESEV.asst_flag,
                            ESEV.consider_vacancy_flag,
                            ESEV.staff_type,
                            cdd.code_text as aid_type
                         FROM             pavitra.pv_eo_sanstha_ex_vac as ESEV
                                LEFT JOIN shala_live.shala_district as SD  ON ESEV.dist_code = SD.distcd
                                LEFT JOIN shala.shala_all_school as SAS ON ESEV.schl_id = SAS.schcd
                                LEFT JOIN master.tchr_post_master as TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                                LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id
                                LEFT JOIN master.cddir as cdd ON ESEV.aid_type=cdd.code_value AND cdd.code_type='AD'
                                LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                         WHERE      ESEV.sanstha_code='" . $sanstha_code . "'
                            AND ESEV.schl_id='" . $schl_id . "' 
                            AND ESEV.eos_medium_id='" . $eos_medium_id . "' 
                            AND ESEV.eos_desg_cd='" . $eos_desg_cd . "' 
                            AND ESEV.eos_type='" . $eos_type . "'
                            AND ESEV.ac_year = '$global_ac_year'
                            AND eos_subject_cd  $option_subject_code_condition 
                ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL) {
//                return $result;
                return 1;
            } else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function checkdata($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            $query = "SELECT sum(ESEV.eos_no_of_post)eos_no_of_post
                         FROM             pavitra.pv_eo_sanstha_ex_vac as ESEV
                                LEFT JOIN shala_live.shala_district as SD  ON ESEV.dist_code = SD.distcd
                                LEFT JOIN shala.shala_all_school as SAS ON ESEV.schl_id = SAS.schcd
                                LEFT JOIN master.tchr_post_master as TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                                LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id
                                LEFT JOIN master.cddir as cdd ON ESEV.aid_type=cdd.code_value AND cdd.code_type='AD'
                                LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                         WHERE      ESEV.sanstha_code='" . $sanstha_code . "'
                            AND ESEV.schl_id='" . $schl_id . "' 
                            AND ESEV.eos_medium_id='" . $eos_medium_id . "' 
                            AND ESEV.eos_desg_cd='" . $eos_desg_cd . "' 
                            AND ESEV.eos_type='" . $eos_type . "'
                            AND ESEV.ac_year = '$global_ac_year'
                            
                ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL) {
                return $result;
//                return 1;
            } else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function findFilledDataInfo_find_sucuessMM($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type, $option_subject_code) {
        $global_ac_year = Configure::read('global_ac_year');

        try {
            if ($option_subject_code == '')
                $option_subject_code_condition = 'IS NULL';
            else
                $option_subject_code_condition = '= ' . $option_subject_code;

            $query = "SELECT 
                            ESEV.dist_code,
                            SD.distname,
                            ESEV.schl_type,
                            ESEV.eo_code, 
                            ESEV.sanstha_code,
                            ESEV.schl_id, 
                            trim(SAS.school_name) as school_name,
                            ESEV.eos_medium_id,
                            SM.medinstr_desc,
                            ESEV.eos_desg_cd, 
                            TPM.post_desc,
                            ESEV.eos_online_posts,
                            ESEV.eos_offline_posts,
                            ESEV.eos_type,
                            ESEV.eos_no_of_post,
                            ESEV.eos_subject_cd,
                            sis.subject_group_desc as code_text,
                            ESEV.asst_flag,
                            ESEV.consider_vacancy_flag,
                            ESEV.staff_type,
                            cdd.code_text as aid_type
                         FROM              pavitra.pv_eo_sanstha_ex_vac as ESEV
                                LEFT JOIN shala_live.shala_district as SD ON ESEV.dist_code = SD.distcd
                                LEFT JOIN shala.shala_all_school as SAS ON ESEV.schl_id = SAS.schcd
                                LEFT JOIN master.tchr_post_master as TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                                LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id
                                LEFT JOIN master.cddir as cdd ON ESEV.aid_type=cdd.code_value AND cdd.code_type='AD'
                                LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                     WHERE  
                                    ESEV.sanstha_code='" . $sanstha_code . "'
                                AND ESEV.schl_id='" . $schl_id . "' 
                                AND ESEV.eos_medium_id='" . $eos_medium_id . "' 
                                AND ESEV.eos_desg_cd='" . $eos_desg_cd . "' 
                                AND ESEV.eos_type='" . $eos_type . "'
                                AND ESEV.ac_year = '$global_ac_year'
                                AND eos_subject_cd  $option_subject_code_condition 
                ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL) {
//                return $result;
                return 0;
            } else {
//$result=0;
                return 1;
            }
        } catch (Exception $e) {
            return 1;
        }
    }

    public function findFilledDataInfo($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            $query = "SELECT 
                                ESEV.dist_code,
                                SD.distname,
                                ESEV.schl_type,
                                ESEV.eo_code,
                                ESEV.sanstha_code,
                                ESEV.schl_id,
                                trim(SAS.school_name) as school_name,
                                ESEV.eos_medium_id,
                                SM.medinstr_desc,
                                ESEV.eos_desg_cd, 
                                TPM.post_desc,
                                ESEV.eos_online_posts,
                                ESEV.eos_offline_posts,
                                ESEV.eos_type,
                                ESEV.eos_no_of_post,
                                ESEV.eos_subject_cd,
                                sis.subject_group_desc as code_text,
                                ESEV.asst_flag,
                                ESEV.consider_vacancy_flag,
                                ESEV.staff_type,
                                cdd.code_text as aid_type,
                                cdd.code_value as aid_type_value
                         FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                            LEFT JOIN shala_live.shala_district as SD ON ESEV.dist_code = SD.distcd
                            LEFT JOIN shala.shala_all_school as SAS ON ESEV.schl_id = SAS.schcd
                            LEFT JOIN master.tchr_post_master as TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                            LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id
                            LEFT JOIN master.cddir as cdd ON ESEV.aid_type=cdd.code_value AND cdd.code_type='AD'
                            LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                     WHERE      ESEV.sanstha_code='" . $sanstha_code . "'
                            AND ESEV.schl_id='" . $schl_id . "' 
                            AND ESEV.eos_medium_id='" . $eos_medium_id . "' 
                            AND ESEV.eos_desg_cd='" . $eos_desg_cd . "' 
                            AND ESEV.ac_year = '$global_ac_year'
                            AND ESEV.eos_type='" . $eos_type . "'
                ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function findFilledDataInfo_post_change($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            $query = "SELECT ESEV.dist_code,
                             SD.distname,
                             ESEV.schl_type,
                             ESEV.eo_code, 
                             ESEV.sanstha_code,
                             ESEV.schl_id, 
                             trim(SAS.school_name) as school_name,
                             ESEV.eos_medium_id, 
                             SM.medinstr_desc,
                             ESEV.eos_desg_cd,  
                             TPM.post_desc,
                             ESEV.eos_online_posts,
                             ESEV.eos_offline_posts,
                             ESEV.eos_type,
                             ESEV.eos_no_of_post,
                             ESEV.shifted_tchr_cnt,
                             ESEV.eos_subject_cd,
                             sis.subject_group_desc as code_text,
                             ESEV.asst_flag,
                             ESEV.consider_vacancy_flag,
                             ESEV.staff_type,
                             ESEV.vac_crd_aft_smj,
                             cdd.code_text as aid_type,
                             cdd.code_value as aid_type_value
                       FROM               pavitra.pv_eo_sanstha_ex_vac as ESEV
                                LEFT JOIN shala_live.shala_district as SD ON ESEV.dist_code = SD.distcd
                                LEFT JOIN shala.shala_all_school as SAS ON ESEV.schl_id = SAS.schcd
                                LEFT JOIN master.tchr_post_master as TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                                LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id
                                LEFT JOIN master.cddir as cdd ON ESEV.aid_type=cdd.code_value AND cdd.code_type='AD'
                               LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                     WHERE      ESEV.sanstha_code='" . $sanstha_code . "'
                            AND ESEV.schl_id='" . $schl_id . "' 
                            AND ESEV.eos_medium_id='" . $eos_medium_id . "' 
                            AND ESEV.ac_year = '$global_ac_year'
                            AND ESEV.eos_desg_cd='" . $eos_desg_cd . "'   
                ";
//                echo "" . $query;
//                exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function findFilledDataInfo_post_change_sum($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd) {
        $global_ac_year = Configure::read('global_ac_year');

        try {
            $query = "SELECT 
                            SUM(eos_no_of_post) as eos_no_of_post_all_sum 
                             FROM 
                                (SELECT 
                                        ESEV.dist_code,
                                        SD.distname,
                                        ESEV.schl_type,
                                        ESEV.eo_code, 
                                        ESEV.sanstha_code,
                                        ESEV.schl_id,
                                        ESEV.shifted_tchr_cnt,
                                        trim(SAS.school_name) as school_name,
                                        ESEV.eos_medium_id, 
                                        SM.medinstr_desc,
                                        ESEV.eos_desg_cd,  
                                        TPM.post_desc,
                                        ESEV.eos_online_posts,
                                        ESEV.eos_offline_posts,
                                        ESEV.eos_type,
                                        ESEV.eos_no_of_post,
                                        ESEV.eos_subject_cd,
                                        sis.subject_group_desc as code_text,
                                        ESEV.asst_flag,
                                        ESEV.consider_vacancy_flag,
                                        ESEV.staff_type,
                                        cdd.code_text as aid_type,
                                        cdd.code_value as aid_type_value
                        FROM                 pavitra.pv_eo_sanstha_ex_vac as ESEV
                                    LEFT JOIN shala_live.shala_district as SD ON ESEV.dist_code = SD.distcd
                                    LEFT JOIN shala.shala_all_school as SAS ON ESEV.schl_id = SAS.schcd
                                    LEFT JOIN master.tchr_post_master as TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                                    LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id
                                    LEFT JOIN master.cddir as cdd ON ESEV.aid_type=cdd.code_value AND cdd.code_type='AD'
                                    LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                        WHERE       ESEV.sanstha_code='" . $sanstha_code . "'
                                AND ESEV.schl_id='" . $schl_id . "' 
                                AND ESEV.eos_medium_id='" . $eos_medium_id . "' 
                                AND ESEV.ac_year = '$global_ac_year'
                                AND ESEV.eos_desg_cd='" . $eos_desg_cd . "'
                        GROUP BY 
                                cdd.code_value,
                                cdd.code_text,
                                ESEV.staff_type,
                                ESEV.shifted_tchr_cnt,
                                ESEV.dist_code,SD.distname,
                                ESEV.schl_type,
                                ESEV.eo_code, ESEV.sanstha_code,
                                ESEV.schl_id, SAS.school_name,
                                ESEV.eos_medium_id, SM.medinstr_desc,
                                ESEV.eos_desg_cd,  TPM.post_desc,
                                ESEV.eos_online_posts,ESEV.eos_offline_posts,
                                ESEV.eos_type,
                                ESEV.eos_no_of_post,
                                ESEV.eos_subject_cd,sis.subject_group_desc,
                                ESEV.asst_flag,
                                 ESEV.consider_vacancy_flag) as tmp
                ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function findFilledDataInfo_delete($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            $query = "SELECT 
                                ESEV.dist_code,
                                SD.distname,
                                ESEV.schl_type,
                                ESEV.eo_code,
                                ESEV.sanstha_code,
                                ESEV.schl_id, 
                                trim(SAS.school_name) as school_name,
                                ESEV.eos_medium_id, 
                                SM.medinstr_desc,
                                ESEV.eos_desg_cd,
                                TPM.post_desc,
                                ESEV.eos_online_posts,
                                ESEV.eos_offline_posts,
                                ESEV.eos_type,
                                ESEV.eos_no_of_post,
                                ESEV.eos_subject_cd,
                                sis.subject_group_desc as code_text,
                                ESEV.asst_flag,
                                ESEV.consider_vacancy_flag
                                ESEV.staff_type,
                                cdd.code_text as aid_type
                        FROM              pavitra.pv_eo_sanstha_ex_vac as ESEV
                                LEFT JOIN shala_live.shala_district as SD ON ESEV.dist_code = SD.distcd
                                LEFT JOIN shala.shala_all_school as SAS ON ESEV.schl_id = SAS.schcd
                                LEFT JOIN master.tchr_post_master as TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                                LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id
                                LEFT JOIN master.cddir as cdd ON ESEV.aid_type=cdd.code_value AND cdd.code_type='AD'
                                LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                        WHERE  ESEV.sanstha_code='" . $sanstha_code . "'
                           AND ESEV.schl_id='" . $schl_id . "' 
                           AND ESEV.eos_medium_id='" . $eos_medium_id . "'  
                           AND ESEV.ac_year = '$global_ac_year'
                           AND ESEV.eos_desg_cd='" . $eos_desg_cd . "'  
                ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function findFilledDataInfo_delete123456789($sanstha_code, $schl_id, $eos_medium_id) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            $query = "SELECT ESEV.dist_code,SD.distname,
                                ESEV.schl_type,
                                  ESEV.eo_code, ESEV.sanstha_code,
                                ESEV.schl_id,
                                trim(SAS.school_name) as school_name,
                                ESEV.eos_medium_id, SM.medinstr_desc,
                                ESEV.eos_desg_cd,  TPM.post_desc,
                                ESEV.eos_type,
                                 ESEV.eos_master_total,
                                 ESEV.eos_no_of_post,
                                ESEV.eos_subject_cd,
                                ESEV.eos_reserv_categ_cd,CD.code_text,
                                ESEV.asst_flag
                         FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			LEFT JOIN shala_live.shala_district as SD
                         ON ESEV.dist_code = SD.distcd
			LEFT JOIN shala.shala_all_school as SAS
                         ON ESEV.schl_id = SAS.schcd
			LEFT JOIN master.tchr_post_master as TPM
                         ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                         LEFT JOIN master.shala_medinstr as SM
                         ON ESEV.eos_medium_id = SM.medinstr_id
			 LEFT JOIN master.cddir as CD
                         ON ESEV.eos_reserv_categ_cd = CAST (CD.code_value as numeric)  AND CD.code_type='CT'
                     WHERE  ESEV.sanstha_code='" . $sanstha_code . "'
                    AND    ESEV.schl_id='" . $schl_id . "' 
                         AND ac_year = '$global_ac_year'
                    AND ESEV.eos_medium_id='" . $eos_medium_id . "'  
                ";

            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateFilledDataInfo($sanstha_dist_cd_old, $option_schl_type_old, $eo_code_old, $sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old, $eos_online_posts_old, $eos_offline_posts_old, $eos_type_old, $eos_no_of_post_old, $option_subject_code_old, $asst_flag_old, $consider_vacancy_flag_old, $sanstha_dist_cd, $option_schl_type, $eo_code, $sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_online_posts, $eos_offline_posts, $eos_type, $eos_no_of_post, $option_subject_code, $consider_vacancy_flag) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($option_subject_code == '')
                $option_subject_code = 'NULL';
            if ($option_subject_code_old == '')
                $option_subject_code_old_condition = 'IS NULL';
            else
                $option_subject_code_old_condition = '= ' . $option_subject_code_old;
//echo "-------".$asst_flag_old;exit();
            if ($asst_flag_old == 'E') {
                $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                   dist_code='" . $sanstha_dist_cd . "',
                   schl_type='" . $option_schl_type . "',
                   eo_code='" . $eo_code . "',
                   sanstha_code='" . $sanstha_code . "',
                   schl_id='" . $schl_id . "', 
                   eos_medium_id='" . $eos_medium_id . "',
                   eos_desg_cd= $eos_desg_cd,
                   eos_type='" . $eos_type . "',
                   eos_online_posts= $eos_online_posts,
                   eos_offline_posts= $eos_offline_posts,
                   eos_no_of_post= $eos_no_of_post, 
                   ac_year = '$global_ac_year',
                   eos_subject_cd = $option_subject_code ,
                   consider_vacancy_flag = '" . $consider_vacancy_flag . "' 
                       
                WHERE    dist_code='" . $sanstha_dist_cd_old . "'
                   AND   schl_type='" . $option_schl_type_old . "'
                   AND   eo_code='" . $eo_code_old . "'
                   AND   sanstha_code='" . $sanstha_code_old . "'
                   AND   schl_id='" . $schl_id_old . "' 
                   AND   eos_medium_id='" . $eos_medium_id_old . "'
                   AND   eos_desg_cd=$eos_desg_cd_old
                   AND   eos_type='" . $eos_type_old . "' 
                   AND   eos_online_posts=$eos_online_posts_old
                   AND   eos_offline_posts=$eos_offline_posts_old
                   AND   eos_no_of_post = $eos_no_of_post_old
                   AND   asst_flag = 'E'
                   AND   ac_year = '$global_ac_year'
                   AND   eos_subject_cd  $option_subject_code_old_condition 
                   AND  consider_vacancy_flag = '" . $consider_vacancy_flag_old . "' 
                  ";
//            echo "" . $query;
//            exit();
                $result = $this->query($query);
                if ($result <> NULL)
                    return $result;
                else
                    return 0;
            }//IF
//            else if ($asst_flag_old == 'R') {
//                $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
//                SET
//                  dist_code='" . $sanstha_dist_cd . "',
//                   schl_type='" . $option_schl_type . "',
//                   eo_code='" . $eo_code . "',
//                   sanstha_code='" . $sanstha_code . "',
//                   schl_id='" . $schl_id . "', 
//                   eos_medium_id='" . $eos_medium_id . "',
//                   eos_desg_cd= $eos_desg_cd,
//                   eos_type='" . $eos_type . "',
//                   eos_online_posts= $eos_online_posts,
//                   eos_offline_posts= $eos_offline_posts,
//                    eos_no_of_post= $eos_no_of_post, 
//                    eos_subject_cd=$option_subject_code ,
//                        asst_flag ='E'
//                WHERE    dist_code='" . $sanstha_dist_cd_old . "'
//                   AND   schl_type='" . $option_schl_type_old . "'
//                   AND   eo_code='" . $eo_code_old . "'
//                   AND   sanstha_code='" . $sanstha_code_old . "'
//                   AND   schl_id='" . $schl_id_old . "' 
//                   AND   eos_medium_id='" . $eos_medium_id_old . "'
//                   AND   eos_desg_cd=$eos_desg_cd_old
//                   AND   eos_type='" . $eos_type_old . "' 
//                   AND   eos_online_posts=$eos_online_posts_old
//                   AND   eos_offline_posts=$eos_offline_posts_old
//                   AND   eos_no_of_post = $eos_no_of_post_old
//                   AND   asst_flag = 'R'
//                   AND   eos_subject_cd  $option_subject_code_old_condition 
//                  ";
////            echo "" . $query;
////            exit();
//                $result = $this->query($query);
//
//
//                $query1 = "UPDATE pavitra.smj_excesstch_det
//                SET
//                        asst_flag='E',
//                        upd_dtts = now()
//                WHERE     
//                       sanstha_code='" . $sanstha_code_old . "'
//                        AND   tchr_curr_desg_cd = $eos_desg_cd_old
//                   AND   schl_id like '%" . $sanstha_dist_cd . "%' 
//                   AND   eos_medium_id='" . $eos_medium_id_old . "'
//                   AND   asst_flag = 'R'
//                   AND sch_type  = '" . $option_schl_type . "'
//                  ";
////            echo "" . $query1;
////            exit();
//                $result1 = $this->query($query1);
//
//
//                if ($result1 <> NULL)
//                    return $result1;
//                else
//                    return 0;
//            }//ELSE
//            ----------------------------------------
//                    $this->SelectEoSansthaExVac->updateAll(array('asst_flag' => "'$asst_flag'"), array('sanstha_code' => $sanstha_code, 'eos_desg_cd' => $tchr_curr_desg_cd, 'schl_type' => $higcls, 'eos_type' => '1', 'dist_code' => $dist, 'asst_flag' => 'R', 'eos_medium_id' => $med));
//            -----------------------------------------
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateFilledDataInfoEoSmj($sanstha_dist_cd_old, $option_schl_type_old, $eo_code_old, $sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old, $eos_online_posts_old, $eos_offline_posts_old, $eos_type_old, $eos_no_of_post_old, $option_subject_code_old, $asst_flag_old, $consider_vacancy_flag_old, $sanstha_dist_cd, $option_schl_type, $eo_code, $sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_online_posts, $eos_offline_posts, $eos_type, $eos_no_of_post, $option_subject_code, $consider_vacancy_flag) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($option_subject_code == '')
                $option_subject_code = 'NULL';
            if ($option_subject_code_old == '')
                $option_subject_code_old_condition = 'IS NULL';
            else
                $option_subject_code_old_condition = '= ' . $option_subject_code_old;
//echo "-------".$asst_flag_old; 
            if ($asst_flag_old == 'Z') {
                $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  dist_code='" . $sanstha_dist_cd . "',
                   schl_type='" . $option_schl_type . "',
                   eo_code='" . $eo_code . "',
                   sanstha_code='" . $sanstha_code . "',
                   schl_id='" . $schl_id . "', 
                   eos_medium_id='" . $eos_medium_id . "',
                   eos_desg_cd= $eos_desg_cd,
                   eos_type='" . $eos_type . "',
                   eos_online_posts= $eos_online_posts,
                   eos_offline_posts= $eos_offline_posts,
                    eos_no_of_post= $eos_no_of_post, 
                  eos_subject_cd=$option_subject_code ,
                          ac_year = '$global_ac_year',
                        asst_flag = 'Z' ,
			 consider_vacancy_flag = '" . $consider_vacancy_flag . "' 
                WHERE    dist_code='" . $sanstha_dist_cd_old . "'
                   AND   schl_type='" . $option_schl_type_old . "'
                   AND   eo_code='" . $eo_code_old . "'
                   AND   sanstha_code='" . $sanstha_code_old . "'
                   AND   schl_id='" . $schl_id_old . "' 
                   AND   eos_medium_id='" . $eos_medium_id_old . "'
                   AND   eos_desg_cd=$eos_desg_cd_old
                   AND   eos_type='" . $eos_type_old . "' 
                   AND   eos_online_posts=$eos_online_posts_old
                   AND   eos_offline_posts=$eos_offline_posts_old
                   AND   eos_no_of_post = $eos_no_of_post_old
                   AND  asst_flag = 'Z' 
                   AND  ac_year = '$global_ac_year' 
                   AND   eos_subject_cd  $option_subject_code_old_condition 
		    AND  consider_vacancy_flag = '" . $consider_vacancy_flag_old . "' 
                  ";
//            echo "ZZZZZZZZZZZZZZZZZZZZZZ" . $query;
//            exit();
                $result = $this->query($query);
                if ($result <> NULL)
                    return $result;
                else
                    return 0;
            }//IF

            else if ($asst_flag_old == 'E') {
                $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                   dist_code='" . $sanstha_dist_cd . "',
                   schl_type='" . $option_schl_type . "',
                   eo_code='" . $eo_code . "',
                   sanstha_code='" . $sanstha_code . "',
                   schl_id='" . $schl_id . "', 
                   eos_medium_id='" . $eos_medium_id . "',
                   eos_desg_cd= $eos_desg_cd,
                   eos_type='" . $eos_type . "',
                   eos_online_posts= $eos_online_posts,
                   eos_offline_posts= $eos_offline_posts,
                   eos_no_of_post= $eos_no_of_post, 
                   eos_subject_cd=$option_subject_code ,
                   asst_flag='Z', 
		   ac_year = '$global_ac_year',
		   consider_vacancy_flag = '" . $consider_vacancy_flag . "' 
                WHERE    
                        dist_code='" . $sanstha_dist_cd_old . "'
                   AND schl_type='" . $option_schl_type_old . "'
                   AND eo_code='" . $eo_code_old . "'
                   AND sanstha_code='" . $sanstha_code_old . "'
                   AND schl_id='" . $schl_id_old . "' 
                   AND eos_medium_id='" . $eos_medium_id_old . "'
                   AND eos_desg_cd=$eos_desg_cd_old
                   AND eos_type='" . $eos_type_old . "' 
                   AND eos_online_posts=$eos_online_posts_old
                   AND eos_offline_posts=$eos_offline_posts_old
                   AND eos_no_of_post = $eos_no_of_post_old
                   AND asst_flag = 'E'
                   AND ac_year = '$global_ac_year'
                   AND eos_subject_cd  $option_subject_code_old_condition 
                   AND  consider_vacancy_flag = '" . $consider_vacancy_flag_old . "' 
                  ";
//            echo "" . $query;
//            exit();
                $result = $this->query($query);
                if ($result <> NULL)
                    return $result;
                else
                    return 0;
            }//IF
//            else if ($asst_flag_old == 'C') {
//                $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
//                SET
//                  dist_code='" . $sanstha_dist_cd . "',
//                   schl_type='" . $option_schl_type . "',
//                   eo_code='" . $eo_code . "',
//                   sanstha_code='" . $sanstha_code . "',
//                   schl_id='" . $schl_id . "', 
//                   eos_medium_id='" . $eos_medium_id . "',
//                   eos_desg_cd= $eos_desg_cd,
//                   eos_type='" . $eos_type . "',
//                   eos_online_posts= $eos_online_posts,
//                   eos_offline_posts= $eos_offline_posts,
//                    eos_no_of_post= $eos_no_of_post, 
//                    eos_subject_cd=$option_subject_code ,
//                        asst_flag='Z'
//                WHERE    dist_code='" . $sanstha_dist_cd_old . "'
//                   AND   schl_type='" . $option_schl_type_old . "'
//                   AND   eo_code='" . $eo_code_old . "'
//                   AND   sanstha_code='" . $sanstha_code_old . "'
//                   AND   schl_id='" . $schl_id_old . "' 
//                   AND   eos_medium_id='" . $eos_medium_id_old . "'
//                   AND   eos_desg_cd=$eos_desg_cd_old
//                   AND   eos_type='" . $eos_type_old . "' 
//                   AND   eos_online_posts=$eos_online_posts_old
//                   AND   eos_offline_posts=$eos_offline_posts_old
//                   AND   eos_no_of_post = $eos_no_of_post_old
//                   AND    asst_flag = 'C' 
//                   AND   eos_subject_cd  $option_subject_code_old_condition 
//                  ";
////            echo "" . $query;
////            exit();
//                $result = $this->query($query);
//                if ($result <> NULL)
//                    return $result;
//                else
//                    return 0;
//            }//IF
//
//            else if ($asst_flag_old == 'R') {
//                $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
//                SET
//                  dist_code='" . $sanstha_dist_cd . "',
//                   schl_type='" . $option_schl_type . "',
//                   eo_code='" . $eo_code . "',
//                   sanstha_code='" . $sanstha_code . "',
//                   schl_id='" . $schl_id . "', 
//                   eos_medium_id='" . $eos_medium_id . "',
//                   eos_desg_cd= $eos_desg_cd,
//                   eos_type='" . $eos_type . "',
//                   eos_online_posts= $eos_online_posts,
//                   eos_offline_posts= $eos_offline_posts,
//                    eos_no_of_post= $eos_no_of_post, 
//                    eos_subject_cd=$option_subject_code ,
//                        asst_flag ='Z'
//                WHERE    dist_code='" . $sanstha_dist_cd_old . "'
//                   AND   schl_type='" . $option_schl_type_old . "'
//                   AND   eo_code='" . $eo_code_old . "'
//                   AND   sanstha_code='" . $sanstha_code_old . "'
//                   AND   schl_id='" . $schl_id_old . "' 
//                   AND   eos_medium_id='" . $eos_medium_id_old . "'
//                   AND   eos_desg_cd=$eos_desg_cd_old
//                   AND   eos_type='" . $eos_type_old . "' 
//                   AND   eos_online_posts=$eos_online_posts_old
//                   AND   eos_offline_posts=$eos_offline_posts_old
//                   AND   eos_no_of_post = $eos_no_of_post_old
//                   AND   asst_flag = 'R'
//                   AND   eos_subject_cd  $option_subject_code_old_condition 
//                  ";
////            echo "" . $query;
////            exit();
//                $result = $this->query($query);
//
//
//                $query1 = "UPDATE pavitra.smj_excesstch_det
//                SET
//                        asst_flag='Z',
//                        upd_dtts = now()
//                WHERE     
//                       sanstha_code='" . $sanstha_code_old . "'
//                        AND   tchr_curr_desg_cd = $eos_desg_cd_old
//                   AND   schl_id like '%" . $sanstha_dist_cd . "%' 
//                   AND   eos_medium_id='" . $eos_medium_id_old . "'
//                   AND   asst_flag = 'R'
//                   AND sch_type  = '" . $option_schl_type . "'
//                  ";
////            echo "" . $query1;
////            exit();
//                $result1 = $this->query($query1);
//
//
//                if ($result1 <> NULL)
//                    return $result1;
//                else
//                    return 0;
//            }//ELSE
//            ----------------------------------------
//                    $this->SelectEoSansthaExVac->updateAll(array('asst_flag' => "'$asst_flag'"), array('sanstha_code' => $sanstha_code, 'eos_desg_cd' => $tchr_curr_desg_cd, 'schl_type' => $higcls, 'eos_type' => '1', 'dist_code' => $dist, 'asst_flag' => 'R', 'eos_medium_id' => $med));
//            -----------------------------------------
        } catch (Exception $e) {
            return 0;
        }
    }

    public function deleteFilledDataInfo($sanstha_dist_cd_old, $option_schl_type_old, $eo_code_old, $sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old, $eos_type_old, $eos_online_posts_old, $eos_offline_posts_old, $eos_no_of_post_old, $option_subject_code_old, $asst_flag_old, $consider_vacancy_flag_old) {
        $global_ac_year = Configure::read('global_ac_year');
        try {

            if ($option_subject_code_old == '')
                $option_subject_code_old_condition = 'IS NULL';
            else
                $option_subject_code_old_condition = '= ' . $option_subject_code_old;
            $query = "DELETE FROM pavitra.pv_eo_sanstha_ex_vac
                WHERE
                        dist_code='" . $sanstha_dist_cd_old . "'
                   AND  schl_type='" . $option_schl_type_old . "'
                   AND  eo_code='" . $eo_code_old . "'
                   AND  sanstha_code='" . $sanstha_code_old . "'
                   AND  schl_id='" . $schl_id_old . "' 
                   AND  eos_medium_id='" . $eos_medium_id_old . "'
                   AND  eos_desg_cd=$eos_desg_cd_old
                   AND  eos_type='" . $eos_type_old . "' 
                   AND  eos_online_posts=$eos_online_posts_old
                   AND  eos_offline_posts=$eos_offline_posts_old
                   AND  eos_no_of_post=$eos_no_of_post_old
                   AND  asst_flag = 'E'
                   AND ac_year = '$global_ac_year'
                   AND  eos_subject_cd  $option_subject_code_old_condition  
                        AND  consider_vacancy_flag = '" . $consider_vacancy_flag_old . "'
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function deleteFilledDataInfoEoSmj($sanstha_dist_cd_old, $option_schl_type_old, $eo_code_old, $sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old, $eos_type_old, $eos_online_posts_old, $eos_offline_posts_old, $eos_no_of_post_old, $option_subject_code_old, $asst_flag_old, $consider_vacancy_flag_old) {
        $global_ac_year = Configure::read('global_ac_year');
        try {

            if ($option_subject_code_old == '')
                $option_subject_code_old_condition = 'IS NULL';
            else
                $option_subject_code_old_condition = '= ' . $option_subject_code_old;
            $query = "DELETE FROM pavitra.pv_eo_sanstha_ex_vac
                WHERE
                        dist_code='" . $sanstha_dist_cd_old . "'
                   AND  schl_type='" . $option_schl_type_old . "'
                   AND  eo_code='" . $eo_code_old . "'
                   AND  sanstha_code='" . $sanstha_code_old . "'
                   AND  schl_id='" . $schl_id_old . "' 
                   AND  eos_medium_id='" . $eos_medium_id_old . "'
                   AND  eos_desg_cd=$eos_desg_cd_old
                   AND  eos_type='" . $eos_type_old . "' 
                   AND  eos_online_posts=$eos_online_posts_old
                   AND  eos_offline_posts=$eos_offline_posts_old
                   AND  eos_no_of_post=$eos_no_of_post_old
                   AND  (asst_flag = 'E' OR  asst_flag = 'Z')
                    AND ac_year = '$global_ac_year'
                   AND  eos_subject_cd  $option_subject_code_old_condition 
                    AND  consider_vacancy_flag = '" . $consider_vacancy_flag_old . "'
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getfilledexvacsanthas($user) {
        try {
            $query = "SELECT distinct(ex.sanstha_code), bi.sanstha_name
                    FROM pavitra.pv_eo_sanstha_ex_vac ex, pavitra.sanstha_basic_info bi
                    WHERE eo_code = '" . $user . "'
                    AND ex.asst_flag = 'F'
                    AND ex.sanstha_code = bi.sanstha_code";

//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getfilledexvacschools($user, $sancd) {
        try {
            $query = "SELECT distinct(schl_id), school_name
                        FROM pavitra.pv_eo_sanstha_ex_vac ex, shala.shala_all_school ss
                        WHERE asst_flag = 'F'
                        AND ex.sanstha_code = '" . $sancd . "'
                        AND schl_id = schcd;
                        ";
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getfilleddets($eo, $san, $sch) {
        try {
            $query = "SELECT medinstr_desc, post_desc, eos_type,
                                eos_no_of_post, eos_subject_cd,  id
                               FROM pavitra.pv_eo_sanstha_ex_vac ex
                               LEFT JOIN master.shala_medinstr sm on ex.eos_medium_id = sm.medinstr_id
                               LEFT JOIN master.tchr_post_master pm on ex.eos_desg_cd = pm.post_id AND pm.post_type = '1'
                               WHERE eo_code = '" . $eo . "'
                               AND sanstha_code = '" . $san . "'
                               AND schl_id = '" . $sch . "'
                               AND asst_flag = 'F';
";


            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
//$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getdesigexcnt($santha, $desig, $sch, $med) {
        $global_ac_year = Configure::read('global_ac_year');
        $qry = "SELECT sanstha_code,eos_desg_cd, eos_type, eos_medium_id,sum(eos_no_of_post)
            FROM pavitra.pv_eo_sanstha_ex_vac
            WHERE sanstha_code='" . $santha . "'
            AND eos_type='1'
            AND eos_desg_cd='" . $desig . "'
            AND eos_medium_id='" . $med . "'
            AND ac_year='" . $global_ac_year . "'    
            group BY  sanstha_code,eos_desg_cd,eos_type,eos_medium_id";

        $result = $this->query($qry);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function selectDesigsanstha($sanstha_code, $dist_cd, $schl_type, $eos_type) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }

            if ($eos_type == 1) {
                $query = "SELECT DISTINCT (ESEV.eos_desg_cd)  ,TPM.post_desc ,ESEV.sanstha_code ,ESEV.schl_id
			FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			
			LEFT JOIN master.tchr_post_master as TPM
                         ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1

                        LEFT JOIN shala.shala_all_school as SAS
                         ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition

                       LEFT JOIN  pavitra.smj_excesstch_det as SED
                         ON SED.sanstha_code =  ESEV.sanstha_code  AND SED.tchr_curr_desg_cd = ESEV.eos_desg_cd
                         
		WHERE   ESEV.sanstha_code='" . $sanstha_code . "'
			 AND    ESEV.schl_id LIKE '" . $dist_cd . "%' 
                         AND     ESEV.eos_type = '" . $eos_type . "'
		        AND   (ESEV.asst_flag ='E')
                        AND   (SED.asst_flag ='E' )
                        AND ESEV.ac_year='" . $global_ac_year . "'
                         ";
            } else if ($eos_type == 2) {
                $query = "SELECT DISTINCT (ESEV.eos_desg_cd)  ,TPM.post_desc,ESEV.sanstha_code ,ESEV.schl_id 
			FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			
			LEFT JOIN master.tchr_post_master as TPM
                         ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1

                        LEFT JOIN shala.shala_all_school as SAS
                         ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition

                                              
		WHERE   ESEV.sanstha_code='" . $sanstha_code . "'
			 AND    ESEV.schl_id LIKE '" . $dist_cd . "%' 
                         AND     ESEV.eos_type = '" . $eos_type . "'
		        AND   (ESEV.asst_flag ='E' )
                         AND ESEV.ac_year='" . $global_ac_year . "'
                       ";
            }

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

    public function selectDesig($sanstha_code, $dist_cd, $schl_type, $eos_type) {
//        die;
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }

            if ($eos_type == 1) {
                $query = "SELECT DISTINCT (ESEV.eos_desg_cd)  ,TPM.post_desc ,ESEV.sanstha_code ,ESEV.schl_id
			FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			
			LEFT JOIN master.tchr_post_master as TPM
                         ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1

                        LEFT JOIN shala.shala_all_school as SAS
                         ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition

                       LEFT JOIN  pavitra.smj_excesstch_det as SED
                         ON SED.sanstha_code =  ESEV.sanstha_code  AND SED.tchr_curr_desg_cd = ESEV.eos_desg_cd
                         
		WHERE   ESEV.sanstha_code='" . $sanstha_code . "'
			 AND    ESEV.schl_id LIKE '" . $dist_cd . "%' 
                         AND     ESEV.eos_type = '" . $eos_type . "'
		        AND   (ESEV.asst_flag ='E' or ESEV.asst_flag ='Z')
                        AND   (SED.asst_flag ='E' or SED.asst_flag ='Z')
                         ";
            } else if ($eos_type == 2) {
                $query = "SELECT DISTINCT (ESEV.eos_desg_cd)  ,TPM.post_desc,ESEV.sanstha_code ,ESEV.schl_id 
			FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			
			LEFT JOIN master.tchr_post_master as TPM
                         ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1

                        LEFT JOIN shala.shala_all_school as SAS
                         ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition

                                              
		WHERE   ESEV.sanstha_code='" . $sanstha_code . "'
			 AND    ESEV.schl_id LIKE '" . $dist_cd . "%' 
                         AND     ESEV.eos_type = '" . $eos_type . "'
		        AND   (ESEV.asst_flag ='E' or ESEV.asst_flag ='Z')
                       ";
            }
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

    public function ex_vac_schl_detail($sanstha_code, $dist_cd, $schl_type, $eos_type, $desig_cd, $med_cd) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }

            $query = "SELECT 
                        ESEV.schl_id,SAS.school_name ,
                        ESEV.eos_desg_cd,TPM.post_desc ,
                        ESEV.eos_medium_id,SM.medinstr_desc ,
                        ESEV.eos_subject_cd,sis.subject_group_desc as subject_desc,
                        ESEV.eos_type,
                        ESEV.dist_code,
                        ESEV.schl_type,
                        ESEV.eo_code,
                        ESEV.sanstha_code,
                        ESEV.eos_online_posts,
                        ESEV.eos_offline_posts,
                        ESEV.eos_no_of_post
		FROM   pavitra.pv_eo_sanstha_ex_vac as ESEV 
                        LEFT JOIN master.tchr_post_master as TPM ON ESEV.eos_desg_cd = TPM.post_id  AND TPM.post_type=1 AND  ESEV.eos_desg_cd =  $desig_cd
			LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id 
                        LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                         LEFT JOIN shala.shala_all_school as SAS ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition
		WHERE     ESEV.sanstha_code='" . $sanstha_code . "'
			AND ESEV.schl_id LIKE '" . $dist_cd . "%' 
                        AND ESEV.schl_id  = SAS.schcd
                        AND ESEV.eos_type = '" . $eos_type . "'
                        AND ESEV.eos_desg_cd =  $desig_cd
                        AND ESEV.eos_medium_id  = '" . $med_cd . "'   
		        AND (ESEV.asst_flag ='E')
                        AND ESEV.ac_year='" . $global_ac_year . "'
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

    public function ex_vac_schl_detail_eo($sanstha_code, $dist_cd, $schl_type, $eos_type, $desig_cd, $med_cd) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }

            $query = "SELECT 
                        ESEV.schl_id,SAS.school_name ,
                        ESEV.eos_desg_cd,TPM.post_desc ,
                        ESEV.eos_medium_id,SM.medinstr_desc ,
                        ESEV.eos_subject_cd,sis.subject_group_desc as subject_desc,
                        ESEV.eos_type,
                        ESEV.dist_code,
                        ESEV.schl_type,
                        ESEV.eo_code,
                        ESEV.sanstha_code,
                        ESEV.eos_online_posts,
                        ESEV.eos_offline_posts,
                        ESEV.eos_no_of_post
                  FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			LEFT JOIN master.tchr_post_master as TPM ON ESEV.eos_desg_cd = TPM.post_id  AND TPM.post_type=1 AND  ESEV.eos_desg_cd =  $desig_cd
			LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id 
                        LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                        LEFT JOIN shala.shala_all_school as SAS ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition
		  WHERE     ESEV.sanstha_code='" . $sanstha_code . "'
			AND ESEV.schl_id LIKE '" . $dist_cd . "%' 
                        AND ESEV.schl_id  = SAS.schcd
                        AND ESEV.eos_type = '" . $eos_type . "'
                        AND ESEV.eos_desg_cd =  $desig_cd
                        AND ESEV.eos_medium_id  = '" . $med_cd . "'   
		        AND (ESEV.asst_flag ='E' or ESEV.asst_flag ='Z')
			 AND ESEV.ac_year='" . $global_ac_year . "'
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

    public function selectsansthaverif($dist_cd, $schl_type, $eos_type, $sansthatype) {
        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }

            if ($sansthatype == '1') {
                $condn = "in ('1')";
            } else if ($sansthatype == '2') {
                $condn = "in ('2','3')";
            }

            if ($eos_type == 1) {

                $query = "SELECT DISTINCT (ESEV.sanstha_code)  ,TPM.sanstha_name 
			FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			LEFT JOIN samayojan.sanstha_basic_info as TPM
                        ON ESEV.sanstha_code = TPM.sanstha_code
                        LEFT JOIN shala.shala_all_school as SAS
                        ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition                    
                        WHERE ESEV.schl_id LIKE '" . $dist_cd . "%' 
                        AND ESEV.eos_type = '" . $eos_type . "'
                        AND ESEV.schl_type = '" . $schl_type . "'
                        and ESEV.ac_year='" . $global_ac_year . "'
                        and TPM.minority_sanstha $condn   
		        AND (ESEV.asst_flag ='F')
                        ORDER BY TPM.sanstha_name
                         ";
            } else if ($eos_type == 2) {
                $query = "SELECT DISTINCT (ESEV.sanstha_code)  ,TPM.sanstha_name 
			FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			
			LEFT JOIN samayojan.sanstha_basic_info as TPM
                         ON ESEV.sanstha_code = TPM.sanstha_code AND TPM.minority_sanstha $condn


                        LEFT JOIN shala.shala_all_school as SAS
                         ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition

                                              
		WHERE   ESEV.schl_id LIKE '" . $dist_cd . "%' 
                         AND   ESEV.schl_type = '" . $schl_type . "'
                         AND ESEV.eos_type = '" . $eos_type . "'
                         and ESEV.ac_year='" . $global_ac_year . "'
                         and TPM.minority_sanstha $condn  
		        AND  (ESEV.asst_flag ='F')
                        order by TPM.sanstha_name 
                       ";
            }
//pr($query);die;



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

    public function selectDesigVerif($sanstha_code, $dist_cd, $schl_type, $eos_type) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }

            if ($eos_type == 1) {
                $query = "SELECT DISTINCT (ESEV.eos_desg_cd)  ,TPM.post_desc 
			FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			
			LEFT JOIN master.tchr_post_master as TPM
                         ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1

                        LEFT JOIN shala.shala_all_school as SAS
                         ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition

                       LEFT JOIN  pavitra.smj_excesstch_det as SED
                         ON SED.sanstha_code =  ESEV.sanstha_code  AND SED.tchr_curr_desg_cd = ESEV.eos_desg_cd
                         
		WHERE   ESEV.sanstha_code='" . $sanstha_code . "'
			 AND    ESEV.schl_id LIKE '" . $dist_cd . "%' 
                         AND     ESEV.eos_type = '" . $eos_type . "'
                             AND     ESEV.schl_type = '" . $schl_type . "'
                        AND ESEV.ac_year='" . $global_ac_year . "'         
		        AND   (ESEV.asst_flag ='F' OR ESEV.asst_flag ='C')
                        AND   (SED.asst_flag ='F' or SED.asst_flag ='C')
                         ";
            } else if ($eos_type == 2) {
                $query = "SELECT DISTINCT (ESEV.eos_desg_cd)  ,TPM.post_desc 
			FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			
			LEFT JOIN master.tchr_post_master as TPM
                         ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1

                        LEFT JOIN shala.shala_all_school as SAS
                         ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition

                                              
		WHERE   ESEV.sanstha_code='" . $sanstha_code . "'
                       AND     ESEV.schl_type = '" . $schl_type . "'
			 AND    ESEV.schl_id LIKE '" . $dist_cd . "%' 
                         AND     ESEV.eos_type = '" . $eos_type . "'
                        AND ESEV.ac_year='" . $global_ac_year . "'       
		        AND   (ESEV.asst_flag ='F' or ESEV.asst_flag ='C')
                       ";
            }



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

    public function ex_vac_schl_detailverif($sanstha_code, $dist_cd, $schl_type, $eos_type, $desig_cd, $med_cd) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }

            $query = "SELECT 
                        ESEV.schl_id,SAS.school_name ,
                        ESEV.eos_desg_cd,TPM.post_desc ,
                        ESEV.eos_medium_id,SM.medinstr_desc ,
                        ESEV.eos_subject_cd,sis.subject_group_desc as subject_desc,
                        ESEV.eos_type,
                        ESEV.dist_code,
                        ESEV.schl_type,
                        ESEV.eo_code,
                        ESEV.sanstha_code,
                        ESEV.eos_online_posts,
                        ESEV.eos_offline_posts,
                        ESEV.eos_no_of_post
                  FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			LEFT JOIN master.tchr_post_master as TPM ON ESEV.eos_desg_cd = TPM.post_id  AND TPM.post_type=1 AND  ESEV.eos_desg_cd =  $desig_cd
			LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id 
                        LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                        LEFT JOIN shala.shala_all_school as SAS ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition
		  WHERE     ESEV.sanstha_code='" . $sanstha_code . "'
			AND ESEV.schl_id LIKE '" . $dist_cd . "%' 
                        AND ESEV.schl_id  = SAS.schcd
                        AND ESEV.eos_type = '" . $eos_type . "'
                        AND ESEV.eos_desg_cd =  $desig_cd
                        AND ESEV.eos_medium_id='" . $med_cd . "'
                             AND ESEV.ac_year='" . $global_ac_year . "'
		        AND (ESEV.asst_flag ='F' or ESEV.asst_flag ='C')
                         ";

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

    public function getmeds($sansthacd) {
        $global_ac_year = Configure::read('global_ac_year');
        try {


            $query = "SELECT distinct(ESEV.eos_medium_id),SM.medinstr_desc
                      FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                      LEFT JOIN master.shala_medinstr as SM
                      ON ESEV.eos_medium_id = SM.medinstr_id 
                      WHERE sanstha_code='" . $sansthacd . "'
                      and ESEV.ac_year='" . $global_ac_year . "'";
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

    public function getSansthaExcessInfoReport($eo_code) {
//          $dist_id =    substr($eo_code, 0, 4);
//        $query = "SELECT ESEV.sanstha_code ,SBI.sanstha_name  ,ESEV.eos_desg_cd,TPM.post_desc
//                  FROM   pavitra.pv_eo_sanstha_ex_vac as ESEV
//                  LEFT JOIN pavitra.sanstha_basic_info as SBI
//                  ON  ESEV.sanstha_code = SBI.sanstha_code
//                  LEFT JOIN master.tchr_post_master TPM 
//                  ON ESEV.eos_desg_cd = TPM.post_id  AND TPM.post_type='1'
//                  WHERE  eo_code = '" . $eo_code . "'
//                  ORDER BY sanstha_name";
////        echo $query; exit();

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT sanstha_code,sanstha_name,eos_desg_cd,post_desc,SUM(filled_excess_info) as filled_excess_info,SUM(filled_tchr_data) as filled_tchr_data
FROM
((SELECT 
	ESEV.sanstha_code ,SBI.sanstha_name,
	ESEV.eos_desg_cd,TPM.post_desc,
	SUM(ESEV.eos_no_of_post) as filled_excess_info,
	0 as filled_tchr_data 
 FROM 	
	pavitra.pv_eo_sanstha_ex_vac as ESEV 
	LEFT JOIN pavitra.sanstha_basic_info as SBI 
	ON ESEV.sanstha_code = SBI.sanstha_code  AND SBI.minority_sanstha   in  $minority_type_cond
	LEFT JOIN master.tchr_post_master TPM
	ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type='1'
 WHERE 
	eo_code = '" . $eo_code . "'
GROUP BY ESEV.sanstha_code,SBI.sanstha_name,ESEV.eos_desg_cd,TPM.post_desc 
ORDER BY ESEV.sanstha_code ,SBI.sanstha_name)

UNION
(SELECT   
	SED.sanstha_code,SBI.sanstha_name,
	SED.tchr_curr_desg_cd,TPM.post_desc,
	0 as filled_excess_info ,
	count(SED.tchr_curr_desg_cd) as filled_tchr_data
 FROM 
	pavitra.smj_excesstch_det as SED
	LEFT JOIN pavitra.sanstha_basic_info as SBI 
	ON SED.sanstha_code = SBI.sanstha_code  AND SBI.minority_sanstha   in   $minority_type_cond
	LEFT JOIN master.tchr_post_master TPM 
	ON SED.tchr_curr_desg_cd = TPM.post_id  AND TPM.post_type='1'
WHERE
	substr(SED.sanstha_code,1,4)= '" . $dist_id . "' AND sch_type = '" . $sch_type . "'
GROUP BY SED.sanstha_code,SED.tchr_curr_desg_cd,SBI.sanstha_name,TPM.post_desc
ORDER BY SED.sanstha_code,SED.tchr_curr_desg_cd)
)as tmp
GROUP BY sanstha_code,sanstha_name,eos_desg_cd,post_desc
ORDER BY sanstha_name";
//        echo $query;
//        exit();



        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSansthaExcessMediumInfoReport($eo_code, $sanstha_type) {
        $global_ac_year = Configure::read('global_ac_year');
        if ($sanstha_type == 1) {
            $cond = "  IN ('2','3')";
        } else {
            $cond = " NOT IN ('2','3')";
        }
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT  eos_medium_id ,medinstr_desc 
                    FROM (
                            (SELECT   DISTINCT (ESEV.eos_medium_id),SM.medinstr_desc 
                                FROM 
                                pavitra.sanstha_basic_info as SBI 
                                LEFT JOIN  pavitra.pv_eo_sanstha_ex_vac as ESEV 
                                ON ESEV.sanstha_code = SBI.sanstha_code   AND SBI.minority_sanstha   $cond
                                LEFT JOIN master.tchr_post_master TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type='1'
                                LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id
                                WHERE   ac_year = '$global_ac_year' AND eo_code = '" . $eo_code . "'
                            ) 
                            UNION 
                            
                            (SELECT DISTINCT (SED.eos_medium_id),SM.medinstr_desc  
                             FROM 
                                             pavitra.sanstha_basic_info as SBI 
                                    LEFT JOIN pavitra.smj_excesstch_det as SED 
                                            ON SED.sanstha_code = SBI.sanstha_code AND SBI.minority_sanstha   $cond
                                    LEFT JOIN master.tchr_post_master TPM 
                                            ON SED.tchr_curr_desg_cd = TPM.post_id AND TPM.post_type='1'
                                    LEFT JOIN master.shala_medinstr as SM 
                                            ON SED.eos_medium_id = SM.medinstr_id
                             WHERE substr(SED.sanstha_code,1,4)= '" . $dist_id . "'  AND ac_year = '$global_ac_year' AND sch_type = '" . $sch_type . "'
                             ) 
                             
                          )as tmp ORDER BY medinstr_desc";

//        echo $query;
//        exit();

        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSansthaExcessDesignation($eo_code, $sanstha_type, $option_medium) {
        $global_ac_year = Configure::read('global_ac_year');
        if ($sanstha_type == 1) {
            $cond = "  IN ('2','3')";
        } else {
            $cond = " NOT IN ('2','3')";
        }
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $query = "SELECT eos_desg_cd,post_desc 
                        FROM
                        (
                        (SELECT ESEV.eos_desg_cd,TPM.post_desc 
                         FROM 
                                pavitra.sanstha_basic_info as SBI
                                LEFT JOIN pavitra.pv_eo_sanstha_ex_vac as ESEV  
                                ON ESEV.sanstha_code = SBI.sanstha_code  AND SBI.minority_sanstha $cond
                                LEFT JOIN master.tchr_post_master TPM
                                ON ESEV.eos_desg_cd = TPM.post_id  AND ESEV.ac_year = '$global_ac_year' AND TPM.post_type='1'
                         WHERE 
                                eo_code = '" . $eo_code . "' AND eos_medium_id = '" . $option_medium . "'
                        GROUP BY  ESEV.eos_desg_cd,TPM.post_desc)

                        UNION
                        
                        (SELECT  SED.tchr_curr_desg_cd,TPM.post_desc 
                          FROM 
                                pavitra.sanstha_basic_info as SBI 
                                LEFT JOIN pavitra.smj_excesstch_det as SED
                                ON SED.sanstha_code = SBI.sanstha_code AND SBI.minority_sanstha $cond
                                LEFT JOIN master.tchr_post_master TPM 
                                ON SED.tchr_curr_desg_cd = TPM.post_id  AND TPM.post_type='1'
                        WHERE
                                substr(SED.sanstha_code,1,4)= '" . $dist_id . "' AND SED.ac_year = '$global_ac_year'  AND sch_type = '" . $sch_type . "' AND eos_medium_id = '" . $option_medium . "'
                        GROUP BY  SED.tchr_curr_desg_cd ,TPM.post_desc)
                        )as tmp
                        GROUP BY  eos_desg_cd,post_desc
                        ORDER BY post_desc";
//        echo $query;
//        exit();



        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSansthaExcessReport($eo_code, $sanstha_type, $option_medium, $option_designation) {
        $global_ac_year = Configure::read('global_ac_year');
        if ($sanstha_type == 1) {
            $cond = "  IN ('2','3')";
        } else {
            $cond = " NOT IN ('2','3')";
        }
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $query = "SELECT sanstha_code,sanstha_name,eos_desg_cd,post_desc,SUM(filled_excess_info) as filled_excess_info,SUM(filled_tchr_data) as filled_tchr_data
                        FROM
                        ((SELECT 
                                ESEV.sanstha_code ,SBI.sanstha_name,
                                ESEV.eos_desg_cd,TPM.post_desc,
                                SUM(ESEV.eos_no_of_post) as filled_excess_info,
                                0 as filled_tchr_data 
                         FROM 	
                               pavitra.sanstha_basic_info as SBI 
                                LEFT JOIN   pavitra.pv_eo_sanstha_ex_vac as ESEV 
                                ON ESEV.sanstha_code = SBI.sanstha_code  AND SBI.minority_sanstha $cond
                                LEFT JOIN master.tchr_post_master TPM
                                ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type='1' AND  ESEV.eos_desg_cd = '" . $option_designation . "'
                         WHERE 
                                  eo_code = '" . $eo_code . "' AND eos_medium_id = '" . $option_medium . "'  AND ESEV.ac_year = '$global_ac_year' AND  ESEV.eos_desg_cd = '" . $option_designation . "'
                        GROUP BY ESEV.sanstha_code,SBI.sanstha_name,ESEV.eos_desg_cd,TPM.post_desc 
                        ORDER BY ESEV.sanstha_code ,SBI.sanstha_name)

                        UNION
                        (SELECT   
                                SED.sanstha_code,SBI.sanstha_name,
                                SED.tchr_curr_desg_cd,TPM.post_desc,
                                0 as filled_excess_info ,
                                count(SED.tchr_curr_desg_cd) as filled_tchr_data
                         FROM   
                                    pavitra.sanstha_basic_info as SBI 
                                LEFT JOIN  pavitra.smj_excesstch_det as SED
                                ON SED.sanstha_code = SBI.sanstha_code   AND SBI.minority_sanstha $cond
                                LEFT JOIN master.tchr_post_master TPM 
                                ON SED.tchr_curr_desg_cd = TPM.post_id  AND TPM.post_type='1' AND  SED.tchr_curr_desg_cd = '" . $option_designation . "'
                        WHERE
                                  substr(SED.sanstha_code,1,4)= '" . $dist_id . "' AND sch_type = '" . $sch_type . "'  AND SED.ac_year = '$global_ac_year' AND eos_medium_id = '" . $option_medium . "' AND  SED.tchr_curr_desg_cd = '" . $option_designation . "'
                        GROUP BY SED.sanstha_code,SED.tchr_curr_desg_cd,SBI.sanstha_name,TPM.post_desc
                        ORDER BY SED.sanstha_code,SED.tchr_curr_desg_cd)
                        )as tmp
                        GROUP BY sanstha_code,sanstha_name,eos_desg_cd,post_desc
                        ORDER BY sanstha_name";
//        echo $query;
//        exit();



        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSansthaExcessVacancyDesignation($eo_code) {
        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT   DISTINCT (ESEV.eos_desg_cd),TPM.post_desc 
                                FROM 
                                pavitra.sanstha_basic_info as SBI 
                                LEFT JOIN  pavitra.pv_eo_sanstha_ex_vac as ESEV  
                                ON ESEV.sanstha_code = SBI.sanstha_code   AND SBI.minority_sanstha   in  $minority_type_cond
                                LEFT JOIN master.tchr_post_master TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type='1'
                              
                                WHERE   ESEV.ac_year = '$global_ac_year' AND eo_code = '" . $eo_code . "' 
                        GROUP BY  eos_desg_cd,post_desc
                        ORDER BY post_desc";
//        echo $query;   exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSansthaExcessVacancyReport($eo_code, $option_designation) {
        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT
                         ESEV.sanstha_code,
                         SBI.sanstha_name, 
                         ESEV.eos_desg_cd,
                         TPM.post_desc,
                         ESEV.eos_type,
                         ESEV.eos_subject_cd,
                         sis.subject_group_desc as subject_code_text,
                         ESEV.eos_medium_id,
                         SM.medinstr_desc,
                         SUM(ESEV.eos_no_of_post) as eos_no_of_post
                    FROM          pavitra.sanstha_basic_info as SBI
                        LEFT JOIN pavitra.pv_eo_sanstha_ex_vac as ESEV ON ESEV.sanstha_code = SBI.sanstha_code  AND SBI.minority_sanstha   in $minority_type_cond
                        LEFT JOIN master.tchr_post_master TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type='1'
                        LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric) 
                        LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id  
                    WHERE      ESEV.eo_code = '" . $eo_code . "'  
                           AND ESEV.ac_year = '$global_ac_year'  
                           AND ESEV.eos_desg_cd = '" . $option_designation . "'
                    GROUP BY ESEV.sanstha_code,SBI.sanstha_name,ESEV.eos_desg_cd,
                            TPM.post_desc,ESEV.eos_type,ESEV.eos_subject_cd,
                            ESEV.eos_medium_id,sis.subject_group_desc,SM.medinstr_desc
                        ORDER BY ESEV.sanstha_code";
//        echo $query;   exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSchoolwiseExcessVacancyReport($eo_code, $sanstha_code, $eos_desg_cd, $eos_type) {
        $global_ac_year = Configure::read('global_ac_year');

        $query = "SELECT 
                            ESEV.sanstha_code,
                            SBI.sanstha_name, 
                            ESEV.eos_desg_cd,
                            TPM.post_desc,
                            ESEV.eos_type,
                            ESEV.schl_id,
                            SAS.school_name,
                            ESEV.eos_subject_cd,
                            sis.subject_group_desc as subject_code_text,
                            ESEV.eos_medium_id,
                            SM.medinstr_desc,
                            SUM(ESEV.eos_no_of_post) as eos_no_of_post
                    FROM 
                                  pavitra.sanstha_basic_info as SBI
                        LEFT JOIN pavitra.pv_eo_sanstha_ex_vac as ESEV ON ESEV.sanstha_code = SBI.sanstha_code AND ESEV.sanstha_code = '" . $sanstha_code . "' 
                        LEFT JOIN master.tchr_post_master TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type='1' AND  ESEV.eos_desg_cd = '" . $eos_desg_cd . "'
                        LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                       LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric) 
                        LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id  
                    WHERE   
                                 ESEV.eo_code = '" . $eo_code . "'
                             AND ESEV.ac_year = '$global_ac_year' 
                             AND ESEV.eos_desg_cd = '" . $eos_desg_cd . "'  
                             AND ESEV.eos_type = '" . $eos_type . "'
                     GROUP BY ESEV.sanstha_code,SBI.sanstha_name,ESEV.eos_desg_cd,
                              TPM.post_desc,ESEV.eos_type,ESEV.eos_subject_cd,
                              ESEV.eos_medium_id,sis.subject_group_desc,SM.medinstr_desc,
                              ESEV.schl_id,SAS.school_name
                    ORDER BY ESEV.sanstha_code";
//        echo $query;   exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    //ROUND 1 START

    public function getSamaMediumExcessMedium($eo_code) {
        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);
        $query = "SELECT distinct(sm.eos_medium_id),medinstr_desc
                    FROM pavitra.smj_excesstch_det sm
                    LEFT JOIN master.shala_medinstr mi on sm.eos_medium_id=mi.medinstr_id 
                    LEFT JOIN pavitra.sanstha_basic_info bi on sm.sanstha_code=bi.sanstha_code AND bi.minority_sanstha in  $minority_type_cond
                    WHERE  
                        sm.schl_id like '$dist_id%'
                   AND sm.sch_type = '$sch_type'
                   AND sm.ac_year = '$global_ac_year'
                   AND sm.asst_flag ='A'
                    AND stg_flg0 = 'W'
                    ORDER BY medinstr_desc"; // AND sm.tc_categ != 1
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

//dd

    public function checkRoundStart($eo_code, $option_medium_type) {
        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);


        $query = "SELECT count(*) FROM pavitra.smj_excesstch_det as SED  
                    LEFT JOIN pavitra.pv_eo_sanstha_ex_vac as ESEV ON SED.sanstha_code = ESEV.sanstha_code AND SED.ac_year = ESEV.ac_year 
                  WHERE      substr(SED.schl_id,1,4) = '" . $dist_id . "'            
                        AND SED.sch_type = '" . $sch_type . "'   
                        AND SED.eos_medium_id = '" . $option_medium_type . "'   
                        AND SED.asst_flag not in ('A')         
                        AND ESEV.asst_flag not in ('A')   
                        AND ESEV.ac_year = '$global_ac_year' 
                        AND SED.ac_year = '$global_ac_year' 
                        AND ESEV.minority_sanstha   in  $minority_type_cond"; //AND asst_flag ='A'
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

//dd

    public function checkRoundStartExVac($eo_code, $option_medium_type) {
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');


        $query = "SELECT count(*)   
            FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                  WHERE    ESEV.eo_code = '" . $eo_code . "'   
                       AND ESEV.schl_type = '" . $sch_type . "' 
                       AND ESEV.eos_medium_id = '" . $option_medium_type . "'   
                       AND ESEV.asst_flag not in ('A')       
                       AND ESEV.ac_year = '$global_ac_year'
                       AND ESEV.minority_sanstha in $minority_type_cond"; //AND asst_flag ='A'
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

//dd

    public function getSamaBlockInfo($eo_code, $option_medium_type, $tchr_curr_desg_cd, $tc_categ, $ts_subject_tot1, $ts_subject_tot2, $eos_tchr_gender) {
        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);


        if ($eos_tchr_gender == '1') { //M
            $tchr_gender_cond = " ('1','3')";
        } else if ($sch_type == '2') { //F
            $tchr_gender_cond = " ('2','3')";
        } else if ($sch_type == '3') { //F
            $tchr_gender_cond = " ('1','2','3')";
        }


        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        if ($tc_categ == '1') { //General
            $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0'; //   $col_cond = 'gen_smj_tot';
        } else if ($tc_categ == '2') { //SC
            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) > 0';
        } else if ($tc_categ == '3') { //ST
            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) > 0';
        } else if ($tc_categ == '4') { //OBC
            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) > 0';
        } else if ($tc_categ == '10') { //VJA
            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) > 0';
        } else if ($tc_categ == '12') { //SBC
            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) > 0';
        } else if ($tc_categ == '13') { //NTB
            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) > 0';
        } else if ($tc_categ == '14') { //NTC  
            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) > 0';
        } else if ($tc_categ == '15') { //NTD
            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) > 0';
        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;

        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }

        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";


        $query = "SELECT DISTINCT(blkcd), blkname 
                  FROM shala_live.shala_block
                  WHERE blkcd IN
                            (SELECT substr(ESEV.schl_id,1,6) as block_code 
                              FROM 
                                        pavitra.pv_eo_sanstha_ex_vac as ESEV
                              LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                               LEFT JOIN shala.shala_basic_infoall SBIA ON SBIA.schcd = SAS.schcd AND SBIA.school_type IN  $tchr_gender_cond
                              LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha in $minority_type_cond

                              WHERE
                                        ESEV.eo_code = '" . $eo_code . "'
                                    AND ESEV.eos_medium_id = '" . $option_medium_type . "'
                                    AND $tchr_curr_desg_cd_cond
                                    AND ESEV.minority_sanstha   in  $minority_type_cond 
                                    AND ESEV.eos_subject_cd IN ($ts_subject_tot1)
                                    AND ESEV.eos_type = '2'
                                    AND ESEV.asst_flag = 'A'
                                    AND ESEV.ac_year = '$global_ac_year'
                                    AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                    AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE $col_cond 
                                                        AND  roster_info.asst_flag = 'V'
                                                        AND roster_info.ac_year = '$global_ac_year'
                                                        AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                            )
                 ORDER BY blkname"; //AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

//dd

    public function getSamaSansthaInfo($eo_code, $option_medium_type, $tchr_curr_desg_cd, $tc_categ, $ts_subject_tot1, $ts_subject_tot2, $eos_tchr_gender) {
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');


        if ($eos_tchr_gender == '1') { //M
            $tchr_gender_cond = " ('1','3')";
        } else if ($sch_type == '2') { //F
            $tchr_gender_cond = " ('2','3')";
        } else if ($sch_type == '3') { //F
            $tchr_gender_cond = " ('1','2','3')";
        }

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        if ($tc_categ == '1') { //General
            $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0'; //   $col_cond = 'gen_smj_tot';
        } else if ($tc_categ == '2') { //SC
            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) > 0';
        } else if ($tc_categ == '3') { //ST
            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) > 0';
        } else if ($tc_categ == '4') { //OBC
            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) > 0';
        } else if ($tc_categ == '10') { //VJA
            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) > 0';
        } else if ($tc_categ == '12') { //SBC
            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) > 0';
        } else if ($tc_categ == '13') { //NTB
            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) > 0';
        } else if ($tc_categ == '14') { //NTC  
            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) > 0';
        } else if ($tc_categ == '15') { //NTD
            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) > 0';
        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;

        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }


        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";



        $query = " SELECT ESEV.sanstha_code ,SBI.sanstha_name
                              FROM 
                                        pavitra.pv_eo_sanstha_ex_vac as ESEV
                              LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                              LEFT JOIN shala.shala_basic_infoall SBIA ON SBIA.schcd = SAS.schcd AND SBIA.school_type IN  $tchr_gender_cond
                              LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond 

                              WHERE
                                        ESEV.eo_code = '" . $eo_code . "'
                                    AND ESEV.eos_medium_id = '" . $option_medium_type . "'
                                    AND $tchr_curr_desg_cd_cond                                   
                                    AND ESEV.minority_sanstha IN  $minority_type_cond
                                    AND ESEV.eos_subject_cd IN ($ts_subject_tot1)
                                    AND ESEV.eos_type = '2'
                                    AND ESEV.asst_flag = 'A'
                                    AND ESEV.ac_year = '$global_ac_year'
                                    AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                    AND ESEV.sanstha_code 
                                          IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                 WHERE $col_cond 
                                                      AND roster_info.asst_flag = 'V'
                                                      AND roster_info.ac_year = '$global_ac_year'
                                                      AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                             ORDER BY SBI.sanstha_name"; // AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

//dd

    public function getSamaVacancySchInfo($eo_code, $option_medium_type, $tchr_curr_desg_cd, $vacancy_block_info, $ts_subject_tot1, $ts_subject_tot2, $tc_categ, $array_vacancy_sanstha_info) {
        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($vacancy_block_info != '' && $array_vacancy_sanstha_info == '') {
            $search_cond = " AND  ESEV.schl_id LIKE '" . $vacancy_block_info . "%'";
        } else if ($vacancy_block_info == '' && $array_vacancy_sanstha_info != '') {
            $search_cond = " AND  ESEV.sanstha_code LIKE '" . $array_vacancy_sanstha_info . "%' ";
        } else if ($vacancy_block_info != '' && $array_vacancy_sanstha_info != '') {
            $search_cond = "  AND  ESEV.schl_id LIKE '" . $vacancy_block_info . "%' 
                                 AND  ESEV.sanstha_code LIKE '" . $array_vacancy_sanstha_info . "%' ";
        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;
        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }


        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        if ($tc_categ == '1') { //General
            $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0'; //   $col_cond = 'gen_smj_tot';
        } else if ($tc_categ == '2') { //SC
            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) > 0';
        } else if ($tc_categ == '3') { //ST
            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) > 0';
        } else if ($tc_categ == '4') { //OBC
            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) > 0';
        } else if ($tc_categ == '10') { //VJA
            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) > 0';
        } else if ($tc_categ == '12') { //SBC
            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) > 0';
        } else if ($tc_categ == '13') { //NTB
            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) > 0';
        } else if ($tc_categ == '14') { //NTC  
            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) > 0';
        } else if ($tc_categ == '15') { //NTD
            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) > 0';
        }



        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";


        $query = "SELECT ESEV.schl_id,SAS.school_name, 
                         SV.vilname,
                         ESEV.sanstha_code,
                         SBI.sanstha_name,
                         ESEV.eos_medium_id,
                         SM.medinstr_desc, 
			 ESEV.eos_desg_cd,
                         TPM.post_desc,
                         ESEV.eos_subject_cd,
                         sis.subject_group_desc as subject_code_text,
                         (ESEV.eos_no_of_post - ESEV.shifted_tchr_cnt) as eos_no_of_post,
                         ESEV. eos_type  
                    FROM 
                                   pavitra.pv_eo_sanstha_ex_vac as ESEV
                         LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                         LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond
                         LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id 
                         LEFT JOIN master.tchr_post_master TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type='1'
                         LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric) 
                    
                        INNER JOIN shala.shala_area SA ON ESEV.schl_id = SA.schcd 
			INNER JOIN shala.shala_village SV ON SV.vilcd = SA.vilcd 
                    WHERE
                               ESEV.eo_code = '" . $eo_code . "' 
                           AND ESEV.eos_medium_id = '" . $option_medium_type . "' 
                           AND $tchr_curr_desg_cd_cond
                           AND ESEV.minority_sanstha IN  $minority_type_cond
                           AND ESEV.eos_subject_cd IN ($ts_subject_tot1)
                           AND ESEV.eos_type = '2'
                           AND ESEV.asst_flag = 'A'
                           AND ESEV.ac_year = '$global_ac_year'
                           AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                               $search_cond
                           AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE $col_cond
                                                        AND  roster_info.asst_flag = 'V'
                                                        AND roster_info.ac_year = '$global_ac_year'
                                                        AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				)
                          
                   GROUP BY ESEV.schl_id,SAS.school_name,ESEV.sanstha_code,
                            SBI.sanstha_name,ESEV.eos_medium_id,SM.medinstr_desc,
                            ESEV.eos_desg_cd,TPM.post_desc,ESEV.eos_subject_cd,
                            subject_code_text,ESEV.eos_no_of_post,
                            ESEV.eos_type,ESEV.shifted_tchr_cnt,SV.vilname
                    HAVING (ESEV.eos_no_of_post - ESEV.shifted_tchr_cnt) > 0   
                    ORDER BY  SAS.school_name "; //  AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

//dd

    public function updateNoVacanctCntRound1($eo_code, $new_sanstha_id, $new_schl_id, $eos_medium_id_old, $eos_desg_cd_old, $eos_subject_cd, $eos_no_of_post, $eos_desg_cd_selected) {
        $global_ac_year = Configure::read('global_ac_year');
        try {

            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt + 1 
                WHERE    dist_code = '" . $dist_id_old . "'
                   AND   schl_type = '" . $sch_type_old . "'
                   AND   eo_code = '" . $eo_code . "'
                   AND   sanstha_code = '" . $new_sanstha_id . "'
                   AND   schl_id = '" . $new_schl_id . "' 
                   AND   eos_medium_id = '" . $eos_medium_id_old . "'
                   AND   eos_desg_cd = $eos_desg_cd_selected
                   AND   eos_type = '2' 
                   AND    ac_year = '$global_ac_year'
                   AND   eos_subject_cd = '" . $eos_subject_cd . "' 
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateNoExcessCntRound1($eo_code, $old_sanstha_id, $old_schl_id, $eos_medium_id_old, $eos_desg_cd_old, $eos_subject_cd, $eos_no_of_post, $eos_desg_cd_selected) {
        $global_ac_year = Configure::read('global_ac_year');
        try {

            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt - 1 
                WHERE  dist_code = '" . $dist_id_old . "'
                   AND schl_type = '" . $sch_type_old . "'
                   AND eo_code = '" . $eo_code . "'
                   AND sanstha_code = '" . $old_sanstha_id . "'
                   AND schl_id = '" . $old_schl_id . "' 
                   AND eos_medium_id = '" . $eos_medium_id_old . "'
                   AND eos_desg_cd = $eos_desg_cd_old
                   AND eos_type = '1' 
                   AND ac_year = '$global_ac_year'
                   AND eos_subject_cd = '" . $eos_subject_cd . "' 
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    //ROUND 1 END
    //ROUND 2 START
    public function checkRound1Over($eo_code, $option_medium_type) {

        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $query = "SELECT count(*) FROM pavitra.smj_excesstch_det as SED
                            LEFT JOIN pavitra.sanstha_basic_info
                            ON SED.sanstha_code = sanstha_basic_info.sanstha_code AND sanstha_basic_info.minority_sanstha   in  $minority_type_cond 
                            WHERE substr(schl_id,1,4) = '" . $dist_id . "' AND sch_type = '" . $sch_type . "'           
                                AND  minority_sanstha   in $minority_type_cond
                                AND SED.asst_flag   in ('A') 
                                AND SED.ac_year = '$global_ac_year'
                                AND stg_flg1 not in ('S','W') 
                                AND stg_flg0 != 'S'
                                AND tch_ex_id IN
                       (SELECT tch_ex_id
                        FROM pavitra.smj_excesstch_det sm,pavitra.sanstha_basic_info bi,master.tchr_post_master 
                        WHERE  sch_type ='" . $sch_type . "'
                         AND schl_id like '" . $dist_id . "%'
                         AND sm.eos_medium_id='" . $option_medium_type . "' 
                        AND bi.sanstha_code=sm.sanstha_code
                        AND bi.minority_sanstha   in $minority_type_cond
                        AND sm.ac_year = '$global_ac_year'
                        AND sm.sanstha_code in 
                        (SELECT sanstha_code 
                           FROM pavitra.pv_eo_sanstha_ex_vac
                           WHERE     eo_code='" . $eo_code . "' 
                                 AND eos_medium_id='" . $option_medium_type . "'  
                                  AND ac_year = '$global_ac_year'
                                 AND minority_sanstha   in $minority_type_cond
                         )
                                 AND sm.asst_flag   in ('A')  
                                 AND post_type = 1
                                 AND post_id=tchr_curr_desg_cd   
                        )"
        ; //AND asst_flag ='A'
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function checkRound1OverExVac($eo_code, $option_medium_type) {

        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT count(*)  
                    FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                        WHERE   eo_code = '" . $eo_code . "'   
                             AND ESEV.schl_type = '" . $sch_type . "' 
                             AND ESEV.eos_medium_id = '" . $option_medium_type . "'   
                             AND ESEV.asst_flag not in ('A')   
                             AND ESEV.ac_year = '$global_ac_year'
                             AND ESEV.minority_sanstha in  $minority_type_cond"; //AND asst_flag ='A'
//        echo $query;
//        exit();

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

//dd

    public function getSamaMediumExcessMediumRound2($eo_code) {

//        $query = "SELECT distinct(sm.eos_medium_id),medinstr_desc
//                                                    from pavitra.pv_eo_sanstha_ex_vac ex,master.shala_medinstr,pavitra.smj_excesstch_det sm
//                                                    WHERE sm.eos_medium_id=medinstr_id
//                                                    AND eo_code='" . $eo_code . "'
//                                                    AND eos_type='1'
//                                                   AND sm.sanstha_code=ex.sanstha_code 
//                                                     AND minority_sanstha   in $minority_type_cond
//                                                     AND stg_flg1 = 'W'
//                                                    ORDER BY medinstr_desc"; //AND asst_flag ='A'
//         echo $query;   exit();

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT distinct(sm.eos_medium_id),medinstr_desc
                    FROM pavitra.smj_excesstch_det sm
                     LEFT JOIN master.shala_medinstr mi on sm.eos_medium_id=mi.medinstr_id
                     LEFT JOIN pavitra.sanstha_basic_info bi on sm.sanstha_code=bi.sanstha_code   AND bi.minority_sanstha   in $minority_type_cond
                     WHERE
                          sm.schl_id like '$dist_id%'
                      AND sch_type='$sch_type'
                      AND sm.asst_flag ='A'
                      AND sm.ac_year = '$global_ac_year'
                      AND stg_flg1 = 'W'
                     ORDER BY medinstr_desc"; //AND asst_flag ='A'
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaBlockInfoRound2($eo_code, $option_medium_type, $tchr_curr_desg_cd, $tc_categ, $ts_subject_tot1, $ts_subject_tot2, $eos_tchr_gender) {
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($eos_tchr_gender == '1') { //M
            $tchr_gender_cond = " ('1','3')";
        } else if ($sch_type == '2') { //F
            $tchr_gender_cond = " ('2','3')";
        } else if ($sch_type == '3') { //F
            $tchr_gender_cond = " ('1','2','3')";
        }

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
        $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0'; //   $col_cond = 'gen_smj_tot';
//        }
//        else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot) > 0';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot) > 0';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot) > 0';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot) > 0';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot) > 0';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot) > 0';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot) > 0';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot) > 0';
//        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;

        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }



        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";

        $query = "SELECT DISTINCT(blkcd), blkname 
                  FROM shala_live.shala_block
                  WHERE blkcd IN
                            (SELECT substr(ESEV.schl_id,1,6) as block_code 
                              FROM 
                                        pavitra.pv_eo_sanstha_ex_vac as ESEV
                              LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                              LEFT JOIN shala.shala_basic_infoall SBIA ON SBIA.schcd = SAS.schcd AND SBIA.school_type IN  $tchr_gender_cond
                              LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond
                              WHERE
                                        ESEV.eo_code = '" . $eo_code . "'
                                    AND ESEV.eos_medium_id = '" . $option_medium_type . "'
                                    AND $tchr_curr_desg_cd_cond
                                    AND ESEV.minority_sanstha IN $minority_type_cond
                                    AND ESEV.eos_subject_cd IN ($ts_subject_tot1)
                                    AND ESEV.eos_type = '2'
                                    AND ESEV.asst_flag = 'A'
                                    AND ESEV.ac_year = '$global_ac_year'
                                    AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                    AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE $col_cond 
                                                        AND  roster_info.asst_flag = 'V'
                                                         AND roster_info.ac_year = '$global_ac_year'
                                                          AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                            )
                 ORDER BY blkname"; //  AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaSansthaInfoRound2($eo_code, $option_medium_type, $tchr_curr_desg_cd, $tc_categ, $ts_subject_tot1, $ts_subject_tot2, $eos_tchr_gender) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);


        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');


        if ($eos_tchr_gender == '1') { //M
            $tchr_gender_cond = " ('1','3')";
        } else if ($sch_type == '2') { //F
            $tchr_gender_cond = " ('2','3')";
        } else if ($sch_type == '3') { //F
            $tchr_gender_cond = " ('1','2','3')";
        }
        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
        $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0'; //   $col_cond = 'gen_smj_tot';
//        } else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot) > 0';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot) > 0';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot) > 0';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot) > 0';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot) > 0';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot) > 0';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot) > 0';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot) > 0';
//        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;

        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }


        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";


        $query = " SELECT ESEV.sanstha_code ,SBI.sanstha_name
                              FROM 
                                        pavitra.pv_eo_sanstha_ex_vac as ESEV
                              LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                              LEFT JOIN shala.shala_basic_infoall SBIA ON SBIA.schcd = SAS.schcd AND SBIA.school_type IN  $tchr_gender_cond
                              LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond

                              WHERE
                                         ESEV.eo_code = '" . $eo_code . "'
                                    AND  ESEV.eos_medium_id = '" . $option_medium_type . "'
                                    AND  $tchr_curr_desg_cd_cond
                                    AND  ESEV.minority_sanstha   in $minority_type_cond
                                    AND  ESEV.eos_subject_cd IN ($ts_subject_tot1)
                                    AND  ESEV.eos_type = '2'
                                    AND  ESEV.asst_flag = 'A'
                                    AND ESEV.ac_year = '$global_ac_year'
                                    AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                    AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE $col_cond 
                                                        AND  roster_info.asst_flag = 'V'
                                                        AND roster_info.ac_year = '$global_ac_year'
                                                          AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                             ORDER BY SBI.sanstha_name"; //AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaVacancySchInfoRound2($eo_code, $option_medium_type, $tchr_curr_desg_cd, $vacancy_block_info, $ts_subject_tot1, $ts_subject_tot2, $tc_categ, $array_vacancy_sanstha_info) {

        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($vacancy_block_info != '' && $array_vacancy_sanstha_info == '') {
            $search_cond = " AND  ESEV.schl_id LIKE '" . $vacancy_block_info . "%'";
        } else if ($vacancy_block_info == '' && $array_vacancy_sanstha_info != '') {
            $search_cond = " AND  ESEV.sanstha_code LIKE '" . $array_vacancy_sanstha_info . "%' ";
        } else if ($vacancy_block_info != '' && $array_vacancy_sanstha_info != '') {
            $search_cond = "  AND  ESEV.schl_id LIKE '" . $vacancy_block_info . "%' 
                                 AND  ESEV.sanstha_code LIKE '" . $array_vacancy_sanstha_info . "%' ";
        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;
        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }


        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
        $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0'; //   $col_cond = 'gen_smj_tot';
//        } else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot) > 0';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot) > 0';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot) > 0';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot) > 0';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot) > 0';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot) > 0';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot) > 0';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot) > 0';
//        }



        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";


        $query = "SELECT ESEV.schl_id,
                        SAS.school_name,
                        SV.vilname,
                        ESEV.sanstha_code,
                        SBI.sanstha_name,
                        ESEV.eos_medium_id,
                        SM.medinstr_desc, 
			ESEV.eos_desg_cd,
                        TPM.post_desc,
                        ESEV.eos_subject_cd,
                        sis.subject_group_desc as subject_code_text,
                        (ESEV.eos_no_of_post-ESEV.shifted_tchr_cnt) as eos_no_of_post,
                        ESEV. eos_type  
                    FROM 
                              pavitra.pv_eo_sanstha_ex_vac as ESEV
                    LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                    LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond
		    LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id 
                    LEFT JOIN master.tchr_post_master TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type='1'
                    LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                    INNER JOIN shala.shala_area SA ON ESEV.schl_id = SA.schcd 
		    INNER JOIN shala.shala_village SV ON SV.vilcd = SA.vilcd 
                    WHERE
                               ESEV.eo_code = '" . $eo_code . "' 
                          AND  ESEV.eos_medium_id = '" . $option_medium_type . "' 
                          AND  $tchr_curr_desg_cd_cond
                          AND  ESEV.minority_sanstha   IN $minority_type_cond
                          AND  ESEV.eos_subject_cd IN ($ts_subject_tot1)
                          AND  ESEV.eos_type = '2'
                          AND  ESEV.asst_flag = 'A'
                          AND ESEV.ac_year = '$global_ac_year'
                          AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                               $search_cond
                          AND ESEV.sanstha_code 
                                   IN (SELECT sanstha_code FROM pavitra.roster_info 
                                            WHERE $col_cond
                                                 AND  roster_info.asst_flag = 'V'
                                                 AND roster_info.ac_year = '$global_ac_year'
                                                 AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				)
                          
                   GROUP BY ESEV.schl_id,SAS.school_name,ESEV.sanstha_code,
                            SBI.sanstha_name,ESEV.eos_medium_id,SM.medinstr_desc,
                            ESEV.eos_desg_cd,TPM.post_desc,ESEV.eos_subject_cd,
                            subject_code_text,ESEV.eos_no_of_post,ESEV.eos_type,
                            ESEV.shifted_tchr_cnt,SV.vilname
                   HAVING (ESEV.eos_no_of_post - ESEV.shifted_tchr_cnt) > 0   
                    ORDER BY  SAS.school_name "; //AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateNoVacanctCntRound2($eo_code, $new_sanstha_id, $new_schl_id, $eos_medium_id_old, $eos_desg_cd_old, $eos_subject_cd, $eos_no_of_post, $eos_desg_cd_selected) {
        $global_ac_year = Configure::read('global_ac_year');
        try {

            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt +1 
                WHERE    dist_code = '" . $dist_id_old . "'
                   AND   schl_type = '" . $sch_type_old . "'
                   AND   eo_code = '" . $eo_code . "'
                   AND   sanstha_code = '" . $new_sanstha_id . "'
                   AND   schl_id = '" . $new_schl_id . "' 
                   AND   eos_medium_id = '" . $eos_medium_id_old . "'
                    AND   eos_desg_cd = $eos_desg_cd_selected
                   AND   eos_type = '2' 
                    AND ac_year = '$global_ac_year'
                   AND   eos_subject_cd = '" . $eos_subject_cd . "' 
                  
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateNoExcessCntRound2($eo_code, $old_sanstha_id, $old_schl_id, $eos_medium_id_old, $eos_desg_cd_old, $eos_subject_cd, $eos_no_of_post, $eos_desg_cd_selected) {
        $global_ac_year = Configure::read('global_ac_year');
        try {

            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt - 1 
                WHERE    dist_code = '" . $dist_id_old . "'
                   AND schl_type = '" . $sch_type_old . "'
                   AND eo_code = '" . $eo_code . "'
                   AND sanstha_code = '" . $old_sanstha_id . "'
                   AND schl_id = '" . $old_schl_id . "' 
                   AND eos_medium_id = '" . $eos_medium_id_old . "'
                   AND eos_desg_cd = $eos_desg_cd_old
                   AND eos_type = '1' 
                   AND ac_year = '$global_ac_year'
                   AND eos_subject_cd = '" . $eos_subject_cd . "' 
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    //ROUND 2 END
    //ROUND 3 START
    public function checkRound2Over($eo_code, $option_medium_type) {
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');


        $query = "SELECT count(*) FROM pavitra.smj_excesstch_det
                    LEFT JOIN pavitra.sanstha_basic_info ON smj_excesstch_det.sanstha_code = sanstha_basic_info.sanstha_code AND sanstha_basic_info.minority_sanstha   in  $minority_type_cond
                WHERE   
                    substr(schl_id,1,4) ='" . $dist_id . "'                     
                AND sch_type = '" . $sch_type . "'  
                AND eos_medium_id = '" . $option_medium_type . "' 
                AND smj_excesstch_det.ac_year = '$global_ac_year'
                AND asst_flag   in ('A')   
                AND  minority_sanstha   in $minority_type_cond             
                AND stg_flg2 not in ('S','W')                           
                AND stg_flg1 != 'S'
                AND tch_ex_id IN 
                         (SELECT  tch_ex_id 
                         FROM pavitra.smj_excesstch_det sm,pavitra.sanstha_basic_info bi,master.tchr_post_master 
                         WHERE    sch_type ='" . $sch_type . "'
                             AND schl_id like '" . $dist_id . "%'
                            AND sm.eos_medium_id = '" . $option_medium_type . "' 
                            AND   bi.sanstha_code=sm.sanstha_code 
                            AND bi.minority_sanstha   in  $minority_type_cond
                            AND sm.ac_year = '$global_ac_year'
                            AND sm.sanstha_code IN 
                                (SELECT sanstha_code 
                                    FROM pavitra.pv_eo_sanstha_ex_vac
                                    WHERE eo_code='" . $eo_code . "'
                                         AND ac_year = '$global_ac_year'
                                    AND minority_sanstha   in  $minority_type_cond
                                 )
                            AND eos_medium_id = '" . $option_medium_type . "'  
                            AND sm.asst_flag   in ('A')  
                            AND post_type = 1
                            AND post_id=tchr_curr_desg_cd   
                            )"; //AND asst_flag ='A'
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function checkRound2OverExVac($eo_code, $option_medium_type) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT count(*)  FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                  WHERE   eo_code = '" . $eo_code . "'  
                       AND ESEV.schl_type = '" . $sch_type . "' 
                       AND ESEV.eos_medium_id = '" . $option_medium_type . "'   
                       AND ESEV.asst_flag NOT IN ('A')  
                       AND ESEV.ac_year = '$global_ac_year'
                       AND ESEV.minority_sanstha IN $minority_type_cond"; //AND asst_flag ='A'
//        echo $query;
//        exit();

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaMediumExcessMediumRound3($eo_code) {

//        $query = "SELECT distinct(sm.eos_medium_id),medinstr_desc
//                                                    from pavitra.pv_eo_sanstha_ex_vac ex,master.shala_medinstr,pavitra.smj_excesstch_det sm
//                                                    WHERE sm.eos_medium_id=medinstr_id
//                                                    AND eo_code='" . $eo_code . "'
//                                                    AND eos_type='1'
//                                                    
//                                                  
//                                                   AND sm.sanstha_code=ex.sanstha_code 
//                                                     AND minority_sanstha   in $minority_type_cond
//                                                     AND stg_flg2 = 'W'
//                                                    ORDER BY medinstr_desc"; //AND asst_flag ='A'
//         echo $query;   exit();
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT distinct(sm.eos_medium_id),medinstr_desc
                    FROM pavitra.smj_excesstch_det sm
                  LEFT JOIN master.shala_medinstr mi ON sm.eos_medium_id = mi.medinstr_id
                  LEFT JOIN pavitra.sanstha_basic_info bi ON sm.sanstha_code=bi.sanstha_code AND bi.minority_sanstha IN $minority_type_cond
                  WHERE     sm.schl_id like '$dist_id%'
                        AND sch_type = '$sch_type'
                        AND sm.asst_flag ='A'
                        AND stg_flg2 = 'W'
                        AND sm.ac_year = '$global_ac_year'
                  ORDER BY medinstr_desc"; //AND asst_flag ='A'

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaBlockInfoRound3($eo_code, $option_medium_type, $tchr_curr_desg_cd, $tc_categ, $ts_subject_tot1, $ts_subject_tot2, $eos_tchr_gender) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');


        if ($eos_tchr_gender == '1') { //M
            $tchr_gender_cond = " ('1','3')";
        } else if ($sch_type == '2') { //F
            $tchr_gender_cond = " ('2','3')";
        } else if ($sch_type == '3') { //F
            $tchr_gender_cond = " ('1','2','3')";
        }

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
//        $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot) > 0'; //   $col_cond = 'gen_smj_tot';
//        }
//        else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot) > 0';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot) > 0';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot) > 0';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot) > 0';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot) > 0';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot) > 0';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot) > 0';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot) > 0';
//        }

        $col_cond = '((gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0) OR (sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) > 0) OR (st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) > 0) OR (obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) > 0) OR (vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) > 0) OR (sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) > 0) OR (ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) > 0) OR (ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot +ntc_ext_tot) > 0) OR (ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) > 0))';


        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;

        $subject_select_cond = '';

//        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
//            $subject_select_cond = "  IN ($ts_subject_tot1) ";
//        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
//            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
//        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
//            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
//        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
//            $subject_select_cond = "  IN ($ts_subject_tot1) ";
//        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
//            $subject_select_cond = "  IN ($ts_subject_tot1) ";
//        } else {
//            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
//        }


        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3 || $ts_subject_tot1 == 5) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 || $ts_subject_tot1 == 4) {
            $subject_select_cond = "  IN (1,4) ";
        }

        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";


        $query = "SELECT DISTINCT(blkcd), blkname 
                  FROM shala_live.shala_block
                  WHERE blkcd IN
                            (SELECT substr(ESEV.schl_id,1,6) as block_code 
                              FROM 
                                        pavitra.pv_eo_sanstha_ex_vac as ESEV
                              LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                              LEFT JOIN shala.shala_basic_infoall SBIA ON SBIA.schcd = SAS.schcd AND SBIA.school_type IN  $tchr_gender_cond
                              LEFT JOIN pavitra.sanstha_basic_info as SBI ON SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha IN $minority_type_cond

                              WHERE
                                        ESEV.eo_code = '" . $eo_code . "'
                                    AND ESEV.eos_medium_id = '" . $option_medium_type . "'
                                    AND $tchr_curr_desg_cd_cond
                                    AND ESEV.minority_sanstha   in  $minority_type_cond
                                    AND ESEV.eos_subject_cd $subject_select_cond
                                    AND ESEV.eos_type = '2'
                                    AND ESEV.asst_flag = 'A'
                                    AND ESEV.ac_year = '$global_ac_year'
                                    AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                    AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE $col_cond  
                                                        AND roster_info.asst_flag = 'V'
                                                        AND roster_info.ac_year = '$global_ac_year'
                                                        AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                            )
                 ORDER BY blkname"; // AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaSansthaInfoRound3($eo_code, $option_medium_type, $tchr_curr_desg_cd, $tc_categ, $ts_subject_tot1, $ts_subject_tot2, $eos_tchr_gender) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($eos_tchr_gender == '1') { //M
            $tchr_gender_cond = " ('1','3')";
        } else if ($sch_type == '2') { //F
            $tchr_gender_cond = " ('2','3')";
        } else if ($sch_type == '3') { //F
            $tchr_gender_cond = " ('1','2','3')";
        }
        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
//        $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot) > 0'; //   $col_cond = 'gen_smj_tot';
//        } else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot) > 0';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot) > 0';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot) > 0';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot) > 0';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot) > 0';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot) > 0';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot) > 0';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot) > 0';
//        }

        $col_cond = '((gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0) OR (sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) > 0) OR (st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) > 0) OR (obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) > 0) OR (vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) > 0) OR (sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) > 0) OR (ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) > 0) OR (ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) > 0) OR (ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) > 0))';

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;

        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }

        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";

        $query = " SELECT ESEV.sanstha_code ,SBI.sanstha_name
                              FROM 
                                        pavitra.pv_eo_sanstha_ex_vac as ESEV
                              LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                              	LEFT JOIN shala.shala_basic_infoall SBIA ON SBIA.schcd = SAS.schcd AND SBIA.school_type IN  $tchr_gender_cond
                              LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha IN $minority_type_cond

                              WHERE
                                        ESEV.eo_code = '" . $eo_code . "'
                                    AND ESEV.eos_medium_id = '" . $option_medium_type . "'
                                    AND $tchr_curr_desg_cd_cond
                                    AND ESEV.minority_sanstha IN $minority_type_cond
                                    AND ESEV.eos_subject_cd IN ($ts_subject_tot1)
                                    AND ESEV.eos_type = '2'
                                    AND ESEV.asst_flag = 'A'
                                    AND ESEV.ac_year = '$global_ac_year'
                                    AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                    AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE   $col_cond  
                                                        AND  roster_info.asst_flag = 'V'
                                                        AND roster_info.ac_year = '$global_ac_year'
                                                        AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                             ORDER BY SBI.sanstha_name"; //  AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaVacancySchInfoRound3($eo_code, $option_medium_type, $tchr_curr_desg_cd, $vacancy_block_info, $ts_subject_tot1, $ts_subject_tot2, $tc_categ, $array_vacancy_sanstha_info) {

        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($vacancy_block_info != '' && $array_vacancy_sanstha_info == '') {
            $search_cond = " AND  ESEV.schl_id LIKE '" . $vacancy_block_info . "%'";
        } else if ($vacancy_block_info == '' && $array_vacancy_sanstha_info != '') {
            $search_cond = " AND  ESEV.sanstha_code LIKE '" . $array_vacancy_sanstha_info . "%' ";
        } else if ($vacancy_block_info != '' && $array_vacancy_sanstha_info != '') {
            $search_cond = "  AND  ESEV.schl_id LIKE '" . $vacancy_block_info . "%' 
                                 AND  ESEV.sanstha_code LIKE '" . $array_vacancy_sanstha_info . "%' ";
        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;
        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }


        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
//        $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot) > 0'; //   $col_cond = 'gen_smj_tot';
//        } else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot) > 0';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot) > 0';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot) > 0';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot) > 0';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot) > 0';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot) > 0';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot) > 0';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot) > 0';
//        }


        $col_cond = '((gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0) OR (sc_sanc_tot -(sc_work_tot + sc_smj_tot +sc_ext_tot) > 0) OR (st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) > 0) OR (obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) > 0) OR (vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) > 0) OR (sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) > 0) OR (ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) > 0) OR (ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) > 0) OR (ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) > 0))';

        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";


        $query = "SELECT ESEV.schl_id,
                         SAS.school_name,
                         SV.vilname,
                         ESEV.sanstha_code,
                         SBI.sanstha_name,
                         ESEV.eos_medium_id,
                         SM.medinstr_desc, 
			 ESEV.eos_desg_cd,
                         TPM.post_desc,
                         ESEV.eos_subject_cd,
                         sis.subject_group_desc as subject_code_text,
                         (ESEV.eos_no_of_post-ESEV.shifted_tchr_cnt) as eos_no_of_post,
                         ESEV. eos_type  
                    FROM 
                              pavitra.pv_eo_sanstha_ex_vac as ESEV
                    LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                    LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond
		    LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id 
                    LEFT JOIN master.tchr_post_master TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type='1'
                    LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                    INNER JOIN shala.shala_area SA ON ESEV.schl_id = SA.schcd 
		    INNER JOIN shala.shala_village SV ON SV.vilcd = SA.vilcd 
                    WHERE
                                 ESEV.eo_code = '" . $eo_code . "' 
                            AND  ESEV.eos_medium_id = '" . $option_medium_type . "' 
                            AND  $tchr_curr_desg_cd_cond
                            AND  ESEV.minority_sanstha   IN $minority_type_cond
                            AND  ESEV.eos_subject_cd IN ($ts_subject_tot1)
                            AND  ESEV.eos_type = '2'
                            AND  ESEV.asst_flag = 'A'
                            AND  ESEV.ac_year = '$global_ac_year'
                            AND  ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                 $search_cond
                            AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE  $col_cond 
                                                    AND roster_info.asst_flag = 'V'
                                                    AND roster_info.ac_year = '$global_ac_year'
                                                    AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                          
                   GROUP BY ESEV.schl_id,SAS.school_name,ESEV.sanstha_code,
                            SBI.sanstha_name,ESEV.eos_medium_id,SM.medinstr_desc,
                            ESEV.eos_desg_cd,TPM.post_desc,ESEV.eos_subject_cd,
                            subject_code_text,ESEV.eos_no_of_post,ESEV.eos_type,
                            ESEV.shifted_tchr_cnt,SV.vilname
                   HAVING (ESEV.eos_no_of_post - ESEV.shifted_tchr_cnt) > 0   
                    ORDER BY SAS.school_name "; //AND  ESEV.eos_subject_cd $subject_select_cond 
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateNoVacanctCntRound3($eo_code, $new_sanstha_id, $new_schl_id, $eos_medium_id_old, $eos_desg_cd_old, $eos_subject_cd, $eos_no_of_post, $eos_desg_cd_selected) {
        $global_ac_year = Configure::read('global_ac_year');
        try {

            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt + 1 
                WHERE    dist_code = '" . $dist_id_old . "'
                   AND   schl_type = '" . $sch_type_old . "'
                   AND   eo_code = '" . $eo_code . "'
                   AND   sanstha_code = '" . $new_sanstha_id . "'
                   AND   schl_id = '" . $new_schl_id . "' 
                   AND   eos_medium_id = '" . $eos_medium_id_old . "'
                   AND   eos_desg_cd = $eos_desg_cd_selected
                   AND   eos_type = '2' 
                   AND   ac_year = '$global_ac_year'
                   AND   eos_subject_cd = '" . $eos_subject_cd . "' 
                  
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateNoExcessCntRound3($eo_code, $old_sanstha_id, $old_schl_id, $eos_medium_id_old, $eos_desg_cd_old, $eos_subject_cd, $eos_no_of_post, $eos_desg_cd_selected) {
        $global_ac_year = Configure::read('global_ac_year');
        try {

            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt - 1 
                WHERE    dist_code = '" . $dist_id_old . "'
                   AND   schl_type = '" . $sch_type_old . "'
                   AND   eo_code = '" . $eo_code . "'
                   AND   sanstha_code = '" . $old_sanstha_id . "'
                   AND   schl_id = '" . $old_schl_id . "' 
                   AND   eos_medium_id = '" . $eos_medium_id_old . "'
                   AND   eos_desg_cd = $eos_desg_cd_old
                   AND   eos_type = '1' 
                   AND   ac_year = '$global_ac_year'
                   AND   eos_subject_cd = '" . $eos_subject_cd . "' 
                  
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    //ROUND 3 END
    //ROUND 4 START

    public function checkRound3Over($eo_code, $option_medium_type) {
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT count(*) FROM pavitra.smj_excesstch_det
                LEFT JOIN pavitra.sanstha_basic_info ON smj_excesstch_det.sanstha_code = sanstha_basic_info.sanstha_code AND sanstha_basic_info.minority_sanstha   in $minority_type_cond
             WHERE              
                         substr(schl_id,1,4) = '" . $dist_id . "'                       
                    AND sch_type = '" . $sch_type . "'  
                    AND eos_medium_id = '" . $option_medium_type . "'
                    AND asst_flag   in ('A')   
                    AND minority_sanstha   in $minority_type_cond  
                    AND stg_flg3 not in ('S','W')        
                    AND stg_flg1 != 'S'         
                    AND stg_flg2 != 'S'
                    AND ac_year = '$global_ac_year'
                    AND tch_ex_id 
                        IN (SELECT  tch_ex_id 
                                FROM pavitra.smj_excesstch_det sm,pavitra.sanstha_basic_info bi,master.tchr_post_master  
                                WHERE   sch_type ='" . $sch_type . "'
                                    AND schl_id like '" . $dist_id . "%'
                                    AND eos_medium_id = '" . $option_medium_type . "'
                                    AND bi.sanstha_code=sm.sanstha_code 
                                    AND bi.minority_sanstha   in  $minority_type_cond
                                    AND bi.ac_year = '$global_ac_year'
                                    AND sm.sanstha_code 
                             IN 
                                (SELECT sanstha_code 
                                    FROM pavitra.pv_eo_sanstha_ex_vac
                                    WHERE eo_code='" . $eo_code . "'
                                     AND ac_year = '$global_ac_year'
                                     AND minority_sanstha   in $minority_type_cond
                                  )
                            AND  eos_medium_id = '" . $option_medium_type . "'
                            AND sm.asst_flag   in ('A')  
                            AND post_type=1
                       AND post_id=tchr_curr_desg_cd   
                            )"; //AND asst_flag ='A'
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function checkRound3OverExVac($eo_code, $option_medium_type) {
        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');


        $query = "SELECT count(*)  FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                  WHERE   eo_code = '" . $eo_code . "'   
                       AND ESEV.schl_type = '" . $sch_type . "' 
                       AND ESEV.eos_medium_id = '" . $option_medium_type . "'   
                       AND ESEV.asst_flag not in ('A')   
                       AND ESEV.ac_year = '$global_ac_year'
                       AND ESEV.minority_sanstha   in  $minority_type_cond"; //AND asst_flag ='A'
//        echo $query;
//        exit();

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaMediumExcessMediumRound4($eo_code) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT distinct(sm.eos_medium_id),medinstr_desc
                    FROM pavitra.smj_excesstch_det sm
                        LEFT JOIN master.shala_medinstr mi on sm.eos_medium_id=mi.medinstr_id
                        LEFT JOIN pavitra.sanstha_basic_info bi on sm.sanstha_code=bi.sanstha_code  AND bi.minority_sanstha   in  $minority_type_cond
                    WHERE  sm.schl_id like '$dist_id%'
                          AND sch_type = '$sch_type'
                          AND sm.asst_flag ='A'
                          AND stg_flg3 = 'W'
                          AND sm.ac_year = '$global_ac_year'
                    ORDER BY medinstr_desc"; //AND asst_flag ='A'
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaBlockInfoRound4($eo_code, $option_medium_type, $tchr_curr_desg_cd, $tc_categ, $ts_subject_tot1, $ts_subject_tot2, $eos_tchr_gender) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($eos_tchr_gender == '1') { //M
            $tchr_gender_cond = " ('1','3')";
        } else if ($sch_type == '2') { //F
            $tchr_gender_cond = " ('2','3')";
        } else if ($sch_type == '3') { //F
            $tchr_gender_cond = " ('1','2','3')";
        }

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        if ($tc_categ == '1') { //General
            $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0'; //   $col_cond = 'gen_smj_tot';
        } else if ($tc_categ == '2') { //SC
            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) > 0';
        } else if ($tc_categ == '3') { //ST
            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) > 0';
        } else if ($tc_categ == '4') { //OBC
            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) > 0';
        } else if ($tc_categ == '10') { //VJA
            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) > 0';
        } else if ($tc_categ == '12') { //SBC
            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) > 0';
        } else if ($tc_categ == '13') { //NTB
            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) > 0';
        } else if ($tc_categ == '14') { //NTC  
            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) > 0';
        } else if ($tc_categ == '15') { //NTD
            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) > 0';
        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;

        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }

        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";

        $query = "SELECT DISTINCT(blkcd), blkname 
                  FROM shala_live.shala_block
                  WHERE blkcd IN
                            (SELECT substr(ESEV.schl_id,1,6) as block_code 
                              FROM 
                                        pavitra.pv_eo_sanstha_ex_vac as ESEV
                              LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                              LEFT JOIN shala.shala_basic_infoall SBIA ON SBIA.schcd = SAS.schcd AND SBIA.school_type IN  $tchr_gender_cond
                              LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha in $minority_type_cond

                              WHERE
                                        ESEV.eo_code = '" . $eo_code . "'
                                    AND ESEV.eos_medium_id = '" . $option_medium_type . "'
                                    AND $tchr_curr_desg_cd_cond
                                    AND ESEV.minority_sanstha in $minority_type_cond 
                                    AND ESEV.eos_subject_cd IN ($ts_subject_tot2)
                                    AND ESEV.eos_type = '2'
                                    AND ESEV.asst_flag = 'A'
                                    AND ESEV.ac_year = '$global_ac_year'
                                    AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                    AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE $col_cond  
                                                        AND roster_info.asst_flag = 'V'
                                                        AND roster_info.ac_year = '$global_ac_year'
                                                        AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                            )
                 ORDER BY blkname"; // AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaSansthaInfoRound4($eo_code, $option_medium_type, $tchr_curr_desg_cd, $tc_categ, $ts_subject_tot1, $ts_subject_tot2, $eos_tchr_gender) {

        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');


        if ($eos_tchr_gender == '1') { //M
            $tchr_gender_cond = " ('1','3')";
        } else if ($sch_type == '2') { //F
            $tchr_gender_cond = " ('2','3')";
        } else if ($sch_type == '3') { //F
            $tchr_gender_cond = " ('1','2','3')";
        }


        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        if ($tc_categ == '1') { //General
            $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0'; //   $col_cond = 'gen_smj_tot';
        } else if ($tc_categ == '2') { //SC
            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) > 0';
        } else if ($tc_categ == '3') { //ST
            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) > 0';
        } else if ($tc_categ == '4') { //OBC
            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) > 0';
        } else if ($tc_categ == '10') { //VJA
            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) > 0';
        } else if ($tc_categ == '12') { //SBC
            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) > 0';
        } else if ($tc_categ == '13') { //NTB
            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) > 0';
        } else if ($tc_categ == '14') { //NTC  
            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) > 0';
        } else if ($tc_categ == '15') { //NTD
            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) > 0';
        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;

        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }


        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";



        $query = " SELECT ESEV.sanstha_code ,SBI.sanstha_name
                              FROM 
                                        pavitra.pv_eo_sanstha_ex_vac as ESEV
                              LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                              LEFT JOIN shala.shala_basic_infoall SBIA ON SBIA.schcd = SAS.schcd AND SBIA.school_type IN  $tchr_gender_cond
                              LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in  $minority_type_cond

                              WHERE
                                         ESEV.eo_code = '" . $eo_code . "'
                                    AND  ESEV.eos_medium_id = '" . $option_medium_type . "'
                                    AND  $tchr_curr_desg_cd_cond
                                    AND  ESEV.minority_sanstha   in  $minority_type_cond
                                    AND  ESEV.eos_subject_cd IN ($ts_subject_tot2)
                                    AND  ESEV.eos_type = '2'
                                    AND  ESEV.asst_flag = 'A'
                                    AND ESEV.ac_year = '$global_ac_year'
                                    AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                    AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE   $col_cond  
                                                        AND  roster_info.asst_flag = 'V'
                                                        AND roster_info.ac_year = '$global_ac_year'
                                                        AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                             ORDER BY SBI.sanstha_name"; //  AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaVacancySchInfoRound4($eo_code, $option_medium_type, $tchr_curr_desg_cd, $vacancy_block_info, $ts_subject_tot1, $ts_subject_tot2, $tc_categ, $array_vacancy_sanstha_info) {

        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($vacancy_block_info != '' && $array_vacancy_sanstha_info == '') {
            $search_cond = " AND  ESEV.schl_id LIKE '" . $vacancy_block_info . "%'";
        } else if ($vacancy_block_info == '' && $array_vacancy_sanstha_info != '') {
            $search_cond = " AND  ESEV.sanstha_code LIKE '" . $array_vacancy_sanstha_info . "%' ";
        } else if ($vacancy_block_info != '' && $array_vacancy_sanstha_info != '') {
            $search_cond = "  AND  ESEV.schl_id LIKE '" . $vacancy_block_info . "%' 
                                 AND  ESEV.sanstha_code LIKE '" . $array_vacancy_sanstha_info . "%' ";
        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;
        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }


        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        if ($tc_categ == '1') { //General
            $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0'; //   $col_cond = 'gen_smj_tot';
        } else if ($tc_categ == '2') { //SC
            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) > 0';
        } else if ($tc_categ == '3') { //ST
            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) > 0';
        } else if ($tc_categ == '4') { //OBC
            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) > 0';
        } else if ($tc_categ == '10') { //VJA
            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) > 0';
        } else if ($tc_categ == '12') { //SBC
            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) > 0';
        } else if ($tc_categ == '13') { //NTB
            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) > 0';
        } else if ($tc_categ == '14') { //NTC  
            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) > 0';
        } else if ($tc_categ == '15') { //NTD
            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot +ntd_ext_tot) > 0';
        }



        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";


        $query = "SELECT ESEV.schl_id,
                        SAS.school_name,
                        SV.vilname,
                        ESEV.sanstha_code,
                        SBI.sanstha_name,
                        ESEV.eos_medium_id,
                        SM.medinstr_desc, 
			ESEV.eos_desg_cd,
                        TPM.post_desc,
                        ESEV.eos_subject_cd,
                        sis.subject_group_desc as subject_code_text,
                        (ESEV.eos_no_of_post-ESEV.shifted_tchr_cnt) as eos_no_of_post,
                        ESEV. eos_type  
                    FROM 
                              pavitra.pv_eo_sanstha_ex_vac as ESEV
                    LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                    LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond
		    LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id 
                    LEFT JOIN master.tchr_post_master TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type='1'
                    LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                    INNER JOIN shala.shala_area SA ON ESEV.schl_id = SA.schcd 
		    INNER JOIN shala.shala_village SV ON SV.vilcd = SA.vilcd 
                    WHERE
                                 ESEV.eo_code = '" . $eo_code . "' 
                            AND  ESEV.eos_medium_id = '" . $option_medium_type . "' 
                            AND  $tchr_curr_desg_cd_cond
                            AND  ESEV.minority_sanstha   IN $minority_type_cond
                            AND  ESEV.eos_subject_cd IN ($ts_subject_tot2)
                            AND  ESEV.eos_type = '2'
                            AND  ESEV.asst_flag = 'A'
                            AND  ESEV.ac_year = '$global_ac_year'
                            AND  ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                 $search_cond
                            AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE  $col_cond 
                                                    AND roster_info.asst_flag = 'V'
                                                    AND roster_info.ac_year = '$global_ac_year'
                                                    AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                          
                   GROUP BY ESEV.schl_id,SAS.school_name,ESEV.sanstha_code,
                            SBI.sanstha_name,ESEV.eos_medium_id,SM.medinstr_desc,
                            ESEV.eos_desg_cd,TPM.post_desc,ESEV.eos_subject_cd,
                            subject_code_text,ESEV.eos_no_of_post,
                            ESEV.eos_type,ESEV.shifted_tchr_cnt,SV.vilname
                   HAVING (ESEV.eos_no_of_post - ESEV.shifted_tchr_cnt) > 0   
                    ORDER BY SAS.school_name "; //AND  ESEV.eos_subject_cd $subject_select_cond 
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateNoVacanctCntRound4($eo_code, $new_sanstha_id, $new_schl_id, $eos_medium_id_old, $eos_desg_cd_old, $eos_subject_cd, $eos_no_of_post, $eos_desg_cd_selected) {

        $global_ac_year = Configure::read('global_ac_year');
        try {
            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt +1 
                WHERE   dist_code = '" . $dist_id_old . "'
                   AND  schl_type = '" . $sch_type_old . "'
                   AND  eo_code = '" . $eo_code . "'
                   AND  sanstha_code = '" . $new_sanstha_id . "'
                   AND  schl_id = '" . $new_schl_id . "' 
                   AND  eos_medium_id = '" . $eos_medium_id_old . "'
                   AND  eos_desg_cd = $eos_desg_cd_selected
                   AND  eos_type = '2' 
                   AND  ac_year = '$global_ac_year'
                   AND  eos_subject_cd = '" . $eos_subject_cd . "' 
                 
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateNoExcessCntRound4($eo_code, $old_sanstha_id, $old_schl_id, $eos_medium_id_old, $eos_desg_cd_old, $eos_subject_cd, $eos_no_of_post, $eos_desg_cd_selected) {

        $global_ac_year = Configure::read('global_ac_year');
        try {
            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt - 1  
                WHERE  dist_code = '" . $dist_id_old . "'
                   AND schl_type = '" . $sch_type_old . "'
                   AND eo_code = '" . $eo_code . "'
                   AND sanstha_code = '" . $old_sanstha_id . "'
                   AND schl_id = '" . $old_schl_id . "' 
                   AND eos_medium_id = '" . $eos_medium_id_old . "'
                   AND eos_desg_cd = $eos_desg_cd_old
                   AND eos_type = '1' 
                   AND ac_year = '$global_ac_year'
                   AND eos_subject_cd = '" . $eos_subject_cd . "' 
                 
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    //ROUND 4 END
    //ROUND 5 START
    public function getSamaMediumExcessMediumRound5($eo_code) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT distinct(sm.eos_medium_id),medinstr_desc
                    FROM pavitra.smj_excesstch_det sm
                        LEFT JOIN master.shala_medinstr mi on sm.eos_medium_id = mi.medinstr_id
                        LEFT JOIN pavitra.sanstha_basic_info bi on sm.sanstha_code=bi.sanstha_code AND bi.minority_sanstha in $minority_type_cond
                            WHERE   sm.schl_id like '$dist_id%'
                                AND sch_type = '$sch_type'
                                AND sm.asst_flag = 'A'
                                AND stg_flg4 = 'W'
                                AND sm.ac_year = '$global_ac_year'
                            ORDER BY medinstr_desc"; //AND asst_flag ='A'
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function checkRound4OverExVac($eo_code, $option_medium_type) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');


        $query = "SELECT count(*)  FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                  WHERE   eo_code = '" . $eo_code . "'   
                       AND ESEV.schl_type = '" . $sch_type . "' 
                       AND ESEV.eos_medium_id = '" . $option_medium_type . "'   
                       AND ESEV.asst_flag not in ('A')   
                       AND ESEV.ac_year = '$global_ac_year'
                       AND ESEV.minority_sanstha   in  $minority_type_cond"; //AND asst_flag ='A'
//        echo $query;
//        exit();

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function checkRound4Over($eo_code, $option_medium_type) {
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT count(*) FROM pavitra.smj_excesstch_det
                LEFT JOIN pavitra.sanstha_basic_info ON smj_excesstch_det.sanstha_code = sanstha_basic_info.sanstha_code AND sanstha_basic_info.minority_sanstha IN $minority_type_cond
             WHERE              
                         substr(schl_id,1,4) = '" . $dist_id . "'                       
                    AND sch_type = '" . $sch_type . "'  
                    AND eos_medium_id = '" . $option_medium_type . "'
                    AND smj_excesstch_det.ac_year = '$global_ac_year'
                    AND asst_flag IN ('A')   
                    AND minority_sanstha   in $minority_type_cond  
                    AND stg_flg4 NOT IN ('S','W')        
                    AND stg_flg1 != 'S'         
                    AND stg_flg2 != 'S'
		    AND stg_flg3 != 'S'
                    AND tch_ex_id 
                        IN (SELECT  tch_ex_id 
                                FROM pavitra.smj_excesstch_det sm,pavitra.sanstha_basic_info bi,master.tchr_post_master  
                                WHERE   sch_type ='" . $sch_type . "'
                                    AND schl_id like '" . $dist_id . "%'
                                    AND eos_medium_id = '" . $option_medium_type . "'
                                    AND bi.sanstha_code=sm.sanstha_code 
                                    AND bi.minority_sanstha IN $minority_type_cond
                                    AND bi.ac_year = '$global_ac_year'
                                    AND sm.sanstha_code 
                             IN 
                                (SELECT sanstha_code 
                                    FROM pavitra.pv_eo_sanstha_ex_vac
                                        WHERE   eo_code='" . $eo_code . "'
                                            AND ac_year = '$global_ac_year'
                                            AND minority_sanstha   in $minority_type_cond
                                  )
                            AND eos_medium_id = '" . $option_medium_type . "'
                            AND sm.asst_flag IN('A')  
                            AND post_type = 1
                            AND post_id = tchr_curr_desg_cd   
                            )"; //AND asst_flag ='A'
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaBlockInfoRound5($eo_code, $option_medium_type, $tchr_curr_desg_cd, $tc_categ, $ts_subject_tot1, $ts_subject_tot2, $eos_tchr_gender) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($eos_tchr_gender == '1') { //M
            $tchr_gender_cond = " ('1','3')";
        } else if ($sch_type == '2') { //F
            $tchr_gender_cond = " ('2','3')";
        } else if ($sch_type == '3') { //F
            $tchr_gender_cond = " ('1','2','3')";
        }

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
        $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0'; //   $col_cond = 'gen_smj_tot';
//        }
//        else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot) > 0';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot) > 0';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot) > 0';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot) > 0';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot) > 0';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot) > 0';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot) > 0';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot) > 0';
//        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;

        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }



        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";

        $query = "SELECT DISTINCT(blkcd), blkname 
                  FROM shala_live.shala_block
                  WHERE blkcd IN
                            (SELECT substr(ESEV.schl_id,1,6) as block_code 
                              FROM 
                                        pavitra.pv_eo_sanstha_ex_vac as ESEV
                              LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                              LEFT JOIN shala.shala_basic_infoall SBIA ON SBIA.schcd = SAS.schcd AND SBIA.school_type IN  $tchr_gender_cond
                              LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond
                              WHERE
                                        ESEV.eo_code = '" . $eo_code . "'
                                    AND ESEV.eos_medium_id = '" . $option_medium_type . "'
                                    AND $tchr_curr_desg_cd_cond
                                    AND ESEV.minority_sanstha in $minority_type_cond 
                                    AND ESEV.eos_subject_cd IN ($ts_subject_tot2)
                                    AND ESEV.eos_type = '2'
                                    AND ESEV.asst_flag = 'A'
                                    AND ESEV.ac_year = '$global_ac_year'
                                    AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                    AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE $col_cond  
                                                        AND  roster_info.asst_flag = 'V'
                                                        AND roster_info.ac_year = '$global_ac_year'
                                                        AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                            )
                 ORDER BY blkname"; // AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaSansthaInfoRound5($eo_code, $option_medium_type, $tchr_curr_desg_cd, $tc_categ, $ts_subject_tot1, $ts_subject_tot2, $eos_tchr_gender) {

        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($eos_tchr_gender == '1') { //M
            $tchr_gender_cond = " ('1','3')";
        } else if ($sch_type == '2') { //F
            $tchr_gender_cond = " ('2','3')";
        } else if ($sch_type == '3') { //F
            $tchr_gender_cond = " ('1','2','3')";
        }

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
        $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0'; //   $col_cond = 'gen_smj_tot';
//        } else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot) > 0';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot) > 0';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot) > 0';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot) > 0';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot) > 0';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot) > 0';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot) > 0';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot) > 0';
//        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;

        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }


        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";


        $query = " SELECT ESEV.sanstha_code ,SBI.sanstha_name
                              FROM 
                                        pavitra.pv_eo_sanstha_ex_vac as ESEV
                              LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                              LEFT JOIN shala.shala_basic_infoall SBIA ON SBIA.schcd = SAS.schcd AND SBIA.school_type IN  $tchr_gender_cond
                              LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond

                              WHERE
                                        ESEV.eo_code = '" . $eo_code . "'
                                    AND ESEV.eos_medium_id = '" . $option_medium_type . "'
                                    AND $tchr_curr_desg_cd_cond
                                    AND ESEV.minority_sanstha   in  $minority_type_cond
                                    AND ESEV.eos_subject_cd IN ($ts_subject_tot2)
                                    AND ESEV.eos_type = '2'
                                    AND ESEV.asst_flag = 'A'
                                    AND ESEV.ac_year = '$global_ac_year'
                                    AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                    AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code 
                                                    FROM pavitra.roster_info 
                                                            WHERE   $col_cond  
                                                                AND roster_info.asst_flag = 'V'
                                                                AND roster_info.ac_year = '$global_ac_year'
                                                                AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                             ORDER BY SBI.sanstha_name"; //  AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaVacancySchInfoRound5($eo_code, $option_medium_type, $tchr_curr_desg_cd, $vacancy_block_info, $ts_subject_tot1, $ts_subject_tot2, $tc_categ, $array_vacancy_sanstha_info) {

        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($vacancy_block_info != '' && $array_vacancy_sanstha_info == '') {
            $search_cond = " AND  ESEV.schl_id LIKE '" . $vacancy_block_info . "%'";
        } else if ($vacancy_block_info == '' && $array_vacancy_sanstha_info != '') {
            $search_cond = " AND  ESEV.sanstha_code LIKE '" . $array_vacancy_sanstha_info . "%' ";
        } else if ($vacancy_block_info != '' && $array_vacancy_sanstha_info != '') {
            $search_cond = "  AND  ESEV.schl_id LIKE '" . $vacancy_block_info . "%' 
                                 AND  ESEV.sanstha_code LIKE '" . $array_vacancy_sanstha_info . "%' ";
        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;
        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }


        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
        $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0'; //   $col_cond = 'gen_smj_tot';
//        } else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot) > 0';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot) > 0';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot) > 0';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot) > 0';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot) > 0';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot) > 0';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot) > 0';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot) > 0';
//        }

        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";


        $query = "SELECT ESEV.schl_id,
                        SAS.school_name,
                        SV.vilname,
                        ESEV.sanstha_code,
                        SBI.sanstha_name,
                        ESEV.eos_medium_id,
                        SM.medinstr_desc, 
			ESEV.eos_desg_cd,
                        TPM.post_desc,
                        ESEV.eos_subject_cd,
                        sis.subject_group_desc as subject_code_text,
                        (ESEV.eos_no_of_post-ESEV.shifted_tchr_cnt) as eos_no_of_post,
                        ESEV. eos_type  
                    FROM 
                              pavitra.pv_eo_sanstha_ex_vac as ESEV
                    LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                    LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond
		    LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id 
                    LEFT JOIN master.tchr_post_master TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type='1'
                    LEFT JOIN master.tchr_apt_subject as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                    INNER JOIN shala.shala_area SA ON ESEV.schl_id = SA.schcd 
		    INNER JOIN shala.shala_village SV ON SV.vilcd = SA.vilcd 
                    WHERE
                                ESEV.eo_code = '" . $eo_code . "' 
                            AND ESEV.eos_medium_id = '" . $option_medium_type . "' 
                            AND $tchr_curr_desg_cd_cond
                            AND ESEV.minority_sanstha   IN $minority_type_cond
                            AND ESEV.eos_subject_cd IN ($ts_subject_tot2)
                            AND ESEV.eos_type = '2'
                            AND ESEV.asst_flag = 'A'
                            AND ESEV.ac_year = '$global_ac_year'
                            AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                 $search_cond
                            AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code 
                                                    FROM pavitra.roster_info 
                                                        WHERE  $col_cond 
                                                            AND roster_info.asst_flag = 'V'
                                                            AND roster_info.ac_year = '$global_ac_year'
                                                            AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                          
                   GROUP BY ESEV.schl_id,SAS.school_name,ESEV.sanstha_code,
                            SBI.sanstha_name,ESEV.eos_medium_id,SM.medinstr_desc,
                            ESEV.eos_desg_cd,TPM.post_desc,ESEV.eos_subject_cd,
                            subject_code_text,ESEV.eos_no_of_post,ESEV.eos_type,
                            ESEV.shifted_tchr_cnt,SV.vilname
                   HAVING (ESEV.eos_no_of_post - ESEV.shifted_tchr_cnt) > 0   
                    ORDER BY SAS.school_name "; //AND  ESEV.eos_subject_cd $subject_select_cond 
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateNoVacanctCntRound5($eo_code, $new_sanstha_id, $new_schl_id, $eos_medium_id_old, $eos_desg_cd_old, $eos_subject_cd, $eos_no_of_post, $eos_desg_cd_selected) {

        $global_ac_year = Configure::read('global_ac_year');
        try {
            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt +1 
                WHERE   dist_code = '" . $dist_id_old . "'
                   AND  schl_type = '" . $sch_type_old . "'
                   AND  eo_code = '" . $eo_code . "'
                   AND  sanstha_code = '" . $new_sanstha_id . "'
                   AND  schl_id = '" . $new_schl_id . "' 
                   AND  eos_medium_id = '" . $eos_medium_id_old . "'
                   AND  eos_desg_cd = $eos_desg_cd_selected
                   AND  eos_type = '2' 
                   AND  ac_year = '$global_ac_year'
                   AND  eos_subject_cd = '" . $eos_subject_cd . "' 
                 
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateNoExcessCntRound5($eo_code, $old_sanstha_id, $old_schl_id, $eos_medium_id_old, $eos_desg_cd_old, $eos_subject_cd, $eos_no_of_post, $eos_desg_cd_selected) {

        $global_ac_year = Configure::read('global_ac_year');
        try {
            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt - 1  
                WHERE  dist_code = '" . $dist_id_old . "'
                   AND schl_type = '" . $sch_type_old . "'
                   AND eo_code = '" . $eo_code . "'
                   AND sanstha_code = '" . $old_sanstha_id . "'
                   AND schl_id = '" . $old_schl_id . "' 
                   AND eos_medium_id = '" . $eos_medium_id_old . "'
                   AND eos_desg_cd = $eos_desg_cd_old
                   AND eos_type = '1' 
                   AND ac_year = '$global_ac_year'
                   AND eos_subject_cd = '" . $eos_subject_cd . "' 
                 
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    //ROUND 5 END
    //ROUND 6 START
    public function getSamaMediumExcessMediumRound6($eo_code) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT distinct(sm.eos_medium_id),medinstr_desc
                    FROM pavitra.smj_excesstch_det sm
                        LEFT JOIN master.shala_medinstr mi on sm.eos_medium_id=mi.medinstr_id
                        LEFT JOIN pavitra.sanstha_basic_info bi on sm.sanstha_code=bi.sanstha_code  AND bi.minority_sanstha IN $minority_type_cond
                    WHERE  sm.schl_id like '$dist_id%'
                        AND sch_type='$sch_type'
                        AND sm.asst_flag ='A'
                        AND stg_flg5 = 'W'
                        AND sm.ac_year = '$global_ac_year'
                    ORDER BY medinstr_desc"; //AND asst_flag ='A'
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function checkRound5OverExVac($eo_code, $option_medium_type) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');


        $query = "SELECT count(*)  FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                  WHERE   eo_code = '" . $eo_code . "'   
                       AND ESEV.schl_type = '" . $sch_type . "' 
                       AND ESEV.eos_medium_id = '" . $option_medium_type . "'   
                       AND ESEV.asst_flag not in ('A')   
                       AND ESEV.ac_year = '$global_ac_year'
                       AND ESEV.minority_sanstha IN $minority_type_cond"; //AND asst_flag ='A'
//        echo $query;
//        exit();

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function checkRound5Over($eo_code, $option_medium_type) {
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT count(*) FROM pavitra.smj_excesstch_det
                LEFT JOIN pavitra.sanstha_basic_info ON smj_excesstch_det.sanstha_code = sanstha_basic_info.sanstha_code AND sanstha_basic_info.minority_sanstha   in $minority_type_cond
             WHERE              
                         substr(schl_id,1,4) = '" . $dist_id . "'                       
                    AND sch_type = '" . $sch_type . "'  
                    AND eos_medium_id = '" . $option_medium_type . "'
                AND smj_excesstch_det.ac_year = '$global_ac_year'
                    AND asst_flag   in ('A')   
                    AND minority_sanstha   in $minority_type_cond  
                    AND stg_flg5 not in ('S','W')        
                    AND stg_flg1 != 'S'         
                    AND stg_flg2 != 'S'
		     AND stg_flg3 != 'S'
		      AND stg_flg4 != 'S'
                    AND tch_ex_id 
                        IN (SELECT  tch_ex_id 
                                FROM pavitra.smj_excesstch_det sm,pavitra.sanstha_basic_info bi,master.tchr_post_master  
                                WHERE   sch_type ='" . $sch_type . "'
                                    AND schl_id like '" . $dist_id . "%'
                                    AND eos_medium_id = '" . $option_medium_type . "'
                                    AND bi.sanstha_code=sm.sanstha_code 
                                    AND bi.minority_sanstha   in  $minority_type_cond
                                    AND bi.ac_year = '$global_ac_year'
                                    AND sm.sanstha_code 
                             IN 
                                (SELECT sanstha_code 
                                    FROM pavitra.pv_eo_sanstha_ex_vac
                                    WHERE eo_code='" . $eo_code . "'
                                     AND ac_year = '$global_ac_year'
                                     AND minority_sanstha   in $minority_type_cond
                                  )
                            AND  eos_medium_id = '" . $option_medium_type . "'
                            AND sm.asst_flag   in ('A')  
                            AND post_type=1
                       AND post_id=tchr_curr_desg_cd   
                            )"; //AND asst_flag ='A'
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaBlockInfoRound6($eo_code, $option_medium_type, $tchr_curr_desg_cd, $tc_categ, $ts_subject_tot1, $ts_subject_tot2, $eos_tchr_gender) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($eos_tchr_gender == '1') { //M
            $tchr_gender_cond = " ('1','3')";
        } else if ($sch_type == '2') { //F
            $tchr_gender_cond = " ('2','3')";
        } else if ($sch_type == '3') { //F
            $tchr_gender_cond = " ('1','2','3')";
        }

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
//        $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot) > 0'; //   $col_cond = 'gen_smj_tot';
//        }
//        else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot) > 0';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot) > 0';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot) > 0';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot) > 0';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot) > 0';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot) > 0';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot) > 0';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot) > 0';
//        }

        $col_cond = '((gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0) OR (sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) > 0) OR (st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) > 0) OR (obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) > 0) OR (vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) > 0) OR (sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) > 0) OR (ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) > 0) OR (ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot +ntc_ext_tot) > 0) OR (ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) > 0))';


        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;

        $subject_select_cond = '';

//        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
//            $subject_select_cond = "  IN ($ts_subject_tot1) ";
//        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
//            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
//        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
//            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
//        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
//            $subject_select_cond = "  IN ($ts_subject_tot1) ";
//        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
//            $subject_select_cond = "  IN ($ts_subject_tot1) ";
//        } else {
//            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
//        }


        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3 || $ts_subject_tot1 == 5) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 || $ts_subject_tot1 == 4) {
            $subject_select_cond = "  IN (1,4) ";
        }



        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";

        $query = "SELECT DISTINCT(blkcd), blkname 
                  FROM shala_live.shala_block
                  WHERE blkcd IN
                            (SELECT substr(ESEV.schl_id,1,6) as block_code 
                              FROM 
                                        pavitra.pv_eo_sanstha_ex_vac as ESEV
                              LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                              LEFT JOIN shala.shala_basic_infoall SBIA ON SBIA.schcd = SAS.schcd AND SBIA.school_type IN  $tchr_gender_cond
                              LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond
                              WHERE
                                         ESEV.eo_code = '" . $eo_code . "'
                                    AND  ESEV.eos_medium_id = '" . $option_medium_type . "'
                                    AND  $tchr_curr_desg_cd_cond
                                    AND  ESEV.minority_sanstha in $minority_type_cond 
                                    AND  ESEV.eos_subject_cd IN ($ts_subject_tot2)
                                    AND  ESEV.eos_type = '2'
                                    AND  ESEV.asst_flag = 'A'
                                    AND ESEV.ac_year = '$global_ac_year'
                                    AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                    AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE $col_cond  
                                                        AND  roster_info.asst_flag = 'V'
                                                        AND roster_info.ac_year = '$global_ac_year'
                                                        AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                            )
                 ORDER BY blkname"; // AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaSansthaInfoRound6($eo_code, $option_medium_type, $tchr_curr_desg_cd, $tc_categ, $ts_subject_tot1, $ts_subject_tot2, $eos_tchr_gender) {

        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($eos_tchr_gender == '1') { //M
            $tchr_gender_cond = " ('1','3')";
        } else if ($sch_type == '2') { //F
            $tchr_gender_cond = " ('2','3')";
        } else if ($sch_type == '3') { //F
            $tchr_gender_cond = " ('1','2','3')";
        }

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
//        $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot) > 0'; //   $col_cond = 'gen_smj_tot';
//        } else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot) > 0';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot) > 0';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot) > 0';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot) > 0';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot) > 0';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot) > 0';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot) > 0';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot) > 0';
//        }

        $col_cond = '((gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0) OR (sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) > 0) OR (st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) > 0) OR (obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) > 0) OR (vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) > 0) OR (sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) > 0) OR (ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) > 0) OR (ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) > 0) OR (ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) > 0))';

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;

        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }


        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";


        $query = " SELECT ESEV.sanstha_code ,SBI.sanstha_name
                              FROM 
                                        pavitra.pv_eo_sanstha_ex_vac as ESEV
                              LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                              LEFT JOIN shala.shala_basic_infoall SBIA ON SBIA.schcd = SAS.schcd AND SBIA.school_type IN  $tchr_gender_cond
                              LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond

                              WHERE
                                         ESEV.eo_code = '" . $eo_code . "'
                                    AND  ESEV.eos_medium_id = '" . $option_medium_type . "'
                                     AND  $tchr_curr_desg_cd_cond
                                    AND  ESEV.minority_sanstha   in  $minority_type_cond
                                    AND  ESEV.eos_subject_cd IN ($ts_subject_tot2)
                                    AND  ESEV.eos_type = '2'
                                     AND  ESEV.asst_flag = 'A'
                                     AND ESEV.ac_year = '$global_ac_year'
                                     AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                    AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE   $col_cond  
                                                        AND  roster_info.asst_flag = 'V'
                                                        AND roster_info.ac_year = '$global_ac_year'
                                                        AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                             ORDER BY SBI.sanstha_name"; //  AND  ESEV.eos_subject_cd $subject_select_cond
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaVacancySchInfoRound6($eo_code, $option_medium_type, $tchr_curr_desg_cd, $vacancy_block_info, $ts_subject_tot1, $ts_subject_tot2, $tc_categ, $array_vacancy_sanstha_info) {

        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        if ($vacancy_block_info != '' && $array_vacancy_sanstha_info == '') {
            $search_cond = " AND  ESEV.schl_id LIKE '" . $vacancy_block_info . "%'";
        } else if ($vacancy_block_info == '' && $array_vacancy_sanstha_info != '') {
            $search_cond = " AND  ESEV.sanstha_code LIKE '" . $array_vacancy_sanstha_info . "%' ";
        } else if ($vacancy_block_info != '' && $array_vacancy_sanstha_info != '') {
            $search_cond = "  AND  ESEV.schl_id LIKE '" . $vacancy_block_info . "%' 
                                 AND  ESEV.sanstha_code LIKE '" . $array_vacancy_sanstha_info . "%' ";
        }

        if ($ts_subject_tot2 == '')
            $ts_subject_tot2 = 0;
        $subject_select_cond = '';

        if ($ts_subject_tot1 == 2 || $ts_subject_tot1 == 3) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if ($ts_subject_tot1 == 1 && $ts_subject_tot2 == 4) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if ($ts_subject_tot1 == 4 && $ts_subject_tot2 == 1) {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 2)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else if (($ts_subject_tot1 == 1 && $ts_subject_tot1 == 4) && ($ts_subject_tot2 == 3)) {
            $subject_select_cond = "  IN ($ts_subject_tot1) ";
        } else {
            $subject_select_cond = "  IN ($ts_subject_tot1,$ts_subject_tot2) ";
        }


        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
//        $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot) > 0'; //   $col_cond = 'gen_smj_tot';
//        } else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot) > 0';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot) > 0';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot) > 0';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot) > 0';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot) > 0';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot) > 0';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot) > 0';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot) > 0';
//        }


        $col_cond = '((gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) > 0) OR (sc_sanc_tot -(sc_work_tot + sc_smj_tot +sc_ext_tot) > 0) OR (st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) > 0) OR (obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) > 0) OR (vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) > 0) OR (sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) > 0) OR (ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) > 0) OR (ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) > 0) OR (ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) > 0))';

        if ($tchr_curr_desg_cd == '4')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('4','5')";
        else if ($tchr_curr_desg_cd == '5')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('5')";
        else if ($tchr_curr_desg_cd == '7')
            $tchr_curr_desg_cd_cond = "ESEV.eos_desg_cd IN ('7')";


        $query = "SELECT ESEV.schl_id,
                         SAS.school_name,
                         SV.vilname,
                         ESEV.sanstha_code,
                         SBI.sanstha_name,
                         ESEV.eos_medium_id,
                         SM.medinstr_desc, 
			 ESEV.eos_desg_cd,
                         TPM.post_desc,
                         ESEV.eos_subject_cd,
                         sis.subject_group_desc as subject_code_text,
                         (ESEV.eos_no_of_post-ESEV.shifted_tchr_cnt) as eos_no_of_post,
                         ESEV. eos_type  
                    FROM 
                              pavitra.pv_eo_sanstha_ex_vac as ESEV
                    LEFT JOIN shala.shala_all_school SAS ON ESEV.schl_id = SAS.schcd 
                    LEFT JOIN pavitra.sanstha_basic_info as SBI ON  SBI.sanstha_code = ESEV.sanstha_code AND SBI.minority_sanstha   in $minority_type_cond
		    LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id 
                    LEFT JOIN master.tchr_post_master TPM ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type='1'
                    LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                    INNER JOIN shala.shala_area SA ON ESEV.schl_id = SA.schcd 
		    INNER JOIN shala.shala_village SV ON SV.vilcd = SA.vilcd 
                    WHERE
                                 ESEV.eo_code = '" . $eo_code . "' 
                            AND  ESEV.eos_medium_id = '" . $option_medium_type . "' 
                            AND  $tchr_curr_desg_cd_cond
                            AND  ESEV.minority_sanstha   IN $minority_type_cond
                            AND  ESEV.eos_subject_cd IN ($ts_subject_tot2)
                            AND  ESEV.eos_type = '2'
                            AND  ESEV.asst_flag = 'A'
                            AND  ESEV.ac_year = '$global_ac_year'
                            AND  ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                 $search_cond
                            AND ESEV.sanstha_code 
                                            IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                    WHERE  $col_cond 
                                                    AND roster_info.asst_flag = 'V'
                                                    AND roster_info.ac_year = '$global_ac_year'
                                                    AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
				                )
                          
                   GROUP BY ESEV.schl_id,SAS.school_name,ESEV.sanstha_code,
                            SBI.sanstha_name,ESEV.eos_medium_id,SM.medinstr_desc,
                            ESEV.eos_desg_cd,TPM.post_desc,ESEV.eos_subject_cd,
                            subject_code_text,ESEV.eos_no_of_post,ESEV.eos_type,
                            ESEV.shifted_tchr_cnt,SV.vilname
                   HAVING (ESEV.eos_no_of_post - ESEV.shifted_tchr_cnt) > 0   
                    ORDER BY SAS.school_name "; //AND  ESEV.eos_subject_cd $subject_select_cond 
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateNoVacanctCntRound6($eo_code, $new_sanstha_id, $new_schl_id, $eos_medium_id_old, $eos_desg_cd_old, $eos_subject_cd, $eos_no_of_post, $eos_desg_cd_selected) {

        $global_ac_year = Configure::read('global_ac_year');
        try {
            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt +1 
                WHERE   dist_code = '" . $dist_id_old . "'
                   AND  schl_type = '" . $sch_type_old . "'
                   AND  eo_code = '" . $eo_code . "'
                   AND  sanstha_code = '" . $new_sanstha_id . "'
                   AND  schl_id = '" . $new_schl_id . "' 
                   AND  eos_medium_id = '" . $eos_medium_id_old . "'
                   AND  eos_desg_cd = $eos_desg_cd_selected
                   AND  eos_type = '2' 
                   AND  ac_year = '$global_ac_year'
                   AND  eos_subject_cd = '" . $eos_subject_cd . "' 
                 
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateNoExcessCntRound6($eo_code, $old_sanstha_id, $old_schl_id, $eos_medium_id_old, $eos_desg_cd_old, $eos_subject_cd, $eos_no_of_post, $eos_desg_cd_selected) {

        $global_ac_year = Configure::read('global_ac_year');
        try {
            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt - 1  
                WHERE   dist_code = '" . $dist_id_old . "'
                   AND  schl_type = '" . $sch_type_old . "'
                   AND  eo_code = '" . $eo_code . "'
                   AND  sanstha_code = '" . $old_sanstha_id . "'
                   AND  schl_id = '" . $old_schl_id . "' 
                   AND  eos_medium_id = '" . $eos_medium_id_old . "'
                   AND  eos_desg_cd = $eos_desg_cd_old
                   AND  eos_type = '1' 
                   AND  ac_year = '$global_ac_year'
                   AND  eos_subject_cd = '" . $eos_subject_cd . "' 
                 
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

//ROUND 6 END
    public function sansthaunverif($dist_cd, $schl_type, $eos_type) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }

            if ($eos_type == 1) {

                $query = "SELECT DISTINCT (ESEV.sanstha_code)  ,TPM.sanstha_name 
			FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			LEFT JOIN pavitra.sanstha_basic_info as TPM
                         ON ESEV.sanstha_code = TPM.sanstha_code 
                        LEFT JOIN shala.shala_all_school as SAS
                         ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition

                       LEFT JOIN  pavitra.smj_excesstch_det as SED
                         ON SED.sanstha_code =  ESEV.sanstha_code  AND SED.tchr_curr_desg_cd = ESEV.eos_desg_cd AND SED.ac_year = ESEV.ac_year
                         
		WHERE    ESEV.schl_id LIKE '" . $dist_cd . "%' 
                         AND     ESEV.eos_type = '" . $eos_type . "'
                              AND   ESEV.schl_type = '" . $schl_type . "'
		        AND  (ESEV.asst_flag ='V')
                        AND   (SED.asst_flag ='V')
                         AND ESEV.ac_year = '$global_ac_year'
                              AND SED.ac_year = '$global_ac_year'
                        ORDER BY TPM.sanstha_name
                         ";
            } else if ($eos_type == 2) {
                $query = "SELECT DISTINCT (ESEV.sanstha_code)  ,TPM.sanstha_name 
			FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
			LEFT JOIN pavitra.sanstha_basic_info as TPM
                         ON ESEV.sanstha_code = TPM.sanstha_code
                        LEFT JOIN shala.shala_all_school as SAS
                         ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition
		WHERE   ESEV.schl_id LIKE '" . $dist_cd . "%' 
                         AND   ESEV.schl_type = '" . $schl_type . "'
                         AND ESEV.eos_type = '" . $eos_type . "'
                              AND ESEV.ac_year = '$global_ac_year'
		        AND  (ESEV.asst_flag ='V')
                        order by TPM.sanstha_name 
                       ";
            }

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

    public function selectDesigUnVerif($sanstha_code, $dist_cd, $schl_type, $eos_type) {
        $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }

            if ($eos_type == 1) {
                $query = "SELECT DISTINCT (ESEV.eos_desg_cd)  ,TPM.post_desc 
                            FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                            LEFT JOIN master.tchr_post_master as TPM
                            ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                            LEFT JOIN shala.shala_all_school as SAS
                            ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition
                            LEFT JOIN  pavitra.smj_excesstch_det as SED
                            ON SED.sanstha_code =  ESEV.sanstha_code  AND SED.tchr_curr_desg_cd = ESEV.eos_desg_cd AND SED.ac_year = ESEV.ac_year
                            WHERE ESEV.sanstha_code='" . $sanstha_code . "'
                            AND ESEV.schl_id LIKE '" . $dist_cd . "%' 
                            AND ESEV.eos_type = '" . $eos_type . "'
                            AND ESEV.schl_type = '" . $schl_type . "'
                                   AND ESEV.ac_year = '$global_ac_year'
                                       AND SED.ac_year = '$global_ac_year'
                            AND (ESEV.asst_flag ='V')
                            AND (SED.asst_flag ='V')";
            } else if ($eos_type == 2) {
                $query = "SELECT DISTINCT (ESEV.eos_desg_cd)  ,TPM.post_desc 
                          FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                          LEFT JOIN master.tchr_post_master as TPM
                          ON ESEV.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                          LEFT JOIN shala.shala_all_school as SAS
                          ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition
                          WHERE ESEV.sanstha_code='" . $sanstha_code . "'
                          AND ESEV.schl_type = '" . $schl_type . "'
			  AND ESEV.schl_id LIKE '" . $dist_cd . "%' 
                          AND ESEV.eos_type = '" . $eos_type . "'
                              AND ESEV.ac_year = '$global_ac_year'
		          AND (ESEV.asst_flag ='V')";
            }



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

    public function ex_vac_schl_detailreturn($sanstha_code, $dist_cd, $schl_type, $eos_type, $desig_cd, $med_cd) {

        $global_ac_year = Configure::read('global_ac_year');
        try {
            if ($schl_type == 01) {
                $schl_type_condition = 'highest_class <= 8';
            } else if ($schl_type == 02) {
                $schl_type_condition = 'highest_class  > 8';
            }

            $query = "SELECT 
                            ESEV.schl_id,
                            SAS.school_name ,
                            ESEV.eos_desg_cd,
                            TPM.post_desc ,
                            ESEV.eos_medium_id,
                            SM.medinstr_desc ,
                            ESEV.eos_subject_cd,
                            sis.subject_group_desc as subject_desc,
                            ESEV.eos_type,
                            ESEV.dist_code,
                            ESEV.schl_type,
                            ESEV.eo_code,
                            ESEV.sanstha_code,
                            ESEV.eos_online_posts,
                            ESEV.eos_offline_posts,
                            ESEV.eos_no_of_post
                    FROM pavitra.pv_eo_sanstha_ex_vac as ESEV
                            LEFT JOIN master.tchr_post_master as TPM ON ESEV.eos_desg_cd = TPM.post_id  AND TPM.post_type=1 AND  ESEV.eos_desg_cd =  $desig_cd
                            LEFT JOIN master.shala_medinstr as SM ON ESEV.eos_medium_id = SM.medinstr_id 
                             LEFT JOIN master.tchr_apt_subject  as sis ON ESEV.eos_subject_cd = CAST (sis.subject_group_id as numeric)
                            LEFT JOIN shala.shala_all_school as SAS ON ESEV.schl_id = SAS.schcd AND SAS.$schl_type_condition
		  WHERE     ESEV.sanstha_code='" . $sanstha_code . "'
			AND ESEV.schl_id LIKE '" . $dist_cd . "%' 
                        AND ESEV.schl_id  = SAS.schcd
                        AND ESEV.eos_type = '" . $eos_type . "'
                        AND ESEV.eos_desg_cd =  $desig_cd
                        AND ESEV.eos_medium_id='" . $med_cd . "'
                        AND ESEV.ac_year = '$global_ac_year'
		        AND (ESEV.asst_flag ='V')
                         ";

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

    /* DYD */

    public function getSamaMediumExcessMediumDydRoundPrimary($option_district_cd_name) {

        $global_ac_year = Configure::read('global_ac_year');
        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT distinct(sm.eos_medium_id),medinstr_desc
                    FROM pavitra.smj_excesstch_det sm
                   LEFT JOIN master.shala_medinstr mi ON sm.eos_medium_id=mi.medinstr_id
                   LEFT JOIN pavitra.sanstha_basic_info bi on sm.sanstha_code=bi.sanstha_code AND bi.minority_sanstha   in  $minority_type_cond
                   WHERE  sm.schl_id like '$option_district_cd_name%'
                   AND sm.sch_type='01'
                   AND sm.asst_flag ='A' 
                   AND sm.ac_year = '$global_ac_year'
                   AND sm.eos_medium_id  NOT IN
                   (select distinct eos_medium_id from pavitra.smj_excesstch_det_dyd as  smdyd 
                    where  smdyd.schl_id like '$option_district_cd_name%' AND smdyd.ac_year = '$global_ac_year' AND smdyd.sch_type='01')
                   ORDER BY medinstr_desc";
//        echo "".$query;
//        exit();


        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSamaMediumExcessMediumDydRoundSecondary($option_district_cd_name) {
        $global_ac_year = Configure::read('global_ac_year');
        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT distinct(sm.eos_medium_id),medinstr_desc
                    FROM pavitra.smj_excesstch_det sm
                   LEFT JOIN master.shala_medinstr mi ON sm.eos_medium_id=mi.medinstr_id
                   LEFT JOIN pavitra.sanstha_basic_info bi on sm.sanstha_code=bi.sanstha_code AND bi.minority_sanstha   in  $minority_type_cond
                   WHERE  sm.schl_id like '$option_district_cd_name%'
                   AND sm.sch_type='02'
                   AND sm.asst_flag ='A' 
                   AND sm.ac_year = '$global_ac_year'
                   AND sm.eos_medium_id  
                             NOT IN (select distinct eos_medium_id 
                                from pavitra.smj_excesstch_det_dyd as  smdyd  
                                    where  smdyd.schl_id like '$option_district_cd_name%' AND smdyd.ac_year = '$global_ac_year' AND smdyd.sch_type='02')
                   ORDER BY medinstr_desc";
//        echo "".$query;
//        exit();


        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getExcessTchrListDydRoundPrimary($option_district_cd_name, $option_medium_cd_name) {
        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT distinct(sm.eos_medium_id),medinstr_desc
                    FROM pavitra.smj_excesstch_det sm
                   LEFT JOIN master.shala_medinstr mi ON sm.eos_medium_id=mi.medinstr_id
                   LEFT JOIN pavitra.sanstha_basic_info bi on sm.sanstha_code=bi.sanstha_code 
                    AND sm.ac_year = '$global_ac_year'
                        AND bi.minority_sanstha   in $minority_type_cond
                   ORDER BY medinstr_desc";

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function insert_sanstha_ex_vac_excesstch_det($district_cd, $medium_cd) {
        $eo_code = $district_cd . "EO01";
        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query_vac = "INSERT INTO pavitra.pv_eo_sanstha_ex_vac_dyd
                                ( sanstha_code , dist_code , schl_type , eo_code , schl_id , eos_medium_id , eos_desg_cd ,
                                eos_sm_posts , eos_proposed_posts , eos_online_posts , eos_offline_posts , eos_type , eos_sub_cal_post ,
                                eos_subject_cd , eos_no_of_post , asst_flag  , minority_sanstha ,
                                shifted_tchr_cnt,ac_year )
                                (SELECT sanstha_code , dist_code , schl_type , eo_code , schl_id , eos_medium_id , eos_desg_cd ,
                                eos_sm_posts , eos_proposed_posts , eos_online_posts , eos_offline_posts , eos_type , eos_sub_cal_post ,
                                eos_subject_cd , eos_no_of_post - shifted_tchr_cnt as eos_no_of_post , 'V' as asst_flag ,  minority_sanstha ,
                                shifted_tchr_cnt,ac_year FROM pavitra.pv_eo_sanstha_ex_vac 
                                where eo_code='$eo_code' and eos_medium_id ='$medium_cd' and minority_sanstha='1' and eos_type='2' AND asst_flag='A' AND ac_year = '$global_ac_year')  ";

//        echo "\n" . $query_vac;
        $result_vac = $this->query($query_vac);

        $query_excess = "INSERT INTO pavitra.pv_eo_sanstha_ex_vac_dyd( sanstha_code , dist_code , schl_type , eo_code , schl_id ,
                                    eos_medium_id , eos_desg_cd , eos_sm_posts , eos_proposed_posts , eos_online_posts , eos_offline_posts ,
                                    eos_type , eos_sub_cal_post , eos_subject_cd , eos_no_of_post , asst_flag , minority_sanstha , shifted_tchr_cnt ,ac_year ) 
                                    (SELECT esev.sanstha_code ,esev.dist_code,esev.schl_type,esev.eo_code,esev.schl_id, esev.eos_medium_id,esev.eos_desg_cd,
                                    esev.eos_sm_posts,esev.eos_proposed_posts,(esev.eos_online_posts + count(sed.tch_ex_id) ) as eos_online_posts ,
                                    0 as eos_offline_posts,esev.eos_type,esev.eos_sub_cal_post , esev.eos_subject_cd , esev.eos_no_of_post, 
                                    'V' as asst_flag,esev.minority_sanstha,0 as shifted_tchr_cnt,esev.ac_year
                                    FROM pavitra.pv_eo_sanstha_ex_vac as esev
                                    LEFT JOIN pavitra.smj_excesstch_det as sed ON esev.sanstha_code = sed.sanstha_code  AND   esev.ac_year = sed.ac_year 
                                    AND esev.schl_type = sed.sch_type AND esev.schl_id = sed.schl_id AND esev.eos_medium_id = sed.eos_medium_id
                                    AND esev.eos_desg_cd = sed.tchr_curr_desg_cd AND esev.dist_code = substr(sed.schl_id,1,4) 
                                    AND substr(esev.eo_code,7,8) = sed.sch_type and sed.stg_flg3='W' where esev.eo_code='$eo_code'
                                    and esev.eos_medium_id ='$medium_cd' and esev.minority_sanstha='1' and esev.eos_type='1' AND esev.ac_year = '$global_ac_year' AND sed.ac_year = '$global_ac_year' and  esev.asst_flag='A'
                                    GROUP BY esev.sanstha_code,esev.dist_code,esev.schl_type,esev.eo_code ,esev.schl_id,esev.eos_medium_id,esev.eos_desg_cd,
                                    esev.eos_sm_posts,esev.eos_proposed_posts,esev.eos_online_posts,esev.eos_offline_posts,esev.eos_type,
                                    esev.eos_sub_cal_post,esev.eos_subject_cd,esev.eos_no_of_post,esev.minority_sanstha) ";
//        echo "\n" . $query_excess;

        $result_excess = $this->query($query_excess);

        $query_staff_info = " INSERT INTO pavitra.smj_excesstch_det_dyd(  
                        tch_ex_id, sanstha_code, tchr_id, tchr_fname, tchr_mname, tchr_lname, 
                        schl_id, schl_name, tchr_gender, tchr_birth_dt, tchr_serv_entry_dt, 
                        tchr_edu_entry_dt, tchr_curr_desg_cd, tchr_curr_desig_dt, tc_categ, 
                        tc_categ_desc, tin_recruit_categ, tq_aqual_lvl, tq_adegree, tq_adegname, 
                        tq_amaj_sub, tq_pqual_lvl, tq_pdegree, tq_pdegname, tq_pmaj_methd, 
                        tq_pmin_methd, ts_subject_tot1, ts_subject_tot2, ts_subject_tot3, 
                        ts_subject_tot4, ts_subjectdesc_tot1, ts_subjectdesc_tot2, ts_subjectdesc_tot3, 
                        ts_subjectdesc_tot4, asst_flag,  sch_type, eos_medium_id,ac_year 
                        )
                        (SELECT sm.tch_ex_id,sm.sanstha_code, sm.tchr_id, sm.tchr_fname, sm.tchr_mname, sm.tchr_lname, 
                        sm.schl_id, sm.schl_name, sm.tchr_gender, sm.tchr_birth_dt, sm.tchr_serv_entry_dt, 
                        sm.tchr_edu_entry_dt, sm.tchr_curr_desg_cd, sm.tchr_curr_desig_dt, sm.tc_categ, 
                        sm.tc_categ_desc, sm.tin_recruit_categ, sm.tq_aqual_lvl, sm.tq_adegree, sm.tq_adegname, 
                        sm.tq_amaj_sub, sm.tq_pqual_lvl, sm.tq_pdegree, sm.tq_pdegname, sm.tq_pmaj_methd, 
                        sm.tq_pmin_methd, sm.ts_subject_tot1, sm.ts_subject_tot2, sm.ts_subject_tot3, 
                        sm.ts_subject_tot4, sm.ts_subjectdesc_tot1, sm.ts_subjectdesc_tot2, sm.ts_subjectdesc_tot3, 
                        sm.ts_subjectdesc_tot4, 'V' as asst_flag ,sm.sch_type, sm.eos_medium_id,sm.ac_year
                        FROM pavitra.smj_excesstch_det as sm,pavitra.sanstha_basic_info bi
                        where bi.sanstha_code=sm.sanstha_code  AND bi.sanstha_code   in  $minority_type_cond
                        AND  schl_id like '$district_cd%' AND   
                        sch_type='01' AND  sm.asst_flag = 'A' AND   eos_medium_id='$medium_cd'  AND sm.ac_year = '$global_ac_year' AND stg_flg3='W' )
                ";
//        echo "\n" . $query_staff_info;
//        exit();

        $result_staff_info = $this->query($query_staff_info);

        if ($result_staff_info <> NULL)
            return $result_staff_info;
        else {
            return 0;
        }
    }

    public function insert_sanstha_ex_vac_excesstch_det_secondary($district_cd, $medium_cd) {
        $global_ac_year = Configure::read('global_ac_year');

        $eo_code = $district_cd . "EO02";

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query_vac = "INSERT INTO pavitra.pv_eo_sanstha_ex_vac_dyd
                                ( sanstha_code , dist_code , schl_type , eo_code , schl_id , eos_medium_id , eos_desg_cd ,
                                eos_sm_posts , eos_proposed_posts , eos_online_posts , eos_offline_posts , eos_type , eos_sub_cal_post ,
                                eos_subject_cd , eos_no_of_post , asst_flag  , minority_sanstha ,
                                shifted_tchr_cnt,ac_year )
                                (SELECT sanstha_code , dist_code , schl_type , eo_code , schl_id , eos_medium_id , eos_desg_cd ,
                                eos_sm_posts , eos_proposed_posts , eos_online_posts , eos_offline_posts , eos_type , eos_sub_cal_post ,
                                eos_subject_cd , eos_no_of_post - shifted_tchr_cnt as eos_no_of_post , 'V' as asst_flag ,  minority_sanstha ,
                                shifted_tchr_cnt,ac_year FROM pavitra.pv_eo_sanstha_ex_vac 
                                where eo_code='$eo_code' and eos_medium_id ='$medium_cd' and minority_sanstha='1' and eos_type='2'   AND ac_year = '$global_ac_year' AND asst_flag='A')  ";

//        echo "\n" . $query_vac;
        $result_vac = $this->query($query_vac);

        $query_excess = "INSERT INTO pavitra.pv_eo_sanstha_ex_vac_dyd( sanstha_code , dist_code , schl_type , eo_code , schl_id ,
                                    eos_medium_id , eos_desg_cd , eos_sm_posts , eos_proposed_posts , eos_online_posts , eos_offline_posts ,
                                    eos_type , eos_sub_cal_post , eos_subject_cd , eos_no_of_post , asst_flag , minority_sanstha , shifted_tchr_cnt ,ac_year) 
                                    (SELECT esev.sanstha_code ,esev.dist_code,esev.schl_type,esev.eo_code,esev.schl_id, esev.eos_medium_id,esev.eos_desg_cd,
                                    esev.eos_sm_posts,esev.eos_proposed_posts,(esev.eos_online_posts + count(sed.tch_ex_id) ) as eos_online_posts ,
                                    0 as eos_offline_posts,esev.eos_type,esev.eos_sub_cal_post , esev.eos_subject_cd , esev.eos_no_of_post, 
                                    'V' as asst_flag,esev.minority_sanstha,0 as shifted_tchr_cnt,esev.ac_year
                                    FROM pavitra.pv_eo_sanstha_ex_vac as esev
                                    LEFT JOIN pavitra.smj_excesstch_det as sed ON esev.sanstha_code = sed.sanstha_code   AND  esev.ac_year = sed.ac_year
                                    AND esev.schl_type = sed.sch_type AND esev.schl_id = sed.schl_id AND esev.eos_medium_id = sed.eos_medium_id
                                    AND esev.eos_desg_cd = sed.tchr_curr_desg_cd AND esev.dist_code = substr(sed.schl_id,1,4) 
                                    AND substr(esev.eo_code,7,8) = sed.sch_type and sed.stg_flg3='W' where esev.eo_code='$eo_code'
                                    and esev.eos_medium_id ='$medium_cd' and esev.minority_sanstha='1' and esev.eos_type='1'   AND esev.ac_year = '$global_ac_year'  AND sed.ac_year = '$global_ac_year'and  esev.asst_flag='A'
                                    GROUP BY esev.sanstha_code,esev.dist_code,esev.schl_type,esev.eo_code ,esev.schl_id,esev.eos_medium_id,esev.eos_desg_cd,
                                    esev.eos_sm_posts,esev.eos_proposed_posts,esev.eos_online_posts,esev.eos_offline_posts,esev.eos_type,
                                    esev.eos_sub_cal_post,esev.eos_subject_cd,esev.eos_no_of_post,esev.minority_sanstha) ";
//        echo "\n" . $query_excess;

        $result_excess = $this->query($query_excess);

        $query_staff_info = " INSERT INTO pavitra.smj_excesstch_det_dyd(  
                        tch_ex_id, sanstha_code, tchr_id, tchr_fname, tchr_mname, tchr_lname, 
                        schl_id, schl_name, tchr_gender, tchr_birth_dt, tchr_serv_entry_dt, 
                        tchr_edu_entry_dt, tchr_curr_desg_cd, tchr_curr_desig_dt, tc_categ, 
                        tc_categ_desc, tin_recruit_categ, tq_aqual_lvl, tq_adegree, tq_adegname, 
                        tq_amaj_sub, tq_pqual_lvl, tq_pdegree, tq_pdegname, tq_pmaj_methd, 
                        tq_pmin_methd, ts_subject_tot1, ts_subject_tot2, ts_subject_tot3, 
                        ts_subject_tot4, ts_subjectdesc_tot1, ts_subjectdesc_tot2, ts_subjectdesc_tot3, 
                        ts_subjectdesc_tot4, asst_flag,  sch_type, eos_medium_id ,ac_year
                        )
                        (SELECT sm.tch_ex_id,sm.sanstha_code, sm.tchr_id, sm.tchr_fname, sm.tchr_mname, sm.tchr_lname, 
                        sm.schl_id, sm.schl_name, sm.tchr_gender, sm.tchr_birth_dt, sm.tchr_serv_entry_dt, 
                        sm.tchr_edu_entry_dt, sm.tchr_curr_desg_cd, sm.tchr_curr_desig_dt, sm.tc_categ, 
                        sm.tc_categ_desc, sm.tin_recruit_categ, sm.tq_aqual_lvl, sm.tq_adegree, sm.tq_adegname, 
                        sm.tq_amaj_sub, sm.tq_pqual_lvl, sm.tq_pdegree, sm.tq_pdegname, sm.tq_pmaj_methd, 
                        sm.tq_pmin_methd, sm.ts_subject_tot1, sm.ts_subject_tot2, sm.ts_subject_tot3, 
                        sm.ts_subject_tot4, sm.ts_subjectdesc_tot1, sm.ts_subjectdesc_tot2, sm.ts_subjectdesc_tot3, 
                        sm.ts_subjectdesc_tot4, 'V' as asst_flag ,sm.sch_type, sm.eos_medium_id ,sm.ac_year
                        FROM pavitra.smj_excesstch_det as sm,pavitra.sanstha_basic_info bi
                        where bi.sanstha_code=sm.sanstha_code  AND bi.sanstha_code   in  $minority_type_cond
                        AND  schl_id like '$district_cd%' AND   
                        sch_type='02' AND  sm.asst_flag = 'A' AND   eos_medium_id='$medium_cd'  AND sm.ac_year = '$global_ac_year' and stg_flg3='W' )
                ";
//        echo "\n" . $query_staff_info;
//        exit();

        $result_staff_info = $this->query($query_staff_info);

        if ($result_staff_info <> NULL)
            return $result_staff_info;
        else {
            return 0;
        }
    }

    /* Revert Samayojan */

    public function checkIncompleteRoundsDistrictRevertSamayojan($option_schl_type) {
        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');


        $query = "SELECT  tmp.distcd,sd.distname
                    FROM
                        (
                        (SELECT DISTINCT(substr(SED.schl_id,1,4))  as distcd
                                 FROM pavitra.smj_excesstch_det as SED , pavitra.sanstha_basic_info as sbi
                                    WHERE      SED.sanstha_code = sbi.sanstha_code 
                                            AND sbi.minority_sanstha   in  $minority_type_cond
                                            AND sch_type='" . $option_schl_type . "' 
                                            AND  SED.asst_flag ='A'   
                                            AND SED.ac_year = '$global_ac_year'
                                            AND (trim(new_sanstha_code) ='' OR   trim(new_sanstha_code) is null )
                        )
                        INTERSECT
                        (SELECT  DISTINCT(substr(SED.schl_id,1,4))  as distcd
                                 FROM pavitra.smj_excesstch_det as SED, pavitra.sanstha_basic_info as sbi
                                    WHERE      SED.sanstha_code = sbi.sanstha_code 
                                        AND sbi.minority_sanstha   in  $minority_type_cond
                                        AND sch_type='" . $option_schl_type . "' 
                                        AND SED.asst_flag ='A'
                                        AND SED.ac_year = '$global_ac_year'
                                        AND (trim(new_sanstha_code) ='' OR   trim(new_sanstha_code) is null )
                                        AND stg_flg1 ='N'  AND stg_flg2 ='N'  AND stg_flg3 ='N'  )

                         )as tmp
                    LEFT JOIN shala_live.shala_district  as sd
                    ON tmp.distcd = sd.distcd 
                    ORDER BY sd.distname"
        ;
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function checkIncompleteRoundsMediumRevertSamayojan($option_schl_type, $dist_cd_revert) {

        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $query = "SELECT  tmp.distcd,tmp.eos_medium_id,md.medinstr_desc
                    FROM
                        (
                        (SELECT  DISTINCT(substr(SED.schl_id,1,4))  as distcd,    eos_medium_id
                                 FROM pavitra.smj_excesstch_det as SED , pavitra.sanstha_basic_info as sbi
                                    WHERE      SED.sanstha_code = sbi.sanstha_code 
                                            AND sbi.minority_sanstha   in  $minority_type_cond
                                            AND sch_type='" . $option_schl_type . "' 
                                            AND (substr(SED.schl_id,1,4))='" . $dist_cd_revert . "' 
                                            AND  SED.asst_flag ='A'   
                                             AND SED.ac_year = '$global_ac_year'
                                           AND (trim(new_sanstha_code) ='' OR   trim(new_sanstha_code) is null )
                        )
                        INTERSECT
                        (SELECT  DISTINCT(substr(SED.schl_id,1,4))  as distcd,    eos_medium_id
                                 FROM pavitra.smj_excesstch_det as SED, pavitra.sanstha_basic_info as sbi
                                    WHERE      SED.sanstha_code = sbi.sanstha_code 
                                        AND sbi.minority_sanstha   in  $minority_type_cond
                                        AND sch_type='" . $option_schl_type . "' 
                                        AND (substr(SED.schl_id,1,4))='" . $dist_cd_revert . "' 
                                        AND SED.asst_flag ='A'
                                         AND SED.ac_year = '$global_ac_year'
                                        AND (trim(new_sanstha_code) ='' OR   trim(new_sanstha_code) is null )
                                        AND stg_flg1 ='N'  AND stg_flg2 ='N'  AND stg_flg3 ='N'  )

                         )as tmp
                    LEFT JOIN master.shala_medinstr md    
                    ON tmp.eos_medium_id = md.medinstr_id 
                    ORDER BY md.medinstr_desc"
        ;
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateRevertSamatyojanSNN($dist_code_old, $sch_type_old, $eo_code_old, $new_sanstha_code_new, $ts_smj_schl_id_new, $eos_medium_id_old, $tchr_curr_desg_cd_old, $ts_subject_tot1_old) {

        $global_ac_year = Configure::read('global_ac_year');
        try {
            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt +1 
                WHERE  dist_code = '" . $dist_code_old . "'
                   AND schl_type = '" . $sch_type_old . "'
                   AND eo_code = '" . $eo_code_old . "'
                   AND sanstha_code = '" . $new_sanstha_code_new . "'
                   AND schl_id = '" . $ts_smj_schl_id_new . "' 
                   AND eos_medium_id = '" . $eos_medium_id_old . "'
                   AND eos_desg_cd = $tchr_curr_desg_cd_old
                   AND eos_type = '2' 
                   AND ac_year = '$global_ac_year'
                   AND eos_subject_cd = '" . $ts_subject_tot1_old . "'   
                  ";
//            echo "" . $query;
//            exit();

            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateRevertSamatyojanWSN($dist_code_old, $sch_type_old, $eo_code_old, $new_sanstha_code_new, $ts_smj_schl_id_new, $eos_medium_id_old, $tchr_curr_desg_cd_old, $ts_subject_tot1_old) {

        $global_ac_year = Configure::read('global_ac_year');
        try {

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt - 1 
                WHERE  dist_code = '" . $dist_code_old . "'
                   AND schl_type = '" . $sch_type_old . "'
                   AND eo_code = '" . $eo_code_old . "'
                   AND sanstha_code = '" . $new_sanstha_code_new . "'
                   AND schl_id = '" . $ts_smj_schl_id_new . "' 
                   AND eos_medium_id = '" . $eos_medium_id_old . "'
                   AND eos_desg_cd = $tchr_curr_desg_cd_old
                   AND eos_type = '2' 
                   AND ac_year = '$global_ac_year'
                   AND eos_subject_cd = '" . $ts_subject_tot1_old . "' 
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateRevertSamatyojanWWS($dist_code_old, $sch_type_old, $eo_code_old, $new_sanstha_code_new, $ts_smj_schl_id_new, $eos_medium_id_old, $tchr_curr_desg_cd_old, $ts_subject_tot1_old) {

        $global_ac_year = Configure::read('global_ac_year');
        try {
            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt - 1 
                WHERE    dist_code = '" . $dist_code_old . "'
                   AND   schl_type = '" . $sch_type_old . "'
                   AND   eo_code = '" . $eo_code_old . "'
                   AND   sanstha_code = '" . $new_sanstha_code_new . "'
                   AND   schl_id = '" . $ts_smj_schl_id_new . "' 
                   AND   eos_medium_id = '" . $eos_medium_id_old . "'
                    AND   eos_desg_cd = $tchr_curr_desg_cd_old
                   AND   eos_type = '2' 
                   AND ac_year = '$global_ac_year'
                   AND   eos_subject_cd = '" . $ts_subject_tot1_old . "' 
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getSansthaListForSamayojanEO($eo_code) {
        $dist_cd = substr($eo_code, 0, 4);
        $schl_type = substr($eo_code, 6, 8);

        $minority_type_cond = SessionComponent::read('minority_type_cond');
//          echo  "-*-----".$minority_type_cond;
//       exit();

        if ($schl_type == 01) {
            $schl_type_condition = 'highest_class <= 8';
        } else if ($schl_type == 02) {
            $schl_type_condition = 'highest_class  > 8';
        }


        $query = "SELECT DISTINCT (SBI.sanstha_code),SBI.sanstha_name,sum(eos_no_of_post) as total_vacant
                    FROM 
                        pavitra.pv_eo_sanstha_ex_vac as ESEV 
                        LEFT JOIN  shala.shala_all_school as SAS ON ESEV.sanstha_code = SAS.sanstha_code AND  ESEV.minority_sanstha IN $minority_type_cond AND ESEV.eos_type ='2' 
                        LEFT JOIN pavitra.sanstha_basic_info as SBI  ON SAS.sanstha_code = SBI.sanstha_code
                        WHERE 
                            schcd LIKE '$dist_cd%' AND SAS.$schl_type_condition  AND length (trim(SBI.sanstha_code)) = 11 AND SBI.minority_sanstha IN $minority_type_cond 
                                AND eos_sama_present !='A'
                            GROUP BY SBI.sanstha_code ,SBI.sanstha_name 
                            ORDER BY total_vacant desc";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    //Samayojan Round0 Start

    public function checkRoundStartSansthaLvlSamaPENDINGGGGGGGGNOTUSED($eo_code, $option_medium_type) {
        $global_ac_year = Configure::read('global_ac_year');

        $minority_type = SessionComponent::read('minority_type');
        $minority_type_cond = SessionComponent::read('minority_type_cond');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);


        $query = "SELECT count(*) FROM pavitra.smj_excesstch_det as SED  
                    LEFT JOIN pavitra.pv_eo_sanstha_ex_vac as ESEV
                     ON SED.sanstha_code =    ESEV.sanstha_code AND SED.ac_year = ESEV.ac_year 
                  WHERE  substr(SED.schl_id,1,4) = '" . $dist_id . "'            
                  AND SED.sch_type = '" . $sch_type . "'   
                       AND SED.eos_medium_id = '" . $option_medium_type . "'   
                       AND SED.asst_flag not in ('A')         
                        AND ESEV.asst_flag not in ('A')   
                        AND ESEV.ac_year = '$global_ac_year' 
                              AND SED.ac_year = '$global_ac_year' 
                       AND ESEV.minority_sanstha   in  $minority_type_cond"; //AND asst_flag ='A'
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getSansthaDistrictList($sanstha_code) {

        $global_ac_year = Configure::read('global_ac_year');

        try {
            $query = "SELECT DISTINCT(ESEV.dist_code),SD.distname
                         FROM         pavitra.pv_eo_sanstha_ex_vac as ESEV
                            LEFT JOIN shala_live.shala_district as SD ON ESEV.dist_code = SD.distcd
                     WHERE  
                                    ESEV.sanstha_code = '" . $sanstha_code . "'
                                AND ESEV.eos_type = '2'
                                AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                                AND ESEV.ac_year = '$global_ac_year'
                ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL) {
                return $result;
//                return 0;
            } else {
//$result=0;
                return 1;
            }
        } catch (Exception $e) {
            return 1;
        }
    }

    public function getSansthaMinorityTypeSama($sanstha_code) {
        $query = "SELECT minority_sanstha
                  FROM   pavitra.sanstha_basic_info
                  WHERE  sanstha_code like '" . $sanstha_code . "%'
                   ";
//        echo "****".$query; exit();
        $result = $this->query($query);

//                 echo "<pre>".print_r($result,true)."</pre>"; exit();

        if ($result[0][0]['minority_sanstha'] == 1) {
//            echo "NON-MINOITY";
            $result1 = '1';
        } else {
//            echo "MINOITY";
            $result1 = '2';
        }
//         echo "" .$result1;
        if ($result <> NULL)
            return $result1;
        else {
            return 0;
        }
    }

    public function get_sanstha_lvl_sama_roaster_caste_list($sanstha_code, $option_schl_type, $district_name_id, $get_sanstha_minority_type_hidden) {

        $global_ac_year = Configure::read('global_ac_year');

        if ($get_sanstha_minority_type_hidden == '1') {
            $minority_type_cond = "('1')";
        } else if ($get_sanstha_minority_type_hidden == '2') {
            $minority_type_cond = "('2','3')";
        }

        if ($option_schl_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($option_schl_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

//        $query = " SELECT DISTINCT(tmp.caste_id), cddir.code_text 
//                    FROM  
//                        (
//                        SELECT 
//                            CASE	
//                                WHEN (gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot)) > 0  THEN 1 
//                                WHEN (sc_sanc_tot  -(sc_work_tot  + sc_smj_tot  + sc_ext_tot )) > 0  THEN 2
//                                WHEN (st_sanc_tot  -(st_work_tot  + st_smj_tot  + st_ext_tot )) > 0  THEN 3
//                                WHEN (obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot)) > 0  THEN 4	
//                                WHEN (vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot)) > 0  THEN 10
//                                WHEN (sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot)) > 0  THEN 12
//                                WHEN (ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot)) > 0  THEN 13
//                                WHEN (ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot)) > 0  THEN 14
//                                WHEN (ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot)) > 0  THEN 15
//                            
//                            END 
//                            AS caste_id
//                        FROM pavitra.roster_info as RI
//                        LEFT JOIN pavitra.sanstha_basic_info as SBI ON RI.sanstha_code = SBI.sanstha_code AND SBI.minority_sanstha IN $minority_type_cond
//                          WHERE
//                                    RI.asst_flag ='V'
//                                AND RI.ac_year = '$global_ac_year'
//                                AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "'
//                                AND RI.sanstha_code =  '" . $sanstha_code . "'
//                        ) tmp
//                        LEFT JOIN master.cddir ON tmp.caste_id = CAST(cddir.code_value as integer) and cddir.code_type = 'CT'
//                        where tmp.caste_id is not null
//                        ORDER BY code_text";

        $query = "
            SELECT caste_id ,code_text 
            FROM
            ((SELECT
			CASE WHEN  (gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot)) > 0
				 THEN 1
				 ELSE 0 
			END AS caste_id,
			code_text,
                        sanstha_code
                FROM pavitra.roster_info as RI 
                LEFT JOIN master.cddir   ON  1 = CAST(cddir.code_value as integer) and cddir.code_type = 'CT'
                WHERE RI.asst_flag ='V' AND RI.ac_year = '$global_ac_year' AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "' AND RI.sanstha_code =  '" . $sanstha_code . "' 
            )
            UNION
            (SELECT
			CASE WHEN    (sc_sanc_tot  -(sc_work_tot  + sc_smj_tot  + sc_ext_tot )) > 0
				 THEN 2
				 ELSE 0 
			END AS caste_id,
			code_text,
                        sanstha_code
                FROM pavitra.roster_info as RI 
                LEFT JOIN master.cddir   ON  2 = CAST(cddir.code_value as integer) and cddir.code_type = 'CT'
                WHERE RI.asst_flag ='V' AND RI.ac_year = '$global_ac_year' AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "' AND RI.sanstha_code =  '" . $sanstha_code . "'
            )
            UNION
            (SELECT
			CASE  WHEN (st_sanc_tot  -(st_work_tot  + st_smj_tot  + st_ext_tot )) > 0 
				 THEN 3
				 ELSE 0 
			END AS caste_id,
			code_text,
                        sanstha_code
                FROM pavitra.roster_info as RI 
                LEFT JOIN master.cddir   ON  3 = CAST(cddir.code_value as integer) and cddir.code_type = 'CT'
                WHERE RI.asst_flag ='V' AND RI.ac_year = '$global_ac_year' AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "' AND RI.sanstha_code =  '" . $sanstha_code . "' 
            )
            UNION
            (SELECT
			CASE WHEN (obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot)) > 0
				 THEN 4
				 ELSE 0 
			END AS caste_id,
			code_text,
                        sanstha_code
                FROM pavitra.roster_info as RI 
                LEFT JOIN master.cddir   ON  4 = CAST(cddir.code_value as integer) and cddir.code_type = 'CT'
                WHERE RI.asst_flag ='V' AND RI.ac_year = '$global_ac_year' AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "' AND RI.sanstha_code =  '" . $sanstha_code . "' 
            )
            UNION
            (SELECT
			CASE WHEN (vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot)) > 0
				 THEN 10
				 ELSE 0 
			END AS caste_id,
			code_text,
                        sanstha_code
                FROM pavitra.roster_info as RI 
                LEFT JOIN master.cddir   ON  10 = CAST(cddir.code_value as integer) and cddir.code_type = 'CT'
                WHERE RI.asst_flag ='V' AND RI.ac_year = '$global_ac_year' AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "' AND RI.sanstha_code =  '" . $sanstha_code . "' 
            )
            UNION
            (SELECT
			CASE WHEN (sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot)) > 0
				 THEN 12
				 ELSE 0 
			END AS caste_id,
			code_text,
                        sanstha_code
                FROM pavitra.roster_info as RI 
                LEFT JOIN master.cddir   ON  12 = CAST(cddir.code_value as integer) and cddir.code_type = 'CT'
                WHERE RI.asst_flag ='V' AND RI.ac_year = '$global_ac_year' AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "' AND RI.sanstha_code =  '" . $sanstha_code . "' 
            )
            UNION
            (SELECT
			CASE WHEN (ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot)) > 0
				 THEN 13
				 ELSE 0 
			END AS caste_id,
			code_text,
                        sanstha_code
                FROM pavitra.roster_info as RI 
                LEFT JOIN master.cddir   ON  13 = CAST(cddir.code_value as integer) and cddir.code_type = 'CT'
                WHERE RI.asst_flag ='V' AND RI.ac_year = '$global_ac_year' AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "' AND RI.sanstha_code =  '" . $sanstha_code . "'
            )
            UNION
            (SELECT
			CASE WHEN (ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot)) > 0
				 THEN 14
				 ELSE 0 
			END AS caste_id,
			code_text,
                        sanstha_code
                FROM pavitra.roster_info as RI 
                LEFT JOIN master.cddir   ON  14 = CAST(cddir.code_value as integer) and cddir.code_type = 'CT'
                WHERE RI.asst_flag ='V' AND RI.ac_year = '$global_ac_year' AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "' AND RI.sanstha_code =  '" . $sanstha_code . "' 
            )
            UNION
            (SELECT
			CASE  WHEN (ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot)) > 0 
				 THEN 15
				 ELSE 0 
			END AS caste_id,
			code_text,
                        sanstha_code
                FROM pavitra.roster_info as RI 
                LEFT JOIN master.cddir   ON  15 = CAST(cddir.code_value as integer) and cddir.code_type = 'CT'
                WHERE RI.asst_flag ='V' AND RI.ac_year = '$global_ac_year' AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "' AND RI.sanstha_code =  '" . $sanstha_code . "'
            )
            ) as tmp
            LEFT JOIN pavitra.sanstha_basic_info as SBI ON tmp.sanstha_code = SBI.sanstha_code AND SBI.minority_sanstha IN $minority_type_cond
             WHERE  caste_id != 0 
             ORDER BY code_text 
            "
        ;

//            echo "------" . $query; 
//            exit();

        $result = $this->query($query);
//        echo "<pre>---------------------" . print_r($result, true) . "<pre>";  exit();

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function get_sanstha_lvl_sama_medium_list($sanstha_code, $option_schl_type, $district_name_id, $get_sanstha_minority_type_hidden, $option_roaster_caste_list_sanstha_lvl_sama) {

        $global_ac_year = Configure::read('global_ac_year');

        $query = "SELECT distinct(esev.eos_medium_id), medinstr_desc
                    FROM pavitra.pv_eo_sanstha_ex_vac esev
                    LEFT JOIN master.shala_medinstr mi on esev.eos_medium_id=mi.medinstr_id 
                    WHERE  
                        esev.sanstha_code = '$sanstha_code'
                    AND esev.schl_type = '$option_schl_type'
                    AND esev.schl_id like '$district_name_id%'
                    AND esev.eos_type = '2'
                   AND esev.eos_no_of_post > esev.shifted_tchr_cnt
                    AND esev.minority_sanstha = '$get_sanstha_minority_type_hidden'
                    AND esev.ac_year = '$global_ac_year'
                    AND esev.asst_flag ='A'
                    ORDER BY medinstr_desc"; // sm.tc_categ != 1
//        echo "------" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function get_sanstha_lvl_sama_designation_list($sanstha_code, $option_schl_type, $district_name_id, $get_sanstha_minority_type_hidden, $option_roaster_caste_list_sanstha_lvl_sama, $option_medium_type_sanstha_lvl_sama) {

        $global_ac_year = Configure::read('global_ac_year');

        $query = "SELECT distinct(esev.eos_desg_cd),TPM.post_desc
                    FROM pavitra.pv_eo_sanstha_ex_vac esev
                    LEFT JOIN master.tchr_post_master as TPM  ON esev.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                    WHERE  
                        esev.sanstha_code = '$sanstha_code'
                    AND esev.schl_type = '$option_schl_type'
                    AND esev.schl_id like '$district_name_id%'
                    AND esev.eos_type ='2'   
                    AND esev.eos_no_of_post > esev.shifted_tchr_cnt
                    AND esev.minority_sanstha = '$get_sanstha_minority_type_hidden'
                    AND esev.eos_medium_id = '$option_medium_type_sanstha_lvl_sama' 
                    AND esev.ac_year = '$global_ac_year'
                    AND esev.asst_flag ='A'
                    ORDER BY post_desc";
//        echo "------" . $query;
//        exit(); 

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function get_sanstha_lvl_sama_subject_list($sanstha_code, $option_schl_type, $district_name_id, $get_sanstha_minority_type_hidden, $option_roaster_caste_list_sanstha_lvl_sama, $option_medium_type_sanstha_lvl_sama, $option_designation_type_sanstha_lvl_sama) {

        $global_ac_year = Configure::read('global_ac_year');

        $query = "SELECT distinct(esev.eos_subject_cd) ,aps.subject_group_desc
                    FROM pavitra.pv_eo_sanstha_ex_vac esev
                    LEFT JOIN master.tchr_post_master as TPM  ON esev.eos_desg_cd = TPM.post_id AND TPM.post_type = 1
                    LEFT JOIN master.tchr_apt_subject  as aps ON esev.eos_subject_cd  = CAST (aps.subject_group_id as numeric) 
                    WHERE  
                        esev.sanstha_code = '$sanstha_code'
                    AND esev.schl_type = '$option_schl_type'
                    AND esev.schl_id like '$district_name_id%'
                    AND esev.eos_type = '2'
                    AND esev.eos_no_of_post > esev.shifted_tchr_cnt
                    AND esev.minority_sanstha = '$get_sanstha_minority_type_hidden'
                    AND esev.eos_medium_id = '$option_medium_type_sanstha_lvl_sama'  
                    AND esev.eos_desg_cd = '$option_designation_type_sanstha_lvl_sama'
                    AND esev.ac_year = '$global_ac_year'
                    AND esev.asst_flag = 'A'
                    ORDER BY aps.subject_group_desc";
//        echo "------" . $query;
//        exit();

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function get_sanstha_lvl_sama_excess_sanstha_list($sanstha_code, $option_schl_type, $district_name_id, $get_sanstha_minority_type_hidden, $option_roaster_caste_list_sanstha_lvl_sama, $option_medium_type_sanstha_lvl_sama, $option_designation_type_sanstha_lvl_sama, $option_subject_type_sanstha_lvl_sama) {

        $global_ac_year = Configure::read('global_ac_year');

        if ($get_sanstha_minority_type_hidden == '1') {
            $minority_type_cond = "('1')";
        } else if ($get_sanstha_minority_type_hidden == '2') {
            $minority_type_cond = "('2','3')";
        }

        if ($option_schl_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($option_schl_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        if ($option_roaster_caste_list_sanstha_lvl_sama == '1') { //General
            $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) < 0'; //   $col_cond = 'gen_smj_tot';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '2') { //SC
            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '3') { //ST
            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '4') { //OBC
            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '10') { //VJA
            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '12') { //SBC
            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '13') { //NTB
            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '14') { //NTC  
            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '15') { //NTD
            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) < 0';
        }

        $query = " SELECT distinct(sbi.sanstha_code), sbi.sanstha_name, count(tch_ex_id) as total_excess
                    FROM
                    pavitra.smj_excesstch_det as sed
                    INNER JOIN shala.shala_all_school as sas ON sed.sanstha_code = sas.sanstha_code
                                                            AND sed.schl_id = sas.schcd 
                                                            AND sed.sch_type = '$option_schl_type'
                                                            AND sed.schl_id like '$district_name_id%'  
                                                            AND sed.tc_categ = '$option_roaster_caste_list_sanstha_lvl_sama' 
                                                            AND sed.sanstha_code != '$sanstha_code'
                                                            AND sed.eos_medium_id = '$option_medium_type_sanstha_lvl_sama'
                                                            AND sed.tchr_curr_desg_cd = '$option_designation_type_sanstha_lvl_sama'
                                                            AND (    sed.ts_subject_tot1 ='$option_subject_type_sanstha_lvl_sama' 
                                                                  OR sed.ts_subject_tot2 ='$option_subject_type_sanstha_lvl_sama'
                                                                )  
                                                            AND stg_flg0 = 'N' AND stg_flg1 = 'N' AND stg_flg2 = 'N' AND stg_flg3 = 'N' AND stg_flg4 = 'N' AND stg_flg5 = 'N' AND stg_flg6 = 'N'  
                     INNER JOIN pavitra.sanstha_basic_info as sbi ON sed.sanstha_code = sbi.sanstha_code 
                                                                    AND length (trim(sbi.sanstha_code)) = 11
                                                                    AND sbi.minority_sanstha IN $minority_type_cond     
                                                                    
                                                                    AND sed.sanstha_code  
                                                                     IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                                            WHERE  $col_cond 
                                                                                AND roster_info.asst_flag = 'V'
                                                                                AND roster_info.ac_year = '$global_ac_year'
                                                                                AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
                                                                        )
                     GROUP BY sbi.sanstha_code , sbi.sanstha_name 
                     ORDER BY sbi.sanstha_name 
        ";
//        echo " ------" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function get_sanstha_lvl_sama_excess_school_list($sanstha_code, $option_schl_type, $district_name_id, $get_sanstha_minority_type_hidden, $option_roaster_caste_list_sanstha_lvl_sama, $option_medium_type_sanstha_lvl_sama, $option_designation_type_sanstha_lvl_sama, $option_subject_type_sanstha_lvl_sama, $option_excess_sanstha_list_sanstha_lvl_sama) {

        $global_ac_year = Configure::read('global_ac_year');

        if ($get_sanstha_minority_type_hidden == '1') {
            $minority_type_cond = "('1')";
        } else if ($get_sanstha_minority_type_hidden == '2') {
            $minority_type_cond = "('2','3')";
        }

        if ($option_schl_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($option_schl_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        if ($option_roaster_caste_list_sanstha_lvl_sama == '1') { //General
            $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) < 0'; //   $col_cond = 'gen_smj_tot';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '2') { //SC
            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '3') { //ST
            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '4') { //OBC
            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '10') { //VJA
            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '12') { //SBC
            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '13') { //NTB
            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '14') { //NTC  
            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '15') { //NTD
            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) < 0';
        }

        $query = " SELECT distinct(sed.schl_id),sed.schl_name,sed.sanstha_code,count(tch_ex_id) as total_excess
                    FROM pavitra.smj_excesstch_det as sed
                    INNER JOIN shala.shala_all_school as sas ON sed.sanstha_code = sas.sanstha_code
                                                            AND sed.schl_id = sas.schcd 
                                                            AND sed.sch_type = '$option_schl_type'
                                                            AND sed.schl_id like '$district_name_id%' 
                                                            AND sed.tc_categ = '$option_roaster_caste_list_sanstha_lvl_sama' 
                                                            AND sed.sanstha_code = '$option_excess_sanstha_list_sanstha_lvl_sama'
                                                            AND sed.eos_medium_id = '$option_medium_type_sanstha_lvl_sama'
                                                            AND sed.tchr_curr_desg_cd = '$option_designation_type_sanstha_lvl_sama'
                                                            AND (   sed.ts_subject_tot1 ='$option_subject_type_sanstha_lvl_sama'  
                                                                  OR sed.ts_subject_tot2 ='$option_subject_type_sanstha_lvl_sama'
                                                                )
                                                            AND stg_flg0 = 'N' AND stg_flg1 = 'N' AND stg_flg2 = 'N' AND stg_flg3 = 'N' AND stg_flg4 = 'N' AND stg_flg5 = 'N' AND stg_flg6 = 'N'       
                     INNER JOIN pavitra.sanstha_basic_info as sbi ON sed.sanstha_code = sbi.sanstha_code
                                                                    AND length (trim(sbi.sanstha_code)) = 11
                                                                    AND sbi.minority_sanstha IN $minority_type_cond     
                    
                                                                    AND sed.sanstha_code  
                                                                     IN (SELECT sanstha_code FROM pavitra.roster_info 
                                                                            WHERE  $col_cond 
                                                                            AND roster_info.asst_flag = 'V'
                                                                            AND roster_info.ac_year = '$global_ac_year'
                                                                            AND roster_edn_level =  '" . $roster_edn_level_cond . "'  
                                                                        )
                     GROUP BY sed.schl_id , sed.schl_name,sed.sanstha_code  
                    ORDER BY schl_name
        ";


//        echo " ------" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function get_sanstha_lvl_sama_excess_tchr_list($sanstha_code, $option_schl_type, $district_name_id, $get_sanstha_minority_type_hidden, $option_roaster_caste_list_sanstha_lvl_sama, $option_medium_type_sanstha_lvl_sama, $option_designation_type_sanstha_lvl_sama, $option_subject_type_sanstha_lvl_sama, $option_excess_sanstha_list_sanstha_lvl_sama, $option_excess_school_list_sanstha_lvl_sama) {

        $global_ac_year = Configure::read('global_ac_year');

        if ($get_sanstha_minority_type_hidden == '1') {
            $minority_type_cond = "('1')";
        } else if ($get_sanstha_minority_type_hidden == '2') {
            $minority_type_cond = "('2','3')";
        }

        if ($option_schl_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($option_schl_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        if ($option_roaster_caste_list_sanstha_lvl_sama == '1') { //General
            $col_cond = 'gen_sanc_tot -(gen_work_tot + gen_smj_tot + gen_ext_tot) < 0'; //   $col_cond = 'gen_smj_tot';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '2') { //SC
            $col_cond = 'sc_sanc_tot -(sc_work_tot + sc_smj_tot + sc_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '3') { //ST
            $col_cond = 'st_sanc_tot -(st_work_tot + st_smj_tot + st_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '4') { //OBC
            $col_cond = 'obc_sanc_tot -(obc_work_tot + obc_smj_tot + obc_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '10') { //VJA
            $col_cond = 'vja_sanc_tot -(vja_work_tot + vja_smj_tot + vja_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '12') { //SBC
            $col_cond = 'sbc_sanc_tot -(sbc_work_tot + sbc_smj_tot + sbc_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '13') { //NTB
            $col_cond = 'ntb_sanc_tot -(ntb_work_tot + ntb_smj_tot + ntb_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '14') { //NTC  
            $col_cond = 'ntc_sanc_tot -(ntc_work_tot + ntc_smj_tot + ntc_ext_tot) < 0';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '15') { //NTD
            $col_cond = 'ntd_sanc_tot -(ntd_work_tot + ntd_smj_tot + ntd_ext_tot) < 0';
        }


        $query = " SELECT  sed.sanstha_code,sbi.sanstha_name,sed.tch_ex_id,sed.tchr_fname,sed.tchr_mname,sed.tchr_lname,
                            sed.tchr_curr_desg_cd,tpm.post_desc,
                            sed.schl_id,sed.schl_name,sed.tchr_birth_dt,sed.tchr_curr_desig_dt,
                            sed.tc_categ,sed.tc_categ_desc, 
                            sed.tq_adegree,sed.tq_adegname,sed.tq_pdegree,sed.tq_pdegname,
                            sed.ts_subject_tot1,sed.ts_subjectdesc_tot1,sed.ts_subject_tot2,sed.ts_subjectdesc_tot2 ,
                            sed.ts_smj_schl_id,sed.ts_smj_eo_code,sed.ts_smj_tch_sub,sed.ts_smj_dtts,sed.new_sanstha_code,sed.ts_smj_categ_cd,
                            sed.stg_flg0,sed.stg_flg1,sed.stg_flg2,sed.stg_flg3,sed.stg_flg4,sed.eos_medium_id,sed.tchr_gender
                            
                        FROM     pavitra.smj_excesstch_det sed  
                             LEFT JOIN  pavitra.sanstha_basic_info sbi ON sed.sanstha_code=sbi.sanstha_code AND sbi.minority_sanstha IN $minority_type_cond
                             LEFT JOIN  master.tchr_post_master as tpm  ON tpm.post_id = sed.tchr_curr_desg_cd AND tpm.post_type = 1
 
                         WHERE 
                                     sed.schl_id = '$option_excess_school_list_sanstha_lvl_sama'  
                                AND sed.sanstha_code = '$option_excess_sanstha_list_sanstha_lvl_sama'      
                                AND sed.sch_type = '$option_schl_type'
                                AND sed.tc_categ='$option_roaster_caste_list_sanstha_lvl_sama' 
                                AND sed.eos_medium_id = '$option_medium_type_sanstha_lvl_sama'
                                AND sed.tchr_curr_desg_cd = '$option_designation_type_sanstha_lvl_sama'
                                AND (    sed.ts_subject_tot1 ='$option_subject_type_sanstha_lvl_sama'  
                                      OR sed.ts_subject_tot2 ='$option_subject_type_sanstha_lvl_sama'
                                    )
                                AND  sed.asst_flag = 'A'
                                AND stg_flg0 = 'N' AND stg_flg1 = 'N' AND stg_flg2 = 'N' AND stg_flg3 = 'N' AND stg_flg4 = 'N' AND stg_flg5 = 'N' AND stg_flg6 = 'N'  
                                AND sed.ac_year = '$global_ac_year'   
                                
                           ORDER BY tchr_curr_desig_dt,tchr_birth_dt,tchr_lname,tchr_fname,tchr_mname
        ";
//        
//        echo "" . $query;
//            exit();

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function get_sanstha_lvl_sama_vacant_school_list($sanstha_code, $option_schl_type, $district_name_id, $get_sanstha_minority_type_hidden, $option_roaster_caste_list_sanstha_lvl_sama, $option_medium_type_sanstha_lvl_sama, $option_designation_type_sanstha_lvl_sama, $option_subject_type_sanstha_lvl_sama, $option_excess_school_list_sanstha_lvl_sama, $row_id_arr) {

        $global_ac_year = Configure::read('global_ac_year');

        $query = "SELECT distinct(esev.schl_id),sas.school_name,(esev.eos_no_of_post - esev.shifted_tchr_cnt  + esev.shifted_tchr_cnt_excess) as total_vacant   
                    FROM pavitra.pv_eo_sanstha_ex_vac esev
                   LEFT JOIN master.tchr_post_master as TPM  ON esev.eos_desg_cd = TPM.post_id AND TPM.post_type = 1
                    LEFT JOIN master.tchr_apt_subject  as aps ON esev.eos_subject_cd  = CAST (aps.subject_group_id as numeric) 
                    LEFT JOIN shala.shala_all_school as sas ON  esev.schl_id = sas.schcd
                    WHERE  
                          esev.sanstha_code = '$sanstha_code'        
                    AND esev.schl_type = '$option_schl_type'
                    AND esev.schl_id like '$district_name_id%'
                    AND esev.minority_sanstha = '$get_sanstha_minority_type_hidden'
                    AND esev.eos_medium_id = '$option_medium_type_sanstha_lvl_sama'  
                    AND esev.eos_desg_cd = '$option_designation_type_sanstha_lvl_sama'
                    AND esev.eos_subject_cd = '$option_subject_type_sanstha_lvl_sama'
                    AND esev.eos_type = '2'   
                    AND ESEV.eos_no_of_post > ESEV.shifted_tchr_cnt
                    AND esev.ac_year = '$global_ac_year'
                    AND esev.asst_flag ='A' 
                    ORDER BY school_name";
//        echo "------" . $query;
//        exit();

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateNoVacanctCntRound0($new_eo_code, $sanstha_code, $option_vacant_school_id_sanstha_lvl_sama, $option_medium_type_sanstha_lvl_sama, $option_designation_type_sanstha_lvl_sama, $option_subject_type_sanstha_lvl_sama) {
        $global_ac_year = Configure::read('global_ac_year');
        try {

            $district_name_id = substr($new_eo_code, 0, 4);
            $option_schl_type = substr($new_eo_code, 6, 8);

            $query = " UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt = shifted_tchr_cnt + 1 
                WHERE    dist_code = '" . $district_name_id . "'
                   AND   schl_type = '" . $option_schl_type . "'
                   AND   eo_code = '" . $new_eo_code . "'
                   AND   sanstha_code = '" . $sanstha_code . "'
                   AND   schl_id = '" . $option_vacant_school_id_sanstha_lvl_sama . "' 
                   AND   eos_medium_id = '" . $option_medium_type_sanstha_lvl_sama . "'
                   AND   eos_desg_cd = $option_designation_type_sanstha_lvl_sama
                   AND   eos_type = '2' 
                   AND   ac_year = '$global_ac_year'
                   AND   eos_subject_cd = '" . $option_subject_type_sanstha_lvl_sama . "' 
                    ";

//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateNoExcessCntRound0($new_eo_code, $option_excess_sanstha_list_sanstha_lvl_sama, $option_excess_school_list_sanstha_lvl_sama, $option_medium_type_sanstha_lvl_sama, $option_designation_type_sanstha_lvl_sama) {
        $global_ac_year = Configure::read('global_ac_year');
        try {

            $district_name_id = substr($new_eo_code, 0, 4);
            $option_schl_type = substr($new_eo_code, 6, 8);


            $query = " UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  shifted_tchr_cnt_excess = shifted_tchr_cnt_excess + 1 
                WHERE    dist_code = '" . $district_name_id . "'
                   AND   schl_type = '" . $option_schl_type . "'
                   AND   eo_code = '" . $new_eo_code . "'
                   AND   sanstha_code = '" . $option_excess_sanstha_list_sanstha_lvl_sama . "'
                   AND   schl_id = '" . $option_excess_school_list_sanstha_lvl_sama . "' 
                   AND   eos_medium_id = '" . $option_medium_type_sanstha_lvl_sama . "'
                   AND   eos_desg_cd = $option_designation_type_sanstha_lvl_sama
                   AND   eos_type = '1' 
                   AND   ac_year = '$global_ac_year'
                    ";


//            echo "" . $query;
//            exit();

            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function updateAbsentSanstha($eo_code, $sanstha_name_sanstha_lvl_id) {
        $global_ac_year = Configure::read('global_ac_year');
        try {

            $dist_id_old = substr($eo_code, 0, 4);
            $sch_type_old = substr($eo_code, 6, 8);

            $query = "UPDATE pavitra.pv_eo_sanstha_ex_vac
                SET
                  remarks = 'PPPPPPPPP'
                WHERE     sanstha_code = '" . $sanstha_name_sanstha_lvl_id . "' 
                   AND    ac_year = '$global_ac_year' 
                  ";
//            echo "" . $query;
//            exit();
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

}

?>
