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

    <?php echo $this->Form->create('view_aplnt', array('url' => array('controller' => 'Pavitras', 'action' => ''), 'enctype' => 'multipart/form-data')); ?>
    <table class="table note">
        <tr>
            <td style="padding: 2px 12px;">
                <span class="notehead"><?php echo __('Note :Below is the list of applicants who have applied in this sanstha'); ?></span> 
            </td>

        </tr>
    </table>
    <div id="main_table">
        <div class="table-responsive" >
            <table class="table table_extract" border="0" style="width:100%; background:#fff;margin-top:15px;">
                <thead>    
                    <tr>
                        <th class="col-xs-1" rowspan="2">Sr. No</th>
                        <th class="col-xs-2" colspan="2" rowspan="2">Applicant Name</th>
                        <th class="col-xs-1" colspan="1" rowspan="2">Date of Birth</th>
                        <th class="col-xs-2" colspan="2">Qualification</th>
                        <th class="col-xs-1" colspan="1" rowspan="2">Marks</th>
                        <th class="col-xs-1" colspan="1" rowspan="2">Caste Category</th>
                        <th class="col-xs-2" colspan="2" rowspan="2">Applied for Post</th>
                        <th class="col-xs-1" colspan="1" rowspan="2">Subject</th>
                        <th class="col-xs-1" colspan="1" rowspan="2">Status</th>
                       <!-- <th width="33" class="th_grid" style="line-height: 15px;"> <?php //echo __('Class To');                                                                                                                                                                                                    ?> </th>-->
                    </tr>
                    <tr>
                        <th class="col-xs-1" >Acad.</th>
                        <th class="col-xs-1" >Prof.</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php
                    if (!empty($check)) {

                        ?><?php
                        $cnt = 1;
                        for ($i = 0; $i < count($check); $i++) {
                            ?>

                        <tr>
                            <td class="col-xs-1" style="width:4.33333333%"><?php echo $cnt; ?></td>
                            <td class="col-xs-2"  colspan="2" ><?php echo $check[$i]['0']['appl_fname']. ' ' .$check[$i]['0']['appl_mname'].' '. $check[$i]['0']['appl_lname']; ?></td>
                            <td class="col-xs-1"><?php echo $check[$i]['0']['pv_apptn_dob']; ?></td>
                            <td class="col-xs-1"><?php echo '' ?></td>
                            <td class="col-xs-1"><?php echo '' ?></td>
                            <td class="col-xs-1"><?php echo '' ?></td>
                            <td class="col-xs-1"><?php echo '' ?></td>
                            <td class="col-xs-2" colspan="2"><?php echo $check[$i]['0']['post_desc']; ?></td>
                            <td class="col-xs-1"><?php echo ''?></td>
                            <td class="col-xs-1"><?php echo $check[$i]['0']['flag_text']; ?></td>

                       
                        </tr>
                        <?php $cnt++;
                    }
                    ?>
                <?php } else {


                    ?><tr> <td class="col-xs-12" ><div><?php echo "No records found";
            }
                ?></div></td></tr>                                   
            </tbody>
            </table>  
        </div>	
    </div>
    <?php echo $this->Form->end(); ?>
</div>