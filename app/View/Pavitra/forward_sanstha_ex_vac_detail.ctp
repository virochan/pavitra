<?php
$eo_sanstha_ex_vac_tot = 0;
$smj_excesstch_det_tot = 0;
$eos_type_main = 0;
$eos_desg_cd_main = 0;
?>
<style>
    .legend_title{width:30%;}
    #frwcastdetails{border:1px solid #678cd8 ;background: #fff;}
    #frwcastdetails thead th{text-align: center}
    #frwcastdetails tbody tr td{border-left:1px solid #678cd8  !important;}
    .notehead{padding:0 10px;}
</style>
<fieldset class="myfieldset" style="width:100%;">

    <legend> <div class="legend_title"><?php echo __('Statistical Information on Excess/Vacant Posts'); ?> </div></legend>

    <table style="width:100%;" class="note">
        <tr>
            <td>
                <span class="notehead" >Note :</span> Statistical information on Vacancy details will be forwarded for the selected post. 
            </td>
        </tr>
    </table>


    <?php
    if (!empty($school_details)) {
        ?>
    <div class="table-responsive">
        <table class="table" id="frwcastdetails">
            <thead>
                <tr>
            <th class="col-xs-1"><?php echo __('Sr No.') ?></th>
            <th class="col-xs-7" colspan="7"><?php echo __('School Name') ?></th>
            <th class="col-xs-1"><?php echo __('Medium') ?> </th>
            <th class="col-xs-1"><?php echo __('Subject') ?> </th>
            <th class="col-xs-2" colspan="2"><?php echo __('Excess/Vacant') ?> </th>
            </tr>
            </thead>

            <tbody> 


                <?php
                $cnt = 1;
                $arrcount = sizeof($school_details);

                for ($i = 0; $i < $arrcount; $i++) {


                    if (isset($school_details[$i][0]['schl_id'])) {
                        $schl_id = $school_details[$i][0]['schl_id'];
                    } else {
                        $schl_id = '';
                    }

                    if (isset($school_details[$i][0]['school_name'])) {
                        $school_name = $school_details[$i][0]['school_name'];
                    } else {
                        $school_name = '-';
                    }

                    if (isset($school_details[$i][0]['eos_desg_cd'])) {
                        $eos_desg_cd = $school_details[$i][0]['eos_desg_cd'];
                    } else {
                        $eos_desg_cd = '';
                    }

                    if (isset($school_details[$i][0]['post_desc'])) {
                        $post_desc = $school_details[$i][0]['post_desc'];
                    } else {
                        $post_desc = '-';
                    }

                    if (isset($school_details[$i][0]['eos_medium_id'])) {
                        $eos_medium_id = $school_details[$i][0]['eos_medium_id'];
                    } else {
                        $eos_medium_id = '';
                    }

                    if (isset($school_details[$i][0]['medinstr_desc'])) {
                        $medinstr_desc = $school_details[$i][0]['medinstr_desc'];
                    } else {
                        $medinstr_desc = '-';
                    }

                    if (isset($school_details[$i][0]['eos_subject_cd'])) {
                        $eos_subject_cd = $school_details[$i][0]['eos_subject_cd'];
                    } else {
                        $eos_subject_cd = '';
                    }

                    if (isset($school_details[$i][0]['subject_desc'])) {
                        $subject_desc = $school_details[$i][0]['subject_desc'];
                    } else {
                        $subject_desc = '-';
                    }


                    if (isset($school_details[$i][0]['eos_no_of_post'])) {
                        $eos_no_of_post = $school_details[$i][0]['eos_no_of_post'];
                    } else {
                        $eos_no_of_post = 0;
                    }

                    if (isset($school_details[$i][0]['schl_type'])) {
                        $schl_type = $school_details[$i][0]['schl_type'];
                    } else {
                        $schl_type = '';
                    }
                    if (isset($school_details[$i][0]['eo_code'])) {
                        $eo_code = $school_details[$i][0]['eo_code'];
                    } else {
                        $eo_code = '';
                    }
                    if (isset($school_details[$i][0]['dist_code'])) {
                        $dist_code = $school_details[$i][0]['dist_code'];
                    } else {
                        $dist_code = '';
                    }

                    if (isset($school_details[$i][0]['eos_online_posts'])) {
                        $eos_online_posts = $school_details[$i][0]['eos_online_posts'];
                    } else {
                        $eos_online_posts = '';
                    }
                    if (isset($school_details[$i][0]['eos_offline_posts'])) {
                        $eos_offline_posts = $school_details[$i][0]['eos_offline_posts'];
                    } else {
                        $eos_offline_posts = '';
                    }

                    if (isset($school_details[$i][0]['eos_type'])) {
                        $eos_type = $school_details[$i][0]['eos_type'];
                    } else {
                        $eos_type = 0;
                    }

                    if (isset($school_details[$i][0]['sanstha_code'])) {
                        $sanstha_code = $school_details[$i][0]['sanstha_code'];
                    } else {
                        $sanstha_code = '';
                    }

                    $eo_sanstha_ex_vac_tot +=$eos_no_of_post;
                    $eos_type_main = $eos_type;
                    $eos_desg_cd_main = $eos_desg_cd;
                    $tr_id = $dist_code . '~' . $schl_type . '~' . $eo_code . '~' . $sanstha_code . '~' . $schl_id . '~' . $eos_medium_id . '~' . $eos_desg_cd . '~' . $eos_online_posts . '~' . $eos_offline_posts . '~' . $eos_type . '~' . $eos_no_of_post . '~' . $eos_subject_cd;
                    ?>



                    <tr id ="<?php echo $tr_id; ?>">
                        <td class="col-xs-1" align="center"><?php echo $cnt; ?></td>
                        <td class="col-xs-7" colspan="7"><?php echo $school_name; ?></td>
                        <td class="col-xs-1"><?php echo $medinstr_desc; ?></td>                
                        <td class="col-xs-1"><?php echo $subject_desc; ?></td>
                        <td class="col-xs-2" colspan="2" align="center"><?php echo $eos_no_of_post; ?></td>
                    </tr>
                    <?php
                    $cnt++;
                }
                ?>
            </tbody>
        </table>
    </div>    
        <?php
    } else {
        ?>
        <table id="frwcastdetails" style="width: 100%; height: 50px; text-align: center; text-transform: capitalize; font-weight:bold;" border="0">
            <tr>
                <td>No Records Available For forward</td>
            </tr>
        </table>

    <?php }
    ?>   
