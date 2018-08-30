<?php
echo $this->Html->script('jquery-1.7.2');
echo $this->Html->script('jquery.ui.datepicker');
echo $this->Html->css('jquery.ui.all');
echo $this->Html->script('jquery.ui.core');
echo $this->Html->css('bootstrap.min');
echo $this->Html->script('bootstrap.min');
?>
<style>
    .table{margin-bottom:0px}
</style>

<script>
    $(document).ready(function () {

        $('#main_table').hide();
        var numpattern = /^[0-9]*$/;
        //$('input:radio[id=tchr_type][value=2]').attr('disabled', true);
        var sess_val = $('#sess_val').val();

        if (sess_val.indexOf('SC') >= 0) {
            //$('#tchr_type1').attr('checked','true');
        } else if (sess_val.indexOf('CB') >= 0) {
            $('#tchr_type1').attr('checked', 'true');
        } else if (sess_val.indexOf('EO') >= 0) {
            $('#tchr_type1').attr('checked', 'true');
        } else if (sess_val.indexOf('DD') >= 0) {
            $('#tchr_type1').attr('checked', 'true');
        }

        $("#roster_cancel").click(function () {
            location.reload();
        });

        $("#tchr_type1").click(function () {
            $('#staff_group').trigger('change');
        });
        $("#tchr_type2").click(function () {
            $('#staff_group').trigger('change');
        });
        $("#caste_hm_exit").click(function () {
            var url = 'sanstha';
            $(location).attr('href', url);
        });
        
        $('.soc_ctg').each(function () {
            if ($(this).val() == '') {
                $(this).val('0');
            }
        });
        $(".soc_ctg").change(function () {
            if (numpattern.test($(this).val()) == false) {
                alert("ERR...Invalid Data. Please Enter Digits ...");
                $(this).val('0');
            }
        });
        
        $("#staff_group").change(function () {
         
            var staff_group = $('#staff_group').val();
            var edu_level = $('input:radio[name=edu_level]:checked').val();
            if(edu_level=='1'){
                $('#tchr_type1').attr('disabled', false);
                $('#tchr_type2').attr('disabled', true);
            }
            else{
                $('#tchr_type2').attr('disabled', false);
                $('#tchr_type1').attr('disabled', true);
            }
            var tchr_type = $('#tchr_type').val();
            $('#main_table').show();
            
             jQuery.post(window.webroot + 'Pavitras/get_soc_categ_data', {staff_group: staff_group,edu_level:edu_level,tchr_type:tchr_type}, function (data) {
                    
                    $.each(data, function (key, val) {
                        $.each(val, function (key, val) {
                            $.each(val, function (key, val) {

                                 
                                if (key === 'soc_women_tot') {
                                     $('#soc_women_tot').val(val);
                                }
                                if (key === 'soc_ex_srvc_tot') {
                                     $('#soc_ex_srvc_tot').val(val);
                                }
                                if (key === 'soc_proj_afct_tot') {
                                     $('#soc_proj_afct_tot').val(val);
                                }
                                if (key === 'soc_earth_qk_tot') {
                                     $('#soc_earth_qk_tot').val(val);
                                }
                                if (key === 'soc_pdo_tot') {
                                     $('#soc_pdo_tot').val(val);
                                }
                                if (key === 'soc_pdb_tot') {
                                     $('#soc_pdb_tot').val(val);
                                }
                                if (key === 'soc_pdd_tot') {
                                     $('#soc_pdd_tot').val(val);
                                }
                                if (key === 'soc_sports_tot') {
                                     $('#soc_sports_tot').val(val);
                                }
                                if (key === 'soc_anshk_tot') {
                                     $('#soc_anshk_tot').val(val);
                                }
                                if (key === 'soc_ff_tot') {
                                     $('#soc_ff_tot').val(val);
                                }
                           
               

                            });
                        });
                    });
               },'json');
           
        });

        $("#social_ctg_submit").click(function () {

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
	         

<?php echo $this->Form->create('social_ctg_save', array('url' => array('controller' => 'Pavitras', 'action' => 'social_ctg_save'), 'enctype' => 'multipart/form-data')); ?>
<input type="hidden" name="sess_val" value="<?php echo $sansthacode; ?>" id="sess_val"/> 

<table class="table note">
    <tr>
        <td style="padding: 2px 12px;">
            <span class="notehead"><?php echo __('Note :'); ?></span> 
        </td>

    </tr>
</table>

<div>
    <div>
        <div class="form_content" align="center">
            <div class="map_head" style="min-height:115px;height:auto">
                <h3> Social Categorywise Backlogs</h3>
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
                            <td class="col-xs-1"><input  type="submit" name="submit" id="social_ctg_submit" value="Save" class="btn btn-sm logbutton2"></td>
                            <td class="col-xs-1"><input  type="button" name="cancel" id="roster_cancel" value="Cancel" class="btn btn-sm logbutton2"></td>
                            <td class="col-xs-1"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Exit" class="btn btn-sm logbutton2">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div id="main_table">
                <div class="table-responsive" >
                    <table class="table table_extract" border="0" style="width:60%; background:#fff;margin-top:15px;">
                        <thead>    
                            <tr>
                                <th class="col-xs-1">Sr. No</th>
                                <th class="col-xs-2" colspan="2">Social Category Name </th>
<!--                                <th class="col-xs-3" colspan="3"> Sanctioned post(As per roster) </th>
                                <th class="col-xs-3" colspan="3">Total Working Saff Approved </th>-->
                                <th class="col-xs-3" colspan="3">Total Vacancies</th>
                               <!-- <th width="33" class="th_grid" style="line-height: 15px;"> <?php //echo __('Class To');                                                                                                                                                                                                    ?> </th>-->
                            </tr>
                        </thead>
                        <tbody>
                            
<!--                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php echo $all_soc_ctg[0];?>">                                                                                                                                                                                     
                                <td class="col-xs-1">1</td>
                                <td class="col-xs-2" colspan="2" style="text-align:left !important"><?php echo $all_soc_ctg[0];?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('sc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'soc_ctg', 'id' => 'soc_ctg_1')); ?></td>
                            </tr>-->

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php echo $all_soc_ctg[1];?>">
                                <td class="col-xs-1">1</td>
                                <td class="col-xs-2" colspan="2" style="text-align:left !important"><?php echo $all_soc_ctg[1];?></td>
                               <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('soc_women_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'soc_ctg', 'id' => 'soc_women_tot')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php echo $all_soc_ctg[2];?>">
                               <td class="col-xs-1">2</td>
                                <td class="col-xs-2" colspan="2" style="text-align:left !important"><?php echo $all_soc_ctg[2];?></td>
                               <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('soc_ex_srvc_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'soc_ctg', 'id' => 'soc_ex_srvc_tot')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php echo $all_soc_ctg[3];?>">
                                <td class="col-xs-1">3</td>
                                <td class="col-xs-2" colspan="2" style="text-align:left !important"><?php echo $all_soc_ctg[3];?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('soc_proj_afct_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'soc_ctg', 'id' => 'soc_proj_afct_tot')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php echo $all_soc_ctg[4];?>">
                                <td class="col-xs-1">4</td>
                                <td class="col-xs-2" colspan="2" style="text-align:left !important"><?php echo $all_soc_ctg[4];?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('soc_earth_qk_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'soc_ctg', 'id' => 'soc_earth_qk_tot')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php echo $all_soc_ctg[5];?>">
                                <td class="col-xs-1">5</td>
                                <td class="col-xs-2" colspan="2" style="text-align:left !important"><?php echo $all_soc_ctg[5];?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('soc_pdo_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'soc_ctg', 'id' => 'soc_pdo_tot')); ?></td>

                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php echo $all_soc_ctg[6];?>">
                                <td class="col-xs-1">6</td>
                                <td class="col-xs-2" colspan="2" style="text-align:left !important"><?php echo $all_soc_ctg[6];?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('soc_pdb_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'soc_ctg', 'id' => 'soc_pdb_tot')); ?></td>

                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php echo $all_soc_ctg[7];?>">
                                <td class="col-xs-1">7</td>
                                <td class="col-xs-2" colspan="2" style="text-align:left !important"><?php echo $all_soc_ctg[7];?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('soc_pdd_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'soc_ctg', 'id' => 'soc_pdd_tot')); ?></td>
                            </tr>

                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php echo $all_soc_ctg[8];?>">
                                <td class="col-xs-1">8</td>
                                <td class="col-xs-2" colspan="2" style="text-align:left !important"><?php echo $all_soc_ctg[8];?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('soc_sports_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'soc_ctg', 'id' => 'soc_sports_tot')); ?></td>
                            </tr>
                            
                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php echo $all_soc_ctg[9];?>">
                                <td class="col-xs-1">9</td>
                                <td class="col-xs-2" colspan="2" style="text-align:left !important"><?php echo $all_soc_ctg[9];?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('soc_anshk_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'soc_ctg', 'id' => 'soc_anshk_tot')); ?></td>
                            </tr>
                            
                            <tr style="cursor: pointer;" class=" Subjectdtl" id="<?php echo $all_soc_ctg[13];?>">
                                <td class="col-xs-1">10</td>
                                <td class="col-xs-2" colspan="2" style="text-align:left !important"><?php echo $all_soc_ctg[13];?></td>
                                <td class="col-xs-3" colspan="3"><?php echo $this->Form->input('soc_ff_tot', array('label' => false, 'autocomplete' => 'off', 'type' => 'text', 'maxlength' => '50', 'style' => 'width:50% !important;  text-align:center;', 'class' => 'soc_ctg', 'id' => 'soc_ff_tot')); ?></td>
                            </tr>

                        </tbody>
                    </table>  
                </div>	
            </div>
        </div>
        <?php //echo $this->Form->end();       ?>  
    </div>
</div>
<?php echo $this->Form->end(); ?>

