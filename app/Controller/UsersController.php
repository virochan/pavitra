<?php

Class UsersController extends AppController {

//    public $name = "Users";
//    public $helpers = array('Js' => array('Jquery'));
//      var $components = array('Auth'); // Not necessary if declared in your app controller
    public $components = array('Common', 'Auth', 'Captcha');
    public $helpers = array('Js' => array('Jquery'));

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow(array(
            'controller' => 'Users',
//            'action' => 'login'
            'action' => 'index'
                ), 'logout');
    }

    public function isAuthorized($user) {
        // All registered users can add posts
        if ($this->action === 'login') {
            return true;
        }
    }

    public function index() {
        $this->layout = 'landing_default';
        if (isset($_SERVER['SERVER_ADDR']))
            $this->Session->write("server_ip", substr($_SERVER['SERVER_ADDR'], 11, 12));
    }

    public function login() {
        $this->layout = 'default';
        $this->set('saltKey', $this->createSalt());
        $this->loadModel('SelectShalaRole');
        $roles = $this->SelectShalaRole->find('all', array('conditions' => array('module_id' => '1')));
        $this->set('roles', $roles);
//        $this->loadModel('SchoolInfo');
//        $this->loadModel('State');
//        $this->set('StateList', $this->State->find('list', array('fields' => array('statcd', 'statname'))));
//
//        $this->loadModel('District');
//        $state_id = '27';
//        $dis = $this->District->find('list', array('conditions' => array('substring(District.distcd,1,2)' => array($state_id)), 'fields' => array('distcd', 'distname'), 'order' => array('distname', 'distname DESC')));
//        $this->set('district_list', $dis);
    }

    public function otp() {
        $this->layout = 'ajax';
        $mob = $_POST['mob'];
        $LoginsUserId = $_POST['LoginsUserId'];
        $LoginsPassword = $_POST['LoginsPassword'];
        $mobileNo = trim($mob);
        $rndno = rand(1000, 9999);
        $message = urlencode("otp number is." . $rndno);
//        pushSMS($mobileNo, $message);  . $rndno
        $this->loadModel('ApplicantUser');
        $check = $this->ApplicantUser->query("select * from pavitra.pv_appl_user where user_id='$LoginsUserId' and reg_flag='1'");
        if (!empty($check)) {
            $dis = 1;
            $this->set('flag', $dis);
        } else {
            $data = array(
                "username" => "MAHSCHEDU", // type your assigned username here(for example:"username" => "CDACMUMBAI")
                "password" => "Cdac@123", //type your password
                "senderid" => "MAHEDU", //type your senderID
                "smsservicetype" => "singlemsg", //*Note*  for single sms enter  ??singlemsg?? , for bulk   enter �bulkmsg??
                "mobileno" => $mobileNo, //enter the mobile number 
                "bulkmobno" => "", //enter the mobile numbers separated by commas, in case of bulk sms otherwise leave it blank
                "content" => @$message               //type the message.
            );
            $url = "http://10.248.220.187/esms/sendsmsrequest";
            $fields = '';
            foreach ($data as $key => $value) {
                $fields .= $key . '=' . $value . '&';
            }
            rtrim($fields, '&');
            $post = curl_init();
            curl_setopt($post, CURLOPT_URL, $url);
            curl_setopt($post, CURLOPT_POST, count($data));
            curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);

            $result = curl_exec($post);
            curl_close($post);
            $respose = trim($result);
            $respose = explode(',', $respose);
            $res_no = trim(substr($respose[0], 0, 3));
            $responseArr = array('401' => 'Credentials Error, may be invalid username or password',
                '403' => 'Credits not available', '404' => 'Internal Database Error.',
                '405' => 'Internal Networking Error.', '406' => 'Invalid or Duplicate numbers',
                '407' => 'Network Error on SMSC.', '408' => 'Network Error on SMSC.', '410' => 'Internal Limit Exceeded, Contact support.',
                '411' => 'Sender ID not approved. ', '412' => 'Sender ID not approved.', '413' => 'Suspect Spam, we do not accept these messages.',
                '414' => 'Rejected by various reasons by the operator such as DND, SPAM etc.');
//            pr($result);
//            pr($responseArr);die;
            if ($result == true) {
                $qry = $this->ApplicantUser->query("Update pavitra.pv_appl_user set user_password='$LoginsPassword',otp='$rndno',mobile_no='$mob',reg_flag='1',password_updated=now() where user_id='$LoginsUserId'");
            } else {
                if ($res_no == '402' || $res_no == '409') {
                    return 0;
                } else {
                    return $responseArr[$res_no];
                }
            }
        }
    }

    public function checklogin() {
        $this->layout = 'ajax';
        $LoginsUserId = $_POST['LoginsUserId'];
        $this->loadModel('ApplicantUser');
        $check = $this->ApplicantUser->query("select * from pavitra.pv_appl_user where user_id='$LoginsUserId' and reg_flag='1'");
        if (!empty($check)) {
            $dis = 1;
            $this->set('flag', $dis);
        }
    }

    public function createSalt() {
        $charArray = array();
        $upper = range('A', 'Z');
        $lower = range('a', 'z');
        $num = range(0, 9);
        $special = array('~', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '-');
        $charArray = array_merge($charArray, $upper, $lower, $num);
        $length = 5;
        $salt = "";
        /* Do we need to seed the random number generator? */
        if (version_compare(PHP_VERSION, '4.2.0') == -1) {
            mt_srand((double) microtime() * 1234567);
        }
        shuffle($charArray);

        for ($x = 0; $x < $length; $x++) {
            $salt .= $charArray[mt_rand(0, (sizeof($charArray) - 1))];
        }

        if (trim($salt) != '' && strlen($salt) == 5) {
            $this->Session->write("saltKey", $salt);
            $this->Session->read('saltKey');
            return $salt;
        } else {
            return 'ERORR';
        }
    }

