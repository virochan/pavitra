<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'Header Data');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
    <head>
        <script type="text/javascript" src="jquery.js"></script>



        <meta charset="utf-8">
            <?php echo $this->Html->charset(); ?>

            <meta name="viewport" content="width=700px; initial-scale=1.0">

                <title><?php echo __('School Education and Sports Department'); ?></title>
                <?php
                echo $this->Html->script('jquery.min');
                echo $this->Html->meta('icon');
                echo $this->Html->css('style');
                echo $this->Html->script('common');
                echo $this->fetch('meta');
                echo $this->fetch('script');
                echo $this->fetch('meta');
                echo $this->fetch('css');
                echo $this->fetch('script');
                echo $this->Html->css('style_menu_ch_beo');
                ?>
                <script type="text/javascript" src="jquery.js">
                    window.webroot = '<?php echo $this->webroot; ?>';
                </script>

                <script>
                    $(document).ready(function () {
                        $('.nav ul li ').click(function () {
                            $('.nav ul li').removeClass('active');
                            $(this).addClass('active');
                        });
                    });
                </script> 
                </head>
                <body>

                    <div id="pagewrap">
                        <header>
                            <div id="header-strip"> 

                                <div id="logo-main">
                                    <div id="emb1">
                                        <img src="<?php echo $this->webroot; ?>img/logo.png" alt="Government of Maharashtra">
                                    </div>
                                    <span> <?php echo __("School Education and Sports Department"); ?>
                                        <br>
                                            <small>Government of Maharashtra</small>
                                    </span>
                                </div>

                                <div id="emb2">
                                    <img src="<?php echo $this->webroot; ?>img/emb.png" alt="Government of India">
                                </div>

                            </div> 

                            <div id="static">


                                <nav>
                                    <ul class="nav">

                                        <li class="current-item"><a href="#" class="newclass"><?php echo __('Data Entry Status'); ?> </a>
                                            <ul>      

                                                <li><?php echo $this->Html->link(__('Status of data not entered'), array('action' => 'clusterhead')); ?>
                                                    <ul>
                                                        <li><?php echo $this->Html->link(__('Caste Category'), array('action' => 'caste_not_entered_data')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Caste Validation'), array('action' => 'castevld_not_entered_data')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Initial Appointment'), array('action' => 'init_not_entered_data')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Academic Qualification'), array('action' => 'acad_not_entered_data')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Professional Qualification'), array('action' => 'prof_not_entered_data')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Subjects Taught'), array('action' => 'subs_not_entered_data')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Physically Handicapped'), array('action' => 'ph_not_entered_data')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Family'), array('action' => 'fmly_not_entered_data')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Nomination'), array('action' => 'nomin_not_entered_data')); ?></li>

                                                    </ul>   
                                                </li>

                                                <li><?php echo $this->Html->link(__('Data Entry Status of Entire Cluster'), array('action' => 'destatusentirecluster')); ?></li>
                                            </ul>
                                        </li>

                                        <li><a href="#"><?php echo __('Verification'); ?></a>
                                            <ul class="sub-menu" style="width:auto!important">
                                                <!--<li><?php // echo $this->Html->link(__('Entire Data'), array('action' => 'allclusterheadVerifyReject'));       ?></li>-->
 
                                                <li><?php echo $this->Html->link(__('Personal and Pay Data'), array('action' => 'personalclusterhead')); ?></li>
                                                <li><?php echo $this->Html->link(__('Pay Details'), array('action' => 'payverifyreject')); ?></li>
                                                <li><?php echo $this->Html->link(__('PF/DCPS Details'), array('action' => 'pfverifyreject')); ?></li>
                                                 <li><?php echo $this->Html->link(__('GIS Details'), array('action' => 'gisverifyreject')); ?></li>
                                               <!--<li><?php // echo $this->Html->link('Verification of Additional Personal Data', array('action' => '#'));             ?></li>-->
                                                <li> <?php echo $this->Html->link(__('Caste and Certificate Details'), array('action' => 'caste_cluster')); ?> </li>
                                                <li> <?php echo $this->Html->link(__('Certificate Validation Details'), array('action' => 'certificate_cluster')); ?> </li>
                                                <li> <?php echo $this->Html->link(__('Initial Appointment Details'), array('action' => 'initverifyreject')); ?> </li>
                                                <li><?php echo $this->Html->link(__('Academic and Professional Details'), array('action' => 'acadprofverifyreject')); ?></li>
                                                <!--<li><?php // echo $this->Html->link(__('Subjects Taught Details'), array('action' => ''));     ?></li>-->
                                                <!--<li><?php // echo $this->Html->link('Service History', array('action' => ''));     ?></li>-->
                                                 <!--<li><?php // echo $this->Html->link('Verification of Other Personal Data', array('action' => ''));         ?></li>-->
                                                <li><?php echo $this->Html->link(__('Physical Handicapped Details'), array('action' => 'ph_cluster')); ?></li>
                                                <!--<li><?php // echo $this->Html->link(__('Family Details'), array('action' => ''));     ?></li>-->
