<?php

class CasteValidAuthMast extends AppModel {

    var $name = 'CasteValidAuthMast';
    public $useDbConfig = 'use_db_Tech_master';
    public $useTable = 'caste_valid_auth_mast';  //db=Teacher schema=master
    
    /*save certificate data*/
    public function savedata($auth_cd,$auth_name,$qtyp){
             $qry="INSERT INTO master.caste_valid_auth_mast(
                    auth_cd, auth_name, auth_caste_cd)
            VALUES (".$auth_cd.",'".$auth_name."','".$qtyp."')";
             $res=$this->query($qry);
             if($res<>null){
                 return 1;
             }else{
                 return 0;
             }
             
         }
      public function maximum($qtyp){
             $qry="SELECT max(auth_cd)
                    FROM master.caste_valid_auth_mast
                  where auth_caste_cd='$qtyp'";
                         
                               $res=$this->query($qry);
                               if($res<>null){
                                   return $res;
                               }else{
                                   return 0;
                               }
             
         }     
        /*update certificate data*/ 
         public function updtdata($auth_cd,$auth_name){
            $qry=" UPDATE master.caste_valid_auth_mast
                   SET auth_name='".$auth_name."'
                   WHERE auth_cd=".$auth_cd;
            
             $res=$this->query($qry);
             if($res<>null){
                 return 1;
             }else{
                 return 0;
             }
         }

}