//Selecting Block on District Change
    public function SelectDist() {
        $this->layout = 'ajax';
        $this->loadModel('District');
        $state_id = '27';
//        $between = 'BETWEEN 01 AND 10';
        $arr = array('22', '23', '25', '20', '34', '19', '07', '09', '28');
        $dis = $this->District->find('list', array('conditions' => array('substring(District.distcd,1,2)' => $state_id, 'substring(District.distcd,3,4)' => $arr), 'fields' => array('distcd', 'distname'), 'order' => array('distname', 'distname DESC')));
        //array('substring(District.distcd,3,4) BETWEEN ? AND ?' => array('01','10'))
//        echo "</pre>" . print_r($dis) . "</pre>";
//        exit();
        $this->set('district_list', $dis);
    }

    public function SelectRegion() {
        $this->layout = 'ajax';
        $this->loadModel('Region');
        $region = $this->Region->find('list', array('fields' => array('region_code', 'region_name'), 'order' => array('region_name', 'region_name DESC')));
//        echo "</pre>" . print_r($region) . "</pre>";
//        exit();
        $this->set('region', $region);
    }

    public function SelectEoDrop() {
        $this->layout = 'ajax';
    }

//    public function SelectEo() {
//        $this->layout = 'ajax';
//        $this->loadModel('SelectEoUser');
//        $eo_drop_id = $_POST['eo_drop_id'];
//        $dist_id = $_POST['dist_id'];
//
//         $EoList = $this->SelectEoUser->getEoUser($dist_id,$eo_drop_id); //No. of Teachers
//         echo "</pre>".print_r($EoList)."</pre>";exit();
//        $this->set('district_list', $dis);
//    }

    public function SelectBlock() {
        $this->layout = 'ajax';
        $this->loadModel('Block');
        $dist_id = $_POST['dist_id'];
        $block = $this->Block->find('list', array('conditions' => array('substring(Block.blkcd,1,4)' => array($dist_id)), 'fields' => array('blkcd', 'blkname'), 'order' => array('blkname', 'blkname DESC')));
        $this->set('block_list', $block);
    }

