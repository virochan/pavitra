<?php

App::uses('Sanitize', 'Utility');

function my_search($haystack) {
    $needle = 'value to search for';
    return(strpos($haystack, $needle)); // or stripos() if you want case-insensitive searching.
}

function multidimensional_array_sort($a, $b) {
    if ($a[0]["tchr_block_entry_dt"] == $b[0]["tchr_block_entry_dt"]) {
        return 0;
    }
    return ($a[0]["tchr_block_entry_dt"] < $b[0]["tchr_block_entry_dt"]) ? -1 : 1;
}

function multidimensional_array_sort1($a, $b) {
    if ($a[0]["code_text"] == $b[0]["code_text"]) { //tchr_block_entry_dt
        return 0;
    }
    return ($a[0]["code_text"] < $b[0]["code_text"]) ? -1 : 1;
}

function LeapYear($year) {
    if ((($year % 4 == 0) && ( (!($year % 100 == 0)) || ($year % 400 == 0)))) {
        return 1;
    }
    return 0;
}

function getLastDayOfMonth($month, $flg_leap) {
    if ($flg_leap) {
        $month_last_day = Array(1 => 31, 2 => 29, 3 => 31, 4 => 30, 5 => 31, 6 => 30, 7 => 31, 8 => 31, 9 => 30, 10 => 31, 11 => 30, 12 => 31);
    } else {
        $month_last_day = Array(1 => 31, 2 => 28, 3 => 31, 4 => 30, 5 => 31, 6 => 30, 7 => 31, 8 => 31, 9 => 30, 10 => 31, 11 => 30, 12 => 31);
    }
    return $month_last_day[(int) $month];
}

class PavitrasController extends AppController {

    var $name = "Pavitra";
// var $layout = "Teacher_default";
    public $components = array('Common', 'Session');
    public $schcd = "";

    public function FindSchoolTotalUnderCluster() {
        $this->loadModel('SelectStTchNtchMapping');
        $clusterCode = $this->Session->read('user_id');
        $schoolCountForCluster = $this->SelectStTchNtchMapping->getSchoolTotalForCluster($clusterCode);
        return $schoolCountForCluster;

        $this->loadModel('Teacher');
        $this->Teacher->discardAll();
    }

    public function FindSchoolTotalUnderBeo() {
        $this->loadModel('SelectStTchNtchMapping');
        $beoCode = $this->Session->read('user_id');
        $schoolCountForBeo = $this->SelectStTchNtchMapping->getSchoolTotalForBeo($beoCode);
        return $schoolCountForBeo;

        $this->loadModel('Teacher');
        $this->Teacher->discardAll();
    }

    public function Guest() {
        $this->layout = 'guest_layout';
        $user_id = $this->Session->read('user_id');
    }

    public function applicant() {
//        echo "hi"; die;
        $this->layout = 'applicant_layout'; //app/views/layouts/sanstha_default_layout.ctp
    }

    public function sanstha() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');

        $this->loadModel('SelectSansthaBasicInfo');
        $res = $this->SelectSansthaBasicInfo->find('all', array('conditions' => array('sanstha_code' => $sansthacode)));
        $this->set('sansthacode', $sansthacode);
//pr($res);exit;
        if (!empty($res)) {
//                    echo "<pre>";
//        print_r($res);
//        exit();
            $minority_sanstha = $res[0]['SelectSansthaBasicInfo']['minority_sanstha'];
            if (isset($minority_sanstha)) {
                $this->Session->write("minority_sanstha", $minority_sanstha); //Sanstha NAME
            } else {
                $this->Session->write("minority_sanstha", "");
            }

            if (isset($sansthacode)) {
                $this->Session->write("sname", ucwords(trim($res[0]['SelectSansthaBasicInfo']['sanstha_name']))); //Sanstha NAME
            } else {
                $this->Session->write("sname", "-");
            }
        } else {
            echo "<script type=\"text/javascript\">window.alert('This option is not available for your sanstha');window.location.href ='sanstha';</script>";
        }
//        type_of_minority


        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $this->loadModel('PvRosterInfo');
        $data_stat = $this->PvRosterInfo->query("select sanstha_code,asst_flag,roster_edn_level
                                                from pavitra.pv_roster_info 
                                                where sanstha_code='$sansthacode' order by roster_edn_level");
//        pr($data_stat);exit;
        $this->set('data_stat', $data_stat);
    }

    public function hm() {

        $this->layout = 'Teacher_hm_default'; //app/views/layouts/Teacher_hm_default.ctp
        $schcode = $this->Session->read('user_id');
        $user_id = $this->Session->read('user_id');
    }

    public function eduofficer() {
        $this->layout = 'eduofficer_layout'; //app/views/layouts/Teacher_hm_default.ctp
        $user_id = $this->Session->read('user_id');
    }

// Prajakta Start

    public function pv_rostersans() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $this->loadModel('SelectEoSansthaExVac');
        $params = array(Sanitize::html($sansthacode));
        $minority_sanstha = $this->SelectEoSansthaExVac->query("select minority_sanstha from samayojan.sanstha_basic_info where sanstha_code=? ", $params);

        if ($minority_sanstha[0][0]['minority_sanstha'] == 2 || $minority_sanstha [0][0]['minority_sanstha'] == 3) {
            echo "<script type=\"text/javascript\">window.alert('This option is not available for your sanstha');window.location.href ='sanstha';</script>";
        }
        $this->loadModel('Cddir'); //Teacher Posting Mode from Teacher DB
        $cddir_sg = $this->Cddir->find('list', array('conditions' => array('Cddir.code_type' => 'SG'),
            'fields' => array('code_value', 'Cddir.code_text'))); //Cddir.=model name
        $this->set('cddir_sg', $cddir_sg);

        $this->loadModel('PvRosterInfo');
        $verif_dtts = $this->PvRosterInfo->query("select verif_dtts from pv_roster_info where sanstha_code=?", $params);
//        pr($verif_dtts);exit;
    }

    public function get_staff_avail() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $staff_group = Sanitize::html($_POST['staff_group']);
        $roster_edn_level = Sanitize::html($_POST['roster_edn_level']);
        $tchr_type = Sanitize::html($_POST['tchr_type']);

        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }

        $this->loadModel('PvRosterInfo');
        $check = $this->PvRosterInfo->find('all', array('conditions' => array('sanstha_code' => trim($sanstha_code), 'staff_group' => trim($staff_group)
                , 'roster_edn_level' => trim($roster_edn_level), 'staff_type' => trim($tchr_type))));
//pr($check);exit;
//echo $staff_group.' --'.$roster_edn_level.' ---'.$tchr_type; 
//	echo "<pre>";	print_r($check); exit;

        if (!empty($check)) {
            $this->set('check', $check);
        } else {
            echo "error";
        }
    }

    public function get_roster_data() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $sanstha_code = Sanitize::html($_POST['session_user_id']);

        $staff_group = Sanitize::html($_POST['staff_group']);
        $tchr_type = Sanitize::html($_POST['tchr_type']);
        $roster_edn_level = Sanitize::html($_POST['roster_edn_level']);

        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }

        $this->loadModel('PvRosterInfo');

        $check = $this->PvRosterInfo->find('all', array('conditions' => array('sanstha_code' => trim($sanstha_code), 'staff_group' => trim($staff_group)
                , 'roster_edn_level' => trim($roster_edn_level), 'staff_type' => trim($tchr_type))));
//echo "<pre>";	print_r($check); exit;
        if (!empty($check)) {
            $this->set('check', $check);
        } else {
            echo "error";
        }
    }

    public function roster_save() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $this->loadModel('PvRosterInfo');
