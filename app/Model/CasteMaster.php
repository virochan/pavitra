<?php
class CasteMaster extends AppModel{
   public $useDbConfig = 'use_db_Tech_master';
   var $name= 'CasteMaster';
   var $useTable = 'tchr_caste_mast';  //db=Teacher schema=master
   
   public function getdata($category_id) 
   {
	   $chkdata = $this->query("SELECT cst_code,cst_desc FROM master.tchr_caste_mast where  cst_category_cd='".$category_id."' ");
	   return($chkdata);
   }
   
    public function getcastname($ta_categ,$ta_caste) 
   {    
        $castname[] = $this->query("SELECT cst_code,cst_desc FROM master.tchr_caste_mast WHERE cst_category_cd='".$ta_categ."' AND cst_code='".$ta_caste."' ");
	   return($castname);
   }
}

