<?php
//if (isset($check) && $check != '') {
//    $jsonArr[] = $check;
//	echo json_encode($jsonArr);
//}
?>
<style>
    .table-fixed thead{width:98%;}
    .table-fixed thead tr th{text-align: center;border-left:1px solid #ddd;}
    .table-fixed tbody tr td{border-left:1px solid #92b2f4;font-size: 12px !important}
    .table-fixed tbody{height:140px;}
    .logbutton2{padding:2px 12px;margin:2px;}
   
</style>


<div class="table-responsive">
    <table class="table table-fixed">
        <thead>
            <tr>
                <th class="col-xs-1" style="width:4.33333333%"><?php echo __('Sr.No.'); ?></th>
                <th class="col-xs-1"><?php echo __('For Medium'); ?>   </th>
                <th class="col-xs-2" colspan="2"><?php echo __('Designation'); ?></th>
                <th class="col-xs-2" colspan="3"><?php echo __('Pay Scale'); ?>   </th>
                <th class="col-xs-1"><?php echo __('No. of Posts'); ?> </th>
                <th class="col-xs-1"><?php echo __('Aid Type'); ?> </th>
                <th class="col-xs-1"><?php echo __('Subject'); ?> </th>
                <th class="col-xs-1" style="width:12.33333333%"><?php echo __('Min.Academic Qualification'); ?> </th>
                <th class="col-xs-1"><?php echo __('Min.Professional Qualification'); ?> </th>
                <th class="col-xs-1"><?php echo __('Action'); ?> </th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (!empty($check)) {
                $count_rows= count($check);
                $flag=$check['0']['0']['asst_flag'];
                $adv_dt=$check['0']['0']['pv_advertise_dt'];
                $adv_st_dt=$check['0']['0']['pv_advertise_frm_dt'];
                $adv_end_dt=$check['0']['0']['pv_advertise_to_dt'];
                
//                echo $flag;
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
                        <td class="col-xs-2" colspan="2"><?php echo $check[$i]['0']['psc_dscr']; ?>&nbsp;(<?php echo '&#8377';?> <?php echo $check[$i]['0']['psc_up_limit']; ?>)</td>
                        <td class="col-xs-1"><?php echo $check[$i]['0']['pv_no_of_post']; ?></td>
                        <td class="col-xs-1"><?php echo $check[$i]['0']['code_text']; ?></td>
                        
                        <td class="col-xs-1"><?php echo $subj_desc; ?></td>
                        <td class="col-xs-1" style="width:12.33333333%"><?php echo $check[$i]['0']['acad']; ?></td>
                        <td class="col-xs-1"><?php echo $check[$i]['0']['prof']; ?></td>
                        <td class="col-xs-1" id="btn_up_d">
                            <a class="logbutton2 upd" style="cursor:pointer;" onclick = "javascript: return update_row(<?php echo $check[$i]['0']['id']; ?>,<?php echo $check[$i]['0']['pv_acad_lvl']; ?>,<?php echo $check[$i]['0']['pv_prof_lvl']; ?>,<?php echo $check[$i]['0']['pv_desg_cd']; ?>);">
                                <i class="icon-edit icon-white"></i>UPDATE</a>
                            <a class="logbutton2 del" style="cursor:pointer;" onclick = "javascript: return delete_row(<?php echo $check[$i]['0']['id']; ?>);">
                                <i class="icon-edit icon-white"></i>DELETE</a>
                        </td>
                    </tr>
        <?php $cnt++;
    }
    ?>
            <?php } else {
                $flag='';
                $count_rows='0';
                $adv_dt=''; $adv_st_dt=''; $adv_end_dt='';
               
                ?><tr> <td class="col-xs-12" ><div><?php echo "No records found";
        }
            ?></div></td></tr>                                   
        </tbody>

    </table> 
    <input type="hidden" id="flag" value="<?php echo $flag;?>"/>
    <input type="hidden" id="count_rows" value="<?php echo $count_rows;?>"/>
    <input type="hidden" id="tot_bcklg" value="<?php echo $tot_bcklg['0']['0']['tot_bcklg'];?>"/>
    <input type="hidden" id="post_count" value="<?php echo $post_count['0']['0']['sum']; ?>"/>
    <input type="hidden" id="adv_dt" value="<?php echo $adv_dt; ?>"/>
    <input type="hidden" id="adv_st_dt" value="<?php echo $adv_st_dt; ?>"/>
    <input type="hidden" id="adv_end_dt" value="<?php echo $adv_end_dt; ?>"/>
</div>

<script>

$(document).ready(function () {
    var flag = $('#flag').val();
    var tot_bcklg = $('#tot_bcklg').val();
    var post_count = $('#post_count').val();
    var count_rows = $('#count_rows').val();
    var adv_dt = $('#adv_dt').val();

   

    
    if(flag=='F'){
        alert('Advertisement has been forwarded to EO. Data cannot be entered/modified');
        $("input").prop('disabled', true);
        $("#roster_cancel").prop('disabled', false);
        $("#caste_hm_exit").prop('disabled', false);
        $("#btn_up_d").prop('disabled', true);
        $(".del").css('pointer-events', 'none');
        $(".upd").css('pointer-events', 'none');
    }
    if(flag=='A'){
        alert('Advertisement has been Verified and Approved by EO. Data cannot be changed');
        $("input").prop('disabled', true);
        $("#roster_cancel").prop('disabled', false);
        $("#caste_hm_exit").prop('disabled', false);
        $("#btn_up_d").prop('disabled', true);
        $(".del").css('pointer-events', 'none');
        $(".upd").css('pointer-events', 'none');
   }
//   if(post_count>=tot_bcklg){
//       alert('You have exceeded the limit of posts available according to the backlog. No more advertisements can be posted');
//        $("input").prop('disabled', true);
//        $("#roster_cancel").prop('disabled', false);
//        $("#caste_hm_exit").prop('disabled', false);
//        $("#btn_up_d").prop('disabled', true);
//   }
});
</script>
