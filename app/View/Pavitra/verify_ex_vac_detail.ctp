<?php
$eo_sanstha_ex_vac_tot = 0;
$smj_excesstch_det_tot = 0;
$eos_type_main = 0;
$eos_desg_cd_main = 0;
?>
<fieldset class="myfieldset" style="width:100%;">

    <legend><div class="legend_title"><?php  echo __('Statistical Information on Vacant Posts'); ?></div></legend>

    <table style="width:100%;" class="note">
        <tr>
            <td>
                <span class="notehead" >Note :</span> Statistical information on Vacancy details will be verified/rejected for the selected post. 
            </td>
        </tr>
    </table>


    <?php
    if (!empty($school_details)) {
        ?>
        <table id="frwcastdetails" class="table_grid" border="0">
            <thead>
            <tr class="tr_grid">
            <th  class="th_grid "><div class="th-inner"><?php echo __('Sr No.') ?></div></th>
            <th class="th_grid"><div class="th-inner"><?php echo __('School Name') ?></div></th>
            <th class="th_grid"><div class="th-inner"><?php echo __('Medium') ?></div> </th>
            <th class="th_grid" width="20%"><div class="th-inner"><?php echo __('Subject') ?></div> </th>
            <th  class="th_grid"><div class="th-inner"><?php echo __('Vacant') ?></div> </th>
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

                    <tr class="tr_grid" id ="<?php echo $tr_id; ?>">
                        <td class="td_grid"><div align="left"><?php echo $cnt; ?></div></td>
                        <td class="td_grid"><div align="left"><?php echo $school_name; ?></div></td>
                        <td class="td_grid"><div align="left"><?php echo $medinstr_desc; ?></div></td>                
                        <td class="td_grid"><div align="left"><?php echo $subject_desc; ?></div></td>
                        <td class="td_grid"><div align="left"><?php echo $eos_no_of_post; ?></div></td>
                    </tr>
                    <?php
                    $cnt++;
                }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        ?>
        <table id="frwcastdetails" style="width: 100%; height: 50px; text-align: center; text-transform: capitalize; font-weight:bold;" border="0">
            <tr>
                <td>No  Vacancy Records Available For forward</td>
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

//echo $this->Form->input('tr_id', array('id' => 'eos_type', 'value' => $tr_id, 'type' => 'text', 'readonly' => 'readonly'));

echo $this->Form->input('sanstha_code', array('id' => 'eos_type', 'value' => $sanstha_code, 'type' => 'hidden', 'readonly' => 'readonly'));
?>

<?php echo $this->Form->end(); ?>

<script>
    $(document).ready(function () {
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
            var url = 'minority_nonminority';
            $(location).attr('href', url);
        });
    });
</script>	
