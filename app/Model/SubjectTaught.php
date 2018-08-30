<?php

class SubjectTaught extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = 'SubjectTaught';
    var $useTable = 'tchr_sub_taught'; //db=Teacher schema=master

    public function getflag() {
        $flag = $this->query("SELECT distinct schl_id  
                                FROM  master.tchr_sub_taught ts,master.tch_master tm
                                where ts.asst_flag='F'
                                and ts.tchr_id=tm.tchr_id");

        return($flag);
    }

    public function findsubject($prof_level, $medium, $from, $user_id) {
        $result = $this->query("SELECT  distinct(sm.subject_code), subject_name
FROM master.shala_standard_medium_subject sm, master.shala_i_x_subject sb 
WHERE schl_id='" . $user_id . "' and medium='" . $medium . "' and standard = '" . $from . "' and sm.subject_code = sb.subject_code
 order by sm.subject_code;");

        if ($result <> NULL) {
            return $result;
        } else {
            return 0;
        }
    }

    public function deletesubjectreocrd($srid, $tid) {
        $schcodeudise = $this->query("delete from  master.tchr_sub_taught where id='" . $srid . "' AND tchr_id='" . $tid . "'  ");
        return( $schcodeudise);
    }

    public function fwdtchrssubstaught($schid) {
        $qry = "select st.tchr_id,tchr_fname,tchr_mname,tchr_lname,ts_prof_level,ts_subject_medium,ts_subject_medium,
                ts_class_from,ts_class_to,ts_subject,st.asst_flag
                from master.tchr_sub_taught st,master.tch_master tm
                where st.asst_flag='E' and schl_id='" . $schid . "'
                and st.tchr_id=tm.tchr_id order by tchr_id";

        $res = $this->query($qry);

        return $res;
    }

    public function clusterfwdtchrssubstaught($tchrid) {
        $qry = "select st.tchr_id,tchr_fname,tchr_mname,tchr_lname,ts_prof_level,ts_subject_medium,ts_subject_medium,
                ts_class_from,ts_class_to,ts_subject,st.asst_flag
                from master.tchr_sub_taught st,master.tch_master tm
                where st.asst_flag='F' 
                and st.tchr_id='" . $tchrid . "'
                and st.tchr_id=tm.tchr_id order by tchr_id";

        $res = $this->query($qry);

        return $res;
    }

    public function rqstrtntchrsst($tchrid) {
        $qry = "select tm.tchr_id,ts_prof_level,ts_subject_medium,ts_class_from,ts_class_to,
            ts_subject,st.asst_flag,tchr_fname,tchr_mname,tchr_lname,ts_remarks
            from master.tchr_sub_taught st,master.tch_master tm
            where st.asst_flag='V' 
            and st.tchr_id='" . $tchrid . "'
            and st.tchr_id=tm.tchr_id order by tchr_id";

        $res = $this->query($qry);

        return $res;
    }

    public function getrtnflag() {
        $flag = $this->query("SELECT distinct schl_id  
                            FROM master.tchr_sub_taught ts,master.tch_master tm
                            where ts.asst_flag='T'
                            and ts.tchr_id=tm.tchr_id");

        return($flag);
    }

    public function clusterrtntchrsst($tchrid) {
        $qry = "select tm.tchr_id,ts_prof_level,ts_subject_medium,ts_class_from,ts_class_to,
            ts_subject,st.asst_flag,tchr_fname,tchr_mname,tchr_lname,ts_remarks
            from master.tchr_sub_taught st,master.tch_master tm
            where st.asst_flag='T' and 
            st.tchr_id='" . $tchrid . "'
            and st.tchr_id=tm.tchr_id order by tchr_id";

        $res = $this->query($qry);

        return $res;
    }

    public function findmedium($prof_level, $user_id) {

        if (isset($prof_level) && $prof_level != '') {
            $from = 0;
            $to = 0;
            if ($prof_level === '1') {
                $from = 1;
                $to = 5;
            } else if ($prof_level === '2') {
                $from = 6;
                $to = 8;
            } else if ($prof_level === '3') {
                $from = 1;
                $to = 8;
            } else if ($prof_level === '5') {
                $from = 9;
                $to = 10;
            } else if ($prof_level === '6') {
                $from = 11;
                $to = 12;
            } else if ($prof_level === '7') {
                $from = 6;
                $to = 10;
            } else if ($prof_level === '8') {
                $from = 9;
                $to = 12;
            }

            if ($from === 9 && $to === 12) {

                $result = $this->query(" (select distinct(tmedium.medinstr_id), medinstr_desc
from  master.tchr_medium as tmedium
INNER JOIN master.shala_standard_medium_subject as subix ON tmedium.medinstr_id = subix.medium  AND (CAST(subix.standard as integer) >= $from and CAST(subix.standard as integer)  <= $to )
where subix.schl_id = '" . $user_id . "' )
union
(select distinct(tmedium.medinstr_id), medinstr_desc
from  master.tchr_medium as tmedium
INNER JOIN master.shala_standard_medium_subject_xi_xii as ab ON  tmedium.medinstr_id = ab.medium AND (CAST( ab.standard as integer) >= $from and CAST( ab.standard as integer)  <= $to )
where ab.schl_id = '" . $user_id . "' ) ");
            } else if ($from === 11 && $to === 12) {
                $result = $this->query("select distinct(tmedium.medinstr_id),medinstr_desc
from master.shala_standard_medium_subject_xi_xii as ab, master.tchr_medium as tmedium
where schl_id = '" . $user_id . "' and   tmedium.medinstr_id = ab.medium and (CAST(standard as integer) >= $from and CAST(standard as integer)  <= $to)");
            } else {

                $result = $this->query("select distinct(tmedium.medinstr_id),medinstr_desc
from master.shala_standard_medium_subject as ab, master.tchr_medium as tmedium
where ab.schl_id = '" . $user_id . "' and   tmedium.medinstr_id = ab.medium and (CAST(standard as integer) >= $from and CAST(standard as integer)  <= $to)");
            }

            if ($result <> NULL) {
                return $result;
            } else {
                return 0;
            }
        }
    }

}

?>