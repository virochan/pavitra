<?php
echo $this->Html->script('jquery-1.7.2');
echo $this->Html->script('jquery.ui.datepicker');
echo $this->Html->css('jquery.ui.all');
echo $this->Html->script('jquery.ui.core');
echo $this->Html->css('bootstrap.min');
echo $this->Html->script('bootstrap.min');
?>

<style>
    .table{margin-bottom: 0px;}    
    img#close {
        position:absolute;
        right:-14px;
        top:-14px;
        cursor:pointer
    }

    div #popimg {
        position:absolute;
        left:40%;
        top:5%;
        font-family:'Raleway',sans-serif;
    }

    #rostertable td
    {
        padding:0.5%;
    }
    .overlay_srch {
        background: rgba(0, 0, 0, 0.69) none repeat scroll 0 0;
        height: 100%;
        left: 0;
        position: fixed;
        top: 0;
        width: 100%;
        display:none;
    }

    .overlay_srch > div#overlay_srch {
        background:rgba(237, 240, 240,0.9);
        border:solid 1px white;
        border-radius: 6px;
        left: 30%;
        padding: 1% 2%;
        position: absolute;
        top: 21%;
        width:45%;
        height:400px;
    }
    #img
    {
        width: 36%;
        height: auto;
        margin-top: 10%;
        margin-left: 32%;
    }
    #exit_search
    {
        cursor: pointer;
        position: absolute;
        top: 130px;
        right: 24%;
    }
    img#close {
        position:absolute;
        right:-14px;
        top:-14px;
        cursor:pointer
    }
