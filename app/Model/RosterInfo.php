
<?php

class RosterInfo extends AppModel {

    public $useDbConfig = 'use_db_samayojan_data';
    var $name = "RosterInfo";
    var $useTable = 'roster_info'; //  schema= samayojan

    public function showSansthaRoasterInfo($eo_code, $sanstha_code) {
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        $query = "SELECT  RI.sanstha_code, SBI.sanstha_name,
                        RI.sc_sanc_tot, RI.st_sanc_tot, RI.vja_sanc_tot, RI.ntb_sanc_tot, RI.ntc_sanc_tot,RI.ntd_sanc_tot, RI.obc_sanc_tot, RI.sbc_sanc_tot, RI.gen_sanc_tot,
                        RI.sc_work_tot, RI.st_work_tot, RI.vja_work_tot, RI.ntb_work_tot, RI.ntc_work_tot, RI.ntd_work_tot,   RI.obc_work_tot, RI.sbc_work_tot, RI.gen_work_tot, RI.roster_file_name,RI.rst_last_upd_dt,
                        RI.sc_smj_tot, RI.st_smj_tot, RI.vja_smj_tot, RI.ntb_smj_tot, RI.ntc_smj_tot, RI.ntd_smj_tot, RI.obc_smj_tot, RI.sbc_smj_tot, RI.gen_smj_tot,
                        RI.sc_ext_tot, RI.st_ext_tot, RI.vja_ext_tot, RI.ntb_ext_tot, RI.ntc_ext_tot, RI.ntd_ext_tot, RI.obc_ext_tot, RI.sbc_ext_tot, RI.gen_ext_tot
       
               FROM samayojan.roster_info as RI
               LEFT JOIN samayojan.sanstha_basic_info as SBI ON RI.sanstha_code = SBI.sanstha_code
                   WHERE 
                          RI.sanstha_code =  '" . $sanstha_code . "'   
                       AND RI.asst_flag ='V'
                       AND RI.ac_year = '$global_ac_year'
                       AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "'   ";
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateRoasterShift($tc_categ, $new_sanstha_id, $old_sanstha_id, $eo_code) {
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);
        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
        if ($tc_categ == '1') { //General
            $col_cond = 'gen_smj_tot';
        } else if ($tc_categ == '2') { //SC
            $col_cond = 'sc_smj_tot';
        } else if ($tc_categ == '3') { //ST
            $col_cond = 'st_smj_tot';
        } else if ($tc_categ == '4') { //OBC
            $col_cond = 'obc_smj_tot';
        } else if ($tc_categ == '10') { //VJA
            $col_cond = 'vja_smj_tot';
        } else if ($tc_categ == '12') { //SBC
            $col_cond = 'sbc_smj_tot';
        } else if ($tc_categ == '13') { //NTB
            $col_cond = 'ntb_smj_tot';
        } else if ($tc_categ == '14') { //NTC  
            $col_cond = 'ntc_smj_tot';
        } else if ($tc_categ == '15') { //NTD
            $col_cond = 'ntd_smj_tot';
        }

        $query = "UPDATE samayojan.roster_info
                SET $col_cond =$col_cond + 1
                WHERE  sanstha_code = '" . $new_sanstha_id . "'
                   AND staff_type = 1
                   AND ac_year = '$global_ac_year'
                   AND roster_edn_level='" . $roster_edn_level_cond . "' 
                  ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else
            return 0;
    }