</tbody>
</table>
</fieldset>
<?php
echo $this->Form->input('eo_sanstha_ex_vac_tot', array('id' => 'eo_sanstha_ex_vac_tot', 'value' => $eo_sanstha_ex_vac_tot, 'type' => 'hidden', 'readonly' => 'readonly'));
echo $this->Form->input('smj_excesstch_det_tot', array('id' => 'smj_excesstch_det_tot', 'value' => $smj_excesstch_det_tot, 'type' => 'hidden', 'readonly' => 'readonly'));
echo $this->Form->input('eos_type_main', array('id' => 'eos_type_main', 'value' => $eos_type_main, 'type' => 'hidden', 'readonly' => 'readonly'));
echo $this->Form->input('eos_desg_cd_main', array('id' => 'eos_desg_cd_main', 'value' => $eos_desg_cd_main, 'type' => 'hidden', 'readonly' => 'readonly'));

$sanstha_code_main = $this->Session->read('user_id');
//echo $this->Form->input('tr_id', array('id' => 'eos_type', 'value' => $tr_id, 'type' => 'text', 'readonly' => 'readonly'));
echo $this->Form->input('sanstha_code_main', array('id' => 'sanstha_code_main', 'value' => $sanstha_code_main, 'type' => 'hidden', 'readonly' => 'readonly'));
?>


<!--<style>
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
/*----------------------------------End of Code------------------------------------------- */
</style>-->


<?php echo $this->Form->end(); ?>

<script>
    $(document).ready(function () {


//        $('#forward_eo_common').click(function () {
//            alert('12345');
//            var eo_sanstha_ex_vac_tot = ('#eo_sanstha_ex_vac_tot').val();
//            alert(eo_sanstha_ex_vac_tot);
//            var smj_excesstch_det_tot = ('#smj_excesstch_det_tot').val();
//            alert(smj_excesstch_det_tot);
//            $("#TeacherNewrecruitmenttechstaffForm").submit(); //fwdexvacdettoeo
//
//        });




//        $(".checkbox1").click(function () {
//            $("#selecctall").prop('checked', ($('.checkbox1:checked').length == $('.checkbox1').length) ? true : false);
//        });

        $('#cancel_tch_personal').click(function (event) {
            var someObj = {};
            someObj.fruitsGranted = [];
            someObj.fruitsDenied = [];
            $('.checkbox1').each(function () { //loop through each checkbox
                var selckbx = $(this).attr("id");
                someObj.fruitsGranted.push(selckbx);
                this.checked = false;  //select all checkboxes with class "checkbox1"              
            });
            jQuery("#selecctall").attr('checked', false);
        });

        $('#exit_tch').click(function () {
            var url = 'sanstha';
            $(location).attr('href', url);
        });

//        $('#selecctall').click(function (event) {
//            var someObj = {};
//            someObj.fruitsGranted = [];
//            someObj.fruitsDenied = [];
//            if ($("#selecctall").is(':checked')) {
//                $('.checkbox1').each(function () { //loop through each checkbox
//                    var selckbx = $(this).attr("id");
//                    someObj.fruitsGranted.push(selckbx);
//                    $('input[type="submit"]').removeAttr('disabled');
//                    // alert(someObj.fruitsGranted);
//                    this.checked = true;  //select all checkboxes with class "checkbox1"              
//                });
//            } else {
//                $('.checkbox1').each(function () { //loop through each checkbox
//                    var selckbx = $(this).attr("id");
//                    someObj.fruitsGranted.push(selckbx);
//                    //  alert(someObj.fruitsGranted);
//                    this.checked = false;  //select all checkboxes with class "checkbox1"              
//                });
//
//            }
//        });

    });
</script>	
