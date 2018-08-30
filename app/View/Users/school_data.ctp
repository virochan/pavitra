<style type="text/css">
    table.myTable{width: 100%;}
    table.myTable { border-collapse:collapse; }
    table.myTable td, table.myTable th { border:1px solid black;padding:5px; }
</style>
<div style="padding:0px; line-height: 20px;width: 100%;" id = "">
    <?php //foreach($schoolinfo as $school): ?>
    <table class="mytable" style="width:100%;">

        <tr>
            <td style="width:21%;">
                School <span style="float: right;">  : </span>
            </td>
            <td style="width: 70%;" >
                <?php echo "(" . $schoolinfo[0]['SchoolInfo']['schcd'] . ")" . $schoolinfo[0]['SchoolInfo']['schname']; ?>
            </td >

        </tr>

        <tr>
            <td >
                Address    <span style="float: right;">   : </span>
            </td>
            <td >
                <?php echo $schoolinfo[0]['SchoolInfo']['distname']; ?>
            </td>

        </tr>
        <tr>
            <td >
                Standard From <span style="float: right;">   : </span>
            </td>
            <td>
                <?php
                echo "" . $schoolStd[0][0]['lowclass'] . " To :" . $schoolStd[0][0]['highclass'];
                echo " Management : " . $schoolStd[0][0]['schmgtdet_desc'];
                ?>
            </td>

        </tr>

    </table>
    <?php //endforeach;   ?>
</div>



<div style="padding:5px;width: 100%;" >
    <table class="myTable">
        <tr >
            <td colspan="7" style="text-align: center;">Teaching and Non-Teaching staff as per Sanch Manyata(2016-17) 
            </td>
        </tr>
        <tr>
            <td style="width:30%;"></td>
            <td style="width:12%;"> Aided </td>
            <td style="width:12%;">Partially Aided </td>
            <td style="width:14%;">Unaided</td>
            <td style="width:14%;">Perm Unaided</td>
            <td style="width:14%;">Self </br>finance</td>
            <td style="width:14%;">Total</td>
        </tr>
        <tr>
            <td> Teachers Sanctioned   </td>
            <td><?php echo "" . $schoolinfoSanch[0][0]['aided']; ?></td>
            <td><?php echo "" . $schoolinfoSanch[0][0]['partpaided']; ?></td>
            <td><?php echo "" . $schoolinfoSanch[0][0]['unaided']; ?></td>
            <td><?php echo "" . $schoolinfoSanch[0][0]['perunaided']; ?></td>
            <td><?php echo "" . $schoolinfoSanch[0][0]['sf']; ?> </td>
            <td><?php echo "" . ($schoolinfoSanch[0][0]['aided'] + $schoolinfoSanch[0][0]['partpaided'] + $schoolinfoSanch[0][0]['unaided'] + $schoolinfoSanch[0][0]['perunaided'] + $schoolinfoSanch[0][0]['sf']); ?> </td>
        </tr>
        <tr>
            <td> Teachers Working     </td>
            <td><?php echo "" . $SchoolInfoStaffDtl[0][0]['aided_staff']; ?></td>
            <td><?php echo "" . $SchoolInfoStaffDtl[0][0]['partpaided_staff']; ?></td>
            <td><?php echo "" . $SchoolInfoStaffDtl[0][0]['asunaided_staff']; ?></td>
            <td><?php echo "" . $SchoolInfoStaffDtl[0][0]['perunaided_staff']; ?></td>
            <td><?php echo "" . $SchoolInfoStaffDtl[0][0]['sf_staff']; ?></td>
            <td><?php echo "" . ($SchoolInfoStaffDtl[0][0]['aided_staff'] + $SchoolInfoStaffDtl[0][0]['partpaided_staff'] + $SchoolInfoStaffDtl[0][0]['asunaided_staff'] + $SchoolInfoStaffDtl[0][0]['perunaided_staff'] + $SchoolInfoStaffDtl[0][0]['sf_staff']); ?> </td>
        </tr>
        <tr>
            <td> Non-Teachers Sanctioned    </td>
            <td><?php echo "" . $SchoolInfoSanDtlNteach[0][0]['aided']; ?></td>
            <td><?php echo "" . $SchoolInfoSanDtlNteach[0][0]['partpaided']; ?></td>
            <td><?php echo "" . $SchoolInfoSanDtlNteach[0][0]['unaided']; ?></td>
            <td><?php echo "" . $SchoolInfoSanDtlNteach[0][0]['perunaided']; ?></td>
            <td><?php echo "" . $SchoolInfoSanDtlNteach[0][0]['sf']; ?></td>
            <td><?php echo "" . ($SchoolInfoSanDtlNteach[0][0]['aided'] + $SchoolInfoSanDtlNteach[0][0]['partpaided'] + $SchoolInfoSanDtlNteach[0][0]['unaided'] + $SchoolInfoSanDtlNteach[0][0]['perunaided'] + $SchoolInfoSanDtlNteach[0][0]['sf']); ?> </td>
        </tr>
        <tr>
            <td>Non-Teachers Working</td>
            <td><?php echo "" . $SchoolInfoStaffDtlNtech[0][0]['aided_staff']; ?></td>
            <td><?php echo "" . $SchoolInfoStaffDtlNtech[0][0]['partpaided_staff']; ?></td>
            <td><?php echo "" . $SchoolInfoStaffDtlNtech[0][0]['asunaided_staff']; ?></td>
            <td><?php echo "" . $SchoolInfoStaffDtlNtech[0][0]['perunaided_staff']; ?></td>
            <td><?php echo "" . $SchoolInfoStaffDtlNtech[0][0]['sf_staff']; ?></td>
            <td><?php echo "" . ($SchoolInfoStaffDtlNtech[0][0]['aided_staff'] + $SchoolInfoStaffDtlNtech[0][0]['partpaided_staff'] + $SchoolInfoStaffDtlNtech[0][0]['asunaided_staff'] + $SchoolInfoStaffDtlNtech[0][0]['perunaided_staff'] + $SchoolInfoStaffDtlNtech[0][0]['sf_staff']); ?> </td>
        </tr>
    </table>
</div>