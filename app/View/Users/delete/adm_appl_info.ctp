<div id="maindiv" style="margin-top:0px;margin-left:0px;">
    <div id="innerdiv1" style="width: auto; height:250px;">
        <div id="innerdiv123" style="height:250px;float:left;">
            <fieldset>
                <legend>Search School</legend>
                <div class="display-records" id="myDiv"  style="float:left;min-height:230px;margin-top:10px;margin-left:10px;  ">
                    <!--<b style="font-size:15px;text-align:center;margin-left: 0px;"></b>-->
                <?php echo $this->Form->create('child_info'); ?>
        	<?php echo $this->Form->input('State', array('options' => $StateList, 'label' => 'State &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;:',  'style' => 'margin-left:5px', 'class'=>'selectbox')); ?>         
                    <br>
                    <div id="mydist_div_school"></div>
                    <br>
                    <div id="my_div"></div>
                    <br>
                    <div id="my_div_one"></div>
                    <br><br>
                <?php  echo $this->form->end();?>	
                </div>
            </fieldset>
        </div>
        <div id="innerdiv123" style=" height:250px; float:left;">
            <fieldset>
                <legend>Login Details</legend>
                <div class="display-records" id="my_login_school" style="float:left;min-height:230px;">
                    <b style="font-size:15px;text-align:center;margin-left: 0px;"></b>
                    <table style="width:auto;">
                        <tr>
                            <td>User Id &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;:  </td>
                            <td><input type="text"> </td>
                        </tr>
                        <tr>
                            <td >Password  &nbsp&nbsp&nbsp&nbsp;:</td>
                            <td><input type="text"> </td>
                        </tr>
                        <tr>
                            <td >Captcha  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;:</td>
                            <td><input type="text"> </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"> <input type="button" name="Login" value="Login" />  <input type="button" name="cancel" value="Cancel" /></td>
                        </tr>
                    </table>
                    
                </div>
            </fieldset>
        </div> 
    </div>
    
    
    <div id="innerdiv1" style="width: auto; height:250px;">
        <div id="innerdiv123" style="height:250px;float:left;">
            <fieldset>
                <legend>List of schools under the above selected cluster</legend>
                <div class="display-records" id="my_div_school"  style="float: left;margin-left: 10px;margin-top: 10px;max-height: 140px;overflow-x: auto;    width: 460px;  ">                 	
                </div>
            </fieldset>
        </div>
        <div id="innerdiv123" style=" height:250px; float:left;">
            <fieldset>
                <legend>School Information</legend>
                <div class="display-records" id="schoolinfo_div" style="float:left;min-height:230px;margin-top:10px;margin-left:10px;">
                </div>
            </fieldset>
        </div> 
    </div>
</div> 
<?php  //pppppppppppppppppppppppppppppp
    echo $this->Html->meta('icon');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    echo $this->Html->script('jquery.min');
    echo $this->Html->css('common');
    echo $this->Html->script('common');
?>