</style>
<script>
    $(document).ready(function() {

        $(function() {
            $("#datepicker").datepicker({
                showOn: "button",
                buttonImage: "../img/calender.gif",
                buttonImageOnly: true,
                buttonText: "Select date"
            });
        });

        $('#main_table').hide();

        $("#overlay_srch").hide();
        $("#img_close").hide();

        var numpattern = /^[0-9]*$/;
        //$('input:radio[id=tchr_type][value=2]').attr('disabled', true);
        var sess_val = $('#sess_val').val();
        $('#view').hide();
        $('#map_container').hide();
        json_data();
        $('.price').each(function() {
            if ($(this).val() == '') {
                $(this).val('0');
            }
        });
        $('.work').each(function() {
            if ($(this).val() == '') {
                $(this).val('0');
            }
        });
        var p_sum = 0;
        $('.vcnt').each(function() {
            if ($(this).val() == '') {
                $(this).val('0');
            } else {
                if ($(this).val() != '') {
                    p_sum += Number($(this).val());
                }
//                $('#SamayojanVacntSum').val(p_sum);
                $('#caste_ctg_saveVacntSum').val(p_sum);
            }
        });
        $('#caste_ctg_saveSancSum').val('0');
        $('#caste_ctg_saveWrkSum').val('0');
        $('#caste_ctg_saveVacntSum').val('0');
//        $('#SamayojanVacntSum').val('0');


        if (sess_val.indexOf('SC') >= 0) {
            //$('#tchr_type1').attr('checked','true');
        } else if (sess_val.indexOf('CB') >= 0) {
            $('#tchr_type1').attr('checked', 'true');
        } else if (sess_val.indexOf('EO') >= 0) {
            $('#tchr_type1').attr('checked', 'true');
        } else if (sess_val.indexOf('DD') >= 0) {
            $('#tchr_type1').attr('checked', 'true');
        }

        $("#caste_teaching").click(function() {
            $('input:radio[id=tchr_type][value=1]').prop('checked', true);
        });
        $("#caste_nonteaching").click(function() {
            $('input:radio[id=tchr_type][value=2]').prop('checked', true);
        });
        $("#roster_cancel").click(function() {
            location.reload();
        });

        $("#tchr_type1").click(function() {
            $('#staff_group').trigger('change');
        });
        $("#tchr_type2").click(function() {
            $('#staff_group').trigger('change');
        });
        $("#caste_hm_exit").click(function() {
            var url = 'sanstha';
            $(location).attr('href', url);
        });
        $("#staff_group").change(function() {

            var staff_group = $('#staff_group').val();
            var edu_level = $('input:radio[name=edu_level]:checked').val();
            if (edu_level == '1') {
                $('#tchr_type1').attr('disabled', false);
                $('#tchr_type2').attr('disabled', true);
            }
            else {
                $('#tchr_type2').attr('disabled', false);
                $('#tchr_type1').attr('disabled', true);
            }
            var tchr_type = $('#tchr_type').val();

            $('#main_table').show();
            jQuery.post('get_staff_avail', {staff_group: staff_group, roster_edn_level: edu_level, tchr_type: tchr_type}, function(data) {
                if (data.trim() == 'error') {
                    alert('Roster data is not filled for this education type');
                    $('#datepicker').val('');
                    $('#view').hide();
                    $('#mycontainer1').hide();
                    $('#SamayojanUplodimg').val('');
                    $('#pdf_path').val('');
                    $('.price').each(function() {
                        $(this).val('0');
                    });
                    $('.work').each(function() {
                        $(this).val('0');
                    });
                    $('.vcnt').each(function() {
                        $(this).val('0');
                    });
                    $('#caste_ctg_saveSancSum').val('0');
                    $('#caste_ctg_saveWrkSum').val('0');
//                    $('#SamayojanVacntSum').val('0');
                    $('#caste_ctg_saveVacntSum').val('0');
                    $("input").prop('disabled', true);
                    $("#caste_hm_exit").prop('disabled', false);
                    $("#roster_cancel").prop('disabled', false);
                } else {
                    json_data();
                }
            });
        });


        function json_data() {
            var flag = '';
            var sanstha_code = '';
            var mgmt_type = '';
            var roster_edn_level = '';
            var tchr_type = '';
            var staff_group = '';
            var sc_sanc_tot = '';
            var st_sanc_tot = '';
            var vja_sanc_tot = '';
            var ntb_sanc_tot = '';
            var ntc_sanc_tot = '';
            var ntd_sanc_tot = '';
            var obc_sanc_tot = '';
            var sbc_sanc_tot = '';
            var gen_sanc_tot = '';
            var sc_work_tot = '';
            var st_work_tot = '';
            var vja_work_tot = '';
            var ntb_work_tot = '';
            var ntc_work_tot = '';
            var ntd_work_tot = '';
            var obc_work_tot = '';
            var sbc_work_tot = '';
            var gen_work_tot = '';
            var roster_file_name = '';
            var rst_last_upd_dt = '';
            var p_sum = 0;
            var w_sum = 0;
            var v_sum = 0;
            var session_user_id = $('#sess_val').val(); // alert($('#sess_val').val());	
//            var edu_level = $('#tchr_type1').val();
            var edu_level = $('input:radio[name=edu_level]:checked').val();
            tchr_type = $('#tchr_type').val();
            staff_group = $('#staff_group').val();
            if (staff_group != '') {
                staff_group = staff_group;
            } else {
                staff_group = 1;
            }

            jQuery.post(window.webroot + 'Pavitras/get_roster_data', {session_user_id: session_user_id, staff_group: staff_group,
                roster_edn_level: edu_level, tchr_type: tchr_type}, function(data) {

                $.each(data, function(key, val) {
                    $.each(val, function(key, val) {
                        $.each(val, function(key, val) {
                            $.each(val, function(key, val) {

                                if (key === 'mgmt_type') {

                                }
                                if (key === 'roster_edn_level') {
                                    if (val == 'P') {
                                        $('#tchr_type1').attr('checked', 'true');
                                    } else {
                                        $('#tchr_type2').attr('checked', 'true');
                                    }
                                }
                                if (key === 'tchr_type') {
                                    if (val == '1') {
                                        $('#tchr_type').attr('checked', 'true');
                                    } else {
                                        //$('#tchr_type2').attr('checked', 'true');
                                    }
                                }
                                if (key === 'staff_group') {
                                    $('#staff_group option[value=' + $.trim(val) + ']').attr("selected", "selected");
                                }
                                if (key === 'sc_sanc_tot') {
                                    sc_sanc_tot = val;
                                    $("#price_1").val(val);
                                }
                                if (key === 'sc_work_tot') {
                                    sc_work_tot = val;
                                    $("#work_1").val(val);
                                }
                                if (key === 'st_sanc_tot') {
                                    st_sanc_tot = val;
                                    $("#price_2").val(val);
                                }
                                if (key === 'st_work_tot') {
                                    st_work_tot = val;
                                    $("#work_2").val(val);
                                }
                                if (key === 'vja_sanc_tot') {
                                    vja_sanc_tot = val;
                                    $("#price_3").val(val);
                                }
                                if (key === 'vja_work_tot') {
                                    vja_work_tot = val;
                                    $("#work_3").val(val);
                                }
                                if (key === 'ntb_sanc_tot') {
                                    ntb_sanc_tot = val;
                                    $("#price_4").val(val);
                                }
                                if (key === 'ntb_work_tot') {
                                    ntb_work_tot = val;
                                    $("#work_4").val(val);
                                }
                                if (key === 'ntc_sanc_tot') {
                                    ntc_sanc_tot = val;
                                    $("#price_5").val(val);
                                }
                                if (key === 'ntc_work_tot') {
                                    ntc_work_tot = val;
                                    $("#work_5").val(val);
                                }
                                if (key === 'ntd_sanc_tot') {
                                    ntd_sanc_tot = val;
                                    $("#price_6").val(val);
                                }
                                if (key === 'ntd_work_tot') {
                                    ntd_work_tot = val;
                                    $("#work_6").val(val);
                                }
                                if (key === 'obc_sanc_tot') {
                                    obc_sanc_tot = val;
                                    $("#price_7").val(val);
                                }
                                if (key === 'obc_work_tot') {
                                    obc_work_tot = val;
                                    $("#work_7").val(val);
                                }
                                if (key === 'sbc_sanc_tot') {
                                    sbc_sanc_tot = val;
                                    $("#price_8").val(val);
                                }
                                if (key === 'sbc_work_tot') {
                                    sbc_work_tot = val;
                                    $("#work_8").val(val);
                                }
                                if (key === 'gen_sanc_tot') {
                                    gen_sanc_tot = val;
                                    $("#price_9").val(val);
                                }
                                if (key === 'gen_work_tot') {
                                    gen_work_tot = val;
                                    $("#work_9").val(val);
                                }

                                if (key === 'asst_flag') {

                                    $("#flg_val").val(val);
//                                    if (val === 'R') {
//                                        alert("This record has been rejected by EO");
//                                    }

//                                    if (val === 'F') {
//                                        alert("Roster has been forwarded to EO.Backlog Data cannot be changed");
//                                        $("input").prop('disabled', true);
//                                        $("#caste_hm_exit").prop('disabled', false);
//                                        $("#roster_cancel").prop('disabled', false);
//                                        
//                                    }
                                    if (val === 'V') {
                                        alert("Roster has been verified to EO.Backlog Data cannot be updated");
                                        $("input").prop('disabled', true);
                                        $("#caste_hm_exit").prop('disabled', false);
                                        $("#roster_cancel").prop('disabled', false);
                                    }
                                }

                            });
                        });
                    });
                });

                var msg = 'No Vacancy';

                if (sc_sanc_tot != '' && sc_work_tot != '') {
                    sc_diff = sc_sanc_tot - sc_work_tot;
                    if (sc_diff <= 0) {
                        $("#vcnt_1").val(msg);
                        document.getElementById("vcnt_1").style.color = "red";
                    }
                    else {
                        $("#vcnt_1").val(sc_diff);
                    }
                }
                if (st_sanc_tot != '' && st_work_tot != '') {
                    st_diff = st_sanc_tot - st_work_tot;
                    if (st_diff <= 0) {
                        $("#vcnt_2").val(msg);
                        document.getElementById("vcnt_2").style.color = "red";

                    }
                    else {
                        $("#vcnt_2").val(st_diff);
                    }
                }
                if (vja_sanc_tot != '' && vja_work_tot != '') {
                    vja_diff = vja_sanc_tot - vja_work_tot;
                    if (vja_diff <= 0) {
                        $("#vcnt_3").val(msg);
                        document.getElementById("vcnt_3").style.color = "red";
                    }
                    else {
                        $("#vcnt_3").val(vja_diff);
                    }
                }
                if (ntb_sanc_tot != '' && ntb_work_tot != '') {
                    ntb_diff = ntb_sanc_tot - ntb_work_tot;
                    if (ntb_diff <= 0) {
                        $("#vcnt_4").val(msg);
                        document.getElementById("vcnt_4").style.color = "red";
                    }
                    else {
                        $("#vcnt_4").val(ntb_diff);
                    }
                }
                if (ntc_sanc_tot != '' && ntc_work_tot != '') {
                    ntc_diff = ntc_sanc_tot - ntc_work_tot;
                    if (ntc_diff <= 0) {
                        $("#vcnt_5").val(msg);
                        document.getElementById("vcnt_5").style.color = "red";
                    }
                    else {
                        $("#vcnt_5").val(ntc_diff);
                    }
                }
                if (ntd_sanc_tot != '' && ntd_work_tot != '') {
                    ntd_diff = ntd_sanc_tot - ntd_work_tot;
                    if (ntd_diff <= 0) {
                        $("#vcnt_6").val(msg);
                        document.getElementById("vcnt_6").style.color = "red";
                    }
                    else {
                        $("#vcnt_6").val(ntd_diff);
                    }
                }
                if (obc_sanc_tot != '' && obc_work_tot != '') {
                    obc_diff = obc_sanc_tot - obc_work_tot;
                    if (obc_diff <= 0) {
                        $("#vcnt_7").val(msg);
                        document.getElementById("vcnt_7").style.color = "red";
                    }
                    else {
                        $("#vcnt_7").val(obc_diff);
                    }
                }
                if (sbc_sanc_tot != '' && sbc_work_tot != '') {
                    sbc_diff = sbc_sanc_tot - sbc_work_tot;
                    if (sbc_diff <= 0) {
                        $("#vcnt_8").val(msg);
                        document.getElementById("vcnt_8").style.color = "red";
                    }
                    else {
                        $("#vcnt_8").val(sbc_diff);
                    }
                }
                if (gen_sanc_tot != '' && gen_work_tot != '') {
                    gen_diff = gen_sanc_tot - gen_work_tot;
                    if (gen_diff <= 0) {
                        $("#vcnt_9").val(msg);
                        document.getElementById("vcnt_9").style.color = "red";
                    }
                    else {
                        $("#vcnt_9").val(gen_diff);
                    }
                }


                $('.price').each(function() {
                    if ($(this).val() != '') {
                        p_sum += Number($(this).val());
                    }
                });
                $('#caste_ctg_saveSancSum').val(p_sum);
                $('.work').each(function() {
                    if ($(this).val() != '') {
                        w_sum += Number($(this).val());
                    }
                });
                $('#caste_ctg_saveWrkSum').val(w_sum);
                $('.vcnt').each(function() {
                    if ($(this).val() != 'No Vacancy') {
                        v_sum += Number($(this).val());
                    }
                });
//                $('#SamayojanVacntSum').val(v_sum);
                $('#caste_ctg_saveVacntSum').val(v_sum);
            }, 'json');
        }

        $("#caste_ctg_submit").click(function() {

            var flag = 1;
            if (!($('input:radio[name=edu_level]:checked').val() == '1' || $('input:radio[name=edu_level]:checked').val() == '2')) {
                flag = 0;
                alert("ERR...Select Education Level");
            } else if (!$('input:radio[name=staff_type]:checked').val() == '1') {
                flag = 0;
                alert("ERR...Select Staff Type");
            } else if ($('#staff_group').val() == '') {
                flag = 0;
                alert("ERR...Select Staff Group");
            }

            if (flag == 0) {
                return false;
            }
        });


    });