    public function updateRoasterShiftRound0($option_roaster_caste_list_sanstha_lvl_sama, $option_excess_sanstha_list_sanstha_lvl_sama, $new_eo_code) {
        
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($new_eo_code, 0, 4);
        $sch_type = substr($new_eo_code, 6, 8);
        
        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
        if ($option_roaster_caste_list_sanstha_lvl_sama == '1') { //General
            $col_cond = 'gen_smj_tot';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '2') { //SC
            $col_cond = 'sc_smj_tot';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '3') { //ST
            $col_cond = 'st_smj_tot';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '4') { //OBC
            $col_cond = 'obc_smj_tot';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '10') { //VJA
            $col_cond = 'vja_smj_tot';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '12') { //SBC
            $col_cond = 'sbc_smj_tot';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '13') { //NTB
            $col_cond = 'ntb_smj_tot';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '14') { //NTC  
            $col_cond = 'ntc_smj_tot';
        } else if ($option_roaster_caste_list_sanstha_lvl_sama == '15') { //NTD
            $col_cond = 'ntd_smj_tot';
        }

        $query = "UPDATE samayojan.roster_info
                SET $col_cond = $col_cond + 1
                WHERE        sanstha_code='" . $option_excess_sanstha_list_sanstha_lvl_sama . "'
                        AND staff_type=1
                        AND ac_year = '$global_ac_year'
                        AND roster_edn_level='" . $roster_edn_level_cond . "' 
                  ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else
            return 0;
    }

    public function showSansthaRoasterInfoRound2($eo_code, $sanstha_code) {
        $global_ac_year = Configure::read('global_ac_year');

        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        $query = "SELECT  RI.sanstha_code, SBI.sanstha_name,
       RI.sc_sanc_tot, RI.st_sanc_tot, RI.vja_sanc_tot, RI.ntb_sanc_tot, RI.ntc_sanc_tot,RI.ntd_sanc_tot, RI.obc_sanc_tot, RI.sbc_sanc_tot, RI.gen_sanc_tot,
       RI.sc_work_tot, RI.st_work_tot, RI.vja_work_tot, RI.ntb_work_tot, RI.ntc_work_tot, RI.ntd_work_tot,   RI.obc_work_tot, RI.sbc_work_tot, RI.gen_work_tot, RI.roster_file_name, RI.rst_last_upd_dt,  
       RI.sc_smj_tot, RI.st_smj_tot, RI.vja_smj_tot, RI.ntb_smj_tot,   RI.ntc_smj_tot, RI.ntd_smj_tot, RI.obc_smj_tot, RI.sbc_smj_tot, RI.gen_smj_tot,
       RI.sc_ext_tot, RI.st_ext_tot, RI.vja_ext_tot, RI.ntb_ext_tot, RI.ntc_ext_tot, RI.ntd_ext_tot, RI.obc_ext_tot, RI.sbc_ext_tot, RI.gen_ext_tot
               FROM samayojan.roster_info as RI
               LEFT JOIN samayojan.sanstha_basic_info as SBI ON RI.sanstha_code = SBI.sanstha_code
                   WHERE 
                        RI.sanstha_code =  '" . $sanstha_code . "'   
                    AND RI.asst_flag ='V'
                    AND RI.ac_year = '$global_ac_year'
                    AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "'   ";
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateRoasterShiftRound2($tc_categ, $new_sanstha_id, $old_sanstha_id, $eo_code) {
        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);
        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
        $col_cond = 'gen_smj_tot';
//        } else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_smj_tot';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_smj_tot';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_smj_tot';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_smj_tot';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_smj_tot';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_smj_tot';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_smj_tot';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_smj_tot';
//        }

        $query = "UPDATE samayojan.roster_info
                SET $col_cond =$col_cond + 1
                WHERE    sanstha_code='" . $new_sanstha_id . "'
                   AND   staff_type=1
                    AND ac_year = '$global_ac_year'
                   AND   roster_edn_level='" . $roster_edn_level_cond . "' 
                  ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else
            return 0;
    }

