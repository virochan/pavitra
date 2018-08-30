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
        <script type="text/javascript">
            window.webroot = '<?php echo $this->webroot; ?>';
        </script>
        <meta charset="utf-8"/>
        <?php echo $this->Html->charset(); ?>
        <!-- disable iPhone inital scale -->
        <meta name="viewport" content="width=700px; initial-scale=1.0" />
        <title>School Education and Sports Department</title>
        <?php
//                echo $this->Html->meta('icon');
//                echo $this->Html->css('style');
////                echo $this->Html->script('common');
//                echo $this->fetch('meta');
//                echo $this->fetch('script');
//                echo $this->fetch('meta');
//                echo $this->fetch('css');
//                echo $this->fetch('script');
//                echo $this->Html->script('jquery.min');
//                echo $this->Html->css('style_menu_ch_beo');
        echo $this->Html->script('jquery-1.7.2');
        echo $this->Html->script('jquery.ui.datepicker');
        echo $this->Html->script('common');
        echo $this->Html->script('teaching_nonteaching_form');
        echo $this->Html->css('styles');
        echo $this->Html->css('style');
        echo $this->Html->script('jquery.form.min');
        echo $this->Html->script('https://www.google.com/jsapi');
        echo $this->Html->script('map_and_language');
        echo $this->Html->script('validations');
        echo $this->Html->css('jquery.ui.all');
        echo $this->Html->script('jquery.ui.core');
        echo $this->Html->script('jquery.ui.widget');
        echo $this->Html->script('calendar_common');
