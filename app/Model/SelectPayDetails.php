<?php

class SelectPayDetails extends AppModel {
        public $useDbConfig = 'use_db_Tech_master';
        var  $name= "SelectPayDetails";
        var $useTable = 'tchr_pay'; //db=Teacher schema=master
        
        
        public function validationPayment($data){
            $errorstr='';
            if(isset($data['paycomm'])){            // Check Pay Commission
                if($data['paycomm']==''){
                   $errorstr.='<li>Please Select Pay Commission</li>'; 
                }
            }else{
                 $errorstr.='<li>Please Select Pay Commission</li>';
            }
            if(isset($data['payscale'])){            // Check Pay Commission Scale
                if($data['payscale']==''){
                   $errorstr.='<li>Please Select Pay Scale</li>'; 
                }
            }else{
                 $errorstr.='<li>Please Select Pay Scale</li>';
            }
            if(isset($data['pbasic'])){            // Check Basic Pay
                if($data['pbasic']==''){
                   $errorstr.='<li>Please Enter Basic Pay</li>'; 
                }
            }else{
                 $errorstr.='<li>Please Enter Basic Pay</li>';
            }
            if(isset($data['pwefdt'])){            // Check With Effect Date
               if($data['pwefdt']==''){
                    $errorstr.='<li>Please Enter With Effect Date</li>';
               }
            }else{
                 $errorstr.='<li>Please Enter With Effect Date</li>';
            }
      
            return $errorstr;
          
        }

