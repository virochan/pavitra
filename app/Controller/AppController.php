<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
//class AppController extends Controller {
//      var $helpers = array('Html', 'Form','Session');
//}


class AppController extends Controller {

    var $components = array('Session', 'Captcha', 'Cookie', 'Common', 'Auth' => array(
//            'loginRedirect' => array('controller' => 'Users', 'action' => 'login'),
            'loginRedirect' => array('controller' => 'Users', 'action' => 'index'),
            'autoRedirect' => false,
            'authError' => 'You Cannt access that page',
            'loginError' => 'Invalid Username or Password entered, please try again.',
            'authorize' => array('Controller')
    ));

    public function initialize() {

        parent::initialize();

        $this->loadComponent('Csrf', ['secure' => true]);
        $this->loadComponent('Cookie', [
            'httpOnly' => true,
            'secure' => true
                ]
        );
    }

    function beforeFilter() {
        parent::beforeFilter();
        $this->_checkRoute();
//        $this->_checkCookie();
        $this->Auth->autoRedirect = FALSE;
        $this->Auth->allow('disclaimer', 'terms_conditions', 'privacy_policy', 'copyright_policy', 'hyperlink_policy', 'important_links', 'SelectDist', 'SelectRegion', 'SelectEoDrop', 'index', 'SelectBlock', 'SelectCluster', 'SelectSchool', 'SchoolData', 'LoginValidation', 'get_captcha', 'pwdWebSrvc', 'get_dist_tchr_cnt', 'entry_status_login_blkwise', 'entry_status_login_cluwise','otp','pushSMS','checklogin');
        $this->Auth->allowedActions = array('disclaimer', 'terms_conditions', 'privacy_policy', 'copyright_policy', 'hyperlink_policy', 'important_links', 'SelectDist', 'SelectRegion', 'SelectEoDrop', 'index', 'SelectBlock', 'SelectCluster', 'SelectSchool', 'SchoolData', 'LoginValidation', 'get_captcha', 'pwdWebSrvc', 'get_dist_tchr_cnt', 'entry_status_login_blkwise', 'entry_status_login_cluwise','otp','pushSMS','checklogin');

        if ($this->Session->read("user_id")) {
//            echo "----------".$this->Session->read("user_desc");exit();
            if ($this->Session->read("user_desc") != '') {
//                ini_set('session.cookie_secure', 1);
//                ini_set('session.cookie_httponly', 1);
//                 ini_set('session.referer_check', 1);
//                ini_set('session.use_only_cookies', 1);

                if (($this->Session->read("user_desc") == 'Applicant') || ($this->Session->read("user_desc") == 'applicant')) {
                    $this->Auth->allowedActions = array('applicant', 'get_captcha', 'DeleteSession', 'underdevelopment', 'logout', 'LoginValidation',
                        'hm', 'applicant_prof_qual', 'applicant_acad_qual', 'applicant_acad_qual', 'applicant_prof_qual', 'save_applicant_acad',
                        'save_applicant_prof', 'BoardUnivbyLevelid', 'BoardUnivbystateid', 'SelectProfQual', 'apply_posn', 'applicant_details', 'SelectSansthapplicant'
                        , 'getsansthadetails', 'save_apply_posn', 'applicant_details_update','tetdetails','savetetdetails','checkpapperonedata','checkpappertwodata'
                        ,'arrange_list','save_arrange_list','ctetdetails');
                }


                if (($this->Session->read("user_desc") == 'Sanstha') || ($this->Session->read("user_desc") == 'sanstha')) {
                    $this->Auth->allowedActions = array('sanstha', 'logout', 'pp', 'pv_rostersans', 'get_staff_avail', 'get_roster_data', 'roster_save', 'roster_delete',
                        'extract_rost_data',
                        'incert_roster_data', 'exc_get_staff_avail', 'exc_get_roster_data', 'fwd_pvros_eo', 'forward_roster'
                        , 'eo_sanstha_excess_vacancy_decalar', 'SelectBlocksearch', 'SelectClustersearch', 'SelectSchoolsearch', 'SelectSchoolSearchSanstha',
                        'searchSchoolNameSanstha', 'SelectSchoolMediumForSanstha'
                        , 'SelectSchoolPostsForSanstha', 'SelectExcessVacantRadio', 'save_excess_vacancy_detail'
                        , 'forward_ex_vac_to_eo', 'selectdesig', 'selectmed', 'getschools', 'forward_sanstha_ex_vac_detail', 'fwdexvacdettoeo',
                        'create_adv', 'SelectAcadQual', 'advertise_save', 'DispGridData', 'delete_advertise', 'FetchAge', 'modify_advertise',
                        'caste_ctg_bcklog', 'social_ctg_bcklog', 'rep_generate_adv', 'get_caste_ctg_data', 'caste_ctg_save', 'SelectSubject', 'SelectProfQual',
                        'social_ctg_save', 'get_soc_categ_data', 'PvAdvertiseReportPdf', 'applicant_details', 'extract_vac_data', 'GetVacaDet', 'save_vaca_det',
                        'ChkVcntCnt', 'rep_schwise_vaca', 'PvSchwiseVacancyPDF', 'forward_adv', 'DispFwdAdv', 'advertise_fwd', 'CheckRosterStatus',
                        'view_applicant_list');
                }




                if (($this->Session->read("user_desc") == 'Guest') || ($this->Session->read("user_desc") == 'guest')) {
                    $this->Auth->allowedActions = array('Guest', 'logout', 'pp');
                }
                if (($this->Session->read("user_desc") == 'Head Master') || ($this->Session->read("user_desc") == 'head master')) {
                    $this->Auth->allowedActions = array('get_captcha', 'DeleteSession', 'underdevelopment', 'logout', 'LoginValidation',
                        'hm');
                } else if (($this->Session->read("user_desc") == 'Education Officer Primary') || ($this->Session->read("user_desc") == 'Education Officer Secondary')) {
                    $this->Auth->allowedActions = array('LoginValidation', 'DeleteSession', 'underdevelopment', 'eduofficer', 'nn'
                        , 'verify_ex_vac_eo', 'selectsanstha', 'selectdesigverif', 'selectmedverif', 'verify_ex_vac_detail', 'verifrejectexvacdets',
                        'pv_roster_verf_sans', 'get_roster_verf_data', 'verify_roster', 'pv_roster_unverf_sans', 'get_roster_unverf_data', 'unverify_roster',
                        'sanstha_excess_vacancy_decalar_eo',
                        'rep_particular_sans_vaca', 'rep_all_sans_vaca', 'PvParticularSansthaVacaPdf', 'PvAllSansthaVacaPdf', 'SelectDistrict', 'approve_adv', 'advertise_aprv',
                        'DispAppAdv', 'view_applications',
                        'appln_list_eo', 'ApplnMed', 'appln_med', 'ApplnDesg', 'appln_desg', 'ApplnSubj', 'appln_subj', 'check_appln_rec', 'CheckApplnRec', 'CheckAllRec'
                    );
                }
            }
        }
        $this->Auth->fields = array('username' => 'user_id', 'password' => 'user_password');
//        $this->_checkRoute();
    }

