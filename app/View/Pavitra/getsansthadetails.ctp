<?php
//$age=0;
//$category=0;
//$flag = 0;
//$data=0;
if (!empty($applicant_data)) {
    $flag = 1;
}
//$CT = 0;
$j = 1;
if (!empty($check)) {
    for ($i = 0; $i < count($check); $i++) {
        ?>
        <table>
            <tr>
                <td class="col-xs-1" align="center"><?php echo $j++; ?></td>
                <td class="col-xs-2" colspan="2"><?php echo $check[$i][0]['post_desc']; ?></td>
                <td class="col-xs-1"><?php echo $check[$i][0]['psc_up_limit']; ?></td>
                <td class="col-xs-1" align="center"><?php echo $check[$i][0]['pv_no_of_post']; ?> </td>
                <td class="col-xs-1"><?php echo $check[$i][0]['code_text']; ?> </td>
                <td class="col-xs-1"><?php echo $check[$i][0]['subject_name']; ?> </td>
                <td class="col-xs-2" colspan="2"><?php echo $check[$i][0]['acad']; ?> </td>
                <td class="col-xs-2" colspan="2"><?php echo $check[$i][0]['prof']; ?> </td>
                <td class="col-xs-1" align="center"><input type="checkbox" name="bla[]" value=<?php echo $user_id; ?>></td>
            </tr>
            <input  type="hidden" name="subject" id="subject" value=<?php echo @$subject; ?>>
            <!--<input  type="hidden" name="Cat" id="Cat" value=<?php echo @$category; ?>>-->
            <input  type="hidden" name="age" id="age" value=<?php echo @$age; ?>>
            <input  type="hidden" name="qual" id="qual" value=<?php echo @$Qualification; ?>>
            <input  type="hidden" name="sub" id="sub" value=<?php echo @$check[$i][0]['pv_subject_cd']; ?>>
            <input  type="hidden" name="wrk_type" id="wrk_type" value=<?php echo @$check[$i][0]['pv_work_type']; ?>>
            <input  type="hidden" name="recordexist" id="recordexist" value=<?php echo @$data; ?>>
            <input  type="hidden" name="ca_roster_edn_level" id="ca_roster_edn_level" value=<?php @$applicant_detail[0]['PvCategAdvt']['ca_roster_edn_level'] ?>>
        </table>
        <?php
    }
}
?>
