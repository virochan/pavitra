<?php

class UdiseSubTaught extends AppModel {

    public $useDbConfig = 'use_db_udise_data';
    var $name = "UdiseSubTaught";
    var $useTable = 'shala_tchsub_taught'; //db=Teacher schema=udise_data

    
    public function getudise(){
      $qry="SELECT distinct(tchsubtaught_parent),tchsubtaught_id,tchsubtaught_desc
            FROM udise_data.shala_tchsub_taught
            order by tchsubtaught_id
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