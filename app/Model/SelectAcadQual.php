<?php
class SelectAcadQual extends AppModel {
     public $useDbConfig = 'default';
    var $name = "SelectAcadQual";
    var $useTable = 'shala_tchaqual'; //db=shala_live schema=master
    
    public function getquallvls($qtyp){
      $qry="SELECT tchaqual_id, tchaqual_desc,tchaqual_type FROM master.shala_tchaqual
               where tchaqual_type='".$qtyp."'
               ";
      
      $res=$this->query($qry);
      if($res <> NULL){
          return $res;
      }else{
          return 0;
      }
      
    }
    
}
?>