<?php echo $this->Form->create('pavitras', array('type' => 'file', 'url' => array('controller' => 'pavitras', 'action' => 'verifrejectexvacdets'))); ?>
<style>
    #vacancy
    {
        border-collapse:collapse;
        margin-bottom:10px;
        margin-left: 1%;
        background:#DFE7F8 none repeat scroll 0% 0%;
        width: 98%;
        border-radius: 0.5em;
        box-shadow: 0px 1px 5px rgb(135, 127, 127);
        margin-top: 10px;
    }

    #vacancy td
    {
        padding:1%;
    }
    .legend_title{width:26%}
    #frwcastdetails{margin-bottom:10px;}
    #dist_school_help span
    {

    }
</style>

<table border="0" style="border-collapse:collapse;width:100%;height:40px;">
    <tr>
        <td colspan="6" width="55%" class="mapheading" style="text-align:center;">Verification of Vacancy Details for Sanstha</td>
        <td width="20%">
            <span style="text-align:right;">
                <input class="gobutton"  id="exit_tch" type="button" value="Exit" style="float:right;"/>
                <input class="gobutton rstbtn"  id="cancel_tch_personal" type="button" value="Cancel"  style="float:right;"/>
                <?php echo $this->Form->submit('Reject', array('class' => 'gobutton', 'id' => 'reject_eo_common', 'type' => 'submit', 'value' => 'Reject', 'style' => 'float:right;')); ?>
                <?php echo $this->Form->submit('Verify', array('class' => 'gobutton', 'id' => 'verify_eo_common', 'type' => 'submit', 'value' => 'Verify', 'style' => 'float:right;')); ?>
            </span>
        </td>
    </tr>
</table>

<table id="vacancy" border="0" width="100%">
    <tr>


        <td class="col-xs-4" colspan="4">
            <div>
                <?php
                $eos_type = array('2' => 'Vacant');
                echo $this->Form->input('eos_type', array('options' => $eos_type, 'label' => 'Vacant Type  &nbsp; &nbsp;:&nbsp; &nbsp;', 'empty' => '-- Select Vacant Type --',
                    'id' => 'eos_type', 'style' => 'width:71% !important;'));
                ?>
            </div>
        </td>

        <td class="col-xs-8" colspan="8">

            <div id="sanstha_list">
                <?php
                if (!empty($sanstha_list)) {
                    echo $this->Form->input('sanstha_code', array('options' => $sanstha_list, 'empty' => '-- Select Sanstha --',
                        'id' => 'sanstha_code', 'label' => 'Select Sanstha &nbsp; &nbsp;:&nbsp; &nbsp;', 'style' => 'width:67%;',
                        'class' => 'selectbox'));
                }
                ?>
            </div>
            <div id="desig_list">
                <?php
                if (!empty($desig_list)) {
                    echo $this->Form->input('desig_cd', array('options' => $desig_list, 'empty' => '-- Select Designation --',
                        'id' => 'desig_cd', 'label' => 'Select Designation &nbsp; &nbsp;:&nbsp; &nbsp;', 'style' => 'width:67%;',
                        'class' => 'selectbox'));
                }
                ?>
            </div>
            <div id="med_list">
                <?php
                if (!empty($med_list)) {
                    echo $this->Form->input('med_cd', array('options' => $med_list, 'empty' => '-- Select Medium --',
                        'id' => 'med_cd', 'label' => 'Select Medium &nbsp; &nbsp;:&nbsp; &nbsp;', 'style' => 'width:67%;',
                        'class' => 'selectbox'));
                }
                ?>
            </div>
        </td>
    </tr>

    <tr>
        <td class="col-xs-4" colspan="4">
            <div id='school_detail' style="height: 26px;overflow: auto;">  </div>
        </td>
        <td class="col-xs-4" colspan="4">
            <div id='med_detail'>  </div>
        </td>
        <td class="col-xs-2" colspan="2"></td>
    </tr>
    <tr>
        <td>
            <input type="hidden" id="vr" name='vr'/>
            <input type="hidden" id="stype" name='stype' value="<?php echo $typ; ?>"/>
            <input type="hidden" id="sch_type" name="sch_type" value="<?php echo $sch_type; ?>"/>
            <input type="hidden" id="dist" name="dist" value="<?php echo $dist; ?>"/>
            <input type="hidden" id="sansthatype" name="sansthatype" value="<?php echo $min; ?>"/>
        </td>
    </tr>
</table>

<div id='school_teacher_detail' style="height: 238px;">

