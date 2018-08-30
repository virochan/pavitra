<?php

class FindSchoolName extends AppModel {
    var $name = 'FindSchoolName';
    public $useDbConfig = 'default';
    var $useTable = 'steps_keyvar'; //db= shala_live schema= udise

    public function get($clucd, $inClausStr) {
//       echo  "SELECT DISTINCT ON(schname) schname,schcd FROM udise.shala_keyvar where clucd='$clucd' AND schcd IN " . $inClausStr . ";";
//       exit();
        $schname = $this->query("SELECT DISTINCT ON(schname) schname,schcd FROM shala_live.steps_keyvar where clucd='$clucd' AND schcd IN " . $inClausStr . ";");
        return($schname);
    }
    
     public function get_new($clucd, $inClausStr) {
//       echo  "SELECT DISTINCT ON(schname) schname,schcd FROM udise.shala_keyvar where clucd='$clucd' AND schcd IN " . $inClausStr . ";";
//       exit();
        $schname = $this->query("SELECT DISTINCT ON(school_name) school_name as schname,schcd FROM shala.shala_all_school WHERE clucd='$clucd' AND schcd IN " . $inClausStr . ";");
        return($schname);
    }
    
      public function get_new_eo_verify($clucd, $inClausStr) {
//       echo  "SELECT DISTINCT ON(school_name) school_name as schname,schcd FROM shala.shala_all_school WHERE clucd='$clucd' AND schcd IN " . $inClausStr . ";";
//       exit();
        $schname = $this->query("SELECT DISTINCT ON(school_name) school_name as schname,schcd FROM shala.shala_all_school WHERE clucd='$clucd' AND schcd IN " . $inClausStr . ";");
        return($schname);
    }
    

    public function getsclname($clucd, $inClausStr) {
        $schname = $this->query("SELECT DISTINCT ON(schname) schname,schcd FROM shala_live.steps_keyvar where clucd='$clucd' AND schcd IN " . $inClausStr . ";");
        return($schname);
    }

    public function getscolnm($clucd, $inClausStr) {
        $schname = $this->query("SELECT DISTINCT ON(schname) schname,schcd FROM shala_live.steps_keyvar where clucd='$clucd' AND schcd IN " . $inClausStr . ";");
        return($schname);
    }

    public function getcluscode($test, $inClausStr) {
        $cluscodesch = $this->query("select clucd from shala_live.steps_keyvar where clucd LIKE '$test%' AND schcd IN " . $inClausStr . ";");
        return($cluscodesch);
    }

    public function getchkw($id, $inClausStr) {

        $cluswcd = $this->query("select clucd from shala_live.steps_keyvar where clucd LIKE '$id%' AND schcd IN " . $inClausStr . ";");
        return($cluswcd);
    }

    public function getclucode($cluster_id, $chkcluscode) {

        $getcodesch = $this->query("select DISTINCT ON(schname) schcd,schname from shala_live.steps_keyvar where clucd='$cluster_id' AND schcd IN " . $chkcluscode . "; ");
        return($getcodesch);
    }

    public function getclucodew($cluswcd, $chkcluscodew) {

        $getcodeschw = $this->query("select DISTINCT ON(schname) schcd,schname from shala_live.steps_keyvar where clucd='$cluswcd' AND schcd IN " . $chkcluscodew . "; ");
        return($getcodeschw);
    }
    
    public function getschools($clucd) {

        $getcodeschw = $this->query("select DISTINCT ON(schname) schcd,schname from shala_live.steps_keyvar where clucd='$clucd'; ");
        return($getcodeschw);
    }
    public function getschname($schl_id) {

        $getcodesch = $this->query("select DISTINCT ON(schname) schcd,schname from shala_live.steps_keyvar where schcd='$schl_id'");
        return($getcodesch);
    }
    
//       public function getschoolnamepara($clucd, $inClausStr) {
//        $schname = $this->query("SELECT DISTINCT ON(school_name) school_name,schcd FROM shala.shala_all_school where clucd='$clucd' AND schcd IN " . $inClausStr . ";");
//        return($schname);
//    }

}

?>