        public function insertsevak($tchr_id,$paycom,$payscale,$paybasic,$pwefdt,$nxtincrdt,$panno,$timestamp,$schcd,$rmks){
            $qry="INSERT INTO master.tchr_pay(
                            tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                            tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                            entry_dtstamp, asst_flag, asst_auth,tp_remarks)
                    VALUES ('".$tchr_id."'," .$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."',null,'".$panno."','".$timestamp."','E','".$schcd."','".$rmks."')";
          
            $res=$this->query($qry);
            
            
            if ($res <> NULL) {
                return $res;
            } else {
                return 0;
            }
        }
        public function insertetar($tchr_id,$paycom,$payscale,$paybasic,$pwefdt,$nxtincrdt,$panno,$timestamp,$schcd,$snrgrade,$snrgradedt,$selgrade,$selgradedt,$gradepay,$payinband,$rmks){
           if($paycom!=10 && $paycom!=11){
            if($snrgrade=='Y' && $selgrade=='Y'){ 
                    $qry="INSERT INTO master.tchr_pay(
                                    tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                                    tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                                    entry_dtstamp, asst_flag, asst_auth,tp_sen_grade_scale,
                                    tp_sen_grade_scale_dt,tp_sel_grade_scale,tp_sel_grade_scale_dt,tp_grade_pay,tp_pay_in_band,tp_remarks)
                            VALUES ('".$tchr_id."',".$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."','".$nxtincrdt."','".$panno."','".$timestamp."','E','"
                            .$schcd."','".$snrgrade."','".$snrgradedt."','".$selgrade."','".$selgradedt."',".$gradepay.",".$payinband.",'".$rmks."')";
                  
            }else if($snrgrade=='Y' && $selgrade=='N'){ 
                    $qry="INSERT INTO master.tchr_pay(
                                    tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                                    tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                                    entry_dtstamp, asst_flag, asst_auth,tp_sen_grade_scale,
                                    tp_sen_grade_scale_dt,tp_grade_pay,tp_pay_in_band,tp_remarks)
                            VALUES ('".$tchr_id."',".$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."','".$nxtincrdt."','".$panno."','".$timestamp."','E','"
                            .$schcd."','".$snrgrade."','".$snrgradedt."',".$gradepay.",".$payinband.",'".$rmks."')";
                   
            }else if($snrgrade=='N' && $selgrade=='Y'){ 
                    $qry="INSERT INTO master.tchr_pay(
                                    tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                                    tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                                    entry_dtstamp, asst_flag, asst_auth,tp_sel_grade_scale,
                                    tp_sel_grade_scale_dt,tp_grade_pay,tp_pay_in_band,tp_remarks)
                            VALUES ('".$tchr_id."',".$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."','".$nxtincrdt."','".$panno."','".$timestamp."','E','"
                            .$schcd."','".$selgrade."','".$selgradedt."',".$gradepay.",".$payinband.",'".$rmks."')";
                   
            }else if($snrgrade=='N' && $selgrade=='N'){ 
               
                    $qry="INSERT INTO master.tchr_pay(
                                    tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                                    tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                                    entry_dtstamp, asst_flag, asst_auth,tp_grade_pay,tp_pay_in_band,tp_remarks)
                            VALUES ('".$tchr_id."',".$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."','".$nxtincrdt."','".$panno."','".$timestamp."','E','"
                            .$schcd."',".$gradepay.",".$payinband.",'".$rmks."')";
                  
            }
           }else{
               if($paycom==10){
                            if($snrgrade=='Y' && $selgrade=='Y'){ 

                         $qry="INSERT INTO master.tchr_pay(
                                         tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                                         tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                                         entry_dtstamp, asst_flag, asst_auth,tp_sen_grade_scale,
                                         tp_sen_grade_scale_dt,tp_sel_grade_scale,tp_sel_grade_scale_dt,tp_remarks)
                                 VALUES ('".$tchr_id."',".$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."',null,'".$panno."','".$timestamp."','E','"
                                 .$schcd."','".$snrgrade."','".$snrgradedt."','".$selgrade."','".$selgradedt."','".$rmks."')";

                 }else if($snrgrade=='Y' && $selgrade=='N'){ 
                         $qry="INSERT INTO master.tchr_pay(
                                         tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                                         tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                                         entry_dtstamp, asst_flag, asst_auth,tp_sen_grade_scale,
                                         tp_sen_grade_scale_dt,tp_remarks)
                                 VALUES ('".$tchr_id."',".$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."',null,'".$panno."','".$timestamp."','E','"
                                 .$schcd."','".$snrgrade."','".$snrgradedt."','".$rmks."')";

                 }else if($snrgrade=='N' && $selgrade=='Y'){ 
                         $qry="INSERT INTO master.tchr_pay(
                                         tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                                         tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                                         entry_dtstamp, asst_flag, asst_auth,tp_sel_grade_scale,
                                         tp_sel_grade_scale_dt,tp_remarks)
                                 VALUES ('".$tchr_id."',".$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."',null,'".$panno."','".$timestamp."','E','"
                                 .$schcd."','".$selgrade."','".$selgradedt."','".$rmks."')";

                 }else if($snrgrade=='N' && $selgrade=='N'){ 

                         $qry="INSERT INTO master.tchr_pay(
                                         tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                                         tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                                         entry_dtstamp, asst_flag, asst_auth,tp_remarks)
                                 VALUES ('".$tchr_id."',".$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."',null,'".$panno."','".$timestamp."','E','"
                                 .$schcd."','".$rmks."')";

                    } 
               
               }else{
                    if($snrgrade=='Y' && $selgrade=='Y'){ 

                         $qry="INSERT INTO master.tchr_pay(
                                         tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                                         tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                                         entry_dtstamp, asst_flag, asst_auth,tp_sen_grade_scale,
                                         tp_sen_grade_scale_dt,tp_sel_grade_scale,tp_sel_grade_scale_dt,tp_remarks)
                                 VALUES ('".$tchr_id."',".$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."','".$nxtincrdt."','".$panno."','".$timestamp."','E','"
                                 .$schcd."','".$snrgrade."','".$snrgradedt."','".$selgrade."','".$selgradedt."','".$rmks."')";

                 }else if($snrgrade=='Y' && $selgrade=='N'){ 
                         $qry="INSERT INTO master.tchr_pay(
                                         tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                                         tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                                         entry_dtstamp, asst_flag, asst_auth,tp_sen_grade_scale,
                                         tp_sen_grade_scale_dt,tp_remarks)
                                 VALUES ('".$tchr_id."',".$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."','".$nxtincrdt."','".$panno."','".$timestamp."','E','"
                                 .$schcd."','".$snrgrade."','".$snrgradedt."','".$rmks."')";

                 }else if($snrgrade=='N' && $selgrade=='Y'){ 
                         $qry="INSERT INTO master.tchr_pay(
                                         tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                                         tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                                         entry_dtstamp, asst_flag, asst_auth,tp_sel_grade_scale,
                                         tp_sel_grade_scale_dt,tp_remarks)
                                 VALUES ('".$tchr_id."',".$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."','".$nxtincrdt."','".$panno."','".$timestamp."','E','"
                                 .$schcd."','".$selgrade."','".$selgradedt."','".$rmks."')";

                 }else if($snrgrade=='N' && $selgrade=='N'){ 

                         $qry="INSERT INTO master.tchr_pay(
                                         tchr_id, tp_pay_com_cd, tp_pay_scale_cd,
                                         tp_basic_pay, tp_incr_dt, tp_next_incr_dt, tp_pan_no,
                                         entry_dtstamp, asst_flag, asst_auth,tp_remarks)
                                 VALUES ('".$tchr_id."',".$paycom.",".$payscale.",".$paybasic.",'".$pwefdt."','".$nxtincrdt."','".$panno."','".$timestamp."','E','"
                                 .$schcd."','".$rmks."')";

                    } 
               
            }
           }
           
            $res=$this->query($qry);
            
            if ($res <> NULL) {
                return $res;
            } else {
                return 0;
            }
            
        }
        public function updatesevak($tchr_id,$paycom,$payscale,$paybasic,$pwefdt,$nxtincrdt,$panno,$timestamp,$schcd,$rmks){
              $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom,tp_pay_scale_cd=$payscale,tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt=null, 
                                tp_pan_no='".$panno."',upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',tp_grade_pay=null,tp_pay_in_band=null
                                WHERE tchr_id='".$tchr_id."'";
              $res=$this->query($qry);
            if ($res <> NULL) {
                return $res;
            } else {
                return 0;
            }
        }
        public function updateetar($tchr_id,$paycom,$payscale,$paybasic,$pwefdt,$nxtincrdt,$panno,$timestamp,$schcd,$snrgrade,$snrgradedt,$selgrade,$selgradedt,$gradepay,$payinband,$rmks){
            if($paycom!=10 && $paycom!=11){
                
             
                if($snrgrade=='Y' && $selgrade=='Y'){ 
                  //  echo "1";
                        $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom, tp_pay_scale_cd=$payscale, tp_pay_in_band=$payinband, 
                                    tp_grade_pay=$gradepay, tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt='".$nxtincrdt."', 
                                    tp_pan_no='".$panno."', tp_sen_grade_scale='".$snrgrade."', tp_sen_grade_scale_dt='".$snrgradedt."', tp_sel_grade_scale='".$selgrade."', 
                                    tp_sel_grade_scale_dt='".$selgradedt."',upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',asst_flag='E'
                              WHERE tchr_id='".$tchr_id."'";

                }else if($snrgrade=='Y' && $selgrade=='N'){ 
                  //   echo "2";
                        $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom, tp_pay_scale_cd=$payscale, tp_pay_in_band=$payinband, 
                                    tp_grade_pay=$gradepay, tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt='".$nxtincrdt."', 
                                    tp_pan_no='".$panno."', tp_sen_grade_scale='".$snrgrade."', tp_sen_grade_scale_dt='".$snrgradedt."', tp_sel_grade_scale='N', 
                                    tp_sel_grade_scale_dt=null,upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',asst_flag='E'
                              WHERE tchr_id='".$tchr_id."'";

                }else if($snrgrade=='N' && $selgrade=='Y'){ 
                   
                        $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom, tp_pay_scale_cd=$payscale, tp_pay_in_band=$payinband, 
                                    tp_grade_pay=$gradepay, tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt='".$nxtincrdt."', 
                                    tp_pan_no='".$panno."', tp_sen_grade_scale='N', tp_sen_grade_scale_dt=null, tp_sel_grade_scale='".$selgrade."', 
                                    tp_sel_grade_scale_dt='".$selgradedt."',upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',asst_flag='E'
                              WHERE tchr_id='".$tchr_id."'";
                }else if($snrgrade=='N' && $selgrade=='N'){ 
                  //   echo "4";
                        $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom, tp_pay_scale_cd=$payscale, tp_pay_in_band=$payinband, 
                                    tp_grade_pay=$gradepay, tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt='".$nxtincrdt."', 
                                    tp_pan_no='".$panno."', tp_sen_grade_scale='N', tp_sen_grade_scale_dt=null, tp_sel_grade_scale='N', 
                                    tp_sel_grade_scale_dt=null,upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',asst_flag='E'
                              WHERE tchr_id='".$tchr_id."'";
                }
            }else{
                 if($paycom!=10){  
                  if($snrgrade=='Y' && $selgrade=='Y'){ 
                  //     echo "5";
                        $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom, tp_pay_scale_cd=$payscale, tp_pay_in_band=null, 
                                    tp_grade_pay=null, tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt='".$nxtincrdt."', 
                                    tp_pan_no='".$panno."', tp_sen_grade_scale='".$snrgrade."', tp_sen_grade_scale_dt='".$snrgradedt."', tp_sel_grade_scale='".$selgrade."', 
                                    tp_sel_grade_scale_dt='".$selgradedt."',upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',asst_flag='E'
                              WHERE tchr_id='".$tchr_id."'";

                }else if($snrgrade=='Y' && $selgrade=='N'){ 
                 //    echo "6";
                        $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom, tp_pay_scale_cd=$payscale, tp_pay_in_band=null, 
                                    tp_grade_pay=null, tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt='".$nxtincrdt."', 
                                    tp_pan_no='".$panno."', tp_sen_grade_scale='".$snrgrade."', tp_sen_grade_scale_dt='".$snrgradedt."', tp_sel_grade_scale='N', 
                                    tp_sel_grade_scale_dt=null,upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',asst_flag='E'
                              WHERE tchr_id='".$tchr_id."'";

                }else if($snrgrade=='N' && $selgrade=='Y'){ 
                 //   echo "7";
                        $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom, tp_pay_scale_cd=$payscale, tp_pay_in_band=null, 
                                    tp_grade_pay=null, tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt='".$nxtincrdt."', 
                                    tp_pan_no='".$panno."', tp_sen_grade_scale='N', tp_sen_grade_scale_dt=null, tp_sel_grade_scale='".$selgrade."', 
                                    tp_sel_grade_scale_dt='".$selgradedt."',upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',asst_flag='E'
                              WHERE tchr_id='".$tchr_id."'";
                }else if($snrgrade=='N' && $selgrade=='N'){ 
                    // echo "8";
                        $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom, tp_pay_scale_cd=$payscale, tp_pay_in_band=null, 
                                    tp_grade_pay=null, tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt='".$nxtincrdt."', 
                                    tp_pan_no='".$panno."', tp_sen_grade_scale='N', tp_sen_grade_scale_dt=null, tp_sel_grade_scale='N', 
                                    tp_sel_grade_scale_dt=null,upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',asst_flag='E'
                              WHERE tchr_id='".$tchr_id."'";
                }
                 }else{
                    if($snrgrade=='Y' && $selgrade=='Y'){ 
                  //     echo "5";
                        $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom, tp_pay_scale_cd=$payscale, tp_pay_in_band=null, 
                                    tp_grade_pay=null, tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt=null, 
                                    tp_pan_no='".$panno."', tp_sen_grade_scale='".$snrgrade."', tp_sen_grade_scale_dt='".$snrgradedt."', tp_sel_grade_scale='".$selgrade."', 
                                    tp_sel_grade_scale_dt='".$selgradedt."',upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',asst_flag='E'
                              WHERE tchr_id='".$tchr_id."'";

                }else if($snrgrade=='Y' && $selgrade=='N'){ 
                 //    echo "6";
                        $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom, tp_pay_scale_cd=$payscale, tp_pay_in_band=null, 
                                    tp_grade_pay=null, tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt=null, 
                                    tp_pan_no='".$panno."', tp_sen_grade_scale='".$snrgrade."', tp_sen_grade_scale_dt='".$snrgradedt."', tp_sel_grade_scale='N', 
                                    tp_sel_grade_scale_dt=null,upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',asst_flag='E'
                              WHERE tchr_id='".$tchr_id."'";

                }else if($snrgrade=='N' && $selgrade=='Y'){ 
                 //   echo "7";
                        $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom, tp_pay_scale_cd=$payscale, tp_pay_in_band=null, 
                                    tp_grade_pay=null, tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt=null, 
                                    tp_pan_no='".$panno."', tp_sen_grade_scale='N', tp_sen_grade_scale_dt=null, tp_sel_grade_scale='".$selgrade."', 
                                    tp_sel_grade_scale_dt='".$selgradedt."',upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',asst_flag='E'
                              WHERE tchr_id='".$tchr_id."'";
                }else if($snrgrade=='N' && $selgrade=='N'){ 
                    // echo "8";
                        $qry="UPDATE master.tchr_pay
                                SET tp_pay_com_cd=$paycom, tp_pay_scale_cd=$payscale, tp_pay_in_band=null, 
                                    tp_grade_pay=null, tp_basic_pay=$paybasic, tp_incr_dt='".$pwefdt."', tp_next_incr_dt=null, 
                                    tp_pan_no='".$panno."', tp_sen_grade_scale='N', tp_sen_grade_scale_dt=null, tp_sel_grade_scale='N', 
                                    tp_sel_grade_scale_dt=null,upd_dtstamp='".$timestamp."',tp_remarks='".$rmks."',asst_flag='E'
                              WHERE tchr_id='".$tchr_id."'";
                } 
                 }
                
            }
           
            $res=$this->query($qry);
            
            if ($res <> NULL) {
                return $res;
            } else {
                return 0;
            }
            
        }
        
        
        
