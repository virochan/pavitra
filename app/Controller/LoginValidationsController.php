<?php

//echo phpinfo();exit();
Class LoginValidationsController extends AppController {

    public $name = "LoginValidations";
    public $helpers = array('Js' => array('Jquery'));

    public function LoginValidation() {
        $this->layout = 'ajax';
//        echo "<pre>" . print_r($this->data, true) . "</pre>";
//        exit();
        $saltKey = $this->Session->read('saltKey');
        $captcha = $this->Session->read('captcha_code');
        if (!empty($this->data['LoginValidationsotp'])) {
            $user_id = trim($this->data['LoginValidationsotp']['user_id_otp']);
            $password = trim($this->data['LoginValidationsotp']['password']);
            $otp = trim($this->data['LoginValidationsotp']['otp']);
            $capthcha_otp = trim($this->request->data['LoginValidationsotp']['captcha']);
        }
        if (!empty($this->data['LoginValidations'])) {
            $user_id = trim($this->data['LoginValidations']['user_id']);
            $password = trim($this->data['LoginValidations']['password']);
            $capthcha_otp = trim($this->request->data['LoginValidations']['captcha']);
        }
        if (!isset($user_id) && empty($user_id) && !isset($password) && empty($password)) {
            $this->set('url', $this->webroot . "users/login");
            exit;
        }
        $flag = 0;
        $this->loadModel('ApplicantUser');
        $qry = $this->ApplicantUser->query("select * from pavitra.pv_appl_user where user_id='$user_id' and reg_flag='1'");
//        pr($qry);
//        echo $password;
//        exit;
        $usercount = strlen($user_id);
        if ($usercount == '16') {
//            echo $password."=====".$qry[0][0]['user_password']; 
            if (!empty($qry) && trim($qry[0][0]['user_password']) == $password) {
                if (($user_id == trim($qry[0][0]['user_id'])) && ($captcha == $capthcha_otp) && (strlen($captcha) == strlen($capthcha_otp))) {
                    $role_desc = 'applicant';
                    $module_desc = 'Pavitras';
                    $this->loadModel('PvApplicant');
                    $qry = $this->PvApplicant->query("Select *,now() from pavitra.applicant_det_mast where pv_apptn_id='$user_id'");
                    $apln_id = trim($qry[0][0]['pv_apptn_id']);
                    $apln_name = trim($qry[0][0]['pv_apptn_fname']) . ' ' . trim($qry[0][0]['pv_apptn_mname']) . ' ' . trim($qry[0][0]['pv_apptn_lname']);
                    $this->Session->write("apln_id", $apln_id);
                    $this->Session->write("apln_name", $apln_name);
                    $this->Session->write("user_id", $user_id);
                    $this->Session->write("module_desc", $module_desc);
                    $this->Session->write("role_desc", $role_desc);
                    $this->Session->write("user_desc", $role_desc);
                    $this->Session->write("app_id", $user_id);
                    $this->set('url', $this->webroot . $module_desc . "/" . $role_desc);
                }
            } else {
                if (!empty($qry)) {
                    $this->set('error', 'Please Register.');
                }
                if (trim($qry[0][0]['user_password']) != $password) {
                    $this->set('error', 'Password Mismatch.');
                }
            }
        } else {
            if (($captcha == $capthcha_otp) && (strlen($captcha) == strlen($capthcha_otp))) {

//            } else {
                if (!empty($user_id) && !empty($password)) {
                    $this->loadModel('CheckLogin');  // Custum Query
                    $result = $this->CheckLogin->get($user_id);

//                echo "<br>".ucwords(trim($result[0][0]['user_desc']));
//                exit();
//            echo $password."=====".(md5($result[0][0]['user_password'] . (md5($saltKey)))); 

                    if ($password != (md5($result[0][0]['user_password'] . (md5($saltKey))))) {
//             echo "IFFFFF";   exit();
                        $this->Session->setFlash('Invalid User Id OR Password. Please try again.', 'default', array(), 'form1');
                        $this->set('url', $this->webroot . "users/login");
                    } else {
                        $userIdDist = (substr(trim($result[0][0]['user_id']), 0, 4));
                        $management_details = trim($result[0][0]['management_details']);
                        $user_id = trim($result[0][0]['user_id']);
                        if (!empty($user_id)) {
//echo "IFFFFFFFFFFFFFFFF";
//exit();
                            $user_id = trim($result[0][0]['user_id']);
                            $module_desc = 'Pavitras';
                            $role_desc = "";

                            $acad_year_tchr = '';
                            if (date('m') < 6) {
                                $new_year1 = (date('Y') - 1);
                                $new_year2 = (substr($new_year1, 2, 3)) + 1;
                            } else {
                                $new_year1 = date('Y');
                                $new_year2 = (substr($new_year1, 2, 3)) + 1;
                            }

                            $acad_year_tchr = $new_year1 . "-" . $new_year2;



                            if (($result[0][0]['user_desc'] == 'Sanstha') || ($result[0][0]['user_desc'] == 'sanstha')) {

                                $role_desc = 'sanstha';
                                $this->Session->write("user_id", trim($result[0][0]['user_id']));
                                $this->Session->write("user_name", trim($result[0][0]['operator_name']));
                                $this->Session->write("user_desc", ucwords(trim($result[0][0]['user_desc'])));
                                $this->Session->write("acad_year_tchr", $acad_year_tchr);
                                $this->Session->write("school_name", trim($result[0][0]['school_name']));

                                $user_id = $this->Session->read('user_id');
                                $this->loadModel('ShalaSchool');
                                $FindedSchoolName = $this->ShalaSchool->find('all', array('conditions' => array('schcd' => $user_id)));

                                if (!empty($FindedSchoolName)) {
                                    $management_details = $FindedSchoolName[0]['ShalaSchool']['management_details'];
                                    $this->set('management_details', $management_details);
                                    $this->Session->write("management_details", $management_details);
                                }
                            }

                            if (($result[0][0]['user_desc'] == 'Head Master') || ($result[0][0]['user_desc'] == 'head master')) {

                                $role_desc = 'hm';
                                $this->Session->write("user_id", trim($result[0][0]['user_id']));
                                $this->Session->write("user_name", trim($result[0][0]['operator_name']));
                                $this->Session->write("user_desc", ucwords(trim($result[0][0]['user_desc'])));
                                $this->Session->write("acad_year_tchr", $acad_year_tchr);

                                $user_id = $this->Session->read('user_id');
                                $this->loadModel('ShalaSchool');
                                $FindedSchoolName = $this->ShalaSchool->find('all', array('conditions' => array('schcd' => $user_id)));

                                if (!empty($FindedSchoolName)) {
                                    $management_details = $FindedSchoolName[0]['ShalaSchool']['management_details'];
                                    $this->set('management_details', $management_details);
                                    $this->Session->write("management_details", $management_details);
                                }
                            } else if (($result[0][0]['user_desc'] == 'Cluster Head') || ($result[0][0]['user_desc'] == 'cluster head' ) || ($result[0][0]['user_desc'] == 'clusterhead') || ($result[0][0]['user_desc'] == 'Cluster Officer' )) {
                                $role_desc = 'clusterhead';
                                $this->Session->write("user_id", trim($result[0][0]['user_id']));
                                $this->Session->write("user_name", trim($result[0][0]['operator_name']));
                                $this->Session->write("user_desc", ucwords(trim($result[0][0]['user_desc'])));
                                $this->Session->write("acad_year_tchr", $acad_year_tchr);
                            } else if ($result[0][0]['user_desc'] == 'Block Education Officer') {
                                $role_desc = 'beo';
                                $this->loadModel('ShalaBlock');
                                $BlockName = $this->ShalaBlock->getblocknamesSession($user_id);
                                if (isset($BlockName[0][0]['blkname']))
                                    $this->Session->write("block_name", trim($BlockName[0][0]['blkname']));

                                $this->Session->write("user_id", trim($result[0][0]['user_id']));
                                $this->Session->write("user_name", trim($result[0][0]['operator_name']));
                                $this->Session->write("user_desc", ucwords(trim($result[0][0]['user_desc'])));
                                $this->Session->write("acad_year_tchr", $acad_year_tchr);
                            }
                            else if (($result[0][0]['user_desc'] == 'Education Officer Primary') || ($result[0][0]['user_desc'] == 'Education Officer Secondary')) {
                                $role_desc = 'eduofficer';
                                $this->Session->write("user_id", trim($result[0][0]['user_id']));
                                $this->Session->write("user_name", trim($result[0][0]['operator_name']));
                                $this->Session->write("user_desc", ucwords(trim($result[0][0]['user_desc'])));
                                $this->Session->write("acad_year_tchr", $acad_year_tchr);
                            } else if (($result[0][0]['user_desc'] == 'Director Primary')) {
                                $role_desc = 'director_primary';
                                $this->Session->write("user_id", trim($result[0][0]['user_id']));
                                $this->Session->write("user_name", trim($result[0][0]['operator_name']));
                                $this->Session->write("user_desc", ucwords(trim($result[0][0]['user_desc'])));
                                $this->Session->write("acad_year_tchr", $acad_year_tchr);
                            } else if (($result[0][0]['user_desc'] == 'Director Secondary')) {
                                $role_desc = 'director_secondary';
                                $this->Session->write("user_id", trim($result[0][0]['user_id']));
                                $this->Session->write("user_name", trim($result[0][0]['operator_name']));
                                $this->Session->write("user_desc", ucwords(trim($result[0][0]['user_desc'])));
                                $this->Session->write("acad_year_tchr", $acad_year_tchr);
                            } else if (($result[0][0]['user_desc'] == 'State Administrator') || ($result[0][0]['user_desc'] == 'state administrator')) {
                                $role_desc = 'stateadministrator';
                                $this->Session->write("user_id", trim($result[0][0]['user_id']));
                                $this->Session->write("user_name", trim($result[0][0]['operator_name']));
                                $this->Session->write("user_desc", ucwords(trim($result[0][0]['user_desc'])));
                                $this->Session->write("acad_year_tchr", $acad_year_tchr);
                            } else if (($result[0][0]['user_desc'] == 'Administrator Officer')) {
                                $role_desc = 'administratorofficer';
                                $this->Session->write("user_id", trim($result[0][0]['user_id']));
                                $this->Session->write("user_name", trim($result[0][0]['operator_name']));
                                $this->Session->write("user_desc", ucwords(trim($result[0][0]['user_desc'])));
                                $this->Session->write("acad_year_tchr", $acad_year_tchr);
                            } else if (($result[0][0]['user_desc'] == 'Guest')) {
                                $role_desc = 'Guest';
                                $this->Session->write("user_id", trim($result[0][0]['user_id']));
                                $this->Session->write("user_name", trim($result[0][0]['operator_name']));
                                $this->Session->write("user_desc", ucwords(trim($result[0][0]['user_desc'])));
                                $this->Session->write("acad_year_tchr", $acad_year_tchr);
                            } else {
                                $role_desc = $result[0][0]['user_desc'];
                                $this->Session->write("user_id", trim($result[0][0]['user_id']));
                                $this->Session->write("user_name", trim($result[0][0]['operator_name']));
                                $this->Session->write("user_desc", ucwords(trim($result[0][0]['user_desc'])));
                                $this->Session->write("acad_year_tchr", $acad_year_tchr);
                            }

//                    ---Teachers---Tech
                            if ($role_desc == 'query') {
                                $module_desc = 'techs';
//                            echo "---role_desc ---" . $result[0][0]['role_desc'];
//                             echo "---user_desc ---" . $result[0][0]['user_desc'];
                                $this->Session->write("module_desc", $module_desc);
                                $this->Session->write("role_desc", $result[0][0]['role_desc']);
                                $this->Session->write("user_desc", (trim($result[0][0]['user_desc'])));
//echo "". $this->webroot."----".$module_desc."----".$role_desc,exit(); ///Education/----techs----query
                                $this->set('url', $this->webroot . $module_desc . "/" . $role_desc);
                            } else {
//                                echo "". $this->webroot."----".$module_desc."----".$role_desc,exit(); ///Education/----techs----query
                                $this->Session->write("module_desc", $module_desc);
                                $this->Session->write("role_desc", $result[0][0]['role_desc']);
//pr($this->webroot . $module_desc . "/" . $role_desc);exit;
                                $this->set('url', $this->webroot . $module_desc . "/" . $role_desc);
                            }
//                        } else {
////                            $this->set('error', 'Already 2 Users are Logged IN.');
//                            $this->Session->setFlash('Allready 2 Users are logged IN. Please try again.', 'default', array(), 'form1');
//                            $this->set('url', $this->webroot . "users/login");
//                        }
                        }//IF end of District Check
                    }
                } else {
                    $this->set('error', 'User Id or Password must not be empty.');
                }
//            }
            } else {
                $this->set('error', 'Captcha code does not match. Verification unsuccessful.');
            }
        }
    }

}

?>