</div>
<script>
    $(document).ready(function() {
        $("#reject_eo_common").attr('disabled', true);
        $('#reject_eo_common').css("background", "grey");
        $("#verify_eo_common").attr('disabled', true);
        $('#verify_eo_common').css("background", "grey");

        var dist_cd = $.trim($("#dist").val());
        var schl_type = $.trim($("#sch_type").val());

//  
//        $('#dist_id_school_help').on('change', function () {
//
//            $('#option_schl_type').val('');
//            $('#eos_type ').val('');
//            $('#school_detail').html('');
//            $('#school_teacher_detail').html('');
//
//
//        });
//
//      
        $('#eos_type').on('change', function() {
            var eos_type = $('#eos_type :selected').val();
            $('#school_detail').html('');
            $('#school_teacher_detail').html('');
//                jQuery.post('SelectSchoolSearchForSanstha', {dist_id: dist_id, schl_type: schl_type}, function(data) {
//                    $('#school_list').html(data); 
            if (eos_type == '') {
                $('#school_detail').html('');
                $('#school_teacher_detail').html('');
                alert("Select Excess/Vacant Type");
            }
            else {
                var sansthatype = $.trim($('#sansthatype').val());
                jQuery.post('selectsanstha', {dist_cd: dist_cd, schl_type: schl_type, eos_type: eos_type, sansthatype: sansthatype}, function(data) {
                    $('#sanstha_list').html(data);
                    $('#school_detail').html('');
                    $('#school_detail').html('');
                    $('#school_teacher_detail').html('');


                    $('#sanstha_code').on('change', function() {

                        var scode = $('#sanstha_code').val();
                        jQuery.post('selectdesigverif', {dist_cd: dist_cd, schl_type: schl_type, eos_type: eos_type, san_code: scode}, function(data) {
                            //                            $('#desig_list').html(data);
                            $('#school_detail').html('');
                            $('#school_detail').html(data);
                            $('#school_teacher_detail').html('');

                            $('#desig_cd').on('change', function() {
                                var desig_cd = $('#desig_cd :selected').val();

                                if (desig_cd == '') {
                                    $('#school_teacher_detail').html('');
                                    alert("Please Select Designation.");

                                }
                                else {
                                    jQuery.post('selectmedverif', {san_code: scode}, function(data) {
                                        $('#med_detail').html('');
                                        $('#med_detail').html(data);
                                        $("#reject_eo_common").attr('disabled', false);

                                        $('#med_cd').on('change', function() {
                                            var med_cd = $('#med_cd').val();
                                            $('#reject_eo_common').css("background", "#fffbcf -moz-linear-gradient(center top , #fffbcf 5%, #f5d969 100%) repeat scroll 0 0");
                                            $("#verify_eo_common").attr('disabled', false);
                                            $('#verify_eo_common').css("background", "#fffbcf -moz-linear-gradient(center top , #fffbcf 5%, #f5d969 100%) repeat scroll 0 0");
                                            jQuery.post('verify_ex_vac_detail', {dist_cd: dist_cd, schl_type: schl_type, eos_type: eos_type, desig_cd: desig_cd, san_code: scode, med_cd: med_cd}, function(data) {
                                                $('#school_teacher_detail').html('');
                                                $('#school_teacher_detail').html(data);


                                                var eo_sanstha_ex_vac_tot = Number($('#eo_sanstha_ex_vac_tot').val());
                                                var smj_excesstch_det_tot = Number($('#smj_excesstch_det_tot').val());

                                                var eos_type_main = Number($('#eos_type_main').val());
                                                var eos_desg_cd_main = Number($('#eos_desg_cd_main').val());



                                                if (eos_type_main == 1) {

                                                    if (eo_sanstha_ex_vac_tot == smj_excesstch_det_tot) {

                                                        $("#verify_eo_common").attr('disabled', false);
                                                        $('#verify_eo_common').css("background", "#fffbcf -moz-linear-gradient(center top , #fffbcf 5%, #f5d969 100%) repeat scroll 0 0");
                                                    }
                                                    else {
                                                        alert("Err... Entry of School-wise Excess Post Details and Total entries of Excess Staff Details is not matching for the selected Post");

                                                    }
                                                }
                                                else if (eos_type_main == 2) {
                                                    $("#verify_eo_common").attr('disabled', false);
                                                    $('#verify_eo_common').css("background", "#fffbcf -moz-linear-gradient(center top , #fffbcf 5%, #f5d969 100%) repeat scroll 0 0");
                                                }

                                                $('#verify_eo_common').click(function() {
                                                    $('#vr').val(1);
                                                    var eo_sanstha_ex_vac_tot = Number($('#eo_sanstha_ex_vac_tot').val());
//                            alert(eo_sanstha_ex_vac_tot);
                                                    var smj_excesstch_det_tot = Number($('#smj_excesstch_det_tot').val());
//                            alert(smj_excesstch_det_tot);
                                                    if (eos_type_main == 1) {
                                                        if (eo_sanstha_ex_vac_tot == smj_excesstch_det_tot)
                                                        {

                                                            $("#TeacherNewrecruitmenttechstaffForm").submit(); //fwdexvacdettoeo
                                                        }
                                                        else {
                                                            alert("Err... Entry of School-wise Excess Post Details and Total entries of Excess Staff Details is not matching for the selected Post");
                                                            return false;
                                                        }
                                                    }
                                                    else if (eos_type_main == 2) {
                                                        $("#TeacherNewrecruitmenttechstaffForm").submit(); //fwdexvacdettoeo
                                                    }

                                                });

                                                $('#reject_eo_common').click(function() {
                                                    $('#vr').val(2);
                                                    var eo_sanstha_ex_vac_tot = Number($('#eo_sanstha_ex_vac_tot').val());
//                            alert(eo_sanstha_ex_vac_tot);
                                                    var smj_excesstch_det_tot = Number($('#smj_excesstch_det_tot').val());
                                                    if (eos_type_main == 1) {
                                                        if (eo_sanstha_ex_vac_tot == smj_excesstch_det_tot)
                                                        {
                                                            //fwdexvacdettoeo
                                                        }
                                                        else {
                                                            alert("Err... Entry of School-wise Excess Post Details and Total entries of Excess Staff Details is not matching for the selected Post");
                                                            return false;
                                                        }
                                                    }
                                                    $("#TeacherNewrecruitmenttechstaffForm").submit(); //fwdexvacdettoeo

                                                });



                                            });
                                        });
                                    });
                                }
                            });
                        });
                    });


                });

//                

            }

        });



        $("#exit_tch").click(function() {
            var url = "minority_nonminority";
            $(location).attr('href', url);
        });

    });
</script>