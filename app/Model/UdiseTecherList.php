<?php
class UdiseTecherList extends AppModel {
     
    public $useDbConfig = 'default';
    var $useTable = 'shala_teacher'; //db=shala_live schema=udise
    var $name = "UdiseTecherList";
    
    public function getUnmapTchUdise($schcode, $inClausStr) { //TO Fetch Shalaarth Records
           $query = "SELECT schcd, ac_year, tchcd, slno, tchname, sex, dob, caste, category, 
       yoj, qual_acad, qual_prof, cls_taught, main_taught1, math_upto, 
       eng_upto, trn_brc, trn_crc, trn_diet, trn_other, nontch_ass, 
       main_taught2, supvar1, supvar2, supvar3, supvar4, supvar5, supvar6, 
       supvar7, supvar8, supvar9, supvar10, checkbit, workingsince, 
       post_status, disability_type, deputation_yn, scienceupto, cwsntrained_yn, 
       appointsub, stream, aadhaar
  FROM shala_live.shala_teacher where schcd ='" . $schcode . "' AND ac_year = '2013-14' AND tchcd IN $inClausStr";
//       exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
}
?>