    public function showSansthaRoasterInfoRound3($eo_code, $sanstha_code) {
        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        $query = "SELECT  RI.sanstha_code, SBI.sanstha_name,
       RI.sc_sanc_tot, RI.st_sanc_tot, RI.vja_sanc_tot, RI.ntb_sanc_tot, RI.ntc_sanc_tot,RI.ntd_sanc_tot, RI.obc_sanc_tot, RI.sbc_sanc_tot, RI.gen_sanc_tot,
       RI.sc_work_tot, RI.st_work_tot, RI.vja_work_tot, RI.ntb_work_tot, RI.ntc_work_tot, RI.ntd_work_tot,   RI.obc_work_tot, RI.sbc_work_tot, RI.gen_work_tot, RI.roster_file_name, RI.rst_last_upd_dt, 
       RI.sc_smj_tot, RI.st_smj_tot, RI.vja_smj_tot, RI.ntb_smj_tot,   RI.ntc_smj_tot, RI.ntd_smj_tot, RI.obc_smj_tot, RI.sbc_smj_tot, RI.gen_smj_tot,
       RI.sc_ext_tot, RI.st_ext_tot, RI.vja_ext_tot, RI.ntb_ext_tot, RI.ntc_ext_tot, RI.ntd_ext_tot, RI.obc_ext_tot, RI.sbc_ext_tot, RI.gen_ext_tot
               FROM samayojan.roster_info as RI
               LEFT JOIN samayojan.sanstha_basic_info as SBI ON RI.sanstha_code = SBI.sanstha_code
                   WHERE 
                          RI.sanstha_code =  '" . $sanstha_code . "'   
                       AND RI.asst_flag ='V'
                       AND RI.ac_year = '$global_ac_year'
                       AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "'   ";
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateRoasterShiftRound3($tc_categ, $new_sanstha_id, $old_sanstha_id, $eo_code) {
        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);
        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        if ($tc_categ == '1') { //General
            $col_cond = 'gen_ext_tot';
        } else if ($tc_categ == '2') { //SC
            $col_cond = 'sc_ext_tot';
        } else if ($tc_categ == '3') { //ST
            $col_cond = 'st_ext_tot';
        } else if ($tc_categ == '4') { //OBC
            $col_cond = 'obc_ext_tot';
        } else if ($tc_categ == '10') { //VJA
            $col_cond = 'vja_ext_tot';
        } else if ($tc_categ == '12') { //SBC
            $col_cond = 'sbc_ext_tot';
        } else if ($tc_categ == '13') { //NTB
            $col_cond = 'ntb_ext_tot';
        } else if ($tc_categ == '14') { //NTC  
            $col_cond = 'ntc_ext_tot';
        } else if ($tc_categ == '15') { //NTD
            $col_cond = 'ntd_ext_tot';
        }

        $query = "UPDATE samayojan.roster_info
                SET $col_cond =$col_cond + 1
                WHERE    sanstha_code='" . $new_sanstha_id . "'
                   AND   staff_type=1
                   AND   ac_year = '$global_ac_year'
                   AND   roster_edn_level='" . $roster_edn_level_cond . "' 
                  ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else
            return 0;
    }

    public function showSansthaRoasterInfoRound4($eo_code, $sanstha_code) {
        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        $query = "SELECT  RI.sanstha_code, SBI.sanstha_name,
       RI.sc_sanc_tot, RI.st_sanc_tot, RI.vja_sanc_tot, RI.ntb_sanc_tot, RI.ntc_sanc_tot,RI.ntd_sanc_tot, RI.obc_sanc_tot, RI.sbc_sanc_tot, RI.gen_sanc_tot,
       RI.sc_work_tot, RI.st_work_tot, RI.vja_work_tot, RI.ntb_work_tot, RI.ntc_work_tot, RI.ntd_work_tot,RI.obc_work_tot, RI.sbc_work_tot, RI.gen_work_tot, RI.roster_file_name, RI.rst_last_upd_dt, 
       RI.sc_smj_tot, RI.st_smj_tot, RI.vja_smj_tot, RI.ntb_smj_tot,   RI.ntc_smj_tot, RI.ntd_smj_tot, RI.obc_smj_tot, RI.sbc_smj_tot, RI.gen_smj_tot,
       RI.sc_ext_tot, RI.st_ext_tot, RI.vja_ext_tot, RI.ntb_ext_tot, RI.ntc_ext_tot, RI.ntd_ext_tot, RI.obc_ext_tot, RI.sbc_ext_tot, RI.gen_ext_tot
               FROM samayojan.roster_info as RI
               LEFT JOIN samayojan.sanstha_basic_info as SBI ON RI.sanstha_code = SBI.sanstha_code
                   WHERE 
                          RI.sanstha_code =  '" . $sanstha_code . "'   
                       AND RI.asst_flag ='V'
                       AND RI.ac_year = '$global_ac_year'
                       AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "'   ";
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateRoasterShiftRound4($tc_categ, $new_sanstha_id, $old_sanstha_id, $eo_code) {
        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);
        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
        if ($tc_categ == '1') { //General
            $col_cond = 'gen_smj_tot';
        } else if ($tc_categ == '2') { //SC
            $col_cond = 'sc_smj_tot';
        } else if ($tc_categ == '3') { //ST
            $col_cond = 'st_smj_tot';
        } else if ($tc_categ == '4') { //OBC
            $col_cond = 'obc_smj_tot';
        } else if ($tc_categ == '10') { //VJA
            $col_cond = 'vja_smj_tot';
        } else if ($tc_categ == '12') { //SBC
            $col_cond = 'sbc_smj_tot';
        } else if ($tc_categ == '13') { //NTB
            $col_cond = 'ntb_smj_tot';
        } else if ($tc_categ == '14') { //NTC  
            $col_cond = 'ntc_smj_tot';
        } else if ($tc_categ == '15') { //NTD
            $col_cond = 'ntd_smj_tot';
        }

        $query = "UPDATE samayojan.roster_info
                SET $col_cond =$col_cond + 1
                WHERE    sanstha_code='" . $new_sanstha_id . "'
                   AND   staff_type=1
                   AND   ac_year = '$global_ac_year'
                   AND   roster_edn_level='" . $roster_edn_level_cond . "' 
                  ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else
            return 0;
    }

