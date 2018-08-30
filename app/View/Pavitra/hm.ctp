<?php
echo $this->Html->script('common');
?>
<style>
    #logsection{
        border-top:solid 1px rgb(139, 220, 255);
        border-bottom:solid 1px rgb(139, 220, 255);
        width:100%;
        height:50px;
        background-color: rgb(199, 236, 253);
        background: #fdfdfd; /* Old browsers */
        -webkit-box-shadow:inset 0 0 10px 5px rgba(199,236,253,1);
        box-shadow:inset 0 0 10px 5px rgba(199,236,253,1);
        margin-bottom:10px;
    }
    .myTable {
        width:100%;
    }
    .myTable, .myTd   {
        border: 1px solid black;
        border-collapse: collapse;
    }
    .myTd ,.myTr {
        padding: 5px;
        text-align: left;
    }

    #page-wrap {
        margin: 50px;
    }
    .table_grid { 
        width: 100%; 
        height:50px;
        margin: auto;
        border-collapse: collapse; 
        background-color:white;
    }
    /* Zebra striping */
    .tr_grid:nth-of-type(odd) { 
        background: #fff; 
    }
    .th_grid { 
        background:#C0E5FD; 
        color: rgb(84, 98, 111); 
    }
    .td_grid, .th_grid { 
        padding: 6px; 
        border: 1px solid #32A1B6;
        text-align: left; 
    }
    .myfieldset tr div p {
        color: #F00;
    }
    .myfieldset tr div p {
        color: #FF8080;
    }
	

#hmtable td {
      border-bottom: 1px solid #ccc;
      padding: 5px;
      text-align: left; /* IE */
      cursor:pointer;
    }
#hmtable td + td {
      border-left: 1px solid #32A1B6;
    }
	
	
#hmtable th {
      padding: 0 5px;
      text-align: left; /* IE */
    }
	
    .header-background {
      border-bottom: 1px solid #32A1B6;
    }
    
    /* above this is decorative, not part of the test */
    
    
    .fixed-table-container-inner {
      overflow-x: hidden;
      overflow-y: auto;
      height: 100%;
    }
     
    .header-background {
      background-color: #D5ECFF;
      height: 30px; /* height of header */
      position: absolute;
      top: 0;
      right: 0;
      left: 0;
    }
    
    #hmtable {
      background-color: white;
      width: 100%;
      overflow-x: hidden;
      overflow-y: auto;
    }

 #hmtable .th-inner {
      position: absolute;
      top: 0;
      line-height: 30px; /* height of header */
      text-align: left;
      border-left: 1px solid rgb(18, 113, 130);
      padding-left: 5px;
      margin-left: -5px;
     color: rgb(246, 253, 255);
    }
    #hmtable .first .th-inner {
        border-left: none;
        padding-left: 6px;
      }
	  .fixed-table-container {
      width: 70%;
      height: 120px;
      border: 1px solid black;
      margin: 10px auto;
      background-color: white;
      /* above is decorative or flexible */
      position: relative; /* could be absolute or relative */
      padding-top: 30px; /* height of header */
    }

    .fixed-table-container-inner {
      overflow-x: hidden;
      overflow-y: auto;
      height: 100%;
    }
     
    .header-background {
      background-color:#32A1B6;
      height: 30px; /* height of header */
      position: absolute;
      top: 0;
      right: 0;
      left: 0;
    }
    #hmtable .first  {
        border-left: none;
        padding-left: 6px;
		width:10%;
      } 
	  
	  #hmtable .second  {
        border-left: none;
        padding-left: 6px;
		width:70%;
      } 
		
		
</style>
<script>
    $(document.body).on('click', '.pending', function() {
        $desc = $(this).attr('id');
        jQuery.post(window.webroot+'Teachers/mappedlist', {desc: $desc}, function(data) {
            $('#list').html(data);
        });
    });
</script>

<?php
//echo "<pre>".print_r($FindedSchoolName,true)."</pre>";exit();
//echo "<br>USER ID(sch cd)     = ".$this->Session->read('user_id');
//echo "<br>MODULE DESC = ".$this->Session->read('module_desc');
//echo "<br>ROLE DESC   = ".$this->Session->read('role_desc');
?>

<?php
$user_id = $this->Session->read('user_id');
$module_desc = $this->Session->read('module_desc');
$role_desc = $this->Session->read('role_desc');
if ($role_desc = 'hm') {
    $role_desc = "Head Master";
}
?>
<!--<script language="javascript" type="text/javascript">
    alert(
            "Welcome" + ''
            "Login as      :  <?php //echo $role_desc                 ?>" + +
            "User             :  <?php //echo $role_desc                 ?>" + '\n' +
            "Authority as :  <?php //echo $role_desc                 ?>"
            );
</script>-->

     <table id="logindetailtbl" width="100%">
                    <tr>
                        <td>
                            <table  border="0" class="tdhead" style="border-collapse:collapse;width:100%;">
                                <tr style="height:16px;padding-top:5px;">
                                    <td width="10%" style="padding-left:2.5%;color:rgb(194, 67, 21);font-weight: bold;">
                                        <?php echo __('School'); ?>  <span style="float:right">&nbsp;:&nbsp;</span> 
                                    </td>
                                

                                    <td width="13%" style="color:rgb(194, 67, 21);font-weight: bold;">
                                        <?php echo __('Academic Year'); ?> <span>&nbsp;:&nbsp;</span> 
                                    </td>
                                    <td>
                                       <?php
                                        if(($this->Session->read('acad_year_tchr')))
                                             echo $this->Session->read('acad_year_tchr');
                                        else
                                            echo "-";
                                        ?>
                                    </td>
                                </tr>     
                            </table>

                            <table border="0" class="tdhead2">    
                                <tr>
                                 <td width="10%" style="padding-top:3px;color:rgb(194, 67, 21);font-weight:bold;">
                                       <img src="../img/login_role.png"  style="float:left;"/><?php echo __('Login as'); ?><span>&nbsp;:&nbsp;</span> 
                                    </td>
                                    <td width="22%">
                                        (<?php echo "" . $this->Session->read('user_id'); ?>)&nbsp;<?php echo "" . $this->Session->read('role_desc'); ?>                      
                                    </td>
                          

                                </tr> 
                            </table>
                        </td>
                    </tr>
                </table>

