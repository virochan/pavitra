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
    .input.text > input{width:154px;}
    th{min-height:61px !important;}
    select{width: 238px !important;}
/*    legend{width:16% !important}*/
    .subformhead{border: 1px solid #8492dd;
                 padding: 2px 10px;
                 border-radius: 7px;
                 box-shadow: 0 0 15px #a3b5de inset;}

     .legend_title{width:15%;}
    
</style>

<div>
    <input type="hidden" id="hid_post"/>
    <?php echo $this->Form->create('create_adv', array('url' => array('controller' => 'Pavitras', 'action' => 'advertise_save'), 'enctype' => 'multipart/form-data')); ?>
    <table class="table note">
        <tr>
            <td style="padding: 2px 12px;">
                <span class="notehead"><?php echo __('Note :1. Data for only one Advertisement can be Entered/Modified.</br> 2. Date of Advertisement and Validity of Advertisement will be applicable for all the mentioned posts in the Advertisement.'); ?></span> 
            </td>
        </tr>
    </table>
    <table class="table b_table" style="border-collapse:collapse;width:100%;margin-bottom:0px;">

        <tr>
            <td class="col-xs-3" colspan="3">Advertisement for Education level <span style="float:right;font-weight:bold">:</span></td>
            <td class="col-xs-6" colspan="6">
                <div style="float:left;">
                    <input type="radio" name="edu_level" id="tchr_type1" value="1" >
                    <label id="1">Primary</label>
                </div>
                <div style="float:left;margin-left: 20px;">
                    <input type="radio" name="edu_level" id="tchr_type2" value="2">
                    <label id="2">Secondary / Higher Secondary</label>
                </div>
            </td>
            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="save_advertise"  type="submit" name="submit"  value="<?php echo __('Save'); ?>" /></td>
            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="roster_cancel" type="button" value="<?php echo __('Cancel'); ?>" /></td>
            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="caste_hm_exit" type="button" value="<?php echo __('Exit'); ?>"/></td>

        </tr>
        <tr>
            <td class="col-xs-2" colspan="2">Date of Advertisement <span style="float:right;font-weight:bold">:</span></td>
            <td class="col-xs-2" colspan="2"><?php echo $this->Form->input('dt_adv', array('label' => false, 'autocomplete' => 'off', 'id' => 'dt_adv', 'type' => 'text', 'placeholder' => 'DD/MM/YYYY', 'maxlength' => '30')); ?>   </td>
            <td class="col-xs-2" colspan="2" align="center"><?php echo __('Valid From'); ?><span style="float:right;font-weight:bold">:</span></td>
            <td class="col-xs-2" colspan="2"><?php echo $this->Form->input('dt_adv_frm', array('label' => false, 'autocomplete' => 'off', 'id' => 'dt_adv_frm', 'type' => 'text', 'placeholder' => 'DD/MM/YYYY', 'maxlength' => '30')); ?>   </td>
            <td class="col-xs-2" colspan="2" align="center"><?php echo __('Valid UpTo'); ?><span style="float:right;font-weight:bold">:</span></td>
            <td class="col-xs-2" colspan="2"><?php echo $this->Form->input('dt_adv_to', array('label' => false, 'autocomplete' => 'off', 'id' => 'dt_adv_to', 'type' => 'text', 'placeholder' => 'DD/MM/YYYY', 'maxlength' => '30')); ?>   </td>
        </tr>
    </table>

    <div>
        <fieldset class="myfieldset">
            <legend><div class="legend_title"> Advertisement Details </div></legend>
            <div id='list' style="float:left">
            </div>

          
            <div class="table-responsive fielddata">
                <table class="table b_table" id="fieldtable">
                    <tr> 
                        <td class="col-xs-3" colspan="3"> 
                            <?php echo __('Select Designation'); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <span>
                                <?php
                                echo $this->Form->input('desg_cd', array('options' => $all_desg_opt, 'label' => false, 'empty' => '-- Select Designation --',
                                    'id' => 'desg_cd', 'name' => 'desg_cd'));
                                ?>   
                            </span>
                        </td>

                        <td class="col-xs-3" colspan="3"> 
                            <?php echo __('Select Pay Scale'); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <span>
                                <?php
                                echo $this->Form->input('adv_pay_scale', array('options' => $all_pay_sc, 'label' => false, 'empty' => '-- Select Payscale --',
                                    'id' => 'adv_pay_scale'));
                                ?>   
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="col-xs-3" colspan="3"> 
                            <?php echo __('Select Subject'); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>
<!--                        <td class="col-xs-3" colspan="3">
                            <span>
                                <?php
                                echo $this->Form->input('adv_subj_cd', array('options' => $all_sub_list, 'label' => false, 'empty' => '-- Select Subject --',
                                    'id' => 'adv_subj_cd'));
                                ?>   
                            </span>
                        </td>-->
                        <td class="col-xs-3" colspan="3">
                            <span id='SelSub'>
                                <select>
                                    <option>------Select Subject------</option>
                                </select>
                            </span>
                        </td>

                        <td class="col-xs-3" colspan="3"> 
                            <?php echo __('Select Medium '); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <span>
                                <?php
                                if(count($all_med_list)=='1'){
                                echo $this->Form->input('adv_med', array('options' => $all_med_list, 'label' => false, 
                                    'id' => 'adv_med'));
                                }
                                else{
                                   echo $this->Form->input('adv_med', array('options' => $all_med_list, 'label' => false, 'empty' => '-----Select Medium-----',
                                    'id' => 'adv_med'));  
                                }
//                                echo $this->Form->input('get_sanstha_minority_type_hidden', array('id' => 'get_sanstha_minority_type_hidden', 'value' => '', 'type' => 'hidden', 'readonly' => 'readonly', 'maxlength' => '1'));
                                ?>   
                            </span>
                        </td>
                    </tr>

                    <tr> 
                        <td class="col-xs-3" colspan="3"> 
                            <?php echo __('Min.Acad Qual Level '); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <span>
                                <?php
                                echo $this->Form->input('edu_qual', array('options' => $all_edu_level, 'label' => false, 'empty' => '-- Select Qualification Level--',
                                    'id' => 'edu_qual'));
//                                echo $this->Form->input('get_sanstha_minority_type_hidden', array('id' => 'get_sanstha_minority_type_hidden', 'value' => '', 'type' => 'hidden', 'readonly' => 'readonly', 'maxlength' => '1'));
                                ?>   

                            </span>
                        </td>
                        
                        <td class="col-xs-3" colspan="3">
                            <?php echo __('Min. Academic Qualification '); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>

                        <td class="col-xs-3" colspan="3">
                            <span id='AcadQual'>
                                <select>
                                    <option>------Select Qualification------</option>
                                </select>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="col-xs-3" colspan="3">
                            <?php echo __('Min. Prof Qual Level '); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <span>
                                <?php
                                echo $this->Form->input('prof_qual_lvl', array('options' => $all_prof_qual, 'label' => false, 'empty' => '-- Select Qualification Level --',
                                    'id' => 'prof_qual_lvl'));
//                                echo $this->Form->input('get_sanstha_minority_type_hidden', array('id' => 'get_sanstha_minority_type_hidden', 'value' => '', 'type' => 'hidden', 'readonly' => 'readonly', 'maxlength' => '1'));
                                ?>   
                            </span>
                        </td>
                      
                        <td class="col-xs-3" colspan="3">
                            <?php echo __('Min. Professional Qualification '); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>

                        <td class="col-xs-3" colspan="3">
                            <span id='ProfQual'>
                                <select>
                                    <option>------Select Qualification------</option>
                                </select>
                            </span>
                        </td>


                     
                    </tr>

                    <tr>
                        <td class="col-xs-3" colspan="3"> 
                            <?php echo __('No. of Posts'); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php echo $this->Form->input('sanc_post', array('label' => false, 'class' => 'num', 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '2', 'style' => 'width:50% !important; text-align:center;', 'id' => 'sanc_post')); ?>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php echo __('Aid Type'); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <span>
                                <?php
                                echo $this->Form->input('aid_type', array('options' => $all_aid_type, 'label' => false, 'empty' => '--Select Aid Type--',
                                    'id' => 'aid_type'));
//                                echo $this->Form->input('get_sanstha_minority_type_hidden', array('id' => 'get_sanstha_minority_type_hidden', 'value' => '', 'type' => 'hidden', 'readonly' => 'readonly', 'maxlength' => '1'));
                                ?>   
                            </span>
                        </td>
                    </tr>
                    <tr id="work_type">
                        <td class="col-xs-3 " colspan="3">Work Type<span style="float:right;font-weight:bold">:</span></td>
                        <td class="col-xs-3 " colspan="3">
                            <div style="float:left;">
                                <input type="radio" name="work_type" id="work_type2" value="2" checked="checked">
                                <label id="2">Full Time</label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="work_type" id="work_type1" value="1" >
                                <label id="1">Part Time</label>
                            </div>
                        </td>
  
                        <?php echo $this->Form->input('mod_upd', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '2', 'style' => 'width:25% !important; text-align:left;', 'class' => 'num', 'id' => 'mod_upd')); ?>
                        <?php echo $this->Form->input('row_id', array('label' => false, 'autocomplete' => 'off', 'type' => 'hidden', 'maxlength' => '2', 'style' => 'width:25% !important; text-align:left;', 'class' => 'num', 'id' => 'row_id')); ?>    
                    </tr>
                </table>
            </div>
        </fieldset>
    </div>
    <?php echo $this->Form->end(); ?>
