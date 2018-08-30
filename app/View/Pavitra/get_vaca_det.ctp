<?php ?>
<style>
    .vac_det tbody tr td {border:1px solid #b6c9f2;}
</style>

<div class="map_head" style="min-height:115px;height:auto;margin-top: 23px;">
    <h3> Vacancy Details as Per School Type</h3>
    <div class="table-responsive" style="height:auto;margin-top: 10px;">
        <table class="table vac_det">
            <thead>
                <tr>
                    <th class="col-xs-1" style="width:4.33333333%"><?php echo __('Sr.No.'); ?></th>
                    <th class="col-xs-1"><?php echo __('District'); ?>   </th>
                    <th class="col-xs-5"><?php echo __('School Name'); ?>   </th>
                    <th class="col-xs-1"><?php echo __('Medium'); ?> </th>
                    <th class="col-xs-2"><?php echo __('Designation'); ?> </th>
                    <th class="col-xs-1"><?php echo __('Subject'); ?> </th>
                    <th class="col-xs-1"><?php echo __('Vacant Posts'); ?></th>
                    <th class="col-xs-1"><?php echo __('Select Desingtion to Extract'); ?></th>

                </tr>
            </thead>

            <tbody>
                <?php
                if (!empty($check)) {
                    ?><?php
                    $cnt = 1;
                    for ($i = 0; $i < count($check); $i++) {
                        $vaca_count = $check[$i][0]['eos_no_of_post'] - $check[$i][0]['shifted_tchr_cnt'];
                        ?>

                        <tr>
                            <td class="col-xs-1" style="width:4.33333333%"><?php echo $cnt; ?></td>
                            <td class="col-xs-1"><?php echo $check[$i][0]['distname']; ?></td>
                            <td class="col-xs-5"><?php echo $check[$i][0]['school_name']; ?><?php echo "(" . $check[$i][0]['schl_id'] . ")"; ?></td>
                            <td class="col-xs-1"><?php echo $check[$i][0]['medinstr_desc']; ?></td>
                            <td class="col-xs-2"><?php echo $check[$i][0]['post_desc']; ?></td>
                            <td class="col-xs-1"><?php echo $check[$i][0]['subject_group_desc']; ?></td>
                            <td class="col-xs-1"><?php echo $vaca_count; ?></td>
                            <td class="col-xs-1" align="center">
                                <input type="checkbox" name=bla[] value="<?php echo trim($check[$i][0]['schl_id']).'-'.trim($check[$i][0]['eos_desg_cd']).'-'.trim($check[$i][0]['eos_medium_id']).'-'.trim($check[$i][0]['eos_subject_cd']); ?>">
                            </td>
                        </tr>
                        <?php
                        $cnt++;
                    }
                    ?>
                <?php } else { ?><tr> <td class="col-xs-12" ><div><?php
                                echo "No records found";
                            }
                            ?></div></td></tr>                                   
            </tbody>

        </table> 
    </div>
</div>
