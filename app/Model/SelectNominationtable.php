<?php

class SelectNominationtable extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "SelectNominationtable";
    var $useTable = 'tchr_nominee_det';

    public function updatenomibyid($tchrsrilid, $recvdata, $curtm) {
        $result = $this->query("update tchr_nominee_det set  tq_qual_lvl=?,tq_board_univ=?,tq_medium=?,tq_state_pass=?,tq_pass_month=?,tq_pass_year=?,tq_pcnt=?,tq_grade=?,tq_maj_sub=?,tq_min_sub1=?,tq_min_sub2=?,tq_othr_sub=?,tq_remarks=?,verif_flag=?,upd_dtts=?,tq_cert_loaded=? where id=?;", array($recvdata['acad_qualification']['SelectedAcadQual'], $board, $recvdata['acad_qualification']['techr_medium'], $state, $recvdata['acad_qualification']['techr_month_pass'], $recvdata['acad_qualification']['techr_year_pass'], $recvdata['acad_qualification']['techr_mark'], $recvdata['acad_qualification']['techr_grade'], $recvdata['acad_qualificationMainsubject'], $sub1, $sub2, $recvdata['acad_qualification']['techr_othersub'], $recvdata['acad_qualification']['techr_remark'], 'E', $curtm, $imgflg, $tchrsrilid));
        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function insertnomibyid($recvdata, $curtm, $cnt, $schcd) {
        $i = 0;
        $count = 1;
        if (@$recvdata['nominationdtl']['techr_nomi_as'] != '' && isset($recvdata['nominationdtl']['techr_nomi_as'])) {
            $recvdata['nominationdtl']['techr_nomi_as'] = $recvdata['nominationdtl']['techr_nomi_as'];
        } else {
            $recvdata['nominationdtl']['techr_nomi_as'] = '';
        }
      //  $result = $this->query("delete from  master.tchr_nominee_det where tchr_id='" . $recvdata['tchr_id'] . "' AND tn_nom_type = '" . $recvdata['familytpid'] . "' AND  tn_nomination_as= '" . $recvdata['nominationdtl']['techr_nomi_as'] . "'");

        for ($i = 0; $i < $cnt; $i++) {
            $pecent = $recvdata['nominationdtl']['techr_mark'][$i];
            if ($pecent == '') {
                $pecent = 0;
            } else {
                $pecent = $pecent;
            }
            if ($recvdata['familytpid'] == '') {
                $recvdata['familytpid'] = '';
            } else {
                $recvdata['familytpid'] = $recvdata['familytpid'];
            }
            if (isset($recvdata['nominationdtl']['nomi_date']) && $recvdata['nominationdtl']['nomi_date'] != '') {
                $arr_trng_from_dt = split("\/", $recvdata['nominationdtl']['nomi_date']);
                $from_dt = $arr_trng_from_dt[1] . '/' . $arr_trng_from_dt[0] . '/' . $arr_trng_from_dt[2];
            } else {
                $from_dt = NULL;
                $recvdata['nominationdtl']['nomi_date'] = NULL;
            }

            $result = $this->query("INSERT INTO tchr_nominee_det (tchr_id,tn_nom_type,tn_nom_date,tf_fam_id_no,tn_pcnt,asst_auth,entry_dtstamp,verif_dtstamp,tn_nomination_as,asst_flag) VALUES  
                       ('" . $recvdata['tchr_id'] . "','" . $recvdata['familytpid'] . "','" . $from_dt . "','" . $recvdata['fmlyid'][$i] . "','" . $pecent . "','" . $schcd . "','" . $curtm . "','" . $curtm . "','" . $recvdata['nominationdtl']['techr_nomi_as'] . "','E')");
        }
        $result_delete = $this->query("delete from  master.tchr_nominee_det
          where tchr_id='" . $recvdata['tchr_id'] . "' AND tn_nom_type = '" . $recvdata['familytpid'] . "'
          AND  tn_nomination_as= '" . $recvdata['nominationdtl']['techr_nomi_as'] . "' AND tn_pcnt = 0 ");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function alternativenomisn($tid, $nomid, $nomias) {
        $curent_date = date('Y/m/d');

        if ($nomid == 'F') {
            if ($nomias == 'A') {
                $result = $this->query("SELECT tchr_id, tf_fam_id_no, tf_rel_cd, tf_rel_fname, tf_rel_mname,tf_rel_lname,tf_rel_dob FROM master.tchr_fmly_det where  tchr_fmly_det.tchr_id='" . $tid . "' and tf_fam_id_no NOT IN( SELECT  nm.tf_fam_id_no FROM master.tchr_nominee_det nm where   nm.tchr_id='" . $tid . "' AND nm.tn_nom_type='" . $nomid . "' AND nm.tn_nomination_as = 'O' and tn_pcnt > 0 )");
            } else {
                $result = $this->query("SELECT tchr_id, tf_fam_id_no, tf_rel_cd, tf_rel_fname, tf_rel_mname,tf_rel_lname,code_text,tf_rel_dob
                        FROM master.tchr_fmly_det ,master.cddir
                        where  tchr_fmly_det.tchr_id='" . $tid . "'   and cddir.code_type= 'NR' and tf_rel_cd = cast(cddir.code_value as numeric) and 
                        ((date_part('year',age('$curent_date', tf_rel_dob)) < 18 and  tf_rel_cd IN ('7')) OR (date_part('year',age('$curent_date', tf_rel_dob)) < 21 and  tf_rel_cd IN ('8'))  OR tf_rel_cd IN ('6','5'))
                        and tf_fam_id_no NOT IN( SELECT  nm.tf_fam_id_no 
                        FROM master.tchr_nominee_det nm 
                        where   nm.tchr_id='" . $tid . "' AND nm.tn_nom_type='" . $nomid . "' AND nm.tn_nomination_as = 'A')
                          ");
            }
        } else {
            if ($nomias == 'A') {
                $result = $this->query("SELECT tchr_id, tf_fam_id_no, tf_rel_cd, tf_rel_fname, tf_rel_mname,tf_rel_lname,tf_rel_dob,code_text
                        FROM master.tchr_fmly_det  ,master.cddir
                        where cddir.code_type= 'NR' and tf_rel_cd = cast(cddir.code_value as numeric) and
                        tchr_fmly_det.tchr_id='" . $tid . "' and tf_fam_id_no NOT IN( SELECT  nm.tf_fam_id_no FROM master.tchr_nominee_det nm where   nm.tchr_id='" . $tid . "' AND nm.tn_nom_type='" . $nomid . "' AND nm.tn_nomination_as = 'O' and tn_pcnt > 0 )");
            } else {
                $result = $this->query("SELECT tchr_id, tf_fam_id_no, tf_rel_cd, tf_rel_fname, tf_rel_mname,tf_rel_lname,code_text,tf_rel_dob
                        FROM master.tchr_fmly_det ,master.cddir
                        where  tchr_fmly_det.tchr_id='" . $tid . "'   and cddir.code_type= 'NR' and tf_rel_cd = cast(cddir.code_value as numeric) 
                        and tf_fam_id_no NOT IN( SELECT  nm.tf_fam_id_no 
                        FROM master.tchr_nominee_det nm 
                        where   nm.tchr_id='" . $tid . "' AND nm.tn_nom_type='" . $nomid . "' AND nm.tn_nomination_as = 'A')
                          ");
            }
        }

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function verify_nomin($tchr_id, $tn_nom_type, $tn_nomination_as) {
        $result = $this->query("SELECT tchr_nominee_det.*
        FROM  master.tch_master,master.tchr_nominee_det
        where tchr_nominee_det.tchr_id='$tchr_id'  and tch_master.tchr_id = tchr_nominee_det.tchr_id 
        and tn_nom_type = '$tn_nom_type' and tn_nomination_as = '$tn_nomination_as'
        order by tch_master.tchr_id,tn_nom_type,tn_nomination_as DESC,tf_fam_id_no");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function ClusterFindTeacher($schcd) {
        $result = $this->query("SELECT  distinct(m.tchr_id),m.tchr_fname,m.tchr_mname,m.tchr_lname,m.schl_id,m.asst_flag,m.tchr_type
                FROM master.tch_master m 
                WHERE  m.schl_id='" . $schcd . "' 
                AND  m.tchr_id in ( select tchr_id from master.tchr_nominee_det as f  where f.asst_flag = 'F'  and f.tchr_id = m.tchr_id ) ");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    //HM query to check record for ori nom exist or not ..
    public function hm_check_org_nom_record($tchr_id, $Nomityp) {
        $result = $this->query("SELECT * FROM master.tchr_nominee_det as f where f.tchr_id = '" . $tchr_id . "' AND f.tn_nomination_as = 'O' 
            AND f.tn_nom_type = '" . $Nomityp . "' AND f.tn_pcnt != 0 ");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function forward_nomination($schcd) {
        $result = $this->query("SELECT f.tf_rel_fname, f.tf_rel_mname, f.tf_rel_lname, n.* , cd.*
FROM master.tch_master m 
INNER JOIN master.tchr_fmly_det as f ON m.tchr_id = f.tchr_id
INNER JOIN master.tchr_nominee_det as n ON m.tchr_id = n.tchr_id AND f.tf_fam_id_no = n.tf_fam_id_no
INNER JOIN master.cddir as cd ON n.tn_nom_type = cd.code_value AND code_type = 'NP'
WHERE m.asst_flag IN ('U','V') 
AND m.schl_id = '" . $schcd . "'
AND N.asst_flag = 'E' 
AND N.tn_pcnt != 0  ");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function verify_nomination_org($school_id, $tchr_id, $nomtype) {
        $result = $this->query("SELECT f.tf_rel_fname, f.tf_rel_mname, f.tf_rel_lname, n.* , cd.*
                                FROM master.tch_master m 
                                INNER JOIN master.tchr_fmly_det as f ON m.tchr_id = f.tchr_id
                                INNER JOIN master.tchr_nominee_det as n ON m.tchr_id = n.tchr_id 
                                INNER JOIN master.cddir as cd ON n.tn_nom_type = cd.code_value AND code_type = 'NP'
                                WHERE
                                 m.schl_id = '" . $school_id . "' AND n.tchr_id = '" . $tchr_id . "' AND f.tf_fam_id_no = n.tf_fam_id_no
                                AND n.asst_flag = 'F'  AND n.tn_nom_type = '" . $nomtype . "' 
                                AND n.tn_pcnt != 0 AND n.tn_nomination_as = 'O'
                                ");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function verify_nomination_alter($school_id, $tchr_id, $nomtype) {
        $result = $this->query("SELECT  n.tchr_id,n.id,f.tf_rel_fname, f.tf_rel_mname, f.tf_rel_lname, n.* , cd.*
                                FROM master.tch_master m 
                                INNER JOIN master.tchr_fmly_det as f ON m.tchr_id = f.tchr_id
                                INNER JOIN master.tchr_nominee_det as n ON m.tchr_id = n.tchr_id 
                                INNER JOIN master.cddir as cd ON n.tn_nom_type = cd.code_value AND code_type = 'NP'
                                WHERE m.schl_id = '" . $school_id . "' AND n.tchr_id = '" . $tchr_id . "' AND f.tchr_id = '" . $tchr_id . "'  AND f.tf_fam_id_no = n.tf_fam_id_no
                                AND n.asst_flag = 'F' AND  n.tn_nom_type = '" . $nomtype . "'  AND n.tn_pcnt != 0 AND n.tn_nomination_as = 'A'  AND  m.tchr_id NOT IN
                                ( select tchr_id from master.tchr_nominee_det as f where  f.tchr_id = '" . $tchr_id . "' AND 
                                f.tn_nom_type = '" . $nomtype . "' AND  f.tn_nomination_as = 'O' AND f.tn_pcnt != 0 AND f.asst_flag IN ('R','F') ) 
                                ");


        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function getflag() {
        $flag = $this->query("SELECT distinct schl_id  
                                FROM  master.tchr_nominee_det ts,master.tch_master tm
                                where ts.asst_flag='F'
                                and ts.tchr_id=tm.tchr_id");

        return($flag);
    }

    public function checkOriginalNomineeDetailsFowardCondition($schcd, $tchr_id) {
        try {
            $query = "SELECT tchr_nominee_det.tchr_id ,tchr_nominee_det.tn_nom_type,tchr_nominee_det.tf_fam_id_no ,tchr_nominee_det.tn_nomination_as 
                FROM master.tch_master,master.tchr_nominee_det,master.tchr_entry_status
                where 
                    tch_master.tchr_id = tchr_entry_status.tchr_id
                AND tch_master.tchr_id = tchr_nominee_det.tchr_id
                AND tch_master.schl_id='" . $schcd . "' 
                AND tch_master.tchr_id='" . $tchr_id . "'
                AND tchr_nominee_det.asst_flag = 'E'
                AND tchr_nominee_det.tn_nom_type is not null 
                 AND tchr_nominee_det.tf_fam_id_no is not null 
                  AND tchr_nominee_det.tn_nomination_as = 'O'
                AND tchr_entry_status.de_fam_nom_org = 'Y'"; // posttype 1=Teaching 2=Non-Teaching
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

    public function checkAlternativeNomineeDetailsFowardCondition($schcd, $tchr_id) {
        try {
            $query = "SELECT tchr_nominee_det.tchr_id ,tchr_nominee_det.tn_nom_type,tchr_nominee_det.tf_fam_id_no ,tchr_nominee_det.tn_nomination_as 
                FROM master.tch_master,master.tchr_nominee_det,master.tchr_entry_status
                where 
                    tch_master.tchr_id = tchr_entry_status.tchr_id
                AND tch_master.tchr_id = tchr_nominee_det.tchr_id
                AND tch_master.schl_id='" . $schcd . "' 
                AND tch_master.tchr_id='" . $tchr_id . "'
                AND tchr_nominee_det.asst_flag = 'E'
                AND tchr_nominee_det.tn_nom_type is not null 
                 AND tchr_nominee_det.tf_fam_id_no is not null 
                  AND tchr_nominee_det.tn_nomination_as = 'A'
                AND tchr_entry_status.de_fam_nom_alt = 'Y'"; // posttype 1=Teaching 2=Non-Teaching
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

?>