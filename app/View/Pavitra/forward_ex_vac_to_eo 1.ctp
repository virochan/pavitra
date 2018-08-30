<?php echo $this->Form->create('pavitras', array('type' => 'file', 'url' => array('controller' => 'pavitras', 'action' => 'fwdexvacdettoeo'))); ?>
<style>
    #vacancy
    {
        border-collapse:collapse;
        margin-bottom:10px;
        margin-left: 1%;
        background:#E4FBFF none repeat scroll 0% 0%;
        width: 98%;
        border-radius: 0.5em;
        box-shadow: 0px 1px 5px rgb(135, 127, 127);
        margin-top: 10px;
    }

    #vacancy td
    {
        padding:1%;
    }

    #dist_school_help span
    {

    }
</style>

<table border="0" style="border-collapse:collapse;width:100%;height:40px;">
    <tr>
        <td colspan="6" width="55%" class="mapheading" style="text-align:center;">Forward Sansthawise Vacancy Details to EO</td>
        <td width="20%">
            <span style="text-align:right;">
                <input class="gobutton"  id="exit_tch" type="button" value="Exit" style="float:right;"/>
                <input class="gobutton rstbtn"  id="cancel_tch_personal" type="button" value="Cancel"  style="float:right;"/>
                <?php echo $this->Form->submit('Forward To EO', array('class' => 'gobutton', 'id' => 'forward_eo_common', 'type' => 'submit', 'value' => 'Forward', 'style' => 'float:right;')); ?>
            </span>
        </td>
    </tr>
</table>

<table id="vacancy" border="0" width="100%">
    <tr>
        <td>
            <div id="dist_school_help" style="padding-left:10%;">
                <?php
                echo $this->Form->input('dist_id_school_help', array('options' => $district_list, 'empty' => '-- Select District --',
                    'id' => 'dist_id_school_help', 'label' => 'District &nbsp;:&nbsp; ', 'style' => 'width:50%;',
                    'class' => 'selectbox'));
                ?>
            </div>
        </td>

        <td>
            <div>
                <?php
                $option_schl_type = array('01' => 'Primary', '02' => 'Secondary');
                echo $this->Form->input('option_schl_type', array('options' => $option_schl_type, 'label' => 'School Type  &nbsp;:&nbsp;', 'empty' => '-- Select School Type --',
                    'id' => 'option_schl_type', 'style' => 'width:40% !important;'));
                ?>
            </div>
        </td>
        <td>
            <div>
                <?php
                $eos_type = array('2' => 'Vacant');
                echo $this->Form->input('eos_type', array('options' => $eos_type, 'label' => 'Vacant Type  &nbsp;:&nbsp;', 'empty' => '-- Select Type --',
                    'id' => 'eos_type', 'style' => 'width:40% !important;'));
                ?>
            </div>
        </td>

    </tr>

    <tr>
        <td colspan="2">
            <div id="school_list">
                <?php
                if (!empty($school_list)) {
                    echo $this->Form->input('dist_id_school_help', array('options' => $school_list, 'empty' => '-- Select school --',
                        'id' => 'school_list', 'label' => 'Select School', 'style' => 'width:67%;',
                        'class' => 'selectbox'));
                }
                ?>
            </div>
            <div id="desig_list">
                <?php
                if (!empty($desig_list)) {
                    echo $this->Form->input('desig_cd', array('options' => $desig_list, 'empty' => '-- Select Designation --',
                        'id' => 'desig_cd', 'label' => 'Select Designation', 'style' => 'width:40%;',
                        'class' => 'selectbox'));
                }
                ?>
            </div>
            <div id="med_list">
                <?php
                if (!empty($med_list)) {
                    echo $this->Form->input('med_cd', array('options' => $med_list, 'empty' => '-- Select Medium --',
                        'id' => 'med_cd', 'label' => 'Select Medium', 'style' => 'width:40%;',
                        'class' => 'selectbox'));
                }
                ?>
            </div>
        <td>
            <div id="school_list">
                <?php
                if (!empty($schools)) {
                    echo $this->Form->input('sch_cd', array('options' => $schools, 'empty' => '-- Select School --',
                        'id' => 'sch_cd', 'label' => 'Select School', 'style' => 'width:40%;',
                        'class' => 'selectbox'));
                }
                ?>
            </div>
        </td>

        </td>  
    </tr>

    <tr>
        <td colspan="2">
            <div id='school_detail'>  </div>
        </td>
        <td >
            <div id='med_detail'>  </div>

        </td>
        <td>
            <div id="school_list">

            </div>
        </td>
    </tr>

