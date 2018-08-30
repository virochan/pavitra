<?php
//echo "---------" . $get_sanstha_minority_type;
echo $this->Html->script('jquery-1.7.2');
//echo $this->Html->script('jquery-ui-1.10.4.custom');
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
    legend{width:16% !important}
    .rGreen{
        background:  #DCFDF2 !important;;
    }
    .rYellow{
        background:  #FDFDE0 !important;;
    }

    .abc {
        width:100%;
        height:100%;
        top:0;
        left:0;
        display:none;
        position:fixed;
        background-color:rgba(0,0,0,0.5);
        overflow:auto
    }
    img#close {
        position:absolute;
        right:-14px;
        top:-14px;
        cursor:pointer
    }
    div #popimg {
        position:absolute;
        left:30%;
        top:5%;
        font-family:'Raleway',sans-serif;
    }

    #filledDataAjax
    {
        border: 1px solid #7B99D7;
        float: left;
        width: 100%;
        background:#F1F5FF none repeat scroll 0% 0%;
    }

    .fielddata
    {
        float:left;
        border:1px solid #CBC8C8;
        width: 98%;
        margin-top:2px;
        margin-left: 1%;
        background: #ffffff; 
        /*  background: -moz-linear-gradient(top, #ffffff 0%, #fffcd8 100%); 
          background: -webkit-linear-gradient(top, #ffffff 0%,#fffcd8 100%);
          background: linear-gradient(to bottom, #ffffff 0%,#fffcd8 100%); 
          filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#fffcd8',GradientType=0 );*/

        background: #ffffff; 
        background: -moz-linear-gradient(top,  #ffffff 0%, #f3f3f3 100%);
        background: -webkit-linear-gradient(top,  #ffffff 0%,#f3f3f3 100%); 
        background: linear-gradient(to bottom,  #ffffff 0%,#f3f3f3 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f3f3f3',GradientType=0 ); 
        border-radius: 10px;
        margin-bottom:3px;
        padding: 0.5%;
        box-shadow:0px 0px 2px #CBC8C8;
        height: 290px;
        overflow-y: auto;   
    }

    #fieldtable td
    {
        padding:4px !important;
    }

    #fieldtable tr
    {
        border:1px solid #FFF;
    }
    #fieldtable table td
    {
        //border-style:none;
    }

    .modbtn
    {
        color:#840303;
        box-shadow: 1px 1px 1px #20BAD7 inset;	
        padding:3px 4px;
        border: 1px solid #F9B85C;
        background: #f9e8b0;
        background: -moz-linear-gradient(top,  #f9e8b0 0%, #fcd084 100%);
        background: -webkit-linear-gradient(top,  #f9e8b0 0%,#fcd084 100%); 
        background: linear-gradient(to bottom,  #f9e8b0 0%,#fcd084 100%); 
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9e8b0', endColorstr='#fcd084',GradientType=0 );
        box-shadow: 2px 2px 0px #FCF7F1 inset;
        font-size: 13px !important;
        border-radius: 5px;
        margin:2px;
    }
    /*---------------------------------table fixed container strip-----------------------------*/

    #excess_vacancy_detail_tbl td {
        border: 1px solid #afc5f2;
        padding: 5px;
        text-align: left; /* IE */
        cursor:pointer;
    }
    #excess_vacancy_detail_tbll td + td {
        border-left: 1px solid #32A1B6;
    }


    #excess_vacancy_detail_tbl th {
        padding: 0 5px;
        text-align: left; /* IE */
    }

    /* above this is decorative, not part of the test */


    .fixed-table-container-inner {
        overflow-x: hidden;
        overflow-y: auto;
        height: 100%;
    }



    #excess_vacancy_detail_tbl{
        background-color: white;
        width: 100%;
        overflow-x: hidden;
        overflow-y: auto;
    }

    #excess_vacancy_detail_tbl .th-inner {
        position: absolute;
        top: 0;
        line-height: 30px; /* height of header */
        text-align: left;
        border-left: 1px solid rgb(175, 197, 242);
        padding-left: 6px;
        margin-left: -6px;
        color: rgb(246, 253, 255);
    }

    #excess_vacancy_detail_tbl .first .th-inner {
        border-left: none;
        padding-left: 6px;
    }
    .fixed-table-container {
        width: 100%;
        height:150px;
        border: 1px solid #7B99D7;
        margin:0px auto;
        background-color: white;
        /* above is decorative or flexible */
        position: relative; /* could be absolute or relative */
        padding-top: 30px; /* height of header */
    }

    .fixed-table-container-inner {
        overflow-x: hidden;
        overflow-y: auto;
        height: 100%;
    }

    .header-background {
        background-color:#3e5c9a;
        height: 30px; /* height of header */
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
    }


    .first { border-left:none;padding-left:3px; width:4%;}  
    .second { border-left: none;padding-left:6px; width:15%;} 
    .third  { border-left: none; padding-left: 6px; width:15%;} 
    .fourth { border-left: none; padding-left: 6px; width:5%;} 
    .fifth { border-left: none; padding-left: 6px; width:5%;} 
    .sixth { border-left: none; padding-left: 6px; width:5%;} 
    .seventh { border-left: none; padding-left: 6px; width:5%;} 
    .eighth { border-left: none; padding-left: 6px; width:5%;} 
    /*    .ninth { border-left: none; padding-left: 6px; width:13%;}
        .ten { border-left: none; padding-left: 6px; width:10%;}		*/

    /*----------------------------------End of Code------------------------------------------- */

    .overlay_srch_school_help {
        background: rgba(0, 0, 0, 0.69) none repeat scroll 0 0;
        height: 100%;
        left: 0;
        position: fixed;
        top: 0;
        width: 100%;
        display:none;
    }

    .overlay_srch_school_help > div#search_box_school_help {
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

    .search_inner_school_help
    {
        border: solid 1px rgb(30, 186, 214);
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        margin-bottom: 10px;
        /*margin-top: 30px;*/
        padding-bottom: 15px;
        box-shadow: inset 1px 1px 5px 2px rgba(39, 164, 186, 0.5);
        height:300px;
        background-image: url("../img/section_bg.png");
        background-color: rgb(182, 244, 255);
        color:black;
        padding: 1% 5%;
    }

    .search_head_school_help h3
    {
        padding:7px 0px;
        margin:0px;
        color:#fff;
        font-size: 17px;
        font-weight: normal;
        font-family:Verdana, Geneva, sans-serif;
    }

    .search_head_school_help
    {
        background-color: #1D9CB3;
        height: 35px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border-bottom: solid 2px rgb(64, 204, 230);
        border-top: solid 1px rgb(64, 204, 230);
        text-align: center;
        width: 100%;
    }

    .overlay_srch_school_help td
    {
        padding:5px;
    }

    input.search_btn_school_help {
        box-shadow: -1px 2px 3px -2px rgba(0, 0, 0, 0.9);
        -moz-box-shadow: inset 0px 1px 0px 0px #CF180A;
        -webkit-box-shadow: inset 0px 1px 0px 0px #CF180A;
        background: #ec3030; 
        background: -moz-linear-gradient(top,  #ea2a2a 0%, #ff7878 100%); 
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ea2a2a), color-stop(100%,#ff7878)); 
        background: -webkit-linear-gradient(top,  #ea2a2a 0%,#ff7878 100%); 
        background: -o-linear-gradient(top,  #ea2a2a 0%,#ff7878 100%);
        background: -ms-linear-gradient(top,  #ea2a2a 0%,#ff7878 100%); 
        background: linear-gradient(to bottom, #ea2a2a 0%,#ff7878 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#12616f', endColorstr='#3f94a4',GradientType=0 );
        border-radius: 8px;
        border: 1px solid #EEA31E;
        display: inline-block;
        cursor: pointer;
        color: #fff;
        font-family: arial;
        font-size: 14px;
        padding: 3px 12px;
        text-decoration: none;
        text-shadow:  0px 1px 0px #DDB72F;
        margin: 1px 2px;
    }

    .link { text-align: center; clear: both; padding: 20px 0; }
    .link a { color: #333333; }
    .wrapper {
        width: 960px;
        margin: 50px auto;
    }
    .ui-datepicker-trigger {
        margin:0px 0px -1px 7px;
    }
    .gobutton:disabled {
        background-color: red;
    }

    .overlay_search_personal {
        background: rgba(0, 0, 0, 0.69) none repeat scroll 0 0;
        height: 100%;
        left: 0;
        position: fixed;
        top: 0;
        width: 100%;
        display:none;
    }
    .overlay_search_personal > div#duplicate_search_box_personal 
    {
        background: white none repeat scroll 0 0;
        border-radius: 6px;
        left: 33%;
        padding: 1% 2%;
        position: absolute;
        top: 21%;
        width: 40%;
    }


</style>

<script>
    $(document).ready(function() {
        commonDatepicker();
        validationCommen();
        $("#overlay_search_personal").hide();
        $('#cancel_tch_personal').on('click', function(e) {
            $("input[type=text]").val("");
            $('#excess_vacancy_detail_tbl tbody').html('');
            $('#sanstha_dist_cd').val('');
            $('#option_schl_type').val('');
            $('#school_medium_code').val('');
            $('#school_posts_code').val('');
            $('#option_subject_code').val('');
        });
        $("#exit_tch_personal").click(function() {
            var url = "sanstha";
            $(location).attr('href', url);
        });

    });
</script>


<div id="personalDiv">
    <?php echo $this->Form->create(null, array('type' => 'file', 'url' => array('controller' => 'samayojans', 'action' => 'save_excess_vacancy_detail'))); ?>

    <table class="table" style="border-collapse:collapse;width:100%;margin-bottom:0px;">


        <tr>
            <td class="col-xs-9" colspan="9" align="center">

                <div class="subformhead"> <?php
                    echo __("Vacancy Post Details for Sanstha");
                    ?></div>
                <div id="error" style="display:none; color:#F00">Some Error!Please Fill form Properly </div> 
                <div id="success" style="display:none; color:#0C0">All the records are submitted!</div>
            </td>
            <td class="col-xs-1">
                <?php
                echo $this->Form->submit(__('Save'), array('class' => 'btn btn-sm logbutton2', 'id' => 'save_excess_vacancy_detail', 'type' => 'button', 'value' => 'Save', 'style' => 'float:right;'));
                ?>
            </td>
            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="cancel_tch_personal" type="button" value="<?php echo __('Cancel'); ?>" /></td>
            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="exit_tch_personal" type="button" value="<?php echo __('Exit'); ?>"/></td>
        </tr>
    </table>
<!--    <table class="table" style="border-collapse:collapse;width:100%;">
        <tr>
            <td class="">
                <div style="float:left;width:63%">
                    <span class="subformhead"> <?php
    if ($get_sanstha_minority_type == '1') {
        $title_text = 'Non-Minority';
    } else if ($get_sanstha_minority_type == '2') {
        $title_text = 'Minority';
    }
    echo __("Vacancy Post Details for $title_text Sanstha");
    ?></span>
                    <span id="error" style="display:none; color:#F00">Some Error!Please Fill form Properly </span> 
                    <span id="success" style="display:none; color:#0C0">All the records are submitted!</span>
                </div>
                <div style="float:right;width:36%">
                    <span style="float:right;text-align:right;width:100%;">

                        <input class="gobutton"  id="exit_tch_personal" type="button" value="<?php echo __('Exit'); ?>" style="float: right;"/>
                        <input class="gobutton"  id="cancel_tch_personal" type="button" value="<?php echo __('Cancel'); ?>" style="float: right;"/>
    <?php
    echo $this->Form->submit(__('Save'), array('class' => 'btn btn-sm logbutton2', 'id' => 'save_excess_vacancy_detail', 'type' => 'button', 'value' => 'Save', 'style' => 'float:right;'));
    ?>

                    </span>
                </div>
            </td>
        </tr>
    </table>-->
    <!--/****************************start new**********************/-->
    <div class="note">
        <span class="notehead"> Note &nbsp;&nbsp;:&nbsp;</span>
        Sansthas can enter Schoolswise,Mediumwise and Postwise Statistical Information on Vacancy Post Details.
    </div>
    <div>
        <fieldset class="myfieldset" style="width:100%;border:1px solid #7B99D7;margin: 10px auto;">
            <legend class="mylegend"><?php echo __('Vacancy Details'); ?>
            </legend>

            <div class="table-responsive" id ='filledDataAjax'>
                <table class="table" style="overflow: auto; width: 100%;" >
                    <tr>
                        <td>
                            <div style="width:100%;">
                                <div class="fixed-table-container">
                                    <div class="header-background"> </div>
                                    <div class="fixed-table-container-inner">    

                                        <table class="table" id="excess_vacancy_detail_tbl">
                                            <thead>
                                                <tr>
                                                    <th class="th_grid col-xs-1"><div class="th-inner"><?php echo __('Sr.No.'); ?></div></th>
                                            <!--<th class="th_grid col-xs-1"><div class="th-inner"><?php echo __('District'); ?></div></th>-->
                                            <th class="th_grid col-xs-4" colspan="4"><div class="th-inner"><?php echo __('School Name'); ?></div></th>
                                            <th class="th_grid col-xs-1" ><div class="th-inner"><?php echo __('Post'); ?></div></th>
                                            <th class="th_grid col-xs-1" ><div class="th-inner"><?php echo __('Medium'); ?></div> </th>
                                            <th class="th_grid col-xs-1" ><div class="th-inner"><?php echo __('Subject'); ?>  </div> </th>
                                            <th class="th_grid col-xs-1" colspan="2"><div class="th-inner"><?php echo __('No. of Posts'); ?></div> </th>
                                            <th class="th_grid col-xs-1" colspan="2"><div class="th-inner"><?php echo __('Aid Type'); ?></div> </th>
                                            <th class="th_grid col-xs-1"><div class="th-inner"><?php echo __('Action'); ?></div> </th>
                                            </tr>
                                            </thead>
                                            <tbody>
<!--                                                <tr>
                                                    <td class="col-xs-1" style="text-align:center"></td>
                                                    <td class="col-xs-1"></td>
                                                    <td class="col-xs-4" colspan="4"></td>
                                                    <td class="col-xs-1"></td>
                                                    <td class="col-xs-1"></td>
                                                    <td class="col-xs-1"></td>
                                                    <td class="col-xs-2" colspan="2" style="text-align:right"></td>
                                                    <td class="col-xs-1" style="text-align:center"></td>

                                                </tr>-->

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="table-responsive fielddata">
                <table class="table" border="0" id="fieldtable" width="100%">
                    <tr> 
                        <td class="col-xs-3" colspan="3"> 
                            <?php echo __('Select District'); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <span>
                                <?php
                                echo $this->Form->input('sanstha_dist_cd', array('options' => $array_sanstha_dist, 'label' => false, 'empty' => '-- Select District --',
                                    'id' => 'sanstha_dist_cd'));
                                echo $this->Form->input('get_sanstha_minority_type_hidden', array('id' => 'get_sanstha_minority_type_hidden', 'value' => $get_sanstha_minority_type, 'type' => 'hidden', 'readonly' => 'readonly', 'maxlength' => '1'));
                                ?>   
                            </span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <div id="schoolType">
                                <?php echo __('Select School Type'); ?> <span style="float:right;font-weight:bold">&nbsp;&nbsp;:</span>
                            </div>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <span>
                                <?php
                                $option_schl_type = array('01' => 'Primary', '02' => 'Secondary');
                                echo $this->Form->input('option_schl_type', array('options' => $option_schl_type, 'label' => false, 'empty' => '-- Select School Type --',
                                    'id' => 'option_schl_type'));
                                ?> 
                            </span>
                        </td>
                    </tr>
                    <tr> 
                        <td class="col-xs-3" colspan="3"> 
                            <?php echo __('Enter School Udise Code '); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>
                        <td class="col-xs-1">

                            <?php
                            echo $this->Form->input('schl_id', array('label' => '', 'type' => 'text', 'id' => 'schl_id', 'value' => '', 'maxlength' => '11'));
                            ?>
                        </td>
                        <td class="col-xs-5" colspan="5">   
                            <div id="schoolName">
                                <?php
                                echo $this->Form->input('schl_name', array('label' => '', 'type' => 'text', 'id' => 'schl_name', 'style' => 'width:400px !important;', 'readonly' => 'readonly'));
                                ?>
                            </div>
                        </td>
                        <td class="col-xs-1">
                            <input class="btn btn-sm logbutton2"  id="search_school_help_eo" type="button"  value="<?php echo __('Search'); ?>"/>
                        </td>
                    </tr>
                    <tr> 
                        <td class="col-xs-3" colspan="3"> 
                            <?php echo __('Select Medium '); ?> <span style="float:right;font-weight:bold">:</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <span id='SchoolMediumSpan'>
                                <select  style="width:80%!important;">
                                    <option>------Select Medium------</option>

                                </select>
                            </span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php echo __('Select Post '); ?> <span style="float:right;font-weight:bold">&nbsp;&nbsp;&nbsp;:&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <span id='SchoolPostsSpan'>
                                <select>
                                    <option>------Select Post------</option>

                                </select>
                            </span>
                        </td>

                    </tr>
                    <tr>
                        <td class="col-xs-3" colspan="3">Sanction Aided Posts as per SM <span style="float:right;font-weight:bold;">:</span></td> 
                        <td class="col-xs-3" colspan="3">

                            <?php
                            echo $this->Form->input('sanch_total', array('label' => ' ', 'type' => 'text', 'id' => 'sanch_total', 'value' => '', 'style' => 'width:35%!important;text-align:center;', 'readonly' => 'readonly', 'maxlength' => '3'));
                            ?>
                        </td>

                        <?php
                        echo $this->Form->input('proposed_total', array('label' => 'Proposed Post as per SM <b>:&nbsp;&nbsp;</b>', 'type' => 'hidden', 'id' => 'proposed_total', 'value' => '', 'style' => 'width:25%!important;text-align:center;', 'readonly' => 'readonly', 'maxlength' => '3'));
                        ?>

                        <?php
                        echo $this->Form->input('sanch_proposed_total', array('label' => 'Total <b>:&nbsp;&nbsp;</b>', 'type' => 'hidden', 'id' => 'sanch_proposed_total', 'value' => '', 'style' => 'width:40%!important;text-align:center;', 'maxlength' => '3', 'type' => 'hidden')); //, 'readonly' => 'readonly'
                        ?>

                        <td class="col-xs-3" colspan="3"> 
                            <?php echo __('Select Aid Type '); ?>   <span style="float:right;font-weight:bold">:</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <span>
                                <?php
                                echo $this->Form->input('aid_type', array('options' => $all_aid_type, 'label' => false, 'empty' => '-- Select Aid Type--', 'id' => 'aid_type', 'name' => 'aid_type'));
                                ?>
                            </span>
                        </td>                     
                    </tr>
                    <tr>
                        <td class="col-xs-3" colspan="3">Approved Working Aided Posts as per payment <span style="float:right;font-weight:bold;">:</span></td>

                        <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('eos_online_posts', array('label' => '', 'type' => 'text', 'id' => 'eos_online_posts', 'value' => '0', 'style' => 'width:35% !important;text-align:center;', 'maxlength' => '3')); ?></td>
                        <?php echo $this->Form->input('eos_offline_posts', array('label' => 'Offline', 'type' => 'hidden', 'id' => 'eos_offline_posts', 'value' => '0', 'style' => 'width:25% !important;text-align:center;', 'maxlength' => '3', 'readonly' => 'readonly')); ?>
                        <?php
//                            echo $this->Form->input('eos_online_offline_tot_posts', array('label' => 'Total <b>&nbsp;:&nbsp;</b> ', 'type' => 'text', 'id' => 'eos_online_offline_tot_posts', 'value' => '0', 'style' => 'width:40% !important; text-align:center;', 'readonly' => 'readonly', 'maxlength' => '3'));
                        echo $this->Form->input('filled_no_of_excess_vancant_posts_hidden', array('id' => 'filled_no_of_excess_vancant_posts_hidden', 'value' => '', 'type' => 'hidden', 'readonly' => 'readonly', 'maxlength' => '3'));
                        ?>

                        <td class="col-xs-3" colspan="3">Staff Type</td>
                        <td class="col-xs-3" colspan="3">
                            <div style="float:left;">
                                <input type="radio" name="staff_level" id="tchr_type1" value="1" >
                                <label id="1">Part Time</label>
                            </div>
                            <div style="float:left;margin-left:10px;">
                                <input type="radio" name="staff_level" id="tchr_type2" value="2">
                                <label id="2">Full Time</label>
                            </div>
                        </td>
                    </tr>
                    <tr id="post_under_grad_tr">
                        <td class="col-xs-3" colspan="3">
                            <span>No. of Posts <b style="float:right;">:</b></span>
                        </td> 
                        <td class="col-xs-1"> 
                            <?php
                            echo $this->Form->input('excess_vacant_cal_posts', array('label' => ' ', 'type' => 'text', 'id' => 'excess_vacant_cal_posts', 'value' => '', 'style' => 'width:6'
                                . '5%!important;float:left;margin-left:1%;', 'readonly' => 'readonly', 'maxlength' => '3'));
                            ?>

                        </td>
                        <td class="col-xs-2" colspan="2">

                            <span>(SM Sanctioned - Working)</span>

                        </td>    
                        <td class="col-xs-3" colspan="3">  <?php echo __('Select Subject '); ?>   <span style="float:right;font-weight:bold">:</span></td>
                        <td class="col-xs-3" colspan="3">
                            <span>
                                <?php
                                echo $this->Form->input('option_subject_code', array('options' => $all_sama_sub_cat, 'label' => false, 'empty' => '-- Select Subject--',
                                    'id' => 'option_subject_code'));
                                ?>
                            </span>
                        </td>
                    </tr>

<!--                    <tr id="post_under_grad_tr" style="border-top:1px solid #FBE2AF !important;"> 
                        <td class="col-xs-5" colspan="5"> 
                    <?php echo __('Select Subject '); ?>   <span style="float:right;font-weight:bold">:</span>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <span>
                    <?php
                    echo $this->Form->input('option_subject_code', array('options' => $all_sama_sub_cat, 'label' => false, 'empty' => '-- Select Subject--',
                        'id' => 'option_subject_code', 'style' => 'width:100% !important;'));
                    ?>
                            </span>
                        </td>
                        <td class="col-xs-2" colspan="2">
                        </td>
                        <td class="col-xs-3" colspan="3">

                        </td>
                    </tr>-->

                    <?php if ($get_sanstha_minority_type != '1') {
                        ?>

                        <tr id="consider_vacancy_flag_tr" style="background:#5F7CB7;border-top:1px solid #3B6394 !important;"> 
                            <td class="col-xs-5" colspan="5"> 
                                <?php echo __('Is Sanstha ready to accept Excess Staff'); ?>   <span style="float:right;font-weight:bold">:</span>
                            </td>
                            <td class="col-xs-2" colspan="2">
                                <span> <?php
                                    $options = array('Y' => 'Yes', 'N' => 'No');
                                    echo $this->Form->input('consider_vacancy_minority', array(
                                        'div' => true,
                                        'label' => true,
                                        'type' => 'radio',
                                        'legend' => false,
                                        'options' => $options,
                                        'name' => 'consider_vacancy_minority',
                                        'style' => 'margin-left:25px;'
                                    ));
                                    ?>
                                </span>
                            </td>

                            <td class="col-xs-2" colspan="2">
                            </td>
                            <td class="col-xs-3" colspan="3">
                                <span>

                                </span>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr style="background: #3E5C9A;border-top:1px solid #3B6394 !important;color:#fff;"> 
                        <td class="col-xs-5" colspan="5"> 
                            Enter No. of Posts   <span style="float:right;font-weight:bold">:</span>
                        </td>


                        <td class="col-xs-2" colspan="2">       
                            <?php
                            echo $this->Form->input('no_of_excess_vancant_posts', array('label' => '', 'type' => 'text', 'id' => 'no_of_excess_vancant_posts', 'style' => 'width:40% !important;', 'maxlength' => '3'));
                            ?>
                        </td>
                        <td class="col-xs-2" colspan="2">
                            <?php
                            echo $this->Form->input('save_modify_delete', array('label' => 'save/modify/delete', 'type' => 'hidden', 'id' => 'save_modify_delete', 'style' => 'width:50px;'));
                            ?>  
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php
                            echo $this->Form->input('save_modify_delete_id', array('label' => 'save/modify/deleteID', 'type' => 'hidden', 'id' => 'save_modify_delete_id', 'style' => 'width:50px;'));
                            ?>

                        </td>
                    </tr>
                </table>

            </div>  
        </fieldset>
    </div>
    <div class="overlay_search_personal" id="overlay_search_personal">
        <div class="duplicate_search_box_personal" id="duplicate_search_box_personal" style="height:400px; overflow-y: auto;">
        </div>
    </div>




    <div class="overlay_srch_school_help" id="overlay_srch_school_help">
        <div id="search_box_school_help">
            <div class="search_head_school_help"><h3>Search School <div id='sanstha_name_selected_div'></div></h3>

            </div>
            <div class="search_inner_school_help"> 
                <div class="input select">
                    <label for="child_infoState">State &nbsp;:</label>
                    <select id="child_infoState" class="selectbox" style="margin-top:10px;margin-bottom:10px;width:80%;margin-left:9%;" name="data[child_info][State]" >
                        <option value="27">MAHARASHTRA</option>
                    </select>
                </div>
                <br>
                <div id="dist_school_help">
                    <?php
                    echo $this->Form->input('dist_id_school_help', array('options' => $array_sanstha_dist, 'empty' => '-- Select District --',
                        'id' => 'dist_id_school_help', 'label' => 'District: ', 'style' => 'width:80%;margin-left:9%;',
                        'class' => 'selectbox'));
                    ?>
                </div>
                <br>
                <div id="dist_div_school_help">

                </div>
                <div id="cluster_div_school_help">
                </div>
                <div id="school_div_school_help">
                </div>
            </div>


            <input class="btn btn-sm logbutton2"  id="exit_search_school_help" type="button" value="Exit" style="float: right;"/>
            <input class="btn btn-sm logbutton2"  id="cancel_search_school_help" type="button" value="Cancel" style="float: right;"/>
            <input class="btn btn-sm logbutton2"  id="submit_search_school_help_eo" type="button" value="Submit" style="float: right;" />
        </div>
    </div>

    <?php echo $this->Form->end(); ?>
</div>




<script>
    $(document).ready(function() {
        $('#consider_vacancy_flag_tr').hide();
        var get_sanstha_minority_type_hidden = $('#get_sanstha_minority_type_hidden').val();
        if (get_sanstha_minority_type_hidden == '1') {
            $('#consider_vacancy_flag_tr').hide();
        }
        else if (get_sanstha_minority_type_hidden == '2') {
            $('#consider_vacancy_flag_tr').show();
        }
        $('#sanstha_dist_cd').on('change', function() {
            $('#school_medium_code').val('');
            var sanstha_dist_cd = $('#sanstha_dist_cd :selected').val();
            $('#dist_id_school_help').val(sanstha_dist_cd);
            $('#dist_id_school_help').click();
        });

        $('#option_schl_type').on('change', function() {
            $('#school_medium_code').val('');
            var option_schl_type = $('#option_schl_type :selected').val();
            var dist_cd = $('#sanstha_dist_cd :selected').val();

            if (dist_cd == "") {
                $('#sanstha_dist_cd').val('');
                $('#option_schl_type').val('');
                alert("Please Select District.");
            }
        });

        $("#overlay_srch_school_help").hide();

        $("#search_school_help_eo").click(function() {
            $("#overlay_srch_school_help").show();
        });

        $('#dist_id_school_help').on('click', function() {
            var dist_id = $('#dist_id_school_help :selected').val();
            jQuery.post('SelectBlocksearch', {dist_id: dist_id}, function(data) {
                $('#dist_div_school_help').html(data);
            });
        });

        $('#dist_div_school_help').on('change', function() {
            var clus_id = $('#searchblock_id :selected').val();
            jQuery.post('SelectClustersearch', {clus_id: clus_id}, function(data) {
                $('#cluster_div_school_help').html(data);
            });
        });

        $('#cluster_div_school_help').on('change', function() {
            var clu_id = $('#searchcluster_id :selected').val();
            var option_schl_type = $('#option_schl_type :selected').val();
            if (option_schl_type == '01' || option_schl_type == '02') {
                jQuery.post('SelectSchoolSearch', {clu_id: clu_id, option_schl_type: option_schl_type}, function(data) {
                    $('#school_div_school_help').html(data);
                });
            }
            else {
                alert("Please Select School Type.");
            }
        });

        $('#submit_search_school_help_eo').on('click', function() {
            var school_code_option_id = $('#school_code :selected').val();
            var value = $('#school_code option:selected').text();
            $('#schl_id').val('');
            $('#schl_name').val('');
            $('#schl_id').val(school_code_option_id);
            if (school_code_option_id != '')
                $('#schl_name').val(value);
            $("#overlay_srch_school_help").hide();
            $('#schl_id').focus();
        });

        $('#cancel_search_school_help').on('click', function() {
            $('#dist_id_school_help').val('');
            $('#searchblock_id').val('');
            $('#searchcluster_id').val('');
            $('#searchteacher_id').val('');
        });

        $('#exit_search_school_help').click(function() {
            $("#overlay_srch_school_help").hide();
        });

        $("#schl_id").on('focusout', function() {
            $('#school_medium_code').val('');
            var schcode = $(this).val();
//            alert(schcode);
            var sanstha_dist_cd = $('#sanstha_dist_cd :selected').val();
            var option_schl_type = $('#option_schl_type :selected').val();

            var statecode;
            var statecode = schcode.substring(0, 2);

            var Alphapattern = /^[0-9]+$/;
            if (Alphapattern.test(schcode) == false) {
                alert('Please Enter Only Digits.');
            }
            else if (isEmpty(schcode) || isSchoolCode(schcode) || (statecode != '27')) {
                alert("Please Enter Valid School Code.");
                $("#schl_id").focus();
            }
            else if (sanstha_dist_cd != schcode.substring(0, 4)) {
                alert("Please Enter Valid School Code within Selected District.");
                $("#schl_id").focus();
            }
            else if (option_schl_type == '') {
                alert("Please Select District.");
                $("#schl_id").focus();
            }
            else {
                jQuery.post('searchSchoolNameSanstha', {schcode: schcode, sanstha_dist_cd: sanstha_dist_cd, option_schl_type: option_schl_type}, function(data) {
                    if (data == '') {
                        alert("Enter Valid School Code");
                    }
                    else {
                        $.each(jQuery.parseJSON(data), function(i, obj) {

                            if (i == 'FindedSchoolName') {
                                $('#schl_name').val(obj);
                            }
                            jQuery.post('SelectSchoolMediumForSanstha', {schcode: schcode, option_schl_type: option_schl_type}, function(data) {
                                $('#SchoolMediumSpan').html(data);

                                $('#school_medium_code').on('change', function() {
                                    var option_schl_type = $('#option_schl_type :selected').val();
                                    var dist_cd = $('#sanstha_dist_cd :selected').val();
                                    var school_medium_code = $('#school_medium_code :selected').val();
                                    var get_sanstha_minority_type_hidden = $('#get_sanstha_minority_type_hidden').val();

                                    if (school_medium_code != "") {
                                        if (dist_cd != "") {
                                            if (option_schl_type == '01' || option_schl_type == '02') {
//                                                jQuery.post('checkApproveralForSama', {dist_cd: dist_cd, option_schl_type: option_schl_type, school_medium_code: school_medium_code,get_sanstha_minority_type_hidden:get_sanstha_minority_type_hidden}, function (data) {
//                                                    $.each(jQuery.parseJSON(data), function (i, obj) {
//                        alert(i + "-----------" + obj);
//                                $('#schl_name').val(obj);
//                                                        if (obj == 'N') {
//                                                            $('#sanstha_dist_cd').val('');
//                                                            $('#option_schl_type').val('');
//                                                            $('#school_medium_code').val('');
//                                                            $('#schl_id').val('');
//                                                            $('#schl_name').val('');
//                                                            alert("Data Entry is Closed for this Mediummmmmmmm.");
//                                                            var url = "sanstha";
//                                                            $(location).attr('href', url);
//                                                        }
//                                                        else if (obj == 'Y') {
                                                var school_medium_code = $('#school_medium_code :selected').val();
                                                jQuery.post('SelectSchoolPostsForSanstha', {schcode: schcode, school_medium_code: school_medium_code}, function(data) {
                                                    $('#SchoolPostsSpan').html(data);
                                                });

//                                                        }

//                                                    });
//                                                });
                                            }
                                            else {
                                                alert("Please Select School Type.");
                                            }

                                        }
                                        else {
                                            $('#sanstha_dist_cd').val('');
                                            $('#option_schl_type').val('');
                                            $('#school_medium_code').val('');
                                            alert("Please Select District.");
                                        }
                                    }
                                    else {
                                        $('#sanstha_dist_cd').val('');
                                        $('#option_schl_type').val('');
                                        $('#school_medium_code').val('');
                                        alert("Please Select Medium.");
                                    }

                                });


                            });

                        });
                    }

                });
            }

        });

        $('#save_excess_vacancy_detail').on('click', function(e) {

            var flag = 0;
            var flag = excess_vacancy_declareValidationForm();

            if (flag == 1) {
                var sanstha_dist_cd = $('#sanstha_dist_cd :selected').val();
                var option_schl_type = $('#option_schl_type :selected').val();
                var eo_code = '';
                eo_code = sanstha_dist_cd + 'EO' + option_schl_type;
                var schl_id = $('#schl_id').val();
                var schl_name = $('#schl_name').val();
                var school_medium_code = $('#school_medium_code :selected').val();
                var school_posts_code = $('#school_posts_code :selected').val();

                var sanch_total = $('#sanch_total').val();
                var proposed_total = $('#proposed_total').val();
                var sanch_proposed_total = $('#sanch_proposed_total').val();

                var eos_online_posts = $('#eos_online_posts').val();
                var eos_offline_posts = $('#eos_offline_posts').val();
                var eos_online_offline_tot_posts = $('#eos_online_offline_tot_posts').val();

                var excess_vacant_cal_posts = $('#excess_vacant_cal_posts').val();

                var option_subject_code = $('#option_subject_code :selected').val();
//                var reservation_category = $('#reservation_category :selected').val();
                var no_of_excess_vancant_posts = $('#no_of_excess_vancant_posts').val();
                var save_modify_delete = $('#save_modify_delete').val();
                var save_modify_delete_id = $('#save_modify_delete_id').val();
                var get_sanstha_minority_type_hidden = $('#get_sanstha_minority_type_hidden').val();

                var SamayojanConsiderVacancyMinority = $("input[name='consider_vacancy_minority']:checked").val();
                if (typeof SamayojanConsiderVacancyMinority === "undefined") {
                    SamayojanConsiderVacancyMinority = 'N';
                }

                var aid_type = $('#aid_type').val();
                var staff_level = $("input[name=staff_level]:checked").val();
//                alert(staff_level);

                var tr = '';
                jQuery.post('save_excess_vacancy_detail', {
                    sanstha_dist_cd: sanstha_dist_cd,
                    get_sanstha_minority_type_hidden: get_sanstha_minority_type_hidden,
                    SamayojanConsiderVacancyMinority: SamayojanConsiderVacancyMinority,
                    option_schl_type: option_schl_type,
                    eo_code: eo_code,
                    schl_id: schl_id,
                    school_medium_code: school_medium_code,
                    school_posts_code: school_posts_code,
                    sanch_total: sanch_total,
                    proposed_total: proposed_total,
                    sanch_proposed_total: sanch_proposed_total,
                    eos_online_posts: eos_online_posts,
                    eos_offline_posts: eos_offline_posts,
                    eos_online_offline_tot_posts: eos_online_offline_tot_posts,
                    excess_vacant_cal_posts: excess_vacant_cal_posts,
                    option_subject_code: option_subject_code,
                    no_of_excess_vancant_posts: no_of_excess_vancant_posts,
                    save_modify_delete: save_modify_delete,
                    save_modify_delete_id: save_modify_delete_id,
                    aid_type: aid_type,
                    staff_level: staff_level
                }, function(data) {
//                   alert(data);
//                    if (data == '1234') {
//                        alert("Record Allready Present for Seleted Subject");
//                    }
//                    else {

                    var counter = 1;
                    $.each(jQuery.parseJSON(data), function(i, obj) {

                        if (i == 'filled_data_success') {
                            var filled_data_success = obj;
                            if (filled_data_success == 1)
                                alert("Record Allready Present.........");
                        }
                        if (i == 'filled_no_of_excess_vancant_posts_hidden') {
                            window.filled_no_of_excess_vancant_posts_hidden = obj;
                            $('#filled_no_of_excess_vancant_posts_hidden').val(obj);
                        }
                        if (i == 'filled_data_success') {
                            var filled_data_success = obj;
                            if (filled_data_success == 2) {
                                alert("Err...Can not enter more than assinged vancancy position.........");
                                location.reload();
                                $("input[type=text]").val("");
                                $('#excess_vacancy_detail_tbl tbody').html('');
                                $('#sanstha_dist_cd').val('');
                                $('#option_schl_type').val('');
                                $('#school_medium_code').val('');
                                $('#school_posts_code').val('');
                                $('#option_subject_code').val('');
                                $('#aid_type').val('');
                            }
                        }
                        $.each(obj, function(key, val) {

                            window.asst_flag = $.trim(val['0']['asst_flag']);
//                            var tr_id = ($.trim(val['0']['dist_code'])) + '~' + ($.trim(val['0']['schl_type'])) + '~' + ($.trim(val['0']['eo_code'])) + '~' + ($.trim(val['0']['sanstha_code'])) + '~' + ($.trim(val['0']['schl_id'])) + '~' + ($.trim(val['0']['eos_medium_id'])) + '~' + ($.trim(val['0']['eos_desg_cd'])) + '~' + ($.trim(val['0']['eos_type'])) + '~' + ($.trim(val['0']['eos_online_posts'])) + '~' + ($.trim(val['0']['eos_offline_posts'])) + '~' + ($.trim(val['0']['eos_no_of_post'])) + '~' + ($.trim(val['0']['eos_subject_cd'])) + '~' + ($.trim(val['0']['asst_flag'])) + '~' + ($.trim(val['0']['consider_vacancy_flag']))+ '~' + ($.trim(val['0']['aid_type']));
//                            tr += '<tr id=' + tr_id + '> <td class="col-xs-1">' + counter + '</td><td class="col-xs-1">' + ($.trim(val['0']['distname'])) + '</td><td class="col-xs-4" colspan="4">' + ($.trim(val['0']['school_name'])) + '</td><td class="col-xs-1">' + ($.trim(val['0']['post_desc'])) + '</td><td class="col-xs-1">' + ($.trim(val['0']['medinstr_desc'])) + '</td><td class="col-xs-1">' + ($.trim(val['0']['code_text'])) + '</td><td class="col-xs-2" colspan="2">' + ($.trim(val['0']['eos_no_of_post'])) + '</td><td class="col-xs-2" colspan="2">' + val['0']['aid_type'] + '</td><td class="col-xs-1"><input name="modify_btn" class="modbtn" type=button onclick="modify_btn_clicked(this)" value=Modify id=' + tr_id + '></td><td><input name="delete_btn" class="modbtn" type=button onclick="delete_btn_click(this)" value=Delete id=' + tr_id + '></td></tr>'
//                            counter++;
                            var tr_id = $.trim(val['0']['dist_code']) + '~' + $.trim(val['0']['schl_type']) + '~' + $.trim(val['0']['eo_code']) + '~' + $.trim(val['0']['sanstha_code']) + '~' + $.trim(val['0']['schl_id']) + '~' + $.trim(val['0']['eos_medium_id']) + '~' + $.trim(val['0']['eos_desg_cd']) + '~' + $.trim(val['0']['eos_type']) + '~' + $.trim(val['0']['eos_online_posts']) + '~' + $.trim(val['0']['eos_offline_posts']) + '~' + $.trim(val['0']['eos_no_of_post']) + '~' + $.trim(val['0']['eos_subject_cd']) + '~' + $.trim(val['0']['asst_flag']) + '~' + ($.trim(val['0']['consider_vacancy_flag']) + '~' + ($.trim(val['0']['aid_type'])));
                            tr += '<tr id=' + tr_id + '> <td class="col-xs-1">' + counter + '</td><td class="col-xs-1">' + val['0']['distname'] + '</td><td class="col-xs-4" colspan="4">' + val['0']['school_name'] + '</td><td class="col-xs-1">' + val['0']['post_desc'] + '</td><td class="col-xs-1">' + val['0']['medinstr_desc'] + '</td><td class="col-xs-1">' + val['0']['code_text'] + '</td><td class="col-xs-1" colspan="1">' + val['0']['eos_no_of_post'] + '</td><td class="col-xs-2" colspan="2">' + val['0']['aid_type'] + '</td><td class="col-xs-1"><input name="modify_btn" class="btn btn-sm logbutton2" type=button onclick="modify_btn_clicked(this)" value=Modify id=' + tr_id + '><input name="delete_btn" class="btn btn-sm logbutton2" type=button onclick="delete_btn_click(this)" value=Delete id=' + tr_id + '></td></tr>'
                            counter++;

                        });

                    });

                    $('#excess_vacancy_detail_tbl tbody').html('');
//                    alert("outer TR "+ tr);
                    $('#excess_vacancy_detail_tbl tbody').html(tr);

                    $('#save_modify_delete').val('');
                    $('#save_modify_delete_id').val('');

                    $('#option_subject_code').val('');
                    $('#no_of_excess_vancant_posts').val('');

//                    if (window.asst_flag == 'R') {
//                        alert("Data has been Rejected by EO.So Please modify it. ");
//                    }
//                    }
                });
            }

        });


        function isEmpty(check) {
            if (check == '') {
                return true;
            } else {
                return false;
            }
        }
        
        function isSchoolCode(check) {
            var schoolCode = /^([0-9]{11})$/;
            if (schoolCode.test(check) == false) {
                return true;
            } else {
                return false;
            }
        }
        
        $("#eos_online_posts").on('focusout', function() {
            var sanch_tot = Number($('#sanch_total').val());
            var wrking = Number($('#eos_online_posts').val());
            if (wrking > sanch_tot) {
                alert("Err...Cannot Enter more than defined posts.");
            }
        });
    });


    function modify_btn_clicked(obj) {
        $('#save_modify_delete').val('Modify');
        $('#save_modify_delete_id').val(obj.id);

        $('#school_posts_code').click();
        var sanch_proposed_total = Number($('#sanch_proposed_total').val());
        var arr = obj.id.split('~');
        var asst_flag = arr[12];
        if (asst_flag == 'F') {
            alert("Data has been Forwarded To EO.So you Can not modify it. ");
        }
//        else if (asst_flag == 'R') {
//            alert("Data has been Rejected by EO.");
//        }
        else if (asst_flag == 'V') {
            alert("Data has been Verified by EO.So you Can not modify it. ");
        }
        else if (asst_flag == 'A') {
            alert("Data has been Approved by EO.So you Can not modify it. ");
        }
        else if (asst_flag == 'Z' || asst_flag == 'C') {
            alert("This data is Filled / Updated by EO.So you Can not modify it. ");
        }
        else {
            $('#school_medium_code').val(arr[5]);
            $('#school_posts_code').val(arr[6]);

            var sanch_proposed_total = Number($('#sanch_proposed_total').val());
            var sanch_total = Number($('#sanch_total').val());

            $('#eos_online_posts').val(arr[8]);
            $('#eos_offline_posts').val(arr[9]);

            var eos_online_offline_tot_posts = Number(arr[8]) + Number(arr[9]);

            if (sanch_total > eos_online_offline_tot_posts) {//VACANT
                var radio_value = '2';
                var value = sanch_total - eos_online_offline_tot_posts;
                $('#excess_vacant_cal_posts_text').text('Vacant');
                $('#enter_no_of_posts_span').text('Vacant');
                document.getElementById('excess_vacant_cal_posts').value = value;
                $('#post_under_grad_tr').show();

                var get_sanstha_minority_type_hidden = $('#get_sanstha_minority_type_hidden').val();
                if (get_sanstha_minority_type_hidden == '1') {
                    $('#consider_vacancy_flag_tr').hide();
                }
                else if (get_sanstha_minority_type_hidden == '2') {
                    $('#consider_vacancy_flag_tr').show();

                    if (typeof arr[13] !== 'undefined') {
                        // your code here
                        if (arr[13] === 'Y') {
                            $('#SamayojanConsiderVacancyMinorityY').prop('checked', true);
                        } else {
                            $('#SamayojanConsiderVacancyMinorityN').prop('checked', true);
                        }
                    }

                }
            }

            $('#option_subject_code').val(arr[11]);
            $('#no_of_excess_vancant_posts').val(arr[10]);


        }

    }

    function delete_btn_click(obj) {

        $('#save_modify_delete').val('Delete');
        $('#save_modify_delete_id').val(obj.id);

        var arr = obj.id.split('~');

        var asst_flag = arr[12];
//        alert(asst_flag);
        if (asst_flag == 'F') {
            alert("Data has been Forwarded To EO.So you Can not delete it. ");
        }
//        else if (asst_flag == 'R') {
//            alert("Data has been Rejected by EO.");
//        }
        else if (asst_flag == 'V') {
            alert("Data has been Verified by EO.So you Can not delete it. ");
        }
        else if (asst_flag == 'A') {
            alert("Data has been Approved by EO.So you Can not delete it. ");
        }
        else if (asst_flag == 'Z' || asst_flag == 'C') {
            alert("This data is Filled / Updated by EO.So you Can not delete it. ");
        }
        else {
            var sanch_proposed_total = Number($('#sanch_proposed_total').val());
            var sanch_total = Number($('#sanch_proposed_total').val());
            var excess_vacant_cal_posts = Number(arr[8]);
            if (sanch_total > excess_vacant_cal_posts) {//VACANT
                var radio_value = '2';
                var value = sanch_total - excess_vacant_cal_posts;
                $('#excess_vacant_cal_posts_text').text('Vacant');
                document.getElementById('excess_vacant_cal_posts').value = value;
            }
            $('#eos_master_total').val(arr[8]);
            $('#option_subject_code').val(arr[10]);
            $('#reservation_category').val(arr[11]);
            $('#no_of_excess_vancant_posts').val(arr[9]);
            $('#save_excess_vacancy_detail').trigger('click');

        }
    }


    function excess_vacancy_declareValidationForm() {
        var flag = 1;
        var str = "";
//        var delete_btn_id = $("input[name=delete_btn]").attr('id');
        var save_modify_delete = ($('#save_modify_delete').val());
        var no_of_excess_vancant_posts = Number($('#no_of_excess_vancant_posts').val());
        var excess_vacant_cal_posts = Number($('#excess_vacant_cal_posts').val());
        var filled_no_of_excess_vancant_posts_hidden = Number($('#filled_no_of_excess_vancant_posts_hidden').val());
        var get_sanstha_minority_type_hidden = $('#get_sanstha_minority_type_hidden').val();
        var SamayojanConsiderVacancyMinority = $("input[name='consider_vacancy_minority']:checked").val();

        var sanch_total = Number($('#sanch_total').val());
        var eos_online_offline_tot_posts = Number($('#eos_online_offline_tot_posts').val());
        var aid_type = Number($('#aid_type').val());

        if (save_modify_delete != 'Delete') {
//        if (delete_btn_id == '') {
            var Alphapattern = /^[0-9]+$/; ///[0-9]|\./;
            var save_modify_delete

            if (Alphapattern.test(no_of_excess_vancant_posts) == false) {
                flag = 0;
                $('#no_of_excess_vancant_posts').val('');
                str = "\nPlease Enter Only Digits. ";
            }

            else if (no_of_excess_vancant_posts == '') {
                flag = 0;
                $('#no_of_excess_vancant_posts').val('');
                str = "\n Enter No. Vacant of Posts.";
            }

            else if (aid_type == '') {
                flag = 0;
                $('#aid_type').val('');
                str = "\n Select Aid Type.";
            }

            else if (no_of_excess_vancant_posts > excess_vacant_cal_posts) {
                flag = 0;
                $('#no_of_excess_vancant_posts').val();
                str = "\nPlease Enter Valid No. of Posts.";
            }

            else if (get_sanstha_minority_type_hidden == '2') {
                if ((sanch_total > eos_online_offline_tot_posts) === true) {
                    if (typeof SamayojanConsiderVacancyMinority === "undefined") {
                        flag = 0;
                        str = "\nPlease Select Is Sanstha ready to accept Excess Staff.";
                    }
                }

            }

            if (save_modify_delete == 'Modify') {

                if ((no_of_excess_vancant_posts) > excess_vacant_cal_posts) {
                    flag = 0;
                    $('#no_of_excess_vancant_posts').val('');
                    str = "\nPlease Enter Valid No. of Posts M.";
                }
                else if (get_sanstha_minority_type_hidden == '2') {
                    if ((sanch_total > eos_online_offline_tot_posts) === true) {
                        if (typeof SamayojanConsiderVacancyMinority === "undefined") {
                            flag = 0;
                            str = "\nPlease Select Is Sanstha ready to accept Excess Staff.";
                        }
                    }

                }
            }
            else
            {
                if ((no_of_excess_vancant_posts + filled_no_of_excess_vancant_posts_hidden) > excess_vacant_cal_posts) {
                    flag = 0;
                    $('#no_of_excess_vancant_posts').val('');
                    str = "\nPlease Enter Valid No. of Posts S.";
                }
                else if (get_sanstha_minority_type_hidden == '2') {
                    if ((sanch_total > eos_online_offline_tot_posts) === true) {
                        if (typeof SamayojanConsiderVacancyMinority === "undefined") {
                            flag = 0;
                            str = "\nPlease Select Is Sanstha ready to accept Excess Staff.";
                        }
                    }

                }
            }
        }

        if (flag) {
            return flag;
        } else {
            alert(str);
        }
    }
</script>
