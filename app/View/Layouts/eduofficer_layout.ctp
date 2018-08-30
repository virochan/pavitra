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
        <script type="text/javascript">
            window.webroot = '<?php echo $this->webroot; ?>';
        </script>
<!--        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script type="text/javascript" src="jquery-ui-1.10.4.custom.js"></script>-->




        <meta charset="utf-8">
            <?php echo $this->Html->charset(); ?>
            <!-- disable iPhone inital scale -->
            <meta name="viewport" content="width=700px; initial-scale=1.0">
                <title>School Education and Sports Department</title>
                <?php
                echo $this->Html->script('jquery-1.7.2');
                echo $this->Html->script('jquery.ui.datepicker');
                echo $this->Html->script('common');
                echo $this->Html->script('teaching_nonteaching_form');
                echo $this->Html->css('style_pavitra');
                echo $this->Html->css('style_menu_ch_beo_pavitra');
                echo $this->Html->css('bootstrap.min');
                echo $this->Html->script('bootstrap.min');
                echo $this->Html->script('jquery.form.min');
                echo $this->Html->script('https://www.google.com/jsapi');
                echo $this->Html->script('map_and_language');
                echo $this->Html->script('validations');
                echo $this->Html->css('jquery.ui.all');
                echo $this->Html->script('jquery.ui.core');
                echo $this->Html->script('jquery.ui.widget');
                echo $this->Html->script('calendar_common');
//                echo $this->Html->script('castevalidation');
                ?>

                </head>
                <body>
                <div class="container">    
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
                                        <li class="current-item"><?php echo $this->Html->link('Advertise', array('action' => '')); ?>
                                            <ul class="sub-menu" style="width:auto!important;">
                                                 <li> <?php echo $this->Html->link(__('Recruitment Processing'), array('action' => 'appln_list_eo')); ?></li>
                                                <li> <?php echo $this->Html->link(__('Approve Advertisement'), array('action' => 'approve_adv')); ?></li> 
                                            </ul>
                                        </li>
                                        <li class="current-item"><?php echo $this->Html->link('Roster Details', array('action' => '')); ?>
                                            <ul class="sub-menu" style="width:auto!important;">
                                                <li> <?php echo $this->Html->link(__('Verify Roster for Sanstha'), array('action' => 'pv_roster_verf_sans')); ?></li>
                                                <!--<li> <?php echo $this->Html->link(__('Unverify Roster for Sanstha'), array('action' => 'pv_roster_unverf_sans')); ?></li>--> 
                                            </ul>
                                        </li>
                                        <li class="current-item"><?php echo $this->Html->link('Vacancy Details', array('action' => '')); ?>
                                            <ul class="sub-menu" style="width:auto!important;">
                                                <li> <?php echo $this->Html->link(__('Verify Vacancy Position'), array('action' => 'verify_ex_vac_eo')); ?></li> 
                                            </ul>
                                        </li>
                                        <li class="current-item"><?php echo $this->Html->link('Recruitement Process', array('action' => '')); ?>
                                            <ul class="sub-menu" style="width:auto!important;">
                                                <li> <?php echo $this->Html->link(__('View Application'), array('action' => 'view_applications')); ?></li> 
                                            </ul>
                                        </li>
                                        <li><?php echo $this->Html->link(__('Reports'), array('action' => '')); ?>
                                            <ul class="sub-menu" style="width:auto!important;">
                                                <li><?php echo $this->Html->link(__('Vacancy Details'), array('action' => '')); ?>
                                                    <ul class="sub-menu" style="width:auto!important;"> 
                                                        <li> <?php echo $this->Html->link(__('For Particular Sanstha'), array('action' => 'rep_particular_sans_vaca')); ?></li> 
                                                        <li> <?php echo $this->Html->link(__('For All Sanstha '), array('action' => 'rep_all_sans_vaca')); ?></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>


                                        <li><?php echo $this->Html->link('Logout', array("controller" => 'Users', "action" => "logout")); ?></li>

                                    </ul>
                                </nav>
                            </div>


                            <div id="logsection_cluster">
                                <table border="0" class="tdhead2">    
                                    <tr>
                                        <td width="2%" style="padding-top:3px;color:rgb(194, 67, 21);font-weight:bold;">
                                            <img src="../img/login_role.png"  style="float:left;"/><?php echo __('Login as'); ?><span style="float:middle">&nbsp;:&nbsp;</span> 
                                        </td>
                                        <td width="22%">
                                            (<?php echo "" . $this->Session->read('user_id'); ?>)&nbsp;<?php echo "" . $this->Session->read('role_desc'); ?>&nbsp;&nbsp;<?php echo "" . $this->Session->read('dist_name'); ?>                      
                                            <!--                                                    <div style="text-align: right;float: right;padding-right: 10px;">For  : <?php
                if ($this->Session->read('minority_type') == '1') {
                    echo "Non-Minority Sanstha";
                } else if ($this->Session->read('minority_type') == '2') {
                    echo "Minority Sanstha";
                }
                ?></div>-->
                                        </td>

                                    </tr> 
                                </table>
                            </div>

                        </header>	
                        <!-- /#pagewrap -->

                        <div id="content">
                            <div id="report">

                                <!-- <div id="static">
                                     <nav class="menu">
                                         <ul class="clearfix">
                                             <li><a href="#"><img src="../img/data_entry.png" align="center" />Data Entry Status </a>
                                                 <ul class="sub-menu">      
                                                     <ul> 
                                                         <li>
                                <?php //echo $this->Html->link('Update Teachers Gender and DOB', array('action' => 'updatetchgendob'));        ?> 
                                                         </li>
                                                     </ul>
                                                 </ul>
                                             </li>
                                         </ul>
                                     </nav>
                                 </div>-->

                            </div>
                            <?php echo $this->fetch('content'); ?>
                        </div>

                        <footer id="footer">
                            <p>Copyright &copy; School Education and Sports Department.  
                                <span style="float: right;">   Site Designed and Developed by <a href="http://www.nic.in" target="_blank">National Inormatics Centre, Pune</a>
                                    <?php
                                    $server_ip = $this->Session->read('server_ip');
                                    if (isset($server_ip)) {
                                        echo "" . $server_ip;
                                    }
                                    ?>
                                </span>
                            </p>

                        </footer>
                    </div>
                    <!-- /#footer -->            
                    <?php echo $this->Session->flash(); ?>
                
                </div>
                </body>
                </html>









