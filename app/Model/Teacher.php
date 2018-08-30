<?php

class Teacher extends AppModel {

    public $useDbConfig = 'default';
    var $useTable = 'shala_teacher'; // db=shala_live  schema =udise
    var $name = "Teacher";

    function validation($data) {//DEMO
        $errorString = '';
        if (($this->isAlpha(trim($data['textfield2']))) && ($this->notEmpty(trim($data['textfield2'])))) {
            $errorString.='<li>Enter Only Alphabets.</li>';
            $errorString.='<li>Field Should not be Empty.</li>';
        }
        if (($this->isAlpha(trim($data['textfield3']))) && ($this->notEmpty(trim($data['textfield3'])))) {
            $errorString.='<li>Enter Only Alphabets.</li>';
            $errorString.='<li>Field Should not be Empty.</li>';
        }
        return $errorString;
    }

    function isAlpha($data) {
        if (!preg_match("/^[a-zA-Z]*$/", $data)) {

            return false;
        } else {

            return true;
        }
//
    }

    function validationPersonalDtl($data) {
        $errorString = '';
//        echo "<pre>".print_r($data,TRUE)."</pre>";exit();
//        $data = $data['Teacher'];

        $currentDate = date("d/m/Y");
        if ($this->isEmpty(trim($data['Teacher']['tchr_fname'])) == '') {
            $errorString.='<li>Invalid Staff First Name.</li>';
        }
//        if ($this->isEmpty(trim($data['Teacher']['tchr_mname'])) == '') {
//            $errorString.='<li>Invalid Staff Middle Name.</li>';
//        }
        if ($this->isEmpty(trim($data['Teacher']['tchr_lname'])) == '') {
            $errorString.='<li>Invalid Staff Last Name.</li>';
        }
//        if ($this->isEmpty(trim($data['Teacher']['tchr_fname_d']) == '')) {
//            $errorString.='<li>Invalid Staff Devanagari First Name.</li>';
//        }
//        if ($this->isEmpty(trim($data['Teacher']['tchr_mname_d'])) == '') {
//            $errorString.='<li>Invalid Staff Devanagari Middle Name.</li>';
//        }
//        if ($this->isEmpty(trim($data['Teacher']['tchr_lname_d'])) == '') {
//            $errorString.='<li>Invalid Staff Devanagari Last Name.</li>';
//        }
        if ((($this->validateDate($data['Teacher']['tchr_birth_dt']) == 0))) {
            $errorString.='<li>Invalid Birth Date111111111.</li>';
        }
        if (($this->DateGreater($data['Teacher']['tchr_birth_dt'], $currentDate)) == 0) {
            $errorString.='<li>Invalid Birth Date2222222222.</li>';
        }
        if (($this->validateDate($data['Teacher']['tchr_birth_dt'])) == 0) {
            $errorString.='<li>Invalid Birth Date33333333.</li>';
        }

        if ($this->isEmpty(trim($data['Teacher']['tchr_serv_entry_dt'])) == 0) {
            $errorString.='<li>Invalid Date of Entry in Service1111 .</li>';
        }
//        echo "--->".$this->validateDate($data['Teacher']['tchr_serv_entry_dt']);

        if ((($this->validateDate($data['Teacher']['tchr_serv_entry_dt'])) == 0)) {
            $errorString.='<li>Invalid Date of Entry in Service22222 .</li>';
        }
        if (($this->DateGreater($data['Teacher']['tchr_serv_entry_dt'], $currentDate)) == 0) {
            $errorString.='<li>Invalid Date of Entry in Service3333 .</li>';
        }

//        if (($this->DateGreater($data['Teacher']['tchr_serv_entry_dt'], $data['Teacher']['tchr_birth_dt']) == 0)){
//            $errorString.='<li>Invalid Date of Entry in Serviceeee .</li>';
//        }  
        if ($this->isEmpty(trim($data['Teacher']['tchr_edu_entry_dt'])) == 0) {
            $errorString.='<li>Invalid Date of Entry in Education111 .</li>';
        }
        if ((($this->validateDate($data['Teacher']['tchr_edu_entry_dt'])) == 0)) {
            $errorString.='<li>Invalid Date of Entry in Education222 .</li>';
        }
        if (($this->DateGreater($data['Teacher']['tchr_edu_entry_dt'], $currentDate)) == 0) {
            $errorString.='<li>Invalid Date of Entry in Education3333 .</li>';
        }
//        if ($this->DateGreater($data['Teacher']['tchr_edu_entry_dt'], $data['Teacher']['tchr_serv_entry_dt']) == 0) {
//            $errorString.='<li>Invalid Date of Entry in Serviceeee .</li>';
//        }
        if ($this->isEmpty(trim($data['Teacher']['tchr_curr_desig_dt'])) == 0) {
            $errorString.='<li>Invalid Date of Joining in Current Designation.</li>';
        }
        if ((($this->validateDate($data['Teacher']['tchr_curr_desig_dt'])) == 0)) {
            $errorString.='<li>Invalid Date of Joining in Current Designation.</li>';
        }
        if (($this->DateGreater($data['Teacher']['tchr_curr_desig_dt'], $currentDate)) == 0) {
            $errorString.='<li>Invalid Date of Joining in Current Designation.</li>';
        }
//        if ($this->DateGreater($data['Teacher']['tchr_curr_desig_dt'], $data['Teacher']['tchr_edu_entry_dt']) == 0) {
//            $errorString.='<li>Invalid Date of Joining in Current Designation.</li>';
//        }
        if ($this->isEmpty(trim($data['Teacher']['tchr_curr_desig_dt'])) == 0) {
            $errorString.='<li>Invalid Date of Joining in Current Designation.</li>';
        }
        if ((($this->validateDate($data['Teacher']['tchr_curr_desig_dt'])) == 0)) {
            $errorString.='<li>Invalid Date of Joining in Current Designation.</li>';
        }
        if (($this->DateGreater($data['Teacher']['tchr_curr_desig_dt'], $currentDate)) == 0) {
            $errorString.='<li>Invalid Date of Joining in Current Designation.</li>';
        }
//        if ($this->DateGreater($data['Teacher']['tchr_curr_desig_dt'], $data['Teacher']['tchr_edu_entry_dt']) == 0) {
//            $errorString.='<li>Invalid Date of Joining in Current Designation.</li>';
//        }
        if ($this->isEmpty(trim($data['Teacher']['tchr_curr_post_mode'])) == '') {
            $errorString.='<li>Invalid Current Posting Mode.</li>';
        }

//        if ($this->isEmpty(trim($data['tchr_type'])) == '') {
//            $errorString.='<li>Invalid Teacher Type(Shikshan Sevak?).</li>';
//        }
//        if ((trim($data['tchr_type'])) == 1) {
//            if ($this->isEmpty(trim($data['Teacher']['tchr_appt_end_dt'])) == 0) {
//                $errorString.='<li>Invalid End of Term of Appoinment.</li>';
//            }
//            if ((($this->validateDate($data['Teacher']['tchr_appt_end_dt'])) == 0)) {
//                $errorString.='<li>Invalid End of Term of Appoinment.</li>';
//            }
//            if (($this->DateGreater($data['Teacher']['tchr_appt_end_dt'], $currentDate)) == 0) {
//                $errorString.='<li>Invalid End of Term of Appoinment.</li>';
//            }
////            if ($this->DateGreater($data['Teacher']['tchr_appt_end_dt'], $data['Teacher']['tchr_edu_entry_dt']) == 0) {
////                $errorString.='<li>Invalid End of Term of Appoinment.</li>';
////            }
//        }


        if ($this->isEmpty(trim($data['Teacher']['tchr_dist_entry_dt'])) == 0) {
            $errorString.='<li>Invalid Date of Joining of Current District.</li>';
        }
        if ((($this->validateDate($data['Teacher']['tchr_dist_entry_dt'])) == 0)) {
            $errorString.='<li>Invalid Date of Joining of Current District.</li>';
        }
        if (($this->DateGreater($data['Teacher']['tchr_dist_entry_dt'], $currentDate)) == 0) {
            $errorString.='<li>Invalid Date of Joining of Current District.</li>';
        }
//        if ($this->DateGreater($data['Teacher']['tchr_dist_entry_dt'], $data['Teacher']['tchr_serv_entry_dt']) == 0) {
//           $errorString.='<li>Invalid Date of Joining of Current District.</li>';
//        }

        if ($this->isEmpty(trim($data['Teacher']['tchr_block_entry_dt'])) == 0) {
            $errorString.='<li>Invalid Date of Joining in Current Block.</li>';
        }
        if ((($this->validateDate($data['Teacher']['tchr_block_entry_dt'])) == 0)) {
            $errorString.='<li>Invalid Date of Joining in Current Block.</li>';
        }
        if (($this->DateGreater($data['Teacher']['tchr_block_entry_dt'], $currentDate)) == 0) {
            $errorString.='<li>Invalid Date of Joining in Current Block.</li>';
        }
//        if ($this->DateGreater($data['Teacher']['tchr_block_entry_dt'], $data['Teacher']['tchr_dist_entry_dt']) == 0) {
//            $errorString.='<li>Invalid Date of Joining in Current Block.</li>';
//        }  


        if ($this->isEmpty(trim($data['Teacher']['tchr_curr_sch_dt'])) == 0) {
            $errorString.='<li>Invalid Date of Joining in Current School.</li>';
        }
        if ((($this->validateDate($data['Teacher']['tchr_curr_sch_dt'])) == 0)) {
            $errorString.='<li>Invalid Date of Joining in Current School.</li>';
        }
        if (($this->DateGreater($data['Teacher']['tchr_curr_sch_dt'], $currentDate)) == 0) {
            $errorString.='<li>Invalid Date of Joining in Current School.</li>';
        }

        if ($data['Teacher']['personal_recruitment_type'] == 'newRecuritment') { 
            if (trim($data['Teacher']['management_details']) == '') {
                $errorString.='<li>Invalid School Code as Management type is Wrong.</li>';
            }
        }
//        if (isset($this->request->data['Teacher']['tchr_recruitment_type_para_hidden'])){
//            if ( trim($this->request->data['Teacher']['tchr_recruitment_type_para_hidden']) == 'paraY') {
//                 if (trim($data['Teacher']['management_details']) == '') {
//                 $errorString.='<li>Invalid School Code as Management type is Wrong For Para Teacher.</li>';
//                 
//                 }
//            }
//        }
//        if ($this->DateGreater($data['Teacher']['tchr_curr_sch_dt'], $data['Teacher']['tchr_block_entry_dt']) == 0) {
//            $errorString.='<li>Invalid Date of Joining in Current School.</li>';
//        }
//        if (isset($data['Teacher']['tchr_appt_ord_no']['name']) && trim($data['Teacher']['tchr_appt_ord_no']['name']) != '') {
//            $filename = $data['Teacher']['tchr_appt_ord_no']['name'];
//            $imageFileType = explode('.', $filename);
//            $filename = $data['Teacher']['tchr_appt_ord_no']['name'];
//
//            if ($this->fileUpload($filename, $imageFileType[1]) == 0) {
//                $errorString.='<li style="padding-bottom: 5px;">Invalid Appoinment Order File.</li>';
//            }
//        }
//        if (isset($data['Teacher']['tchr_apprv_ord_no']['name']) && trim($data['Teacher']['tchr_apprv_ord_no']['name']) != '') {
//            $filename = $data['Teacher']['tchr_apprv_ord_no']['name'];
//            $imageFileType = explode('.', $filename);
//            $filename = $data['Teacher']['tchr_apprv_ord_no']['name'];
//
//            if ($this->fileUpload($filename, $imageFileType[1]) == 0) {
//                $errorString.='<li style="padding-bottom: 5px;">Invalid  Approval File.</li>';
//            }
//        }

        return $errorString;
    }

