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

<script>
$(document).ready(function () {
    var staid = 27;
    $('#acad_qualificationTechrState').val(staid);
    $('#acd_qual').change(function () {
        var edu_lvl=$('#acd_qual').val();
        jQuery.post('SelectAcadQual', {edu_lvl: edu_lvl}, function(data) {
//                alert(data);
                $('#examdtl').html(data);
            });
    });
    
    $("input[name=RadioGroup]").on("change", function () {
        var ac = $('input:radio[name=RadioGroup]:checked').val();
        var AcadQual = $('#acd_qual').val();
        if(ac=='1'){
           $('#acad_qualificationTechrState').val(staid); 
            if (staid != '') {
                // alert(AcadQual);
                jQuery.post('BoardUnivbystateid', {level_id: AcadQual, state_id: staid}, function(data) {
                    // alert(data);
                    $('#borddtl').html(data);

                });
            }
        }
        else if(ac=='2'){
            $('#techr_board').val('');
            $('#acad_qualificationTechrState').val('');
            $("#acad_qualificationTechrState option[value='27']").hide();
        }
    });
    
    $('#acad_qualificationTechrState').unbind('change').bind('change', function (e) {
        var AcadQual = $('#acd_qual').val();
        var Acadstateid = $('#acad_qualificationTechrState').val();
        if (Acadstateid != '') {
            // alert(AcadQual);
            jQuery.post('BoardUnivbystateid', {level_id: AcadQual, state_id: Acadstateid}, function (data) {
                //alert(data);
                $('#borddtl').html(data);
            });
        }
    });
    
    $("#save_applicant_acad").click(function () {
        var acd_qual = $('#acd_qual').val();
        if(acd_qual=='0'){
            alert('Please Select Academic Qulaification');
            return false;
        }
        
        var acd_exam = $('#acad_qualificationTechrExam').val();
        alert(acd_exam);
        if(acd_exam=='undefined'){
            alert('Please Select Academic Degree');
            return false;
        }
        
        var x = document.getElementById("RadioGroupYes").checked;
        var y = document.getElementById("RadioGroupNo").checked;
        if ((x == false) && (y == false)) {
            alert('Please Select Degree State');
            return false;
        }
        
        var acd_state = $('#acad_qualificationTechrState').val();
        if(acd_state==''){
            alert('Please Select State');
            return false;
        }
        
        var acd_board = $('#acad_qualificationTechrBoard').val();
        alert(acd_board);
        if(acd_board==''){
            alert('Please Select Board');
            return false;
        }
        
        var acd_month = $('#acad_qualificationTechrMonthPass').val();
        if(acd_month==''){
            alert('Please Select passing Month');
            return false;
        }
        
        var acd_year = $('#acad_qualificationTechrYearPass').val();
        if(acd_year==''){
            alert('Please Select Year');
            return false;
        }
        
        var acd_percent = $('#acad_qualificationTechrMark').val();
        if(acd_percent==''){
            alert('Please Enter Percentage');
            return false;
        }
        
        var acd_grade = $('#acad_qualificationTechrGrade').val();
        if(acd_grade==''){
            alert('Please Enter Grade');
            return false;
        }
    });
    
});
</script>
<?php
$years = array_combine(range(date("Y"), 1950), range(date("Y"), 1950));
?>
<div>
    <?php echo $this->Form->create('acad_qualification', array('url' => array('controller' => 'Pavitras', 'action' => 'save_applicant_acad'), 'enctype' => 'multipart/form-data')); ?>
    <table class="table b_table" style="border-collapse:collapse;width:100%;margin-bottom:0px;">
        <tr>
            <td class="col-xs-9" colspan="9"></td>
            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="save_applicant_acad"  type="submit" name="submit"  value="<?php echo __('Save'); ?>" /></td>
            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="cancel_tch_personal" type="button" value="<?php echo __('Cancel'); ?>" /></td>
            <td class="col-xs-1" align="right"><input class="btn btn-sm logbutton2"  id="caste_hm_exit" type="button" value="<?php echo __('Exit'); ?>"/></td>
        </tr>
    </table>
    
    <div class="table-responsive">
        <table class="table table-fixed">
            <thead>
                <tr>
                    <th class="col-xs-1"><?php echo __('Sr.No.'); ?></th>
                    <th class="col-xs-1"><?php echo __('Education Qualification'); ?>   </th>
                    <th class="col-xs-1"><?php echo __('Name of Course'); ?></th>
                    <th class="col-xs-1"><?php echo __('Qualified from State'); ?>   </th>
                    <th class="col-xs-1"><?php echo __('Name of University/Board'); ?> </th>
                    <th class="col-xs-1"><?php echo __('Passed On'); ?> </th>
                    <th class="col-xs-1"><?php echo __('Marks Obtained'); ?> </th>
                    <th class="col-xs-1"><?php echo __('Max. Marks'); ?> </th>
                    <th class="col-xs-1"><?php echo __('Percentage'); ?> </th>
                    <th class="col-xs-1"><?php echo __('Percentile'); ?> </th>
                    <th class="col-xs-1"><?php echo __('CGPA'); ?> </th>
                    <th class="col-xs-1"><?php echo __('Grade'); ?> </th>
                </tr>
            </thead>

            <tbody>

            </tbody>
        </table> 
    </div>

    <div>
        <fieldset class="myfieldset">
            <legend><div class="legend_title"> Academic Qualification</div></legend>
            <div class="table-responsive fielddata">
                <table class="table b_table" id="fieldtable">
                    <tr>
                        <td class="col-xs-3" colspan="3">
                            <?php echo __('Academic Qualification') ?><span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php echo $this->Form->input('acd_qual', array('options' => $all_edu_level, 'label' => false, 'id'=>'acd_qual', 'empty' => array(0 => '-- Select Level --'))); ?>                                              
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php echo __('Examination / Degree') ?>  <span style="float:right;">&nbsp;:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3" id="examdtl" > 
                            <div style="float:left;"> <?php echo $this->Form->input('techr_exam', array('options' => '', 'label' => false, 'empty' => '-- Select Examition --')); ?></div>

                        </td>
                        <input type="hidden" name="hiddenqual" id="hiddenqual" value=""/>
                        <input type="hidden" name="hiddendeg" id="hiddendeg"  value=""/>
                    </tr>

                    <tr>
                        <td class="col-xs-3" colspan="3" >
                            <?php echo __('Is Degree From Maharashtra?') ?><span style="float:right;">:&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3"> 
                            <div style="float:left;">
                                <input type="radio" name="RadioGroup" id="RadioGroupYes" value="1" checked="checked">
                                <label id="1">Yes</label>
                            </div>
                            <div style="float:left;margin-left: 20px;">
                                <input type="radio" name="RadioGroup" id="RadioGroupNo" value="2" >
                                <label id="2">No</label>
                            </div>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php echo __('State') ?> <span style="float:right;"> :&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3"> 
                            <?php echo $this->Form->input('techr_state', array('options' => $allstates, 'label' => false,  'empty' => '-- Select State --')); ?>               
                        </td>
                    </tr>

                    <tr>
                        <td class="col-xs-3" colspan="3">
                            <?php echo __('Board / University') ?>  <span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td id="borddtl" class="col-xs-9" colspan="9"> 
                            <?php echo $this->Form->input('techr_board', array('options' => $allbordunilist, 'label' => false, 'name' => 'acad_qualificationTechrBoard', 'empty' => '-- Select University --')); ?>               
                        </td>
                    </tr>
                    <tr>
                        <td class="col-xs-3" colspan="3">
                            <?php echo __('Month Of Passing') ?> <span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3"> 

                            <?php echo $this->Form->input('techr_month_pass', array('options' => array('1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'), 'label' => false,  'empty' => '-- Select Month --')); ?>  
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php echo __('Year Of Passing') ?> <span style="float:right;">&nbsp;:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <input type="hidden" name="bdate" id="bdate" value=""/>
                        <input type="hidden" name="curryear" id="curryear"  value=""/>
                        <td id='tyear' class="col-xs-3" colspan="3"> 
                            <?php echo $this->Form->input('techr_year_pass', array('options'=>$years,'label' => false,  'empty' => '-- Select Year --')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-xs-3" colspan="3" >
                            <?php echo __('Percentage of Marks') ?> <span style="float:right;">:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3"> 
                            <?php echo $this->Form->input('techr_mark', array('label' => false, 'type' => 'text', 'maxlength' => '5')); ?>
                        </td>
                        <td class="col-xs-3" colspan="3">
                            <?php echo __('Grade') ?> <span style="float:right;">&nbsp;:&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="col-xs-3" colspan="3"> 
                            <?php echo $this->Form->input('techr_grade', array('label' => false, 'type' => 'text', 'maxlength' => '2')); ?>
                        </td>
                    </tr>
                </table>
            </div>
        </fieldset>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
