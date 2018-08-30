<?php
//echo "---------" . pr($qry);exit;
echo $this->Html->script('jquery-1.7.2');
echo $this->Html->script('jquery.ui.datepicker');
echo $this->Html->script('common');
echo $this->Html->script('teaching_nonteaching_form');
//echo $this->Html->css('styles');
echo $this->Html->css('style_pavitra');
echo $this->Html->css('style_menu_ch_beo_pavitra');
echo $this->Html->css('bootstrap.min');
echo $this->Html->script('bootstrap.min');
echo $this->Html->script('jquery.form.min');
echo $this->Html->script('https://www.google.com/jsapi'); //**********************https://www.google.com/jsapi
echo $this->Html->script('map_and_language');
echo $this->Html->script('validations');
echo $this->Html->css('jquery.ui.all');
echo $this->Html->script('jquery.ui.core');
echo $this->Html->script('jquery.ui.widget');
echo $this->Html->script('calendar_common');
echo $this->Html->script('castevalidation');
echo $this->Html->script('teaching_nonteaching_form');
echo $this->Html->script('calendar_common');
echo $this->Session->flash();
?>
<style>
    .input.text > input{width:154px;}
    th{min-height:61px !important;}
    select{width: 238px !important;}
    /*    legend{width:16% !important}*/
    .subformhead{border: 1px solid #8492dd;
                 padding: 2px 10px;
                 border-radius: 7px;
                 box-shadow: 0 0 15px #a3b5de inset;}

    .legend_title{width:15%;}
    #content{min-height:400px}
</style>
<div>
    <?php echo $this->Form->create('applicant_det', array('url' => array('controller' => 'Pavitras', 'action' => 'applicant_details_update'), 'enctype' => 'multipart/form-data')); ?>

    <table class="table note">
        <tr>
            <td style="padding: 2px 12px;">
                <span class="notehead"><?php echo __('Note :'); ?></span> 
            </td>
        </tr>
    </table>
    <table
        <tr>
            <td class="col-xs-6"></td>
            <td class="col-xs-5"></td>
            <td><input  type="submit" name="Update" id="Update" value="Update" class="btn btn-sm logbutton2"></td>
            <td class="col-xs-1"><input  type="button" name="Exit" id="Exit" value="Exit" class="btn btn-sm logbutton2"></td>
        </tr>
    </table>
    <div>
        <fieldset class="myfieldset">
            <legend><div class="legend_title">Personal Details</div></legend>
            <div class="table-responsive fielddata">
                <table class="table b_table" id="fieldtable">
                    <tr>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Applicant ID') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php echo $qry[0][0]['pv_apptn_id']; ?>
                        </td>
                        <td class="col-xs-1" colspan="1">
                            <?php echo __('Applicant Name as in TET') ?><span style="float:right;">:</span>
                        </td>
                        <td class="col-xs-1" colspan="1">
                            <input type="text" name="pv_apptn_fname" id="pv_apptn_fname" value="<?php echo trim($qry[0][0]['pv_apptn_fname']); ?>" style="text-transform:uppercase" placeholder="First Name"/>
                        </td><td>
                            <input type="text" name="pv_apptn_mname" id="pv_apptn_mname" value="<?php echo trim($qry[0][0]['pv_apptn_mname']); ?>" style="text-transform:uppercase" placeholder="Middle Name"/>
                        </td><td>
                            <input type="text" name="pv_apptn_lname" id="pv_apptn_lname" value="<?php echo trim($qry[0][0]['pv_apptn_lname']); ?>" style="text-transform:uppercase" placeholder="Last Name"/>
                            <?php // echo trim($qry[0][0]['pv_apptn_fname']) . ' ' . trim($qry[0][0]['pv_apptn_mname']) . ' ' . trim($qry[0][0]['pv_apptn_lname']); ?>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Marks') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php echo $qry[0][0]['marks_obtained']; ?>/<?php echo $qry[0][0]['marks_outof']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Gender') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-6" colspan="6">
                            <div style="float:left;">
                                <input type="radio" name="gen" id="cont_emp_1" value="1" <?php if ($qry[0][0]['pv_apptn_gen'] == 1) { ?> checked<?php } ?> readonly> 
                                <label id="1">Male</label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="gen" id="cont_emp_2" value="2" <?php if ($qry[0][0]['pv_apptn_gen'] == 2) { ?> checked<?php } ?> readonly>
                                <label id="2">Female</label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="gen" id="cont_emp_2" value="3" <?php if ($qry[0][0]['pv_apptn_gen'] == 3) { ?> checked<?php } ?> readonly>
                                <label id="3">Transgender</label>
                            </div>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Date of Birth') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <input type="text" name="app_birth_dt" id="app_birth_dt" value="<?php
                            // echo $qry[0][0]['pv_apptn_dob'];
                            $arr = explode("-", $qry[0][0]['pv_apptn_dob']);
                            echo $app_birth_dt = $arr[2] . "/" . $arr[1] . "/" . $arr[0];
//                            date("d-m-Y", strtotime($qry[0][0]['pv_apptn_dob']));
                            ?>" class="inputBox" placeholder="DD-MM-YYYY" style = "width: 90% !important;" readonly>
                        </td>
                    </tr>                  
                    <tr>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Mobile No.') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <input type="text" name="app_mob" id="app_mob" value="<?php echo $qry[0][0]['mobile_no']; ?>" class="inputBox" maxlength="10" style = "width: 90% !important;" readonly>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Category of Applicant') ?><span style="float:right;">:</span>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php
                            if (!empty($qry[0][0]['pv_apptn_categ'])) {
                                $CT = trim($qry[0][0]['pv_apptn_categ']);
                            } else {
                                $CT = '';
                            }
                            echo $this->Form->input('categ', array('options' => $all_cast_type, 'id' => 'categ', 'label' => false, 'empty' => '-- Select Category--', 'style' => 'width:100%; float: left;', 'value' => $CT));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Physical Disability?') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php
                            if (!empty($qry[0][0]['pv_apptn_disab_type'])) {
                                $ph = trim($qry[0][0]['pv_apptn_disab_type']);
                            } else {
                                $ph = '';
                            }
                            echo $this->Form->input('ph', array('options' => $all_ph_type, 'id' => 'ph', 'label' => false, 'empty' => '-- Select Disability Type--', 'style' => 'width:100%; float: left;', 'value' => $ph));
                            ?>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Part Time(Anshakalin)?') ?><span style="float:right;">:</span>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php if (!empty($qry[0][0]['pv_apptn_parttime'])) { ?>
                                <div style="float:left;">
                                    <input type="radio" name="pr_apptn_parttime" id="pr_apptn_parttime_1" value="1" <?php if (trim($qry[0][0]['pv_apptn_parttime']) == '1') { ?> checked<?php } ?> >
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="pr_apptn_parttime" id="pr_apptn_parttime_2" value="2" <?php if (trim($qry[0][0]['pv_apptn_parttime']) == '2') { ?> checked<?php } ?> >
                                    <label id="2">No</label>
                                </div>
                            <?php } else { ?>
                                <div style="float:left;">
                                    <input type="radio" name="pr_apptn_parttime" id="pr_apptn_parttime_1" value="1">
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="pr_apptn_parttime" id="pr_apptn_parttime_2" value="2" checked>
                                    <label id="2">No</label>
                                </div>
                            <?php } ?>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Medium') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php
                            if (!empty($qry[0][0]['pv_medium'])) {
                                $medium = trim($qry[0][0]['pv_medium']);
                            } else {
                                $medium = '';
                            }
                            echo $this->Form->input('medium', array('options' => $meds, 'id' => 'medium', 'label' => false, 'empty' => '-- Select Medium--', 'style' => 'width:100%; float: left;', 'value' => $medium));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-xs-6" colspan="6">
                            <?php echo __('D.Ed English medium course?(20% reservation)') ?>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php if (!empty($qry[0][0]['pv_bed_eng'])) { ?>
                                <div style="float:left;">
                                    <input type="radio" name="pr_bed_eng" id="pr_bed_eng_1" value="1" <?php if (trim($qry[0][0]['pv_bed_eng']) == '1') { ?> checked<?php } ?> >
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="pr_bed_eng" id="pr_bed_eng_2" value="2" <?php if (trim($qry[0][0]['pv_bed_eng']) == '2') { ?> checked<?php } ?> >
                                    <label id="2">No</label>
                                </div>
                            <?php } else { ?>
                                <div style="float:left;">
                                    <input type="radio" name="pr_bed_eng" id="pr_bed_eng_1" value="1">
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="pr_bed_eng" id="pr_bed_eng_2" value="2" checked>
                                    <label id="2">No</label>
                                </div>
                            <?php } ?>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Contract Employee?') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php if (!empty($qry[0][0]['pv_apptn_type'])) { ?>
                                <div style="float:left;">
                                    <input type="radio" name="pr_apptn_type" id="pr_apptn_type_1" value="1" <?php if (trim($qry[0][0]['pv_apptn_type']) == '1') { ?> checked<?php } ?> >
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="pr_apptn_type" id="pr_apptn_type_2" value="2" <?php if (trim($qry[0][0]['pv_apptn_type']) == '2') { ?> checked<?php } ?> >
                                    <label id="2">No</label>
                                </div>
                            <?php } else { ?>
                                <div style="float:left;">
                                    <input type="radio" name="pr_apptn_type" id="pr_apptn_type_1" value="1">
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="pr_apptn_type" id="pr_apptn_type_2" value="2" checked>
                                    <label id="2">No</label>
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
                </table>
            </div>
        </fieldset>
    </div>
    <div>
        <fieldset class="myfieldset">
            <legend><div class="legend_title">Other Details</div></legend>
            <div class="table-responsive fielddata">
                <table class="table b_table" id="fieldtable">
                    <tr>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Aadhaar No.') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3" class="brd_left"><div>
                                <input type="text" name="pr_apptn_aadhar_1" id="pr_apptn_aadhar_1" size="6" maxlength="4" style="width:24%!important;" value="<?php echo substr($qry[0][0]['pv_apptn_aadhar'], 1, 4); ?>"> -
                                <input type="text" name="pr_apptn_aadhar_2" id="pr_apptn_aadhar_2" size="5" maxlength="4" style="width:24%!important;" value="<?php echo substr($qry[0][0]['pv_apptn_aadhar'], 4, 4); ?>"> -
                                <input type="text" name="pr_apptn_aadhar_3" id="pr_apptn_aadhar_3" size="6" maxlength="4" style="width:24%!important;" value="<?php echo substr($qry[0][0]['pv_apptn_aadhar'], 8, 12); ?>">
                            </div></td>

                        <td class="col-xs-4" colspan="4">
                            <?php echo __('Special (Horizontal) category.') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php
                            if (!empty($qry[0][0]['pv_apptn_social_categ'])) {
                                $SC = trim($qry[0][0]['pv_apptn_social_categ']);
                            } else {
                                $SC = '';
                            }
                            echo $this->Form->input('sc', array('options' => $all_soc_categ, 'id' => 'sc', 'label' => false, 'empty' => '-- Select Social Category--', 'style' => 'width:100%; float: left;', 'value' => $SC));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Marital Status') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php if (!empty($qry[0][0]['pv_apptn_mas'])) { ?>
                                <div style="float:left;">
                                    <input type="radio" name="pr_apptn_mas" id="pr_apptn_mas_1" value="M" <?php if (trim($qry[0][0]['pv_apptn_mas']) == 'M') { ?> checked<?php } ?>  >
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="pr_apptn_mas" id="pr_apptn_mas_2" value="N" <?php if (trim($qry[0][0]['pv_apptn_mas']) == 'N') { ?> checked<?php } ?>  >
                                    <label id="2">No</label>
                                </div>
                            <?php } else { ?>
                                <div style="float:left;">
                                    <input type="radio" name="pr_apptn_mas" id="pr_apptn_mas_1" value="M">
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="pr_apptn_mas" id="pr_apptn_mas_2" value="N" checked>
                                    <label id="2">No</label>
                                </div>
                            <?php } ?>
                        </td>
                        <td class="col-xs-4" colspan="4">
                            <?php echo __('No. of Children') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <input type="text" name="app_no_of_chil" id="app_no_of_chil" value="<?php echo $qry[0][0]['pv_no_of_chil']; ?>" class="inputBox" style = "width:10% !important;">
                        </td>
                    </tr>
                    <tr>
                        <td class="col-xs-2" colspan="2">
                            <?php echo __('Domicile of Maharashtra'); ?>    <span style="">: </span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php if (!empty($qry[0][0]['pv_domicile'])) { ?>
                                <div style="float:left;">
                                    <input type="radio" name="pr_domicile" id="pr_domicile_1" value="1" <?php if (trim($qry[0][0]['pv_domicile']) == '1') { ?> checked<?php } ?>>
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="pr_domicile" id="pr_domicile_2" value="2"<?php if (trim($qry[0][0]['pv_domicile']) == '2') { ?> checked<?php } ?>>
                                    <label id="2">No</label>
                                </div>
                            <?php } else { ?>
                                <div style="float:left;">
                                    <input type="radio" name="pr_domicile" id="pr_domicile_1" value="1">
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="pr_domicile" id="pr_domicile_2" value="2" checked>
                                    <label id="2">No</label>
                                </div>
                            <?php } ?>
                        </td>
                        <td class="col-xs-4" colspan="4">
                            <?php echo __('Are you from controversial Karnataka 865 border villages?'); ?> <span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php if (!empty($qry[0][0]['pv_border'])) { ?>
                                <div style="float:left;">
                                    <input type="radio" name="pr_border" id="pr_border_1" value="1" <?php if (trim($qry[0][0]['pv_border']) == '1') { ?> checked<?php } ?>>
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="pr_border" id="pr_border_2" value="2" <?php if (trim($qry[0][0]['pv_border']) == '2') { ?> checked<?php } ?>  >
                                    <label id="2">No</label>
                                </div>
                            <?php } else { ?>
                                <div style="float:left;">
                                    <input type="radio" name="pr_border" id="pr_border_1" value="1">
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="pr_border" id="pr_border_2" value="2" checked>
                                    <label id="2">No</label>
                                </div>
                            <?php } ?>
                        </td>

                    </tr>
                    <tr>
                        <td class="col-xs-4" colspan="4">
                            <?php echo __('Are you a child of sucide victim farmer?'); ?> <span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php if (!empty($qry[0][0]['pv_suicide_victim_child'])) { ?>
                                <div style="float:left;">
                                    <input type="radio" name="sucide_vic_child" id="sucide_vic_child_1" value="1" <?php if (trim($qry[0][0]['pv_suicide_victim_child']) == '1') { ?> checked<?php } ?>>
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="sucide_vic_child" id="sucide_vic_child_2" value="2" <?php if (trim($qry[0][0]['pv_suicide_victim_child']) == '2') { ?> checked<?php } ?>  >
                                    <label id="2">No</label>
                                </div>
                            <?php } else { ?>
                                <div style="float:left;">
                                    <input type="radio" name="sucide_vic_child" id="sucide_vic_child_1" value="1">
                                    <label id="1">Yes</label>
                                </div>
                                <div style="float:left;margin-left: 20px;">
                                    <input type="radio" name="sucide_vic_child" id="sucide_vic_child_2" value="2" checked>
                                    <label id="2">No</label>
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
<!--                    <tr>
                        <td class="col-xs-4" colspan="4">
                    <?php echo __('Select District For Document Verification') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                    <?php
                    if (!empty($qry[0][0]['dist_code'])) {
                        $dist_code = trim($qry[0][0]['dist_code']);
                    } else {
                        $dist_code = '';
                    }
                    echo $this->Form->input('dist_code', array('options' => $district_list, 'id' => 'dist_code', 'label' => false, 'empty' => '-- Select District--', 'style' => 'width:100%; float: left;', 'value' => $dist_code));
                    ?>
                        </td>
                    </tr>-->
                </table>
            </div>
        </fieldset>
        <input type="hidden" id="checkflag" value=<?php echo $flag; ?>>
    </div>       
    <?php echo $this->Form->end(); ?>
</div>
<script>
//    $(document).keydown(function(event) {
//        if (event.keyCode == 123) { // Prevent F12
//            return false;
//        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
//            return false;
//        }
//        else if (event.ctrlKey && event.shiftKey) { // Prevent Ctrl+Shift+I        
//            return false;
//        }
//    });
//    $(document).on("contextmenu", function(e) {
//        e.preventDefault();
//    });
    $(document).ready(function() {
        $("input[name='tet']").on('click', function() {
            var x = $("input[name='tet']:checked").val();
            if (x == '1') {
                $("#marks").show();
            }
            if (x == '2') {
                $("#marks").hide();
            }
        });

        $('#Update').on('click', function() {
            var pv_apptn_fname = $('#pv_apptn_fname').val();
            var pv_apptn_mname = $('#pv_apptn_mname').val();
            var pv_apptn_lname = $('#pv_apptn_lname').val();
            var medium = $('#medium :selected').val();
            var designation = $('#designation :selected').val();
            var sanstha = $('#sanstha :selected').val();
            var edu_lvl = $('#edu_lvl :selected').val();
            var checkbox = $("input[name='bla[]']").prop("checked");
            var app_dis_type = $('#ph :selected').val();
            var pr_apptn_parttime = $("input[name='pr_apptn_parttime']:checked").val();
            var pr_bed_eng = $("input[name='pr_bed_eng']:checked").val();
            var pr_domicile = $("input[name='pr_domicile']:checked").val();
            var pr_border = $("input[name='pr_border']:checked").val();
            var mod = $('#app_mob').val();
            var pr_apptn_aadhar_1 = $('#pr_apptn_aadhar_1').val();
            var pr_apptn_aadhar_2 = $('#pr_apptn_aadhar_2').val();
            var pr_apptn_aadhar_3 = $('#pr_apptn_aadhar_3').val();
            var schoolMobile = $('#app_mob').val();
            var x = schoolMobile.charAt(0);
            if (x < 7) {
                alert("Enter correct Mobile Number (Starting with: 7/8/9)");
                $('#app_mob').val('');
                $("#app_mob").focus();
                return false;
            }
            if (schoolMobile.length < 10)
            {
                alert("Mobile Number should not be less than 10-digits.");
                $("#app_mob").focus();
                return false;
            }
            else if (pv_apptn_fname == "") {
                alert("Enter First Name");
                return false;
            }
            else if (pv_apptn_mname == "") {
                alert("Enter Middle Name");
                return false;
            }
            else if (pv_apptn_lname == "") {
                alert("Enter Last Name");
                return false;
            }
            else if (medium == "") {
                alert("Select Medium");
                return false;
            } else if (designation == '') {
                alert("Select Designation");
                return false;
            } else if (sanstha == '') {
                alert("Select Sanstha");
                return false;
            } else if (edu_lvl == '') {
                alert("Select Education Level");
                return false;
            } else if (checkbox == false) {
                alert("Select atlist one checkbox");
                return false;
            }
            else if (app_dis_type == '') {
                alert("Select Physical Disability");
                return false;
            }
            else if (pr_apptn_parttime == false) {
                alert("Select atlist one checkbox for Part Time");
                return false;
            }
            else if (pr_bed_eng == false) {
                alert("Select atlist one checkbox for D.Ed English medium course");
                return false;
            }
            else if (pr_domicile == false) {
                alert("Select atlist one checkbox for Domicile of Maharashtra");
                return false;
            }
            else if (pr_border == false) {
                alert("Select atlist one checkbox for controversial 865 border");
                return false;
            }
            else if (mod == '') {
                alert("ERR...Enter Mobile Number.");
                $('#app_mob').val('');
                return false;
            }
            else if (pr_apptn_aadhar_1 == '')
            {
                alert("Aadhar card no. should not be blank");
                $("#pr_apptn_aadhar_1").focus();
                $("#pr_apptn_aadhar_2").focus();
                $("#pr_apptn_aadhar_3").focus();
                return false;
            }
            else if (pr_apptn_aadhar_2 == '')
            {
                alert("Aadhar card no. should not be blank");
                $("#pr_apptn_aadhar_1").focus();
                $("#pr_apptn_aadhar_2").focus();
                $("#pr_apptn_aadhar_3").focus();
                return false;
            }
            else if (pr_apptn_aadhar_3 == '')
            {
                alert("Aadhar card no. should not be blank");
                $("#pr_apptn_aadhar_1").focus();
                $("#pr_apptn_aadhar_2").focus();
                $("#pr_apptn_aadhar_3").focus();
                return false;
            }
        });
        var checkflag = $('#checkflag').val();
        if (checkflag == 1) {
            $('#applicant_detApplicantDetailsForm input[type=text]').attr("disabled", true);
            $('input[type="text"], input[type="checkbox"], select').prop("disabled", true);
            $("#applicant_detApplicantDetailsForm input:radio").attr('disabled', true);
        }
        $(document.body).on('focusout', '#app_mob', function() {
            var schoolMobile = $(this).val();
            var x = schoolMobile.charAt(0);
            if (x < 7) {
                alert("Enter correct Mobile Number (Starting with: 7/8/9)");
            }
            if (schoolMobile.length < 10)
            {
                alert("Mobile Number should not be less than 10-digits.");
                $("#app_mob").focus();
                return false;
            }
        });
//        $('#app_birth_dt').on('blur', function() {
//            var checkflag = $('#app_birth_dt').val();
//            var pattern = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
//            var check = pattern.test(checkflag);
//            if (check == false) {
//                alert("Please enter valid Date Of Birth.");
//                $('#app_birth_dt').val('');
//                $('#app_birth_dt').focus();
//            }
//
//            var d = new Date();
//            var date1 = new Date(checkflag);
//            if (date1 > d) {
//                alert("Please enter valid Date Of Birth.");
//                $('#app_birth_dt').val('');
//                $('#app_birth_dt').focus();
//            }
//        });
//   
        $("#pr_apptn_aadhar_1").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                    // Allow: Ctrl/cmd+A
                            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                            // Allow: Ctrl/cmd+C
                                    (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                                    // Allow: Ctrl/cmd+X
                                            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                                            // Allow: home, end, left, right
                                                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                                        // let it happen, don't do anything
                                        return;
                                    }
                                    // Ensure that it is a number and stop the keypress
                                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                        e.preventDefault();
                                    }
                                });
                        $('#pr_apptn_aadhar_1').on('blur', function() {
                            var checkflag = $('#pr_apptn_aadhar_1').val();
                            var n = checkflag.length;
                            if (n < 4) {
                                alert("Please enter valid Aadhar Number.");
                                $('#pr_apptn_aadhar_1').val('');
                                $('#pr_apptn_aadhar_1').focus();
                            }
                            var pattern = /[1-9]|\./;
                            var check = pattern.test(checkflag);
                            if (check == false) {
                                alert("Please enter valid Aadhar Number.");
                                $('#pr_apptn_aadhar_1').val('');
                                $('#pr_apptn_aadhar_1').focus();
                            }
                        });

                        $('#pr_apptn_aadhar_1').on('input', function(event) {
                            this.value = this.value.replace(/[^1-9]/g, '');
                        });
                        $("#pr_apptn_aadhar_2").keydown(function(e) {
                            // Allow: backspace, delete, tab, escape, enter and .
                            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                                    // Allow: Ctrl/cmd+A
                                            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                                            // Allow: Ctrl/cmd+C
                                                    (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                                                    // Allow: Ctrl/cmd+X
                                                            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                                                            // Allow: home, end, left, right
                                                                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                                                        // let it happen, don't do anything
                                                        return;
                                                    }
                                                    // Ensure that it is a number and stop the keypress
                                                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                                        e.preventDefault();
                                                    }
                                                });
                                        $('#pr_apptn_aadhar_2').on('blur', function() {
                                            var checkflag = $('#pr_apptn_aadhar_2').val();
                                            var n = checkflag.length;
                                            if (n < 4) {
                                                alert("Please enter valid Aadhar Number.");
                                                $('#pr_apptn_aadhar_2').val('');
                                                $('#pr_apptn_aadhar_2').focus();
                                            }
                                            var pattern = /^(0?[1-9])/;
                                            var check = pattern.test(checkflag);
                                            if (check == false) {
                                                alert("Please enter valid Aadhar Number.");
                                                $('#pr_apptn_aadhar_2').val('');
                                                $('#pr_apptn_aadhar_2').focus();
                                            }
                                        });
                                        $('#pr_apptn_aadhar_2').on('input', function(event) {
                                            this.value = this.value.replace(/[^0-9]/g, '');
                                        });
                                        $("#pr_apptn_aadhar_3").keydown(function(e) {
                                            // Allow: backspace, delete, tab, escape, enter and .
                                            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                                                    // Allow: Ctrl/cmd+A
                                                            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                                                            // Allow: Ctrl/cmd+C
                                                                    (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                                                                    // Allow: Ctrl/cmd+X
                                                                            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                                                                            // Allow: home, end, left, right
                                                                                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                                                                        // let it happen, don't do anything
                                                                        return;
                                                                    }
                                                                    // Ensure that it is a number and stop the keypress
                                                                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                                                                        e.preventDefault();
                                                                    }
                                                                });
                                                        $('#pr_apptn_aadhar_3').on('blur', function() {
                                                            var checkflag = $('#pr_apptn_aadhar_3').val();
                                                            var n = checkflag.length;
                                                            if (n < 4) {
                                                                alert("Please enter valid Aadhar Number.");
                                                                $('#pr_apptn_aadhar_3').val('');
                                                                $('#pr_apptn_aadhar_3').focus();
                                                            }
                                                            var pattern = /^(0?[1-9])/;
                                                            var check = pattern.test(checkflag);
                                                            if (check == false) {
                                                                alert("Please enter valid Aadhar Number.");
                                                                $('#pr_apptn_aadhar_3').val('');
                                                                $('#pr_apptn_aadhar_3').focus();
                                                            }
                                                        });
                                                        $('#pr_apptn_aadhar_3').on('input', function(event) {
                                                            this.value = this.value.replace(/[^0-9]/g, '');
                                                        });
                                                        $("#pr_apptn_aadhar_1").attr('autocomplete', 'off');
                                                        $("#pr_apptn_aadhar_2").attr('autocomplete', 'off');
                                                        $("#pr_apptn_aadhar_3").attr('autocomplete', 'off');
                                                    });

                                            $('#pv_apptn_fname').on('blur', function() {
                                                var checkflag = $('#pv_apptn_fname').val();
                                                var pattern = /^[A-z]+$/;
                                                var check = pattern.test(checkflag);
                                                if (check == false) {
                                                    alert("Please enter valid First Name.");
                                                    $('#pv_apptn_fname').val('');
                                                    $('#pv_apptn_fname').focus();
                                                }
                                            });
                                            $('#pv_apptn_mname').on('blur', function() {
                                                var checkflag = $('#pv_apptn_mname').val();
                                                var pattern = /^[A-z]+$/;
                                                var check = pattern.test(checkflag);
                                                if (check == false) {
                                                    alert("Please enter valid Middle Name.");
                                                    $('#pv_apptn_mname').val('');
                                                    $('#pv_apptn_mname').focus();
                                                }
                                            });
                                            $('#pv_apptn_lname').on('blur', function() {
                                                var checkflag = $('#pv_apptn_lname').val();
                                                var pattern = /^[A-z]+$/;
                                                var check = pattern.test(checkflag);
                                                if (check == false) {
                                                    alert("Please enter valid Last Name.");
                                                    $('#pv_apptn_lname').val('');
                                                    $('#pv_apptn_lname').focus();
                                                }
                                            });


//dob = new Date(dob);
//var today = new Date();
//var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
//$('#age').html(age+' years old');
</script>