</table>
<div id='school_teacher_detail'>

</div>
<script>
    $(document).ready(function() {
        $("#forward_eo_common").attr('disabled', true);
        $('#forward_eo_common').css("background", "grey");

        $('#dist_id_school_help').on('change', function() {

            $('#option_schl_type').val('');
            $('#eos_type ').val('');
            $('#school_detail').html('');
            $('#school_teacher_detail').html('');


        });

        $('#option_schl_type').on('change', function() {
            $('#eos_type ').val('');
            $('#school_detail').html('');
            $('#school_teacher_detail').html('');
        });

        $('#eos_type').on('change', function() {
            var dist_cd = $('#dist_id_school_help :selected').val();
            var schl_type = $('#option_schl_type :selected').val();
            var eos_type = $('#eos_type :selected').val();
//                jQuery.post('SelectSchoolSearchForSanstha', {dist_id: dist_id, schl_type: schl_type}, function(data) {
//                    $('#school_list').html(data); 
            if (dist_cd == '' || schl_type == '' || eos_type == '') {
                $('#school_detail').html('');
                $('#school_teacher_detail').html('');
                alert("Select District OR School Type OR Vacant Type");
            }
            else {
                jQuery.post('selectdesig', {dist_cd: dist_cd, schl_type: schl_type, eos_type: eos_type}, function(data) {
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
                            jQuery.post('selectmed', function(data) {
                                $('#med_detail').html('');
                                $('#med_detail').html(data);
                                $('#med_cd').on('change', function() {
                                    var med_cd = $('#med_cd').val();
//                                    jQuery.post('getschools', {dist_cd: dist_cd, schl_type: schl_type, eos_type: eos_type, desig_cd: desig_cd, med_cd: med_cd}, function(data) {
//                                        $('#school_list').html('');
//                                        $('#school_list').html(data);
//                                        $('#sch_cd').on('change', function() {
//                                            var sch_cd = $('#sch_cd :selected').val();
                                            jQuery.post('forward_sanstha_ex_vac_detail', {dist_cd: dist_cd, schl_type: schl_type, eos_type: eos_type, desig_cd: desig_cd, med_cd: med_cd}, function(data) {
                                                $('#school_teacher_detail').html('');
                                                $('#school_teacher_detail').html(data);
                                                var eo_sanstha_ex_vac_tot = Number($('#eo_sanstha_ex_vac_tot').val());
                                                var smj_excesstch_det_tot = Number($('#smj_excesstch_det_tot').val());
                                                var eos_type_main = Number($('#eos_type_main').val());
                                                var eos_desg_cd_main = Number($('#eos_desg_cd_main').val());
                                                if (eos_type_main == 1) {
                                                    if (eo_sanstha_ex_vac_tot == smj_excesstch_det_tot) {

                                                        $("#forward_eo_common").attr('disabled', false);
                                                        $('#forward_eo_common').css("background", "#fffbcf -moz-linear-gradient(center top , #fffbcf 5%, #f5d969 100%) repeat scroll 0 0");
                                                    }
                                                    else {
                                                        alert("Err... Entry of School-wise Excess Post Details and Total entries of Excess Staff Details is not matching for the selected Post");
                                                        $("#forward_eo_common").attr('disabled', false);
                                                        $('#forward_eo_common').css("background", "#fffbcf -moz-linear-gradient(center top , #fffbcf 5%, #f5d969 100%) repeat scroll 0 0");
                                                    }
                                                }
                                                else if (eos_type_main == 2) {
                                                    $("#forward_eo_common").attr('disabled', false);
                                                    $('#forward_eo_common').css("background", "#fffbcf -moz-linear-gradient(center top , #fffbcf 5%, #f5d969 100%) repeat scroll 0 0");
                                                }
                                            });
//                                        });
//                                    });
//                              
                                });
                            });
                        }
                    });
                    $('#forward_eo_common').click(function() {

                        var eo_sanstha_ex_vac_tot = Number($('#eo_sanstha_ex_vac_tot').val());
//                            alert(eo_sanstha_ex_vac_tot);
                        var smj_excesstch_det_tot = Number($('#smj_excesstch_det_tot').val());
//                            alert(smj_excesstch_det_tot);
                        var eos_type_main = Number($('#eos_type_main').val());
                        var eos_desg_cd_main = Number($('#eos_desg_cd_main').val());
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

                });
            }
        });
        $("#exit_tch").click(function() {
            var url = "sanstha";
            $(location).attr('href', url);
        });

//        $("#forward_eo").attr('disabled', 'disabled');
//        $('#forward_eo').css("background", "grey"); 
    });
</script>