</div>


<script>
    $(document).ready(function () {
        $('#adv_create_detail').hide();
        $('#work_type').hide();
        var numpattern = /^[0-9]*$/;
        /*Check if numeric for post, min & max age-----START*/
        $("#sanc_post").change(function () {
            if (numpattern.test($(this).val()) == false) {
                alert("ERR...Enter digits only ...");
                $(this).val('');
            }
        });
        
        $("#roster_cancel").click(function () {
            location.reload();
        });
 
        /*Check if numeric for post, min & max age-----END*/

        /*Dates Validation------START*/
        var todays_date = new Date();

        $("#dt_adv").change(function () {
//                var advertise_date = $("#dt_adv").datepicker("getDate");
            var advertise_date = $(this).val();
            var date = advertise_date.substring(0, 2);
            var month = advertise_date.substring(3, 5);
            var year = advertise_date.substring(6, 10);
            date = year + '-' + month + '-' + date;
            var advertise_dt = new Date(date);
            var d = new Date("2012-05-31");
            if (d > advertise_dt) {
                alert("Err....Entered date can not be less than 31/05/2012");
                $(this).val('');
            }

//            if (advertise_dt > todays_date) {
//                alert("Err....Entered date cannot be Greater than today's date.")
//                $(this).val('');
//            }
        });

        $("#dt_adv_frm").change(function () {
            var advertise_date = $("#dt_adv").datepicker("getDate");
            var advertise_frm_date = $(this).val();
            var date = advertise_frm_date.substring(0, 2);
            var month = advertise_frm_date.substring(3, 5);
            var year = advertise_frm_date.substring(6, 10);
            date = year + '-' + month + '-' + date;
            var advertise_frm_dt = new Date(date);
            var d = new Date("2012-05-31");
            if (d > advertise_frm_dt) {
                alert("Err....Entered date can not be less than 31/05/2012");
                $(this).val('');
            }

//            if (advertise_frm_dt > todays_date) {
//                alert("Err....Entered date cannot be Greater than today's date.")
//                $(this).val('');
//            }

            if (advertise_frm_dt < advertise_date) {
                alert("Err...Advertisement start date should be greater than or equal to creation date..")
                $(this).val('');
            }
        });


        $("#dt_adv_to").change(function () {
            var advertise_date = $("#dt_adv").datepicker("getDate");
            var advertise_frm_date = $("#dt_adv_frm").datepicker("getDate");

            var advertise_to_date = $(this).val();
            var date = advertise_to_date.substring(0, 2);
            var month = advertise_to_date.substring(3, 5);
            var year = advertise_to_date.substring(6, 10);
            date = year + '-' + month + '-' + date;
            var advertise_to_dt = new Date(date);
            var d = new Date("2012-05-31");
            if (d > advertise_to_dt) {
                alert("Err....Entered date can not be less than 31/05/2012");
                $(this).val('');
            }

//                if (advertise_to_dt > todays_date) {
//                    alert("Err....Entered date cannot be Greater than today's date.")
//                    $(this).val('');
//                }

            if (advertise_to_dt < advertise_date) {
                alert("Err...Advertisement Valid till date should be greater than or equal to creation date..")
                $(this).val('');
            }

            if (advertise_to_dt < advertise_frm_date) {
                alert("Err...Advertisement Valid till date should be greater than or equal to Start date..")
                $(this).val('');
            }
        });

        /*Dates Validation------END*/

        $(function () {
            $("#dt_adv").datepicker({
                showOn: "button",
                buttonImage: "../img/calender.gif",
                buttonImageOnly: true,
                buttonText: "Select date"
            });
        });
        $(function () {
            $("#dt_adv_frm").datepicker({
                showOn: "button",
                buttonImage: "../img/calender.gif",
                buttonImageOnly: true,
                buttonText: "Select date"
            });
        });
        $(function () {
            $("#dt_adv_to").datepicker({
                showOn: "button",
                buttonImage: "../img/calender.gif",
                buttonImageOnly: true,
                buttonText: "Select date"
            });
        });
        $("#caste_hm_exit").click(function () {
            var url = 'sanstha';
            $(location).attr('href', url);
        });


//         $('.edu_level').click(function () {
//             alert($('input:radio[name=edu_level]:checked').val());
//         });

        $("input[name=edu_level]").on("change", function () {
            $('#adv_create_detail').show();
            $('#desg_cd').val('');
            var ac = $('input:radio[name=edu_level]:checked').val();
            if(ac=='1'){
                $("#tchr_type1").prop('disabled', false);
                $("#tchr_type2").prop('disabled', true);
            }
            else if(ac=='2'){
                $("#tchr_type1").prop('disabled', true);
                $("#tchr_type2").prop('disabled', false);
            }
            if (ac == '2') {
                $("#desg_cd option[value='4']").show();
                $("#desg_cd option[value='21']").show();
                $("#desg_cd option[value='22']").show();
            }
            else if (ac == '1') {
                $("#desg_cd option[value='4']").hide();
                $("#desg_cd option[value='21']").hide();
                $("#desg_cd option[value='22']").hide();
            }
            jQuery.post('CheckRosterStatus', {ac: ac}, function(data) {
//                   alert(data);
                    if(data.trim()!='V'){
                        alert('Roster for this sanstha has not been verified yet.Advertisement cannot be posted');
                        $("input").prop('disabled', true);
                        $("#caste_hm_exit").prop('disabled', false);
                        $("#roster_cancel").prop('disabled', false);
                    }
                    else{
                        jQuery.post('DispGridData', {ac: ac}, function(data) {
                         
                            $('#list').html(data);
                            
                            var val1=$('#adv_dt').val()
                            if(val1!=''){
                                var arr_val = val1.split(' ');
                                var arr = arr_val[0].split('-');
                                var date1 = arr[2] + "/" + arr[1] + "/" + arr[0];
                                $("#dt_adv").val(date1);
                            }
                            
                            var val2=$('#adv_st_dt').val()
                            if(val2!=''){
                                var arr_val = val2.split(' ');
                                var arr = arr_val[0].split('-');
                                var date2 = arr[2] + "/" + arr[1] + "/" + arr[0];
                                $("#dt_adv_frm").val(date2);
                            }
                            
                            var val3=$('#adv_end_dt').val()
                            if(val3!=''){
                                var arr_val = val3.split(' ');
                                var arr = arr_val[0].split('-');
                                var date3 = arr[2] + "/" + arr[1] + "/" + arr[0];
                                $("#dt_adv_to").val(date3);
                            }
                            
                        });
                    }
            });
            
            
      

        });
        
  
        $('#desg_cd').change(function () {
            var tot_bcklg=  $('#tot_bcklg').val();
            var post_count = $('#post_count').val();
//            $(".del").css('pointer-events', 'none'); //disable delete link
            
            var desg_cd = $('#desg_cd').val();
           
            jQuery.post('SelectSubject', {desg_cd: desg_cd}, function(data) {
                
                    $('#SelSub').html(data);
            });
            
            if(desg_cd=='22'){
                $('#work_type').show();
            }
            else if(desg_cd!='22'){
                 $('#work_type').hide();
            }
            if (desg_cd == '4') {
                $("#adv_pay_scale option[value='1014']").show();
                $("#adv_pay_scale option[value='1011']").hide();
                $("#adv_pay_scale option[value='1012']").hide();
                $("#adv_pay_scale option[value='1013']").hide();
                $("#adv_pay_scale option[value='1015']").hide();
                $("#edu_qual option[value='2']").hide();
                $("#edu_qual option[value='3']").hide();
                
            }
            else if (desg_cd == '5') {
                $("#adv_pay_scale option[value='1012']").show();
                $("#adv_pay_scale option[value='1013']").show();
                $("#adv_pay_scale option[value='1011']").hide();
                $("#adv_pay_scale option[value='1014']").hide();
                $("#adv_pay_scale option[value='1015']").hide();
                $("#edu_qual option[value='2']").hide();
                $("#edu_qual option[value='3']").hide();
            }
            else if (desg_cd == '7') {
                $("#adv_pay_scale option[value='1011']").show();
                $("#adv_pay_scale option[value='1013']").hide();
                $("#adv_pay_scale option[value='1012']").hide();
                $("#adv_pay_scale option[value='1014']").hide();
                $("#adv_pay_scale option[value='1015']").hide();
                $("#edu_qual option[value='2']").show();
                $("#edu_qual option[value='3']").show();
                $("#edu_qual option[value='4']").show();
                $("#edu_qual option[value='5']").show();
            }
            else{
                $("#adv_pay_scale option[value='1015']").show();
                $("#adv_pay_scale option[value='1011']").hide();
                $("#adv_pay_scale option[value='1013']").hide();
                $("#adv_pay_scale option[value='1012']").hide();
                $("#adv_pay_scale option[value='1014']").hide();
                $("#edu_qual option[value='2']").hide();
                $("#edu_qual option[value='3']").hide();
                $("#edu_qual option[value='4']").hide();
            }
            
            var x = document.getElementById("tchr_type1").checked;
            var y = document.getElementById("tchr_type2").checked;

            if ((x == false) && (y == false)) {
                alert('Please Select Education Level');
                $('#desg_cd').val('');
                return false;
            }

            else {
                if (desg_cd == '21') {
                    $('#work_type1').attr('disabled', true);
                    $('#work_type2').attr('disabled', false);
                    document.getElementById("work_type2").checked = true;
                }
                else if (desg_cd == '22') {
                    $('#work_type2').attr('disabled', true);
                    $('#work_type1').attr('disabled', false);
                    document.getElementById("work_type1").checked = true;
                }
                else{
                    $('#work_type1').attr('disabled', true);
                    $('#work_type2').attr('disabled', false);
                    document.getElementById("work_type2").checked = true;
                    
                }
            }
            
            if(post_count==tot_bcklg){
                alert('You have exceeded the limit of posts available according to the backlog. No more advertisements can be posted');
//                $("input").prop('disabled', true);
                $("#roster_cancel").prop('disabled', false);
                $("#caste_hm_exit").prop('disabled', false);
//                $("#btn_up_d").prop('disabled', true);
            }
    
        });

        $('#adv_pay_scale').change(function () {
            var desg_cd = $('#desg_cd').val();
            if (desg_cd=='') {
                alert('Please Select Designation');
                $('#adv_pay_scale').val('');
                return false;
            }
        });
        
        $('#edu_qual').change(function () {
            var edu_lvl=$('#edu_qual').val();
            jQuery.post('SelectAcadQual', {edu_lvl: edu_lvl}, function(data) {
//                alert(data);
                    $('#AcadQual').html(data);
                });
        });
        
        $('#prof_qual_lvl').change(function () {
            var prof_lvl=$('#prof_qual_lvl').val();
            jQuery.post('SelectProfQual', {prof_lvl: prof_lvl}, function(data) {
//                alert(data);
                    $('#ProfQual').html(data);
                });
        });
        
        $("#sanc_post").change(function () {
            var sanc = $('#sanc_post').val();
            if(sanc=='0'){
                alert('Post cannot be equal to 0');
                return false;
            }
            var tot_bcklg=  $('#tot_bcklg').val();
           
            var post_filled= $('#post_count').val();
            if(post_filled==''){
                post_filled= '0';
            }
            var hid_post= $('#hid_post').val();
            var sum = (parseInt(sanc)+parseInt(post_filled));
            if(hid_post==''){
                
                if(sum>tot_bcklg){
                    alert('Posts Available cannot exceede backlog total of '+tot_bcklg);
                    $(this).val('');
                    return false;
                }
            }
            else{
                sum=parseInt(post_filled)-parseInt(hid_post);
//                alert(sum);
                sum=parseInt(sum)+parseInt(sanc);
//                alert(sum);
                   if(sum>tot_bcklg){
                    alert('Posts Available cannot exceede backlog total of '+tot_bcklg);
                    $(this).val('');
                    return false;
                }
            }
            
        });
        
//        save_advertise
        $("#save_advertise").click(function () {
            var flag=1;
            var x = document.getElementById("tchr_type1").checked;
            var y = document.getElementById("tchr_type2").checked;
            if ((x == false) && (y == false)) {
                alert('Please Select Education Level');
                return false;
            }
            
            var adv_dt=$('#dt_adv').val();
            if (adv_dt == '') {
                alert("ERR...Select Advertisement Date");
                return false;
            }
            
            if ($('#dt_adv_frm').val() == '') {
                alert("ERR...Select Start Date");
                return false;
            }
            
            if ($('#dt_adv_to').val() == '') {
                alert("ERR...Select Valid upto Date");
                return false;
            }
            
            var desg_cd = $('#desg_cd').val();
            if(desg_cd==''){
                alert('Please Select Designation');
                return false;
            }
            
            var pay_scale=$('#adv_pay_scale').val();
            if(pay_scale==''){
                alert('Please Select Pay Scale');
                return false;
            }
            
            var subj_cd = $('#adv_subj_cd').val();
            if(subj_cd==''){
                alert('Please Select Subject');
                return false;
            }
            
            var med_cd = $('#adv_med').val();
            if(med_cd==''){
                alert('Please Select Medium');
                return false;
            }

            var edu_ql_cd = $('#edu_qual').val();
            if(edu_ql_cd==''){
                alert('Please Select Educational qualification');
                return false;
            }
            
            var acad_cd = $('#acad_qual').val();
            if(acad_cd==''){
                alert('Please Select Academic qualification');
                return false;
            }
            
            var prof_cd = $('#prof_qual').val();
            if(prof_cd==''){
                alert('Please Select Professional qualification');
                return false;
            }
            

            
            var no_sanc_post = $('#sanc_post').val();
            if(no_sanc_post==''){
                alert('Please Enter No.of Posts Sanctioned');
                return false;
            }
            
            if(no_sanc_post=='0'){
                 alert('No.of Posts Sanctioned cannot be 0');
                return false; 
            }
            
            var aid_type_aid = $('#aid_type').val();
            if(aid_type_aid==''){
                alert('Please Select Aid Type');
                return false;
            }
            
            var ft = document.getElementById("work_type2").checked;
            var pt = document.getElementById("work_type1").checked;
            if ((ft == false) && (pt == false)) {
                alert('Please Select Work Type');
                return false;
            }
            
    
            
//            var gb = document.getElementById("gen_pref_b").checked;
//            var gf = document.getElementById("gen_pref_f").checked;
//            if ((gb == false) && (gf == false)) {
//                alert('Please Select Prefered Gender');
//                return false;
//            }
            
        });
        

    });
    function update_row(id,edu_lvl,prof_lvl,desg_cd)
        {
           var flag = 'UPD_'+id;
           
            
            jQuery.post('SelectSubject', {desg_cd: desg_cd}, function(data) {
                    $('#SelSub').html(data);
            });
           
            jQuery.post('SelectAcadQual', {edu_lvl: edu_lvl}, function(data) {
//                alert(data);
                    $('#AcadQual').html(data);
                });
           
            jQuery.post('SelectProfQual', {prof_lvl: prof_lvl}, function(data) {
//                alert(data);
                    $('#ProfQual').html(data);
                });
 
                jQuery.post(window.webroot + 'Pavitras/modify_advertise', {id: id}, function (data) {
                    
                    $.each(data, function (key, val) {
                        $.each(val, function (key, val) {
                            $.each(val, function (key, val) {
                                if(key === 'id'){
                                    $('#row_id').val(val);
                                }
                                
                                if (key === 'pv_advertise_dt') {
                                    var arr_val = val.split(' ');
                                    var arr = arr_val[0].split('-');
                                    var date1 = arr[2] + "/" + arr[1] + "/" + arr[0];
                                    $("#dt_adv").val(date1);
                                } 
                                if (key === 'pv_advertise_frm_dt') {
                                    var arr_val = val.split(' ');
                                    var arr = arr_val[0].split('-');
                                    var date2 = arr[2] + "/" + arr[1] + "/" + arr[0];
                                    $("#dt_adv_frm").val(date2);
                                }
                                 if (key === 'pv_advertise_to_dt') {
                                    var arr_val = val.split(' ');
                                    var arr = arr_val[0].split('-');
                                    var date3 = arr[2] + "/" + arr[1] + "/" + arr[0];
                                    $("#dt_adv_to").val(date3);
                                }
                                 
                                if (key === 'pv_desg_cd') {
                                     $('#desg_cd').val(val);
                                     $('#mod_upd').val(flag);
                                }
                                
                                if (key === 'pv_pay_scale_cd') {
                                     $('#adv_pay_scale').val(val);
                                   
                                }
                                
                                if (key === 'pv_subject_cd') {
                                    var sub = $.trim(val);
                                     $('#adv_subj_cd').val(sub);
                                }
                                if (key === 'pv_medium_id') {
                                    var med=$.trim(val);
                                     $('#adv_med').val(med);
                                }
                                if (key==='pv_acad_lvl'){
                                    var alvl = $.trim(val);
                                   $('#edu_qual').val(alvl); 
                                }
                                if (key === 'pv_acad_qual') {
                                    
                                    var aql=$.trim(val);
                                     $('#acad_qual').val(aql);
                                }
                                
                                 if (key==='pv_prof_lvl'){
                                      var plvl = $.trim(val);
                                   $('#prof_qual_lvl').val(plvl); 
                                }
                                
                                if (key === 'pv_prof_qual') {
                                    var pql=$.trim(val);
                                     $('#prof_qual').val(pql);
                                }
                       
                                if (key === 'pv_no_of_post') {
                                    $('#sanc_post').val(val);
                                    $('#hid_post').val(val); 
                                }
                                if (key === 'pv_aid_type') {
                                    var aid=$.trim(val);
                                     $('#aid_type').val(aid);
                                }
                                if (key === 'pv_work_type') {
                                   
                                    if(val=='1'){
                                        document.getElementById("work_type1").checked = true;
                                        $('#work_type2').attr('disabled', true);
                                    }
                                    else{
                                        document.getElementById("work_type2").checked = true;
                                        $('#work_type1').attr('disabled', true);
                                    }
//                                    $('#work_type option[value=' + $.trim(val) + ']').attr("selected", "selected");
                                }
                          
//                                if (key === 'pv_gender_pref') {
//                                    var gen=$.trim(val);
//                                    if(gen=='1'){
//                                        document.getElementById("gen_pref_b").checked = true;
//                                    }
//                                    else{
//                                        document.getElementById("gen_pref_f").checked = true;
//                                    }
////                                    $('#gen_pref option[value=' + $.trim(val) + ']').attr("selected", "selected");
//                                }
                            });
                        });
                    });
               },'json');
           
        }
        function delete_row(id)
        {
            
            var retVal = confirm("Do you want to continue ?");
            if (retVal == true)
            {  
                $.ajax({type: "POST",url: "<?php echo $this->webroot; ?>Pavitras/delete_advertise",data: {'id': id},
                    success: function(data) {
                      
                       
                            alert('Record Deleted Successfully...!');
                            window.location.reload();
                    }
                });
            }
            else
            {
                return false;
            }
        }
</script>