</script>


<?php echo $this->Form->create('caste_ctg_save', array('url' => array('controller' => 'Pavitras', 'action' => 'caste_ctg_save'), 'enctype' => 'multipart/form-data')); ?>
<input type="hidden" name="sess_val" value="<?php echo $sansthacode; ?>" id="sess_val"/> 

<table class="table note">
    <tr>
        <td style="padding: 2px 12px;">
            <span class="notehead"><?php echo __('Note :'); ?></span> <?php echo __('Below table shows the data fetched from roster and '
        . 'also categorywise vacancies which are available. This data will be used to create advertisements and for recruitment procedure.');
?>
        </td>

    </tr>
</table>

<div>
    <div>
        <div class="form_content" align="center">
            <div class="map_head" style="min-height:115px;height:auto">
                <h3> Caste Categorywise Backlogs</h3>
                <div class="table-responsive">
                    <table class="table b_table" id="rostertable" style="border-collapse:collapse;">
                        <tr>
                            <td class="col-xs-2" colspan="2">Education Level <span style="float:right;font-weight:bold">:</span></td>
                            <td class="col-xs-4" colspan="4">
                                <input type="radio" name="edu_level" id="tchr_type1" value="1" >
                                <label id="1">Primary</label>

                                <input type="radio" name="edu_level" id="tchr_type2" value="2">
                                <label id="2">Secondary / Higher Secondary</label>
                            </td>

                            <td class="col-xs-2" colspan="2">Select Staff Type <span style="float:right;font-weight:bold">:</span></td>
                            <td class="col-xs-2" colspan="2"> 
                                <input type="radio" name="staff_type" id="tchr_type" value="1" checked>
                                <label id="1">Teaching Staff</label>
                            </td>
                            <td class="col-xs-2" colspan="2"></td>
                        </tr>
                        <tr> 
                            <td class="col-xs-2" colspan="2">Select Staff Group <span style="float:right;font-weight:bold">:</span></td>
                            <td class="col-xs-3" colspan="3">
                                <?php
                                $options = array('3' => 'Teaching');
                                echo $this->Form->input('staff_group', array('options' => $options, 'id' => 'staff_group', 'label' => false, 'style' => 'width: 85%; float: left;'));
                                ?>  
                            </td>
                            <td class="col-xs-4" colspan="4"></td>
                            <td class="col-xs-1"><input  type="submit" name="submit" id="caste_ctg_submit" value="Save" class="btn btn-sm logbutton2"></td>
                                    <!--<input  type="button" name="Delete" id="roster_Delete" value="Delete" class="logbutton2
                                    " style="float:left;margin-right:-2px;">-->
                            <td class="col-xs-1"><input  type="button" name="cancel" id="roster_cancel" value="Cancel" class="btn btn-sm logbutton2"></td>
                            <td class="col-xs-1"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Exit" class="btn btn-sm logbutton2">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="main_table">
                <div class="table-responsive" >
                    <table class="table table_extract" border="0" style="width:80%; background:#fff;margin-top:15px;">
                        <thead>    
                            <tr>
                                <th class="col-xs-1">Sr. No</th>
                                <th class="col-xs-2" colspan="2">Category Name </th>