<!--                                               <li><?php // echo $this->Html->link('Nomination Details', array('action' => ''));     ?></li>-->
                                                <li><?php echo $this->Html->link(__('Change Staff Type'), array('action' => 'cluster_change_stf')); ?></li>

                                            </ul>
                                        </li>
                                        
                                                <li><?php echo $this->Html->link(__('Return of Data to Head Master'), array('action' => 'clusterhead')); ?>
                                                    <ul>
                                                        <li><?php echo $this->Html->link(__('Additional Information for Samayojan'), array('action' => 'returndata_addinfo')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Caste Certificate Details'), array('action' => 'returndata_cst')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Caste Validation Details'), array('action' => 'returndata_cstvld')); ?></li>
                                             <li><?php echo $this->Html->link(__('Initial Appointment Details'), array('action' => 'returndata_init')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Academic/Professional qualifications Details'), array('action' => 'returndata_acadprof')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Subjects Taught Details'), array('action' => 'returndata_st')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Physically Handicapped Details'), array('action' => 'returndata_ph')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Family Details'), array('action' => 'underdevelopmentcluster')); ?></li>
                                                        <li><?php echo $this->Html->link(__('Nomination Details'), array('action' => 'underdevelopmentcluster')); ?></li>

                                                    </ul>   
                                                </li>
                                        
                                    <!--       <li><a href="#"><?php // echo __('Verification'); ?></a>
                                  <ul class="sub-menu" style="width:auto!important">
                                                <li><?php// echo $this->Html->link(__('Data Updated by HM'), array('action' => 'clusterheadVerifyReject')); ?></li>
                                                <li><?php //echo $this->Html->link(__('Entire Data'), array('action' => 'allclusterheadVerifyReject')); ?></li>

        <li><?php //echo $this->Html->link(__('Personal and Pay Data'), array('action' => 'personalclusterhead'));       ?></li>
      <li><?php // echo $this->Html->link('Verification of Additional Personal Data', array('action' => '#'));         ?></li>
        <li> <?php // echo $this->Html->link(__('Caste and Certificate Details'), array('action' => 'caste_cluster'));       ?>
        <li>
                                        <?php // echo $this->Html->link(__('Certificate Validation Details'), array('action' => 'certificate_cluster')); ?> 
        </li>
        <li>
                                        <?php // echo $this->Html->link(__('Initial Appointment Details'), array('action' => 'initverifyreject')); ?> 
        </li>
        
        </li>
         <li><?php // echo $this->Html->link(__('Academic and Professional Details'), array('action' => 'acadprofverifyreject'));       ?></li>
        <li><?php // echo $this->Html->link(__('Subjects Taught Details'), array('action' => 'subjectstaughtverifyreject'));       ?></li>
       <li><?php //echo $this->Html->link('Service History', array('action' => 'service_history_cluster'));       ?></li>
        <li><?php // echo $this->Html->link('Verification of Other Personal Data', array('action' => ''));         ?></li>
        <li><?php //echo $this->Html->link(__('Physical Handicapped Details'), array('action' => 'ph_cluster'));       ?></li>
        <li><?php //echo $this->Html->link(__('Family Details'), array('action' => 'familyVerifyReject'));       ?></li>
        <li><?php // echo $this->Html->link('Nomination Details', array('action' => 'nominationVerifyReject'));       ?></li>

    </ul>