//        pr($this->request->data);exit;
        $global_ac_year = Configure::read('global_ac_year');
        if ($this->request->data) {

            if (strpos($sanstha_code, 'SC') !== false)
                $mgmt_type = 'PVT';
            else if (strpos($sanstha_code, 'EO') !== false)
                $mgmt_type = 'ZP';
            else if (strpos($sanstha_code, 'DD') !== false)
                $mgmt_type = 'NP';

            $data = $this->request->data;

            $date = date('Y-m-d H:i:s');
            $dtext = split("-", trim($date));
            $dt_ext = substr($dtext[0], 2, 2);


            if (isset($data['edu_level']) && Sanitize::html($data ['edu_level'] != '')) {
                if (Sanitize::html($data['edu_level']) == '1')
                    $roster_edn_level = 'P';
                else
                    $roster_edn_level = 'S';
            } else {
                $roster_edn_level = '';
            }

            if (isset($data['staff_type']) && Sanitize::html($data ['staff_type']) != '') {
                $radio = Sanitize::html($data['staff_type']);
            } else {
                $radio = 0;
            }

            if (isset($data['pv_rostersans']['staff_group']) && Sanitize::html($data ['pv_rostersans']['staff_group'] != '')) {
                $staff_group = Sanitize::html($data['pv_rostersans']['staff_group']);
                if ($staff_group == 1) {
                    $img_name = 'hm';
                } else
                if ($staff_group == 2) {
                    $img_name = 'ahm';
                } else
                if ($staff_group == 3) {
                    $img_name = 'tchr';
                }
            } else {
                $staff_group = 0;
            }
            if (isset($data['pv_rostersans']['rst_last_upd_dt']) && Sanitize::html($data ['pv_rostersans']['rst_last_upd_dt'] != '')) {
                $arr_tp_incr_dt = split("\/", trim($this->request->data['pv_rostersans']['rst_last_upd_dt']));
                $arr_tp_incr_dt = "'" . $arr_tp_incr_dt [1] . '-' . $arr_tp_incr_dt [0] . '-' . $arr_tp_incr_dt [2] . "'";
            } else {
                $arr_tp_incr_dt = split("\/", trim($this->request->data['hid_dt']));
                $arr_tp_incr_dt = "'" . $arr_tp_incr_dt [1] . '-' . $arr_tp_incr_dt [0] . '-' . $arr_tp_incr_dt [2] . "'";
            }
            if (isset($data['pv_rostersans']['sc_sanc_tot']) && Sanitize::html($data ['pv_rostersans']['sc_sanc_tot'] != '')) {
                $sc_sanc_tot = Sanitize::html($data['pv_rostersans']['sc_sanc_tot']);
            } else {
                $sc_sanc_tot = 0;
            }
            if (isset($data['pv_rostersans']['st_sanc_tot']) && Sanitize::html($data ['pv_rostersans']['st_sanc_tot'] != '')) {
                $st_sanc_tot = Sanitize::html($data['pv_rostersans']['st_sanc_tot']);
            } else {
                $st_sanc_tot = 0;
            }
            if (isset($data['pv_rostersans']['vja_sanc_tot']) && Sanitize::html($data ['pv_rostersans']['vja_sanc_tot'] != '')) {
                $vja_sanc_tot = Sanitize::html($data['pv_rostersans']['vja_sanc_tot']);
            } else {
                $vja_sanc_tot = 0;
            }
            if (isset($data['pv_rostersans']['ntb_sanc_tot']) && Sanitize::html($data ['pv_rostersans']['ntb_sanc_tot'] != '')) {
                $ntb_sanc_tot = Sanitize::html($data['pv_rostersans']['ntb_sanc_tot']);
            } else {
                $ntb_sanc_tot = 0;
            }
            if (isset($data['pv_rostersans']['ntc_sanc_tot']) && Sanitize::html($data ['pv_rostersans']['ntc_sanc_tot'] != '')) {
                $ntc_sanc_tot = Sanitize::html($data['pv_rostersans']['ntc_sanc_tot']);
            } else {
                $ntc_sanc_tot = 0;
            }

            if (isset($data['pv_rostersans']['ntd_sanc_tot']) && Sanitize::html($data ['pv_rostersans']['ntd_sanc_tot'] != '')) {
                $ntd_sanc_tot = Sanitize::html($data['pv_rostersans']['ntd_sanc_tot']);
            } else {
                $ntd_sanc_tot = 0;
            }

            if (isset($data['pv_rostersans']['obc_sanc_tot']) && Sanitize::html($data ['pv_rostersans']['obc_sanc_tot'] != '')) {
                $obc_sanc_tot = Sanitize::html($data['pv_rostersans']['obc_sanc_tot']);
            } else {
                $obc_sanc_tot = 0;
            }
            if (isset($data['pv_rostersans']['sbc_sanc_tot']) && Sanitize::html($data ['pv_rostersans']['sbc_sanc_tot'] != '')) {
                $sbc_sanc_tot = Sanitize::html($data['pv_rostersans']['sbc_sanc_tot']);
            } else {
                $sbc_sanc_tot = 0;
            }
            if (isset($data['pv_rostersans']['gen_sanc_tot']) && Sanitize::html($data ['pv_rostersans']['gen_sanc_tot'] != '')) {
                $gen_sanc_tot = Sanitize::html($data['pv_rostersans']['gen_sanc_tot']);
            } else {
                $gen_sanc_tot = 0;
            }

// ----- work ----------------//
            if (isset($data['pv_rostersans']['sc_work_tot']) && Sanitize::html($data ['pv_rostersans']['sc_work_tot'] != '')) {
                $sc_work_tot = Sanitize::html($data['pv_rostersans']['sc_work_tot']);
            } else {
                $sc_work_tot = 0;
            }
            if (isset($data['pv_rostersans']['st_work_tot']) && Sanitize::html($data ['pv_rostersans']['st_work_tot'] != '')) {
                $st_work_tot = Sanitize::html($data['pv_rostersans']['st_work_tot']);
            } else {
                $st_work_tot = 0;
            }
            if (isset($data['pv_rostersans']['vja_work_tot']) && Sanitize::html($data ['pv_rostersans']['vja_work_tot'] != '')) {
                $vja_work_tot = Sanitize::html($data['pv_rostersans']['vja_work_tot']);
            } else {
                $vja_work_tot = 0;
            }
            if (isset($data['pv_rostersans']['ntb_work_tot']) && Sanitize::html($data ['pv_rostersans']['ntb_work_tot'] != '')) {
                $ntb_work_tot = Sanitize::html($data['pv_rostersans']['ntb_work_tot']);
            } else {
                $ntb_work_tot = 0;
            }
            if (isset($data['pv_rostersans']['ntc_work_tot']) && Sanitize::html($data ['pv_rostersans']['ntc_work_tot'] != '')) {
                $ntc_work_tot = Sanitize::html($data['pv_rostersans']['ntc_work_tot']);
            } else {
                $ntc_work_tot = 0;
            }
            if (isset($data['pv_rostersans']['ntd_work_tot']) && Sanitize::html($data ['pv_rostersans']['ntd_work_tot'] != '')) {
                $ntd_work_tot = Sanitize::html($data['pv_rostersans']['ntd_work_tot']);
            } else {
                $ntd_work_tot = 0;
            }
            if (isset($data['pv_rostersans']['obc_work_tot']) && Sanitize::html($data ['pv_rostersans']['obc_work_tot'] != '')) {
                $obc_work_tot = Sanitize::html($data['pv_rostersans']['obc_work_tot']);
            } else {
                $obc_work_tot = 0;
            }
            if (isset($data['pv_rostersans']['sbc_work_tot']) && Sanitize::html($data ['pv_rostersans']['sbc_work_tot'] != '')) {
                $sbc_work_tot = Sanitize::html($data['pv_rostersans']['sbc_work_tot']);
            } else {
                $sbc_work_tot = 0;
            }
            if (isset($data['pv_rostersans']['gen_work_tot']) && Sanitize::html($data ['pv_rostersans']['gen_work_tot'] != '')) {
                $gen_work_tot = Sanitize::html($data['pv_rostersans']['gen_work_tot']);
            } else {
                $gen_work_tot = 0;
            }

            if (isset($data['pv_rostersans']['vacnt_sum']) && Sanitize::html($data ['pv_rostersans']['vacnt_sum'] != '')) {
                $tot_bcklg = Sanitize::html($data['pv_rostersans']['vacnt_sum']);
            } else {
                $tot_bcklg = 0;
            }

//-----------
//            echo "<pre>";
//            print_r($data);
            $filename = '';
            if (isset($data['pv_rostersans']['pdf_path']) && $data ['pv_rostersans']['pdf_path'] != '') {
                $uploadData = $data['pv_rostersans']['pdf_path'];
                $filename = basename($uploadData['name']);
                $uploadFolder = WWW_ROOT . 'STADMIN_UPLOADS';
// $uploadFolder = WWW_ROOT . 'nfsshare/' . 'STADMIN_UPLOADS';
//                $destination_file = WWW_ROOT . "nfsshare/" . $targetFolderPath . "" . DS . $newFileName;

                $filename = basename($uploadData['name']);
                if ($filename) {

                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $filename = $sanstha_code . '_' . $radio . '_' . $roster_edn_level . '_' . $img_name . '_' . 'rst' . $dt_ext . '.' . $ext;
//                pr($filename);exit;
                    $uploadPath = $uploadFolder . DS . $filename;
//                pr($uploadPath);exit;
                    if (!file_exists($uploadFolder)) {
                        mkdir($uploadPath);
                    }
                    $flag = 0;
                    if ($uploadData['tmp_name'] == '') {
                        $flag = 1;
                    }
                    if ($flag == 0) {
                        if (!move_uploaded_file($uploadData['tmp_name'], $uploadPath)) {
                            return false;
                        }
                    }
                    $tc_cert_fname = trim($filename);
                } else {
                    $tc_cert_fname = $data['img_name'];
                }
            }

//            pr($data);

            $check = $this->PvRosterInfo->find('all', array('conditions' => array('sanstha_code' => trim($sanstha_code),
                    'staff_type' => trim($radio), 'roster_edn_level' => $roster_edn_level, 'staff_group' => $staff_group)));
            $myIp = getHostByName(php_uname('n'));
//            pr($myIp);exit;
            if (Sanitize::check($data)) {

                if (empty($check)) {

                    $this->PvRosterInfo->save(array('sanstha_code' => $sanstha_code, 'mgmt_type' => $mgmt_type, 'roster_edn_level' => $roster_edn_level,
                        'staff_type' => $radio, 'staff_group' => $staff_group, 'tot_bcklg' => $tot_bcklg,
                        'sc_sanc_tot' => $sc_sanc_tot, 'st_sanc_tot' => $st_sanc_tot, 'vja_sanc_tot' => $vja_sanc_tot,
                        'ntb_sanc_tot' => $ntb_sanc_tot, 'ntc_sanc_tot' => $ntc_sanc_tot, 'ntd_sanc_tot' => $ntd_sanc_tot, 'obc_sanc_tot' => $obc_sanc_tot, 'sbc_sanc_tot' => $sbc_sanc_tot, 'gen_sanc_tot' => $gen_sanc_tot,
                        'sc_work_tot' => $sc_work_tot, 'st_work_tot' => $st_work_tot, 'vja_work_tot' => $vja_work_tot,
                        'ntb_work_tot' => $ntb_work_tot, 'ntc_work_tot' => $ntc_work_tot, 'ntd_work_tot' => $ntd_work_tot, 'obc_work_tot' => $obc_work_tot, 'sbc_work_tot' => $sbc_work_tot, 'gen_work_tot' => $gen_work_tot,
                        'rst_last_upd_dt' => $arr_tp_incr_dt, 'asst_auth' => $sanstha_code, 'ac_year' => $global_ac_year, 'system_ip' => "'$myIp'",
                        'asst_flag' => 'E', 'entry_dtts' => $date, 'roster_file_name' => $tc_cert_fname));
                    echo "<script type=\"text/javascript\">window.alert('Data Saved');window.location.href ='pv_rostersans';</script>";
                } else {

                    if ($this->request->data['uplodimg'] != '') {
                        $tc_cert_fname = $this->request->data['uplodimg'];
                    }
                    $this->PvRosterInfo->updateALL(array('mgmt_type' => "'$mgmt_type'",
                        'sc_sanc_tot' => $sc_sanc_tot, 'st_sanc_tot' => $st_sanc_tot, 'vja_sanc_tot' => $vja_sanc_tot, 'ntb_sanc_tot' => $ntb_sanc_tot,
                        'ntc_sanc_tot' => $ntc_sanc_tot, 'ntd_sanc_tot' => $ntd_sanc_tot, 'obc_sanc_tot' => $obc_sanc_tot,
                        'sbc_sanc_tot' => $sbc_sanc_tot, 'gen_sanc_tot' => $gen_sanc_tot, 'system_ip' => "'$myIp'",
                        'sc_work_tot' => $sc_work_tot, 'st_work_tot' => $st_work_tot, 'vja_work_tot' => $vja_work_tot,
                        'ntb_work_tot' => $ntb_work_tot, 'ntc_work_tot' => $ntc_work_tot, 'ntd_work_tot' => $ntd_work_tot, 'obc_work_tot' => $obc_work_tot, 'sbc_work_tot' => $sbc_work_tot, 'gen_work_tot' => $gen_work_tot,
                        'rst_last_upd_dt' => $arr_tp_incr_dt, 'ac_year' => $global_ac_year, 'tot_bcklg' => $tot_bcklg,
                        'asst_auth' => "'$sanstha_code'", 'asst_flag' => "'E'", 'entry_dtts' => "'$date'", 'roster_file_name' => "'$tc_cert_fname'"), array('sanstha_code' => trim($sanstha_code), 'staff_type' => trim($radio), 'roster_edn_level' => $roster_edn_level, 'staff_group' => $staff_group));
                    echo "<script type=\"text/javascript\">window.alert('Data Updated');window.location.href ='pv_rostersans';</script>";
                }
            }
//        echo "<script type=\"text/javascript\">window.location.href ='pv_rostersans';</script>";
            else {
                echo "<script type=\"text/javascript\">window.alert('Improper Data');window.location.href ='pv_rostersans';</script>";
            }
        }
    }

    public function roster_delete() {
        $this->layout = 'ajax';
        $this->loadModel('PvRosterInfo');

        $sanstha_code = $this->Session->read('user_id');
        $edu_level = Sanitize::html(trim($_POST['edu_level']));
        $staff_group = Sanitize::html(trim($_POST['staff_group']));
        $staff_type = Sanitize::html(trim($_POST['staff_type']));

        if ($edu_level == 1) {
            $edu_level = 'P';
        }
        if ($edu_level == 2) {
            $edu_level = 'S';
        }
        $params = array($sanstha_code, $edu_level, $staff_type, $staff_group);
        if (Sanitize::check($params)) {
            $this->PvRosterInfo->query("Delete from pavitra.pv_roster_info where sanstha_code=? 
                 and roster_edn_level=? and staff_type=? and staff_group=? ", $params);
        } else {
            echo "<script type=\"text/javascript\">window.alert('Improper Data.');window.location.href ='pv_rostersans';</script>";
        }
    }

    public function fwd_pvros_eo() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $this->loadModel('PvRosterInfo');

        $result = $this->PvRosterInfo->find('all', array('conditions' => array('sanstha_code' => trim($sansthacode),
                'asst_flag' => 'E', 'not' => array('roster_file_name' => null))));
        $this->set('result', $result);
    }

    public function forward_roster() {
        $this->loadModel('PvRosterInfo');
        $sansthacode = $this->Session->read('user_id');
        $edu_level = Sanitize::html(trim($_POST['edu_level']));
//        $staff_group = trim($_POST['staff_group']);
        $staff_type = Sanitize::html(trim($_POST['staff_type']));

        if ($edu_level == 1) {
            $edu_level = 'P';
        }
        if ($edu_level == 2) {
            $edu_level = 'S';
        }
//        pr($this->request);exit;
        if (isset($sansthacode) && $sansthacode != '') {
            $sansthacode = $sansthacode;
        }
        $date = date('Y-m-d H:i:s');

        $params = array($sansthacode, $date, $edu_level);
        if (Sanitize::check($params)) {
            $this->PvRosterInfo->updateAll(array('asst_flag' => "'F'", 'verif_dtts' => "'$date'"), array('sanstha_code' => $sansthacode, 'roster_edn_level' => $edu_level));
            echo "<script type=\"text/javascript\">window.alert('Data has been forwarded to EO.');window.location.href ='fwd_pvros_eo';</script>";
        } else {
            echo "<script type=\"text/javascript\">window.alert('Improper Data.');window.location.href ='fwd_pvros_eo';</script>";
        }
    }

    public function pv_roster_verf_sans() {
        $this->layout = 'eduofficer_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $user_id = $this->Session->read('user_id');
        $dist_cd = substr($user_id, 0, 4);
        $this->set('user_id', $user_id);

        $this->loadModel('ShalaUser');
        $ShalaUser = $this->ShalaUser->find('all', array('conditions' => array('user_id' => $user_id),
            'fields' => array('user_id', 'user_desc')));
        $this->set('ShalaUser', $ShalaUser);
//        pr($ShalaUser);exit;

        $this->loadModel('SelectSansthaBasicInfo');
        $this->loadModel('PvRosterInfo');
        $this->loadModel('ShalaSchool');
        $dis_code = strstr($user_id, "EO", true);
        $roster_edn_level = substr($user_id, 6, 8);

        if ($roster_edn_level == 01) {
            $schl_type_condition = 'highest_class <= 8';
        } else if ($roster_edn_level == 02) {
            $schl_type_condition = 'highest_class  > 8';
        }


        if ($roster_edn_level == 01) {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }


        $params = array($roster_edn_level);

//        $sanstha = $this->SelectSansthaBasicInfo->query("select sbi.sanstha_code,sanstha_name from samayojan.sanstha_basic_info sbi Left Join pavitra.pv_roster_info ri ON sbi.sanstha_code=ri.sanstha_code where ri.asst_flag='F'  and ri.asst_auth ='$user_id' and roster_edn_level='$roster_edn_level' order by sanstha_name");

        $sanstha = $this->SelectSansthaBasicInfo->query("select sbi.sanstha_code,sanstha_name 
                                                        from samayojan.sanstha_basic_info sbi 
                                                        Left Join pavitra.pv_roster_info ri 
                                                        ON sbi.sanstha_code=ri.sanstha_code where ri.asst_flag='F'  
                                                        and ri.asst_auth  LIKE '$dist_cd%' and roster_edn_level=? 
                                                        order by sanstha_name", $params);


        $array_sanstha = array();
        for ($i = 0; $i < count($sanstha); $i++) {
            $sanstha_code = trim($sanstha[$i][0]['sanstha_code']);
            $sanstha_name = trim($sanstha[$i][0]['sanstha_name']);
            $array_sanstha[$sanstha_code] = $sanstha_name;
        }
        $this->set('roster_edn_level', $roster_edn_level);
        $this->set('array_sanstha', $array_sanstha);
//           echo "<pre>";    print_r($array_sanstha); exit;
    }

    public function get_roster_verf_data() {
        $this->layout = 'ajax';
// $data = $this->request->data;
//        pr($data);exit;
        $sanstha_code = trim($this->Session->read('user_id'));
        $sanstha_code = Sanitize::html($_POST['session_user_id']);

        $staff_group = Sanitize::html($_POST['staff_group']);
        $tchr_type = Sanitize::html($_POST['tchr_type']);
        $roster_edn_level = Sanitize::html(trim($_POST['roster_edn_level']));

        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }
        $this->loadModel('PvRosterInfo');

        $check = $this->PvRosterInfo->find('all', array('conditions' => array('sanstha_code' => trim($sanstha_code), 'staff_group' => trim($staff_group)
                , 'roster_edn_level' => trim($roster_edn_level), 'staff_type' => trim($tchr_type))));
//echo "<pre>";	print_r($check); exit;
        if (!empty($check)) {
            $this->set('check', $check);
        } else {
            echo "error";
        }
    }

    public function verify_roster() {

        $this->loadModel('ajax');
        $this->autoRender = false;
        $data = $this->request->data;
//        pr($data);exit;
        $user_id = $this->Session->read('user_id');


        $date = date('Y-m-d H:i:s');

        $sess_val = trim(Sanitize::html($data['sess_val']));
        $staff_type = trim(Sanitize::html($data['staff_type']));
        $chkflg = trim(Sanitize::html($data['select']));
        $sanstha_code = trim(Sanitize::html($data['pv_rost_verf']['sanstha']));
        $staff_group = trim(Sanitize::html($data['pv_rost_verf']['staff_group']));
        $roster_remarks = trim(Sanitize::html($data['pv_rost_verf']['roster_remarks']));
        $myIp = getHostByName(php_uname('n'));
        if ($data['edu_level'] == 1) {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }
        $this->loadModel('PvRosterInfo');
        $params_r = array($chkflg, $date, $roster_remarks, $sess_val, $sanstha_code, $staff_type, $roster_edn_level, $staff_group);
        $params_v = array($myIp, $chkflg, $date, $sess_val, $sanstha_code, $staff_type, $roster_edn_level, $staff_group);


        if ($chkflg == 'R') {
            if (Sanitize::check($params_r)) {
                $this->PvRosterInfo->query("UPDATE pavitra.pv_roster_info
                                        SET  asst_flag = ?, verif_dtts = ? , roster_remarks = ?, verif_auth = ?
                                        WHERE sanstha_code = ? and staff_type = ? and roster_edn_level = ? and staff_group = ? ", $params_r);
                echo "<script type=\"text/javascript\">window.alert('Data Rejected by EO.');window.location.href ='pv_roster_verf_sans';</script>";
            } else {
                echo "<script type=\"text/javascript\">window.alert('Improper Data for Rejection.');window.location.href ='pv_roster_verf_sans';</script>";
            }
        } else {
            if (Sanitize::check($params_v)) {
                $this->PvRosterInfo->query("UPDATE pavitra.pv_roster_info
                                        SET system_ip_verif=?, asst_flag = ?, verif_dtts = ? , verif_auth = ?
                                        WHERE sanstha_code = ? and staff_type = ? and roster_edn_level = ? and staff_group = ?", $params_v);
                echo "<script type=\"text/javascript\">window.alert('Data verified by EO.');window.location.href ='pv_roster_verf_sans';</script>";
            } else {
                echo "<script type=\"text/javascript\">window.alert('Improper Data for Verification.');window.location.href ='pv_roster_verf_sans';</script>";
            }
        }
    }

    public function pv_roster_unverf_sans() {
        $this->layout = 'eduofficer_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $user_id = $this->Session->read('user_id');
        $dist_cd = substr($user_id, 0, 4);
        $this->set('user_id', $user_id);

        $this->loadModel('ShalaUser');
        $ShalaUser = $this->ShalaUser->find('all', array('conditions' => array('user_id' => $user_id),
            'fields' => array('user_id', 'user_desc')));
        $this->set('ShalaUser', $ShalaUser);
//        pr($ShalaUser);exit;

        $this->loadModel('SelectSansthaBasicInfo');
        $this->loadModel('PvRosterInfo');
        $this->loadModel('ShalaSchool');
        $dis_code = strstr($user_id, "EO", true);
        $roster_edn_level = substr($user_id, 6, 8);

        if ($roster_edn_level == 01) {
            $schl_type_condition = 'highest_class <= 8';
        } else if ($roster_edn_level == 02) {
            $schl_type_condition = 'highest_class  > 8';
        }


        if ($roster_edn_level == 01) {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }



        $params = array($roster_edn_level);
//        $sanstha = $this->SelectSansthaBasicInfo->query("select sbi.sanstha_code,sanstha_name from samayojan.sanstha_basic_info sbi Left Join pavitra.pv_roster_info ri ON sbi.sanstha_code=ri.sanstha_code where ri.asst_flag='F'  and ri.asst_auth ='$user_id' and roster_edn_level='$roster_edn_level' order by sanstha_name");

        $sanstha = $this->SelectSansthaBasicInfo->query("select sbi.sanstha_code,sanstha_name 
                                                        from samayojan.sanstha_basic_info sbi 
                                                        Left Join pavitra.pv_roster_info ri 
                                                        ON sbi.sanstha_code=ri.sanstha_code where ri.asst_flag='V'  
                                                        and ri.asst_auth  LIKE '$dist_cd%' and roster_edn_level=? 
                                                        order by sanstha_name", $params);


        $array_sanstha = array();
        for ($i = 0; $i < count($sanstha); $i++) {
            $sanstha_code = trim($sanstha[$i][0]['sanstha_code']);
            $sanstha_name = trim($sanstha[$i][0]['sanstha_name']);
            $array_sanstha[$sanstha_code] = $sanstha_name;
        }
        $this->set('roster_edn_level', $roster_edn_level);
        $this->set('array_sanstha', $array_sanstha);
//           echo "<pre>";    print_r($array_sanstha); exit;
    }

    public function get_roster_unverf_data() {
        $this->layout = 'ajax';

        $sanstha_code = trim($this->Session->read('user_id'));
        $sanstha_code = Sanitize::html($_POST['session_user_id']);

        $staff_group = Sanitize::html($_POST['staff_group']);
        $tchr_type = Sanitize::html($_POST['tchr_type']);
        $roster_edn_level = Sanitize::html($_POST['roster_edn_level']);

        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }
        $this->loadModel('PvRosterInfo');

        $check = $this->PvRosterInfo->find('all', array('conditions' => array('sanstha_code' => trim($sanstha_code), 'staff_group' => trim($staff_group)
                , 'roster_edn_level' => trim($roster_edn_level), 'staff_type' => trim($tchr_type))));
//echo "<pre>";	print_r($check); exit;
        if (!empty($check)) {
            $this->set('check', $check);
        } else {
            echo "error";
        }
    }

    public function unverify_roster() {

        $this->loadModel('ajax');
        $this->autoRender = false;
        $data = $this->request->data;
//        pr($data);exit;
        $user_id = $this->Session->read('user_id');


        $date = date('Y-m-d H:i:s');

        $sess_val = trim(Sanitize::html($data['sess_val']));
        $staff_type = trim(Sanitize::html($data['staff_type']));
        $chkflg = trim(Sanitize::html($data['select']));
        $sanstha_code = trim(Sanitize::html($data['pv_rost_unverf']['sanstha']));
        $staff_group = trim(Sanitize::html($data['pv_rost_unverf']['staff_group']));
        $roster_remarks = trim(Sanitize::html($data['pv_rost_unverf']['roster_remarks']));
        if ($data['edu_level'] == 1) {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }
        $this->loadModel('PvRosterInfo');

        $params_r = array($chkflg, $date, $roster_remarks, $sess_val, $sanstha_code, $staff_type, $roster_edn_level, $staff_group);
        $params_u = array($chkflg, $date, $sess_val, $sanstha_code, $staff_type, $roster_edn_level, $staff_group);


        if ($chkflg == 'R') {
            if (Sanitize::check($params_r)) {
                $this->PvRosterInfo->query("UPDATE pavitra.pv_roster_info
                                        SET asst_flag = ?, verif_dtts = ?, roster_remarks = ?, verif_auth = ?
                                        WHERE sanstha_code = ? and staff_type = ? and roster_edn_level = ? and staff_group = ? ", $params_r);

                echo "<script type=\"text/javascript\">window.alert('Data Rejected by EO.');window.location.href ='pv_roster_unverf_sans';</script>";
            } else {
                echo "<script type=\"text/javascript\">window.alert('Improper Data for Rejection.');window.location.href ='pv_roster_unverf_sans';</script>";
            }
        } else {
            if (Sanitize::check($params_u)) {
                $this->PvRosterInfo->query("UPDATE pavitra.pv_roster_info
                                        SET asst_flag = ?, verif_dtts = ?, verif_auth = ?
                                        WHERE sanstha_code = ? and staff_type = ? and roster_edn_level = ? and staff_group = ? ", $params_u);

                /* CHECK IF CATEGORY WISE RECORDS ENTERED */
                $this->loadModel('PvCategAdvt');
                $check_rec = $this->PvCategAdvt->find('all', array('conditions' => array('sanstha_code' => $sanstha_code, 'staff_type' => $staff_type, 'roster_edn_level' => $roster_edn_level)));
                if (!empty($check_rec)) {
                    $check = $this->PvCategAdvt->query("delete from pavitra.pv_categ_advt WHERE sanstha_code='$sanstha_code' and staff_type = '$staff_type' and roster_edn_level =  '$roster_edn_level'");
                    echo "<script type=\"text/javascript\">window.alert('Category wise advertise data deleted.');window.location.href ='pv_roster_unverf_sans';</script>";
                }

                /*   $this->RosterInfo->updateAll(array('asst_flag' => '"V"', 'verif_dtts' => '".$date."', 'verif_auth' => '".$sess_val."'), array('sanstha_code' => trim($sanstha_code), 'tchr_type' => trim($staff_type), 'roster_edn_level' => "'$roster_edn_level'", 'staff_group' => $staff_group)); */
                echo "<script type=\"text/javascript\">window.alert('Data un-verified by EO.');window.location.href ='pv_roster_unverf_sans';</script>";
            } else {
                echo "<script type=\"text/javascript\">window.alert('Improper Data for Unverification.');window.location.href ='pv_roster_unverf_sans';</script>";
            }
        }
    }

    public function create_adv() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);

        $this->loadModel('SelectTchrMastPost');
        $desg_opt = $this->SelectTchrMastPost->query("Select post_id,post_desc from master.tchr_post_master 
                                                        where post_type='1' and post_id IN('4','5','7','21','22')");
        $all_desg_opt = array();
        for ($i = 0; $i < count($desg_opt); $i++) {
            $post_id = trim($desg_opt[$i][0]['post_id']);
            $post_desc = trim($desg_opt[$i][0]['post_desc']);
            $all_desg_opt[$post_id] = $post_desc;
        }
        $this->set('all_desg_opt', $all_desg_opt);

        $params = array($sansthacode);
        $this->loadModel('SelectSansthaBasicInfo');
        $sanstha_name = $this->SelectSansthaBasicInfo->query("select sanstha_name 
                                                        from samayojan.sanstha_basic_info where sanstha_code=?", $params);
        $this->set('sanstha_name', $sanstha_name[0][0]['sanstha_name']);



        $this->loadModel('PayScaleMaster');
        $pay_sc = $this->PayScaleMaster->query("select psc_scale_cd,psc_dscr,psc_up_limit
                                                        from master.pay_scale 
                                                        where psc_scale_cd IN('1011','1012','1013','1014','1015')");
        $all_pay_sc = array();
        for ($i = 0; $i < count($pay_sc); $i++) {
            $psc_scale_cd = trim($pay_sc[$i][0]['psc_scale_cd']);
            $psc_dscr = trim($pay_sc[$i][0]['psc_dscr']) . "(Rs." . trim($pay_sc[$i][0]['psc_up_limit']) . ")";
            $all_pay_sc[$psc_scale_cd] = $psc_dscr;
        }
        $this->set('all_pay_sc', $all_pay_sc);

        $this->loadModel('SelectSchoolMedium');
        $all_med = $this->SelectSansthaBasicInfo->query("select DISTINCT(medium_of_instruct) as medinstr_id,medinstr_desc
                                                        from shala.shala_medium_basic_info sbi
                                                        LEFT JOIN master.shala_medinstr as sm ON sbi.medium_of_instruct = CAST(sm.medinstr_id AS INTEGER)
                                                        LEFT JOIN shala.shala_all_school sas ON sas.schcd=sbi.schcd
                                                        where sas.sanstha_code=? order by medium_of_instruct", $params);
        $all_med_list = array();
        for ($i = 0; $i < count($all_med); $i++) {
            $medinstr_id = trim($all_med[$i][0]['medinstr_id']);
            $medinstr_desc = trim($all_med[$i][0]['medinstr_desc']);
            $all_med_list[$medinstr_id] = $medinstr_desc;
        }
        $this->set('all_med_list', $all_med_list);

        $this->loadModel('ShalaSchool');
        $sanstha_dist_name = $this->ShalaSchool->getDistListForSanstha($sansthacode);
        $array_sanstha_dist = array();
        for ($i = 0; $i < count($sanstha_dist_name); $i++) {
            $distcd = trim($sanstha_dist_name[$i][0]['distcd']);
            $distname = trim($sanstha_dist_name[$i][0]['distname']);
            $array_sanstha_dist[$distcd] = $distname;
        }
        $this->set('array_sanstha_dist', $array_sanstha_dist);

        $this->loadModel('Cddir');
        $aid_type = $this->Cddir->find('all', array('conditions' => array('code_type' => 'AD'), 'fields' => array('code_value', 'code_text'), 'order' => array('code_value')));
        $all_aid_type = array();
        for ($i = 0; $i < count($aid_type); $i++) {
            $code_value = trim($aid_type[$i]['Cddir']['code_value']);
            $code_text = trim($aid_type[$i]['Cddir']['code_text']);
            $all_aid_type[$code_value] = $code_text;
        }
        $this->set('all_aid_type', $all_aid_type);



        $this->loadModel('SelectAcadQualTech');
//        $edu_level = $this->SelectAcadQualTech->find('all', array('conditions' => array('tchaqual_type' => 'A'), 'fields' => array('tchaqual_id', 'tchaqual_desc')));
        $edu_level = $this->SelectAcadQualTech->query("select tchaqual_id, tchaqual_desc from master.shala_tchaqual where tchaqual_type = 'A' and tchaqual_id NOT IN('1') ");
        $all_edu_level = array();
        for ($i = 0; $i < count($edu_level); $i++) {
            $tchaqual_id = trim($edu_level[$i][0]['tchaqual_id']);
            $tchaqual_desc = trim($edu_level[$i][0]['tchaqual_desc']);
            $all_edu_level[$tchaqual_id] = $tchaqual_desc;
        }
        $this->set('all_edu_level', $all_edu_level);


        $prof_qual = $this->SelectAcadQualTech->find('all', array('conditions' => array("NOT" => array('tchaqual_id' => array('11')), 'tchaqual_type' => 'P'), 'fields' => array('tchaqual_id', 'tchaqual_desc')));
        $all_prof_qual = array();

        for ($i = 0; $i < count($prof_qual); $i++) {
            $deg_cd = trim($prof_qual[$i]['SelectAcadQualTech']['tchaqual_id']);
            $deg_text = trim($prof_qual[$i]['SelectAcadQualTech']['tchaqual_desc']);
            $all_prof_qual[$deg_cd] = $deg_text;
        }
//        pr($all_prof_qual);exit;
        $this->set('all_prof_qual', $all_prof_qual);

        $this->loadModel('SelectSubjectApt');
        $all_sub = $this->SelectSubjectApt->find('all', array('fields' => array('subject_group_id', 'subject_group_desc')));
        $all_sub_list = array();
        for ($i = 0; $i < count($all_sub); $i++) {
            $subject_group_id = trim($all_sub[$i]['SelectSubjectApt']['subject_group_id']);
            $subject_group_desc = trim($all_sub[$i]['SelectSubjectApt']['subject_group_desc']);
            $all_sub_list[$subject_group_id] = $subject_group_desc;
        }
        $this->set('all_sub_list', $all_sub_list);
    }

    public function SelectAcadQual() {
        $this->layout = 'ajax';
        $edu_lvl = Sanitize::html($_POST['edu_lvl']);
        $this->loadModel('DegreeMaster');
        $acad_qual = $this->DegreeMaster->find('all', array('conditions' => array('deg_qual_level' => $edu_lvl), 'fields' => array('deg_cd', 'deg_text'), 'order' => array('deg_cd')));
        $all_acad_qual = array();
        for ($i = 0; $i < count($acad_qual); $i++) {
            $deg_cd = trim($acad_qual[$i]['DegreeMaster']['deg_cd']);
            $deg_text = trim($acad_qual[$i]['DegreeMaster']['deg_text']);
            $all_acad_qual[$deg_cd] = $deg_text;
        }
        $this->set('all_acad_qual', $all_acad_qual);

        $this->loadModel('ShalaState');
        $statList = $this->ShalaState->find('all', array('fields' => array('state_code', 'state_name'), 'order' => array('state_name ASC')));

        $allstatelist = array();
        foreach ($statList AS $arr) {
            $mediumval = trim($arr['ShalaState']['state_code']);
            $mediumname = trim($arr['ShalaState']['state_name']);
            $allstatelist[$mediumval] = $mediumname;
        }
        $this->set('allstates', $allstatelist);
    }

    public function SelectProfQual() {
        $this->layout = 'ajax';
        $prof_lvl = Sanitize::html($_POST['prof_lvl']);

        $this->loadModel('DegreeMaster');
        $prof_qual_lvl = $this->DegreeMaster->find('all', array('conditions' => array('deg_qual_level' => $prof_lvl), 'fields' => array('deg_cd', 'deg_text'), 'order' => array('deg_cd')));
//        pr($prof_qual_lvl);exit;
        $all_prof_qual_lvl = array();
        for ($i = 0; $i < count($prof_qual_lvl); $i++) {
            $deg_cd = trim($prof_qual_lvl[$i]['DegreeMaster']['deg_cd']);
            $deg_text = trim($prof_qual_lvl[$i]['DegreeMaster']['deg_text']);
            $all_prof_qual_lvl[$deg_cd] = $deg_text;
        }
        $this->set('all_prof_qual_lvl', $all_prof_qual_lvl);
    }

    public function SelectSubject() {
        $this->layout = 'ajax';
        $desg_cd = Sanitize::html($_POST['desg_cd']);

        $this->loadModel('SelectSubjectApt');
        $this->loadModel('SubjectJrCol');

        $all_sub_list = array();

        if ($desg_cd == '21' || $desg_cd == '22') {
            $all_sub = $this->SubjectJrCol->find('all', array('fields' => array('subject_code', 'subject_name'), 'order' => array('subject_code')));
            for ($i = 0; $i < count($all_sub); $i++) {
                $subject_code = trim($all_sub[$i]['SubjectJrCol']['subject_code']);
                $subject_name = trim($all_sub[$i]['SubjectJrCol']['subject_name']);
                $all_sub_list[$subject_code] = $subject_name;
            }
        } else {
            if ($desg_cd == '7') {
                $all_sub = $this->SelectSubjectApt->find('all', array('conditions' => array('subject_group_id' => '0'), 'fields' => array('subject_group_id', 'subject_group_desc')));
            } else {
                $all_sub = $this->SelectSubjectApt->find('all', array('conditions' => array("NOT" => array('subject_group_id' => array('0'))), 'fields' => array('subject_group_id', 'subject_group_desc'), 'order' => array('subject_group_id')));
            }


            for ($i = 0; $i < count($all_sub); $i++) {
                $subject_group_id = trim($all_sub[$i]['SelectSubjectApt']['subject_group_id']);
                $subject_group_desc = trim($all_sub[$i]['SelectSubjectApt']['subject_group_desc']);
                $all_sub_list[$subject_group_id] = $subject_group_desc;
            }
        }
        $this->set('all_sub_list', $all_sub_list);
    }

    public function advertise_save() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $staff_type = '1';
        $roster_edn_level = Sanitize::html(trim($_POST['edu_level']));
        $pay_scale = Sanitize::html($this->request->data['create_adv']['adv_pay_scale']);
        $aid_type = Sanitize::html($this->request->data['create_adv']['aid_type']);
        $aid_medium = Sanitize::html($this->request->data['create_adv']['adv_med']);
        $subj_cd = Sanitize::html($this->request->data['adv_subj_cd']);
        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }
//        pr($this->request);exit;
        $this->loadModel('PvAdvertise');
        $date = date('Y-m-d H:i:s');
        $myIp = getHostByName(php_uname('n'));
        $global_ac_year = Configure::read('global_ac_year');
        $chk_id = $this->PvAdvertise->find('list', array('conditions' => array('id' => $this->request->data['create_adv']['row_id'])));
//        pr($chk_id);exit;
        $check = $this->PvAdvertise->find('all', array('conditions' => array('sanstha_code' => $sanstha_code, 'pv_roster_edn_level' => $roster_edn_level,
                'pv_staff_type' => $staff_type, 'pv_medium_id' => $aid_medium, 'pv_desg_cd' => Sanitize::html($_POST['desg_cd']), 'pv_subject_cd' => $subj_cd, 'pv_aid_type' => $aid_type,
                'pv_acad_lvl' => Sanitize::html($this->request->data['create_adv']['edu_qual']), 'pv_acad_qual' => Sanitize::html($this->request->data['acad_qual']),
                'pv_prof_lvl' => Sanitize::html($this->request->data['create_adv']['prof_qual_lvl']), 'pv_prof_qual' => Sanitize::html($this->request->data['prof_qual']),
                'pv_work_type' => Sanitize::html($_POST['work_type']), 'pv_pay_scale_cd' => $pay_scale, 'pv_no_of_post' => Sanitize::html($this->request->data['create_adv']['sanc_post']))));
//        pr($check);exit;
//        pr($this->request);exit;
        if ($this->request->is('post')) {
            $adv_dt = split("\/", trim($this->request->data['create_adv']['dt_adv']));
            $adv_dt = "'" . $adv_dt [2] . '-' . $adv_dt [1] . '-' . $adv_dt [0] . "'";

            $adv_st_dt = split("\/", trim($this->request->data['create_adv']['dt_adv_frm']));
            $adv_st_dt = "'" . $adv_st_dt [2] . '-' . $adv_st_dt [1] . '-' . $adv_st_dt [0] . "'";

            $adv_to_dt = split("\/", trim($this->request->data['create_adv']['dt_adv_to']));
            $adv_to_dt = "'" . $adv_to_dt [2] . '-' . $adv_to_dt [1] . '-' . $adv_to_dt [0] . "'";


            $data1 = array('ac_year' => $global_ac_year,
                'sanstha_code' => $sanstha_code,
                'pv_roster_edn_level' => $roster_edn_level,
                'pv_staff_type' => $staff_type,
                'pv_pay_scale_cd' => Sanitize::html($_POST['data']['create_adv']['adv_pay_scale']),
                'pv_desg_cd' => Sanitize::html($_POST['desg_cd']),
                'pv_work_type' => Sanitize::html($_POST['work_type']),
                'pv_no_of_post' => Sanitize::html($_POST['data']['create_adv']['sanc_post']),
                'pv_aid_type' => Sanitize::html($_POST['data']['create_adv']['aid_type']),
                'pv_medium_id' => Sanitize::html($_POST['data']['create_adv']['adv_med']),
                'pv_acad_lvl' => Sanitize::html($_POST['data']['create_adv']['edu_qual']),
                'pv_prof_lvl' => Sanitize::html($_POST['data']['create_adv']['prof_qual_lvl']),
                'pv_subject_cd' => Sanitize::html($this->request->data['adv_subj_cd']),
                'pv_acad_qual' => Sanitize::html($this->request->data['acad_qual']),
                'pv_prof_qual' => Sanitize::html($this->request->data['prof_qual']),
                'entry_dtts' => $date,
                'system_ip_entry' => $myIp,
                'entry_auth' => $sanstha_code,
                'asst_flag' => 'E',
            );  /* 'pv_gender_pref' =>  $_POST['gen_pref'], */
//            pr($data1);exit;

            if (count($chk_id) <= 0) {
                if (count($check) <= 0) {
                    if (Sanitize::check($data1)) {
                        if ($this->PvAdvertise->save($data1)) {
                            echo "<script type=\"text/javascript\">window.alert('Data Saved.');window.location.href ='create_adv';</script>";
                        }
                    } else {
                        $this->Session->setFlash(__('Please Enter Proper Data..!Record Not Updated Successfully.'));
                    }
                } else {
                    echo "<script type=\"text/javascript\">window.alert('ERR...Record already exists.');window.location.href ='create_adv';</script>";
                }
            } else {
                $id_upd = $this->request->data['create_adv']['mod_upd'];
                if (!empty($this->request->data['create_adv']['mod_upd'])) {
                    $id_upd_new = split("_", trim($this->request->data['create_adv']['mod_upd']));
                    $id_upd = $id_upd_new['1'];
                    $chk = $id_upd_new['0'];
                } else {
                    $chk = 'EXT';
                }


                if ($chk == 'UPD') {
                    if (count($check) <= 0) {
                        if (Sanitize::check($data1)) {
                            $this->PvAdvertise->query("UPDATE pavitra.pv_advertise
                                    SET ac_year = '" . $global_ac_year . "',
                                    sanstha_code = '" . $sanstha_code . "',
                                    pv_roster_edn_level = '" . $roster_edn_level . "' ,
                                    pv_staff_type =  $staff_type,
                                   
                                    pv_desg_cd =  '" . Sanitize::html($_POST['desg_cd']) . "',
                                    pv_work_type =  '" . Sanitize::html($_POST['work_type']) . "',
                                    pv_no_of_post =  '" . Sanitize::html($_POST['data']['create_adv']['sanc_post']) . "',
                                    pv_aid_type =  '" . Sanitize::html($_POST['data']['create_adv']['aid_type']) . "',
                                    pv_medium_id =  '" . Sanitize::html($_POST['data']['create_adv']['adv_med']) . "',
                                    pv_acad_lvl = '" . Sanitize::html($_POST['data']['create_adv']['edu_qual']) . "',
                                    pv_prof_lvl = '" . Sanitize::html($_POST['data']['create_adv']['prof_qual_lvl']) . "',
                                    pv_subject_cd =  '" . Sanitize::html($this->request->data['adv_subj_cd']) . "',
                                    pv_acad_qual =   '" . Sanitize::html($this->request->data['acad_qual']) . "',
                                    pv_prof_qual =  '" . Sanitize::html($this->request->data['prof_qual']) . "', 
                                    update_dtts =  '" . $date . "',
                                    system_ip_update = '" . $myIp . "',
                                    update_auth =  '" . $sanstha_code . "',
                                    asst_flag =  'E'
                                    WHERE id = '" . $id_upd . "'  "); /* pv_gender_pref =  '".$_POST['gen_pref']."', */

                            echo "<script type=\"text/javascript\">window.alert('Data Updated.');window.location.href ='create_adv';</script>";
                        } else {
                            echo "<script type=\"text/javascript\">window.alert('Improper Data for Updation.');window.location.href ='create_adv';</script>";
                        }
                    } else {
                        echo "<script type=\"text/javascript\">window.alert('ERR...Such Record already exists.');window.location.href ='create_adv';</script>";
                    }
                } else {
                    echo "<script type=\"text/javascript\">window.alert('ERR...Record already exists.');window.location.href ='create_adv';</script>";
                }
            }

            $params_dt = array($adv_dt, $adv_st_dt, $adv_to_dt, $sanstha_code, $roster_edn_level, $staff_type, $global_ac_year);
            $this->loadModel('PvAdvertise');
            $this->PvAdvertise->query("UPDATE pavitra.pv_advertise
                                        SET pv_advertise_dt = ?, pv_advertise_frm_dt = ?, pv_advertise_to_dt = ?
                                        WHERE sanstha_code = ?  and pv_roster_edn_level = ? and pv_staff_type = ? and ac_year=?  ", $params_dt);
            echo "<script type=\"text/javascript\">window.alert('Date Updated.');window.location.href ='create_adv';</script>";
        }
    }

    public function DispGridData() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
//        $staff_type = $_POST['ac'];
        $staff_type = '1';
        $roster_edn_level = Sanitize::html(trim($_POST['ac']));
        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }

        $params = array($sanstha_code, $roster_edn_level, $staff_type);

        $this->loadModel('PvRosterInfo');
        $tot_bcklg = $this->PvRosterInfo->query("SELECT tot_bcklg from pavitra.pv_roster_info WHERE  sanstha_code=?
                                            and roster_edn_level  = ? and staff_type=?", $params);
        $this->set('tot_bcklg', $tot_bcklg);

        $this->loadModel('PvAdvertise');

        $post_count = $this->PvAdvertise->query("SELECT SUM(pv_no_of_post) from pavitra.pv_advertise pac WHERE  pac.sanstha_code=?
                                            and pac.pv_roster_edn_level = ? and pac.pv_staff_type=?", $params);
//        pr($post_count);exit;
        $this->set('post_count', $post_count);

        $check = $this->PvAdvertise->query("select distinct pac.*,TPM.post_desc,SM.medinstr_desc,sis.subject_group_desc,sjc.subject_name,
                                            dm.deg_text as acad,dmp.deg_text as prof,ps.psc_scale_cd,ps.psc_dscr,ps.psc_up_limit,cdd.code_text
                                         
                                            from pavitra.pv_advertise pac
                                            LEFT JOIN master.tchr_post_master as TPM ON pac.pv_desg_cd = TPM.post_id AND TPM.post_type=1
                                            LEFT JOIN master.shala_medinstr as SM ON pac.pv_medium_id = SM.medinstr_id
                                            LEFT JOIN master.tchr_apt_subject  as sis ON pac.pv_subject_cd = sis.subject_group_id 
                                            LEFT JOIN master.shala_subject_jc  as sjc ON pac.pv_subject_cd = sjc.subject_code 
                                            LEFT JOIN master.degree_mast as dm ON pac.pv_acad_qual = CAST(dm.deg_cd as numeric) 
                                            LEFT JOIN master.degree_mast as dmp ON pac.pv_prof_qual = CAST(dmp.deg_cd as numeric)
                                            LEFT JOIN master.pay_scale as ps ON pac.pv_pay_scale_cd = ps.psc_scale_cd 
                                            LEFT JOIN master.cddir as cdd ON pac.pv_aid_type = cdd.code_value and cdd.code_type='AD'
                                            
                                            WHERE  pac.sanstha_code=?
                                            and pac.pv_roster_edn_level = ? and pac.pv_staff_type=?", $params);
//        pr($check);exit;
        if (!empty($check)) {
            $this->set('check', $check);
        } else {
            echo " ";
        }
//         echo json_encode($check);
    }

    public function CheckRosterStatus() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $staff_type = '1';
        $roster_edn_level = Sanitize::html(trim($_POST['ac']));
        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }
        $params = array($sanstha_code, $roster_edn_level, $staff_type);
        $this->loadModel('PvRosterInfo');
        $check = $this->PvRosterInfo->query("Select asst_flag from pavitra.pv_roster_info WHERE  sanstha_code=?
                                            and roster_edn_level = ? and staff_type=?", $params);
//        pr($check);
        if (!empty($check)) {
            $this->set('check', $check[0][0]['asst_flag']);
        }
    }

    public function FetchAge() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $rect_cat_cd = Sanitize::html($_POST['rect_cat_cd']);
        $this->loadModel('PvFetchAge');
        $age = $this->PvFetchAge->find('all', array('conditions' => array('categ_cd' => $rect_cat_cd), 'fields' => array('min_age', 'max_age')));
        if (!empty($age)) {
            $this->set('age', $age);
        } else {
            echo "error";
        }
    }

    public function delete_advertise() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $id = Sanitize::html($_POST['id']);
        $this->loadModel('PvAdvertise');

        $params = array($id, $sanstha_code);
        $check_data = $this->PvAdvertise->find('all', array('conditions' => array('sanstha_code' => $sanstha_code, 'id' => Sanitize::html($_POST['id']))));
        if (!empty($check_data)) {
            $check = $this->PvAdvertise->query("delete from pavitra.pv_advertise WHERE id=? and sanstha_code=?", $params);
            echo "a";
        } else {
            echo"b";
        }
    }

    public function modify_advertise() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $id = Sanitize::html($_POST['id']);
        $this->loadModel('PvAdvertise');
        $check_data = $this->PvAdvertise->find('all', array('conditions' => array('sanstha_code' => $sanstha_code, 'id' => Sanitize::html($_POST['id']))));
        $params = array($id, $sanstha_code);
        if (!empty($check_data)) {
            $check = $this->PvAdvertise->query("select * from pavitra.pv_advertise WHERE id=? and sanstha_code=?", $params);
            $this->set('check', $check);
//            pr($check);exit;
        } else {
            echo "error";
        }
    }

    public function caste_ctg_bcklog() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
    }

    public function caste_ctg_save() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $date = date('Y-m-d H:i:s');
        $myIp = getHostByName(php_uname('n'));
        $global_ac_year = Configure::read('global_ac_year');
        $this->loadModel('PvCategAdvt');
//        pr($this->request);exit;

        if ($this->request->is('post')) {

            $staff_group = Sanitize::html($_POST['data']['caste_ctg_save']['staff_group']);
            $roster_edn_level = Sanitize::html($_POST['edu_level']);
            $staff_type = Sanitize::html($_POST['staff_type']);

            if ($roster_edn_level == '1') {
                $roster_edn_level = 'P';
            } else {
                $roster_edn_level = 'S';
            }

            $check = $this->PvCategAdvt->find('all', array('conditions' => array('sanstha_code' => $sansthacode, 'ca_staff_type' => $staff_type, 'ca_roster_edn_level' => $roster_edn_level)));
//          pr($check);exit;

            if ($_POST['data']['caste_ctg_save']['sc_tot'] == 'No Vacancy') {
                $sc_tot = '0';
            } else {
                $sc_tot = Sanitize::html($_POST['data']['caste_ctg_save']['sc_tot']);
            }
            if ($_POST['data']['caste_ctg_save']['st_tot'] == 'No Vacancy') {
                $st_tot = '0';
            } else {
                $st_tot = Sanitize::html($_POST['data']['caste_ctg_save']['st_tot']);
            }
            if ($_POST['data']['caste_ctg_save']['vja_tot'] == 'No Vacancy') {
                $vja_tot = '0';
            } else {
                $vja_tot = Sanitize::html($_POST['data']['caste_ctg_save']['vja_tot']);
            }
            if ($_POST['data']['caste_ctg_save']['ntb_tot'] == 'No Vacancy') {
                $ntb_tot = '0';
            } else {
                $ntb_tot = Sanitize::html($_POST['data']['caste_ctg_save']['ntb_tot']);
            }
            if ($_POST['data']['caste_ctg_save']['ntc_tot'] == 'No Vacancy') {
                $ntc_tot = '0';
            } else {
                $ntc_tot = Sanitize::html($_POST['data']['caste_ctg_save']['ntc_tot']);
            }
            if ($_POST['data']['caste_ctg_save']['ntd_tot'] == 'No Vacancy') {
                $ntd_tot = '0';
            } else {
                $ntd_tot = Sanitize::html($_POST['data']['caste_ctg_save']['ntd_tot']);
            }
            if ($_POST['data']['caste_ctg_save']['obc_tot'] == 'No Vacancy') {
                $obc_tot = '0';
            } else {
                $obc_tot = Sanitize::html($_POST['data']['caste_ctg_save']['obc_tot']);
            }
            if ($_POST['data']['caste_ctg_save']['sbc_tot'] == 'No Vacancy') {
                $sbc_tot = '0';
            } else {
                $sbc_tot = Sanitize::html($_POST['data']['caste_ctg_save']['sbc_tot']);
            }
            if ($_POST['data']['caste_ctg_save']['gen_tot'] == 'No Vacancy') {
                $gen_tot = '0';
            } else {
                $gen_tot = Sanitize::html($_POST['data']['caste_ctg_save']['gen_tot']);
            }
            if ($_POST['data']['caste_ctg_save']['vacnt_sum'] == 'No Vacancy') {
                $tot_bcklg = '0';
            } else {
                $tot_bcklg = Sanitize::html($_POST['data']['caste_ctg_save']['vacnt_sum']);
            }


            $data1 = array('ac_year' => $global_ac_year,
                'sanstha_code' => $sansthacode,
                'ca_roster_edn_level' => $roster_edn_level,
                'ca_staff_type' => $staff_type,
                'ca_staff_group' => $staff_group,
                'ca_sc_tot' => $sc_tot,
                'ca_st_tot' => $st_tot,
                'ca_vja_tot' => $vja_tot,
                'ca_ntb_tot' => $ntb_tot,
                'ca_ntc_tot' => $ntc_tot,
                'ca_ntd_tot' => $ntd_tot,
                'ca_obc_tot' => $obc_tot,
                'ca_sbc_tot' => $sbc_tot,
                'ca_gen_tot' => $gen_tot,
                'asst_flag' => 'E',
                'entry_auth' => $sansthacode,
                'entry_dtts' => $date,
                'system_ip_entry' => $myIp,
                'tot_bcklg' => $tot_bcklg,
            );
//            pr($data1);exit;
            if (count($check) <= 0) {
                if (Sanitize::check($data1)) {
                    if ($this->PvCategAdvt->save($data1)) {
                        echo "<script type=\"text/javascript\">window.alert('Data Saved.');window.location.href ='caste_ctg_bcklog';</script>";
                    } else {
                        $this->Session->setFlash(__('Please Enter Proper Data..!Record Not Updated Successfully.'));
                    }
                } else {
                    echo "<script type=\"text/javascript\">window.alert('Improper Data.');window.location.href ='caste_ctg_bcklog';</script>";
                }
            } else {
                echo "<script type=\"text/javascript\">window.alert('Record Already Exists.');window.location.href ='caste_ctg_bcklog';</script>";
            }
        }
    }

    public function social_ctg_bcklog() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $this->loadModel('Cddir');
        $soc_ctg = $this->Cddir->find('all', array('conditions' => array('code_type' => 'SC'), 'fields' => array('code_value', 'code_text'), 'order' => array('code_value')));
        $all_soc_ctg = array();
        for ($i = 0; $i < count($soc_ctg); $i++) {
            $code_value = trim($soc_ctg[$i]['Cddir']['code_value']);
            $code_text = trim($soc_ctg[$i]['Cddir']['code_text']);
            $all_soc_ctg[$code_value] = $code_text;
        }
//        pr($all_soc_ctg);exit;
        $this->set('all_soc_ctg', $all_soc_ctg);
    }

    public function social_ctg_save() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $date = date('Y-m-d H:i:s');
        $myIp = getHostByName(php_uname('n'));
        $global_ac_year = Configure::read('global_ac_year');
        $this->loadModel('PvSocCateg');
