<style>
        #goback{float:right;font-size: 16px;font-weight: bold;}
    #goback:hover{cursor: pointer;}
    
    .backtohome a img{
        float: left; margin-right: 5px; max-width: 25px; max-height: 25px;
    }
</style>
<?php
    echo $this->fetch('script');
   echo $this->Html->script('jquery-1.7.2');
    echo $this->Html->script('jquery.dataTables.js');
    echo $this->fetch('css');
    echo $this->Html->css('jquery.dataTables.css');
?>

<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function() {
        
          $('#qres').dataTable({
            "paging": true,
            "pagingType": "full_numbers"
//            "order": [[2, "asc"]],
//            stateSave: true
        });
      
        
    });

</script>


<?php

//echo "<pre>";
//print_r($query);

$count=count($query);
//echo $count;
$count=1;
if ($query!=''){ ?>
 
<div style="width: 96%; height:250px;overflow: auto;margin: 0% auto;margin-right: 2%; margin-top: 10px;">
<?php
echo "<table id='qres' class='display' border='1' style='border-collapse:collapse'>";


//echo '<pre>';
//print_r($query);die();

foreach ($query as $q)
{
    
    foreach($q as $res)
    { 
        
      if($count==1){
          echo "<thead style='background:#378D9C;color: #000;'>";
           echo "<tr height='35px' style='background:#378D9C'>";
        foreach ($res as $key=>$value)
        {
           
          echo "<th>$key</th>";
           
          
          $count++;
        } 
         echo "</tr>"; 
         echo "</thead>";
      }
       echo "<tr height='30px'>";
      foreach ($res as $value)
        {
          
          echo "<td>$value</td>";
          
         
          $count++;
        }
          echo "</tr>";            
        
        }
    
   
}
echo "</table>";

?>
</div>

<?php }else{?>
<div style="width: 98%; height: 200px;margin: 0% auto;margin-right: 2%;">
<table  width="50%" style="margin:0% auto;margin-top: 5%;">
    <tr>
        <td style="font-size: 16px; text-align: center;">No record found.</td>
    </tr>
    
</table>
</div>
<?php } ?>

  