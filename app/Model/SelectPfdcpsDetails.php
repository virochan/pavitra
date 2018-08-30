<?php

class SelectPfdcpsDetails extends AppModel {
        public $useDbConfig = 'use_db_Tech_master';
        var  $name= "SelectPfdcpsDetails";
        var $useTable = 'tchr_pfnps'; //db=Teacher schema=master
        
        public function updatedetsg($tchr_id,$atype,$amntd,$pfseries,$pfaccno,$rmks,$timestamp,$user){
             $tchr_id=trim($tchr_id);
             $atype=trim($atype);
             $amntd=trim($amntd);
             $pfseries=trim($pfseries);
             $pfaccno=trim($pfaccno);
             $rmks=trim($rmks);
             $user=trim($user);
            $qry="UPDATE master.tchr_pfnps
                    SET tp_acct_type='".$atype."', tp_acct_maint=$amntd, tp_pf_nps_series='".$pfseries."', 
                        tp_pf_no='".$pfaccno."', upd_dtstamp='".$timestamp."',
                        asst_auth=$user, tp_remarks='".$rmks."'
                  WHERE tchr_id='".$tchr_id."'";
           
           $res=$this->query($qry);
            if ($res <> NULL) {
                return $res;
            } else {
                return 0;
            }
        }
        public function updatedetsd($tchr_id,$atype,$amntd,$pfseries,$pfaccno,$rmks,$timestamp,$user){
             $tchr_id=trim($tchr_id);
             $atype=trim($atype);
             $amntd=trim($amntd);
             $pfseries=trim($pfseries);
             $pfaccno=trim($pfaccno);
             $rmks=trim($rmks);
             $user=trim($user);
            $qry="UPDATE master.tchr_pfnps
                    SET tp_acct_type='".$atype."', tp_acct_maint=$amntd, tp_pf_nps_series='".$pfseries."', 
                        tp_ppan_no='".$pfaccno."', upd_dtstamp='".$timestamp."',
                        asst_auth=$user, tp_remarks='".$rmks."'
                  WHERE tchr_id='".$tchr_id."'";
        
           $res=$this->query($qry);
            if ($res <> NULL) {
                return $res;
            } else {
                return 0;
            }
        }
        public function fwdpftchrdtls($schcd){
              $qry="SELECT m.tchr_id,tchr_fname,tchr_mname,tchr_lname,pf_type_desc,pf_agency_desc,tp_pf_nps_series,tp_pf_no,tp_ppan_no
                    FROM master.tch_master m
                    INNER JOIN master.tchr_pfnps pf ON m.tchr_id = pf.tchr_id 
                    INNER JOIN master.pf_agency_mast pfm ON pf_type = tp_acct_type and  pf_agency=pf.tp_acct_maint
                    where pf.asst_flag = 'E' and m.schl_id = '".$schcd."'
                    order by m.tchr_fname";
                $res=$this->query($qry);
            
                if ($res <> NULL) {
                    return $res;
                } else {
                    return 0;
                }
        }
        
        public function getflag() {
            $flag = $this->query("SELECT distinct schl_id  
                                FROM  master.tchr_pfnps tp,master.tch_master tm
                                where tp.asst_flag='F'
                                and tp.tchr_id=tm.tchr_id");

            return($flag);
        }
        
         public function clusterfwdtchrspf($tchrid){
            $qry="SELECT m.tchr_id,tchr_fname,tchr_mname,tchr_lname,pf_type_desc,pf_agency_desc,tp_pf_nps_series,tp_pf_no,tp_ppan_no
                    FROM master.tch_master m
                    INNER JOIN master.tchr_pfnps pf ON m.tchr_id = pf.tchr_id 
                    INNER JOIN master.pf_agency_mast pfm ON pf_type = tp_acct_type and  pf_agency=pf.tp_acct_maint
                    where pf.asst_flag = 'F' and m.tchr_id = '".$tchrid."'
                    order by m.tchr_fname";
          
           
            $res=$this->query($qry);
            return $res;
        }
         public function rqstrtntchrspf($tchrid){
            $qry="SELECT m.tchr_id,tchr_fname,tchr_mname,tchr_lname,pf_type_desc,pf_agency_desc,tp_pf_nps_series,tp_pf_no,tp_ppan_no,tp_remarks
                    FROM master.tch_master m
                    INNER JOIN master.tchr_pfnps pf ON m.tchr_id = pf.tchr_id 
                    INNER JOIN master.pf_agency_mast pfm ON pf_type = tp_acct_type and  pf_agency=pf.tp_acct_maint
                    where pf.asst_flag = 'V' and m.tchr_id = '".$tchrid."'
                    order by m.tchr_fname";

            $res=$this->query($qry);

            return $res;
        }
          public function getrtnflag() {
            $flag = $this->query("SELECT distinct schl_id  
                                FROM  master.tchr_pfnps tp,master.tch_master tm
                                where tp.asst_flag='T'
                                and tp.tchr_id=tm.tchr_id");

            return($flag);
         }
         public function clusterrtntchrspf($tchrid){
            $qry="SELECT m.tchr_id,tchr_fname,tchr_mname,tchr_lname,pf_type_desc,pf_agency_desc,tp_pf_nps_series,tp_pf_no,tp_ppan_no,tp_remarks
                    FROM master.tch_master m
                    INNER JOIN master.tchr_pfnps pf ON m.tchr_id = pf.tchr_id 
                    INNER JOIN master.pf_agency_mast pfm ON pf_type = tp_acct_type and  pf_agency=pf.tp_acct_maint
                    where pf.asst_flag = 'T' and m.tchr_id = '".$tchrid."'
                    order by m.tchr_fname";

            $res=$this->query($qry);

            return $res;
        }
}

