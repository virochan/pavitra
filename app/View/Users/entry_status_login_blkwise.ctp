<?php

echo $this->Html->script('jquery-1.7.2');
echo $this->Html->css('jquery.dataTables.css');
echo $this->Html->script('jquery.dataTables');
?>

<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        $('#sd_entry_status_login_blkwise').dataTable({
            "pagingType": "full_numbers",
            "bFilter": false,
            "aoColumns": [
                {"sWidth": "5%"},
                {"sWidth": "10%"},
                {"sWidth": "5%"},
                {"sWidth": "5%"},
                {"sWidth": "20px"},
                {"sWidth": "20px"},
                {"sWidth": "20px"},
                {"sWidth": "20px"},
                {"sWidth": "20px"},
                {"sWidth": "20px"}
            ],
        });

    });
</script>
<div style="text-align: left; background:#C6EBF0; border-bottom:3px solid #32A1B6; display:block; padding:3px 0;float:left;width:40%;" id="blkdisname">District : </div>
<div style="text-align: left; background:#C6EBF0; border-bottom:3px solid #32A1B6; display:block; padding:3px 4px;float:left;width:35%;">Blockwise Data Entry Statistics</div>

<div style="text-align: right; background:#C6EBF0; border-bottom:3px solid #32A1B6; display:block; padding:3px 0;float:left;width:25%;">as on Date : 
<?php 
 date_default_timezone_set("Asia/Kolkata");
 //echo date(' d/m/Y '); 
 App::uses('Xml', 'Utility');
                $xmlString = '../View/XML/districtwise.xml';
//                $xmlString = '/wwwroot/Education/app/View/XML/districtwise.xml';
                $xmlArray = Xml::toArray(Xml::build($xmlString));
                date_default_timezone_set("Asia/Kolkata");
                if (file_exists($xmlString)) {
                    $timeFileChhanged = date(filemtime($xmlString));
                } ?>
<?php echo date('d/m/Y (g:i a)', $timeFileChhanged); ?></div>
<div style="display:block; padding:3px 2%; border:1px Solid #ccc; background:#f6f6f6; box-sizing:border-box; border-radius:0 0 0.5em 0.5em">
    <table id="sd_entry_status_login_blkwise" class="display dataTable no-footer" cellspacing="0" style="width: 700px;padding: 9px 0 0 0;margin-left: 10px;margin-right: 10px;" border="0">
        <thead>
            <tr style="background-color: #32A1B6;">
                <th >Sr. No.</th>
                <th >Block Name</th>
                <th>No. of Schools</th>
                <th>No. of Posts</th>
                <th>Data Entered by Schools</th>
                <th>Staff Entered</th>                
            </tr>
        </thead>
        <tbody>
            <?php // echo "<pre>";	print_r($blkDetail); exit;
            $i = 0;
            $j = 1;
            $stud_total = 0;
            $sch_total = 0;
            $no_of_posts = 0;
            $data_entr_by_schls = 0;
            $staff_entered = 0;
           
            
            for ($i; $i < count($blkDetail); $i++) {
               
                echo "<tr id=" . trim($blkDetail[$i][0]['blkcd']).'*'.$blkDetail[$i][0]['blkname'] . " name=" . $i . ">";
                echo "<td align='center'>";
                echo $j;
                echo "</td>";
                echo "<td align='left' style='cursor:pointer;'>";
                echo "<a href='#' style='text-decoration:none;'>" . ucwords(strtolower($blkDetail[$i][0]['blkname'])) . "</a>";
                echo "</td>";
                echo "<td align='center'>";
                echo number_format(floatval($blkDetail[$i][0]['sch_cnt_sanch_manayta']));
                echo "</td>";
                echo "<td align='center'>";
                echo number_format(floatval($blkDetail[$i][0]['tch_cnt_sanch_manayta']));
                echo "</td>";
                echo "<td align='center'>";
                echo number_format(floatval($blkDetail[$i][0]['filled_sch']));
                echo "</td>";
                echo "<td align='center'>";
                echo number_format(floatval($blkDetail[$i][0]['filled_tchr']));
                echo "</td>";
                
//                echo "<td align='center'>";
//                
//                $sum =  $blkDetail[$i][0]['mapped_tot'] + $blkDetail[$i][0]['updated_tot'] + $blkDetail[$i][0]['discrepancy_tot'] +
//                        $blkDetail[$i][0]['forarwded_tot'] + $blkDetail[$i][0]['verify_tot']+ $blkDetail[$i][0]['rejected_tot'];
//                echo $sum;
//                echo "</td>";s
                echo "</tr>";

//                $stud_total = $stud_total + $blkDetail[$i][0]['tchr_count'];
                $sch_total = $sch_total + $blkDetail[$i][0]['sch_cnt_sanch_manayta'];
                $no_of_posts = $no_of_posts + $blkDetail[$i][0]['tch_cnt_sanch_manayta'];
                $data_entr_by_schls = $data_entr_by_schls + $blkDetail[$i][0]['filled_sch'];
                $staff_entered = $staff_entered + $blkDetail[$i][0]['filled_tchr'];

                $j++;
            }

            echo "<thead><tr style='background-color:#32A1B6;'>";
            echo "<th>";
            echo "";
            echo "</th>";
            echo "<th>";
            echo "Total";
            echo "</th>";
            echo "<th align='center'>";
            echo number_format($sch_total);
            echo "</th>";
            echo "<th align='center'>";
            echo number_format($no_of_posts);
            echo "</th>";
            echo "<th align='center'>";
            echo number_format($data_entr_by_schls);
            echo "</th>";
            echo "<th align='center'>";
            echo number_format($staff_entered);
            echo "</th>";
            echo "</tr></thead>";
            ?>
        </tbody>
    </table>
</div>