        public function fwdpaytchrdtls($schcd){
              $qry="SELECT m.tchr_id,tchr_fname,tchr_mname,tchr_lname,code_text,psc_dscr,tp_pay_in_band,tp_grade_pay,tp_basic_pay,tp_pan_no
                    FROM master.tch_master m
                    INNER JOIN master.tchr_pay pay ON m.tchr_id = pay.tchr_id 
                    INNER JOIN master.Cddir cd ON tp_pay_com_cd = cd.code_value::numeric and cd.code_type='PC'
                    INNER JOIN master.pay_scale ps ON tp_pay_scale_cd=ps.psc_scale_cd and tp_pay_com_cd=ps.psc_paycomm_cd
                    where pay.asst_flag = 'E' and m.schl_id = '".$schcd."'
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
                                FROM  master.tchr_pay tp,master.tch_master tm
                                where tp.asst_flag='F'
                                and tp.tchr_id=tm.tchr_id");

            return($flag);
        }
        
        public function clusterfwdtchrspay($tchrid){
            $qry="SELECT m.tchr_id,tchr_fname,tchr_mname,tchr_lname,code_text,psc_dscr,tp_pay_in_band,tp_grade_pay,tp_basic_pay,tp_pan_no
                    FROM master.tch_master m
                    INNER JOIN master.tchr_pay pay ON m.tchr_id = pay.tchr_id 
                    INNER JOIN master.Cddir cd ON tp_pay_com_cd = cd.code_value::numeric and cd.code_type='PC'
                    INNER JOIN master.pay_scale ps ON tp_pay_scale_cd=ps.psc_scale_cd and tp_pay_com_cd=ps.psc_paycomm_cd
                    where pay.asst_flag = 'F' and pay.tchr_id = '".$tchrid."'
                    order by m.tchr_fname";

            $res=$this->query($qry);

            return $res;
        }
        
        
        public function rqstrtntchrspay($tchrid){
            $qry="SELECT m.tchr_id,tchr_fname,tchr_mname,tchr_lname,code_text,psc_dscr,tp_pay_in_band,tp_grade_pay,tp_remarks,tp_basic_pay,tp_pan_no
                    FROM master.tch_master m
                    INNER JOIN master.tchr_pay pay ON m.tchr_id = pay.tchr_id 
                    INNER JOIN master.Cddir cd ON tp_pay_com_cd = cd.code_value::numeric and cd.code_type='PC'
                    INNER JOIN master.pay_scale ps ON tp_pay_scale_cd=ps.psc_scale_cd and tp_pay_com_cd=ps.psc_paycomm_cd
                    where pay.asst_flag = 'V' and pay.tchr_id = '".$tchrid."'
                    order by m.tchr_fname";

            $res=$this->query($qry);

            return $res;
        }
        
         public function getrtnflag() {
            $flag = $this->query("SELECT distinct schl_id  
                                FROM  master.tchr_pay tp,master.tch_master tm
                                where tp.asst_flag='T'
                                and tp.tchr_id=tm.tchr_id");

            return($flag);
         }
         
        public function clusterrtntchrspay($tchrid){
            $qry="SELECT m.tchr_id,tchr_fname,tchr_mname,tchr_lname,code_text,psc_dscr,tp_pay_in_band,tp_grade_pay,tp_remarks,tp_basic_pay,tp_pan_no
                    FROM master.tch_master m
                    INNER JOIN master.tchr_pay pay ON m.tchr_id = pay.tchr_id 
                    INNER JOIN master.Cddir cd ON tp_pay_com_cd = cd.code_value::numeric and cd.code_type='PC'
                    INNER JOIN master.pay_scale ps ON tp_pay_scale_cd=ps.psc_scale_cd and tp_pay_com_cd=ps.psc_paycomm_cd
                    where pay.asst_flag = 'T' and pay.tchr_id = '".$tchrid."'
                    order by m.tchr_fname";

            $res=$this->query($qry);

            return $res;
        }
    
}