<!--                                <th class="col-xs-3" colspan="3"> Sanctioned post(As per roster) </th>
                                <th class="col-xs-3" colspan="3">Total Working Saff Approved </th>-->
                                <th class="col-xs-3" colspan="3">Total Vacancies</th>
                               <!-- <th width="33" class="th_grid" style="line-height: 15px;"> <?php //echo __('Class To');                                                                                                                                                                                                     ?> </th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="cursor: pointer;" class=" Subjectdtl" id="sc_tot">                                                                                                                                                                                     
                                <td class="col-xs-1">1</td>
                                <td class="col-xs-2" colspan="2">SC</td>
                                <?php echo $this->Form->input('sc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'price', 'id' => 'price_1')); ?>
<?php echo $this->Form->input('sc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'work', 'id' => 'work_1')); ?>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('sc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'readonly', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_1')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="st_tot">
                                <td class="col-xs-1">2</td>
                                <td class="col-xs-2" colspan="2">ST</td>
                                <?php echo $this->Form->input('st_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'price', 'id' => 'price_2')); ?>
<?php echo $this->Form->input('st_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'work', 'id' => 'work_2')); ?>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('st_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_2', 'readonly')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="vja_tot">
                                <td class="col-xs-1">3</td>
                                <td class="col-xs-2" colspan="2">VJA</td>
                                <?php echo $this->Form->input('vja_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'price', 'id' => 'price_3')); ?>
<?php echo $this->Form->input('vja_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'work', 'id' => 'work_3')); ?>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('vja_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_3', 'readonly')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="ntb_tot">
                                <td class="col-xs-1">4</td>
                                <td class="col-xs-2" colspan="2">NTB</td>
                                <?php echo $this->Form->input('ntb_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'price', 'id' => 'price_4')); ?>
<?php echo $this->Form->input('ntb_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'work', 'id' => 'work_4')); ?>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('ntb_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_4', 'readonly')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="ntc_tot">
                                <td class="col-xs-1">5</td>
                                <td class="col-xs-2" colspan="2">NTC</td>
                                <?php echo $this->Form->input('ntc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'price', 'id' => 'price_5')); ?>
<?php echo $this->Form->input('ntc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'work', 'id' => 'work_5')); ?>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('ntc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_5', 'readonly')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="ntd_tot">
                                <td class="col-xs-1">6</td>
                                <td class="col-xs-2" colspan="2">NTD</td>
                                <?php echo $this->Form->input('ntd_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'price', 'id' => 'price_6')); ?>
<?php echo $this->Form->input('ntd_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'work', 'id' => 'work_6')); ?>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('ntd_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_6', 'readonly')); ?></td>

                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="obc_tot">
                                <td class="col-xs-1">7</td>
                                <td class="col-xs-2" colspan="2">OBC</td>
                                <?php echo $this->Form->input('obc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'price', 'id' => 'price_7')); ?>
<?php echo $this->Form->input('obc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'work', 'id' => 'work_7')); ?>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('obc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_7', 'readonly')); ?></td>

                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="sbc_tot">
                                <td class="col-xs-1">8</td>
                                <td class="col-xs-2" colspan="2">SBC</td>
                                <?php echo $this->Form->input('sbc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'price', 'id' => 'price_8')); ?>
<?php echo $this->Form->input('sbc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'work', 'id' => 'work_8')); ?>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('sbc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_8', 'readonly')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="gen_tot">
                                <td class="col-xs-1">9</td>
                                <td class="col-xs-2" colspan="2">General</td>
                                <?php echo $this->Form->input('gen_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'price', 'id' => 'price_9')); ?>
<?php echo $this->Form->input('gen_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;', 'class' => 'work', 'id' => 'work_9')); ?>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('gen_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_9', 'readonly')); ?></td>
                            </tr>

                            <tr class="Subjectdtl total_col" id="">

                                <td class="col-xs-3" colspan="3" style="color:#fff;font-weight:600">Total</td>
                                <?php echo $this->Form->input('sanc_sum', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;')); ?>
<?php echo $this->Form->input('wrk_sum', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '50', 'style' => 'width:40% !important;  text-align:center;')); ?>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('vacnt_sum', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'readonly')); ?></td>
                            </tr>
                        <input type="hidden" id="flg_val" name="flg_val" value="">
                        </tbody>
                    </table>  
                </div>	
            </div>
        </div>
<?php //echo $this->Form->end();        ?>  
    </div>
</div>
<?php echo $this->Form->end(); ?>