    public function showSansthaRoasterInfoRound5($eo_code, $sanstha_code) {
        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        $query = "SELECT  RI.sanstha_code, SBI.sanstha_name,
       RI.sc_sanc_tot, RI.st_sanc_tot, RI.vja_sanc_tot, RI.ntb_sanc_tot, RI.ntc_sanc_tot,RI.ntd_sanc_tot, RI.obc_sanc_tot, RI.sbc_sanc_tot, RI.gen_sanc_tot,
       RI.sc_work_tot, RI.st_work_tot, RI.vja_work_tot, RI.ntb_work_tot, RI.ntc_work_tot, RI.ntd_work_tot,RI.obc_work_tot, RI.sbc_work_tot, RI.gen_work_tot, RI.roster_file_name, RI.rst_last_upd_dt, 
       RI.sc_smj_tot, RI.st_smj_tot, RI.vja_smj_tot, RI.ntb_smj_tot,   RI.ntc_smj_tot, RI.ntd_smj_tot, RI.obc_smj_tot, RI.sbc_smj_tot, RI.gen_smj_tot,
       RI.sc_ext_tot, RI.st_ext_tot, RI.vja_ext_tot, RI.ntb_ext_tot, RI.ntc_ext_tot, RI.ntd_ext_tot, RI.obc_ext_tot, RI.sbc_ext_tot, RI.gen_ext_tot
               FROM samayojan.roster_info as RI
               LEFT JOIN samayojan.sanstha_basic_info as SBI ON RI.sanstha_code = SBI.sanstha_code
                   WHERE 
                          RI.sanstha_code =  '" . $sanstha_code . "'   
                       AND RI.asst_flag ='V'
                       AND RI.ac_year = '$global_ac_year'
                       AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "'   ";
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateRoasterShiftRound5($tc_categ, $new_sanstha_id, $old_sanstha_id, $eo_code) {
        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);
        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
//        if ($tc_categ == '1') { //General
        $col_cond = 'gen_smj_tot';
//        } else if ($tc_categ == '2') { //SC
//            $col_cond = 'sc_smj_tot';
//        } else if ($tc_categ == '3') { //ST
//            $col_cond = 'st_smj_tot';
//        } else if ($tc_categ == '4') { //OBC
//            $col_cond = 'obc_smj_tot';
//        } else if ($tc_categ == '10') { //VJA
//            $col_cond = 'vja_smj_tot';
//        } else if ($tc_categ == '12') { //SBC
//            $col_cond = 'sbc_smj_tot';
//        } else if ($tc_categ == '13') { //NTB
//            $col_cond = 'ntb_smj_tot';
//        } else if ($tc_categ == '14') { //NTC  
//            $col_cond = 'ntc_smj_tot';
//        } else if ($tc_categ == '15') { //NTD
//            $col_cond = 'ntd_smj_tot';
//        }

        $query = "UPDATE samayojan.roster_info
                SET $col_cond =$col_cond + 1
                WHERE    sanstha_code='" . $new_sanstha_id . "'
                   AND   staff_type=1
                   AND   ac_year = '$global_ac_year'
                   AND   roster_edn_level='" . $roster_edn_level_cond . "' 
                  ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else
            return 0;
    }