    function _checkRoute() {
        $params = $this->params['pass'];
        $url = $this->here;

        if (strpos($url, 'language:jpn')) {
            $this->Session->write('Config.language', 'jpn');
            Configure::write('Config.language', 'jpn');
        } elseif (strpos($url, 'language:eng')) {
            Configure::write('Config.language', 'eng');
            $this->Session->write('Config.language', 'eng');
        }
    }

//    public function _checkCookie() {
//        $this->Cookie->name = 'CAKEPHP';
//        $this->Cookie->time = 0;  // or '1 hour'
//        $this->Cookie->path = '/Education';
////    $this->Cookie->domain = 'https://education.maharashtra.gov.in';
////        $this->Cookie->domain = 'http://10.153.16.180';
//         $this->Cookie->domain =  'http://127.0.0.1';
//        $this->Cookie->secure = true;  // i.e. only sent if using secure HTTPS
//        $this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
//        $this->Cookie->httpOnly = true;
////    $this->Cookie->type('aes');
//    }

    function _setErrorLayout() {
        if ($this->name == 'CakeError') {
            $this->layout = 'Error404';
        }
    }

    function beforeSave() {
        $this->data = Sanitize::clean($this->data);
        return true;
    }

    function beforeRender() {
        $this->response->disableCache();
        $this->_setErrorLayout();
    }

    public function isAuthorized($user) {
// Here is where we should verify the role and give access based on role
        return true;
    }

//    function beforeRender() {
//        $this->response->disableCache();
//        $this->_setErrorLayout();
//        hm27280107902
//    }
//Removed Functions--- 'update_tchr_mast','udiseform',addSessionTeachersId,'paperSetter', 'moderator','ltcDetails','presentAddr','previous_goverment_service','homeTown','nativeAddr',
//save_forward_all_acad_qual_data,save_forward_all_prof_qual_data,save_forward_all_caste_cert_data,save_forward_all_caste_valid_cert_data,save_forward_all_family_dtl_data,save_forward_all_nomi_original_data
//save_forward_all_nomi_alter_data,'teachingDetails','initaptdtl','familydtl','RenewalDtl','ltcdtl','InitAppointDts','teacherQualibyid','admin', 'headmaster','adpl', 'index',
//'lastAcademicYear', 'address','UdiseRecordEdit','save_forward_all_pay_pf_data','index','printUdise','SelectedSchooldata','forwardacadmic','forwardacadmicdatatoCluster',
//'academic_cluster','SelectacademictechrCluster', 'verifyacademicdatatoCluster','jsontchdtls','save_teaching_dtls','appforsubj', 'sch_status_list', 
//'frwrdotherdetails','personal_cluster','personaltechrCluster','TeacherPersonalDetailbyid','verifypersonal', 'frwrdotherdetails','schoolregstatus_pdf',
//'general_stat','schltchrlist','ph_school_report','ProfExaminationbyLevelid','caste_not_entered_data','view_not_entered_caste_data','view_st_staff_ph_type_stat'
}
