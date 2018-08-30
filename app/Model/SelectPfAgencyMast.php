<?php

class SelectPfAgencyMast extends AppModel {

    public $useDbConfig = 'use_db_Tech_master';
    var $name = "SelectPfAgencyMast";
    var $useTable = 'pf_agency_mast'; //db=Teacher schema=master
//    public $virtualFields = array('code_type_value' => 'CONCAT(Cddir.code_type|| \'-\' ||Cddir.code_value)'); //Cddir.=model name

}
?>