</li>-->

                                        <li><a href="#"><?php echo __('Report/Queries'); ?></a>
                                            <ul class="sub-menu" style="width:auto!important">
                                                <li><?php echo $this->Html->link(__('Para Teacher List'), array('action' => 'para_teacher_list')); ?></li>

                                                <li><?php echo $this->Html->link(__('Staff List having Physical Disability as_ _ _?'), array('action' => 'underdevelopmentcluster')); ?></li> 
                                            </ul>
                                        </li>

                                        <li><a href="#"><?php echo __('Statistical Report'); ?></a>
                                            <ul class="sub-menu" style="width:auto!important">
                                                <li><?php echo $this->Html->link(__('Mapping Report'), array('action' => 'mapping_report')); ?></li>
                                                <li><?php echo $this->Html->link(__('Gender'), array('action' => 'reportsclustergender')); ?></li>
                                                <li><?php echo $this->Html->link(__('Physically Disabled'), array('action' => 'ph_report')); ?></li>
                                                <li><?php echo $this->Html->link(__('Caste Category Report'), array('action' => 'religion_report')); ?></li>
                                                <li><?php echo $this->Html->link(__('School-Wise List of Shikshan Sevaks'), array('action' => 'reportsshikshansevak')); ?></li>
                                                <li><?php echo $this->Html->link(__('School-Wise List of Teaching/Non-Teaching Staff Due for Snr Grade'), array('action' => 'reportsduesnrgrade')); ?></li>
                                                <li><?php echo $this->Html->link(__('School-Wise List of Teaching/Non-Teaching Staff Due for Sel Grade'), array('action' => 'reportsdueselgrade')); ?></li>
                                            </ul>
                                        </li>

                                        

                                        <li><?php echo $this->Html->link(__('Logout'), array("controller" => 'users', "action" => "logout")); ?></li>
                                    </ul>
                                </nav>

                            </div>

                            <div id="logsection_cluster">
                                <table width="100%" height="35px" >
                                    <tr>

                                        <td width="8%" class="name">
                                            <?php echo __('Login as : '); ?>
                                        </td>

                                        <td width="31%">

                                            <?php echo "  (" . $this->Session->read('user_id') . ") " . $this->Session->read('user_desc') . "  "; ?>

                                        </td>

                                        <td width="10%" class="name"> No of Schools <span>:</span></td>

                                        <td width="11%">
                                            <?php
                                            $schoolCountForCluster = $this->requestAction(array('controller' => 'Teachers', 'action' => 'FindSchoolTotalUnderCluster'));
                                            echo $schoolCountForCluster[0][0]['count'];
                                            ?>

                                        </td>


                                        <td width="22%" align="right" class="name" >Academic Year <span>:</span></td>

                                        <td width="7%" align="center">
                                            <?php
                                            if ($this->Session->read('acad_year_tchr'))
                                                echo $this->Session->read('acad_year_tchr');
                                            else
                                                echo "-";
                                            ?>
                                        </td>
                                    </tr>


                                </table>
                            </div>
                        </header>

                        <div id="content_cluster">
                            <?php echo $this->fetch('content'); ?>
                        </div>

                        <div id="footer">
                            <p><span style="float:left;">Copyright &copy; School Education and Sports Department</span>

                                <span style="float:right;">
                                    <?php echo __('Site Designed and Developed by'); ?> <a href="http://www.nic.in" target="_blank"><?php echo __('National Informatics Centre, Pune'); ?></a>
                                    <?php
                                    $server_ip = $this->Session->read('server_ip');
                                    if (isset($server_ip)) {
                                        echo "" . $server_ip;
                                    }
                                    ?>
                                </span>
                            </p>
                        </div>
                    </div>


                    <?php echo $this->Session->flash(); ?>
                </body>
                </html>









