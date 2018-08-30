<?php

class FindClusName extends AppModel{
   public $useDbConfig = 'default'; 
   var $name = "FindSchoolName"; 
   var $useTable ='steps_cluster'; //db= shala_live schema= udise
   
 public function getclusname($inClauscodeStr){
     
     
    //echo "select DISTINCT ON(cluname) clucd,cluname from udise.sanch_cluster where clucd='$inClauscodeStr'";
     //die();
     $cluscodesch=$this->query("select DISTINCT ON(cluname) clucd,cluname from shala_live.steps_cluster where clucd IN " .$inClauscodeStr. ";");
    return($cluscodesch);
 } 
 public function getcluwsname ($inClaucdStr){
     
        $clunamew=$this->query("select DISTINCT ON(cluname) clucd,cluname from shala_live.steps_cluster where clucd IN " .$inClaucdStr. ";");
    return($clunamew);
       
   }
   
}

?>