    public function showSansthaRoasterInfoRound6($eo_code, $sanstha_code) {
        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        $query = "SELECT  RI.sanstha_code, SBI.sanstha_name,
       RI.sc_sanc_tot, RI.st_sanc_tot, RI.vja_sanc_tot, RI.ntb_sanc_tot, RI.ntc_sanc_tot,RI.ntd_sanc_tot, RI.obc_sanc_tot, RI.sbc_sanc_tot, RI.gen_sanc_tot,
       RI.sc_work_tot, RI.st_work_tot, RI.vja_work_tot, RI.ntb_work_tot, RI.ntc_work_tot, RI.ntd_work_tot,RI.obc_work_tot, RI.sbc_work_tot, RI.gen_work_tot, RI.roster_file_name, RI.rst_last_upd_dt, 
       RI.sc_smj_tot, RI.st_smj_tot, RI.vja_smj_tot, RI.ntb_smj_tot,   RI.ntc_smj_tot, RI.ntd_smj_tot, RI.obc_smj_tot, RI.sbc_smj_tot, RI.gen_smj_tot,
       RI.sc_ext_tot, RI.st_ext_tot, RI.vja_ext_tot, RI.ntb_ext_tot, RI.ntc_ext_tot, RI.ntd_ext_tot, RI.obc_ext_tot, RI.sbc_ext_tot, RI.gen_ext_tot
               FROM samayojan.roster_info as RI
               LEFT JOIN samayojan.sanstha_basic_info as SBI ON RI.sanstha_code = SBI.sanstha_code
                   WHERE 
                          RI.sanstha_code =  '" . $sanstha_code . "'   
                       AND RI.asst_flag ='V'
                       AND RI.ac_year = '$global_ac_year'
                       AND RI.roster_edn_level =  '" . $roster_edn_level_cond . "'   ";
//        echo $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function updateRoasterShiftRound6($tc_categ, $new_sanstha_id, $old_sanstha_id, $eo_code) {
        $global_ac_year = Configure::read('global_ac_year');
        $dist_id = substr($eo_code, 0, 4);
        $sch_type = substr($eo_code, 6, 8);
        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        if ($tc_categ == '1') { //General
            $col_cond = 'gen_ext_tot';
        } else if ($tc_categ == '2') { //SC
            $col_cond = 'sc_ext_tot';
        } else if ($tc_categ == '3') { //ST
            $col_cond = 'st_ext_tot';
        } else if ($tc_categ == '4') { //OBC
            $col_cond = 'obc_ext_tot';
        } else if ($tc_categ == '10') { //VJA
            $col_cond = 'vja_ext_tot';
        } else if ($tc_categ == '12') { //SBC
            $col_cond = 'sbc_ext_tot';
        } else if ($tc_categ == '13') { //NTB
            $col_cond = 'ntb_ext_tot';
        } else if ($tc_categ == '14') { //NTC  
            $col_cond = 'ntc_ext_tot';
        } else if ($tc_categ == '15') { //NTD
            $col_cond = 'ntd_ext_tot';
        }

        $query = "UPDATE samayojan.roster_info
                SET $col_cond =$col_cond + 1
                WHERE    sanstha_code='" . $new_sanstha_id . "'
                   AND   staff_type=1
                   AND   ac_year = '$global_ac_year'
                   AND   roster_edn_level='" . $roster_edn_level_cond . "' 
                  ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else
            return 0;
    }

