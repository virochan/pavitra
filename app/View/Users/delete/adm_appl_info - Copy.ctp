<!Doctype html>
<html lang="en">
    <head>

        <title>
            Admission Form
        </title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		echo $this->Html->script('jquery.min');
                echo $this->Html->css('common');
                echo $this->Html->script('common');
    ?>

    </head>
    <body>


        <article class="post clearfix">
            <h3>STUDENT REGISTRATION FORM</h3>
            <header>
                <h1 class="post-title">
		<?php 
                        /*echo $this->Html->link(
                        'Child Details',
                        'javascript:void(0);',
                         array('class' => 'activelink', 'id'=>'link1'));
	
                        echo $this->Html->link(
                        'Parent Details',
                        'javascript:void(0);',
                        array('id'=>'link2'));
	                */  
                        echo $this->Html->link(
                        'Login Form',
                        'javascript:void(0);',
                        array('id'=>'link3'));
	
                        /*echo $this->Html->link(
                        'Form Summary',
                        'javascript:void(0);',
                        array('id'=>'link4'));
                         
                         */
	 ?>

                </h1>
            </header>

            <div class="first_div">
			<?php
echo $this->Form->create('child_info');
?>
              <table align="center" cellpadding = "10">
                    <tr><td colspan='4'><h2>Child Information<h2></td></tr>
                                    <!----- Student Name ---------------------------------------------------------->
                                    <tr>
                                        <td>Name Of Child Seeking Admission</td>
                                        <td><?php echo $this->Form->input('child_lname',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                            Last Name
                                        </td>
                                        <td><?php echo $this->Form->input('child_fname',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                            First Name
                                        </td>
                                        <td><?php echo $this->Form->input('child_mname',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                            Middle Name
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>Father's Full Name</td>
                                        <td><?php echo $this->Form->input('father_lname',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                            Last Name
                                        </td>
                                        <td><?php echo $this->Form->input('father_fname',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                            First Name
                                        </td>
                                        <td><?php echo $this->Form->input('father_mname',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                            Middle Name
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Mother's Full Name</td>
                                        <td><?php echo $this->Form->input('mother_lname',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                            Last Name
                                        </td>
                                        <td><?php echo $this->Form->input('mother_fname',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                            First Name
                                        </td>
                                        <td><?php echo $this->Form->input('mother_mname',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                            Middle Name
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Gardian's Full Name</td>
                                        <td><?php echo $this->Form->input('gardian_lname',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                            Last Name
                                        </td>
                                        <td><?php echo $this->Form->input('gardian_fname',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                            First Name
                                        </td>
                                        <td><?php echo $this->Form->input('gardian_mname',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                            Middle Name
                                        </td>
                                    </tr>

                                    <tr><td>Child Date Of Birth:<td><?php echo $this->Form->input('child_dob',array('label'=>false,'type'=>'text')); ?></td> </td><td align='center'>Child Gender: 
                                        </td><td><?php echo $this->Form->input('child_gender', array(
 'div' => true,
 'label' => true,
 'type' => 'radio',
 'legend' => false,
 'options' => array(1 => 'Male', 2 => 'Female')
));  ?></td></tr>
                                    <tr><td colspan='2'>For Which Class Admission Require?</td><td colspan='2'><?php
	echo $this->Form->input('std', array('label'=>false,
    'options' => array('Pre-Primary','Junior-KG','Senior KG',1,2,3,4,5,6,7,8,9,10),
    'empty' => '(choose one)','style'=>'width:200px; height:30px;'
));?></td></tr>
                                    <tr><td colspan='2'>Select School Medium</td><td colspan='2'><?php
	/*echo $this->Form->input('school_medium', array('label'=>false,
    'options' => array('Marathi','English','Urdu','Hindi','Gujrathi','Sindhi','Tamil','Kannad','Telgu'),
    'empty' => '(choose one)','style'=>'width:200px; height:30px;'
));*/
echo $this->Form->input('',array('options' => $school_medium,'style'=>'width:200px; height:30px;'),array('label'=>false,'empty' => '(choose one)'));
?></td></tr>
                                    <tr><td colspan='2'>Do You Belong to Religious Minority<br>(Muslim,Christian,Sikh,Jain,Bauddha or Parsi)</td><td><?php echo $this->Form->input('Child_religion', array(
 'div' => true,
 'label' => true,
 'type' => 'radio',
 'legend' => false,
 'options' => array(1 => 'Yes', 2 => 'No')
));  ?></td> <td><?php
	//echo $this->Form->input('caste_nm', array('label'=>false,
  //  'options' => array('Maratha','Muslim','Sikh','Jain','other'),
   // 'empty' => '(Select Caste)','style'=>'width:200px; height:30px;'
   //)); // echo "<pre>";
  // print_r $castenm;
  echo $this->Form->input('',array('options' => $castenm,'style'=>'width:200px; height:30px;'),array('label'=>false,'empty' => '(choose one)'));
   ?></td></tr>
                                    <tr><td colspan='2'>Is Your child Disability</td><td><?php echo $this->Form->input('Child_disability', array(
 'div' => true,
 'label' => true,
 'type' => 'radio',
 'legend' => false,
 'options' => array(1 => 'Yes', 2 => 'No'),'selected' => array('1')
));
  ?></td> <td><?php
  echo $this->Form->input('',array('options' => $nature_disb,'style'=>'width:200px; height:30px;'),array('label'=>false,'empty' => '(choose one)'));
   ?></td></tr>
                                    <!--<tr><td colspan='2'>Reservation Category</td><td colspan='2'><?php
	echo $this->Form->input('reservation_cat', array('label'=>false,
    'options' => array('Open','Cast'),
    'empty' => '(choose one)','style'=>'width:200px; height:30px;'
));?></td></tr>
                                    --><tr><td colspan='2'>Is Parents Annual income below Rs. 1,00,000?</td><td colspan='2'><?php echo $this->Form->input('parent_income', array(
 'div' => true,
 'label' => true,
 'type' => 'radio',
 'legend' => false,
 'options' => array(1 => 'Yes', 2 => 'No')
));  ?></td></tr>

                                    <tr><td colspan='2'>Annual Income of Parent from all sources in Rs</td><td colspan='2'><?php echo $this->Form->input('parent_annual_income',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?></td></tr>
                                    <tr><td>Parent Mobile Number(only 10 Digits)</td><td><?php echo $this->Form->input('mob_num',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?></td><td>Parent Email ID</td><td><?php echo $this->Form->input('email_id',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?></td></tr>

<!-- <tr><td colspan='4'><h2>Login Details<h2></td></tr>
<tr><td colspan='2' align='right'>Enter Password</td><td colspan='2'><?php echo $this->Form->input('pwd',array('label'=>false,'type'=>'password','maxlength'=>'30')); ?></td></tr>
<tr><td colspan='2' align='right'>Confirm Password</td><td colspan='2'><?php echo $this->Form->input('confirm_pwd',array('label'=>false,'type'=>'password','maxlength'=>'30')); ?></td></tr>-->
                                    <tr><td align='center' colspan='4'> <?php
    echo $this->Form->end('Save and Proceed');
?>
                                        </td></tr>

                                    </table>
                                    </div>

                                    <div class="second_div" style="display:none;">
						<?php
echo $this->Form->create('parents_info');
?>

                                        <table align="center" cellpadding = "10">
                                            <tr><td colspan='4'><h2>Parents Personal Information<h2></td></tr>
                                                            <tr>
                                                                <td>Father's Details</td>
                                                                <td><?php echo $this->Form->input('father_education',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                                                    Education
                                                                </td>
                                                                <td><?php echo $this->Form->input('father_occupation',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                                                    Occupation
                                                                </td>
                                                                <td><?php echo $this->Form->input('father_income',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                                                    Annual Income
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Mother's Details</td>
                                                                <td><?php echo $this->Form->input('mother_education',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                                                    Education
                                                                </td>
                                                                <td><?php echo $this->Form->input('mother_occupation',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                                                    Occupation
                                                                </td>
                                                                <td><?php echo $this->Form->input('mother_income',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                                                    Annual Income
                                                                </td>
                                                            </tr>
                                                            <tr><td>Parent Mobile Number(only 10 Digits)</td><td><?php echo $this->Form->input('father_mob_num',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?></td><td>Parent Email ID</td><td><?php echo $this->Form->input('father_email_id',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?></td></tr>
                                                            <tr><td>permanent Address</td><td><?php echo $this->Form->textarea('permanent_address'); ?></td><td>Current Address:<br>same as Permanent Address?<?php echo $this->Form->input('current_addr', array(
 'div' => true,
 'label' => true,
 'type' => 'radio',
 'legend' => false,
 'options' => array(1 => 'Yes', 2 => 'No'),array('default' => '2')
));  ?></td><td> <?php echo $this->Form->textarea('current_address',array('id'=>'current_address')); ?></td></tr>
                                                            <tr><td colspan='2'>Is Parents and Gardians are Same </td><td colspan='2'><?php echo $this->Form->input('gardian_validator', array(
 'div' => true,
 'label' => true,
 'type' => 'radio',
 'legend' => false,
 'options' => array(1 => 'Yes', 2 => 'No'),array('default' => '1')
));  ?></td></tr>
                                                            </table>

                                                            <div id="gardian_info_tbl" style="display:none;">
                                                                <table>
                                                                    <tr>
                                                                        <td>Gardian's Details</td>
                                                                        <td><?php echo $this->Form->input('gardian_education',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                                                            Education
                                                                        </td>
                                                                        <td><?php echo $this->Form->input('gardian_occupation',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                                                            Occupation
                                                                        </td>
                                                                        <td><?php echo $this->Form->input('gardian_income',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?>
                                                                            Annual Income
                                                                        </td>
                                                                    </tr>
                                                                    <tr><td>Gardian Mobile Number(only 10 Digits)</td><td><?php echo $this->Form->input('gardian_mob_num',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?></td><td>Gardian Email ID</td><td><?php echo $this->Form->input('gardian_email_id',array('label'=>false,'type'=>'text','maxlength'=>'30')); ?></td></tr>
                                                                    <tr><td>Gardian permanent Address</td><td><?php echo $this->Form->textarea('gardian_permanent_address'); ?></td><td>Gardian Current Address:<br>same as Permanent Address?<?php echo $this->Form->input('gardian_current_addr', array(
 'div' => true,
 'label' => true,
 'type' => 'radio',
 'legend' => false,
 'options' => array(1 => 'Yes', 2 => 'No')
));  ?></td><td> <?php echo $this->Form->textarea('gardian_current_address'); ?></td></tr>


                                                                </table>
                                                            </div>
                                                            <table>
                                                                <tr><td colspan=4 align='center'>
			<?php
    echo $this->Form->end('Save and Proceed');
?></td></table>  
                                                            </div>

                                                            <div class="third_div" style="display:none;">
                                                                <table align="center" cellpadding = "10">
                                                                    <tr><td colspan='4'><h2>Select School For Admission<h2></td></tr>
                                                                                    <tr><td colspan='4'><?php echo $this->Form->input('district', array('options' => $dist_list, 'empty' => '-- Select --','id'=>'dist_id','label' => 'Select District ')); 

?>
                                                                                            <br>
                                                                                            <div id="my_div"></div>
                                                                                            <br>
                                                                                            <div id="my_div_one"></div>
                                                                                            <br><br>
                                                                                            <div id="my_div_school"></div>
                                                                                        </td></tr>

                                                                                    </table>
                                                                                    <table>
                                                                                        <tr><td colspan=4 align='center'>
			<?php
    echo $this->Form->end('Confirm and Submit');
?></td></table>
                                                                                    </div>

                                                                                    <div class="fourth_div" style="display:none;">Some text here <br><br><br><br></div>

                                                                                    </article>

                                                                                    </body>
                                                                                    </html>