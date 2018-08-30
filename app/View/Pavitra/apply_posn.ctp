<?php
//echo "---------" . $get_sanstha_minority_type;
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
    .table-fixed thead{width:100%;}
    .table-fixed thead tr th{text-align: center;border-left:1px solid #ddd;height:60px;}
    .table-fixed tbody tr td{border-left:1px solid #92b2f4;font-size: 12px !important}
    .table-fixed tbody{height:140px;}
    .logbutton2{padding:2px 12px;margin:2px;}
    .apply_table{width:100%;border-collapse: collapse;background:#fff;}
    .apply_table thead tr th{text-align: center}
    .apply_table tbody tr td{border:1px solid #eee;}
</style>
<div id="content">
    <?php echo $this->Form->create('apply_posn', array('url' => array('controller' => 'Pavitras', 'action' => 'save_apply_posn'))); ?>
    <table class="table note">
        <tr>
            <td style="padding:2px 12px">
                <span class="notehead"><?php echo __('Note :'); ?></span> 
            </td>
        </tr>
    </table>
    <div style="height:595px;width:100%;padding:5px;clear:both;">
        <div class="form_content" align="center">
            <div class="map_head" style="min-height:115px;height:auto">
                <h3> Apply For Position in a Sanstha</h3>
                <table class="table b_table" width="100%" id="eoroster">
                    <tr>
                        <td class="col-xs-2" colspan="2" align="center">Select School Level <span style="float:right;font-weight:bold">:</span> </td>
                        <td class="col-xs-2" colspan="2"> 
                            <?php
                            echo $this->Form->input('edu_lvl', array('options' => $options, 'id' => 'edu_lvl', 'label' => false, 'empty' => '-- Select Level--', 'style' => 'width:100%; float: left;'));
                            ?>    
                        </td>
                        <td class="col-xs-2" colspan="2" align="center">Select Designation <span style="float:right;font-weight:bold">:</span> </td>
                        <td class="col-xs-2" colspan="2"> 
                            <?php
                            echo $this->Form->input('post', array('options' => $postdata, 'id' => 'designation', 'label' => false, 'empty' => '-- Select Designation--', 'style' => 'width:100%; float: left;'));
                            ?>    
                        </td>
                        <td class="col-xs-2" colspan="2" align="center">Medium in Advertisement<span style="float:right;font-weight:bold">:</span> </td>
                        <td class="col-xs-2" colspan="2"> 
                            <?php
                            echo $this->Form->input('medium', array('options' => $meds, 'id' => 'medium', 'label' => false, 'empty' => '-- Select Medium--', 'style' => 'width:100%; float: left;'));
                            ?>    
                        </td>
                    </tr>
                    <tr>
                        <td class="col-xs-2" colspan="2" align="center">Select Category <span style="float:right;font-weight:bold">:</span> </td>
                        <td class="col-xs-2" colspan="2"> 
                            <?php
                            echo $this->Form->input('caste', array('options' => $castedata, 'id' => 'caste', 'label' => false, 'empty' => '-- Select Caste--', 'style' => 'width:100%; float: left;'));
                            ?>    
                        </td>
                        <td class="col-xs-2" colspan="2" align="center">Select Subject <span style="float:right;font-weight:bold">:</span> </td>
                        <td class="col-xs-2" colspan="2"> 
                            <?php
                            echo $this->Form->input('subject', array('options' => $all_subj_opt, 'id' => 'subject', 'label' => false, 'empty' => '-- Select Subject--', 'style' => 'width:100%; float: left;'));
                            ?>    
                        </td>
                    </tr>
                    <tr id="sanstha">
                        <td class="col-xs-2" colspan="2" align="center">Select Sanstha <span style="float:right;font-weight:bold">:</span> </td>
                        <td class="col-xs-6" colspan="6"> 
                            <?php
                            echo $this->Form->input('sanstha', array('options' => '', 'id' => 'sanstha', 'label' => false, 'empty' => '-- Select Sanstha--', 'style' => 'width:100%; float: left;'));
                            ?>    
                        </td>
                        <td class="col-xs-4" colspan="4"></td>
                    </tr>
                </table> 

            </div>
            <div>
                <div class="map_head" style="margin:10px 0;height:auto">
                    <h3> Post wise details</h3>
                </div>
                <table>
                    <tr>
                        <td class="col-xs-6"></td>
                        <td class="col-xs-5"></td>
                        <td><input  type="submit" name="Apply" id="apply" value="Apply" class="btn btn-sm logbutton2"></td>
                        <td class="col-xs-1"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Clear" class="btn btn-sm logbutton2"></td>
                    </tr>
                </table>
                <table class="table apply_table">   
                    <thead>
                        <tr>
                            <th class="col-xs-1"><?php echo __('Sr.No.'); ?></th>
                            <th class="col-xs-2" colspan="2"><?php echo __('Designation'); ?></th>
                            <th class="col-xs-1"><?php echo __('Pay Scale'); ?></th>
                            <th class="col-xs-1"><?php echo __('No. of Posts'); ?></th>
                            <th class="col-xs-1"><?php echo __('Aid Type'); ?></th>
                            <th class="col-xs-1"><?php echo __('Subject'); ?> </th>
                            <th class="col-xs-2" colspan="2" ><?php echo __('Min.Academic Qualification'); ?></th>
                            <th class="col-xs-2" colspan="2"><?php echo __('Min.Professional Qualification'); ?></th>
                            <th class="col-xs-1" colspan="1"><?php echo __('Select'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="adv_data">
                    </tbody>
                </table> 
            </div>
        </div>
        <?php
        echo $this->Form->end();
        echo $this->Form->input('dob', array('id' => 'dob_hidden_id', 'value' => $applicant_detail[0]['ApplnDetMast']['pv_apptn_dob'], 'type' => 'hidden', 'readonly' => 'readonly', 'maxlength' => '1'));
        echo $this->Form->input('aqal', array('id' => 'aqal_hidden_id', 'value' => $applicant_detail[0]['ApplnDetMast']['pv_apptn_dob'], 'type' => 'hidden', 'readonly' => 'readonly', 'maxlength' => '1'));
        echo $this->Form->input('pqal', array('id' => 'pqal_hidden_id', 'value' => $applicant_detail[0]['ApplnDetMast']['pv_apptn_dob'], 'type' => 'hidden', 'readonly' => 'readonly', 'maxlength' => '1'));
        echo $this->Form->input('categ', array('id' => 'categ_hidden_id', 'value' => $applicant_detail[0]['ApplnDetMast']['pv_apptn_categ'], 'type' => 'hidden', 'readonly' => 'readonly', 'maxlength' => '1'));
        echo $this->Form->input('Desing', array('id' => 'desing_hidden_id', 'value' => '', 'type' => 'hidden', 'readonly' => 'readonly', 'maxlength' => '1'));
        echo $this->Form->input('Medium', array('id' => 'medium_hidden_id', 'value' => '', 'type' => 'hidden', 'readonly' => 'readonly', 'maxlength' => '1'));
        ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#edu_lvl').on('change', function() {
            var edu_lvl = $('#edu_lvl :selected').val();
            if (edu_lvl == '2') {
                $("#designation option[value='4']").show();
                $("#designation option[value='21']").show();
                $("#designation option[value='22']").show();
            }
            else if (edu_lvl == '1') {
                $("#designation option[value='4']").hide();
                $("#designation option[value='21']").hide();
                $("#designation option[value='22']").hide();
            }
        });
        $('#subject').on('change', function() {
            var medium = $('#medium :selected').val();
            var designation = $('#designation :selected').val();
            var edu_lvl = $('#edu_lvl :selected').val();
            var subject = $('#subject :selected').val();
            var caste = $('#caste :selected').val();

            if (edu_lvl == '1') {
                edu_lvl = 'P';
            } else {
                edu_lvl = 'S';
            }
            if (medium != '' || designation != '') {
                jQuery.post('SelectSansthapplicant', {medium: medium, designation: designation, edu_lvl: edu_lvl,subject:subject,caste:caste}, function(data) {
                    $('#sanstha').html(data);
                });
            }
            else {
                alert("Please Select Medium.");
            }
        });
        $('#sanstha').on('change', function() {
            var medium = $('#medium :selected').val();
            var designation = $('#designation :selected').val();
            var sanstha = $('#sanstha :selected').val();
            var edu_lvl = $('#edu_lvl :selected').val();
            if (edu_lvl == '1') {
                edu_lvl = 'P';
            } else {
                edu_lvl = 'S';
            }
            if (medium != '' || designation != '') {
                jQuery.post('getsansthadetails', {medium: medium, designation: designation, sanstha: sanstha, edu_lvl: edu_lvl}, function(data) {
                    $('#adv_data').html(data);
                    $("input[name='bla[]']").click(function() {
//                        var cat = $("#Cat").val();
//                        if (cat == 0) {
//                            alert("Can't apply for this post due to mismastch in Catergory.");
//                            location.reload();
//                            $('#medium :selected').val('');
//                            $('#designation :selected').val('');
//                            $('#sanstha :selected').val('');
//                            $('#edu_lvl :selected').val('');
//                        }
                        var age = $("#age").val();
                        if (age == 1) {
                            alert("Can't apply for this post because you exceeds age limit.");
                            location.reload();
                            $('#medium :selected').val('');
                            $('#designation :selected').val('');
                            $('#sanstha :selected').val('');
                            $('#edu_lvl :selected').val('');
                        }
                        var recordexist = $("#recordexist").val();
                        if (recordexist == 1) {
                            alert("Already applied for this Post.");
                            location.reload();
                            $('#medium :selected').val('');
                            $('#designation :selected').val('');
                            $('#sanstha :selected').val('');
                            $('#edu_lvl :selected').val('');

                        }
                        var qual = $("#qual").val();
                        if (qual == 1) {
                            alert("Can't apply for this post due to mismastch in Qualification.");
                            location.reload();
                            $('#medium :selected').val('');
                            $('#designation :selected').val('');
                            $('#sanstha :selected').val('');
                            $('#edu_lvl :selected').val('');
                        }
                        var subject = $("#subject").val();
                        if (subject == 0) {
                            alert("Can't apply for this post due to mismastch in Subject.");
                            location.reload();
                            $('#medium :selected').val('');
                            $('#designation :selected').val('');
                            $('#sanstha :selected').val('');
                            $('#edu_lvl :selected').val('');
                        }
                    });
                    $('#desing_hidden_id').val(designation);
                    $('#medium_hidden_id').val(medium);
                });
            }
            else {
                alert("Please Select Sanstha.");
            }
        });
        $('#apply').on('click', function() {
            var medium = $('#medium :selected').val();
            var designation = $('#designation :selected').val();
            var sanstha = $('#sanstha :selected').val();
            var edu_lvl = $('#edu_lvl :selected').val();
            var checkbox = $("input[name='bla[]']").prop("checked");
            if (medium == '') {
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

        });
    });
</script>