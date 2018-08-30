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
                <h3> View Applicant</h3>
                <table class="table b_table" width="100%" id="eoroster">
                    <tr>
                        <td class="col-xs-2" colspan="2" align="center">Select Designation <span style="float:right;font-weight:bold">:</span> </td>
                        <td class="col-xs-2" colspan="2"> 
                            <?php
                            echo $this->Form->input('sanstha', array('options' => '', 'id' => 'sanstha', 'label' => false, 'empty' => '-- Select Designation--', 'style' => 'width:100%; float: left;'));
                            ?>    
                        </td>
                        <td class="col-xs-2" colspan="2" align="center">Select Medium <span style="float:right;font-weight:bold">:</span> </td>
                        <td class="col-xs-2" colspan="2"> 
                            <?php
                            echo $this->Form->input('sanstha', array('options' => '', 'id' => 'sanstha', 'label' => false, 'empty' => '-- Select Medium--', 'style' => 'width:100%; float: left;'));
                            ?>    
                        </td>
                        <td class="col-xs-2" colspan="2"> </td>
                        <td class="col-xs-1"><input  type="submit" name="submit" id="roster_submit" value="Submit" class="btn btn-sm logbutton2"></td>
                        <td class="col-xs-1"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Exit" class="btn btn-sm logbutton2"></td>
                    </tr>
                    <tr>
                        <td class="col-xs-2" colspan="2" align="center">Select Sanstha <span style="float:right;font-weight:bold">:</span> </td>
                        <td class="col-xs-6" colspan="6"> 
                            <?php
                            echo $this->Form->input('sanstha', array('options' => '', 'id' => 'sanstha', 'label' => false, 'empty' => '-- Select Sanstha--', 'style' => 'width:100%; float: left;'));
                            ?>    
                        </td>
                        <td class="col-xs-4" colspan="4"></td>
                    </tr>
<!--                    <tr>
                        <td class="col-xs-2" colspan="2" align="center">Select District  <span style="float:right;font-weight:bold">:</span></td>
                        <td class="col-xs-2" colspan="2"> 
                    <?php
//                    echo $this->Form->input('sanstha', array('options' => '', 'id' => 'sanstha', 'label' => false, 'empty' => '-- Select District--', 'style' => 'width:100%; float: left;'));
                    ?>    
                        </td>

                    </tr>-->

<!--                <tr>
   
     <td class="col-xs-10" colspan="10"> </td>
     <td class="col-xs-1"><input  type="submit" name="submit" id="roster_submit" value="Submit" class="btn btn-sm logbutton2"></td>
     <td class="col-xs-1"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Exit" class="btn btn-sm logbutton2"></td>
     
 </tr>-->
                </table> 

            </div>

            <div>
                <!--                <div class="map_head" style="margin:10px 0;height:auto">
                                    <h3> Applicant details</h3>
                                </div>-->
                <table
                    <tr>
                        <td class="col-xs-6"> </td>
                        <td class="col-xs-5"> </td>
                        <td><input  type="submit" name="Apply" id="roster_submit" value="Accept" class="btn btn-sm logbutton2"></td>
                        <td class="col-xs-1"><input  type="button" name="caste_hm_exit" id="caste_hm_exit" value="Reject" class="btn btn-sm logbutton2"></td>
                    </tr>
                </table>
                <table class="table table-fixed">   
                    <thead>
                        <tr>
                            <th class="col-xs-1"><?php echo __('Sr.No.'); ?></th>
                            <th class="col-xs-2"><?php echo __('Name'); ?>   </th>
                            <th class="col-xs-1" colspan="2"><?php echo __('Category'); ?>   </th>
                            <th class="col-xs-2"><?php echo __('Aid Type'); ?> </th>
                            <th class="col-xs-2"><?php echo __('Subject'); ?> </th>
                            <th class="col-xs-2"><?php echo __('Applied for Post'); ?> </th>
                            <th class="col-xs-1" colspan="2" ><?php echo __('Pay Scale'); ?> </th>
                            <!--<th class="col-xs-2" colspan="2"><?php echo __('Min.Professional Qualification'); ?> </th>-->
                            <th class="col-xs-1" colspan="1"><?php echo __('Select'); ?> </th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table> 
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div>