//Selecting Cluster on Block Change
    public function SelectCluster() {
        $this->layout = 'ajax';
        $this->loadModel('ShalaCluster');
        $dist_id = $_POST['dist_id'];
        $block_id = $_POST['block_id'];
        $block_id1 = substr($block_id, 5, 6);
        $this->set('cluster_list', $this->ShalaCluster->find('list', array('conditions' => array('substring(ShalaCluster.clucd,1,6)' => array($block_id)),
                    'fields' => array('clucd', 'cluname'),
                    'order' => array('cluname', 'cluname DESC'))));
    }

    public function view() {
        //$this->set('data',$this->SchoolData->read(NULL , $id));
    }

    public function SelectSchool() {
        $this->layout = 'ajax';
        $this->loadModel('ShalaSchool');

        $user_role = $_POST['user_role'];
        $this->set('user_role', $user_role);


        if ($user_role == 'login_roles4') {

            $dist_id = $_POST['dist_id'];
            $this->loadModel('Block');
            $block = $this->Block->find('all', array('conditions' => array('substring(Block.blkcd,1,4)' => array($dist_id)),
                'fields' => array('blkcd', 'blkname'),
                'order' => array('blkname', 'blkname DESC')));
            $this->set('block_list', $block);
        }



        if ($user_role == 'login_roles5') {
            $dist_id = $_POST['dist_id'];
            $block_id = $_POST['block_id'];
            $block_id1 = substr($block_id, 5, 6);
            $this->loadModel('ShalaCluster');
            $this->set('cluster_list', $this->ShalaCluster->find('all', array('conditions' => array('substring(ShalaCluster.clucd,1,6)' => array($block_id)),
                        'fields' => array('clucd', 'cluname'),
                        'order' => array('cluname', 'cluname DESC'))));
        }



        if ($user_role == 'login_roles6') {
            $cluster_id = $_POST['cluster_id'];
            $schools = $this->ShalaSchool->find('all', array('conditions' => array('clucd' => $cluster_id),
                'order' => array('school_name', 'school_name DESC'))); //, 'AND' => array('ac_year' => '2014-15')
            $this->set('schools', $schools);
        }
    }

    public function SchoolData($schcd = '') {
        $this->layout = 'ajax';
        $this->loadModel('SchoolInfo');
        $global_ac_year = Configure::read('global_ac_year');
        $this->loadModel('SchoolInfoSanch'); // Custum Query
        $this->loadModel('SchoolStdMaster'); // Custum Query

        $schcd = $_POST['id'];

        //for School Information
        $schoolinfo = $this->SchoolInfo->find('all', array('conditions' => array('schcd' => $schcd, 'AND' => array('ac_year' => $global_ac_year))));
        $this->set('schoolinfo', $schoolinfo);
//        echo "<pre>" . print_r($schoolinfo, true) . "</pre>";
//        exit();
        //for  Teaching and Non-Teaching staff as per Sanch Manyata 
        $result = $this->SchoolInfoSanch->getSchoolInfoSanchPost($schcd);
        if ($result == 0) {
            $this->redirect(array("controller" => 'Users', "action" => 'login'));
        } else {
            $this->set('schoolinfoSanch', $result);
        }
//        echo "<pre>" . print_r($result, true) . "</pre>";
//        exit();

        $SchoolInfoStaffDtl = $this->SchoolInfoSanch->getSchoolInfoStaffDtl($schcd);
        if ($SchoolInfoStaffDtl == 0) {
            $this->redirect(array("controller" => 'Users', "action" => 'login'));
        } else {
            $this->set('SchoolInfoStaffDtl', $SchoolInfoStaffDtl);
        }
//        echo "<pre>".print_r($SchoolInfoStaffDtl,true)."</pre>";exit();

        $SchoolInfoSanDtlNteach = $this->SchoolInfoSanch->getSchoolInfoSanchPostNtech($schcd);
        if ($SchoolInfoSanDtlNteach == 0) {
            $this->redirect(array("controller" => 'Users', "action" => 'login'));
        } else {
            $this->set('SchoolInfoSanDtlNteach', $SchoolInfoSanDtlNteach);
        }

//         echo "<pre>".print_r($SchoolInfoSanDtlNteach,true)."</pre>";exit();

        $SchoolInfoStaffDtlNtech = $this->SchoolInfoSanch->SchoolInfoStaffDtlNtech($schcd);
        if ($SchoolInfoStaffDtlNtech == 0) {
            $this->redirect(array("controller" => 'Users', "action" => 'login'));
        } else {
            $this->set('SchoolInfoStaffDtlNtech', $SchoolInfoStaffDtlNtech);
        }

        //for Standard
        $schoolStd = $this->SchoolStdMaster->getSchoolStd($schcd);
        if ($schoolStd == 0) {
            $this->redirect(array("controller" => 'Users', "action" => 'login'));
        } else {
            $this->set('schoolStd', $schoolStd);
        }
    }

    public function calendar() {
        
    }

    public function logout() {
//echo "asasdasdsad";exit();
//        $this->loadModel('CheckLoginAttempts');
        $user_id = $this->Session->read('user_id');

//        $this->loadModel('CheckLoginAttempts');
//        $loginAttemptsArray = $this->CheckLoginAttempts->find('all', array('conditions' => array('user_id' => $user_id)));
//        if (sizeof($loginAttemptsArray) > 0) {
//            if ($loginAttemptsArray[0]['CheckLoginAttempts']['login_attempts_flag2'] == 'Y')
//                $this->CheckLoginAttempts->deleteAll(array('user_id' => $user_id, 'login_attempts_flag2' => 'Y'));
//            else
//            if ($loginAttemptsArray[0]['CheckLoginAttempts']['login_attempts_flag1'] == 'Y')
//                $this->CheckLoginAttempts->deleteAll(array('user_id' => $user_id, 'login_attempts_flag1' => 'Y'));
//        }


        $this->Session->delete('user_id');
        $this->Session->delete('user_name');
        $this->Session->delete('user_desc');
        $this->Session->delete('acad_year_tchr');
        $this->Session->delete('user_password');
        $this->Session->delete('module_desc');
        $this->Session->delete('role_desc');

        if ($this->Session->read('block_name'))
            $this->Session->delete('block_name');

        $this->Session->destroy();
//        $this->redirect('https://edustaff.maharashtra.gov.in');
        $this->redirect('http://localhost/pavitra_p');
    }

    public function get_captcha() {
        $this->autoRender = false;
        App::import('Component', 'Captcha');

        //generate random charcters for captcha
        $random = mt_rand(100, 99999);

        //save characters in session
        $this->Session->write('captcha_code', $random);

        $settings = array(
            'characters' => $random,
            'winHeight' => 50, // captcha image height 
            'winWidth' => 220, // captcha image width
            'fontSize' => 25, // captcha image characters fontsize 
            'fontPath' => WWW_ROOT . 'tahomabd.ttf', // captcha image font
            'noiseColor' => '#ccc',
            'bgColor' => '#fff',
            'noiseLevel' => '100',
            'textColor' => '#000'
        );

        $img = $this->Captcha->ShowImage($settings);
        echo $img;
    }

    public function disclaimer() {
//        $this->layout = 'Teacher_hm_default';
    }

    public function terms_conditions() {
//        $this->layout = 'Teacher_hm_default';
    }

    public function privacy_policy() {
//        $this->layout = 'Teacher_hm_default';
    }

    public function copyright_policy() {
//        $this->layout = 'Teacher_hm_default';
    }

    public function hyperlink_policy() {
//        $this->layout = 'Teacher_hm_default';
    }

    public function important_links() {
        
    }

    public function important_policy() {
        $this->layout = 'Teacher_hm_default';
    }

    public function pwdWebSrvc() {
        $this->layout = 'ajax';
        // echo "<pre>";print_r($this->request);
//	echo '===============';
        $data = $this->request->query['token'];
//	echo '---===---==--==-----';
        if ($data != '') {
//	    echo '---------------';
            $this->loadModel('Users');
            // echo '---><pre>';print_r($data);
            $webSrvsJson = $this->Users->decryptWebSrvc($data);
            $webSrvsArr = json_decode($webSrvsJson);

            $tokenK = base64_decode($webSrvsArr->tokenK);
            $tokenU = base64_decode($webSrvsArr->tokenU);
            $tokenP = base64_decode($webSrvsArr->tokenP);

            //     echo $tokenK . '--------' . $tokenU . '---------' . $tokenP;
            // UPDATE query for user table
            $this->loadModel('CheckLogin');
            $flag = $this->CheckLogin->changePassward($tokenU, $tokenP);
            $this->set('flag', $flag);
        }
        exit();
    }

    public function get_dist_tchr_cnt() {
        $this->layout = 'ajax';
        $dist_id = $_POST['distcd'];
        $this->loadModel('SelectStTchNtchMapping');
        //$cnt = $this->SelectStTchNtchMapping->find_districtk_name($dist_id); 
        $query1 = $this->SelectStTchNtchMapping->query("select dist_cd,distname,count(distinct(sch_cd )) as sch_cnt_sanch_manayta ,sum(sch_sm_tot) as  tch_cnt_sanch_manayta,
          0 as  filled_sch,0 as  filled_tchr
          from stat_data.stat_sm_mapping ,shala_live.shala_district
          where dist_cd = distcd and dist_cd = '$dist_id'
          group by dist_cd,distname
          order by distname");

        $query2 = $this->SelectStTchNtchMapping->query("SELECT  dist_cd,COUNT(DISTINCT sch_cd) as filled_sch ,sum(sch_mapped_tot + sch_updated_tot + sch_forwarded_tot + sch_verified_tot  + sch_rejected_tot + sch_discrepancy_tot + sch_cluster_return_tot) as filled_tchr      
        FROM stat_data.stat_sm_mapping
        WHERE   ((sch_mapped_tot > 0 )  OR (sch_updated_tot > 0 ) OR (sch_forwarded_tot > 0 ) OR (sch_verified_tot > 0 ) OR (sch_rejected_tot > 0 ) OR (sch_discrepancy_tot > 0 )   OR (sch_cluster_return_tot > 0 ) )  
        and dist_cd = '$dist_id' 
        group  by dist_cd");

        $array_length1 = count($query1);
        $array_length2 = count($query2);

        for ($i = 0; $i < $array_length1; $i++) {
            for ($j = 0; $j < $array_length2; $j++) {
                if (trim($query1[$i][0]['dist_cd']) == trim($query2[$j][0]['dist_cd'])) {
                    $query1[$i][0]['filled_sch'] = $query2[$j][0]['filled_sch'];
                    $query1[$i][0]['filled_tchr'] = $query2[$j][0]['filled_tchr'];
                }
            }
        }
// echo "<pre>"; print_r($query1);  exit();
        if (!empty($query1)) {
            $this->set('distData', $query1);
        }
    }

    public function entry_status_login_blkwise() {
        $this->layout = "ajax";
        if (isset($_POST['distcd'])) {
            $this->loadModel('SelectStTchNtchMapping');
            $this->loadModel('ShalaBlock');
            $distcd = trim($_POST['distcd']);
            $block_result = $this->SelectStTchNtchMapping->find_block_name($distcd);

            for ($i = 0; $i < count($block_result); $i++) {
                $block_name = $this->SelectStTchNtchMapping->find_blk_name($block_result[$i][0]['blkcd']);
                $block_result[$i][0]['blkname'] = $block_name[0][0]['blkname'];
            }
            $this->set('blkDetail', $block_result);
        }
    }

    public function entry_status_login_cluwise() {
        $this->layout = "ajax";
        if (isset($_POST['distcd']) && isset($_POST['blkcd'])) {
            $this->loadModel('SelectStTchNtchMapping');
            $distcd = $_POST['distcd'];
            $blkcd = $_POST['blkcd'];
            $cluster_result = $this->SelectStTchNtchMapping->find_cluster_name($distcd, $blkcd);
            $this->set('cluDetail', $cluster_result);
        }
    }

}

?>
