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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <?php echo $this->Html->charset(); ?>
        <!--<meta name="viewport" content="width=700px; initial-scale=1.0">-->
        <title>School Education and Sports Department</title>
        <?php
        echo $this->Html->script('jquery-1.7.2');
        echo $this->Html->script('jquery.ui.datepicker');
        echo $this->Html->script('common');
        echo $this->Html->script('teaching_nonteaching_form');
        echo $this->Html->css('styles');
        echo $this->Html->css('style');
        echo $this->Html->script('jquery.form.min');
        echo $this->Html->script('map_and_language');
        echo $this->Html->script('validations');
        echo $this->Html->css('jquery.ui.all');
        echo $this->Html->script('jquery.ui.core');
        echo $this->Html->script('jquery.ui.widget');
        echo $this->Html->script('calendar_common');
        echo $this->Html->script('castevalidation');
        echo $this->Html->css('style_menu_ch_beo');
        ?>

        <script>
            window.webroot = '<?php echo $this->webroot; ?>';
            (function($) {
                $(document).ready(function() {
                    $("#overlay_srch").hide();

                    $('#cssmenu > ul > li > a').click(function() {
                        $('#cssmenu li').removeClass('active');
                        $(this).closest('li').addClass('active');
                        var checkElement = $(this).next();
                        if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                            $(this).closest('li').removeClass('active');
                            checkElement.slideUp('normal');
                        }
                        if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                            $('#cssmenu ul ul:visible').slideUp('normal');
                            checkElement.slideDown('normal');
                        }
                        if ($(this).closest('li').find('ul').children().length == 0) {
                            return true;
                        } else {
                            return false;
                        }
                    });


                    $('#cssmenu1 > ul > li > a').click(function() {
                        $('#cssmenu1 li').removeClass('active');
                        $(this).closest('li').addClass('active');
                        var checkElement = $(this).next();
                        if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                            $(this).closest('li').removeClass('active');
                            checkElement.slideUp('normal');
                        }
                        if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                            $('#cssmenu1 ul ul:visible').slideUp('normal');
                            checkElement.slideDown('normal');
                        }
                        if ($(this).closest('li').find('ul').children().length == 0) {
                            return true;
                        } else {
                            return false;
                        }
                    });



                    $("#search_b").click(function() {
                        var tchr_id = $("#tchr_id_hidden").val();
                        jQuery.post('popupformhm', {popupid: tchr_id}, function(data) {
                            $('#popupform').html(data);
                            $('#overlay_srch').show();
                            $('#exit_search').click(function() {
                                $("#overlay_srch").hide();
                            });
                        });
                    });
                });
            })(jQuery);
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
                <div class="example">

                    <nav>
                        <ul class="nav">
                            <li class="current-item"> 

                                <?php echo $this->Html->link(__('Teaching Staff'), array('action' => 'teaching')); ?>
                                <ul class="sub-menu" style="width:auto!important;">
                                    <li> <?php echo $this->Html->link(__('Map with Shalarth and Udise'), array('action' => 'mapShalarth')); ?></li> 
                                    <li> <?php echo $this->Html->link(__('Map only Shalarth'), array('action' => 'mapOnlyShalarthTchr')); ?></li> 
                                    <li> <?php echo $this->Html->link(__('Map From Other School'), array('action' => 'mapOtherSchool')); ?></li> 
                                    <li> <?php echo $this->Html->link(__('Data Updated by Headmaster After Mapping'), array('action' => 'forwardch')); ?> </li>
                                    <li> <?php echo $this->Html->link(__('Attach and Detach Teacher'), array('action' => '')); ?>
                                        <ul>
                                            <li><?php echo $this->Html->link(__('Detach Teacher'), array('action' => 'detach_teacher')); ?> </li>
                                            <li><?php echo $this->Html->link(__('Attach Teacher'), array('action' => 'attach_teacher')); ?> </li>
                                        </ul>
                                    </li>
                                    <li> <?php echo $this->Html->link(__('Discrepancy Report'), array('action' => 'disReport')); ?> </li> 
                                    <li> <?php echo $this->Html->link(__('Teaching Details'), array('action' => 'teaching')); ?> </li> 
                                    <?php
                                    if (($this->Session->read('management_details'))) {
                                        $management_details = $this->Session->read('management_details');

                                        if ($management_details == 20 || $management_details == 27) {
                                            ?>
                                            <li><?php echo $this->Html->link('New Recurtment - Teaching Staff', array('action' => 'newrecruitmenttechstaff')); ?></li>
                                            <li><?php echo $this->Html->link('New Recurtment - NonTeaching Staff', array('action' => 'newrecruitmentnontechstaff')); ?></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>             
                            </li>    

                            <li><?php echo $this->Html->link(__('Non Teaching Staff'), array('action' => 'nonteaching_staff')); ?>
                                <ul class="sub-menu" style="width:auto!important;">
                                    <li> <?php echo $this->Html->link(__('Map with Shalarth'), array('action' => 'map_shalarth_non')); ?></li> 
                                    <li> <?php echo $this->Html->link(__('Map only Shalarth'), array('action' => 'mapOnlyShalarthNonTchr')); ?></li> 
                                    <li> <?php echo $this->Html->link(__('Map From Other School'), array('action' => 'map_other_school_non')); ?></li> 
                                    <li> <?php echo $this->Html->link(__('Data Updated by Headmaster After Mapping'), array('action' => 'nonteaching')); ?> </li>
                                    <li> <?php echo $this->Html->link(__('Non Teaching Details'), array('action' => 'nonteaching_staff')); ?> </li> 
                                </ul>
                            </li>

                            <li><?php echo $this->Html->link(__('Forward/Return to CH/URC'), array('action' => '')); ?>
                                <ul class="sub-menu" style="width:auto !important;">
                                    <li> <?php // echo $this->Html->link(__('Forward Entire Data'), array('action' => 'forwardalldata'));          ?></li>
                                    <!--<li>
                                    <?php echo $this->Html->link(__('Forward Data For DOB Correction'), array('action' => 'dobcorrection')); ?></li>-->
                                    <li> <?php echo $this->Html->link(__('Forward Data (Menu-wise)'), array('action' => 'hm')); ?>
                                        <ul>
                                            <li><?php echo $this->Html->link(__('Personal Details'), array('action' => 'forwardpersonal')); ?></li>  <!-- and Pay-->
                                            <li><?php echo $this->Html->link(__('Pay Details'), array('action' => 'fwdpaymntdtls')); ?></li> 
                                            <li><?php echo $this->Html->link(__('PF/DCPS Details'), array('action' => 'fwdpfdtls')); ?></li> 
                                            <li><?php echo $this->Html->link(__('GIS Details'), array('action' => 'fwdgisdtls')); ?></li> 
                                            <li> <?php echo $this->Html->link(__('Caste Certificate Details'), array('action' => 'forwardcastdetails')); ?></li> 
                                            <li> <?php echo $this->Html->link(__('Caste Certificate Validation Details'), array('action' => 'frwrdcastcertificate')); ?></li>
                                            <li> <?php echo $this->Html->link(__('Initial Appointment Details'), array('action' => 'fwdinitialapt')); ?></li>	
                                            <li> <?php echo $this->Html->link(__('Academic/Professional Qualification Details'), array('action' => 'fwdacadprof')); ?></li>
                                            <li> <?php echo $this->Html->link(__('Physical Disability Details'), array('action' => 'forwardph')); ?></li>
                                            <!--<li> <?php echo $this->Html->link(__('Forward Detach data'), array('action' => 'forward_detach_details')); ?> </li>-->

                                            <li> <?php echo $this->Html->link(__('Change Date of Joining Current Management'), array('action' => 'mgmtdatecorrection')); ?> </li>
                                            <li> <?php echo $this->Html->link(__('Change Date of Joining Current District'), array('action' => 'distdatecorrection')); ?> </li>
                                            <li> <?php echo $this->Html->link(__('Change Staff Type'), array('action' => 'change_staff_type')); ?> </li>
                                            <li> <?php echo $this->Html->link(__('Forward superannuation/Other than superannuation data to Cluster'), array('action' => 'forward_superannuation')); ?> </li>
                                            <li> <?php echo $this->Html->link(__('Forward Detach data'), array('action' => 'forward_detach_details')); ?> </li>
                                            <li> <?php echo $this->Html->link(__('Forward Attach data'), array('action' => 'forward_attach_details')); ?> </li>
                                        </ul>

                                    </li>


                                    <li> <?php echo $this->Html->link(__('Change Staff Type'), array('action' => 'change_staff_type')); ?> </li>   


                                    <li><?php echo $this->Html->link('Return Data (Menu-wise)', array('action' => 'hm')); ?>
                                        <ul>
                                            <!--<li> <?php // echo $this->Html->link(__('Personal Details'), array('action' => 'returnpaypfhm'));       ?></li>-->
                                            <li> <?php echo $this->Html->link(__('Pay Details'), array('action' => 'rqstrtnpay')); ?></li>
                                            <li> <?php echo $this->Html->link(__('PF/DCPS Details'), array('action' => 'rqstrtnpf')); ?></li>
                                            <li> <?php echo $this->Html->link(__('GIS Details'), array('action' => 'rqstrtngis')); ?></li>
                                            <li> <?php echo $this->Html->link(__('Caste Certificate Details'), array('action' => 'rqstrtncaste')); ?></li>
                                            <li> <?php echo $this->Html->link(__('Caste Certificate Validation Details'), array('action' => 'rqstrtncastevld')); ?></li>
                                            <li> <?php echo $this->Html->link(__('Initial Appointment Details'), array('action' => 'rqstrtninit')); ?></li>
                                            <li> <?php echo $this->Html->link(__('Academic/Professional Qualification Details'), array('action' => 'rqstrtnacadprof')); ?></li>
                                            <li> <?php echo $this->Html->link(__('Subjects Taught Details'), array('action' => 'rqstrtnst')); ?></li>
                                            <li> <?php echo $this->Html->link(__('Physical Disability Details'), array('action' => 'rqstrtnph')); ?></li>
                                        </ul>   
                                    </li>
                                </ul>
                            </li> 

                            <li><?php echo $this->Html->link(__('Report/Query'), array('action' => '')); ?>
                                <ul class="sub-menu" style="width:auto !important;">
                                    <li> <?php echo $this->Html->link(__('Mapping'), array('action' => 'mappingHmReport')); ?></li>
                                    <li> <?php echo $this->Html->link(__('Gender'), array('action' => 'genderhm')); ?></li>
                                    <li> <?php echo $this->Html->link(__('Caste Report'), array('action' => 'castehm')); ?></li>

                                    <li> <?php echo $this->Html->link(__('List of Shikshan Sevaks'), array('action' => 'listshikshansevak')); ?></li>
                                    <li> <?php echo $this->Html->link(__('Due for Senior Grade Scale'), array('action' => 'duesnrgrade')); ?></li>
                                    <li> <?php echo $this->Html->link(__('Due for Selection Grade Scale'), array('action' => 'dueselgrade')); ?></li>
                                </ul>

                            </li>


                            <?php
                            if (($this->Session->read('management_details'))) {
                                $management_details = $this->Session->read('management_details');

                                if ($management_details == 16 || $management_details == 17 || $management_details == 18 || $management_details == 20) {
                                    ?>
                                    <li><?php echo $this->Html->link(__('Transfer/Samayojan'), array('action' => '')); ?>
                                        <ul class="sub-menu" style="width:auto !important;">
                                            <li> <?php echo $this->Html->link(__('Tally with SM'), array('action' => 'hm_tally_sm')); ?></li>
                                            <li> <?php echo $this->Html->link(__('Comparision with SM'), array('action' => 'hm_surplus_declaration')); ?></li>
                                            <li> <?php echo $this->Html->link(__('Forward Accepted Data'), array('action' => 'forward_surplus_hm')); ?></li>
                                        </ul>
                                    </li>    
                                    <?php
                                }
                            }
                            ?>



                            <li><?php echo $this->Html->link(__('Logout'), array("controller" => 'users', "action" => "logout")); ?></li>
                        </ul>  
                    </nav>
                </div>
            </header>	


            <div id="content">
                <table id="logindetailtbl" width="100%">
                    <tr>
                        <td>
                            <table  border="0" class="tdhead" style="border-collapse:collapse;width:100%;">
                                <tr style="height:16px;padding-top:5px;">
                                    <td width="10%" style="padding-left:2.5%;color:rgb(194, 67, 21);font-weight: bold;">
                                        <?php echo __('School'); ?>  <span style="float:right">&nbsp;:&nbsp;</span> 
                                    </td>
                                    <td>
                                        <?php echo "" . $FindedSchoolName[0]['FindSchoolName']['schname']; ?> 
                                        (  <?php echo __('Std.'); ?> <span style="float: right;"> </span>
                                        <?php
                                        $lowclass = '';
                                        $highclass = '';

                                        if (isset($schoolStd[0][0]['lowclass'])) {
                                            $lowclass = $schoolStd[0][0]['lowclass'];
                                        }
                                        if (isset($schoolStd[0][0]['highclass'])) {
                                            $highclass = $schoolStd[0][0]['highclass'];
                                        }

                                        function addOrdinalNumberSuffix($num) {
                                            if (!in_array(($num % 100), array(11, 12, 13))) {
                                                switch ($num % 10) {
                                                    // Handle 1st, 2nd, 3rd
                                                    case 1: return $num . 'st';
                                                    case 2: return $num . 'nd';
                                                    case 3: return $num . 'rd';
                                                }
                                            }
                                            return $num . 'th';
                                        }

                                        echo "" . addOrdinalNumberSuffix($lowclass) . " - " . addOrdinalNumberSuffix($highclass) . " )";
                                        ?>
                                        (  <?php echo __('Mgmt.'); ?> <span>&nbsp;:</span> 
                                        <?php
                                        echo "" . $schoolStd[0][0]['schmgtdet_desc'] . " )";
                                        ?>
                                    </td>

                                    <td width="13%" style="color:rgb(194, 67, 21);font-weight: bold;">
                                        <?php echo __('Academic Year'); ?> <span>&nbsp;:&nbsp;</span> 
                                    </td>
                                    <td>
                                        <?php
                                        if ($this->Session->read('acad_year_tchr'))
                                            echo $this->Session->read('acad_year_tchr');
                                        else
                                            echo "-";
                                        ?>
                                    </td>
                                </tr>     
                            </table>

                            <table border="0" class="tdhead2">    
                                <tr>
                                    <td width="10%" style="padding-top:3px;color:rgb(194, 67, 21);font-weight:bold;">
                                        <img src="../img/login_role.png"  style="float:left;"/><?php echo __('Login as'); ?><span style="float:right">&nbsp;:&nbsp;</span> 
                                    </td>
                                    <td width="22%">
                                        (<?php echo "" . $this->Session->read('user_id'); ?>)&nbsp;<?php echo "" . $this->Session->read('role_desc'); ?>                      
                                    </td>
                                    <td width="12%" colspan="0" style="text-align:right;color:rgb(194, 67, 21);font-weight:bold;">
                                        <img src="../img/total_staff.png"  style="float:left;"/> 
                                        <?php echo __('Total Staff'); ?> 
                                        <span style="float:right">&nbsp;:&nbsp;</span> 
                                    </td>
                                    <td  >
                                        <?php echo "" . ($tchr_sum + $non_tchr_sum); ?>                      
                                    </td>  


                                    <td width="12%" > 
                                        <div class="udata">
                                            <div class="uinner"></div>
                                            <?php echo __('Udise Data'); ?>
                                        </div>
                                    </td>

                                    <td width="12%">
                                        <div class="sdata">
                                            <div class="sinner"></div>
                                            <?php echo __('Shalarth Data'); ?>
                                        </div> 
                                    </td>

                                </tr> 
                            </table>
                        </td>
                    </tr>
                </table>

                <table border="0" style="border-collapse:collapse;width:100%;margin:1px 0px 5px 0px;;height:40px;box-shadow: 0px 2px 2px rgba(0,0,0,0.2);">
                    <tr style="background-color:#DCFAFF;margin-bottom: 10px;">

                        <td width="26%"> 
                            <!--                            <div style="float:left;">    
                                                            <input class="new_recuirtment"  id="new_recruitment_tch" type="button" value="New Recruitment" />
                                                        </div>-->

                            <div style="float:left;">    
                                <input class="Status"  id="search_b" type="button" value="Status" />

                            </div>
                        </td>

                        <td width="47%">

                            <div style="float:left">                              
                                <?php
                                echo $this->Form->create(null, array('url' => array('controller' => 'Teachers', 'action' => 'sessionTeacherId')));

                                if (@$SelecteTeacherscd1) {
                                    echo $this->Form->input('SelecteTeacherscd1', array('options' => $SelecteTeacherscd1,
                                        'label' => 'Select Staff  :  ', 'empty' => '-------------------Select Staff-----------------------',
                                        'id' => 'tchr_id', 'style' => 'margin-left:0.5%;width:68% !important;'));
                                } else {
                                    echo $this->Form->input('empty', array('options' => '', 'label' => 'Select Staff  :  ',
                                        'empty' => '---------------------------Select Staff---------------------------',
                                        'id' => 'tchr_id', 'style' => 'margin-left:0px;width:68% !important;'));
                                }

                                echo $this->Form->input('tchr_id_hidden', array('id' => 'tchr_id_hidden', 'type' => 'hidden', 'readonly' => 'readonly'));
                                echo $this->Form->input('tchr_type_hidden', array('id' => 'tchr_type_hidden', 'type' => 'hidden', 'readonly' => 'readonly', 'value' => $tchr_type));
                                echo $this->Form->input('tchr_recruitment_type_hidden', array('id' => 'tchr_recruitment_type_hidden', 'type' => 'hidden', 'readonly' => 'readonly'));
                                echo $this->Form->input('tchr_udise_apt_type', array('id' => 'tchr_udise_apt_type', 'type' => 'hidden', 'readonly' => 'readonly'));
                                ?>
                            </div>
                        </td>

                        <td width="27%">
                            <div style="float:right;width:100%">    
                                <input class="button-success pure-button"  id="exit_tch" type="button" value="Exit" style="float:right;"/>
                                <input class="button-success pure-button"  id="cancel_tchr_staff" type="button" value="Cancel" style="float:right;"/>   
                                <?php
                                echo $this->Form->submit('Submit', array('class' => 'button-success pure-button', 'id' => 'tchr_staff', 'type' => 'button', 'value' => 'Submit',
                                    'style' => 'float:right'));
                                ?>
                            </div>
                        </td>
                    </tr>
                </table>

                <table style="border-collapse:collapse;width:100%;height:470px;">
                    <tr>
                        <td valign="top" width="20%" style="background-color:#D1F1F5;">
                            <table style="width:100%;height:100%" id="leftmenu">
                                <tr>
                                    <td valign="top">
                                        <div style="height:500px;overflow:hidden">

                                            <div id="top">
                                                <div id='cssmenu'>
                                                    <ul>

                                                        <li class='has-sub'>
                                                            <a href=''><span><?php echo __('Personal Details'); ?></span></a>
                                                            <ul>
                                                                <li><a id="personalDtl1"> <span><?php echo __('Basic and Current Posting'); ?></span></a></li>
                                                              <!--  <li><a id="payDtl"><span><?php echo __('Pay, PF/DCPS and GIS'); ?></span></a></li>    payDtl -->
                                                                <li><a id="paymentdetails"><span><?php echo __('Pay Details'); ?></span></a></li>
                                                                <li><a id="pfdcpsdetails"><span><?php echo __('PF/DCPS Details'); ?></span></a></li>
                                                                <li><a id="gisdetails"><span><?php echo __('GIS Details'); ?></span></a></li>
                                                            </ul>
                                                        </li>


                                                        <!--<li class='single'><a id='addtnal_info'><span><?php // echo __('Addnl. Info. for Samayojan');    ?></span></a></li>-->

                                                        <li class='single'><a id='religion'><span><?php echo __('Caste and Certification'); ?></span></a></li>

                                                        <li class='single'><a id="initApptDtl"><span><?php echo __('Initial Appointment Details'); ?></span></a>

                                                            <li class='single'><a id="newInitialAptDtl"><span><?php echo __('Initial Appointment Details NEW'); ?></span></a>
                                                                <!--initApptDtl-->
                                                            </li>



                                                        <!--<li class='single'><a id='subtaught'><span><?php // echo __('Subjects Taught');    ?></span></a></li>-->

                                                   <!-- <li class='last'><a id='serviceHistory' style="cursor:pointer"><span><?php echo __('Service History'); ?></span></a>
                                                    </li>-->

                                                            <li class='last'><a id='phdtls' style="cursor:pointer"><span><?php echo __('Physically Handicap Details'); ?></span></a>
                                                            </li>

                                                   <!-- <li class='has-sub'><a href='#'><span><?php echo __('Training Details'); ?></span></a>
                                                        <ul>
                                                            <li><a id='training'><span><?php echo __('Training Attended Details'); ?></span></a></li>
                                                            <li><a id='udise_training'><span><?php echo __('Udise - Training Details'); ?></span></a></li>
                                                        </ul>
                                                    </li>
                                                            -->

                                                            <li class='has-sub'><a href=''><span><?php echo __('Udise Details'); ?></span></a>
                                                                <ul>
                                                                    <li><a id="udqulsndtl"><span><?php echo __('Udise - Qualification Details'); ?></span></a></li>
                                                                    <li><a id="udisetchngdtl"><span><?php echo __('Udise - Teaching Details'); ?></span></a></li>
                                                                    <li><a id='udise_training'><span><?php echo __('Udise - Training Details'); ?></span></a></li>
                                                                </ul>
                                                            </li>

                                                            <li class='has-sub'><a href=''><span><?php echo __('Qualification Details'); ?></span></a>
                                                                <ul>
                                                                    <li><a id="acdmicdtls"><span><?php echo __('Academic Qualification'); ?></span></a></li>
                                                                    <li><a id="profnaldtls"><span><?php echo __('Professional Qualification'); ?></span></a></li>
                                                                  <!-- <li><a id="udqulsndtl"><span><?php echo __('Udise - Qualification Details'); ?></span></a></li>-->
                                                                </ul>
                                                            </li>


<!--                                                        <li class='has-sub'><a href='#'><span>Address</span></a>
                                                            <ul>
                                                                <li><a id='presentAddr'><span>Present / Perm. Address</span></a></li>
                                                                <li><a id='homeTown'><span>Home Town</span></a></li>
                                                                <li><a id='nativeAddr'><span>Native Address</span></a></li>
                                                            </ul>
                                                        </li>-->

<!--                                                        <li class='has-sub'><a href=''><span>Other</span></a>
                                                            <ul>
                                                                <li><a id="paperSetter" style="cursor:pointer;"><span>Paper Setter</span></a></li>
                                                                <li><a id="moderator" style="cursor:pointer;"><span>Moderator</span></a></li>
                                                            </ul>
                                                        </li>-->
                                                    </ul>
                                                </div>
                                            </div>
                                            <div id="bottom">
                                                <div id='cssmenu1'>
                                                    <ul> 


                                                        <li class='single'><a id='othrprsnldtl'><span><?php echo __('Other Personal Details'); ?></span></a></li> 

                                                        <li class='single'><a id='serviceHistory_new' style="cursor:pointer"><span><?php echo __('Service History'); ?></span></a></li>

                                                        <li class='single'><a id='training'><span><?php echo __('Training Attended Details'); ?></span></a>  </li>




                                                        <li class='has-sub'><a href='#'><span><?php echo __('Family'); ?></span></a>
                                                            <ul>
                                                                <li><a id="family"><span><?php echo __('Family Details'); ?></span></a></li>

                                                                <li><a id="nominationdtl"><span><?php echo __('Nomination Details'); ?></span></a></li>

                                                            </ul>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td valign="top" width="80%" style="background-color:rgb(239, 253, 255);">
                            <table style="width:100%;height:100%">
                                <tr>
                                    <td  valign="top">

                                        <div class="maincontent" id="maincontent">

                                            <div id="overlay_personal" style="display:none;">
                                                <!--<div class="overlay-loader">-->
                                                <img style="width: 150px; height: 150px; margin: 15px 0px 0px 350px;" src="../images/busy.gif" id="loader_img">
                                                    <!--</div>-->
                                            </div>

                                            <div id="subcontent" class="">

                                                <!-- SUB MAINDIV-->
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <div id='popupform'></div>
            </div>
            <div id="footer">
                <p><span style="float: left;">Copyright &copy; School Education and Sports Department.  </span>
                    <span style="float: right;">   Site Designed and Developed by <a href="http://www.nic.in" target="_blank">National Informatics Center, Pune</a>

                        <?php
                        $server_ip = $this->Session->read('server_ip');

                        if (isset($server_ip)) {
                            echo "" . $server_ip;
                        }
                        ?>
                    </span>
                </p>
            </div>

            <?php echo $this->Form->end(); ?>

        </div>
    </body>


    <script type="text/javascript" src="//www.google.com/jsapi">
    </script>
    <script type="text/javascript">

        // Load the Google Transliterate API
        google.load("elements", "1", {
            packages: "transliteration"
        });

    </script>