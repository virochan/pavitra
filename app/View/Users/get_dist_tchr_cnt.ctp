<?php

echo $this->Html->script('jquery-1.7.2');
echo $this->Html->css('jquery.dataTables.css');
echo $this->Html->script('jquery.dataTables');
?>

<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {
        $('#student_database_distdata').dataTable({
            //"pagingType": "full_numbers",
            "paging": false,
            "bFilter": false,
            "bDestroy": true,
            stateSave: true,
            "bPaginate": false,
            'iDisplayLength': 25,
            'bLengthChange': false,
            "bAutoWidth": false,
            "aoColumns": [
                {"sWidth": "22px"},
                {"sWidth": "60px"},
                {"sWidth": "30px"},
                {"sWidth": "30px"},
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
<script type="text/javascript" language="javascript" class="init">
    $(document).ready(function () {

        $("#student_database_distdata tbody").delegate("tr", "click", function (evt) {
            $distcd = $(this).attr('id');
            var $cell = $(evt.target).closest('td');
            $expRowIdDist = $(this).attr('name');



            if ($cell.index() == 1) {
                jQuery.post('../Users/entry_status_login_blkwise', {distcd: $distcd}, function (data) {
                    $disname = $("#disname").text();
                    $('#blkdata').html(data);
                    $('#blkdata').show();
                    $("#blkdisname").append($disname)
                    $('#cludata').hide();
                    $('#schdata').hide();
                    $('#divdata').hide();
                    $('#studdata').hide();

                    $("#sd_entry_status_login_blkwise tbody").delegate("tr", "click", function (evt) {
                        $blkcd_data = $(this).attr('id');
                        // alert($blkcd);
                        $blk = $blkcd_data.split("*");
                        $blkcd = $blk[0];
                        $blkcd_name = $blk[1];
                        // alert($blk_data[0]); alert($blk_data[1]);
                        var $cell = $(evt.target).closest('td');
                        $expRowIdBlk = $(this).attr('name');


                        if ($cell.index() == 1) {
                            jQuery.post('../Users/entry_status_login_cluwise', {distcd: $distcd, blkcd: $blkcd}, function (data) {                                 // $blkname = $("#blkname").text();
                                $('#cludata').html(data);
                                $('#cludata').show();
                                $("#clsblkname").append($blkcd_name);
                                $('#schdata').hide();
                                $('#divdata').hide();
                                $('#studdata').hide();

                                $("#sd_entry_status_login_cluwise tbody").delegate("tr", "click", function (evt) {
                                    $clucd = $(this).attr('id');
                                    var $cell = $(evt.target).closest('td');
                                    $expRowIdSch = $(this).attr('name');

                                    if ($cell.index() == 1) {
                                        jQuery.post('../Reports/entry_status_login_schwise', {distcd: $distcd, blkcd: $blkcd, clucd: $clucd}, function (data) {
                                            $('#schdata').html(data);
                                            $('#schdata').show();
                                            $('#divdata').hide();
                                            $('#studdata').hide();

                                            $("#sd_entry_status_login_schwise tbody").delegate("tr", "click", function (evt) {
                                                $schcd = $(this).attr('id');
                                                var $cell = $(evt.target).closest('td');
                                                $expRowIdSch = $(this).attr('name');
                                                //alert($distcd+"*****"+$blkcd+"****"+$expRowId);
//                                                if ($cell.index() == 0) {
//                                                    $('#showMinusSch' + $expRowIdSch).toggle();
//                                                    $('#showPlusSch' + $expRowIdSch).toggle();
//                                                    $('#expRowSch' + $expRowIdSch).toggle();
//                                                    jQuery.post('../Reports/exp_login_dist_detail', {distcd: $distcd, blkcd: $blkcd, schcd: $schcd}, function(data) {
//                                                        $('#showExpTabSch' + $expRowIdSch).html(data);
//                                                        $('#showExpTabSch' + $expRowIdSch).show();
//                                                    });
//                                                }

                                                if ($cell.index() == 1) {
                                                    jQuery.post('../Reports/entry_status_login_divwise', {distcd: $distcd, blkcd: $blkcd, schcd: $schcd}, function (data) {
                                                        $('#divdata').html(data);
                                                        $('#divdata').show();
                                                        $('#studdata').hide();
                                                        $("#sd_entry_status_login_divwise tbody").delegate("tr", "click", function (evt) {
                                                            $combcd = $(this).attr('id');
                                                            var temp = $combcd.split('*');
                                                            var standard = temp[0].trim();
                                                            var division = temp[1].trim();
                                                            var $cell = $(evt.target).closest('td');
                                                            $expRowIdDiv = $(this).attr('name');
//                                                            if ($cell.index() == 0) {
//                                                                $('#showMinusDiv' + $expRowIdDiv).toggle();
//                                                                $('#showPlusDiv' + $expRowIdDiv).toggle();
//                                                                $('#expRowDiv' + $expRowIdDiv).toggle();
//                                                                jQuery.post('../Reports/exp_login_dist_detail', {schcd: $schcd, std: standard, div: division}, function(data) {
//                                                                    $('#showExpTabDiv' + $expRowIdDiv).html(data);
//                                                                    $('#showExpTabDiv' + $expRowIdDiv).show();
//                                                                });
//                                                            }
                                                            if ($cell.index() == 1) {
                                                                jQuery.post('../Reports/entry_status_login_studdata', {schcd: $schcd, std: standard, div: division}, function (data) {
                                                                    $('#studdata').html(data);
                                                                    $('#studdata').show();
                                                                });
                                                            }
                                                        });
                                                    });
                                                }
                                            });
                                        });
                                    }
                                });


                            });
                        }
                    });
                });
            }
            ;
        });
    });
</script>

<div style="text-align: center; background:#C6EBF0; border-bottom:3px solid #32A1B6; display:block; padding:3px 0 3px 33%;width:70%;float:left;">Data Entry Statistics for District</div>
<div style="text-align: right; background:#C6EBF0; border-bottom:3px solid #32A1B6; display:block; padding:3px 4px;float:left;width:30%;">as on Date :
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
<?php echo date('d/m/Y (g:i a) ', $timeFileChhanged); ?></div>
<div style="display:block; padding:3px 2%; border:1px Solid #ccc; background:#f6f6f6; box-sizing:border-box; border-radius:0 0 0.5em 0.5em">
    <table id="student_database_distdata" class="display dataTable no-footer" cellspacing="0" style="width: 700px;padding: 9px 0 0 0;margin-left: 10px;margin-right: 10px;" border="0">
        <thead>
            <tr style="background-color: #32A1B6;">
                <th>Sr. No.</th>
                <th>District Name</th>
                <th>No. of Schools</th>
                <th>No. of Posts</th>
                <th>Data Entered by Schools</th>
                <th>Staff Entered</th>
                <!--<th>Total</th>-->
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            $j = 1;
            $selected_total = 0;
            $admitted_total = 0;
            $rejected_total = 0;
            $not_approached_total = 0;
            $remaining_total = 0;
            $school_total = 0;  $sum = 0;
			
            if (isset($distData)) { 
                foreach ($distData as $distDetail) {
	
                    echo "<tr id=" . $distDetail[0]['dist_cd'] . "  name=" . $i . ">";
                    echo "<td align='center'>";
                    echo $j;
                    echo "</td>";
                    echo "<td align='center' id='disname' style='text-decoration:underline;cursor:pointer;'>";
                    echo ucwords(strtolower($distDetail[0]['distname'])); 
                    echo "</td>";
                    echo "<td align='center'>";
              echo number_format(floatval($distDetail[0]['sch_cnt_sanch_manayta'])) > 0 ? number_format(floatval($distDetail[0]['sch_cnt_sanch_manayta'])) : 0;
                    echo "</td>";
                    echo "<td align='center'>";
              echo number_format(floatval($distDetail[0]['tch_cnt_sanch_manayta'])) > 0 ? number_format(floatval($distDetail[0]['tch_cnt_sanch_manayta'])) : 0;
                    echo "</td>";
                    echo "<td align='center'>";
              echo number_format(floatval($distDetail[0]['filled_sch'])) > 0 ? number_format(floatval($distDetail[0]['filled_sch'])) : 0;
                    echo "</td>";
                    echo "<td align='center'>";
               echo number_format(floatval($distDetail[0]['filled_tchr'])) > 0 ? number_format(floatval($distDetail[0]['filled_tchr'])) : 0;
                    
//                    echo "<td align='center'>";
//                    $sum =  $distDetail[0]['mapped_tot'] + $distDetail[0]['updated_tot'] + $distDetail[0]['discrepancy_tot'] + $distDetail[0]['forarwded_tot'] + $distDetail[0]['verify_tot']
//                            + $distDetail[0]['rejected_tot'];
//                    echo $sum;
//                    echo "</td>";
//                    echo "</tr>";
                    $i++;
                    $j++;

                    echo "</tr>";
                    echo "<tr id=expRowDist" . $i . " style='display:none;'>";
                    echo "<td colspan='8' align='left'>";
                    echo "<div id=showExpTabDist" . $i . " style='display:none;'></div>";
                }
            }
            ?>
        </tbody>
    </table>
</div>