    function validationPayPfDtl($data) {
        $errorString = '';
//  echo "<pre>".print_r($data,TRUE)."</pre>";exit();   tchr_serv_entry_dt_post
        $currentDate = date("d/m/Y");
        if (isset($data['Teacher']['tp_pay_com_cd'])) {
            if ($this->isEmpty(trim($data['Teacher']['tp_pay_com_cd'])) == '') {
                $errorString.='<li>Please Select Pay Commission.</li>';
            }
        }
        if ((!(isset($data[0])))) {
            $errorString.='<li>Please Select Pay Scale</li>';
        }

        if ($this->isEmpty(trim($data['Teacher']['tp_basic_pay'])) == '') {
            $errorString.='<li>Please Enter Basic Pay.</li>';
        }

        if (((($this->validateDate($data['Teacher']['tp_incr_dt'])) == 0)) || ($this->isEmpty(trim($data['Teacher']['tp_incr_dt'])) == '')) {
            $errorString.='<li>Please Enter Pay w.e.f. Date.</li>';
        }
        if ($this->DateGreater($data['Teacher']['tp_incr_dt'], $data['Teacher']['tchr_serv_entry_dt_post']) == 0) {
            $errorString.='<li>Please Enter Pay w.e.f. Date.</li>';
        }
        if (((($this->validatePanNo($data['Teacher']['tp_pan_no'])) == 0)) || ($this->isEmpty(trim($data['Teacher']['tp_pan_no'])) == '')) {
            $errorString.='<li>Please Enter Valid Pan No.</li>';
        }

        if ($this->isEmpty(trim($data['Teacher']['tp_acct_type'])) == '') {
            $errorString.='<li>Please Select Account Type.</li>';
        }
        if ((!(isset($data[1])))) {
            $errorString.='<li>Please Select Account Maintained by.</li>';
        }
//        if ($this->isEmpty(trim($data['Teacher']['tp_pf_nps_series'])) == '') {
//            $errorString.='<li>Please Select Series.</li>';
//        }
//        if ($this->isEmpty(trim($data['Teacher']['tp_pf_no'])) == '') {
//            //((($this->validateAccNo($data['Teacher']['tp_pf_no'])) == 0)) ||
//            $errorString.='<li>Please Enter Valid Account No.</li>';
//        }
//        if ($this->isEmpty(trim($data['Teacher']['tp_gis_appl'])) == '') {
//            $errorString.='<li>Please Select GIS Applicable ?</li>';
//        }
//        if ((trim($data['Teacher']['tp_gis_appl'])) != 0) {
//            if ($this->isEmpty(trim($data['Teacher']['tp_gis_group'])) == '') {
//                $errorString.='<li>Please Select Current GIS Group.</li>';
//            } 
//            else if (((($this->validateDate($data['Teacher']['tp_gis_memb_dt'])) == 0)) || ($this->isEmpty(trim($data['tp_gis_memb_dt'])) == '')) {
//                $errorString.='<li>Err... Enter Membership Date</li>';
//            } 
//            
//            
//            else if ($this->DateGreater($data['Teacher']['tp_gis_memb_dt'], $data['Teacher']['tchr_serv_entry_dt_post']) == 0) {
//                $errorString.='<li>Err... Enter Membership Date</li>';
//            }
//        }
//        if (isset($data['Teacher']['tp_pay_com_cd'])) {
//            if (($data['Teacher']['tp_pay_com_cd'] == 12) || ($data['Teacher']['tp_pay_com_cd'] == 14)) {
//                if ($this->isEmpty(trim($data['Teacher']['tp_pay_in_band'])) == '')
//                    $errorString.='<li>Please Enter Pay In Band.</li>';
//                if ($this->isEmpty(trim($data['tp_grade_pay'])) == '')
//                    $errorString.='<li>Please Enter Grade Pay.</li>';
//            }
//        }
        return $errorString;
    }