//         pr($this->request);exit;

        if ($this->request->is('post')) {

            $staff_group = Sanitize::html($_POST['data']['social_ctg_save']['staff_group']);
            $roster_edn_level = Sanitize::html($_POST['edu_level']);
            $staff_type = Sanitize::html($_POST['staff_type']);

            if ($roster_edn_level == '1') {
                $roster_edn_level = 'P';
            } else {
                $roster_edn_level = 'S';
            }

            $check = $this->PvSocCateg->find('all', array('conditions' => array('sanstha_code' => $sansthacode, 'soc_staff_type' => $staff_type, 'soc_roster_edn_level' => $roster_edn_level)));
//          pr($check);exit;


            $data1 = array('ac_year' => $global_ac_year,
                'sanstha_code' => $sansthacode,
                'soc_roster_edn_level' => $roster_edn_level,
                'soc_staff_type' => $staff_type,
                'staff_group' => $staff_group,
                'soc_women_tot' => Sanitize::html($_POST['data']['social_ctg_save']['soc_women_tot']),
                'soc_ex_srvc_tot' => Sanitize::html($_POST['data']['social_ctg_save']['soc_ex_srvc_tot']),
                'soc_proj_afct_tot' => Sanitize::html($_POST['data']['social_ctg_save']['soc_proj_afct_tot']),
                'soc_earth_qk_tot' => Sanitize::html($_POST['data']['social_ctg_save']['soc_earth_qk_tot']),
                'soc_pdo_tot' => Sanitize::html($_POST['data']['social_ctg_save']['soc_pdo_tot']),
                'soc_pdb_tot' => Sanitize::html($_POST['data']['social_ctg_save']['soc_pdb_tot']),
                'soc_pdd_tot' => Sanitize::html($_POST['data']['social_ctg_save']['soc_pdd_tot']),
                'soc_sports_tot' => Sanitize::html($_POST['data']['social_ctg_save']['soc_sports_tot']),
                'soc_anshk_tot' => Sanitize::html($_POST['data']['social_ctg_save']['soc_anshk_tot']),
                'soc_ff_tot' => Sanitize::html($_POST['data']['social_ctg_save']['soc_ff_tot']),
                'asst_flag' => 'E',
                'entry_auth' => $sansthacode,
                'entry_dtts' => $date,
                'system_ip_entry' => $myIp,
            );
//            pr($data1);exit;
            if (count($check) <= 0) {
                if ($this->PvSocCateg->save($data1)) {
                    echo "<script type=\"text/javascript\">window.alert('Data Saved.');window.location.href ='social_ctg_bcklog';</script>";
                } else {
                    $this->Session->setFlash(__('Please Enter Proper Data..!Record Not Updated Successfully.'));
                }
            } else {

                $this->PvSocCateg->query("UPDATE pavitra.pv_soc_categ_advt
                                        SET ac_year = '" . $global_ac_year . "',
                                        sanstha_code = '" . $sansthacode . "',
                                        soc_roster_edn_level =  '" . $roster_edn_level . "',
                                        soc_staff_type =  '" . $staff_type . "',
                                        staff_group =  '" . $staff_group . "',
                                        soc_women_tot = '" . Sanitize::html($_POST['data']['social_ctg_save']['soc_women_tot']) . "', 
                                        soc_ex_srvc_tot = '" . Sanitize::html($_POST['data']['social_ctg_save']['soc_ex_srvc_tot']) . "',
                                        soc_proj_afct_tot = '" . Sanitize::html($_POST['data']['social_ctg_save']['soc_proj_afct_tot']) . "',
                                        soc_earth_qk_tot = '" . Sanitize::html($_POST['data']['social_ctg_save']['soc_earth_qk_tot']) . "',
                                        soc_pdo_tot = '" . Sanitize::html($_POST['data']['social_ctg_save']['soc_pdo_tot']) . "',
                                        soc_pdb_tot = '" . Sanitize::html($_POST['data']['social_ctg_save']['soc_pdb_tot']) . "',
                                        soc_pdd_tot = '" . Sanitize::html($_POST['data']['social_ctg_save']['soc_pdd_tot']) . "',
                                        soc_sports_tot = '" . Sanitize::html($_POST['data']['social_ctg_save']['soc_sports_tot']) . "',
                                        soc_anshk_tot  = '" . Sanitize::html($_POST['data']['social_ctg_save']['soc_anshk_tot']) . "',
                                        soc_ff_tot = '" . Sanitize::html($_POST['data']['social_ctg_save']['soc_ff_tot']) . "',
                                        asst_flag =  'E',
                                        update_auth =  '" . $sansthacode . "',
                                        update_dtts =  '" . $date . "',
                                        system_ip_update =  '" . $myIp . "'
                                        WHERE sanstha_code = '" . $sansthacode . "' and  soc_roster_edn_level =  '" . $roster_edn_level . "' and
                                        soc_staff_type =  '" . $staff_type . "'  "); /* pv_gender_pref =  '".$_POST['gen_pref']."', */



                echo "<script type=\"text/javascript\">window.alert('Data Updated.');window.location.href ='social_ctg_bcklog';</script>";
            }
        }
    }

    public function get_soc_categ_data() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $staff_group = Sanitize::html($_POST['staff_group']);
        $roster_edn_level = Sanitize::html($_POST['edu_level']);
        $staff_type = Sanitize::html($_POST['tchr_type']);

        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }
        $this->loadModel('PvSocCateg');
        $check = $this->PvSocCateg->find('all', array('conditions' => array('sanstha_code' => $sanstha_code, 'soc_staff_type' => $staff_type, 'soc_roster_edn_level' => $roster_edn_level)));

        if (!empty($check)) {

            $this->set('check', $check);
//            pr($check);exit;
        } else {
            echo "error";
        }
    }

    public function rep_generate_adv() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
    }

    public function PvAdvertiseReportPDF() {
        include('mpdf60/mpdf.php');
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $this->loadModel('SelectSansthaBasicInfo');
        $res = $this->SelectSansthaBasicInfo->find('all', array('conditions' => array('sanstha_code' => $sansthacode)));
        if (isset($sansthacode)) {
            $this->set('sanstha_name', ucwords(trim($res[0]['SelectSansthaBasicInfo']['sanstha_name'])));
        }
//          pr($this->request);exit;
        $staff_type = '1';
        $roster_edn_level = $this->request->data['edu_level'];
        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }
        $this->set('roster_edn_level', $roster_edn_level);
        $this->loadModel('PvSocCateg');
        $params = array($sansthacode, $roster_edn_level);
        $check = $this->PvSocCateg->query("Select distinct soc.*, pca.*
                                            from pavitra.pv_soc_categ_advt soc
                                            LEFT JOIN pavitra.pv_categ_advt as pca ON soc.sanstha_code = pca.sanstha_code 
                                            WHERE  pca.sanstha_code=?
                                            and pca.ca_roster_edn_level =?", $params);
//     pr($check);exit;
        if (!empty($check)) {
            $this->set('check', $check);
        }

        $this->loadModel('PvAdvertise');
        $params = array($sansthacode, $roster_edn_level, $staff_type);
        $check_grid = $this->PvAdvertise->query("select distinct pac.*,TPM.post_desc,SM.medinstr_desc,sis.subject_group_desc,sjc.subject_name,
                                            dm.deg_text as acad,dmp.deg_text as prof,ps.psc_scale_cd,ps.psc_dscr,ps.psc_up_limit,cdd.code_text
                                            from pavitra.pv_advertise pac
                                            LEFT JOIN master.tchr_post_master as TPM ON pac.pv_desg_cd = TPM.post_id AND TPM.post_type=1
                                            LEFT JOIN master.shala_medinstr as SM ON pac.pv_medium_id = SM.medinstr_id
                                            LEFT JOIN master.tchr_apt_subject  as sis ON pac.pv_subject_cd = sis.subject_group_id 
                                            LEFT JOIN master.shala_subject_jc  as sjc ON pac.pv_subject_cd = sjc.subject_code 
                                            LEFT JOIN master.degree_mast as dm ON pac.pv_acad_qual = CAST(dm.deg_cd as numeric) 
                                            LEFT JOIN master.degree_mast as dmp ON pac.pv_prof_qual = CAST(dmp.deg_cd as numeric)
                                            LEFT JOIN master.pay_scale as ps ON pac.pv_pay_scale_cd = ps.psc_scale_cd 
                                            LEFT JOIN master.cddir as cdd ON pac.pv_aid_type = cdd.code_value and cdd.code_type='AD'
                                            WHERE  pac.sanstha_code= ?
                                            and pac.pv_roster_edn_level =? and pac.pv_staff_type=?", $params);
//        pr($check_grid);exit;
        if (!empty($check_grid)) {
            $this->set('check_grid', $check_grid);
        }
    }

    public function applicant_acad_qual() {
        $this->layout = 'applicant_layout';
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $this->loadModel('SelectAcadQualTech');
//        $edu_level = $this->SelectAcadQualTech->find('all', array('conditions' => array('tchaqual_type' => 'A'), 'fields' => array('tchaqual_id', 'tchaqual_desc')));
        $edu_level = $this->SelectAcadQualTech->query("select tchaqual_id, tchaqual_desc from master.shala_tchaqual where tchaqual_type = 'A' ");
        $all_edu_level = array();
        for ($i = 0; $i < count($edu_level); $i++) {
            $tchaqual_id = trim($edu_level[$i][0]['tchaqual_id']);
            $tchaqual_desc = trim($edu_level[$i][0]['tchaqual_desc']);
            $all_edu_level[$tchaqual_id] = $tchaqual_desc;
        }
        $this->set('all_edu_level', $all_edu_level);
        $this->loadModel('ShalaState');
        $statList = $this->ShalaState->find('all', array('fields' => array('state_code', 'state_name'), 'order' => array('state_name ASC')));

        $allstatelist = array();
        foreach ($statList AS $arr) {
            $mediumval = trim($arr['ShalaState']['state_code']);
            $mediumname = trim($arr['ShalaState']['state_name']);
            $allstatelist[$mediumval] = $mediumname;
        }
        $this->set('allstates', $allstatelist);

        $this->loadModel('SelectBoardUnivMast');
        $BordUniversityList = $this->SelectBoardUnivMast->find('all', array('conditions' => array('bu_type' => array('B', 'U'), 'state_cd' => 27), 'order' => array('bu_name ASC')));

        $allbordunilist = array();
        foreach ($BordUniversityList AS $arr) {
            $mediumval = trim($arr['SelectBoardUnivMast']['bu_code']);
            $mediumname = trim($arr['SelectBoardUnivMast']['bu_name']);
            $allbordunilist[$mediumval] = $mediumname;
        }
        $this->set('allbordunilist', $allbordunilist);
    }

    public function applicant_prof_qual() {
        $this->layout = 'applicant_layout';
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $this->loadModel('SelectAcadQualTech');
        $prof_qual = $this->SelectAcadQualTech->find('all', array('conditions' => array("NOT" => array('tchaqual_id' => array('11')), 'tchaqual_type' => 'P'), 'fields' => array('tchaqual_id', 'tchaqual_desc')));
        $all_prof_qual = array();

        for ($i = 0; $i < count($prof_qual); $i++) {
            $deg_cd = trim($prof_qual[$i]['SelectAcadQualTech']['tchaqual_id']);
            $deg_text = trim($prof_qual[$i]['SelectAcadQualTech']['tchaqual_desc']);
            $all_prof_qual[$deg_cd] = $deg_text;
        }
//        pr($all_prof_qual);exit;
        $this->set('all_prof_qual', $all_prof_qual);
        $this->loadModel('ShalaState');
        $statList = $this->ShalaState->find('all', array('fields' => array('state_code', 'state_name'), 'order' => array('state_name ASC')));

        $allstatelist = array();
        foreach ($statList AS $arr) {
            $mediumval = trim($arr['ShalaState']['state_code']);
            $mediumname = trim($arr['ShalaState']['state_name']);
            $allstatelist[$mediumval] = $mediumname;
        }
        $this->set('allstates', $allstatelist);

        $this->loadModel('SelectBoardUnivMast');
        $BordUniversityList = $this->SelectBoardUnivMast->find('all', array('conditions' => array('bu_type' => array('B', 'U'), 'state_cd' => 27), 'order' => array('bu_name ASC')));

        $allbordunilist = array();
        foreach ($BordUniversityList AS $arr) {
            $mediumval = trim($arr['SelectBoardUnivMast']['bu_code']);
            $mediumname = trim($arr['SelectBoardUnivMast']['bu_name']);
            $allbordunilist[$mediumval] = $mediumname;
        }
        $this->set('allbordunilist', $allbordunilist);
    }

    public function BoardUnivbyLevelid() {
        $this->layout = 'ajax';
        $this->loadModel('SelectBoardUnivMast');
        $recvdata = $this->request->data;
        $levlid = $recvdata['level_id'];

        if ($levlid == 1) {
            $BordUniversityList = $this->SelectBoardUnivMast->find('all', array('conditions' => array('bu_type' => 'N'), 'order' => array('bu_name ASC')));
        } else {
            if ($levlid == 2 || $levlid == 3) {
                $BordUniversityList = $this->SelectBoardUnivMast->find('all', array('conditions' => array('bu_type' => 'B'), 'order' => array('bu_name ASC')));
            } else {
                $BordUniversityList = $this->SelectBoardUnivMast->find('all', array('conditions' => array('bu_type' => 'U'), 'order' => array('bu_name ASC')));
            }
        }
        $allbordunilist = array();
        foreach ($BordUniversityList AS $arr) {
            $mediumval = trim($arr['SelectBoardUnivMast']['bu_code']);
            $mediumname = trim($arr['SelectBoardUnivMast']['bu_name']);
            $allbordunilist[$mediumval] = $mediumname;
        }
        $this->set('allbordunitys', $allbordunilist);
        $this->loadModel('Teacher');
        $this->Teacher->discardAll();
    }

    public function BoardUnivbystateid() {
        $this->layout = 'ajax';
        $this->loadModel('SelectBoardUnivMast');
        $recvdata = $this->request->data;


        $levlid = $recvdata['level_id'];
        $statelid = $recvdata['state_id'];
        if ($levlid == 1) {
            $BordUniversityList = $this->SelectBoardUnivMast->find('all', array('conditions' => array('bu_type' => 'N'), 'order' => array('bu_name ASC')));
        } else {
            if ($levlid == 2 || $levlid == 3) {
                $BordUniversityList = $this->SelectBoardUnivMast->find('all', array('conditions' => array('bu_type' => 'B', 'state_cd' => $statelid), 'order' => array('bu_name ASC')));
            } else if ($levlid == 11 || $levlid == 12) {
                $BordUniversityList = $this->SelectBoardUnivMast->find('all', array('conditions' => array('state_cd' => $statelid), 'order' => array('bu_name ASC')));
            } else {
                $BordUniversityList = $this->SelectBoardUnivMast->find('all', array('conditions' => array('bu_type' => 'U', 'state_cd' => $statelid), 'order' => array('bu_name ASC')));
            }
        }
        $allbordunilist = array();
        foreach ($BordUniversityList AS $arr) {
            $mediumval = trim($arr['SelectBoardUnivMast']['bu_code']);
            $mediumname = trim($arr['SelectBoardUnivMast']['bu_name']);
            $allbordunilist[$mediumval] = $mediumname;
        }
        if (array_key_exists('deg', $recvdata)) {
            if ($recvdata['deg'] == '70') {
                $BordUniversityList = $this->SelectBoardUnivMast->find('all', array('conditions' => array('bu_type' => 'B', 'state_cd' => $statelid, 'bu_code' => 33), 'order' => array('bu_name ASC')));
//                echo "<pre>";
//                print_r($BordUniversityList);
//                die;
                $mediumval = trim($BordUniversityList[0]['SelectBoardUnivMast']['bu_code']);
                $mediumname = trim($BordUniversityList[0]['SelectBoardUnivMast']['bu_name']);
                $allbordunilist[$mediumval] = $mediumname;
            }
        }
        $this->set('allbordunitys', $allbordunilist);
        $this->loadModel('Teacher');
        $this->Teacher->discardAll();
    }

    public function save_applicant_acad() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
    }

    public function save_applicant_prof() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
    }

    public function extract_vac_data() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sanstha_code = $this->Session->read('user_id');
        $this->set('sanstha_code', $sanstha_code);
        $global_ac_year = Configure::read('global_ac_year');
    }

    public function GetVacaDet() {
        $this->layout = 'ajax';
        $sanstha_code = $this->Session->read('user_id');
        $this->set('sanstha_code', $sanstha_code);
        $roster_edn_level = Sanitize::html($_POST['ac']);
        $staff_type = '1';

        if ($roster_edn_level == '1') {
            $roster_edn_level = '01';
        } else {
            $roster_edn_level = '02';
        }
        $this->loadModel('SelectEoSansthaExVac');
//        $check=$this->SansthaVacancy->find('all',array('conditions'=>array('sanstha_code'=>$sanstha_code,'schl_type'=>$roster_edn_level)));
        $param = array($sanstha_code, $roster_edn_level);
        $check = $this->SelectEoSansthaExVac->query("select exv.*,TPM.post_desc,SM.medinstr_desc,sis.subject_group_desc,sd.distname,sas.school_name,exv.eos_desg_cd,exv.eos_medium_id,exv.eos_subject_cd
                        from samayojan.eo_sanstha_ex_vac exv 
                        LEFT JOIN master.tchr_post_master as TPM ON exv.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                        LEFT JOIN master.shala_medinstr as SM ON exv.eos_medium_id = SM.medinstr_id
                        LEFT JOIN master.tchr_apt_subject  as sis ON exv.eos_subject_cd = CAST(sis.subject_group_id as numeric)
                        LEFT JOIN shala_live.shala_district as sd ON exv.dist_code = sd.distcd
                        LEFT JOIN shala.shala_all_school as sas ON exv.schl_id=sas.schcd
                        where exv.sanstha_code=? and schl_type=?", $param);



//        pr($check);exit;
        if (!empty($check)) {
            $this->set('check', $check);
        }
    }

    public function ChkVcntCnt() {
        $this->layout = 'ajax';
        $sanstha_code = $this->Session->read('user_id');
        $this->set('sanstha_code', $sanstha_code);
        $roster_edn_level = Sanitize::html($_POST['ac']);
        $staff_type = '1';

        if ($roster_edn_level == '1') {
            $roster_edn_level = '01';
        } else {
            $roster_edn_level = '02';
        }
        $this->loadModel('SelectEoSansthaExVac');
        $check = $this->SelectEoSansthaExVac->find('all', array('conditions' => array('sanstha_code' => $sanstha_code, 'schl_type' => $roster_edn_level)));
        $cnt = count($check);
//        pr($cnt);exit;

        $this->set('cnt', $cnt);
    }

    public function save_vaca_det() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $date = date('Y-m-d H:i:s');
        $myIp = getHostByName(php_uname('n'));
        $global_ac_year = Configure::read('global_ac_year');


        $data = $this->request->data;
        $count = count($data['bla']);
        for ($i = 0; $i < $count; $i++) {
            $respose[] = explode('-', $data['bla'][$i]);
            $sch_code[] = $respose[$i][0];
            $desig[] = $respose[$i][1];
            $medium[] = $respose[$i][2];
            $sub[] = $respose[$i][3];
        }
//school
        $inschcdStr = '(';
        if ($sch_code) {
            foreach ($sch_code AS $arr => $val) {
                $inschcdStr.="'" . trim($val) . "',";
            }
        } else {
            $inschcdStr.="''";
        }
        $inschcdStr = trim($inschcdStr, ",");
        $inschcdStr.=')';

//desig
        $indesigStr = '(';
        if ($desig) {
            foreach ($desig AS $arr => $val) {
                $indesigStr.="'" . trim($val) . "',";
            }
        } else {
            $indesigStr.="''";
        }
        $indesigStr = trim($indesigStr, ",");
        $indesigStr.=')';
//medium

        $inmediumStr = '(';
        if ($medium) {
            foreach ($medium AS $arr => $val) {
                $inmediumStr.="'" . trim($val) . "',";
            }
        } else {
            $inmediumStr.="''";
        }
        $inmediumStr = trim($inmediumStr, ",");
        $inmediumStr.=')';

//sub
        $insubStr = '(';
        if ($sub) {
            foreach ($sub AS $arr => $val) {
                $insubStr.="'" . trim($val) . "',";
            }
        } else {
            $insubStr.="''";
        }
        $insubStr = trim($insubStr, ",");
        $insubStr.=')';

        if ($this->request->is('post')) {
            $roster_edn_level = Sanitize::html($_POST['edu_level']);
            if ($roster_edn_level == '1') {
                $roster_edn_level = '01';
            } else {
                $roster_edn_level = '02';
            }
            $this->loadModel('SelectEoSansthaExVac');
            $this->loadModel('SansthaVacancy');
            $check = $this->SansthaVacancy->find('all', array('conditions' => array('sanstha_code' => $sansthacode, 'schl_id' => $sch_code, 'schl_type' => $roster_edn_level, 'eos_desg_cd' => $desig, 'eos_medium_id' => $medium, 'eos_subject_cd' => $sub)));

            $count_vac = count($check);
            $params = array($sansthacode, $roster_edn_level, $inschcdStr, $indesigStr, $inmediumStr, $insubStr);
            if (!empty($check)) {
                $qry = $this->SelectEoSansthaExVac->query("INSERT INTO pavitra.pv_eo_sanstha_ex_vac
                                                     (sanstha_code,dist_code,schl_type,eo_code,schl_id,eos_medium_id,eos_desg_cd,
                                                     eos_sm_posts,eos_proposed_posts,eos_online_posts,eos_offline_posts,eos_type,
                                                     eos_sub_cal_post,eos_subject_cd,eos_no_of_post,asst_flag,asst_auth,entry_dtts,
                                                     remarks,minority_sanstha,shifted_tchr_cnt,ac_year,staff_type,aid_type 
                                                     )
                                                     (SELECT 
                                                     sanstha_code,dist_code,schl_type,eo_code,schl_id,eos_medium_id,eos_desg_cd,
                                                     eos_sm_posts,eos_proposed_posts,eos_online_posts,eos_offline_posts,eos_type,
                                                     eos_sub_cal_post,eos_subject_cd,eos_no_of_post,'A',asst_auth,entry_dtts,
                                                     minority_sanstha,remarks,shifted_tchr_cnt,ac_year,'2','1'

                                                     FROM samayojan.eo_sanstha_ex_vac
                                                     WHERE sanstha_code='$sansthacode' and schl_type='$roster_edn_level' and schl_id IN $inschcdStr and eos_desg_cd IN $indesigStr and eos_medium_id IN $inmediumStr and eos_subject_cd IN $insubStr
                                                     )");
                echo "<script type=\"text/javascript\">window.alert('Data Extracted.');window.location.href ='extract_vac_data';</script>";
            } else {
                echo "<script type=\"text/javascript\">window.alert('Data Extraction Error.');window.location.href ='extract_vac_data';</script>";
            }
        }
    }

    public function rep_schwise_vaca() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $this->loadModel('ShalaSchool');
        $sanstha_dist_name = $this->ShalaSchool->getDistListForSanstha($sansthacode);
        $array_sanstha_dist = array();
        for ($i = 0; $i < count($sanstha_dist_name); $i++) {
            $distcd = trim($sanstha_dist_name[$i][0]['distcd']);
            $distname = trim($sanstha_dist_name[$i][0]['distname']);
            $array_sanstha_dist[$distcd] = $distname;
        }
        $this->set('array_sanstha_dist', $array_sanstha_dist);
    }

    public function PvSchwiseVacancyPdf() {
        include('mpdf60/mpdf.php');
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $this->loadModel('SelectSansthaBasicInfo');
        $res = $this->SelectSansthaBasicInfo->find('all', array('conditions' => array('sanstha_code' => $sansthacode)));
        if (isset($sansthacode)) {
            $this->set('sanstha_name', ucwords(trim($res[0]['SelectSansthaBasicInfo']['sanstha_name'])));
        }

        $this->loadModel('ShalaSchool');
        $dist_code = $this->request->data['dist_cd'];
        $dist_name = $this->ShalaSchool->query("SELECT distinct distname 
                                                        FROM shala_live.shala_district
                                                        WHERE distcd = '$dist_code'");
        $this->set('dist_name', $dist_name['0']['0']['distname']);
        $this->loadModel('SansthaVacancy');
//        $check=$this->SansthaVacancy->find('all',array('conditions'=>array('sanstha_code'=>$sanstha_code,'schl_type'=>$roster_edn_level)));
        $param = array($sansthacode, $dist_code);
        $check = $this->SansthaVacancy->query("select distinct exv.*,TPM.post_desc,SM.medinstr_desc,sis.subject_group_desc,sd.distname,sas.school_name,cdd.code_text
                                                    from pavitra.pv_eo_sanstha_ex_vac exv 
                                                    LEFT JOIN master.tchr_post_master as TPM ON exv.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                                                    LEFT JOIN master.shala_medinstr as SM ON exv.eos_medium_id = SM.medinstr_id
                                                    LEFT JOIN master.tchr_apt_subject  as sis ON exv.eos_subject_cd = CAST(sis.subject_group_id as numeric)
                                                    LEFT JOIN shala_live.shala_district as sd ON exv.dist_code = sd.distcd
                                                    LEFT JOIN shala.shala_all_school as sas ON exv.schl_id=sas.schcd
                                                    LEFT JOIN master.cddir as cdd ON exv.aid_type = cdd.code_value and cdd.code_type='AD'
                                                    where exv.sanstha_code=? and exv.dist_code=? order by exv.schl_id", $param);

//               pr($check);exit;
        if (!empty($check)) {
            $this->set('check', $check);
        }
    }

    public function rep_particular_sans_vaca() {
        $this->layout = 'eduofficer_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $user_id = $this->Session->read('user_id');
        $dist_cd = substr($user_id, 0, 4);
        $this->set('user_id', $user_id);

        $this->loadModel('ShalaUser');
        $ShalaUser = $this->ShalaUser->find('all', array('conditions' => array('user_id' => $user_id),
            'fields' => array('user_id', 'user_desc')));
        $this->set('ShalaUser', $ShalaUser);
//        pr($ShalaUser);exit;

        $this->loadModel('SelectSansthaBasicInfo');
        $this->loadModel('PvRosterInfo');
        $this->loadModel('ShalaSchool');
        $dis_code = strstr($user_id, "EO", true);
        $params = array($user_id);


        $sanstha = $this->SelectSansthaBasicInfo->query("select distinct(sbi.sanstha_code),sanstha_name
                            from samayojan.sanstha_basic_info sbi 
                            LEFT JOIn pavitra.pv_eo_sanstha_ex_vac exv
                            ON sbi.sanstha_code=exv.sanstha_code 
                            where exv.eo_code=? and exv.asst_flag='A'", $params);


        $array_sanstha = array();
        for ($i = 0; $i < count($sanstha); $i++) {
            $sanstha_code = trim($sanstha[$i][0]['sanstha_code']);
            $sanstha_name = trim($sanstha[$i][0]['sanstha_name']);
            $array_sanstha[$sanstha_code] = $sanstha_name;
        }

        $this->set('array_sanstha', $array_sanstha);
    }

    public function SelectDistrict() {
        $this->layout = 'ajax';
        $sans_cd = Sanitize::html($_POST['sans_cd']);
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);

        $this->loadModel('ShalaSchool');
        $sanstha_dist_name = $this->ShalaSchool->query("SELECT distcd,distname 
                                                        FROM shala_live.shala_district
                                                        WHERE distcd IN
                                                                   (SELECT DISTINCT(substr(schcd,1,4)) 
                                                                   FROM shala.shala_all_school 
                                                                   WHERE sanstha_code like '$sans_cd%')");

        $array_sanstha_dist = array();
        for ($i = 0; $i < count($sanstha_dist_name); $i++) {
            $distcd = trim($sanstha_dist_name[$i][0]['distcd']);
            $distname = trim($sanstha_dist_name[$i][0]['distname']);
            $array_sanstha_dist[$distcd] = $distname;
        }
        $this->set('array_sanstha_dist', $array_sanstha_dist);
    }

    public function PvParticularSansthaVacaPdf() {
        include('mpdf60/mpdf.php');
        $user_id = $this->Session->read('user_id');
        $this->set('user_id', $user_id);

//        pr($this->request);exit;
        $sansthacode = Sanitize::html($_POST['sans_cd']);
        $districtcode = $this->request->data['dist_cd'];
//        pr($districtcode);exit;
        $this->loadModel('SelectSansthaBasicInfo');
        $res = $this->SelectSansthaBasicInfo->find('all', array('conditions' => array('sanstha_code' => $sansthacode)));
        if (isset($sansthacode)) {
            $this->set('sanstha_name', ucwords(trim($res[0]['SelectSansthaBasicInfo']['sanstha_name'])));
        }

        $this->loadModel('ShalaSchool');

        $dist_name = $this->ShalaSchool->query("SELECT distname 
                                                        FROM shala_live.shala_district
                                                        WHERE distcd = '$districtcode'");
//        pr($dist_name);exit;
        $this->set('dist_name', $dist_name['0']['0']['distname']);

        $this->loadModel('SansthaVacancy');
        $param = array($user_id, $sansthacode, 'A', $districtcode);
        $check = $this->SansthaVacancy->query("select exv.*,TPM.post_desc,SM.medinstr_desc,sis.subject_group_desc,sd.distname,sas.school_name,cdd.code_text
                                                    from pavitra.pv_eo_sanstha_ex_vac exv 
                                                    LEFT JOIN master.tchr_post_master as TPM ON exv.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                                                    LEFT JOIN master.shala_medinstr as SM ON exv.eos_medium_id = SM.medinstr_id
                                                    LEFT JOIN master.tchr_apt_subject  as sis ON exv.eos_subject_cd = CAST(sis.subject_group_id as numeric)
                                                    LEFT JOIN shala_live.shala_district as sd ON exv.dist_code = sd.distcd
                                                    LEFT JOIN shala.shala_all_school as sas ON exv.schl_id=sas.schcd
                                                    LEFT JOIN master.cddir as cdd ON exv.aid_type = cdd.code_value and cdd.code_type='AD'
                                                    where exv.eo_code=? and exv.sanstha_code=? and exv.asst_flag=? and exv.dist_code=? order by exv.schl_id", $param);

//               pr($check);exit;
        if (!empty($check)) {
            $this->set('check', $check);
        }
    }

    public function rep_all_sans_vaca() {
        $this->layout = 'eduofficer_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $user_id = $this->Session->read('user_id');
        $dist_cd = substr($user_id, 0, 4);
        $this->set('user_id', $user_id);
    }

    public function PvAllSansthaVacaPdf() {
        include('mpdf60/mpdf.php');
        $user_id = $this->Session->read('user_id');
        $this->set('user_id', $user_id);

        $this->loadModel('SansthaVacancy');
        $param = array($user_id, 'A');
        $check = $this->SansthaVacancy->query("select exv.*,TPM.post_desc,SM.medinstr_desc,sis.subject_group_desc,sd.distname,sas.school_name,cdd.code_text,sbi.sanstha_name
                                                    from pavitra.pv_eo_sanstha_ex_vac exv 
                                                    LEFT JOIN master.tchr_post_master as TPM ON exv.eos_desg_cd = TPM.post_id AND TPM.post_type=1
                                                    LEFT JOIN master.shala_medinstr as SM ON exv.eos_medium_id = SM.medinstr_id
                                                    LEFT JOIN master.tchr_apt_subject  as sis ON exv.eos_subject_cd = CAST(sis.subject_group_id as numeric)
                                                    LEFT JOIN shala_live.shala_district as sd ON exv.dist_code = sd.distcd
                                                    LEFT JOIN shala.shala_all_school as sas ON exv.schl_id=sas.schcd
                                                    LEFT JOIN master.cddir as cdd ON exv.aid_type = cdd.code_value and cdd.code_type='AD'
                                                    LEFT JOIN shala.sanstha_basic_info sbi ON exv.sanstha_code=sbi.sanstha_code
                                                    where exv.eo_code=? and exv.asst_flag=? order by exv.schl_id", $param);

//               pr($check);exit;
        if (!empty($check)) {
            $this->set('check', $check);
        }
    }

    public function forward_adv() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
    }

    public function DispFwdAdv() {
//       pr($this->request);exit;
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $staff_type = '1';
        $roster_edn_level = Sanitize::html(trim($_POST['ac']));
        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }

        $this->loadModel('PvAdvertise');

        $params = array($sanstha_code, $roster_edn_level, $staff_type);
        $check = $this->PvAdvertise->query("select distinct pac.*,TPM.post_desc,SM.medinstr_desc,sis.subject_group_desc,sjc.subject_name,
                                            dm.deg_text as acad,dmp.deg_text as prof,ps.psc_scale_cd,ps.psc_dscr,ps.psc_up_limit,cdd.code_text
                                            from pavitra.pv_advertise pac
                                            LEFT JOIN master.tchr_post_master as TPM ON pac.pv_desg_cd = TPM.post_id AND TPM.post_type=1
                                            LEFT JOIN master.shala_medinstr as SM ON pac.pv_medium_id = SM.medinstr_id
                                            LEFT JOIN master.tchr_apt_subject  as sis ON pac.pv_subject_cd = sis.subject_group_id 
                                            LEFT JOIN master.shala_subject_jc  as sjc ON pac.pv_subject_cd = sjc.subject_code 
                                            LEFT JOIN master.degree_mast as dm ON pac.pv_acad_qual = CAST(dm.deg_cd as numeric) 
                                            LEFT JOIN master.degree_mast as dmp ON pac.pv_prof_qual = CAST(dmp.deg_cd as numeric)
                                            LEFT JOIN master.pay_scale as ps ON pac.pv_pay_scale_cd = ps.psc_scale_cd 
                                            LEFT JOIN master.cddir as cdd ON pac.pv_aid_type = cdd.code_value and cdd.code_type='AD'
                                            WHERE  pac.sanstha_code=? 
                                            and pac.pv_roster_edn_level = ? and pac.pv_staff_type=?", $params);
//        pr($check);exit;
        if (!empty($check)) {
            $this->set('check', $check);
        } else {
            echo " ";
        }
    }

    public function advertise_fwd() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
//         pr($this->request);exit;

        $staff_type = '1';
        $roster_edn_level = Sanitize::html(trim($_POST['edu_level']));

        if ($roster_edn_level == 1) {
            $roster_edn_level = 'P';
        }
        if ($roster_edn_level == 2) {
            $roster_edn_level = 'S';
        }
//        pr($this->request);exit;
        if (isset($sansthacode) && $sansthacode != '') {
            $sansthacode = $sansthacode;
        }
        $date = date('Y-m-d H:i:s');
        $this->loadModel('PvAdvertise');


        $params = array($sansthacode, $roster_edn_level);


        if (Sanitize::check($params)) {
            $this->PvAdvertise->updateAll(array('asst_flag' => "'F'", 'verif_dtts' => "'$date'"), array('sanstha_code' => $sansthacode, 'pv_staff_type' => $staff_type, 'pv_roster_edn_level' => $roster_edn_level));
            echo "<script type=\"text/javascript\">window.alert('Advertise has been forwarded to EO.');window.location.href ='forward_adv';</script>";
        } else {
            echo "<script type=\"text/javascript\">window.alert('Improper Data.');window.location.href ='forward_adv';</script>";
        }
    }

    public function DispAppAdv() {
//       pr($this->request);exit;
        $this->layout = 'ajax';
        $user_code = trim($this->Session->read('user_id'));
//        $staff_type = $_POST['ac'];
        $staff_type = '1';
        $sanstha_code = Sanitize::html(trim($_POST['sanstha_code']));
        $roster_edn_level = Sanitize::html(trim($_POST['ac']));
        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }

        $this->loadModel('PvAdvertise');

        $params = array($sanstha_code, $roster_edn_level, $staff_type);
        $check = $this->PvAdvertise->query("select distinct pac.*,TPM.post_desc,SM.medinstr_desc,sis.subject_group_desc,sjc.subject_name,
                                            dm.deg_text as acad,dmp.deg_text as prof,ps.psc_scale_cd,ps.psc_dscr,ps.psc_up_limit,cdd.code_text
                                            from pavitra.pv_advertise pac
                                            LEFT JOIN master.tchr_post_master as TPM ON pac.pv_desg_cd = TPM.post_id AND TPM.post_type=1
                                            LEFT JOIN master.shala_medinstr as SM ON pac.pv_medium_id = SM.medinstr_id
                                            LEFT JOIN master.tchr_apt_subject  as sis ON pac.pv_subject_cd = sis.subject_group_id 
                                            LEFT JOIN master.shala_subject_jc  as sjc ON pac.pv_subject_cd = sjc.subject_code 
                                            LEFT JOIN master.degree_mast as dm ON pac.pv_acad_qual = CAST(dm.deg_cd as numeric) 
                                            LEFT JOIN master.degree_mast as dmp ON pac.pv_prof_qual = CAST(dmp.deg_cd as numeric)
                                            LEFT JOIN master.pay_scale as ps ON pac.pv_pay_scale_cd = ps.psc_scale_cd 
                                            LEFT JOIN master.cddir as cdd ON pac.pv_aid_type = cdd.code_value and cdd.code_type='AD'
                                            WHERE  pac.sanstha_code=? and pac.asst_flag='F'
                                            and pac.pv_roster_edn_level = ? and pac.pv_staff_type=?", $params);
//        pr($check);exit;
        if (!empty($check)) {
            $this->set('check', $check);
        } else {
            echo " ";
        }
//         echo json_encode($check);
    }

    public function approve_adv() {
        $this->layout = 'eduofficer_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $user_id = $this->Session->read('user_id');
        $dist_cd = substr($user_id, 0, 4);
        $this->set('user_id', $user_id);

        $this->loadModel('ShalaUser');
        $ShalaUser = $this->ShalaUser->find('all', array('conditions' => array('user_id' => $user_id),
            'fields' => array('user_id', 'user_desc')));
        $this->set('ShalaUser', $ShalaUser);
//        pr($ShalaUser);exit;

        $this->loadModel('SelectSansthaBasicInfo');
        $this->loadModel('PvAdvertise');
        $this->loadModel('ShalaSchool');
        $dis_code = strstr($user_id, "EO", true);
        $roster_edn_level = substr($user_id, 6, 8);

        if ($roster_edn_level == 01) {
            $schl_type_condition = 'highest_class <= 8';
        } else if ($roster_edn_level == 02) {
            $schl_type_condition = 'highest_class  > 8';
        }


        if ($roster_edn_level == 01) {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }


        $params = array($roster_edn_level, '1');

//        $sanstha = $this->SelectSansthaBasicInfo->query("select sbi.sanstha_code,sanstha_name from samayojan.sanstha_basic_info sbi Left Join pavitra.pv_roster_info ri ON sbi.sanstha_code=ri.sanstha_code where ri.asst_flag='F'  and ri.asst_auth ='$user_id' and roster_edn_level='$roster_edn_level' order by sanstha_name");

        $sanstha = $this->SelectSansthaBasicInfo->query("select sbi.sanstha_code,sanstha_name 
                                                        from samayojan.sanstha_basic_info sbi 
                                                        Left Join pavitra.pv_advertise adv
                                                        ON sbi.sanstha_code=adv.sanstha_code where adv.asst_flag='F'  
                                                        and adv.entry_auth  LIKE '$dist_cd%' and pv_roster_edn_level=? and pv_staff_type=?
                                                        order by sanstha_name", $params);


        $array_sanstha = array();
        for ($i = 0; $i < count($sanstha); $i++) {
            $sanstha_code = trim($sanstha[$i][0]['sanstha_code']);
            $sanstha_name = trim($sanstha[$i][0]['sanstha_name']);
            $array_sanstha[$sanstha_code] = $sanstha_name;
        }
        $this->set('roster_edn_level', $roster_edn_level);
        $this->set('array_sanstha', $array_sanstha);
    }

    public function advertise_aprv() {
        $user_code = $this->Session->read('user_id');

//         pr($this->request);exit;

        $staff_type = Sanitize::html(trim($_POST['staff_type']));
        $roster_edn_level = Sanitize::html(trim($_POST['edu_level']));
        $sansthacode = Sanitize::html(trim($this->request->data['advertise_aprv']['sanstha']));
        $action = Sanitize::html(trim($_POST['select']));
        $rej_reason = Sanitize::html(trim($this->request->data['advertise_aprv']['roster_remarks']));

        if ($roster_edn_level == 1) {
            $roster_edn_level = 'P';
        }
        if ($roster_edn_level == 2) {
            $roster_edn_level = 'S';
        }
//        pr($this->request);exit;



        $date = date('Y-m-d H:i:s');
        $this->loadModel('PvAdvertise');
        $params = array($sansthacode, $staff_type, $roster_edn_level, $rej_reason);

        if (Sanitize::check($params)) {
            if ($action == 'A') {
                $this->PvAdvertise->updateAll(array('asst_flag' => "'A'", 'verif_dtts' => "'$date'"), array('sanstha_code' => $sansthacode, 'pv_staff_type' => $staff_type, 'pv_roster_edn_level' => $roster_edn_level));
                echo "<script type=\"text/javascript\">window.alert('Advertise has been Approved by EO.');window.location.href ='approve_adv';</script>";
            } else if ($action == 'R') {
                $this->PvAdvertise->updateAll(array('asst_flag' => "'R'", 'verif_dtts' => "'$date'", 'reject_reason' => "'$rej_reason'"), array('sanstha_code' => $sansthacode, 'pv_staff_type' => $staff_type, 'pv_roster_edn_level' => $roster_edn_level));
                echo "<script type=\"text/javascript\">window.alert('Advertise has been Rejected by EO.');window.location.href ='approve_adv';</script>";
            }
        } else {
            echo "<script type=\"text/javascript\">window.alert('Improper Data.');window.location.href ='approve_adv';</script>";
        }
    }

    public function view_applicant_list() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $this->loadModel('ApplicantPreferences');

        $check = $this->ApplicantPreferences->query("select distinct(apf.*),adm.*,tpm.post_desc,SM.medinstr_desc,fa.flag_text
                                                    from pavitra.applicant_preferences apf
                                                    LEFT JOIN master.tchr_post_master as tpm ON apf.applied_post=CAST(tpm.post_id as character) and tpm.post_type=1
                                                    LEFT JOIN master.shala_medinstr as SM ON apf.applied_medium = SM.medinstr_id 
                                                    LEFT JOIN pavitra.pv_flags_applicant as fa ON apf.applicant_status=fa.flag_cd
                                                    LEFT JOIN pavitra.applicant_det_mast as adm ON apf.appl_id = adm.pv_apptn_id
                                                    where apf.sanstha_id='$sansthacode'");
        if (!empty($check)) {
            $this->set('check', $check);
        }
//        pr($check);exit;
    }

    public function appln_list_eo() {
        $this->layout = 'eduofficer_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $user_id = $this->Session->read('user_id');
        $dist_cd = substr($user_id, 0, 4);
        $this->set('user_id', $user_id);

        $this->loadModel('SelectSansthaBasicInfo');
        $sanstha = $this->SelectSansthaBasicInfo->query("select distinct(ap.sanstha_id),sbi.sanstha_code,sanstha_name 
                                                        from pavitra.applicant_preferences ap
                                                        LEFT JOIN samayojan.sanstha_basic_info sbi ON  sbi.sanstha_code=ap.sanstha_id  
                                                        where ap.sanstha_id like '$dist_cd%'");
        $array_sanstha = array();
        if (!empty($sanstha)) {
            for ($i = 0; $i < count($sanstha); $i++) {
                $sanstha_code = trim($sanstha[$i][0]['sanstha_code']);
                $sanstha_name = trim($sanstha[$i][0]['sanstha_name']);
                $array_sanstha[$sanstha_code] = $sanstha_name;
            }
            $this->set('array_sanstha', $array_sanstha);
        } else {
            $this->set('array_sanstha', '');
        }
//         pr($sanstha);exit;
    }

    public function ApplnMed() {
        $this->layout = 'ajax';
        $apln_sans = $_POST['apln_sans'];
        $params = array($apln_sans);
        $this->loadModel('SelectSchoolMedium');
        $all_med = $this->SelectSchoolMedium->query("select DISTINCT(medium_of_instruct) as medinstr_id,medinstr_desc
                                                        from shala.shala_medium_basic_info sbi
                                                        LEFT JOIN master.shala_medinstr as sm ON sbi.medium_of_instruct = CAST(sm.medinstr_id AS INTEGER)
                                                        LEFT JOIN shala.shala_all_school sas ON sas.schcd=sbi.schcd
                                                        where sas.sanstha_code=? order by medium_of_instruct", $params);
//        pr($all_med);exit;
        $all_med_list = array();
        for ($i = 0; $i < count($all_med); $i++) {
            $medinstr_id = trim($all_med[$i][0]['medinstr_id']);
            $medinstr_desc = trim($all_med[$i][0]['medinstr_desc']);
            $all_med_list[$medinstr_id] = $medinstr_desc;
        }
        $this->set('all_med_list', $all_med_list);
    }

    public function ApplnDesg() {
        $this->layout = 'ajax';
        $apln_sans = $_POST['apln_sans'];
        $apln_med = $_POST['apln_med'];
        $params = array($apln_sans, $apln_med);

        $this->loadModel('SelectTchrMastPost');
        $desg_opt = $this->SelectTchrMastPost->query("select distinct(ap.applied_post),pm.post_desc 
                                                        from pavitra.applicant_preferences ap
                                                        LEFT JOIN master.tchr_post_master pm ON ap.applied_post=CAST(pm.post_id as character) and pm.post_type='1'
                                                        where ap.sanstha_id =? and ap.applied_medium=?", $params);

        $all_desg_opt = array();
        for ($i = 0; $i < count($desg_opt); $i++) {
            $post_id = trim($desg_opt[$i][0]['applied_post']);
            $post_desc = trim($desg_opt[$i][0]['post_desc']);
            $all_desg_opt[$post_id] = $post_desc;
        }
        $this->set('all_desg_opt', $all_desg_opt);
    }

    public function ApplnSubj() {
        $this->layout = 'ajax';
        $apln_sans = $_POST['apln_sans'];
        $apln_med = $_POST['apln_med'];
        $apln_desg = $_POST['apln_desg'];
        $params = array($apln_sans, $apln_med, $apln_desg);

        $this->loadModel('SelectSubjectApt');
        $subj_opt = $this->SelectSubjectApt->query("select distinct(ap.applied_sub),pm.subject_group_desc
                                                    from pavitra.applicant_preferences ap
                                                    LEFT JOIN master.tchr_apt_subject pm ON ap.applied_sub=pm.subject_group_id
                                                    where ap.sanstha_id = ? and ap.applied_medium=? and ap.applied_post=?", $params);
        $all_subj_opt = array();
        for ($i = 0; $i < count($subj_opt); $i++) {
            $subj_id = trim($subj_opt[$i][0]['applied_sub']);
            $subj_desc = trim($subj_opt[$i][0]['subject_group_desc']);
            $all_subj_opt[$subj_id] = $subj_desc;
        }
        $this->set('all_subj_opt', $all_subj_opt);
    }

    public function CheckApplnRec() {
        $this->layout = 'ajax';
//        pr($this->request);exit;
//        $apln_sans = Sanitize::html(trim($this->request->data['appln_data']['apln_sans']));
//        $apln_med = Sanitize::html(trim($this->request->data['apln_med']));
//        $apln_desg = Sanitize::html(trim($this->request->data['apln_desg']));
//        $apln_subj = Sanitize::html(trim($this->request->data['apln_subj']));

        $apln_sans = $_POST['apln_sans'];
        $apln_med = $_POST['apln_med'];
        $apln_desg = $_POST['apln_desg'];
        $apln_subj = $_POST['apln_subj'];

//        echo $apln_sans ."-".$apln_med."-".$apln_desg."-".$apln_subj;
        $params = array($apln_sans, $apln_med, $apln_desg, $apln_subj);
        $this->loadModel('ApplicantPreferences');
        $check = $this->ApplicantPreferences->query("select distinct(apf.*),adm.*,tpm.post_desc,SM.medinstr_desc,fa.flag_text
                                                    from pavitra.applicant_preferences apf
                                                    LEFT JOIN master.tchr_post_master as tpm ON apf.applied_post=CAST(tpm.post_id as character) and tpm.post_type=1
                                                    LEFT JOIN master.shala_medinstr as SM ON apf.applied_medium = SM.medinstr_id 
                                                    LEFT JOIN pavitra.pv_flags_applicant as fa ON apf.applicant_status=fa.flag_cd
                                                    LEFT JOIN pavitra.applicant_det_mast as adm ON apf.appl_id = adm.pv_apptn_id
                                                    where apf.sanstha_id=? and apf.applied_medium=? and apf.applied_post=? and apf.applied_sub=?", $params);
//        pr($check);exit;
        if (!empty($check)) {
            $this->set('check', $check);
        }
    }

// Prajakta End 
//----------------------------------------------------------------------------------------------------------------------------------------------
// Virochan Start
// Extract Roster Details

    public function extract_rost_data() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sansthacode = $this->Session->read('user_id');
        $this->set('sansthacode', $sansthacode);
        $this->loadModel('SelectEoSansthaExVac');
        $minority_sanstha = $this->SelectEoSansthaExVac->query("select minority_sanstha from samayojan.sanstha_basic_info where sanstha_code='$sansthacode' ");

        if ($minority_sanstha[0][0]['minority_sanstha'] == 2 || $minority_sanstha [0][0]['minority_sanstha'] == 3) {
            echo "<script type=\"text/javascript\">window.alert('This option is not available for your sanstha');window.location.href ='sanstha';</script>";
        }
        $this->loadModel('Cddir'); //Teacher Posting Mode from Teacher DB
        $cddir_sg = $this->Cddir->find('list', array('conditions' => array('Cddir.code_type' => 'SG'),
            'fields' => array('code_value', 'Cddir.code_text'))); //Cddir.=model name
        $this->set('cddir_sg', $cddir_sg);

        $this->loadModel('RosterInfo');
        $verif_dtts = $this->RosterInfo->query("select * from samayojan.roster_info where sanstha_code='$sansthacode'");
    }

    public function exc_get_staff_avail() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $staff_group = $_POST['staff_group'];
        $roster_edn_level = $_POST['roster_edn_level'];
        $tchr_type = $_POST['tchr_type'];

        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }

        $this->loadModel('RosterInfo');
        $check = $this->RosterInfo->find('all', array('conditions' => array('sanstha_code' => trim($sanstha_code), 'staff_group' => trim($staff_group)
                , 'roster_edn_level' => trim($roster_edn_level), 'staff_type' => trim($tchr_type))));
//pr($check);exit;
//echo $staff_group.' --'.$roster_edn_level.' ---'.$tchr_type; 
//	echo "<pre>";	print_r($check); exit;

        if (!empty($check)) {
            $this->set('check', $check);
        } else {
            echo "error";
        }
    }

    public function exc_get_roster_data() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $sanstha_code = $_POST['session_user_id'];

        $staff_group = $_POST['staff_group'];
        $tchr_type = $_POST['tchr_type'];
        $roster_edn_level = $_POST['roster_edn_level'];

        if ($roster_edn_level == '1') {
            $roster_edn_level = 'P';
        } else {
            $roster_edn_level = 'S';
        }

        $this->loadModel('RosterInfo');

        $check = $this->RosterInfo->find('all', array('conditions' => array('sanstha_code' => trim($sanstha_code), 'staff_group' => trim($staff_group)
                , 'roster_edn_level' => trim($roster_edn_level), 'staff_type' => trim($tchr_type))));
//echo "<pre>";	print_r($check); exit;
        if (!empty($check)) {
            $this->set('check', $check);
        } else {
            echo "error";
        }
    }

    public function incert_roster_data() {
        $this->layout = 'ajax';
        $sanstha_code = trim($this->Session->read('user_id'));
        $this->loadModel('PvRosterInfo');
        if ($this->request->data) {

            if (strpos($sanstha_code, 'SC') !== false)
                $mgmt_type = 'PVT';
            else if (strpos($sanstha_code, 'EO') !== false)
                $mgmt_type = 'ZP';
            else if (strpos($sanstha_code, 'DD') !== false)
                $mgmt_type = 'NP';

            $data = $this->request->data;
//            pr($data);exit;

            $date = date('Y-m-d H:i:s');
            if (isset($data['edu_level']) && $data ['edu_level'] != '') {
                if ($data['edu_level'] == '1')
                    $roster_edn_level = 'P';
                else
                    $roster_edn_level = 'S';
            } else {
                $roster_edn_level = '';
            }

            if (isset($data['staff_type']) && $data ['staff_type'] != '') {
                $radio = $data['staff_type'];
            } else {
                $radio = 0;
            }

            if (isset($data['pv_rostersans']['staff_group']) && $data ['pv_rostersans']['staff_group'] != '') {
                $staff_group = $data['pv_rostersans']['staff_group'];
                if ($staff_group == 1) {
                    $img_name = 'hm';
                } else
                if ($staff_group == 2) {
                    $img_name = 'ahm';
                } else
                if ($staff_group == 3) {
                    $img_name = 'tchr';
                }
            } else {
                $staff_group = 0;
            }
            $this->loadModel('PvRosterInfo');
            $result = $this->PvRosterInfo->find('all', array('conditions' => array('sanstha_code' => trim($sanstha_code), 'staff_group' => trim($staff_group)
                    , 'roster_edn_level' => trim($roster_edn_level))));
            if (!empty($result)) {
                echo "<script type=\"text/javascript\">window.alert('Data has been extracted once.');window.location.href ='extract_rost_data';</script>";
            } else {
                if (isset($data['pv_rostersans']['rst_last_upd_dt']) && $data ['pv_rostersans']['rst_last_upd_dt'] != '') {
                    $arr_tp_incr_dt = split("\/", trim($this->request->data['pv_rostersans']['rst_last_upd_dt']));
                    $arr_tp_incr_dt = "'" . $arr_tp_incr_dt [1] . '/' . $arr_tp_incr_dt [0] . '/' . $arr_tp_incr_dt [2] . "'";
                } else {
                    $arr_tp_incr_dt = split("\/", trim($this->request->data['hid_dt']));
                    $arr_tp_incr_dt = "'" . $arr_tp_incr_dt [1] . '/' . $arr_tp_incr_dt [0] . '/' . $arr_tp_incr_dt [2] . "'";
                }
                if (isset($data['pv_rostersans']['sc_sanc_tot']) && $data ['pv_rostersans']['sc_sanc_tot'] != '') {
                    $sc_sanc_tot = $data['pv_rostersans']['sc_sanc_tot'];
                } else {
                    $sc_sanc_tot = 0;
                }
                if (isset($data['pv_rostersans']['st_sanc_tot']) && $data ['pv_rostersans']['st_sanc_tot'] != '') {
                    $st_sanc_tot = $data['pv_rostersans']['st_sanc_tot'];
                } else {
                    $st_sanc_tot = 0;
                }
                if (isset($data['pv_rostersans']['vja_sanc_tot']) && $data ['pv_rostersans']['vja_sanc_tot'] != '') {
                    $vja_sanc_tot = $data['pv_rostersans']['vja_sanc_tot'];
                } else {
                    $vja_sanc_tot = 0;
                }
                if (isset($data['pv_rostersans']['ntb_sanc_tot']) && $data ['pv_rostersans']['ntb_sanc_tot'] != '') {
                    $ntb_sanc_tot = $data['pv_rostersans']['ntb_sanc_tot'];
                } else {
                    $ntb_sanc_tot = 0;
                }
                if (isset($data['pv_rostersans']['ntc_sanc_tot']) && $data ['pv_rostersans']['ntc_sanc_tot'] != '') {
                    $ntc_sanc_tot = $data['pv_rostersans']['ntc_sanc_tot'];
                } else {
                    $ntc_sanc_tot = 0;
                }

                if (isset($data['pv_rostersans']['ntd_sanc_tot']) && $data ['pv_rostersans']['ntd_sanc_tot'] != '') {
                    $ntd_sanc_tot = $data['pv_rostersans']['ntd_sanc_tot'];
                } else {
                    $ntd_sanc_tot = 0;
                }

                if (isset($data['pv_rostersans']['obc_sanc_tot']) && $data ['pv_rostersans']['obc_sanc_tot'] != '') {
                    $obc_sanc_tot = $data['pv_rostersans']['obc_sanc_tot'];
                } else {
                    $obc_sanc_tot = 0;
                }
                if (isset($data['pv_rostersans']['sbc_sanc_tot']) && $data ['pv_rostersans']['sbc_sanc_tot'] != '') {
                    $sbc_sanc_tot = $data['pv_rostersans']['sbc_sanc_tot'];
                } else {
                    $sbc_sanc_tot = 0;
                }
                if (isset($data['pv_rostersans']['gen_sanc_tot']) && $data ['pv_rostersans']['gen_sanc_tot'] != '') {
                    $gen_sanc_tot = $data['pv_rostersans']['gen_sanc_tot'];
                } else {
                    $gen_sanc_tot = 0;
                }

// ----- work ----------------//
                if (isset($data['pv_rostersans']['sc_work_tot']) && $data ['pv_rostersans']['sc_work_tot'] != '') {
                    $sc_work_tot = $data['pv_rostersans']['sc_work_tot'];
                } else {
                    $sc_work_tot = 0;
                }
                if (isset($data['pv_rostersans']['st_work_tot']) && $data ['pv_rostersans']['st_work_tot'] != '') {
                    $st_work_tot = $data['pv_rostersans']['st_work_tot'];
                } else {
                    $st_work_tot = 0;
                }
                if (isset($data['pv_rostersans']['vja_work_tot']) && $data ['pv_rostersans']['vja_work_tot'] != '') {
                    $vja_work_tot = $data['pv_rostersans']['vja_work_tot'];
                } else {
                    $vja_work_tot = 0;
                }
                if (isset($data['pv_rostersans']['ntb_work_tot']) && $data ['pv_rostersans']['ntb_work_tot'] != '') {
                    $ntb_work_tot = $data['pv_rostersans']['ntb_work_tot'];
                } else {
                    $ntb_work_tot = 0;
                }
                if (isset($data['pv_rostersans']['ntc_work_tot']) && $data ['pv_rostersans']['ntc_work_tot'] != '') {
                    $ntc_work_tot = $data['pv_rostersans']['ntc_work_tot'];
                } else {
                    $ntc_work_tot = 0;
                }
                if (isset($data['pv_rostersans']['ntd_work_tot']) && $data ['pv_rostersans']['ntd_work_tot'] != '') {
                    $ntd_work_tot = $data['pv_rostersans']['ntd_work_tot'];
                } else {
                    $ntd_work_tot = 0;
                }
                if (isset($data['pv_rostersans']['obc_work_tot']) && $data ['pv_rostersans']['obc_work_tot'] != '') {
                    $obc_work_tot = $data['pv_rostersans']['obc_work_tot'];
                } else {
                    $obc_work_tot = 0;
                }
                if (isset($data['pv_rostersans']['sbc_work_tot']) && $data ['pv_rostersans']['sbc_work_tot'] != '') {
                    $sbc_work_tot = $data['pv_rostersans']['sbc_work_tot'];
                } else {
                    $sbc_work_tot = 0;
                }
                if (isset($data['pv_rostersans']['gen_work_tot']) && $data ['pv_rostersans']['gen_work_tot'] != '') {
                    $gen_work_tot = $data['pv_rostersans']['gen_work_tot'];
                } else {
                    $gen_work_tot = 0;
                }

//-----------
//            echo "<pre>";
//            print_r($data);
                $filename = '';
                if (isset($data['pv_rostersans']['pdf_path']) && $data ['pv_rostersans']['pdf_path'] != '') {
                    $uploadData = $data['pv_rostersans']['pdf_path'];
                    $filename = basename($uploadData['name']);
                    $uploadFolder = WWW_ROOT . 'STADMIN_UPLOADS';
// $uploadFolder = WWW_ROOT . 'nfsshare/' . 'STADMIN_UPLOADS';
//                $destination_file = WWW_ROOT . "nfsshare/" . $targetFolderPath . "" . DS . $newFileName;

                    $filename = basename($uploadData['name']);
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $filename = $sanstha_code . '_' . $radio . '_' . $roster_edn_level . '_' . $img_name . '_' . 'rst' . '.' . $ext;

                    $uploadPath = $uploadFolder . DS . $filename;
//                pr($uploadPath);exit;
                    if (!file_exists($uploadFolder)) {
                        mkdir($uploadPath);
                    }
                    $flag = 0;
                    if ($uploadData['tmp_name'] == '') {
                        $flag = 1;
                    }
                    if ($flag == 0) {
                        if (!move_uploaded_file($uploadData['tmp_name'], $uploadPath)) {
                            return false;
                        }
                    }
                }

//            pr($data);
                if ($filename) {
                    $tc_cert_fname = trim($filename);
                } else {
                    $tc_cert_fname = '';
                }
//            echo $tc_cert_fname;
//            die();
                $check = $this->PvRosterInfo->find('all', array('conditions' => array('sanstha_code' => trim($sanstha_code),
                        'staff_type' => trim($radio), 'roster_edn_level' => $roster_edn_level, 'staff_group' => $staff_group)));

                if (empty($check)) {
                    $this->PvRosterInfo->save(array('sanstha_code' => $sanstha_code, 'mgmt_type' => $mgmt_type, 'roster_edn_level' => $roster_edn_level,
                        'staff_type' => $radio, 'staff_group' => $staff_group,
                        'sc_sanc_tot' => $sc_sanc_tot, 'st_sanc_tot' => $st_sanc_tot, 'vja_sanc_tot' => $vja_sanc_tot,
                        'ntb_sanc_tot' => $ntb_sanc_tot, 'ntc_sanc_tot' => $ntc_sanc_tot, 'ntd_sanc_tot' => $ntd_sanc_tot, 'obc_sanc_tot' => $obc_sanc_tot, 'sbc_sanc_tot' => $sbc_sanc_tot, 'gen_sanc_tot' => $gen_sanc_tot,
                        'sc_work_tot' => $sc_work_tot, 'st_work_tot' => $st_work_tot, 'vja_work_tot' => $vja_work_tot,
                        'ntb_work_tot' => $ntb_work_tot, 'ntc_work_tot' => $ntc_work_tot, 'ntd_work_tot' => $ntd_work_tot, 'obc_work_tot' => $obc_work_tot, 'sbc_work_tot' => $sbc_work_tot, 'gen_work_tot' => $gen_work_tot,
                        'rst_last_upd_dt' => $arr_tp_incr_dt, 'asst_auth' => $sanstha_code, 'ac_year' => '2017-18',
                        'asst_flag' => 'E', 'entry_dtts' => $date, 'roster_file_name' => $tc_cert_fname));
                } else {
                    if ($this->request->data['uplodimg'] != '') {
                        $tc_cert_fname = $this->request->data['uplodimg'];
                    }
                    $this->PvRosterInfo->updateALL(array('mgmt_type' => "'$mgmt_type'",
                        'sc_sanc_tot' => $sc_sanc_tot, 'st_sanc_tot' => $st_sanc_tot, 'vja_sanc_tot' => $vja_sanc_tot, 'ntb_sanc_tot' => $ntb_sanc_tot,
                        'ntc_sanc_tot' => $ntc_sanc_tot, 'ntd_sanc_tot' => $ntd_sanc_tot, 'obc_sanc_tot' => $obc_sanc_tot,
                        'sbc_sanc_tot' => $sbc_sanc_tot, 'gen_sanc_tot' => $gen_sanc_tot,
                        'sc_work_tot' => $sc_work_tot, 'st_work_tot' => $st_work_tot, 'vja_work_tot' => $vja_work_tot,
                        'ntb_work_tot' => $ntb_work_tot, 'ntc_work_tot' => $ntc_work_tot, 'ntd_work_tot' => $ntd_work_tot, 'obc_work_tot' => $obc_work_tot, 'sbc_work_tot' => $sbc_work_tot, 'gen_work_tot' => $gen_work_tot,
                        'rst_last_upd_dt' => $arr_tp_incr_dt, 'ac_year' => '2017-18',
                        'asst_auth' => "'$sanstha_code'", 'asst_flag' => "'E'", 'entry_dtts' => "'$date'", 'roster_file_name' => "'$tc_cert_fname'"), array('sanstha_code' => trim($sanstha_code), 'staff_type' => trim($radio), 'roster_edn_level' => $roster_edn_level, 'staff_group' => $staff_group));
                }
            }
        }
        echo "<script type=\"text/javascript\">window.location.href ='extract_rost_data';</script>";
    }

// Vacancy Details

    public function eo_sanstha_excess_vacancy_decalar() {
        $this->layout = 'sanstha_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sanstha_code = $this->Session->read('user_id');
        $this->set('sanstha_code', $sanstha_code);


        $this->loadModel('ShalaSchool');
        $sanstha_dist_name = $this->ShalaSchool->getDistListForSanstha($sanstha_code);
//        echo "<pre>";	print_r($sanstha_dist_name); exit();

        $array_sanstha_dist = array();
        for ($i = 0; $i < count($sanstha_dist_name); $i++) {
            $distcd = trim($sanstha_dist_name[$i][0]['distcd']);
            $distname = trim($sanstha_dist_name[$i][0]['distname']);
            $array_sanstha_dist[$distcd] = $distname;
        }
        $this->set('array_sanstha_dist', $array_sanstha_dist);
//        echo "<pre>";	print_r($array_sanstha_dist); exit; 

        $this->loadModel('State');
        $this->set('StateList', $this->State->find('list', array('fields' => array('statcd', 'statname'))));

        $this->loadModel('District');
        $state_id = '27';

//        $dis = $this->District->find('list', array('conditions' => array('distcd' => substr($sanstha_code, 0, 4)), 'fields' => array('distcd', 'distname')));
//        $this->set('district_list', $dis);

        $this->loadModel('Cddir'); //Teacher Posting Mode from Teacher DB
        $all_subject_result = $this->Cddir->getSamayojansSubject();

//        echo "<pre>".print_r($all_subject_result,true)."</pre>";exit();

        $all_sama_sub_cat = array();
        for ($i = 0; $i < count($all_subject_result); $i++) {
            $code_value = trim($all_subject_result[$i][0]['code_value']);
            $code_text = trim($all_subject_result[$i][0]['code_text']);
            $all_sama_sub_cat[$code_value] = $code_text;
        }
        $this->set('all_sama_sub_cat', $all_sama_sub_cat);

//         echo "<pre>";
//        print_r($all_sama_sub_cat);
//        exit();
        $this->loadModel('Cddir');
        $aid_type = $this->Cddir->find('all', array('conditions' => array('code_type' => 'AD'), 'fields' => array('code_value', 'code_text'), 'order' => array('code_text', 'code_text DESC')));

//        echo "<pre>";
//        print_r($aid_type);
//        exit();
        $all_aid_type = array();
        for ($i = 0; $i < count($aid_type); $i++) {
            $code_value = trim($aid_type[$i]['Cddir']['code_value']);
            $code_text = trim($aid_type[$i]['Cddir']['code_text']);
            $all_aid_type[$code_value] = $code_text;
        }
        $this->set('all_aid_type', $all_aid_type);

        $this->loadModel('SelectSansthaBasicInfo');
        $get_sanstha_minority_type = $this->SelectSansthaBasicInfo->getSansthaMinorityType($sanstha_code);
        $this->set('get_sanstha_minority_type', $get_sanstha_minority_type);
    }

    public function SelectBlocksearch() { //dd
        $this->layout = 'ajax';
        $this->loadModel('Block');
        $dist_id = $_POST['dist_id'];
        $block = $this->Block->find('list', array('conditions' => array('substring(Block.blkcd, 1, 4)' => array($dist_id)), 'fields' => array('blkcd', 'blkname'),
            'order' => array('blkname', 'blkname DESC')));
        $this->set('block_list', $block);
//        $this->loadModel('Teacher');
//        $this->Teacher->discardAll();
    }

    public function SelectClustersearch() { //dd
        $this->layout = 'ajax';
        $this->loadModel('ShalaCluster');
//$dist_id = $_POST['dist_id'];
        $block_id = trim($_POST['clus_id']);
//$block_id1 = substr($block_id, 5, 6);
        $cluster_list = $this->ShalaCluster->find('list', array('conditions' => array('substring(ShalaCluster.clucd, 1, 6)' => array($block_id)),
            'fields' => array('clucd', 'cluname'),
            'order' => array('cluname', 'cluname DESC')));
        $this->set('cluster_list', $cluster_list);
//        echo '<pre>'.print_r($cluster_list,true).'</pre>';exit();
//        $this->loadModel('Teacher');
//        $this->Teacher->discardAll();
    }

    public function SelectSchoolsearch() { //dd
        $this->layout = 'ajax';
        $this->loadModel('ShalaSchool');
        $sanstha_code = $this->Session->read('user_id');
        $cluster_id = $_POST['clu_id'];
        $option_schl_type = $_POST['option_schl_type'];


        if ($option_schl_type == '01') { // echo "Primary";
            $schools = $this->ShalaSchool->find('all', array('conditions' => array('clucd' => $cluster_id, 'highest_class <' => 8, 'sanstha_code LIKE ' => $sanstha_code . '%'),
                'fields' => array('schcd', 'school_name'), 'order' => array('school_name', 'school_name DESC')));

            $array_schools = array();
            for ($i = 0; $i < count($schools); $i++) {
                $schcd = trim($schools[$i]['ShalaSchool']['schcd']);
                $school_name = trim($schools[$i]['ShalaSchool']['school_name']) . " ( " . (trim($schools[$i]['ShalaSchool']['schcd'])) . " ) ";
                $array_schools[$schcd] = $school_name;
            }
        }
        if ($option_schl_type == '02') {
            $schools = $this->ShalaSchool->find('all', array('conditions' => array('clucd' => $cluster_id, 'highest_class >=' => 8, 'sanstha_code LIKE ' => $sanstha_code . '%'),
                'fields' => array('schcd', 'school_name'), 'order' => array('school_name', 'school_name DESC')));
//             echo "<pre>";print_r($schools);exit();

            $array_schools = array();
            for ($i = 0; $i < count($schools); $i++) {
                $schcd = trim($schools[$i]['ShalaSchool']['schcd']);
                $school_name = trim($schools[$i]['ShalaSchool']['school_name']) . " ( " . (trim($schools[$i]['ShalaSchool']['schcd'])) . " ) ";
                $array_schools[$schcd] = $school_name;
            }
        }
// echo "<pre>";print_r($schools);exit();
        $this->set('schools', $array_schools);
    }

    public function SelectSchoolSearchSanstha() {
        $this->layout = 'ajax';
        $this->loadModel('SelectSansthaBasicInfo');
        $this->loadModel('ShalaSchool');
        $dist_id = $_POST['dist_id'];


        if (($this->Session->read("user_desc") == 'Education  Officer Primary') || ($this->Session->read("user_desc") == 'Education Officer Secondary')) {
            if ($this->Session->read("user_desc") == 'Education Officer Primary') {
                $FindedSchoolName = $this->ShalaSchool->find('all', array('conditions' => array('substring(schcd, 1, 4)' => $dist_id, 'highest_class <=' => 8))); //
//          echo "pppppppppppp" . "<pre>" . print_r($FindedSchoolName, true) . "</pre>"; exit();
                $array_school_name = array();
                for ($i = 0; $i < count($FindedSchoolName); $i++) {
                    $schcd = trim($FindedSchoolName[$i]['ShalaSchool']['schcd']);
//                    $school_name = trim($FindedSchoolName[$i]['ShalaSchool']['school_name']);
                    $school_name = trim($FindedSchoolName[$i]['ShalaSchool']['school_name']) . " ( " . (trim($FindedSchoolName[$i]['ShalaSchool']['schcd'])) . " ) ";
                    $array_school_name[$schcd] = $school_name;
                }
                $this->set('FindedSchoolName', $array_school_name);
            }
            if ($this->Session->read("user_desc") == 'Education Officer Secondary') {
                $FindedSchoolName = $this->ShalaSchool->find('all', array('conditions' => array('substring(schcd, 1, 4)' => $dist_id, 'highest_class >' => 8)));
                if (!empty($FindedSchoolName)) {
                    $array_school_name = array();
                    for ($i = 0; $i < count($FindedSchoolName); $i++) {
                        $schcd = trim($FindedSchoolName[$i]['ShalaSchool']['schcd']);
//                        $school_name = trim($FindedSchoolName[$i]['ShalaSchool']['school_name']);
                        $school_name = trim($FindedSchoolName[$i]['ShalaSchool']['school_name']) . " ( " . (trim($FindedSchoolName[$i]['ShalaSchool']['schcd'])) . " ) ";
                        $array_school_name[$schcd] = $school_name;
                    }
                    $this->set('FindedSchool Name', $array_school_name);
                }
            }
        }//if outer
//        print_r($array_school_name);
//        exit();
//        $block = $this->SelectSansthaBasicInfo->find('list', array('conditions' => array('substring(Block.blkcd, 1, 4)' => array($dist_id)), 'fields' => array('blkcd', 'blkname'), 'order' => array('blkname', 'blkname DESC')));
    }

    public function searchSchoolNameSanstha() { //dd
        $this->layout = 'ajax';
        $sanstha_id = $this->Session->read('user_id');
        $schoolcode = $_POST['schcode'];
        $sanstha_dist_cd = $_POST['sanstha_dist_cd'];
        $option_schl_type = $_POST['option_schl_type'];

        $this->loadModel('ShalaSchool');

        if (!empty($schoolcode)) {
            $schocde = trim($schoolcode);
            $dist_code = substr($_POST['schcode'], 0, 4); // 2703,2728
            $fullcodename = '';
//            if (($this->Session->read("user_desc") == ' Sanstha')) {
//                $eo_id = $dist_code . "EO" . $option_schl_type;
            if ($option_schl_type == '01') {
                $FindedSchoolName = $this->ShalaSchool->find('all', array('conditions' => array('schcd' => $schocde, 'highest_class <=' => 8, 'sanstha_code LIKE' => $sanstha_id . '%')));
                if (!empty($FindedSchoolName)) {
                    @$name = trim($FindedSchoolName[0]['ShalaSchool']['school_name']);
                    @$code = trim($FindedSchoolName[0]['ShalaSchool']['schcd']);
                    $fullcodename = trim($name);
                    $this->set('FindedSchoolName', $fullcodename);
//                    pr($fullcodename);
//                    die;
                }
            } else if ($option_schl_type == '02') {
                $FindedSchoolName = $this->ShalaSchool->find('all', array('conditions' => array('schcd' => $schocde, 'highest_class >' => 8, 'sanstha_code LIKE' => $sanstha_id . '%')));
                if (!empty($FindedSchoolName)) {
                    @$name = trim($FindedSchoolName[0]['ShalaSchool']['school_name']);
                    @$code = trim($FindedSchoolName[0]['ShalaSchool']['schcd']);
                    $fullcodename = trim($name);
                    $this->set('FindedSchoolName', $fullcodename);
//                    pr($fullcodename);
//                    die;
                }
            }
//            }
//            pr($fullcodename);
//            die;
            if (isset($fullcodename) && isset($fullcodename)) {
                $tmpArrray = array('FindedSchoolName' => $fullcodename);
                echo json_encode($tmpArrray);
            }
        }
    }

    public function SelectSchoolMediumForSanstha() { //dd
        $this->layout = 'ajax';
        $this->loadModel('SelectSchoolMedium');
        $schcode = $_POST['schcode'];
        $option_schl_type = $_POST['option_schl_type'];

//        $block = $this->Block->find('list', array('conditions' => array('substring(Block.blkcd, 1, 4)' => array($dist_id)), 'fields' => array('blkcd', 'blkname'), 'order' => array('blkname', 'blkname DESC')));
//        $this->set('block_list', $block);


        $FindedSchoolMedium = $this->SelectSchoolMedium->getSchoolMedium($schcode, $option_schl_type);
        if (!empty($FindedSchoolMedium)) {
            $array_school_medium_name = array();
            for ($i = 0; $i < count($FindedSchoolMedium); $i++) {
                $medinstr_id = trim($FindedSchoolMedium[$i][0]['medinstr_id']);
                $medinstr_desc = trim($FindedSchoolMedium[$i][0]['medinstr_desc']);
                $array_school_medium_name[$medinstr_id] = $medinstr_desc;
            }
            $this->set('FindedSchoolMedium', $array_school_medium_name);
        }
//                  echo "pppppppppppp" . "<pre>" . print_r($array_school_medium_name, true) . "</pre>"; exit();
    }

    public function SelectSchoolPostsForSanstha() { //dd
        $this->layout = 'ajax';
        $option_schl_type = $_POST['option_schl_type'];
        $user_id = $this->Session->read('user_id');
        if (isset($_POST['schcode'])) {
            $schl_id = $_POST['schcode'];
        } else {
            $schl_id = '';
        }

        if (isset($_POST['school_medium_code'])) {
            $school_medium_code = $_POST['school_medium_code'];
        } else {
            $school_medium_code = '';
        }

        $tchr_type = 1;

        $this->loadModel('SelectTeacherMaster');
        $perticularPostwiseInfoForAcceptAndExcessSanstha = $this->SelectTeacherMaster->getPerticularSchoolsPostwiseInfoForAcceptAndExcessSanstha($schl_id, $tchr_type, $school_medium_code, $option_schl_type);
//        echo "<pre>" . print_r($perticularPostwiseInfoForAcceptAndExcessSanstha, true) . "</pre>";
//        exit();

        if (!empty($perticularPostwiseInfoForAcceptAndExcessSanstha)) {
            $array_perticularPostwiseInfoForAcceptAndExcessSanstha = array();
            for ($i = 0; $i < count($perticularPostwiseInfoForAcceptAndExcessSanstha); $i++) {
                $postid = trim($perticularPostwiseInfoForAcceptAndExcessSanstha[$i][0]['postid']);
                $post_desc = trim($perticularPostwiseInfoForAcceptAndExcessSanstha[$i][0]['post_desc']);
                $array_perticularPostwiseInfoForAcceptAndExcessSanstha[$postid] = $post_desc;
            }
            $this->set('FindedSchoolPosts', $array_perticularPostwiseInfoForAcceptAndExcessSanstha);
        }
//                  echo "pppppppppppp" . "<pre>" . print_r($array_perticularPostwiseInfoForAcceptAndExcessSanstha, true) . "</pre>"; exit();
    }

    public function SelectExcessVacantRadio() { //dd
        $this->layout = 'ajax';
        $sanstha_code = $this->Session->read('user_id');
        $filled_no_of_excess_vancant_posts_hidden = 0;
        if (isset($_POST['school_medium_code'])) {
            $school_medium_code = $_POST['school_medium_code'];
        } else {
            $school_medium_code = '';
        }

        if (isset($_POST['school_posts_code'])) {
            $school_posts_code = $_POST['school_posts_code'];
        } else {
            $school_posts_code = '';
        }

        if (isset($_POST['schcode'])) {
            $schl_id = $_POST['schcode'];
        } else {
            $schl_id = '';
        }


        $tchr_type = 1;
        $this->loadModel('SelectTeacherMaster');
        $perticularPostwiseInfoForAcceptAndExcessSanstha = $this->SelectTeacherMaster->getPerticularPostwiseInfoForAcceptAndExcessSanstha($schl_id, $tchr_type, $school_posts_code, $school_medium_code);
//        $this->set('perticularPostwiseInfoForAcceptAndExcessSanstha', $perticularPostwiseInfoForAcceptAndExcessSanstha);
        if (isset($perticularPostwiseInfoForAcceptAndExcessSanstha)) {

//            echo "".$perticularPostwiseInfoForAcceptAndExcessSanstha[0][0]['aided_cyear_sanch'];
//            exit();

            $aided_cyear_sanch = $perticularPostwiseInfoForAcceptAndExcessSanstha[0][0]['aided_cyear_sanch'];
            $sanchTotal = $aided_cyear_sanch;
            $proposedTotal = 0;
        }



        $this->set('sanch_total', $sanchTotal);
        $this->set('proposed_total', $proposedTotal);
//        $this->set('no_of_excess_vancant_posts_hidden', $no_of_posts);

        $this->loadModel('SelectEoSansthaExVac');
        $filled_no_of_excess_vancant_posts = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change_sum($sanstha_code, $schl_id, $school_medium_code, $school_posts_code);

//            echo "--------<pre>";
//            print_r($filled_no_of_excess_vancant_posts);
//            exit();
        if (isset($filled_no_of_excess_vancant_posts)) {
            if ($filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'] != '') {

                $filled_no_of_excess_vancant_posts_hidden = $filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'];
            } else {
                $filled_no_of_excess_vancant_posts_hidden = 0;
            }
        } else {
            $filled_no_of_excess_vancant_posts_hidden = 0;
        }


        $this->loadModel('SelectEoSansthaExVac');
        $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change($sanstha_code, $schl_id, $school_medium_code, $school_posts_code);
        $this->set('filled_data', $filled_data);

//        echo "--------<pre>";
//        print_r($filled_data);
//        exit();

        $jsonArr = array();
        $jsonArr1 = array();
//        $jsonArr['no_of_excess_vancant_posts_hidden'] = $no_of_posts;
        $jsonArr['sanch_total'] = $sanchTotal;
        $jsonArr['proposed_total'] = $proposedTotal;
        $jsonArr['filled_no_of_excess_vancant_posts_hidden'] = $filled_no_of_excess_vancant_posts_hidden;
        $jsonArr['filled_data'] = $filled_data;

        echo json_encode($jsonArr);
    }

    public function save_excess_vacancy_detail() { //dd
        $this->layout = 'ajax';
        $date = date('Y-m-d H:i:s');
        $sanstha_code = $this->Session->read('user_id');
        $global_ac_year = Configure::read('global_ac_year');
        $minority_sanstha = $this->Session->read('minority_sanstha');
        $this->loadModel('SelectEoSansthaExVac');
//        echo "<pre>" . print_r($this->request->data, true) . "<pre>";
//        exit(); 
        $jsonArr1 = array();
        $filled_no_of_excess_vancant_posts_hidden = 0;

        if (isset($minority_sanstha)) {
            $minority_sanstha = $minority_sanstha;
        } else {
            $minority_sanstha = '';
        }

        if (isset($this->request->data['get_sanstha_minority_type_hidden'])) {
            $get_sanstha_minority_type_hidden = $this->request->data['get_sanstha_minority_type_hidden'];
        } else {
            $get_sanstha_minority_type_hidden = '';
        }

        if (isset($this->request->data['SamayojanConsiderVacancyMinority'])) {
            $consider_vacancy_flag = $this->request->data['SamayojanConsiderVacancyMinority'];
        } else {
            $consider_vacancy_flag = 'N';
        }

        if (isset($this->request->data['sanstha_dist_cd'])) {
            $sanstha_dist_cd = $this->request->data['sanstha_dist_cd'];
        } else {
            $sanstha_dist_cd = '';
        }

        if (isset($this->request->data['option_schl_type'])) {
            $option_schl_type = $this->request->data['option_schl_type'];
        } else {
            $option_schl_type = '';
        }

        if (isset($this->request->data['eo_code'])) {
            $eo_code = $this->request->data['eo_code'];
        } else {
            $eo_code = '';
        }

        if (isset($sanstha_code)) {
            $sanstha_code = trim($sanstha_code);
        } else {
            $sanstha_code = '';
        }

        if (isset($this->request->data['schl_id'])) {
            $schl_id = $this->request->data['schl_id'];
        } else {
            $schl_id = '';
        }

        if (isset($this->request->data['school_medium_code'])) {
            $eos_medium_id = trim($this->request->data['school_medium_code']);
        } else {
            $eos_medium_id = '';
        }

        if (isset($this->request->data['school_posts_code'])) {
            $eos_desg_cd = trim($this->request->data['school_posts_code']);
        } else {
            $eos_desg_cd = '';
        }

        if (isset($this->request->data['sanch_total'])) {
            $sanch_total = trim($this->request->data['sanch_total']);
        } else {
            $sanch_total = '';
        }

        if (isset($this->request->data['proposed_total'])) {
            $proposed_total = trim($this->request->data['proposed_total']);
        } else {
            $proposed_total = '';
        }

        if (isset($this->request->data['sanch_proposed_total'])) {
            $sanch_proposed_total = trim($this->request->data['sanch_proposed_total']);
        } else {
            $sanch_proposed_total = '';
        }

        if (isset($this->request->data['eos_online_posts'])) {
            $eos_online_posts = trim($this->request->data['eos_online_posts']);
        } else {
            $eos_online_posts = '';
        }

        if (isset($this->request->data['eos_offline_posts'])) {
            $eos_offline_posts = trim($this->request->data['eos_offline_posts']);
        } else {
            $eos_offline_posts = '';
        }

        if (isset($this->request->data['eos_online_offline_tot_posts'])) {
            $eos_online_offline_tot_posts = trim($this->request->data['eos_online_offline_tot_posts']);
        } else {
            $eos_online_offline_tot_posts = '';
        }

        if ($eos_online_offline_tot_posts > $sanch_total) {
            $eos_type = '1';
        } else if ($eos_online_offline_tot_posts < $sanch_total) {
            $eos_type = '2';
        }

        if (isset($this->request->data['excess_vacant_cal_posts'])) {
            $excess_vacant_cal_posts = trim($this->request->data['excess_vacant_cal_posts']);
        } else {
            $excess_vacant_cal_posts = '';
        }

        if (isset($this->request->data['no_of_excess_vancant_posts'])) {
            $eos_no_of_post = trim($this->request->data['no_of_excess_vancant_posts']);
        } else {
            $eos_no_of_post = '';
        }

        if (isset($this->request->data['option_subject_code'])) {
            $option_subject_code = trim($this->request->data['option_subject_code']);
        } else {
            $option_subject_code = NULL;
        }

        if (isset($sanstha_code)) {
            $asst_auth = trim($sanstha_code);
        } else {
            $asst_auth = '';
        }

        if (isset($this->request->data['save_modify_delete'])) {
            $save_modify_delete = trim($this->request->data['save_modify_delete']);
        } else {
            $save_modify_delete = '';
        }

        if (isset($this->request->data['save_modify_delete_id'])) {
            $save_modify_delete_id = trim($this->request->data['save_modify_delete_id']);
        } else {
            $save_modify_delete_id = '';
        }

        if (isset($this->request->data['aid_type'])) {
            $aid_type = trim($this->request->data['aid_type']);
        } else {
            $aid_type = '';
        }

        if (isset($this->request->data['staff_level'])) {
            $staff_level = trim($this->request->data['staff_level']);
        } else {
            $staff_level = '';
        }
        if (isset($this->request->data['vac_cr_during'])) {
            $vac_cr_during = trim($this->request->data['vac_cr_during']);
        } else {
            $vac_cr_during = '';
        }
        if (isset($this->request->data['total_vac_posts'])) {
            $total_vac_posts = trim($this->request->data['total_vac_posts']);
        } else {
            $total_vac_posts = '';
        }
        $this->loadModel('SelectEoSansthaExVac');
        $this->loadModel('PvRosterInfo');
        $data_stat = $this->PvRosterInfo->query("select tot_bcklg
                                                from pavitra.pv_roster_info 
                                                where sanstha_code='$sanstha_code'");
        $eos_posts = $this->SelectEoSansthaExVac->query("select sum(eos_no_of_post) from pavitra.pv_eo_sanstha_ex_vac where sanstha_code='$sanstha_code'");
//        pr($eos_posts[0][0]['sum']);
//        pr($data_stat[0][0]['tot_bcklg']);
        if ($eos_posts[0][0]['sum'] >= $data_stat[0][0]['tot_bcklg']) {
            $flags = 2;
            $this->set('flags', $flags);
            $jsonArr['mistmatch_data'] = $flags;
            echo json_encode($jsonArr);
        } else {
            $respose = explode('~', $save_modify_delete_id);

            if (!empty($respose[0])) {
                $data = $this->SelectEoSansthaExVac->query("select * from pavitra.pv_eo_sanstha_ex_vac where sanstha_code='$sanstha_code' and 
                                                    schl_type='$option_schl_type' and
                                                    eo_code ='$eo_code' and 
                                                    schl_id ='$schl_id' and 
                                                    eos_medium_id='$eos_medium_id' and
                                                    eos_desg_cd ='$eos_desg_cd' and 
                                                    eos_subject_cd=$respose[11]");
            } else {
                $data = $this->SelectEoSansthaExVac->query("select sum(eos_no_of_post) from pavitra.pv_eo_sanstha_ex_vac where sanstha_code='$sanstha_code' and 
                                                    schl_type='$option_schl_type' and
                                                    eo_code ='$eo_code' and 
                                                    schl_id ='$schl_id' and 
                                                    eos_medium_id='$eos_medium_id' and
                                                    eos_desg_cd ='$eos_desg_cd'");
            }
//        pr($data);
//        die;
            $flag = 0;
            if (!empty($data) && !empty($data[0][0]['sum']) && $data[0][0]['sum'] >= $total_vac_posts && $save_modify_delete != 'Modify') {
                $flags = 1;
                $this->set('flags', $flags);
                $jsonArr['filled_data'] = $flags;
                echo json_encode($jsonArr);
            } else {
                if (!empty($data) && $save_modify_delete == 'Modify') {
                    $duplicate = $this->SelectEoSansthaExVac->query("select * from pavitra.pv_eo_sanstha_ex_vac where sanstha_code='$sanstha_code' and 
                                                                schl_type='$option_schl_type' and
                                                                eo_code ='$eo_code' and 
                                                                schl_id ='$schl_id' and 
                                                                eos_medium_id='$eos_medium_id' and
                                                                eos_desg_cd ='$eos_desg_cd' and 
                                                                eos_subject_cd = $option_subject_code and aid_type='$aid_type'");
//                pr($duplicate); die;
                    if (empty($duplicate)) {
                        $this->SelectEoSansthaExVac->query("update pavitra.pv_eo_sanstha_ex_vac set  
                                                eos_sm_posts=$sanch_total,
                                                eos_proposed_posts=$proposed_total,
                                                eos_online_posts=$eos_online_posts,
                                                eos_sub_cal_post=$excess_vacant_cal_posts,
                                                eos_type=$eos_type,
                                                eos_no_of_post=$eos_no_of_post,
                                                eos_subject_cd=$option_subject_code,
                                                asst_flag='E',
                                                asst_auth='$asst_auth',
                                                entry_dtts='$date',
                                                ac_year='$global_ac_year',
                                                minority_sanstha=$minority_sanstha,
                                                aid_type='$aid_type',
                                                staff_type='$staff_level',
                                                vac_crd_aft_smj='$vac_cr_during'
                                                where 
                                                sanstha_code='$sanstha_code' and 
                                                schl_type='$option_schl_type' and
                                                eo_code ='$eo_code' and 
                                                schl_id ='$schl_id' and 
                                                eos_medium_id='$eos_medium_id' and
                                                eos_desg_cd ='$eos_desg_cd' and 
                                                eos_subject_cd=$respose[11]");
                    } else {
                        $duplicate = 'duplicate';
                        $jsonArr1['duplicate'] = $duplicate;
                    }
                } else {
                    $duplicate = $this->SelectEoSansthaExVac->query("select * from pavitra.pv_eo_sanstha_ex_vac where sanstha_code='$sanstha_code' and 
                                                                schl_type='$option_schl_type' and
                                                                eo_code ='$eo_code' and 
                                                                schl_id ='$schl_id' and 
                                                                eos_medium_id='$eos_medium_id' and
                                                                eos_desg_cd ='$eos_desg_cd' and 
                                                                eos_subject_cd = $option_subject_code and aid_type='$aid_type'");
                    if (empty($duplicate)) {
                        $sucuess = $this->SelectEoSansthaExVac->save(array(
                            'sanstha_code' => $sanstha_code,
                            'dist_code' => $sanstha_dist_cd,
                            'schl_type' => $option_schl_type,
                            'eo_code' => $eo_code,
                            'schl_id' => $schl_id,
                            'eos_medium_id' => $eos_medium_id,
                            'eos_desg_cd' => $eos_desg_cd,
                            'eos_sm_posts' => $sanch_total,
                            'eos_proposed_posts' => $proposed_total,
                            'eos_online_posts' => $eos_online_posts,
                            'eos_offline_posts' => $eos_offline_posts,
                            'eos_sub_cal_post' => $excess_vacant_cal_posts,
                            'eos_type' => $eos_type,
                            'eos_no_of_post' => $eos_no_of_post,
                            'eos_subject_cd' => $option_subject_code,
                            'asst_flag' => 'E', 'asst_auth' => $asst_auth,
                            'entry_dtts' => $date,
                            'ac_year' => $global_ac_year,
                            'minority_sanstha' => $minority_sanstha,
                            'consider_vacancy_flag' => $consider_vacancy_flag,
                            'aid_type' => $aid_type,
                            'staff_type' => $staff_level,
                            'vac_crd_aft_smj' => $vac_cr_during));
                    } else {
                        $duplicate = 'duplicate';
                        $jsonArr1['duplicate'] = $duplicate;
                    }
                }
                $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type);
                $this->set('filled_data', $filled_data);
                $jsonArr['filled_data'] = $filled_data;
                $jsonArr = $jsonArr + $jsonArr1;
                echo json_encode($jsonArr);
            }
        }
    }

// Forward Vacancy Details

    public function forward_ex_vac_to_eo() {
        $this->layout = 'sanstha_layout';
        $user = $this->Session->read('user_id');
        $global_ac_year = Configure::read('global_ac_year');
        $this->loadModel('SelectEoSansthaExVac');
        $dist_list = $this->SelectEoSansthaExVac->query("SELECT distinct(dist_code), distname
                                                FROM pavitra.pv_eo_sanstha_ex_vac,shala_live.shala_district
                                                where dist_code=distcd
                                                and sanstha_code='" . $user . "'
                                                and ac_year='" . $global_ac_year . "'");

        $dist_array = array();

        for ($i = 0; $i < count($dist_list); $i++) {
            $distcd = trim($dist_list[$i][0]['dist_code']);
            $distname = trim($dist_list[$i][0]['distname']);
            $dist_array[$distcd] = $distname;
        }
        $this->set('district_list', $dist_array);
    }

    public function selectdesig() {
        $this->layout = 'ajax';
        $sanstha_code = $this->Session->read('user_id');
        $dist_cd = $_POST['dist_cd'];
        $schl_type = $_POST['schl_type'];
        $eos_type = $_POST['eos_type'];



        $this->loadModel('SelectEoSansthaExVac');
        $res = $this->SelectEoSansthaExVac->selectDesigsanstha($sanstha_code, $dist_cd, $schl_type, $eos_type);

        $desig_array = array();

        for ($i = 0; $i < count($res); $i++) {
            $desigcd = trim($res[$i][0]['eos_desg_cd']);
            $designame = trim($res[$i][0]['post_desc']);
            $desig_array[$desigcd] = $designame;
        }
        $this->set('desig_list', $desig_array);
    }

    public function selectmed() {
        $this->layout = 'ajax';
        $sanstha_code = $this->Session->read('user_id');

        $this->loadModel('SelectEoSansthaExVac');
        $global_ac_year = Configure::read('global_ac_year');
        $school_details = $this->SelectEoSansthaExVac->query("select distinct(eos_medium_id),medinstr_desc from
                                                                pavitra.pv_eo_sanstha_ex_vac,master.shala_medinstr
                                                                where sanstha_code='" . $sanstha_code . "'
                                                                and eos_medium_id=medinstr_id
                                                                and ac_year='" . $global_ac_year . "'");

        $med_array = array();

        for ($i = 0; $i < count($school_details); $i++) {
            $medcd = trim($school_details[$i][0]['eos_medium_id']);
            $medname = trim($school_details[$i][0]['medinstr_desc']);
            $med_array[$medcd] = $medname;
        }

        if (!empty($med_array))
            $this->set('med_list', $med_array);
    }

    public function getschools() {
        $this->layout = 'ajax';
        $sanstha_code = $this->Session->read('user_id');
        $dist_cd = $_POST['dist_cd'];
        $schl_type = $_POST['schl_type'];
        $eos_type = $_POST['eos_type'];
        $desig_cd = trim($_POST['desig_cd']);
        $med_cd = trim($_POST['med_cd']);
        $this->loadModel('SelectEoSansthaExVac');
        $school_details = $this->SelectEoSansthaExVac->query("select schl_id ,school_name
                                                              from pavitra.pv_eo_sanstha_ex_vac
                                                              left join shala.shala_all_school sas on sas.schcd=schl_id
                                                              where dist_code='$dist_cd'and schl_type='$schl_type' and eos_type='$eos_type'and eos_desg_cd='$desig_cd' and eos_medium_id='$med_cd'");
        $array_schools = array();
        for ($i = 0; $i < count($school_details); $i++) {
            $schcd = trim($school_details[$i][0]['schl_id']);
            $school_name = trim($school_details[$i][0]['school_name']) . " ( " . (trim($school_details[$i][0]['schl_id'])) . " ) ";
            $array_schools[$schcd] = $school_name;
        }
        $this->set('schools', $array_schools);
    }

    public function forward_sanstha_ex_vac_detail() {
        $this->layout = 'ajax';
        $sanstha_code = $this->Session->read('user_id');
        $dist_cd = $_POST['dist_cd'];
        $schl_type = trim($_POST['schl_type']);
        $eos_type = trim($_POST['eos_type']);
        $desig_cd = trim($_POST['desig_cd']);
        $med_cd = trim($_POST['med_cd']);
//        $sch_cd = trim($_POST['sch_cd']);

        $this->set('eos_type', $eos_type);
        $this->loadModel('SelectEoSansthaExVac');
        $school_details = $this->SelectEoSansthaExVac->ex_vac_schl_detail($sanstha_code, $dist_cd, $schl_type, $eos_type, $desig_cd, $med_cd);
        if (!empty($school_details))
            $this->set('school_details', $school_details);
    }

    public function fwdexvacdettoeo() {
        $this->layout = 'ajax';
        $global_ac_year = Configure::read('global_ac_year');
        $sanstha_code = $this->Session->read('user_id');
        $this->set('sanstha_code', $sanstha_code);

//        pr($this->request->data);die;
        $eos_desg_cd_main = $this->request->data['eos_desg_cd_main'];
        $eos_type = trim($this->request->data['eos_type_main']);
        $schl_type = trim($this->request->data['pavitras']['option_schl_type']);
        $med_cd = trim($this->request->data['med_cd']);

        $dist = trim($this->request->data['pavitras']['dist_id_school_help']);

        $this->loadModel('SelectEoSansthaExVac');
        $this->SelectEoSansthaExVac->updateAll(array('asst_flag' => "'F'"), array('sanstha_code' => $sanstha_code, 'eos_desg_cd' => $eos_desg_cd_main, 'schl_type' => $schl_type, 'eos_type' => $eos_type, 'dist_code' => $dist, 'asst_flag' => 'E', 'eos_medium_id' => $med_cd, 'ac_year' => $global_ac_year));
        if ($eos_type == 1) {
            $this->loadModel('SelectExcessTchrDets');
            $this->SelectExcessTchrDets->updateAll(array('asst_flag' => "'F'"), array('sanstha_code' => $sanstha_code, 'tchr_curr_desg_cd' => $eos_desg_cd_main, 'schl_id like' => $dist . "%", 'asst_flag' => 'E', 'sch_type' => $schl_type, 'eos_medium_id' => $med_cd, 'ac_year' => $global_ac_year));
        }

        echo "<script type=\"text/javascript\">window.alert('Data Succesfully forwarded to EO');window.location.href ='forward_ex_vac_to_eo';</script>";
    }

//Verify Vacancy Details

    public function verify_ex_vac_eo() {
        $this->layout = 'eduofficer_layout';
        $user = $this->Session->read('user_id');
        $typ = substr($user, 6);
        $user = substr($user, 0, 4);
        $this->loadModel('SelectEoSansthaExVac');
        $global_ac_year = Configure::read('global_ac_year');
        $dist_list = $this->SelectEoSansthaExVac->query("SELECT distinct(dist_code), distname
                                                         FROM pavitra.pv_eo_sanstha_ex_vac,shala_live.shala_district
                                                         where dist_code='" . $user . "'
                                                         and dist_code=distcd 
                                                         and schl_type = '" . $typ . "'
                                                         and ac_year='" . $global_ac_year . "'
                                                         and minority_sanstha='1'    
                                                         and (asst_flag='F')");

        $dist_array = array();

        for ($i = 0; $i < count($dist_list); $i++) {
            $distcd = trim($dist_list[$i][0]['dist_code']);
            $distname = trim($dist_list[$i][0]['distname']);
            $dist_array[$distcd] = $distname;
        }
        $this->set('district_list', $dist_array);
        $this->set('typ', $typ);
        $this->set('sch_type', $typ);
        $this->set('dist', $user);
        $this->set('min', '1');
    }

    public function selectsanstha() {
        $this->layout = 'ajax';
        $dist_cd = $_POST['dist_cd'];
        $schl_type = $_POST['schl_type'];
        $eos_type = $_POST['eos_type'];
        $sansthatype = $_POST['sansthatype'];
        $this->loadModel('SelectEoSansthaExVac');
        $res = $this->SelectEoSansthaExVac->selectsansthaverif($dist_cd, $schl_type, $eos_type, $sansthatype);

        $sanstha_array = array();

        for ($i = 0; $i < count($res); $i++) {
            $sansthacd = trim($res[$i][0]['sanstha_code']);
            $sansthaname = trim($res[$i][0]['sanstha_name']);
            $sanstha_array[$sansthacd] = $sansthaname;
        }
        $this->set('sanstha_list', $sanstha_array);
    }

    public function selectdesigverif() {
        $this->layout = 'ajax';
        $sanstha_code = $_POST['san_code'];
        $dist_cd = $_POST['dist_cd'];
        $schl_type = $_POST['schl_type'];
        $eos_type = $_POST['eos_type'];

        $this->loadModel('SelectEoSansthaExVac');
        $res = $this->SelectEoSansthaExVac->selectDesigVerif($sanstha_code, $dist_cd, $schl_type, $eos_type);

        $desig_array = array();

        for ($i = 0; $i < count($res); $i++) {
            $desigcd = trim($res[$i][0]['eos_desg_cd']);
            $designame = trim($res[$i][0]['post_desc']);
            $desig_array[$desigcd] = $designame;
        }
        $this->set('desig_list', $desig_array);
    }

    public function selectmedverif() {
        $this->layout = 'ajax';
        $sanstha_code = $this->request->data['san_code'];
        $global_ac_year = Configure::read('global_ac_year');
        $this->loadModel('SelectEoSansthaExVac');
        $school_details = $this->SelectEoSansthaExVac->query("select distinct(eos_medium_id),medinstr_desc from
                                                                pavitra.pv_eo_sanstha_ex_vac,master.shala_medinstr
                                                                where sanstha_code='" . $sanstha_code . "'
                                                                and eos_medium_id=medinstr_id
                                                                and ac_year='" . $global_ac_year . "'");

        $med_array = array();

        for ($i = 0; $i < count($school_details); $i++) {
            $medcd = trim($school_details[$i][0]['eos_medium_id']);
            $medname = trim($school_details[$i][0]['medinstr_desc']);
            $med_array[$medcd] = $medname;
        }

        if (!empty($med_array))
            $this->set('med_list', $med_array);
    }

    public function verify_ex_vac_detail() {
        $this->layout = 'ajax';
        $user = $this->Session->read('user_id');
        $typ = substr($user, 6);
        $eo_code = trim($user);
        $global_ac_year = Configure::read('global_ac_year');
        $dist_cd = $_POST['dist_cd'];
        $schl_type = trim($_POST['schl_type']);
        $eos_type = trim($_POST['eos_type']);
        $desig_cd = trim($_POST['desig_cd']);
        $sanstha_code = trim($_POST['san_code']);
        $med_cd = trim($_POST['med_cd']);
        $date = date('Y-m-d H:i:s');
        $this->set('eos_type', $eos_type);
        $currdt = date('Y-m-d');

        $this->loadModel('SelectEoSansthaExVac');
        $school_details = $this->SelectEoSansthaExVac->ex_vac_schl_detailverif($sanstha_code, $dist_cd, $schl_type, $eos_type, $desig_cd, $med_cd);
        if (!empty($school_details))
            $this->set('school_details', $school_details);
    }

    public function verifrejectexvacdets() {
        $this->layout = 'ajax';

        $dat = $this->request->data;
//        pr($dat);
//        die;
        $global_ac_year = Configure::read('global_ac_year');
        $sanstha_code = $dat['sanstha_code'];
        $eos_desg_cd_main = trim($this->request->data['eos_desg_cd_main']);
        $schl_type = trim($dat['sch_type']);
        $eos_type = trim($dat['pavitras']['eos_type']);
        $dist = trim($dat['dist']);
        $med = trim($dat['med_cd']);
        $date = date('Y-m-d H:i:s');
        $this->loadModel('SelectSansthaBasicInfo');
        $minnonmin = $this->SelectSansthaBasicInfo->find('all', array('conditions' => array('sanstha_code' => $sanstha_code)));
        $minnonmin = trim($minnonmin[0]['SelectSansthaBasicInfo']['minority_sanstha']);
        if ($minnonmin == 1) {
            $returnto = "verify_ex_vac_eo";
        } else {
            $returnto = "verify_ex_vac_eo_min";
        }
        if (trim($dat['vr']) == 1) {
            $this->loadModel('SelectEoSansthaExVac');
            $this->SelectEoSansthaExVac->updateAll(array('asst_flag' => "'V'", 'verif_dtts' => "'$date'"), array('sanstha_code' => $sanstha_code, 'eos_desg_cd' => $eos_desg_cd_main, 'schl_type' => $schl_type, 'eos_type' => $eos_type, 'dist_code' => $dist, 'asst_flag' => array('F', 'C'), 'eos_medium_id' => $med, 'ac_year' => $global_ac_year));
            echo "<script type=\"text/javascript\">window.alert('Data Verified Succesfully');window.location.href ='" . $returnto . "';</script>";
        } else if (trim($dat['vr']) == 2) {
            $this->loadModel('SelectEoSansthaExVac');
            $this->SelectEoSansthaExVac->updateAll(array('asst_flag' => "'R'"), array('sanstha_code' => $sanstha_code, 'eos_desg_cd' => $eos_desg_cd_main, 'schl_type' => $schl_type, 'eos_type' => $eos_type, 'dist_code' => $dist, 'asst_flag' => array('F', 'C'), 'eos_medium_id' => $med, 'ac_year' => $global_ac_year));
            echo "<script type=\"text/javascript\">window.alert('Data Rejected Succesfully');window.location.href ='" . $returnto . "';</script>";
        }
    }

//vacancy details EO
    public function sanstha_excess_vacancy_decalar_eo() {
        $this->layout = 'eduofficer_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $sanstha_code = $this->Session->read('user_id');
        $this->set('sanstha_code', $sanstha_code);


        $this->loadModel('ShalaSchool');
        $sanstha_dist_name = $this->ShalaSchool->getDistListForSanstha($sanstha_code);
//        echo "<pre>";	print_r($sanstha_dist_name); exit();

        $array_sanstha_dist = array();
        for ($i = 0; $i < count($sanstha_dist_name); $i++) {
            $distcd = trim($sanstha_dist_name[$i][0]['distcd']);
            $distname = trim($sanstha_dist_name[$i][0]['distname']);
            $array_sanstha_dist[$distcd] = $distname;
        }
        $this->set('array_sanstha_dist', $array_sanstha_dist);
//        echo "<pre>";	print_r($array_sanstha_dist); exit; 

        $this->loadModel('State');
        $this->set('StateList', $this->State->find('list', array('fields' => array('statcd', 'statname'))));

        $this->loadModel('District');
        $state_id = '27';

//        $dis = $this->District->find('list', array('conditions' => array('distcd' => substr($sanstha_code, 0, 4)), 'fields' => array('distcd', 'distname')));
//        $this->set('district_list', $dis);

        $this->loadModel('Cddir'); //Teacher Posting Mode from Teacher DB
        $all_subject_result = $this->Cddir->getSamayojansSubject();

//        echo "<pre>".print_r($all_subject_result,true)."</pre>";exit();

        $all_sama_sub_cat = array();
        for ($i = 0; $i < count($all_subject_result); $i++) {
            $code_value = trim($all_subject_result[$i][0]['code_value']);
            $code_text = trim($all_subject_result[$i][0]['code_text']);
            $all_sama_sub_cat[$code_value] = $code_text;
        }
        $this->set('all_sama_sub_cat', $all_sama_sub_cat);

//         echo "<pre>";
//        print_r($all_sama_sub_cat);
//        exit();
        $this->loadModel('Cddir');
        $aid_type = $this->Cddir->find('all', array('conditions' => array('code_type' => 'AD'), 'fields' => array('code_value', 'code_text'), 'order' => array('code_text', 'code_text DESC')));

//        echo "<pre>";
//        print_r($aid_type);
//        exit();
        $all_aid_type = array();
        for ($i = 0; $i < count($aid_type); $i++) {
            $code_value = trim($aid_type[$i]['Cddir']['code_value']);
            $code_text = trim($aid_type[$i]['Cddir']['code_text']);
            $all_aid_type[$code_value] = $code_text;
        }
        $this->set('all_aid_type', $all_aid_type);

        $this->loadModel('SelectSansthaBasicInfo');
        $get_sanstha_minority_type = $this->SelectSansthaBasicInfo->getSansthaMinorityType($sanstha_code);
        $this->set('get_sanstha_minority_type', $get_sanstha_minority_type);
    }

    public function SelectBlocksearch_eo() { //dd
        $this->layout = 'ajax';
        $this->loadModel('Block');
        $dist_id = $_POST['dist_id'];
        $block = $this->Block->find('list', array('conditions' => array('substring(Block.blkcd, 1, 4)' => array($dist_id)), 'fields' => array('blkcd', 'blkname'),
            'order' => array('blkname', 'blkname DESC')));
        $this->set('block_list', $block);
//        $this->loadModel('Teacher');
//        $this->Teacher->discardAll();
    }

    public function SelectClustersearch_eo() { //dd
        $this->layout = 'ajax';
        $this->loadModel('ShalaCluster');
//$dist_id = $_POST['dist_id'];
        $block_id = trim($_POST['clus_id']);
//$block_id1 = substr($block_id, 5, 6);
        $cluster_list = $this->ShalaCluster->find('list', array('conditions' => array('substring(ShalaCluster.clucd, 1, 6)' => array($block_id)),
            'fields' => array('clucd', 'cluname'),
            'order' => array('cluname', 'cluname DESC')));
        $this->set('cluster_list', $cluster_list);
//        echo '<pre>'.print_r($cluster_list,true).'</pre>';exit();
//        $this->loadModel('Teacher');
//        $this->Teacher->discardAll();
    }

    public function SelectSchoolsearch_eo() { //dd
        $this->layout = 'ajax';
        $this->loadModel('ShalaSchool');
        $sanstha_code = $this->Session->read('user_id');
        $cluster_id = $_POST['clu_id'];
        $option_schl_type = $_POST['option_schl_type'];


        if ($option_schl_type == '01') { // echo "Primary";
            $schools = $this->ShalaSchool->find('all', array('conditions' => array('clucd' => $cluster_id, 'highest_class <' => 8, 'sanstha_code LIKE ' => $sanstha_code . '%'),
                'fields' => array('schcd', 'school_name'), 'order' => array('school_name', 'school_name DESC')));

            $array_schools = array();
            for ($i = 0; $i < count($schools); $i++) {
                $schcd = trim($schools[$i]['ShalaSchool']['schcd']);
                $school_name = trim($schools[$i]['ShalaSchool']['school_name']) . " ( " . (trim($schools[$i]['ShalaSchool']['schcd'])) . " ) ";
                $array_schools[$schcd] = $school_name;
            }
        }
        if ($option_schl_type == '02') {
            $schools = $this->ShalaSchool->find('all', array('conditions' => array('clucd' => $cluster_id, 'highest_class >=' => 8, 'sanstha_code LIKE ' => $sanstha_code . '%'),
                'fields' => array('schcd', 'school_name'), 'order' => array('school_name', 'school_name DESC')));
//             echo "<pre>";print_r($schools);exit();

            $array_schools = array();
            for ($i = 0; $i < count($schools); $i++) {
                $schcd = trim($schools[$i]['ShalaSchool']['schcd']);
                $school_name = trim($schools[$i]['ShalaSchool']['school_name']) . " ( " . (trim($schools[$i]['ShalaSchool']['schcd'])) . " ) ";
                $array_schools[$schcd] = $school_name;
            }
        }
// echo "<pre>";print_r($schools);exit();
        $this->set('schools', $array_schools);
    }

    public function SelectSchoolSearchSanstha_eo() {
        $this->layout = 'ajax';
        $this->loadModel('SelectSansthaBasicInfo');
        $this->loadModel('ShalaSchool');
        $dist_id = $_POST['dist_id'];


        if (($this->Session->read("user_desc") == 'Education  Officer Primary') || ($this->Session->read("user_desc") == 'Education Officer Secondary')) {
            if ($this->Session->read("user_desc") == 'Education Officer Primary') {
                $FindedSchoolName = $this->ShalaSchool->find('all', array('conditions' => array('substring(schcd, 1, 4)' => $dist_id, 'highest_class <=' => 8))); //
//          echo "pppppppppppp" . "<pre>" . print_r($FindedSchoolName, true) . "</pre>"; exit();
                $array_school_name = array();
                for ($i = 0; $i < count($FindedSchoolName); $i++) {
                    $schcd = trim($FindedSchoolName[$i]['ShalaSchool']['schcd']);
//                    $school_name = trim($FindedSchoolName[$i]['ShalaSchool']['school_name']);
                    $school_name = trim($FindedSchoolName[$i]['ShalaSchool']['school_name']) . " ( " . (trim($FindedSchoolName[$i]['ShalaSchool']['schcd'])) . " ) ";
                    $array_school_name[$schcd] = $school_name;
                }
                $this->set('FindedSchoolName', $array_school_name);
            }
            if ($this->Session->read("user_desc") == 'Education Officer Secondary') {
                $FindedSchoolName = $this->ShalaSchool->find('all', array('conditions' => array('substring(schcd, 1, 4)' => $dist_id, 'highest_class >' => 8)));
                if (!empty($FindedSchoolName)) {
                    $array_school_name = array();
                    for ($i = 0; $i < count($FindedSchoolName); $i++) {
                        $schcd = trim($FindedSchoolName[$i]['ShalaSchool']['schcd']);
//                        $school_name = trim($FindedSchoolName[$i]['ShalaSchool']['school_name']);
                        $school_name = trim($FindedSchoolName[$i]['ShalaSchool']['school_name']) . " ( " . (trim($FindedSchoolName[$i]['ShalaSchool']['schcd'])) . " ) ";
                        $array_school_name[$schcd] = $school_name;
                    }
                    $this->set('FindedSchool Name', $array_school_name);
                }
            }
        }//if outer
//        print_r($array_school_name);
//        exit();
//        $block = $this->SelectSansthaBasicInfo->find('list', array('conditions' => array('substring(Block.blkcd, 1, 4)' => array($dist_id)), 'fields' => array('blkcd', 'blkname'), 'order' => array('blkname', 'blkname DESC')));
    }

    public function searchSchoolNameSanstha_eo() { //dd
        $this->layout = 'ajax';
        $sanstha_id = $this->Session->read('user_id');
        $schoolcode = $_POST['schcode'];
        $sanstha_dist_cd = $_POST['sanstha_dist_cd'];
        $option_schl_type = $_POST['option_schl_type'];

        $this->loadModel('ShalaSchool');

        if (!empty($schoolcode)) {
            $schocde = trim($schoolcode);
            $dist_code = substr($_POST['schcode'], 0, 4); // 2703,2728
            $fullcodename = '';
//            if (($this->Session->read("user_desc") == ' Sanstha')) {
//                $eo_id = $dist_code . "EO" . $option_schl_type;
            if ($option_schl_type == '01') {
                $FindedSchoolName = $this->ShalaSchool->find('all', array('conditions' => array('schcd' => $schocde, 'highest_class <=' => 8, 'sanstha_code LIKE ' => $sanstha_id . '%')));
                if (!empty($FindedSchoolName)) {
                    @$name = trim($FindedSchoolName[0]['ShalaSchool']['school_name']);
                    @$code = trim($FindedSchoolName[0]['ShalaSchool']['schcd']);
                    $fullcodename = trim($name);
                    $this->set('FindedSchoolName', $fullcodename);
//                    pr($fullcodename);
//                    die;
                }
            } else if ($option_schl_type == '02') {
                $FindedSchoolName = $this->ShalaSchool->find('all', array('conditions' => array('schcd' => $schocde, 'highest_class >' => 8, 'sanstha_code LIKE ' => $sanstha_id . '%')));
                if (!empty($FindedSchoolName)) {
                    @$name = trim($FindedSchoolName[0]['ShalaSchool']['school_name']);
                    @$code = trim($FindedSchoolName[0]['ShalaSchool']['schcd']);
                    $fullcodename = trim($name);
                    $this->set('FindedSchoolName', $fullcodename);
//                    pr($fullcodename);
//                    die;
                }
            }
//            }
            if (isset($fullcodename) && isset($fullcodename)) {
                $tmpArrray = array('FindedSchoolName' => $fullcodename);
                echo json_encode($tmpArrray);
            }
        }
    }

    public function SelectSchoolMediumForSanstha_eo() { //dd
        $this->layout = 'ajax';
        $this->loadModel('SelectSchoolMedium');
        $schcode = $_POST['schcode'];
        $option_schl_type = $_POST['option_schl_type'];

//        $block = $this->Block->find('list', array('conditions' => array('substring(Block.blkcd, 1, 4)' => array($dist_id)), 'fields' => array('blkcd', 'blkname'), 'order' => array('blkname', 'blkname DESC')));
//        $this->set('block_list', $block);


        $FindedSchoolMedium = $this->SelectSchoolMedium->getSchoolMedium($schcode, $option_schl_type);
        if (!empty($FindedSchoolMedium)) {
            $array_school_medium_name = array();
            for ($i = 0; $i < count($FindedSchoolMedium); $i++) {
                $medinstr_id = trim($FindedSchoolMedium[$i][0]['medinstr_id']);
                $medinstr_desc = trim($FindedSchoolMedium[$i][0]['medinstr_desc']);
                $array_school_medium_name[$medinstr_id] = $medinstr_desc;
            }
            $this->set('FindedSchoolMedium', $array_school_medium_name);
        }
//                  echo "pppppppppppp" . "<pre>" . print_r($array_school_medium_name, true) . "</pre>"; exit();
    }

    public function SelectSchoolPostsForSanstha_eo() { //dd
        $this->layout = 'ajax';
        $user_id = $this->Session->read('user_id');
        if (isset($_POST['schcode'])) {
            $schl_id = $_POST['schcode'];
        } else {
            $schl_id = '';
        }

        if (isset($_POST['school_medium_code'])) {
            $school_medium_code = $_POST['school_medium_code'];
        } else {
            $school_medium_code = '';
        }

        $tchr_type = 1;

        $this->loadModel('SelectTeacherMaster');
        $perticularPostwiseInfoForAcceptAndExcessSanstha = $this->SelectTeacherMaster->getPerticularSchoolsPostwiseInfoForAcceptAndExcessSanstha($schl_id, $tchr_type, $school_medium_code);
//        echo "<pre>" . print_r($perticularPostwiseInfoForAcceptAndExcessSanstha, true) . "</pre>";
//        exit();

        if (!empty($perticularPostwiseInfoForAcceptAndExcessSanstha)) {
            $array_perticularPostwiseInfoForAcceptAndExcessSanstha = array();
            for ($i = 0; $i < count($perticularPostwiseInfoForAcceptAndExcessSanstha); $i++) {
                $postid = trim($perticularPostwiseInfoForAcceptAndExcessSanstha[$i][0]['postid']);
                $post_desc = trim($perticularPostwiseInfoForAcceptAndExcessSanstha[$i][0]['post_desc']);
                $array_perticularPostwiseInfoForAcceptAndExcessSanstha[$postid] = $post_desc;
            }
            $this->set('FindedSchoolPosts', $array_perticularPostwiseInfoForAcceptAndExcessSanstha);
        }
//                  echo "pppppppppppp" . "<pre>" . print_r($array_perticularPostwiseInfoForAcceptAndExcessSanstha, true) . "</pre>"; exit();
    }

    public function SelectExcessVacantRadio_eo() { //dd
        $this->layout = 'ajax';
        $sanstha_code = $this->Session->read('user_id');
        $filled_no_of_excess_vancant_posts_hidden = 0;
        if (isset($_POST['school_medium_code'])) {
            $school_medium_code = $_POST['school_medium_code'];
        } else {
            $school_medium_code = '';
        }

        if (isset($_POST['school_posts_code'])) {
            $school_posts_code = $_POST['school_posts_code'];
        } else {
            $school_posts_code = '';
        }

        if (isset($_POST['schcode'])) {
            $schl_id = $_POST['schcode'];
        } else {
            $schl_id = '';
        }


        $tchr_type = 1;
        $this->loadModel('SelectTeacherMaster');
        $perticularPostwiseInfoForAcceptAndExcessSanstha = $this->SelectTeacherMaster->getPerticularPostwiseInfoForAcceptAndExcessSanstha($schl_id, $tchr_type, $school_posts_code, $school_medium_code);
//        $this->set('perticularPostwiseInfoForAcceptAndExcessSanstha', $perticularPostwiseInfoForAcceptAndExcessSanstha);
        if (isset($perticularPostwiseInfoForAcceptAndExcessSanstha)) {

//            echo "".$perticularPostwiseInfoForAcceptAndExcessSanstha[0][0]['aided_cyear_sanch'];
//            exit();

            $aided_cyear_sanch = $perticularPostwiseInfoForAcceptAndExcessSanstha[0][0]['aided_cyear_sanch'];
            $sanchTotal = $aided_cyear_sanch;
            $proposedTotal = 0;
        }



        $this->set('sanch_total', $sanchTotal);
        $this->set('proposed_total', $proposedTotal);
//        $this->set('no_of_excess_vancant_posts_hidden', $no_of_posts);

        $this->loadModel('SelectEoSansthaExVac');
        $filled_no_of_excess_vancant_posts = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change_sum($sanstha_code, $schl_id, $school_medium_code, $school_posts_code);

//            echo "--------<pre>";
//            print_r($filled_no_of_excess_vancant_posts);
//            exit();
        if (isset($filled_no_of_excess_vancant_posts)) {
            if ($filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'] != '') {

                $filled_no_of_excess_vancant_posts_hidden = $filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'];
            } else {
                $filled_no_of_excess_vancant_posts_hidden = 0;
            }
        } else {
            $filled_no_of_excess_vancant_posts_hidden = 0;
        }


        $this->loadModel('SelectEoSansthaExVac');
        $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change($sanstha_code, $schl_id, $school_medium_code, $school_posts_code);
        $this->set('filled_data', $filled_data);

//        echo "--------<pre>";
//        print_r($filled_data);
//        exit();

        $jsonArr = array();

//        $jsonArr['no_of_excess_vancant_posts_hidden'] = $no_of_posts;
        $jsonArr['sanch_total'] = $sanchTotal;
        $jsonArr['proposed_total'] = $proposedTotal;
        $jsonArr['filled_no_of_excess_vancant_posts_hidden'] = $filled_no_of_excess_vancant_posts_hidden;
        $jsonArr['filled_data'] = $filled_data;

        echo json_encode($jsonArr);
    }

    public function save_excess_vacancy_detail_eo() { //dd
        $this->layout = 'ajax';
        $date = date('Y-m-d H:i:s');
        $sanstha_code = $this->Session->read('user_id');
        $global_ac_year = Configure::read('global_ac_year');
        $minority_sanstha = $this->Session->read('minority_sanstha');
        $this->loadModel('SelectEoSansthaExVac');
//        echo "<pre>" . print_r($this->request->data, true) . "<pre>";
//        exit(); 
        $filled_no_of_excess_vancant_posts_hidden = 0;

        if (isset($minority_sanstha)) {
            $minority_sanstha = $minority_sanstha;
        } else {
            $minority_sanstha = '';
        }

        if (isset($this->request->data['get_sanstha_minority_type_hidden'])) {
            $get_sanstha_minority_type_hidden = $this->request->data['get_sanstha_minority_type_hidden'];
        } else {
            $get_sanstha_minority_type_hidden = '';
        }


        if (isset($this->request->data['SamayojanConsiderVacancyMinority'])) {
            $consider_vacancy_flag = $this->request->data['SamayojanConsiderVacancyMinority'];
        } else {
            $consider_vacancy_flag = 'N';
        }


        if (isset($this->request->data['sanstha_dist_cd'])) {
            $sanstha_dist_cd = $this->request->data['sanstha_dist_cd'];
        } else {
            $sanstha_dist_cd = '';
        }

        if (isset($this->request->data['option_schl_type'])) {
            $option_schl_type = $this->request->data['option_schl_type'];
        } else {
            $option_schl_type = '';
        }

        if (isset($this->request->data['eo_code'])) {
            $eo_code = $this->request->data['eo_code'];
        } else {
            $eo_code = '';
        }

        if (isset($sanstha_code)) {
            $sanstha_code = trim($sanstha_code);
        } else {
            $sanstha_code = '';
        }

        if (isset($this->request->data['schl_id'])) {
            $schl_id = $this->request->data['schl_id'];
        } else {
            $schl_id = '';
        }

        if (isset($this->request->data['school_medium_code'])) {
            $eos_medium_id = trim($this->request->data['school_medium_code']);
        } else {
            $eos_medium_id = '';
        }

        if (isset($this->request->data['school_posts_code'])) {
            $eos_desg_cd = trim($this->request->data['school_posts_code']);
        } else {
            $eos_desg_cd = '';
        }

        if (isset($this->request->data['sanch_total'])) {
            $sanch_total = trim($this->request->data['sanch_total']);
        } else {
            $sanch_total = '';
        }

        if (isset($this->request->data['proposed_total'])) {
            $proposed_total = trim($this->request->data['proposed_total']);
        } else {
            $proposed_total = '';
        }

        if (isset($this->request->data['sanch_proposed_total'])) {
            $sanch_proposed_total = trim($this->request->data['sanch_proposed_total']);
        } else {
            $sanch_proposed_total = '';
        }

        if (isset($this->request->data['eos_online_posts'])) {
            $eos_online_posts = trim($this->request->data['eos_online_posts']);
        } else {
            $eos_online_posts = '';
        }

        if (isset($this->request->data['eos_offline_posts'])) {
            $eos_offline_posts = trim($this->request->data['eos_offline_posts']);
        } else {
            $eos_offline_posts = '';
        }

        if (isset($this->request->data['eos_online_offline_tot_posts'])) {
            $eos_online_offline_tot_posts = trim($this->request->data['eos_online_offline_tot_posts']);
        } else {
            $eos_online_offline_tot_posts = '';
        }

        if ($eos_online_offline_tot_posts > $sanch_total) {
            $eos_type = '1';
        } else if ($eos_online_offline_tot_posts < $sanch_total) {
            $eos_type = '2';
        }

        if (isset($this->request->data['excess_vacant_cal_posts'])) {
            $excess_vacant_cal_posts = trim($this->request->data['excess_vacant_cal_posts']);
        } else {
            $excess_vacant_cal_posts = '';
        }

        if (isset($this->request->data['no_of_excess_vancant_posts'])) {
            $eos_no_of_post = trim($this->request->data['no_of_excess_vancant_posts']);
        } else {
            $eos_no_of_post = '';
        }

        if (isset($this->request->data['option_subject_code'])) {
            $option_subject_code = trim($this->request->data['option_subject_code']);
        } else {
            $option_subject_code = NULL;
        }

        if (isset($sanstha_code)) {
            $asst_auth = trim($sanstha_code);
        } else {
            $asst_auth = '';
        }

        if (isset($this->request->data['save_modify_delete'])) {
            $save_modify_delete = trim($this->request->data['save_modify_delete']);
        } else {
            $save_modify_delete = '';
        }

        if (isset($this->request->data['save_modify_delete_id'])) {
            $save_modify_delete_id = trim($this->request->data['save_modify_delete_id']);
        } else {
            $save_modify_delete_id = '';
        }

        if (isset($this->request->data['aid_type'])) {
            $aid_type = trim($this->request->data['aid_type']);
        } else {
            $aid_type = '';
        }

        if (isset($this->request->data['staff_level'])) {
            $staff_level = trim($this->request->data['staff_level']);
        } else {
            $staff_level = '';
        }

        if ($save_modify_delete == '') {//SAVE/INSERT
            $this->loadModel('SelectEoSansthaExVac');

            if (isset($option_subject_code_find)) {
                $option_subject_code_find = $option_subject_code;
            } else {
                $option_subject_code_find = 'NULL';
            }

            $eos_type_filled = '';
            $find_sucuess_eo_type = $this->SelectEoSansthaExVac->findFilledDataInfo_find_sucuess_ex_vac($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd);
            $eos_type_filled = $find_sucuess_eo_type[0][0]['eos_type'];

            if ($eos_type == $eos_type_filled || $eos_type_filled == '') {


                $find_sucuess = $this->SelectEoSansthaExVac->findFilledDataInfo_find_sucuess($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type, $option_subject_code);

                $checkdata = $this->SelectEoSansthaExVac->checkdata($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type);

                if ($excess_vacant_cal_posts == $checkdata[0][0]['eos_no_of_post'] || $excess_vacant_cal_posts < ($checkdata[0][0]['eos_no_of_post'] + $eos_no_of_post)) {
                    $find_sucuess = 2;
                    $jsonArr['filled_data_success'] = $find_sucuess;
                    echo json_encode($jsonArr);
                }
//                echo $excess_vacant_cal_posts;
//                pr($checkdata);
//                die;
//            echo "<pre>";
//            print_r($find_sucuess_eo_type);exit;
                if ($find_sucuess == 0) {
                    $sucuess = $this->SelectEoSansthaExVac->save(array(
                        'sanstha_code' => $sanstha_code,
                        'dist_code' => $sanstha_dist_cd,
                        'schl_type' => $option_schl_type,
                        'eo_code' => $eo_code,
                        'schl_id' => $schl_id,
                        'eos_medium_id' => $eos_medium_id,
                        'eos_desg_cd' => $eos_desg_cd,
                        'eos_sm_posts' => $sanch_total,
                        'eos_proposed_posts' => $proposed_total,
                        'eos_online_posts' => $eos_online_posts,
                        'eos_offline_posts' => $eos_offline_posts,
                        'eos_sub_cal_post' => $excess_vacant_cal_posts,
                        'eos_type' => $eos_type,
                        'eos_no_of_post' => $eos_no_of_post,
                        'eos_subject_cd' => $option_subject_code,
                        'asst_flag' => 'E', 'asst_auth' => $asst_auth,
                        'entry_dtts' => $date,
                        'ac_year' => $global_ac_year,
                        'minority_sanstha' => $minority_sanstha,
                        'consider_vacancy_flag' => $consider_vacancy_flag,
                        'aid_type' => $aid_type,
                        'staff_type' => $staff_level)); //


                    if (isset($sucuess)) {


                        $sanstha_code = $sucuess['SelectEoSansthaExVac']['sanstha_code'];
                        $dist_code = $sucuess['SelectEoSansthaExVac']['dist_code'];
                        $schl_type = $sucuess['SelectEoSansthaExVac']['schl_type'];
                        $eo_code = $sucuess['SelectEoSansthaExVac']['eo_code'];

                        $schl_id = $sucuess['SelectEoSansthaExVac']['schl_id'];
                        $eos_medium_id = $sucuess['SelectEoSansthaExVac']['eos_medium_id'];
                        $eos_desg_cd = $sucuess['SelectEoSansthaExVac']['eos_desg_cd'];

                        $eos_sm_posts = $sucuess['SelectEoSansthaExVac']['eos_sm_posts'];
                        $eos_proposed_posts = $sucuess['SelectEoSansthaExVac']['eos_proposed_posts'];

                        $eos_online_posts = $sucuess['SelectEoSansthaExVac']['eos_online_posts'];
                        $eos_offline_posts = $sucuess['SelectEoSansthaExVac']['eos_online_posts'];

                        $eos_sub_cal_post = $sucuess['SelectEoSansthaExVac']['eos_sub_cal_post'];

                        $eos_type = $sucuess['SelectEoSansthaExVac']['eos_type'];
                        $eos_no_of_post = $sucuess['SelectEoSansthaExVac']['eos_no_of_post'];
                        $option_subject_code = $sucuess['SelectEoSansthaExVac']['eos_subject_cd'];

                        $consider_vacancy_flag = $sucuess['SelectEoSansthaExVac']['consider_vacancy_flag'];
                        $minority_sanstha = $sucuess['SelectEoSansthaExVac']['minority_sanstha'];



                        $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type);
                        $this->set('filled_data', $filled_data);



                        $this->loadModel('SelectEoSansthaExVac');
                        $filled_no_of_excess_vancant_posts = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change_sum($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd);
                        if (isset($filled_no_of_excess_vancant_posts)) {
                            if ($filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'] != '') {
                                $filled_no_of_excess_vancant_posts_hidden = $filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'];
                            } else {
                                $filled_no_of_excess_vancant_posts_hidden = 0;
                            }
                        } else {
                            $filled_no_of_excess_vancant_posts_hidden = 0;
                        }

                        $jsonArr['filled_data'] = $filled_data;
                        $jsonArr['filled_data_success'] = $find_sucuess;
                        $jsonArr['filled_no_of_excess_vancant_posts_hidden'] = $filled_no_of_excess_vancant_posts_hidden;
                        echo json_encode($jsonArr);

//                        echo "SUCESSSSSS";
//                        echo "<pre>".print_r($jsonArr,true)."</pre>";exit();
                    }
                } else if ($find_sucuess == 1) {

                    $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type);

                    $jsonArr['filled_data'] = $filled_data;
                    $jsonArr['filled_data_success'] = $find_sucuess;

                    $this->loadModel('SelectEoSansthaExVac');
                    $filled_no_of_excess_vancant_posts = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change_sum($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd);
                    if (isset($filled_no_of_excess_vancant_posts)) {
                        if ($filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'] != '') {
                            $filled_no_of_excess_vancant_posts_hidden = $filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'];
                        } else {
                            $filled_no_of_excess_vancant_posts_hidden = 0;
                        }
                    } else {
                        $filled_no_of_excess_vancant_posts_hidden = 0;
                    }

                    $jsonArr['filled_no_of_excess_vancant_posts_hidden'] = $filled_no_of_excess_vancant_posts_hidden;
                    echo json_encode($jsonArr);
                }
            } else if ($eos_type != $eos_type_filled) {


                $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type);
                $find_sucuess = 1;
                $jsonArr['filled_data'] = $filled_data;
                $jsonArr['filled_data_success'] = $find_sucuess;

                $this->loadModel('SelectEoSansthaExVac');
                $filled_no_of_excess_vancant_posts = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change_sum($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd);
                if (isset($filled_no_of_excess_vancant_posts)) {
                    if ($filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'] != '') {
                        $filled_no_of_excess_vancant_posts_hidden = $filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'];
                    } else {
                        $filled_no_of_excess_vancant_posts_hidden = 0;
                    }
                } else {
                    $filled_no_of_excess_vancant_posts_hidden = 0;
                }

                $jsonArr['filled_no_of_excess_vancant_posts_hidden'] = $filled_no_of_excess_vancant_posts_hidden;
                echo json_encode($jsonArr);
            }
        } else if ($save_modify_delete == 'Modify') {//MODIFY/UPDATE
// $.trim(val.dist_code) 0
// $.trim(val.schl_type) 1
// $.trim(val.eo_code) 2
// $.trim(val.sanstha_code) 3
// $.trim(val.schl_id) 4
// $.trim(val.eos_medium_id) 5
// $.trim(val.eos_desg_cd) 6
// $.trim(val.eos_type) 7
// $.trim(val.eos_online_posts) 8
// $.trim(val.eos_offline_posts) 9
// $.trim(val.eos_no_of_post) 10
// $.trim(val.eos_subject_cd) 11
// $.trim(val.asst_flag);12
            $arr_save_modify_delete_id = split("~", $save_modify_delete_id);

//            echo "ARRAY";
//            echo "<pre>".print_r($arr_save_modify_delete_id,true)."</pre>";
//            exit();
            $sanstha_dist_cd_old = trim($arr_save_modify_delete_id[0]);
            $option_schl_type_old = trim($arr_save_modify_delete_id[1]);
            $eo_code_old = trim($arr_save_modify_delete_id[2]);
            $sanstha_code_old = trim($arr_save_modify_delete_id[3]);
            $schl_id_old = trim($arr_save_modify_delete_id[4]);
            $eos_medium_id_old = trim($arr_save_modify_delete_id[5]);
            $eos_desg_cd_old = trim($arr_save_modify_delete_id[6]);
            $eos_online_posts_old = trim($arr_save_modify_delete_id[8]);
            $eos_offline_posts_old = trim($arr_save_modify_delete_id[9]);
            $eos_type_old = trim($arr_save_modify_delete_id[7]);
            $eos_no_of_post_old = trim($arr_save_modify_delete_id[10]);
            if (isset($arr_save_modify_delete_id[11])) {
                $option_subject_code_old = trim($arr_save_modify_delete_id[11]);
            } else {
                $option_subject_code_old = NULL;
            }

            $asst_flag_old = trim($arr_save_modify_delete_id[12]);

            $consider_vacancy_flag_old = trim($arr_save_modify_delete_id[13]);



            $eos_type_filled = '';
            $find_sucuess_eo_type = $this->SelectEoSansthaExVac->findFilledDataInfo_find_sucuess_ex_vac($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd);
            $eos_type_filled = $find_sucuess_eo_type[0][0]['eos_type'];

            if ($eos_type == $eos_type_filled || $eos_type_filled == '') {

                $this->loadModel('SelectEoSansthaExVac');

                $find_sucuess = $this->SelectEoSansthaExVac->findFilledDataInfo_find_sucuessMM($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type, $option_subject_code);
//IMP NOTE HERE 0=TRUE AND 1=FALSE
//            echo "<pre>";
//            print_r($find_sucuess);
                if ($find_sucuess == 0) {
//                    echo "IFFF1222222222".$asst_flag_old;exit();
                    $this->loadModel('SelectEoSansthaExVac');
                    $sucuess = $this->SelectEoSansthaExVac->updateFilledDataInfo(
                            $sanstha_dist_cd_old, $option_schl_type_old, $eo_code_old, $sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old, $eos_online_posts_old, $eos_offline_posts_old, $eos_type_old, $eos_no_of_post_old, $option_subject_code_old, $asst_flag_old, $consider_vacancy_flag_old, $sanstha_dist_cd, $option_schl_type, $eo_code, $sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_online_posts, $eos_offline_posts, $eos_type, $eos_no_of_post, $option_subject_code, $consider_vacancy_flag);

                    if (isset($sucuess)) {
                        if ($sucuess == 1) {
//                            echo "IFFF333333333333";
                            $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type);
                            $jsonArr['filled_data'] = $filled_data;
                            $jsonArr['filled_data_success'] = $find_sucuess;
                            $this->loadModel('SelectEoSansthaExVac');
                            $filled_no_of_excess_vancant_posts = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change_sum($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd);
                            if (isset($filled_no_of_excess_vancant_posts)) {
                                if ($filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'] != '') {
                                    $filled_no_of_excess_vancant_posts_hidden = $filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'];
                                } else {
                                    $filled_no_of_excess_vancant_posts_hidden = 0;
                                }
                            } else {
                                $filled_no_of_excess_vancant_posts_hidden = 0;
                            }
                            $jsonArr['filled_no_of_excess_vancant_posts_hidden'] = $filled_no_of_excess_vancant_posts_hidden;
                            echo json_encode($jsonArr);
                        } else {
                            $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo($sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old, $eos_type_old);
                            $jsonArr['filled_data'] = $filled_data;
                            $jsonArr['filled_data_success'] = $find_sucuess;
                            $this->loadModel('SelectEoSansthaExVac');
                            $filled_no_of_excess_vancant_posts = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change_sum($sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old);
                            if (isset($filled_no_of_excess_vancant_posts)) {
                                if ($filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'] != '') {
                                    $filled_no_of_excess_vancant_posts_hidden = $filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'];
                                } else {
                                    $filled_no_of_excess_vancant_posts_hidden = 0;
                                }
                            } else {
                                $filled_no_of_excess_vancant_posts_hidden = 0;
                            }
                            $jsonArr['filled_no_of_excess_vancant_posts_hidden'] = $filled_no_of_excess_vancant_posts_hidden;
                            echo json_encode($jsonArr);
                        }
                    }
                } else if ($find_sucuess == 1) {
                    $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type);
                    $jsonArr['filled_data'] = $filled_data;
                    $jsonArr['filled_data_success'] = $find_sucuess;
                    $this->loadModel('SelectEoSansthaExVac');
                    $filled_no_of_excess_vancant_posts = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change_sum($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd);
                    if (isset($filled_no_of_excess_vancant_posts)) {
                        if ($filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'] != '') {
                            $filled_no_of_excess_vancant_posts_hidden = $filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'];
                        } else {
                            $filled_no_of_excess_vancant_posts_hidden = 0;
                        }
                    } else {
                        $filled_no_of_excess_vancant_posts_hidden = 0;
                    }
                    $jsonArr['filled_no_of_excess_vancant_posts_hidden'] = $filled_no_of_excess_vancant_posts_hidden;
                    echo json_encode($jsonArr);
                }
            } else if ($eos_type != $eos_type_filled) {


                $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd, $eos_type);
                $find_sucuess = 1;
                $jsonArr['filled_data'] = $filled_data;
                $jsonArr['filled_data_success'] = $find_sucuess;

                $this->loadModel('SelectEoSansthaExVac');
                $filled_no_of_excess_vancant_posts = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change_sum($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd);
                if (isset($filled_no_of_excess_vancant_posts)) {
                    if ($filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'] != '') {
                        $filled_no_of_excess_vancant_posts_hidden = $filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'];
                    } else {
                        $filled_no_of_excess_vancant_posts_hidden = 0;
                    }
                } else {
                    $filled_no_of_excess_vancant_posts_hidden = 0;
                }

                $jsonArr['filled_no_of_excess_vancant_posts_hidden'] = $filled_no_of_excess_vancant_posts_hidden;
                echo json_encode($jsonArr);
            }
        } else if ($save_modify_delete == 'Delete') {//MODIFY/UPDATE
            $find_sucuess = 0;
// $.trim(val.dist_code) 0    
// $.trim(val.schl_type) 1
// $.trim(val.eo_code) 2
// $.trim(val.sanstha_code) 3
// $.trim(val.schl_id) 4
// $.trim(val.eos_medium_id) 5
// $.trim(val.eos_desg_cd) 6
// $.trim(val.eos_type) 7
// $.trim(val.eos_online_posts) 8
// $.trim(val.eos_offline_posts) 9
// $.trim(val.eos_no_of_post) 10
// $.trim(val.eos_subject_cd) 11
// $.trim(val.asst_flag);12
            $arr_save_modify_delete_id = split("~", $save_modify_delete_id);

            $sanstha_dist_cd_old = trim($arr_save_modify_delete_id[0]);
            $option_schl_type_old = trim($arr_save_modify_delete_id[1]);
            $eo_code_old = trim($arr_save_modify_delete_id[2]);
            $sanstha_code_old = trim($arr_save_modify_delete_id[3]);
            $schl_id_old = trim($arr_save_modify_delete_id[4]);
            $eos_medium_id_old = trim($arr_save_modify_delete_id[5]);
            $eos_desg_cd_old = trim($arr_save_modify_delete_id[6]);
            $eos_type_old = trim($arr_save_modify_delete_id[7]);


            $eos_online_posts_old = trim($arr_save_modify_delete_id[8]);
            $eos_offline_posts_old = trim($arr_save_modify_delete_id[9]);
            $eos_no_of_post_old = trim($arr_save_modify_delete_id[10]);

            if (isset($arr_save_modify_delete_id[11])) {
                $option_subject_code_old = trim($arr_save_modify_delete_id[11]);
            } else {
                $option_subject_code_old = NULL;
            }

            $asst_flag_old = trim($arr_save_modify_delete_id[12]);

            $consider_vacancy_flag_old = trim($arr_save_modify_delete_id[13]);


            $this->loadModel('SelectExcessTchrDets');
            $record_found = $this->SelectExcessTchrDets->checkStaffDeailedFilledSanstha($sanstha_dist_cd_old, $option_schl_type_old, $eo_code_old, $sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old, $eos_type_old, $eos_online_posts_old, $eos_offline_posts_old, $eos_no_of_post_old, $option_subject_code_old, $asst_flag_old, $consider_vacancy_flag_old);

//echo "----------------------------record_found".$record_found;exit();
            if ($record_found == 0) {

                $this->loadModel('SelectEoSansthaExVac');
                $sucuess = $this->SelectEoSansthaExVac->deleteFilledDataInfo($sanstha_dist_cd_old, $option_schl_type_old, $eo_code_old, $sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old, $eos_type_old, $eos_online_posts_old, $eos_offline_posts_old, $eos_no_of_post_old, $option_subject_code_old, $asst_flag_old, $consider_vacancy_flag_old);

                if (isset($sucuess)) {
                    if ($sucuess == 1) {

                        $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo_delete($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd);
                        $jsonArr['filled_data'] = $filled_data;
                        $jsonArr['filled_data_success'] = $find_sucuess;
                        $this->loadModel('SelectEoSansthaExVac');
                        $filled_no_of_excess_vancant_posts = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change_sum($sanstha_code, $schl_id, $eos_medium_id, $eos_desg_cd);
                        if (isset($filled_no_of_excess_vancant_posts)) {
                            if ($filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'] != '') {
                                $filled_no_of_excess_vancant_posts_hidden = $filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'];
                            } else {
                                $filled_no_of_excess_vancant_posts_hidden = 0;
                            }
                        } else {
                            $filled_no_of_excess_vancant_posts_hidden = 0;
                        }
                        $jsonArr['filled_no_of_excess_vancant_posts_hidden'] = $filled_no_of_excess_vancant_posts_hidden;
                        echo json_encode($jsonArr);
                    } else {
                        $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo($sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old, $eos_type_old);
                        $jsonArr['filled_data'] = $filled_data;
                        $jsonArr['filled_data_success'] = $find_sucuess;
                        $this->loadModel('SelectEoSansthaExVac');
                        $filled_no_of_excess_vancant_posts = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change_sum($sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old);
                        if (isset($filled_no_of_excess_vancant_posts)) {
                            if ($filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'] != '') {
                                $filled_no_of_excess_vancant_posts_hidden = $filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'];
                            } else {
                                $filled_no_of_excess_vancant_posts_hidden = 0;
                            }
                        } else {
                            $filled_no_of_excess_vancant_posts_hidden = 0;
                        }
                        $jsonArr['filled_no_of_excess_vancant_posts_hidden'] = $filled_no_of_excess_vancant_posts_hidden;
                        echo json_encode($jsonArr);
                    }
                }
            } else if ($record_found == 1) {
                $filled_data = $this->SelectEoSansthaExVac->findFilledDataInfo($sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old, $eos_type_old);
                $jsonArr['filled_data'] = $filled_data;
                $jsonArr['filled_data_success'] = $find_sucuess;
                $this->loadModel('SelectEoSansthaExVac');
                $filled_no_of_excess_vancant_posts = $this->SelectEoSansthaExVac->findFilledDataInfo_post_change_sum($sanstha_code_old, $schl_id_old, $eos_medium_id_old, $eos_desg_cd_old);
                if (isset($filled_no_of_excess_vancant_posts)) {
                    if ($filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'] != '') {
                        $filled_no_of_excess_vancant_posts_hidden = $filled_no_of_excess_vancant_posts[0][0]['eos_no_of_post_all_sum'];
                    } else {
                        $filled_no_of_excess_vancant_posts_hidden = 0;
                    }
                } else {
                    $filled_no_of_excess_vancant_posts_hidden = 0;
                }
                $jsonArr['filled_no_of_excess_vancant_posts_hidden'] = $filled_no_of_excess_vancant_posts_hidden;
                echo json_encode($jsonArr);
            }
        }
//        $this->redirect(array("controller" => 'samayojans', "action" => 'eo_sanstha_excess_vacancy_decalar'));
    }

//applicant details

    public function view_applications() {
        $this->layout = 'eduofficer_layout';
    }

    public function apply_posn() {
        $this->layout = 'applicant_layout'; //app/views/layouts/sanstha_default_layout.ctp
        $user_id = $this->Session->read('user_id');
        $this->loadModel('SelectTchrMastPost');
        $this->loadModel('SelectExcessTchrDets');
        $this->loadModel('TetExmDet');
        $this->loadModel('ApplnDetMast');
        $check = $this->ApplnDetMast->find('all', array('conditions' => array('pv_apptn_id' => $user_id), 'asst_flag' => 'V'));
//        if (empty($check)) {
        $tetcheck = $this->TetExmDet->find('all', array('conditions' => array('pv_apptn_id' => trim($user_id)), 'fields' => array('pv_tet_exm_1', 'pv_tet_exm_2', 'pv_exm_qualify_1', 'pv_exm_qualify_2')));
        if (!empty($tetcheck)) {
            if (trim($tetcheck[0]['TetExmDet']['pv_exm_qualify_1']) == "YES" && trim($tetcheck[0]['TetExmDet']['pv_exm_qualify_2']) == "YES") {
                $res = $this->SelectTchrMastPost->find('all', array('conditions' => array('post_id IN' => array('4', '5', '7'), 'post_type' => 1), 'fields' => array('post_id', 'post_desc')));
                $options = array(1 => "Primary", 2 => "Secondary");
                $this->set('options', $options);
            }
            if (trim($tetcheck[0]['TetExmDet']['pv_exm_qualify_1']) == 'NO' && trim($tetcheck[0]['TetExmDet']['pv_exm_qualify_2']) == 'NO') {
                echo "<script type=\"text/javascript\">window.alert('You are not Eligible to apply.');window.location.href ='applicant';</script>";
            }
            if (trim($tetcheck[0]['TetExmDet']['pv_exm_qualify_1']) == 'NO' && trim($tetcheck[0]['TetExmDet']['pv_exm_qualify_2']) == 'YES') {
                $res = $this->SelectTchrMastPost->find('all', array('conditions' => array('post_id IN' => array('4', '5', '7'), 'post_type' => 1), 'fields' => array('post_id', 'post_desc')));
                $options = array(2 => "Secondary");
                $this->set('options', $options);
            }
            if (trim($tetcheck[0]['TetExmDet']['pv_exm_qualify_1']) == 'YES' && trim($tetcheck[0]['TetExmDet']['pv_exm_qualify_2']) == 'NO') {
                $res = $this->SelectTchrMastPost->find('all', array('conditions' => array('post_id IN' => array('5', '7'), 'post_type' => 1), 'fields' => array('post_id', 'post_desc')));
                $options = array(1 => "Primary");
                $this->set('options', $options);
            }
            $desig_array = array();
            for ($i = 0; $i < count($res); $i++) {
                $descd = trim($res[$i]['SelectTchrMastPost']['post_id']);
                $desname = trim($res[$i]['SelectTchrMastPost']['post_desc']);
                $desig_array[$descd] = $desname;
            }
            $this->set('postdata', $desig_array);

            $meds = $this->SelectExcessTchrDets->query("select DISTINCT(medin.medinstr_desc),medin.medinstr_id 
                                                        from master.shala_medinstr medin
                                                        JOIN pavitra.pv_advertise ON pv_medium_id=medin.medinstr_id 
                                                        ORDER BY medinstr_desc");

            $med_array = array();

            for ($i = 0; $i < count($meds); $i++) {
                $medcd = trim($meds[$i][0]['medinstr_id']);
                $medname = trim($meds[$i][0]['medinstr_desc']);
                $med_array[$medcd] = $medname;
            }
            $med_array[0] = 'All Medium';

            $this->set('meds', $med_array);

            $this->loadModel('ApplnDetMast');
            $res = $this->ApplnDetMast->find('all', array('conditions' => array('pv_apptn_id' => $user_id)));
            $this->set('applicant_detail', $res);

            $castedata = $res[0]['ApplnDetMast']['pv_apptn_categ'];
            $this->loadModel('Cddir');
            if ($castedata != 1) {
                $soc_ctg = $this->Cddir->find('all', array('conditions' => array('code_type' => 'CT', ' code_value IN' => array($castedata, 1)), 'fields' => array('code_value', 'code_text'), 'order' => array('code_value')));
            } else {
                $soc_ctg = $this->Cddir->find('all', array('conditions' => array('code_type' => 'CT', ' code_value' => 1), 'fields' => array('code_value', 'code_text'), 'order' => array('code_value')));
            }
//            pr($soc_ctg);
//            die;
            $caste_array = array();
            for ($i = 0; $i < count($soc_ctg); $i++) {
                $castecd = trim($soc_ctg[$i]['Cddir']['code_value']);
                $castename = trim($soc_ctg[$i]['Cddir']['code_text']);
                $caste_array[$castecd] = $castename;
            }
            $this->set('castedata', $caste_array);

            $this->loadModel('SelectSubjectApt');
            $subj_opt = $this->SelectSubjectApt->query("select subject_group_id,subject_group_desc from master.tchr_apt_subject
                                                        JOIN pavitra.pv_advertise ON pv_subject_cd=subject_group_id");
//            pr($subj_opt);die;
            $all_subj_opt = array();
            for ($i = 0; $i < count($subj_opt); $i++) {
                $subj_id = trim($subj_opt[$i][0]['subject_group_id']);
                $subj_desc = trim($subj_opt[$i][0]['subject_group_desc']);
                $all_subj_opt[$subj_id] = $subj_desc;
            }
            $this->set('all_subj_opt', $all_subj_opt);
        } else {
            echo "<script type=\"text/javascript\">window.alert('Please Update TET Data.');window.location.href ='applicant';</script>";
        }
//        } else {
//            echo "<script type=\"text/javascript\">window.alert('Please Self Certify the data to Apply for Positions.');window.location.href ='applicant';</script>";
//        }
    }

    public function SelectSansthapplicant() {
        $this->layout = 'ajax';
        $medium = $_POST['medium'];
        $designation = $_POST['designation'];
        $edu_lvl = $_POST['edu_lvl'];
        $subject = $_POST['subject'];
        $caste = $_POST['caste'];
        if ($edu_lvl == 1) {
            $edu_lvl = 'P';
        } else {
            $edu_lvl = 'S';
        }
        $this->loadModel('PvCategAdvt');
        $res1 = $this->PvCategAdvt->find('all', array('conditions' => array('ca_roster_edn_level' => $edu_lvl)));
        for ($i = 0; $i < count($res1); $i++) {
            if (!empty($res1)) {
                if ($res1[$i]['PvCategAdvt']['ca_sc_tot'] != '0') {
                    $sc_details = 2;
                    if ($sc_details == $caste) {
                        $sanstha_code[] = $res1[$i]['PvCategAdvt']['sanstha_code'];
                    }
                }
                if ($res1[$i]['PvCategAdvt']['ca_st_tot'] != '0') {
                    $sc_details = 3;
                    if ($sc_details == $caste) {
                        $sanstha_code[] = $res1[$i]['PvCategAdvt']['sanstha_code'];
                    }
                }
                if ($res1[$i]['PvCategAdvt']['ca_vja_tot'] != '0') {
                    $sc_details = 10;
                    if ($sc_details == $caste) {
                        $sanstha_code[] = $res1[$i]['PvCategAdvt']['sanstha_code'];
                    }
                }
                if ($res1[$i]['PvCategAdvt']['ca_ntb_tot'] != '0') {
                    $sc_details = 13;
                    if ($sc_details == $caste) {
                        $sanstha_code[] = $res1[$i]['PvCategAdvt']['sanstha_code'];
                    }
                }
                if ($res1[$i]['PvCategAdvt']['ca_ntc_tot'] != '0') {
                    $sc_details = 14;
                    if ($sc_details == $caste) {
                        $sanstha_code[] = $res1[$i]['PvCategAdvt']['sanstha_code'];
                    }
                }
                if ($res1[$i]['PvCategAdvt']['ca_ntd_tot'] != '0') {
                    $sc_details = 15;
                    if ($sc_details == $caste) {
                        $sanstha_code[] = $res1[$i]['PvCategAdvt']['sanstha_code'];
                    }
                }
                if ($res1[$i]['PvCategAdvt']['ca_obc_tot'] != '0') {
                    $sc_details = 4;
                    if ($sc_details == $caste) {
                        $sanstha_code[] = $res1[$i]['PvCategAdvt']['sanstha_code'];
                    }
                }
                if ($res1[$i]['PvCategAdvt']['ca_sbc_tot'] != '0') {
                    $sc_details = 12;
                    if ($sc_details == $caste) {
                        $sanstha_code[] = $res1[$i]['PvCategAdvt']['sanstha_code'];
                    }
                }
                if ($res1[$i]['PvCategAdvt']['ca_gen_tot'] != '0') {
                    $sc_details = 1;
                    if ($sc_details == $caste) {
                        $sanstha_code[] = $res1[$i]['PvCategAdvt']['sanstha_code'];
                    }
                }
            }
        }

        $sanstha_code = array_unique($sanstha_code);
//        pr($sanstha_code);A
        $this->loadModel('PvAdvertise');
        $res = $this->PvAdvertise->find('all', array('conditions' => array('pv_desg_cd' => $designation, 'pv_medium_id' => $medium, 'pv_roster_edn_level' => $edu_lvl, 'sanstha_code' => $sanstha_code, 'pv_subject_cd' => $subject), 'fields' => array('DISTINCT(sanstha_code)')));
//        pr($res);
//        die;
        $inClausStr = '(';
        if ($res) {
            foreach ($res AS $arr => $val) {
                $inClausStr.="'" . trim($val[0]['sanstha_code']) . "',";
            }
        } else {
            $inClausStr.="''";
        }
        $inClausStr = trim($inClausStr, ",");
        $inClausStr.=')';

        $this->loadModel('SelectSansthaBasicInfo');
        $sanstha = $this->SelectSansthaBasicInfo->query("select * from samayojan.sanstha_basic_info where sanstha_code IN $inClausStr ");

        $sanstha_array = array();
        for ($i = 0; $i < count($sanstha); $i++) {
            $sansthacd = trim($sanstha[$i][0]['sanstha_code']);
            $sansthaname = trim($sanstha[$i][0]['sanstha_name']);
            $sanstha_array[$sansthacd] = $sansthaname;
        }
        $this->set('sanstha_array', $sanstha_array);
    }

    public function getsansthadetails() {
        $this->layout = 'ajax';
        $user_id = $this->Session->read('user_id');
        $medium = $_POST['medium'];
        $designation = $_POST['designation'];
        $sanstha = $_POST['sanstha'];
        $edu_lvl = $_POST['edu_lvl'];
        if ($edu_lvl == 1) {
            $edu_lvl = 'P';
        } else {
            $edu_lvl = 'S';
        }
        try {
            $this->loadModel('PvAdvertise');

            $params = array($sanstha, $designation, $medium, $edu_lvl);

            $check = $this->PvAdvertise->query("select distinct pac.*,TPM.post_desc,SM.medinstr_desc,sis.subject_group_desc,sjc.subject_name,pac.pv_subject_cd,
                                            dm.deg_text as acad,dmp.deg_text as prof,ps.psc_scale_cd,ps.psc_dscr,ps.psc_up_limit,cdd.code_text
                                            from pavitra.pv_advertise pac
                                            LEFT JOIN master.tchr_post_master as TPM ON pac.pv_desg_cd = TPM.post_id AND TPM.post_type=1
                                            LEFT JOIN master.shala_medinstr as SM ON pac.pv_medium_id = SM.medinstr_id
                                            LEFT JOIN master.tchr_apt_subject  as sis ON pac.pv_subject_cd = sis.subject_group_id 
                                            LEFT JOIN master.shala_subject_jc  as sjc ON pac.pv_subject_cd = sjc.subject_code 
                                            LEFT JOIN master.degree_mast as dm ON pac.pv_acad_qual = CAST(dm.deg_cd as numeric) 
                                            LEFT JOIN master.degree_mast as dmp ON pac.pv_prof_qual = CAST(dmp.deg_cd as numeric)
                                            LEFT JOIN master.pay_scale as ps ON pac.pv_pay_scale_cd = ps.psc_scale_cd 
                                            LEFT JOIN master.cddir as cdd ON pac.pv_aid_type = cdd.code_value and cdd.code_type='AD'
                                            WHERE  pac.sanstha_code=?
                                            and pac.pv_desg_cd = ? and pac.pv_medium_id=? and pac.pv_roster_edn_level=?", $params);
//            pr($check);
            $pv_acad_lvl = $check[0][0]['pv_acad_lvl'];
            $pv_prof_lvl = $check[0][0]['pv_prof_lvl'];
            $adv_sub = $check[0][0]['pv_subject_cd'];
            $this->loadModel('ApplicantQualification');
            $aqual_data = $this->ApplicantQualification->find('all', array('conditions' => array('applicant_id' => $user_id, 'applicant_qual_type' => 'A', 'apql_acad_lvl >=' => $pv_acad_lvl)));
            $pqual_data = $this->ApplicantQualification->find('all', array('conditions' => array('applicant_id' => $user_id, 'applicant_qual_type' => 'P', 'apql_acad_lvl >=' => $pv_prof_lvl)));
            if ($edu_lvl == 'S' && $designation == 4 || $designation == 5) {
                $aqual_subdata = $this->ApplicantQualification->find('all', array('conditions' => array('applicant_id' => $user_id, 'applicant_qual_type' => 'A', 'apql_acad_lvl >=' => $pv_acad_lvl, 'apql_main_subj' => $adv_sub)));
            }
//            pr($aqual_subdata);
            $subject = 0;
            if (!empty($aqual_subdata)) {
                $subject = 1;
            }
            $this->set('subject', $subject);
            $Qualification = 0;
            if (!empty($aqual_data) && !empty($pqual_data)) {
                $Qualification = 1;
            }
            if (empty($aqual_data) OR empty($pqual_data)) {
                $Qualification = 1;
            }
            $this->set('Qualification', $Qualification);
            $this->set('check', $check);
            $this->set('user_id', $user_id);

            $this->loadModel('PvCategAdvt');
            $res = $this->PvCategAdvt->find('all', array('conditions' => array('sanstha_code' => $sanstha, 'ca_roster_edn_level' => $edu_lvl)));
            $this->set('applicant_detail', $res);
            if (!empty($res)) {
                if ($res[0]['PvCategAdvt']['ca_sc_tot'] != '0') {
                    $sc_details[] = 2;
                }
                if ($res[0]['PvCategAdvt']['ca_st_tot'] != '0') {
                    $sc_details[] = 3;
                }
                if ($res[0]['PvCategAdvt']['ca_vja_tot'] != '0') {
                    $sc_details[] = 10;
                }
                if ($res[0]['PvCategAdvt']['ca_ntb_tot'] != '0') {
                    $sc_details[] = 13;
                }
                if ($res[0]['PvCategAdvt']['ca_ntc_tot'] != '0') {
                    $sc_details[] = 14;
                }
                if ($res[0]['PvCategAdvt']['ca_ntd_tot'] != '0') {
                    $sc_details[] = 15;
                }
                if ($res[0]['PvCategAdvt']['ca_obc_tot'] != '0') {
                    $sc_details[] = 4;
                }
                if ($res[0]['PvCategAdvt']['ca_sbc_tot'] != '0') {
                    $sc_details[] = 12;
                }
                if ($res[0]['PvCategAdvt']['ca_gen_tot'] != '0') {
                    $sc_details[] = 1;
                }

                $this->loadModel('PvApplicant');
//                $flag = 0;
                $data = $this->PvApplicant->query("select *,EXTRACT(YEAR FROM age(cast(pv_apptn_dob as date)))age from pavitra.applicant_det_mast where pv_apptn_id='$user_id' and asst_flag='V'");
//                for ($i = 0; $i < count($sc_details); $i++) {
//                    if ($data[0][0]['pv_apptn_categ'] == $sc_details[$i]) {
//                        $this->set('applicant_data', $data);
//                        $flag = 1;
//                    }
//                }
//                if ($flag == 0) {
//                    $this->set('category', $flag);
//                } else {
//                    $this->set('category', $flag);
//                }
                $age = 0;
                $this->loadModel('AgeValidation');
                $sc_code = $data[0][0]['pv_apptn_categ'];
                $agedata = $this->AgeValidation->query("select age_limit from pavitra.age_validation where code_type='AC' and code_value='$sc_code'");
                if ($agedata[0][0]['age_limit'] <= $data[0][0]['age']) {
                    $age = 1;
                }
                if ($age == 1) {
                    $this->set('age', $age);
                } else {
                    $this->set('age', $age);
                }
                $data = 0;
                $this->loadModel('ApplicantPreferences');
                if ($edu_lvl == 'S') {
                    $edu_lvl = 2;
                } else {
                    $edu_lvl = 1;
                }
//            echo "select * from pavitra.applicant_preferences where appl_id=$user_id,appl_categ=$edu_lvl,applied_post=$designation,applied_medium=$medium,sanstha_id=$sanstha";
                $result = $this->ApplicantPreferences->find('all', array('conditions' => array('appl_id' => $user_id, 'appl_categ' => $edu_lvl, 'applied_post' => $designation, 'applied_medium' => $medium, 'sanstha_id' => $sanstha)));
                if (!empty($result)) {
                    $data = 1;
                    $this->set('data', $data);
                } else {
                    $this->set('data', $data);
                }
            } else {
                echo "<script type=\"text/javascript\">window.alert('Can not Apply for This Position');window.location.href ='apply_posn';</script>";
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function save_apply_posn() {
        $this->layout = 'ajax';
        $appl_id = $this->Session->read('user_id');
        $data = $this->request->data;
        if (!empty($data)) {
            $data = $this->request->data;
            $appl_id = $data['bla'][0];
            $appl_categ = $data['categ'];
            $applied_post = $data['apply_posn']['post'];
            $applied_medium = $data['apply_posn']['medium'];
            $sub = $data['sub'];
            $edu_lvl = $data['apply_posn']['edu_lvl'];
            $date = date('Y/m/d H:i:s');
            $appl_type = $data['wrk_type'];
            $sanstha_id = $data['sanstha'];
            $myIp = getHostByName(php_uname('n'));
            $this->loadModel('ApplicantPreferences');
            $result = $this->ApplicantPreferences->find('all', array('conditions' => array('appl_id' => $appl_id, 'appl_categ' => $edu_lvl, 'applied_post' => $applied_post, 'applied_medium' => $applied_medium, 'sanstha_id' => $sanstha_id)));
            if (!empty($result)) {
                echo "<script type=\"text/javascript\">window.alert('Already Applied for this Post');window.location.href ='apply_posn';</script>";
            } else {
                $data = array('appl_id' => $appl_id,
                    'appl_categ' => Sanitize::html($appl_categ),
                    'wrk_type' => Sanitize::html($appl_type),
                    'sanstha_id' => Sanitize::html($sanstha_id),
                    'applied_post' => Sanitize::html($applied_post),
                    'applied_sub' => Sanitize::html($sub),
                    'applied_medium' => Sanitize::html($applied_medium),
                    'edn_level' => $edu_lvl,
                    'asst_flag' => Sanitize::html('E'),
                    'applicant_status' => Sanitize::html('E'),
                    'entry_auth' => Sanitize::html($appl_id),
                    'entry_dtts' => $date,
                    'system_ip_entry' => $myIp);
                $this->ApplicantPreferences->save($data);
                echo "<script type=\"text/javascript\">window.alert('Data Saved Successfully');window.location.href ='apply_posn';</script>";
            }
        }
//        exit;
    }

    public function tetexamdetails() {
        $this->layout = 'applicant_layout';
    }

    //applicant details

    public function applicant_details() {
        $this->layout = 'applicant_layout';
        $user = trim($this->Session->read('apln_id'));
        $this->loadModel('ApplnDetMast');
        $this->loadModel('ApplnOtherDetMast');
        $flag = 0;
        $qry = $this->ApplnDetMast->query("select *
                                           from pavitra.applicant_det_mast ad
                                           Left JOIN pavitra.applicant_other_det aod
                                           ON ad.pv_apptn_id=aod.pv_apptn_id where ad.pv_apptn_id='$user' and ad.asst_flag='V'");
        if (!empty($qry)) {
            $flag = 1;
            $this->set('flag', $flag);
        }
        $this->set('flag', $flag);
        $params = array($user);
        $qry = $this->ApplnDetMast->query("select *
                                           from pavitra.applicant_det_mast ad
                                           Left JOIN pavitra.applicant_other_det aod
                                           ON ad.pv_apptn_id=aod.pv_apptn_id 
                                           left JOIN pavitra.pv_appl_user ON user_id=ad.pv_apptn_id where ad.pv_apptn_id=?  
                                           ", $params);
//        pr($qry);exit;
        if (!empty($qry)) {
            $this->set('qry', $qry);
        }
//        $this->loadModel('SelectTchrMastPost');
//        $desg_opt = $this->SelectTchrMastPost->query("Select post_id,post_desc from master.tchr_post_master 
//                                                      where post_type='1' and post_id IN('4','5','7','21','22')");
//        $all_desg_opt = array();
//        for ($i = 0; $i < count($desg_opt); $i++) {
//            $post_id = trim($desg_opt[$i][0]['post_id']);
//            $post_desc = trim($desg_opt[$i][0]['post_desc']);
//            $all_desg_opt[$post_id] = $post_desc;
//        }
//        $this->set('all_desg_opt', $all_desg_opt);

        $this->loadModel('Cddir');
        $cast_type = $this->Cddir->find('all', array('conditions' => array('code_type' => 'SC', 'code_value NOT' => array('5', '6', '7')), 'fields' => array('code_value', 'code_text'), 'order' => array('code_value')));
        $all_soc_categ = array();
        for ($i = 0; $i < count($cast_type); $i++) {
            $code_value = trim($cast_type[$i]['Cddir']['code_value']);
            $code_text = trim($cast_type[$i]['Cddir']['code_text']);
            $all_soc_categ[$code_value] = $code_text;
        }
        $this->set('all_soc_categ', $all_soc_categ);

        $this->loadModel('SelectExcessTchrDets');
        $meds = $this->SelectExcessTchrDets->query("select DISTINCT(medin.medinstr_desc),medin.medinstr_id 
                                                    from master.shala_medinstr medin where medinstr_id!='0'
                                                    ORDER BY medinstr_id");

        $med_array = array();

        for ($i = 0; $i < count($meds); $i++) {
            $medcd = trim($meds[$i][0]['medinstr_id']);
            $medname = trim($meds[$i][0]['medinstr_desc']);
            $med_array[$medcd] = $medname;
        }
        $med_array[0] = 'All Medium';

        $this->set('meds', $med_array);

        $this->loadModel('Cddir');
        $cast_type = $this->Cddir->find('all', array('conditions' => array('code_type' => 'CT'), 'fields' => array('code_value', 'code_text'), 'order' => array('code_value')));
        $all_cast_type = array();
        for ($i = 0; $i < count($cast_type); $i++) {
            $code_value = trim($cast_type[$i]['Cddir']['code_value']);
            $code_text = trim($cast_type[$i]['Cddir']['code_text']);
            $all_cast_type[$code_value] = $code_text;
        }
        $this->set('all_cast_type', $all_cast_type);

        $this->loadModel('District');
        $dis = $this->District->find('list', array('fields' => array('distcd', 'distname'), 'order' => array('distname')));
        $this->set('district_list', $dis);

        $this->loadModel('Cddir');
        $ph_type = $this->Cddir->find('all', array('conditions' => array('code_type' => 'PH'), 'fields' => array(trim('code_value'), 'code_text'), 'order' => array('code_value')));
        $all_ph_type = array();
        for ($i = 0; $i < count($ph_type); $i++) {
            $code_value = trim($ph_type[$i]['Cddir']['code_value']);
            $code_text = trim($ph_type[$i]['Cddir']['code_text']);
            $all_ph_type[$code_value] = $code_text;
        }
        $this->set('all_ph_type', $all_ph_type);
    }

    public function applicant_details_update() {
        $this->layout = 'ajax';
        $data = $this->request->data;
        $user = trim($this->Session->read('apln_id'));
//        pr($data);
//        die;
        $this->loadModel('ApplnDetMast');
        $this->loadModel('ApplnOtherDetMast');
//        $params = array($user, "V");
        $qry = $this->ApplnDetMast->query("select *
                                           from pavitra.applicant_det_mast ad
                                           Left JOIN pavitra.applicant_other_det aod
                                           ON ad.pv_apptn_id=aod.pv_apptn_id where ad.pv_apptn_id='$user'  and ad.asst_flag='V'");
        if (!empty($qry)) {
            echo "<script type=\"text/javascript\">window.alert('Data Already Verified.');window.location.href ='applicant_details';</script>";
        } else if (empty($qry)) {
            if (!empty($data)) {
                $gen = Sanitize::html($data['gen']);
                $arr = explode("/", $data['app_birth_dt']);
                $app_birth_dt = ($arr[2] . "-" . $arr[1] . "-" . $arr[0]);
                $app_birth_dt_new = $app_birth_dt;
                $app_mob = Sanitize::html($data['app_mob']);
                $pr_apptn_type = Sanitize::html($data['pr_apptn_type']);
//                $app_dis_type = Sanitize::html($data['app_dis_type']);
                $pr_apptn_parttime = Sanitize::html($data['pr_apptn_parttime']);
//                $pr_bed_eng = Sanitize::html($data['pr_bed_eng']);
                $pr_apptn_aadhar = Sanitize::html($data['pr_apptn_aadhar_1']) . Sanitize::html($data['pr_apptn_aadhar_2']) . Sanitize::html($data['pr_apptn_aadhar_3']);
                $pr_apptn_mas = Sanitize::html($data['pr_apptn_mas']);
                $app_no_of_chil = Sanitize::html($data['app_no_of_chil']);
                $pr_domicile = Sanitize::html($data['pr_domicile']);
                $pr_border = Sanitize::html($data['pr_border']);
                $sucide_vic_child = Sanitize::html($data['sucide_vic_child']);
                $categ = Sanitize::html($data['applicant_det']['categ']);
                $medium = Sanitize::html($data['applicant_det']['medium']);
                $sc = Sanitize::html($data['applicant_det']['sc']);
                $dist_code = Sanitize::html($data['applicant_det']['dist_code']);
                $ph = Sanitize::html($data['applicant_det']['ph']);

                $pv_apptn_fname = Sanitize::html($data['pv_apptn_fname']);
                $pv_apptn_mname = Sanitize::html($data['pv_apptn_mname']);
                $pv_apptn_lname = Sanitize::html($data['pv_apptn_lname']);

                $myIp = getHostByName(php_uname('n'));
                $date = date('Y-m-d H:i:s');
                $this->loadModel('ApplnDetMast');
                $this->loadModel('ApplnOtherDetMast');

                $this->ApplnDetMast->UpdateAll(array('pv_apptn_gen' => $gen,
                    'pv_apptn_dob' => "'$app_birth_dt_new'",
                    'pv_apptn_type' => $pr_apptn_type,
                    'pv_apptn_disab_type' => $ph,
                    'pv_apptn_parttime' => $pr_apptn_parttime,
                    'pv_apptn_categ' => $categ,
                    'pv_medium' => $medium,
                    'pv_suicide_victim_child' => $sucide_vic_child,
                    'pv_apptn_fname' => "'$pv_apptn_fname'",
                    'pv_apptn_mname' => "'$pv_apptn_mname'",
                    'pv_apptn_lname' => "'$pv_apptn_lname'",
                    'dist_code' => "'$dist_code'",
                    'system_ip_update' => "'$myIp'",
                    'update_dtts' => "'$date'"), array('pv_apptn_id' => $user));

                $this->ApplnOtherDetMast->UpdateAll(array('pv_apptn_mob' => "'$app_mob'",
                    'pv_apptn_aadhar' => "'$pr_apptn_aadhar'",
                    'pv_apptn_mas' => "'$pr_apptn_mas'",
                    'pv_no_of_chil' => $app_no_of_chil,
                    'pv_domicile' => "'$pr_domicile'",
                    'pv_border' => "'$pr_border'",
                    'pv_apptn_social_categ' => $sc), array('pv_apptn_id' => $user));

                echo "<script type=\"text/javascript\">window.alert('Data Updated Successfully.');window.location.href ='applicant_details';</script>";
            }
        }
    }

    public function tetdetails() {
        $this->layout = 'applicant_layout';
        $user = trim($this->Session->read('apln_id'));
        $this->loadModel('TetExmDet');
        $check = $this->TetExmDet->find('all', array('conditions' => array('pv_apptn_id' => trim($user))));
//        pr($check);
        $this->set('check', $check);
    }

    public function checkpapperonedata() {
        $this->layout = 'ajax';
        $papperoneid = Sanitize::html(trim($_POST['papperoneid']));
        @$tetxn = Sanitize::html(trim($_POST['tet']));
        @$paperone = Sanitize::html(trim($_POST['paperone']));
        $user = trim($this->Session->read('apln_id'));
        $this->loadModel('ApplnDetMast');
        $app_mast_data = $this->ApplnDetMast->find('all', array('conditions' => array('pv_apptn_id' => trim($user)), 'fields' => array('pv_apptn_fname', 'pv_apptn_mname', 'pv_apptn_lname', 'pv_apptn_dob', 'pv_apptn_gen')));
//        pr($app_mast_data[0]['ApplnDetMast']);
//        die;
        $this->loadModel('TetData');
        $check = $this->TetData->find('all', array('conditions' => array('pv_exm_id_1' => trim($papperoneid)), 'fields' => array('pv_exm_year_1', 'pv_exm_qualify_1', 'pv_exm_id_1', 'pv_apptn_fname', 'pv_apptn_mname', 'pv_apptn_lname')));
//        pr($check);
//        die;
//
//        $appt_name = $app_mast_data[0]['ApplnDetMast']['pv_apptn_fname'] . " " . $app_mast_data[0]['ApplnDetMast']['pv_apptn_mname'] . " " . $app_mast_data[0]['ApplnDetMast']['pv_apptn_lname'];
//
//        if ($check[0]['TetData']['applicant_name'] != $appt_name) {
//            echo "hi";
//        }
//        die;
        if (!empty($check) && $check[0]['TetData']['pv_exm_id_1'] != '') {
            $this->set('check', $check);
            $this->set('papperoneid', $papperoneid);
        } else if ($tetxn != '2' && $paperone == 1) {
            echo "<script type=\"text/javascript\">window.alert('Please Enter a Valid TET Exam Number.');window.location.href ='tetdetails';</script>";
        }
    }

    public function checkpappertwodata() {
        $this->layout = 'ajax';
        $pappertwoid = Sanitize::html(trim($_POST['pappertwoid']));
        @$papertwo = Sanitize::html(trim($_POST['papertwo']));
        @$tetxn = Sanitize::html(trim($_POST['tet']));
        $this->loadModel('TetData');
        $check = $this->TetData->find('all', array('conditions' => array('pv_exm_id_2' => trim($pappertwoid)), 'fields' => array('pv_exm_year_2', 'pv_exm_qualify_2', 'pv_exm_id_2', 'pv_apptn_fname', 'pv_apptn_mname', 'pv_apptn_lname')));
//        pr($check);die;
        if (!empty($check) && trim($check[0]['TetData']['pv_exm_id_2']) != '') {
            $this->set('check', $check);
            $this->set('pappertwoid', $pappertwoid);
        } else if ($tetxn != '2' && $papertwo == 1) {
            echo "<script type=\"text/javascript\">window.alert('Please Enter a Valid TET Exam Number.');window.location.href ='tetdetails';</script>";
        }
    }

    public function savetetdetails() {
        $this->layout = 'ajax';
        $applicant_id = $this->Session->read('user_id');
        $result = $this->request->data;
//        echo $result['tet'];
//        pr($result);die;
        $this->loadModel('TetExmDet');
        $date = date('Y-m-d H:i:s');
        $myIp = getHostByName(php_uname('n'));
        if (!empty($result)) {
            $tet = Sanitize::html(trim($result['tet']));
            $data = $this->TetExmDet->find('all', array('conditions' => array('pv_apptn_id' => trim($applicant_id))));
            if (empty($data) && $tet == 1) {
                $this->TetExmDet->SaveAll(array('pv_apptn_id' => $applicant_id,
                    'pv_tet_appeard' => $result['tet'],
                    'asst_flag' => 'E',
                    'entry_auth' => $applicant_id,
                    'system_ip_entry' => $myIp,
                    'entry_dtts' => $date));
                if ($tet == 1) {
                    $tetpapper1 = $result['tetpapper1'];
                    if ($tetpapper1 == 1) {
                        $tetpappernumber1 = Sanitize::html(trim($result['tetpappernumber1']));
                        $tetpapperyear1 = Sanitize::html(trim($result['tetpapperyear1']));
                        @$Eligibility1 = Sanitize::html(trim($result['Eligibility1']));
                        $this->TetExmDet->UpdateAll(array('pv_tet_exm_1' => $tetpapper1,
                            'pv_exm_id_1' => "'$tetpappernumber1'",
                            'pv_exm_year_1' => $tetpapperyear1,
                            'pv_exm_qualify_1' => "'$Eligibility1'",
                            'pv_tet_appeard' => $result['tet'],
                            'entry_auth' => "'$applicant_id'",
                            'system_ip_update' => "'$myIp'",
                            'update_dtts' => "'$date'"), array('pv_apptn_id' => $applicant_id));
                    } else if ($tetpapper1 == 2 || $tetpapper1 == 3) {
                        @$Eligibility1 = Sanitize::html(trim($result['Eligibility1']));
                        $this->TetExmDet->UpdateAll(array('pv_tet_exm_1' => $tetpapper1,
                            'pv_exm_qualify_1' => "'NO'",
                            'pv_tet_appeard' => $result['tet'],
                            'entry_auth' => "'$applicant_id'",
                            'system_ip_update' => "'$myIp'",
                            'update_dtts' => "'$date'"), array('pv_apptn_id' => $applicant_id));
                    }
                    $tetpapper2 = $result['tetpapper2'];
                    if ($tetpapper2 == 1) {
                        $tetpappernumber2 = Sanitize::html(trim($result['tetpappernumber2']));
                        $tetpapperyear2 = Sanitize::html(trim($result['tetpapperyear2']));
                        $Eligibility2 = Sanitize::html(trim($result['Eligibility2']));
                        $this->TetExmDet->UpdateAll(array('pv_tet_exm_2' => $tetpapper2,
                            'pv_exm_id_2' => "'$tetpappernumber2'",
                            'pv_exm_year_2' => $tetpapperyear2,
                            'pv_exm_qualify_2' => "'$Eligibility2'",
                            'entry_auth' => "'$applicant_id'",
                            'system_ip_update' => "'$myIp'",
                            'update_dtts' => "'$date'"), array('pv_apptn_id' => trim($applicant_id)));
                    } else if ($tetpapper2 == 2 || $tetpapper2 == 3) {
                        $Eligibility2 = Sanitize::html(trim($result['Eligibility2']));
                        $this->TetExmDet->UpdateAll(array('pv_tet_exm_2' => $tetpapper2,
                            'pv_exm_qualify_2' => "'NO'",
                            'pv_tet_appeard' => $result['tet'],
                            'entry_auth' => "'$applicant_id'",
                            'system_ip_update' => "'$myIp'",
                            'update_dtts' => "'$date'"), array('pv_apptn_id' => trim($applicant_id)));
                    }
                } else if ($tet == 2) {
                    try {
                        $this->TetExmDet->SaveAll(array('pv_apptn_id' => $applicant_id,
                            'pv_tet_appeard' => $result['tet'],
                            'asst_flag' => 'E',
                            'entry_auth' => "'$applicant_id'",
                            'system_ip_entry' => $myIp,
                            'entry_dtts' => $date));
                        echo "<script type=\"text/javascript\">window.alert('Data Saved Successfully.');window.location.href ='tetdetails';</script>";
                    } catch (Exception $e) {
//                    return 0;
                        echo "<script type=\"text/javascript\">window.alert('Data Saved Successfully.');window.location.href ='tetdetails';</script>";
                    }
                }
            } else if (!empty($data) && $tet == 2) {
                $this->TetExmDet->UpdateAll(array('pv_tet_exm_1' => "''",
                    'pv_exm_id_1' => "''",
                    'pv_exm_qualify_1' => "'NO'",
                    'pv_tet_appeard' => $result['tet'],
                    'entry_auth' => "'$applicant_id'",
                    'system_ip_update' => "'$myIp'",
                    'update_dtts' => "'$date'"), array('pv_apptn_id' => $applicant_id));
                $this->TetExmDet->UpdateAll(array('pv_tet_exm_2' => "''",
                    'pv_exm_id_2' => "''",
                    'pv_exm_qualify_2' => "'NO'",
                    'pv_tet_appeard' => $result['tet'],
                    'entry_auth' => "'$applicant_id'",
                    'system_ip_update' => "'$myIp'",
                    'update_dtts' => "'$date'"), array('pv_apptn_id' => trim($applicant_id)));
            }
            if (!empty($data) && $tet == 1) {
                $tetpapper1 = $result['tetpapper1'];
                if ($tetpapper1 == 1) {
                    $tetpappernumber1 = Sanitize::html(trim($result['tetpappernumber1']));
                    $tetpapperyear1 = Sanitize::html(trim($result['tetpapperyear1']));
                    @$Eligibility1 = Sanitize::html(trim($result['Eligibility1']));
                    $this->TetExmDet->UpdateAll(array('pv_tet_exm_1' => $tetpapper1,
                        'pv_exm_id_1' => "'$tetpappernumber1'",
                        'pv_exm_year_1' => $tetpapperyear1,
                        'pv_exm_qualify_1' => "'$Eligibility1'",
                        'pv_tet_appeard' => $result['tet'],
                        'entry_auth' => "'$applicant_id'",
                        'system_ip_update' => "'$myIp'",
                        'update_dtts' => "'$date'"), array('pv_apptn_id' => $applicant_id));
                } else if ($tetpapper1 == 2 || $tetpapper1 == 3) {
                    @$Eligibility1 = Sanitize::html(trim($result['Eligibility1']));
                    $this->TetExmDet->UpdateAll(array('pv_tet_exm_1' => $tetpapper1,
                        'pv_exm_qualify_1' => "'NO'",
                        'pv_tet_appeard' => $result['tet'],
                        'entry_auth' => "'$applicant_id'",
                        'system_ip_update' => "'$myIp'",
                        'update_dtts' => "'$date'"), array('pv_apptn_id' => $applicant_id));
                }
                $tetpapper2 = $result['tetpapper2'];
                if ($tetpapper2 == 1) {
                    $tetpappernumber2 = Sanitize::html(trim($result['tetpappernumber2']));
                    $tetpapperyear2 = Sanitize::html(trim($result['tetpapperyear2']));
                    $Eligibility2 = Sanitize::html(trim($result['Eligibility2']));
                    $this->TetExmDet->UpdateAll(array('pv_tet_exm_2' => $tetpapper2,
                        'pv_exm_id_2' => "'$tetpappernumber2'",
                        'pv_exm_year_2' => $tetpapperyear2,
                        'pv_exm_qualify_2' => "'$Eligibility2'",
                        'entry_auth' => "'$applicant_id'",
                        'system_ip_update' => "'$myIp'",
                        'update_dtts' => "'$date'"), array('pv_apptn_id' => trim($applicant_id)));
                } else if ($tetpapper2 == 2 || $tetpapper2 == 3) {
                    @$Eligibility2 = Sanitize::html(trim($result['Eligibility2']));
                    $this->TetExmDet->UpdateAll(array('pv_tet_exm_2' => $tetpapper2,
                        'pv_exm_qualify_2' => "'NO'",
                        'pv_tet_appeard' => $result['tet'],
                        'entry_auth' => "'$applicant_id'",
                        'system_ip_update' => "'$myIp'",
                        'update_dtts' => "'$date'"), array('pv_apptn_id' => trim($applicant_id)));
                }
            }
        }
        echo "<script type=\"text/javascript\">window.alert('Data Saved Successfully.');window.location.href ='tetdetails';</script>";
    }

    //arrange list

    public function arrange_list() {
        $this->layout = 'applicant_layout';
        $user = trim($this->Session->read('apln_id'));
        $this->loadModel('ApplicantPreferences');
        $check = $this->ApplicantPreferences->query("SELECT appl_id, appl_categ,ab.code_text,wrk_type,sanstha_id,sanstha_name, applied_post,post_desc,applied_sub,subject_group_desc,
                                                    applied_medium,medinstr_desc,edn_level, asst_flag, applicant_status,id,aid_type,abc.code_text
                                                    FROM pavitra.applicant_preferences
                                                    LEFT JOIN samayojan.sanstha_basic_info ON sanstha_code=sanstha_id
                                                    LEFT JOIN master.tchr_post_master ON post_id=applied_post::numeric and post_type='1'
                                                    LEFT JOIN master.tchr_apt_subject ON subject_group_id=applied_sub
                                                    LEFT JOIN master.shala_medinstr ON medinstr_id=applied_medium
                                                    LEFT JOIN master.cddir abc ON code_value=aid_type and code_type='AD'
                                                    LEFT JOIN master.cddir ab ON ab.code_value=appl_categ and ab.code_type='CT'
                                                    where appl_id='$user'");
        $this->set('check', $check);
//        pr($check);

        $all_pref_list = array();
        for ($i = 0; $i < count($check); $i++) {
            $code_value = trim($check[$i][0]['edn_level']) . "-" . trim($check[$i][0]['applied_post']) . "-" . trim($check[$i]['0']['applied_medium']) . "-" . trim($check[$i][0]['sanstha_id']) . "-" . trim($check[$i][0]['applied_sub']) . "-" . trim($check[$i][0]['appl_id']) . "-" . trim($check[$i][0]['aid_type']) . "-" . trim($check[$i][0]['appl_categ']);
            $code_text = trim($check[$i][0]['sanstha_id']);
            $all_pref_list[$code_value] = $code_text;
        }
//        $this->set('code_value', $code_value);
//        $this->set('code_text', $code_text);
        $this->set('all_pref_list', $all_pref_list);
    }

    public function save_arrange_list() {
        $this->layout = 'ajax';
        $result = $this->request->data;
        $user = trim($this->Session->read('apln_id'));
//        pr($result);
//        die;
        $this->loadModel('ApplicantPreferences');
        $data = count($result['selectto']);
        $j = 1;
        for ($i = 0; $i < $data; $i++) {
            $respose[] = explode('-', $result['selectto'][$i]);
            $edn_level[] = $respose[$i][0];
            $applied_post[] = $respose[$i][1];
            $applied_medium[] = $respose[$i][2];
            $sanstha_id[] = $respose[$i][3];
            $applied_sub[] = $respose[$i][4];
            $appl_id[] = $respose[$i][5];
            $aid_type[] = $respose[$i][6];
            $appl_categ[] = $respose[$i][7];

            $this->ApplicantPreferences->UpdateAll(array('sq_no' => "'$j'"), array('appl_id' => $appl_id[$i], 'edn_level' => $edn_level[$i], 'applied_post' => $applied_post[$i], 'applied_medium' => $applied_medium[$i], 'sanstha_id' => $sanstha_id[$i], 'applied_sub' => $applied_sub[$i], 'aid_type' => $aid_type[$i], 'appl_categ' => $appl_categ[$i]));
            $j++;
        }
    }

    public function ctetdetails() {
        $this->layout = 'applicant_layout';
        $user = trim($this->Session->read('apln_id'));
//        $this->loadModel('TetExmDet');
//        $check = $this->TetExmDet->find('all', array('conditions' => array('pv_apptn_id' => trim($user))));
//        pr($check);
//        $this->set('check', $check);
    }

}

//,
//                'edn_level' => "'$edn_level[$i]'",
//                'applied_post' => $applied_post[$i],
//                'applied_medium' => "'$applied_medium[$i]'",
//                'sanstha_id' => $sanstha_id[$i],
//                'applied_sub' => "'$applied_sub[$i]'",
//                'aid_type' => "'$aid_type[$i]'", 'appl_categ' => trim($appl_categ[$i])
?>
