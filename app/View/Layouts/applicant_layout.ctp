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


        <meta charset="utf-8">
            <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>-->

            <script>

                function disply_udise_record_update(id)
                {
                    // alert("hhhhiiiii");
                    $("#right_td_update_udise").hide();
                    $("#right_ajax_td_update_udise").show();
                    var id = id;
                    $.ajax({
                        url: "UdiseRecordEdit",
                        type: "POST",
                        data: {'id': id},
                        success: function(output) {
                            //alert(output);
                            $("#right_ajax_td_update_udise").html(output);
                        }
                    });
                }
            </script>
            <script type="text/javascript" src="jquery-ui-1.10.4.custom.js"></script>
            <script type="text/javascript">
                window.webroot = '<?php echo $this->webroot; ?>';
            </script>
            <?php echo $this->Html->charset(); ?>
            <!-- disable iPhone inital scale -->
            <meta name="viewport" content="width=700px; initial-scale=1.0"/>
            <title>School Education and Sports Department</title>
            <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css('bootstrap.min');
            echo $this->Html->css('style_pavitra');
            echo $this->fetch('meta');
            echo $this->fetch('script');
            echo $this->Html->script('jquery.min');
            echo $this->Html->css('style_menu_ch_beo_pavitra');
            echo $this->Html->script('bootstrap.min');
            echo $this->Html->script('common');
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
                    <div class="example">

                        <nav>
                            <ul class="nav">

                                <li><?php echo $this->Html->link(__('Applicant Details'), array('action' => '')); ?>
                                    <ul class="sub-menu" style="width:auto!important;">
                                        <li> <?php echo $this->Html->link(__('Personal Details'), array('action' => 'applicant_details')); ?></li> 
                                        <li> <?php echo $this->Html->link(__('TET Exam Details'), array('action' => '')); ?>
                                            <ul class="sub-menu" style="width:auto!important;">
                                                <li> <?php echo $this->Html->link(__('State TET'), array('action' => 'tetdetails')); ?></li> 
                                                <li> <?php echo $this->Html->link(__('Centrel TET'), array('action' => 'ctetdetails')); ?></li>
                                            </ul>
                                        </li>
                                        <li><?php echo $this->Html->link(__('Qualification Details'), array('action' => '')); ?>
                                            <ul class="sub-menu" style="width:auto!important;"> 
                                                <li> <?php echo $this->Html->link(__('Academic Qualification'), array('action' => 'applicant_acad_qual')); ?></li> 
                                                <li> <?php echo $this->Html->link(__('Professional Qualification'), array('action' => 'applicant_prof_qual')); ?></li>
                                            </ul>
                                        </li>
                                        <li> <?php echo $this->Html->link(__('View Entire Applicant Details'), array('action' => '')); ?></li> 
                                    </ul>
                                </li>
                                <li>
                                    <?php echo $this->Html->link(__('Self Certification'), array('action' => 'self_certifn_applicant_details')); ?>
                                </li>
                                <li><?php echo $this->Html->link(__('Application Form'), array('action' => 'apply_posn')); ?>
                                    <ul>
                                        <li><?php echo $this->Html->link(__('Apply For Position'), array('action' => 'apply_posn')); ?></li>
                                        <li><?php echo $this->Html->link(__('Arrange List'), array('action' => 'arrange_list')); ?></li>
                                    </ul>

                                </li>

                                <li class="current-item"> 
                                    <?php echo $this->Html->link(__('Print Order Details'), array('action' => '')); ?> 

                                </li>
                                <li class="current-item"> 
                                    <?php echo $this->Html->link(__('Utilities'), array('action' => '')); ?> 
                                    <ul class="sub-menu" style="width:auto!important;">
                                        <li><?php echo $this->Html->link(__('Change Password'), array('action' => '')); ?></li>
                                    </ul> 
                                </li>

                                <!--                                <li class="current-item"> 
                                <?php echo $this->Html->link(__('Applicant'), array('action' => '')); ?> 
                                                                    <ul class="sub-menu" style="width:auto!important;">
                                                                        <li><?php echo $this->Html->link(__('Academic Qualification'), array('action' => 'applicant_acad_qual')); ?></li>
                                                                        <li><?php echo $this->Html->link(__('Professional Qualification'), array('action' => 'applicant_prof_qual')); ?></li>
                                                                    </ul> 
                                                                </li>
                                                                
                                                                 <li class="current-item"> 
                                <?php echo $this->Html->link(__('Reports'), array('action' => '')); ?> 
                                                                    <ul class="sub-menu" style="width:auto!important;">
                                                                        <li> <?php echo $this->Html->link(__('Generate Advertisement'), array('action' => 'rep_generate_adv')); ?></li> 
                                                                        <li><?php echo $this->Html->link(__('Schoolwise Vacancy Details'), array('action' => 'rep_schwise_vaca')); ?></li>
                                                                    </ul> 
                                                                </li>-->


                                <li><?php echo $this->Html->link(__('Logout'), array("controller" => 'users', "action" => "logout")); ?></li>
                            </ul>  
                        </nav>
                    </div>

                    <div id="logsection_cluster">
                        <table border="0" class="tdhead2">    
                            <tr>
                                <td width="2%" style="padding-top:3px;color:rgb(194, 67, 21);font-weight:bold;">
                                    <img src="../img/login_role.png"  style="float:left;"/><?php echo __('Login as'); ?>&nbsp;<?php echo "" . $this->Session->read('role_desc'); ?><span style="float:middle">&nbsp;:&nbsp;</span> 
                                </td>
                                <td width="22%">
                                    (<?php echo "" . $this->Session->read('apln_id'); ?>)&nbsp;&nbsp;<?php echo "" . $this->Session->read('apln_name'); ?>                      

                                </td>

                            </tr> 
                        </table>
                    </div>
                </header>		
                <!-- /#pagewrap -->


                <div id="content">
                    <?php echo $this->fetch('content'); ?>
                </div>

                <div id="footer">
                    <p><span style="float: left;">Copyright &copy; School Education and Sports Department.  </span>
                        <span style="float: right;">   Site Designed and Developed by <a href="http://www.nic.in" target="_blank">National Inormatics Centre, Pune</a>
                            <?php
                            $server_ip = $this->Session->read('server_ip');
                            if (isset($server_ip)) {
                                echo "" . $server_ip;
                            }
                            ?>
                        </span>
                    </p>
                </div>
                <!-- /#footer -->            
                <?php echo $this->Session->flash(); ?>
            </div>
        </div>
    </body>
</html>