//                echo $this->Html->script('castevalidation');
        echo $this->Html->css('style_menu_ch_beo');
        ?>

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
                            <li><a href="#">Data Entry</a>
                                <ul class="sub-menu" style="width:auto!important">
                                    <li>
                                        <li><?php echo $this->Html->link('New Recurtment - Teaching Staff', array('action' => 'newrecruitmenttechstaff')); ?></li>
                                        <li><?php echo $this->Html->link('New Recurtment - NonTeaching Staff', array('action' => 'newrecruitmentnontechstaff')); ?></li>
                                    </li>

                                </ul>
                            </li>

                            <li><?php echo $this->Html->link(__('Surplus Staff'), array('action' => 'beo')); ?>
                                <ul class="sub-menu" style="width:auto!important;">
                                    <li> <?php echo $this->Html->link(__('Declaration of Surplus Staff'), array('action' => '#')); ?>
                                        <ul>
                                            <li><?php echo $this->Html->link(__('Teaching'), array('action' => 'surplusteacherdeclationbeo')); ?></li> 
                                            <!--<li> <?php // echo $this->Html->link('Non Teaching', array('action' => 'surplusnonteacherdeclation'));    ?></li>-->
                                        </ul>
                                    </li> 
                                    <li> <?php echo $this->Html->link(__('Print Surplus Staff'), array('action' => 'beo')); ?>
                                        <ul>
                                            <li><?php echo $this->Html->link(__('Teaching'), array('action' => 'surplusteacherreportbeo')); ?></li> 
                                            <!--<li> <?php // echo $this->Html->link('Non Teaching', array('action' => 'surplusnonteacherdeclation'));    ?></li>-->
                                        </ul>
                                    </li> 
                                    <li> <?php echo $this->Html->link(__('Shift Excess Teacher'), array('action' => 'beo')); ?>
                                        <ul>
                                            <li><?php echo $this->Html->link(__('Teaching'), array('action' => 'shiftexcessteachereo')); ?></li> 
                                            <!--<li> <?php // echo $this->Html->link('Non Teaching', array('action' => 'surplusnonteacherdeclation'));    ?></li>-->
                                        </ul>
                                    </li> 
                                </ul>
                            </li>

                            <li class="current-item"><a href="#">Data Entry Status </a>
                                <ul class="sub-menu" style="width:auto!important">      
                                    <li><?php echo $this->Html->link('List of Clusters who have not verified Caste Category Details', array('action' => 'underdevelopmentbeo')); ?></li>
                                    <li><?php echo $this->Html->link('List of Clusters who have not verified PH Details', array('action' => 'underdevelopmentbeo')); ?></li>
                                    <li><?php echo $this->Html->link('List of Clusters who have not verified Academic Qual. Details', array('action' => 'underdevelopmentbeo')); ?></li>
                                    <li><?php echo $this->Html->link('List of Clusters who have not verified Professional Qual. Details', array('action' => 'underdevelopmentbeo')); ?></li>
                                </ul>
                            </li>
                            <li><?php echo $this->Html->link(__('Return of Data to Head Master'), array('action' => 'clusterhead')); ?>
                                <ul>
                                     <!--<li><?php // echo $this->Html->link(__('Pay, PF and GIS Details'), array('action' => 'returnpaypfgisdata'));     ?></li>
				      <li><?php echo $this->Html->link(__('Pay Details'), array('action' => 'returndata_pay')); ?></li>
                                    <li><?php echo $this->Html->link(__('PF/DCPS Details'), array('action' => 'returndata_pf')); ?></li>
                                     <li><?php echo $this->Html->link(__('GIS Details'), array('action' => 'returndata_gis')); ?></li>-->
                                    <li><?php echo $this->Html->link(__('Caste Certificate Details'), array('action' => 'returndata_cst')); ?></li>
                                    <li><?php echo $this->Html->link(__('Caste Validation Details'), array('action' => 'returndata_cstvld')); ?></li>
                                    <li><?php echo $this->Html->link(__('Initial Appointment Details'), array('action' => 'returndata_init')); ?></li>
                                    <li><?php echo $this->Html->link(__('Academic/Professional qualifications Details'), array('action' => 'returndata_acadprof')); ?></li>
                                    <!--<li><?php // echo $this->Html->link(__('Subjects Taught Details'), array('action' => 'returndata_st'));     ?></li>-->
                                    <li><?php echo $this->Html->link(__('Physically Handicapped Details'), array('action' => 'returndata_ph')); ?></li>
                                    <!--<li><?php // echo $this->Html->link(__('Family Details'), array('action' => 'underdevelopmentcluster'));     ?></li>-->
                                    <!--<li><?php // echo $this->Html->link(__('Nomination Details'), array('action' => 'underdevelopmentcluster'));     ?></li>-->

                                </ul>   
                            </li>
                            <li><a href="#">Verification/Discrepancy</a>
                                <ul class="sub-menu" style="width:auto!important">
                                    <li>
                                        <?php echo $this->Html->link('Correction of Date of Birth for discrepancy', array('action' => 'updatetchgendob')); ?> 
                                    </li>
                                    <li>
                                        <?php echo $this->Html->link('Change in Date of Birth for Verified Staff Details', array('action' => 'correctdob_beo')); ?> 
                                    </li>
                                    <li>
                                        <?php echo $this->Html->link('Verification of Detached Teacher', array('action' => 'verify_detach_beo')); ?>
                                    </li>
                                    <li>
                                        <?php echo $this->Html->link('Verification of Attached Teacher', array('action' => 'verify_attach_beo')); ?> 
                                    </li>

                                </ul>
                            </li>
                            

                            <li><a href="#">Report/Queries</a>
                                <ul class="sub-menu" style="width:auto!important">
                                    <li><?php echo $this->Html->link(__('Para Teacher List'), array('action' => 'para_teacher_list_beo')); ?></li>
                                    <li><?php echo $this->Html->link('Staff List having Physical Disability as_ _ _?', array('action' => 'underdevelopmentbeo')); ?></li> 
                                </ul>
                            </li>

                            <li><a href="#">Statistical Report</a>
                                <ul class="sub-menu" style="width:auto!important">
                                    <li> <?php echo $this->Html->link('Para Teacher List', array('action' => 'para_teacher_list_beo')); ?>    </li>
                                    <li> <?php echo $this->Html->link('Mapping', array('action' => 'mappingBeoReport')); ?>    </li>
                                    <li>   <?php echo $this->Html->link('Gender', array('action' => 'reportsbeogender')); ?>    </li>
                                    <li><?php echo $this->Html->link('Physically Disabled', array('action' => 'underdevelopmentbeo')); ?></li> 
                                    <li><?php echo $this->Html->link('Caste Category', array('action' => 'reportsbeocaste')); ?></li> 
                                    <li><?php echo $this->Html->link('Shikshan Sevak', array('action' => 'reportsbeoshikshansevak')); ?></li> 
                                    <li><?php echo $this->Html->link('Senior Grade Not Received', array('action' => 'reportsbeosnrgrade')); ?></li>
                                    <li><?php echo $this->Html->link('Selection Grade Not Received', array('action' => 'reportsbeoselgrade')); ?></li>
                                </ul>
                            </li>
 


                            <li> 
                                <?php echo $this->Html->link('Logout', array("controller" => 'users', "action" => "logout")); ?>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div id="logsection_cluster">
                    <table width="100%" height="50px" >
                        <tr>

                            <td width="15%" class="name">  <?php echo __('Login as BEO: '); ?>   </td> 
                            <td width="61%"> 

                                <?php
                                if ($this->Session->read('user_id'))
                                    $user_id = $this->Session->read('user_id');
                                else
                                    $user_id = "-";

                                if ($this->Session->read('user_desc'))
                                    $user_desc = $this->Session->read('user_desc');
                                else
                                    $user_desc = "-";

                                if ($this->Session->read('block_name'))
                                    $block_name = $this->Session->read('block_name');
                                else
                                    $block_name = "-";
                                ?>

                                <?php echo " " . " ( " . $user_id . " ) " . $user_desc . "  " . $block_name;
                                ?>       </td> 
                            <td width="16%" align="right" class="name" >Academic Year <span>:</span></td> 
                            <td width="8%">
                                <?php
                                if ($this->Session->read('acad_year_tchr'))
                                    echo $this->Session->read('acad_year_tchr');
                                else
                                    echo "-";
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td class="name"> No. of Schools :</td>
                            <td>
                                <?php
                                $schoolCountForBeo = $this->requestAction(array('controller' => 'Teachers', 'action' => 'FindSchoolTotalUnderBeo'));
                                echo $schoolCountForBeo[0][0]['count'];
                                ?>

                            </td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table>
                </div>
            </header>
            <!-- /#pagewrap -->


            <div id="content">

                <div id="report">
                    <?php echo $this->fetch('content'); ?>
                </div>
            </div>



            <div id="footer">
                <p>Copyright &copy; School Education and Sports Department.  
                    <span style="float: right;">   Site Designed and Developed by <a href="http://www.nic.in" target="_blank">National Inormatics Centre, Pune</a>
                        <?php
                        $server_ip = $this->Session->read('server_ip');
                        if (isset($server_ip)) {
                            echo "" . $server_ip;
                        }
                        ?></span>
                </p>

            </div>


        </div>

        <?php echo $this->Session->flash(); ?>
    </body>
</html>









