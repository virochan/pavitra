<style>
    .table-fixed thead{width:98%;}
    .table-fixed thead tr th{text-align: center;border-left:1px solid #ddd;}
    .table-fixed tbody tr td{border-left:1px solid #92b2f4;font-size: 12px !important}
    .table-fixed tbody{height:140px;}
    .logbutton2{padding:2px 12px;margin:2px;}
   
</style>

<div class="map_head" style="margin:10px 0;height:auto;">
    <h3> Advertisement Details </h3>
</div>
<div class="table-responsive" style="overflow-x:hidden;"> 
    <table class="table table-fixed">
        <thead>
            <tr>
                <th class="col-xs-1" style="width:4.33333333%"><?php echo __('Sr.No.'); ?></th>
                <th class="col-xs-1"><?php echo __('For Medium'); ?>   </th>
                <th class="col-xs-2" colspan="2"><?php echo __('Designation'); ?></th>
                <th class="col-xs-3" colspan="3"><?php echo __('Pay Scale'); ?>   </th>
                <th class="col-xs-1"><?php echo __('No. of Posts'); ?> </th>
                <th class="col-xs-1"><?php echo __('Aid Type'); ?> </th>
                <th class="col-xs-1"><?php echo __('Subject'); ?> </th>
                <th class="col-xs-1" style="width:12.33333333%"><?php echo __('Min.Academic Qualification'); ?> </th>
                <th class="col-xs-1"><?php echo __('Min.Professional Qualification'); ?> </th>
                
            </tr>
        </thead>

        <tbody>
            <?php
            if (!empty($check)) {
                ?><?php
                $cnt = 1;
                for ($i = 0; $i < count($check); $i++) {
                    ?>
                <?php 
                if($check[$i]['0']['pv_desg_cd']=='21' || $check[$i]['0']['pv_desg_cd']=='22'){
                    $subj_desc=$check[$i]['0']['subject_name'];
                    }else{
                       $subj_desc=$check[$i]['0']['subject_group_desc']; 
                    }
                    
                    if($check[$i]['0']['pv_work_type']=='1'){
                    $wrk_type='(Part Time)';
                    }else{
                       $wrk_type='(Full Time)';
                    }
                    ?>
                    <tr>
                        <td class="col-xs-1" style="width:4.33333333%"><?php echo $cnt; ?></td>
                        <td class="col-xs-1"><?php echo $check[$i]['0']['medinstr_desc']; ?></td>
                        <td class="col-xs-2" colspan="2" id="desg_cd_<?php echo $check[$i]['0']['pv_desg_cd']; ?>"><?php echo $check[$i]['0']['post_desc']; ?><?php echo $wrk_type; ?></td>
                        <td class="col-xs-3" colspan="3"><?php echo $check[$i]['0']['psc_dscr']; ?>&nbsp;(<?php echo '&#8377';?> <?php echo $check[$i]['0']['psc_up_limit']; ?>)</td>
                        <td class="col-xs-1"><?php echo $check[$i]['0']['pv_no_of_post']; ?></td>
                        <td class="col-xs-1"><?php echo $check[$i]['0']['code_text']; ?></td>
                        
                        <td class="col-xs-1"><?php echo $subj_desc; ?></td>
                        <td class="col-xs-1" style="width:12.33333333%"><?php echo $check[$i]['0']['acad']; ?></td>
                        <td class="col-xs-1"><?php echo $check[$i]['0']['prof']; ?></td>
                     
                    </tr>
        <?php $cnt++;
    }
    ?>
            <?php } else { ?><tr> <td class="col-xs-12" colspan="12"><div><?php echo "No records found";
        }
            ?></div></td></tr>                                   
        </tbody>

    </table> 
</div>
