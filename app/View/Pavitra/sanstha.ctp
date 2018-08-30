<?php //

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!--<script>
    $(document).ready(function () {
        var pflag=$('#p_flag').val();
        var sflag=$('#s_flag').val();
        
        if(pflag=='R'){
            alert('Roster data for Primary Rejected by EO');
        }
        else if(pflag=='V'){
            alert('Roster data for Primary Verified by EO');
        }
        else if(pflag=='U'){
            alert('Roster data for Primary Unverified by EO');
        }
        else if(pflag=='F'){
            alert('Roster data for Primary Forwarded to EO');
        }
       
        if(sflag=='R'){
            alert('Roster data for Secondary Rejected by EO');
        }
        else if(sflag=='V'){
            alert('Roster data for Secondary Verified by EO');
        }
        else if(sflag=='U'){
            alert('Roster data for Secondary Unverified by EO');
        }
        else if(sflag=='F'){
            alert('Roster data for Secondary Forwarded to EO');
        }
    });
</script>-->
<!--
<div>
    <?php
//    pr(count($data_stat));exit;
    if(count($data_stat)==0){
        $p_flg='';
        $s_flg='';
    }
    if(count($data_stat)==1){
        if($data_stat[0][0]['roster_edn_level']=='P'){
           $p_flg=$data_stat[0][0]['asst_flag'];
           $s_flg='';
        }
        else if($data_stat[0][0]['roster_edn_level']=='S'){
            $p_flg='';
            $s_flg=$data_stat[0][0]['asst_flag'];
        }
    }
    
    if(count($data_stat)==2){
        $p_flg=$data_stat[0][0]['asst_flag'];
        $s_flg=$data_stat[1][0]['asst_flag'];
    }

    
    ?>
    <input type="hidden" id="p_flag" name="p_flag" value="<?php echo $p_flg; ?>"/>
    <input type="hidden" id="s_flag" name="s_flag" value="<?php echo $s_flg; ?>"/>
</div>-->