    function validateDate($check) {
//        echo "--DT--".$check;
//        $pattern = "/(((0|1)[1-9]|2[1-9]|3[0-1])\/(0[1-9]|1[1-2])\/((19|20)\d\d))$/";
        $pattern = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
        $result = !(preg_match($pattern, $check));
//          echo "--Result---".$result;  
        return $result;
    }

    function validatePanNo($check) {
        $pattern = "/^([a-zA-Z]{5})(\d{4})([a-zA-Z]{1})$/";
        $result = preg_match($pattern, $check);
        return $result;
    }

    function validateAccNo($check) {
        $pattern = "/^([0-9]{6})$/";
        $result = preg_match($pattern, $check);
        return $result;
    }

    function alphabets($check) {
        $result = preg_match('|^[a-zA-Z]*$|', $check);
        return $result;
    }

    function isEmpty($check) {
//        echo "check==".$check;exit();
        if ($check == '') {
            $result = 0;
        } else {
            $result = 1;
        }

        return $result;
    }

    function DateGreater($date1, $date2) {
        $date1 = split("\/", $date1);
        $date1 = $date1[0] . '-' . $date1[1] . '-' . $date1[2];
        $date1 = date('Ymd', strtotime($date1));

        $date2 = split("\/", $date2);
        $date2 = $date2[0] . '-' . $date2[1] . '-' . $date2[2];
        $date2 = date('Ymd', strtotime($date2));

        if ($date1 > $date2) {// || $date1 == $date2) {
            $result = 0;
        } else {
            $result = 1;
        }
        return $result;
    }

//    function fileUpload($name, $type) {
//        $uploadOk = 1;
//        $newFileName = NULL;
//        if (isset($name) && !empty($name)) {
//            if (isset($type) && $type != '') {
//                if ($type != "jpg" && $type != "png" && $type != "jpeg") {
//                    echo "Sorry, only JPG, JPEG, PNG files are allowed.";
//                    $uploadOk = 0;
//                }
//            }
//        } else {
//            $uploadOk = 1;
//        }
//        return $uploadOk;
//    }

