<?php

class PayScaleMaster extends AppModel {

    var $name = 'PayScaleMaster';
    public $useDbConfig = 'use_db_Tech_master';
    public $useTable = 'pay_scale';  //db=Teacher schema=master
    
    public function maximum($pcode){
             $qry="select max(psc_scale_cd)+1 as pcode
                    from master.pay_scale
                    where psc_paycomm_cd = '".$pcode ."'";
                         
                               $res=$this->query($qry);
                               if($res<>null){
                                   return $res;
                               }else{
                                   return 0;
                               }
             
         }        
     
     public function pcomgrid($pay){
       $qry="SELECT psc_scale_cd, pfm_for_cd, psc_group_cd, psc_lo_limit, 
       psc_inc1, psc_stage1, psc_inc2, psc_stage2, psc_inc3, psc_stage3, 
       psc_inc4, psc_up_limit, psc_dscr, psc_wef,psc_gis_group_cd,psc_gradepay
       FROM master.pay_scale
       where psc_paycomm_cd = '".$pay ."'";
                         
                               $res=$this->query($qry);
                               if($res<>null){
                                   return $res;
                               }else{
                                   return 0;
                               }  
     }

     
}
