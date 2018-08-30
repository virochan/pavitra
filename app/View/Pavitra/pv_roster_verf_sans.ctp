<style>
    .td_grid, .th_grid {
        padding:4px !important;
        border: 1px solid #A5BFDE !important;
        text-align: center;
    }

    #eoroster
    {
        border-collapse:collapse;

    }
    #eoroster td
    {
        padding:0.3%;
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
    .total_col{cursor:pointer;background: #5F7CB7;border-top: 3px solid #215799;border-bottom: 2px solid #215799;}
    h3{margin-bottom: 0px;}
    .table{margin-bottom:0px;}
    label{font-weight:500 !important}
    .b_table tr td{border-top:none !important;}
</style>

<script type="text/javascript">
    function div_show() {
        var a = $("#popup").attr('src');
        $("#overlay_srch").show();
        $("#overlay_srch").html("<img id='img' height='25' width='50' src=" + a + "/>");
        $("#img_close").show();
    }
    function div_hide() {
        $("#overlay_srch").hide();
        $("#img_close").hide();

    }
</script>	          
<?php echo $this->Form->create('pv_rost_verf', array('url' => array('controller' => 'Pavitras', 'action' => 'verify_roster'))); ?>

<input type="hidden" name="sess_val" value="<?php echo $user_id; ?>" id="sess_val"/> 
<?php echo $this->Form->input('uplodimg', array('label' => false, 'type' => 'hidden', 'value' => '', 'name' => 'uplodimg')); ?>
<?php echo $this->Form->input('asst_flag', array('type' => 'hidden', 'value' => '')); ?>
<?php
if (!empty($roster_edn_level)) {
    echo $this->Form->input('edu_lvl', array('type' => 'hidden', 'value' => $roster_edn_level, 'id' => 'edu_lvl'));
}
?>
<?php echo $this->Form->input('json_flag', array('type' => 'hidden', 'value' => '')); ?>

<div style="height:595px;width:100%;padding:5px;clear:both;">
    <div class="form_content" align="center">
        <div class="map_head" style="min-height:115px;height:auto">
            <h3> Verification of Roster entry for Sanstha</h3>
            <table class="table b_table" width="100%" id="eoroster">
                <tr>
                    <td class="col-xs-2" colspan="2" align="center">Select Sanstha <span style="float:right;font-weight:bold">:</span> </td>
                    <td class="col-xs-8" colspan="8"> 
                        <?php
                        echo $this->Form->input('sanstha', array('options' => $array_sanstha, 'id' => 'sanstha', 'label' => false, 'empty' => '-- Select Sanstha--', 'style' => 'width:100%; float: left;'));
                        ?>    
                    </td>
                    <td class="col-xs-2" colspan="2"></td>
                    
                </tr>
                <tr>
                    <td class="col-xs-2" colspan="2" align="center">Education Level <span style="float:right;font-weight:bold">:</span></td>
                    <td class="col-xs-4" colspan="4">
                        
                            <input type="radio" name="edu_level" id="tchr_type1" value="1" >
                            <label id="1">Primary</label>
                      
                            <input type="radio" name="edu_level" id="tchr_type2" value="2">
                            <label id="2">Secondary / Higher Secondary</label>
                       
                    </td>
                    <td class="col-xs-2" colspan="2">Select Staff  <span style="float:right;font-weight:bold">:</span></td>
                    <td class="col-xs-2" colspan="2">
                        <?php
                        $options = array('3' => 'Teaching');
                        echo $this->Form->input('staff_group', array('options' => $options, 'id' => 'staff_group', 'label' => false, 'empty' => '-- Select Staff--', 'style' => 'width:100%; float: left;'));
                        ?>   
                    </td>
                    <td class="col-xs-2" colspan="2"></td>
                </tr>
                <tr>
                    <td class="col-xs-2" colspan="2" align="center"> Select Staff Type <span style="float:right;font-weight:bold">:</span></td>
                    <td class="col-xs-4" colspan="4"> <input type="radio" name="staff_type" id="tchr_type" value="1" checked>
                        <label id="1">Teaching Staff</label></td>
                    <td class="col-xs-2" colspan="2">Roster Data as on Date <span style="float:right;font-weight:bold">:</span> </td>
                    <td class="col-xs-2" colspan="2"><?php echo $this->Form->input('rst_last_upd_dt', array('label' => false, 'autocomplete' => 'off', 'id' => 'datepicker', 'type' => 'text', 'placeholder' => 'DD/MM/YYYY', 'style' => 'margin-right:3px;width:122px;', 'maxlength' => '30')); ?>   </td>
                   
                    <td class="col-xs-1"> 
                        <input  type="submit" name="submit" id="roster_submit" value="Save" class="btn btn-sm logbutton2"></td>
                      <td class="col-xs-1"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Exit" class="btn btn-sm logbutton2">
                       
                    </td>

                </tr>

            </table> 

        </div>
        <div style="margin-top:8px !important; width:100%;height:30px;">

            <div style="float:right;width:40%;">
                <table id="resonid" width="99%">
                    <tr>
                        <td width="33%" style="padding-left:0%;">
                            <?php echo __('Reason for Rejection :') ?>   
                        </td>
                        <td width="75%">
<?php echo $this->Form->input('roster_remarks', array('label' => false, 'maxlength' => '20', 'type' => 'text', 'style' => 'width:100% !important; text-transform:capitalize;', 'value' => '')); ?>
                        </td>
                    </tr>
                </table>
            </div>   
            <div style="float:right;width:20%;">
                <table width="82%" border="0" style="border-collapse:collapse;margin-left:0%;">

                    <tr>
                        <td width="8%">
                            <span class="clus_btn">
                                Reject &nbsp;<input type="checkbox"  id="selectrjct" value="R" name="select"/>
                            </span>
                        </td>

                        <td width="8%">
                            <span class="clus_btn">
                                Verify &nbsp;<input type="checkbox"  id="selectvfy" value="V" name="select"/> 
                            </span>
                        </td>
                    </tr>
                </table>
            </div>      			 	 
        </div>


        <div style="margin-top:5px;clear:both;" id="main_table">
            <table class="table table_grid" border="0" style="width:75%;background:#fff;">
                <tr  class="">
                    <td class="th_grid col-xs-1"><div align="center" class="clorclas">Sr. No</div></td>
                    <td class="th_grid col-xs-2" colspan="2"><div align="center" class="clorclas">Category Name</div> </td>
                    <td class="th_grid col-xs-3" colspan="3"><div align="center" class="clorclas">Sanctioned post(As per roster)</div> </td>
                    <td class="th_grid col-xs-3" colspan="3"><div align="center" class="clorclas">Total Working Saff Approved</div></td>
                    <td class="th_grid col-xs-3" colspan="3"><div align="center" class="clorclas">Total Vacant Staff</div></td>
                </tr>

                <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                    ?>">
                    <td class="td_grid col-xs-1">1</td>
                    <td class="td_grid col-xs-2" colspan="2">SC</td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('sc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_1')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('sc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_1')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('sc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_1')); ?></td>
                </tr>

                <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                    ?>">
                    <td class="td_grid col-xs-1">2</td>
                    <td class="td_grid col-xs-2" colspan="2">ST</td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('st_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_2')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('st_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_2')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('st_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_2')); ?></td>
                </tr>

                <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                             ?>">
                    <td   class="td_grid col-xs-1">3</td>
                    <td class="td_grid col-xs-2" colspan="2">VJA</td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('vja_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_3')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('vja_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_3')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('vja_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_3')); ?></td>
                </tr>

                <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                             ?>">
                    <td   class="td_grid col-xs-1">4</td>
                    <td class="td_grid col-xs-2" colspan="2">NTB</td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('ntb_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_4')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('ntb_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_4')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('ntb_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_4')); ?></td>
                </tr>

                <tr style="cursor: pointer;" class="Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                             ?>">
                    <td   class="td_grid col-xs-1">5</td>
                    <td class="td_grid col-xs-2" colspan="2">NTC</td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('ntc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_5')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('ntc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_5')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('ntc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_5')); ?></td>
                </tr>

                <tr style="cursor: pointer;" class="Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                             ?>">
                    <td class="td_grid col-xs-1">6</td>
                    <td class="td_grid col-xs-2" colspan="2">NTD</td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('ntd_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_6')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('ntd_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_6')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('ntd_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_6')); ?></td>

                </tr>

                <tr style="cursor: pointer;" class="Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                             ?>">
                    <td   class="td_grid col-xs-1">7</td>
                    <td class="td_grid col-xs-2" colspan="2">OBC</td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('obc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_7')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('obc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_7')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('obc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_7')); ?></td>

                </tr>

                <tr style="cursor: pointer;" class="Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                             ?>">
                    <td   class="td_grid col-xs-1">8</td>
                    <td class="td_grid col-xs-2" colspan="2">SBC</td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('sbc_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_8')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('sbc_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_8')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('sbc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_8')); ?></td>
                </tr>

                <tr style="cursor: pointer;" class="tr_grid Subjectdtl" id="<?php //echo $post['SubjectTaught']['id'];                                                             ?>">
                    <td class="td_grid col-xs-1">9</td>
                    <td class="td_grid col-xs-2" colspan="2">GENERAL</td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('gen_sanc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'price', 'id' => 'price_9')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('gen_work_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'work', 'id' => 'work_9')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('gen_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;', 'class' => 'vcnt', 'id' => 'vcnt_9')); ?></td>
                </tr>

                <tr class="total_col" id="<?php //echo $post['SubjectTaught']['id'];                                                            ?>">
                    
                    <td class="td_grid col-xs-3" colspan="3"style="color:#fff; font-weight:600;">Total</td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('sanc_sum', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('wrk_sum', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;')); ?></td>
                    <td class="td_grid col-xs-3" colspan="3"><?php echo $this->Form->input('vacnt_sum', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:59% !important; text-transform: uppercase;text-align:center;')); ?></td>
                </tr>
            </table>  
        </div>	



        <div style="width: 50% ! important; padding-left: 7% ! important;" class="map_container" >
            <div id="view" style="float:left;padding-top:8px;">View Rostser File : &nbsp;</div>
            <div  id="mycontainer1">
            </div>   

        </div>


    </div>
    <div class="overlay_srch" id="overlay_srch">
        <div id="search_box">


        </div>
    </div>
    <div id="img_close">
        <a id="popupBoxClose"><img style="cursor: pointer; position: absolute; right: 24%; top: 18%;" src="../img/close.png" id="exit_search" height="40" width="40" onclick='div_hide()'></a>
    </div>

</div>


<?php echo $this->Form->end(); ?>
<script>
    $(document).ready(function () {
        $("#img_close").hide();
//        $(function() {
//            $("#datepicker").datepicker({
//                showOn: "button",
//                buttonImage: "../img/calender.gif",
//                buttonImageOnly: true,
//                buttonText: "Select date"
//            });
//        });

        $('#main_table').hide();
        var edu_lvl = $('#edu_lvl').val();
        if (edu_lvl == 'P') {
            $('#tchr_type2').attr('disabled', true);

        }
        else {
            $('#tchr_type1').attr('disabled', true);
        }
        $('input:radio[id=tchr_type][value=2]').attr('disabled', true);
        $("#caste_teaching").click(function () {
            $('input:radio[id=tchr_type][value=1]').prop('checked', true);
        });
        $('#view').hide();
        $('#map_container').hide();
        $('#datepicker').attr('readonly', 'readonly');
        $('.price').attr('readonly', 'readonly');
        $('.work').attr('readonly', 'readonly');
        $('.vcnt').attr('readonly', 'readonly');
        $('#pv_rost_verfSancSum').attr('readonly', 'readonly');
        $('#pv_rost_verfWrkSum').attr('readonly', 'readonly');
        $('#pv_rost_verfVacntSum').attr('readonly', 'readonly');
        $('#resonid').hide();
        var numpattern = /^[0-9]*$/;
        var sess_val = $('#user_id').val();
        $("#caste_hm_exit").click(function () {
            var url = 'eduofficer';
            $(location).attr('href', url);
        });
        $("#staff_group").change(function () {
            $('#main_table').show();
            json_data();
        });
        function json_data() {
            var edu_level = '';
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
            var asst_flag = '';
            var roster_remarks = '';
            var p_sum = 0;
            var w_sum = 0;
            var v_sum = 0;
            var session_user_id = $('#sanstha').val();
            tchr_type = $('#tchr_type').val();
            staff_group = $('#staff_group').val();
            edu_level = $('input:radio[name=edu_level]:checked').val();
            jQuery.post(window.webroot + 'Pavitras/get_roster_verf_data', {session_user_id: session_user_id, staff_group: staff_group,
                roster_edn_level: edu_level, tchr_type: tchr_type}, function (data) {

                $.each(data, function (key, val) {
                    $.each(val, function (key, val) {
                        $.each(val, function (key, val) {
                            $.each(val, function (key, val) {

                                if (key === 'roster_edn_level') {
//                                    alert(val);
                                    if (val == 'P') {
                                        $('#tchr_type1').attr('checked', 'true');
                                    }
                                    if (val == 'S') {
                                        $('#tchr_type2').attr('checked', 'true');
                                    }
                                }
                                if (key === 'tchr_type') {
                                    if (val == '1') {
                                        $('#tchr_type').attr('checked', 'true');
                                    } else {
                                    }
                                }
                                if (key === 'asst_flag') {
                                    asst_flag = val;
                                }
                                if (key === 'staff_group') {
                                    $('#staff_group option[value=' + $.trim(val) + ']').attr("selected", "selected");
                                }
                                if (key === 'rst_last_upd_dt') {
                                    var arr = val.split('-');
                                    var date = arr[2] + "/" + arr[1] + "/" + arr[0];
                                    $("#datepicker").val(date);
                                }
                                if (key === 'roster_file_name') {
                                    roster_file_name = val;
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
                                if (key === 'roster_remarks') {
                                    roster_remarks = val;
                                }

                            });
                        });
                    });
                });
                // image 1
                if (roster_file_name) {
                    $('#mycontainer1').show();
                    $('#view').show();
                    $("#pv_rost_verfUplodimg").val(roster_file_name);
                    $('#close').show();
                    var newImage = $('<img align="center" height="150" width="483" id="popimg"/>');
//                    newImage.attr('src', window.webroot + 'STADMIN_UPLOADS/' + roster_file_name);
                    newImage.attr('src', window.webroot + 'nfsshare/STADMIN_UPLOADS/' + roster_file_name);
                    $('#abc').append(newImage);
                    d = new Date();
//                    $("#popup").attr("src", window.webroot + 'STADMIN_UPLOADS/' + roster_file_name + '?' + d.getTime());
                    $("#popup").attr("src", window.webroot + 'nfsshare/STADMIN_UPLOADS/' + roster_file_name + '?' + d.getTime());
                } else {
                    $("#mycontainer1").hide();
                    $("#view").hide();
                    $('#close').hide();
                    $("#pv_rost_verfUplodimg").val('');
                }

                if (roster_file_name) {
                    var newImage = $('<img align="left" height="25" width="50" id="popup" onClick="div_show()" />');
                    newImage.attr('src', window.webroot + 'STADMIN_UPLOADS/' + roster_file_name);
                    //newImage.attr('src', window.webroot + 'nfsshare/STADMIN_UPLOADS/' + roster_file_name);
                    $('#mycontainer1').html('');
                    $('#mycontainer1').append(newImage);
                    d = new Date();
                    $("#popup").attr("src", window.webroot + 'STADMIN_UPLOADS/' + roster_file_name + '?' + d.getTime());
                    // $("#popup").attr("src", window.webroot + 'nfsshare/STADMIN_UPLOADS/' + roster_file_name + '?' + d.getTime());
                } else {
                    $('#mycontainer1').hide();
                    $('#view').hide();
                }

                if (sc_sanc_tot != '' && sc_work_tot != '') {
                    var sc_diff = sc_sanc_tot - sc_work_tot;
                    $("#vcnt_1").val(sc_diff);
                }
                if (st_sanc_tot != '' && st_work_tot != '') {
                    var st_diff = st_sanc_tot - st_work_tot;
                    $("#vcnt_2").val(st_diff);
                }
                if (vja_sanc_tot != '' && vja_work_tot != '') {
                    var vja_diff = vja_sanc_tot - vja_work_tot;
                    $("#vcnt_3").val(vja_diff);
                }
                if (ntb_sanc_tot != '' && ntb_work_tot != '') {
                    var ntb_diff = ntb_sanc_tot - ntb_work_tot;
                    $("#vcnt_4").val(ntb_diff);
                }
                if (ntc_sanc_tot != '' && ntc_work_tot != '') {
                    var ntc_diff = ntc_sanc_tot - ntc_work_tot;
                    $("#vcnt_5").val(ntc_diff);
                }
                if (ntd_sanc_tot != '' && ntd_work_tot != '') {
                    var ntd_diff = ntd_sanc_tot - ntd_work_tot;
                    $("#vcnt_6").val(ntd_diff);
                }
                if (obc_sanc_tot != '' && obc_work_tot != '') {
                    var obc_diff = obc_sanc_tot - obc_work_tot;
                    $("#vcnt_7").val(obc_diff);
                }
                if (sbc_sanc_tot != '' && sbc_work_tot != '') {
                    var sbc_diff = sbc_sanc_tot - sbc_work_tot;
                    $("#vcnt_8").val(sbc_diff);
                }
                if (gen_sanc_tot != '' && gen_work_tot != '') {
                    var gen_diff = gen_sanc_tot - gen_work_tot;
                    $("#vcnt_9").val(gen_diff);
                }
                $('.price').each(function () {
                    if ($(this).val() != '') {
                        p_sum += Number($(this).val());
                    }
                });
                $('#pv_rost_verfSancSum').val(p_sum);
                $('.work').each(function () {
                    if ($(this).val() != '') {
                        w_sum += Number($(this).val());
                    }
                });
                $('#pv_rost_verfWrkSum').val(w_sum);
                $('.vcnt').each(function () {
                    if ($(this).val() != '') {
                        v_sum += Number($(this).val());
                    }
                });
                $('#pv_rost_verfVacntSum').val(v_sum);
                $('#pv_rost_verfRosterRemarks').val('');
                $('input:[type=checkbox][name=select]').attr('checked', false);
                $("input:[type=checkbox][name=select]").removeAttr("disabled");
                $('#resonid').hide();
                $('#pv_rost_verfJsonFlag').val(asst_flag);
                if (asst_flag == 'V') {
                    $('input:[type=checkbox][id=selectvfy]').attr('checked', true);
                    $('input:[type=checkbox][id=selectrjct]').prop('disabled', 'disabled');
                }
                // alert(roster_remarks);
                if (asst_flag == 'R') {
                    $("#selectrjct").attr("checked", true);
                    //	$('input:[id=selectrjct]').attr('checked', true);
                    //	$('input:[id=selectvfy]').prop('disabled', 'disabled');
                    $("#selectvfy").attr("disabled", true);
                    $('#resonid').show();
                    $('#pv_rost_verfRosterRemarks').val(roster_remarks);
                    $('#pv_rost_verfRosterRemarks').attr('readonly', 'readonly');
                }

            }, 'json');
        }

        $("#roster_submit").click(function () {
            var flag = 1;
            if ($('#sanstha').val() == '') {
                flag = 0;
                alert("ERR...Select Sanstha");
            } else
            if (!$('input:radio[name=staff_type]:checked').val() == '1') {
                flag = 0;
                alert("ERR...Select Staff Type");
            } else if ($('#staff_group').val() == '') {
                flag = 0;
                alert("ERR...Select Staff Group");
            } else if (!$('input[name="select"]').is(':checked')) {
                flag = 0;
                alert("ERR...Select either Verify or Reject");
                //if ($('input:radio[name=select]:checked').val() != 'V' ||  $('input:radio[name=select]:checked').val() != 'R') { 
                //if  (!($('input:radio[type=checkbox]:checked').val() == 'V' || $('input:radio[type=checkbox]:checked').val() == 'R')) {

            } else {
                var rejection_flag = $('#pv_rost_verfAsstFlag').val();
                var remarks = $('#pv_rost_verfRosterRemarks').val();
                if (rejection_flag == "R") {
                    if (remarks == "") {
                        flag = 0;
                        alert("Err...Enter Reason for Rejection.");
                        $("#pv_rost_verfRosterRemarks").focus();
                        $('#pv_rost_verfRosterRemarks').css('border-color', 'red');
                    } else {
                        if (window.confirm("Are you sure want to Reject Record ?")) {
                            $("#pv_rost_verfRosterPvtTchVerfForm").submit();
                        }
                    }
                } else {
                    if (window.confirm("Are you sure want to Verify Record ?")) {
                        $("#pv_rost_verfRosterPvtTchVerfForm").submit();
//                        location.reload();
                    }
                }
            }
            if (flag == 0) {
                return false;
            }
        })

//        $("#pv_rost_verfRosterPvtTchVerfForm").ajaxForm({url: 'verify_roster', type: 'post',
//            success: function(data) {
//                alert("Data Saved Successfully.");
////                location.reload();
//                $('#selectvfy').attr('checked', false);
//                $('#selectrjct').attr('checked', false);
//                $('#staff_group').val('');
//                $('#tchr_type').prop('checked', false);
////                location.reload();
//            }
//        });
        $("#selectvfy").change(function () {
            var flag = $('#selectvfy').val();
            if ($(this).is(":checked")) {
                $('#pv_rost_verfAsstFlag').val(flag);
                $('#selectrjct').prop('disabled', 'disabled');
            } else {
                $('#pv_rost_verfAsstFlag').val('');
                $('#selectrjct').prop('disabled', false);
            }
        });
        $("#selectrjct").change(function () {
            var flag = $('#selectrjct').val();
            if ($(this).is(":checked")) {
                $('#pv_rost_verfAsstFlag').val(flag);
                $('#selectvfy').prop('disabled', 'disabled');
                $('#remarkid').hide();
                $('#resonid').show();
            } else {
                $('#pv_rost_verfAsstFlag').val('');
                $('#selectvfy').prop('disabled', false);
                $('#remarkid').show();
                $('#resonid').hide();
            }
        });
    });
</script>