    public function updateRevertSamatyojanRoasterShiftSNN($tc_categ_old, $new_sanstha_code_new, $sanstha_code_old, $eo_code_old) {
        $dist_id = substr($eo_code_old, 0, 4);
        $sch_type = substr($eo_code_old, 6, 8);
        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }
        if ($tc_categ_old == '1') { //General
            $col_cond = 'gen_smj_tot';
        } else if ($tc_categ_old == '2') { //SC
            $col_cond = 'sc_smj_tot';
        } else if ($tc_categ_old == '3') { //ST
            $col_cond = 'st_smj_tot';
        } else if ($tc_categ_old == '4') { //OBC
            $col_cond = 'obc_smj_tot';
        } else if ($tc_categ_old == '10') { //VJA
            $col_cond = 'vja_smj_tot';
        } else if ($tc_categ_old == '12') { //SBC
            $col_cond = 'sbc_smj_tot';
        } else if ($tc_categ_old == '13') { //NTB
            $col_cond = 'ntb_smj_tot';
        } else if ($tc_categ_old == '14') { //NTC  
            $col_cond = 'ntc_smj_tot';
        } else if ($tc_categ_old == '15') { //NTD
            $col_cond = 'ntd_smj_tot';
        }

        $query = "UPDATE samayojan.roster_info
                SET $col_cond =$col_cond - 1
                WHERE    sanstha_code='" . $new_sanstha_code_new . "'
                   AND   staff_type = 1
                   AND   roster_edn_level='" . $roster_edn_level_cond . "' 
                  ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else
            return 0;
    }

    public function updateRevertSamatyojanRoasterShiftWSN($tc_categ_old, $new_sanstha_code_new, $sanstha_code_old, $eo_code_old) {
        $dist_id = substr($eo_code_old, 0, 4);
        $sch_type = substr($eo_code_old, 6, 8);

        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        $col_cond = 'gen_smj_tot';

        $query = "UPDATE samayojan.roster_info
                SET $col_cond =$col_cond - 1
                WHERE    sanstha_code='" . $new_sanstha_code_new . "'
                   AND   staff_type = 1
                   AND   roster_edn_level='" . $roster_edn_level_cond . "' 
                  ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else
            return 0;
    }

    public function updateRevertSamatyojanRoasterShiftWWS($tc_categ_old, $new_sanstha_code_new, $sanstha_code_old, $eo_code_old) {

        $dist_id = substr($eo_code_old, 0, 4);
        $sch_type = substr($eo_code_old, 6, 8);
        if ($sch_type == '01') { //P
            $roster_edn_level_cond = 'P';
        } else if ($sch_type == '02') { //S
            $roster_edn_level_cond = 'S';
        }

        if ($tc_categ_old == '1') { //General
            $col_cond = 'gen_ext_tot';
        } else if ($tc_categ_old == '2') { //SC
            $col_cond = 'sc_ext_tot';
        } else if ($tc_categ_old == '3') { //ST
            $col_cond = 'st_ext_tot';
        } else if ($tc_categ_old == '4') { //OBC
            $col_cond = 'obc_ext_tot';
        } else if ($tc_categ_old == '10') { //VJA
            $col_cond = 'vja_ext_tot';
        } else if ($tc_categ_old == '12') { //SBC
            $col_cond = 'sbc_ext_tot';
        } else if ($tc_categ_old == '13') { //NTB
            $col_cond = 'ntb_ext_tot';
        } else if ($tc_categ_old == '14') { //NTC  
            $col_cond = 'ntc_ext_tot';
        } else if ($tc_categ_old == '15') { //NTD
            $col_cond = 'ntd_ext_tot';
        }

        $query = "UPDATE samayojan.roster_info
                SET $col_cond = $col_cond - 1
                WHERE    sanstha_code = '" . $new_sanstha_code_new . "'
                   AND   staff_type = 1
                   AND   roster_edn_level='" . $roster_edn_level_cond . "' 
                  ";
//        echo "" . $query;
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else
            return 0;
    }

}

?>