    function fileUpload($name, $type, $temp_name, $targetFolderPath) {

        $newFileName = NULL;
        if (isset($name) && !empty($name)) {
//           $newFileName = time() . '_' . strtolower(str_replace(' ', '_', $name));
            $newFileName = $name;
            $target_dir = $targetFolderPath; //WWW_ROOT . "uploads";
//            echo "".$targetFolderPath."<br>";

            $destination_file = WWW_ROOT . "nfsshare/" . $targetFolderPath . "" . DS . $newFileName;
//            exit();

            $uploadOk = 1;
            $imageFileType = strtolower(array_pop(explode('.', $newFileName)));


            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only JPG, JPEG, PNG files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                $newFileName = NULL;
            } else {
                try {
                    if (!file_exists($targetFolderPath)) {
                        mkdir($targetFolderPath); // creates folder if  not found
                    }
                    /*                     * *********FTP FILE UPLOAD*********************************************** */
                    //  $destination_file = "/dev/mapper/vg_mhsdctest1-LV_scandocs/" . $filename;
                    $ftp_server = "10.187.203.111";  //address of ftp server. // '10.187.203.112',
                    $ftp_user_name = "webadmin"; // Username 
                    $ftp_user_pass = "webadmin";   // Password
                    $conn_id = ftp_connect($ftp_server);        // set up basic connection

                    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass) or die("<h2>You do not have access to this ftp server!</h2>");
                    if (file_exists($destination_file)) {
                        unlink($destination_file);
                    }

                    $upload = ftp_put($conn_id, $destination_file, $temp_name, FTP_BINARY);


                    /*                     * *************************End file upload***************************** */

                    //  move_uploaded_file($temp_name, $target_file);
                } catch (Exception $ex) {
                    echo $ex->getMessage();
                }
            }
        } else {
            $newFileName = NULL;
        }
    }

//    function validation($data) {
//       
//
//        $errorString = '';
//
//        if (($this->isAlpha(trim($data['textfield2'])))&& ($this->notEmpty(trim($data['textfield2'])))) {
//
//           
//            $errorString.='<li>Enter Only Alphabets.</li>';
//            $errorString.='<li>Field Should not be Empty.</li>';
//        }
//        if (($this->isAlpha(trim($data['textfield3']))) && ($this->notEmpty(trim($data['textfield3'])))) {
//            $errorString.='<li>Enter Only Alphabets.</li>';
//            $errorString.='<li>Field Should not be Empty.</li>';
//            
//        }
////        if (($this->isAlpha(trim($data['textfield4'])))) {
////            $errorString.='<li>Enter Only Alphabets</li>';
////        }
////        if (($this->isAlpha(trim($data['textfield4'])))) {
////            $errorString.='<li>Enter Only Alphabets</li>';
////        }
//        return $errorString;
//    }
    function notEmpty($value) {
        if ($value == '') {
            return true;
        } else {
            return false;
        }
    }

    public function discardAll() {
        $query = "DISCARD ALL";
        try {
            $this->query($query);
        } catch (Exception $ex) {
            
        }
    }

}

?>