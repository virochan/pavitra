<?php 
$cakeDescription = __d('cake_dev', 'Header Data');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
    <head>
        <script type="text/javascript">
            window.webroot = '<?php echo $this->webroot; ?>';
        </script>  <meta charset="utf-8">
            <?php echo $this->Html->charset(); ?> 
            <meta name="viewport" content="width=700px; initial-scale=1.0">
                <title>School Education and Sports Department</title>
                <?php 
                echo $this->Html->script('jquery-1.7.2');
                echo $this->Html->script('jquery.ui.datepicker');
                echo $this->Html->script('common');
                echo $this->Html->script('teaching_nonteaching_form');
                echo $this->Html->css('styles');
                echo $this->Html->css('style');
                echo $this->Html->script('jquery.form.min');
                echo $this->Html->script('https://www.google.com/jsapi'); 
                echo $this->Html->script('validations');
                echo $this->Html->css('jquery.ui.all');
                echo $this->Html->script('jquery.ui.core');
                echo $this->Html->script('jquery.ui.widget');
                echo $this->Html->script('calendar_common'); 
                echo $this->Html->css('style_menu_ch_beo');
                ?>

                </head>
                <body>
                    <div id="pagewrap">
                        <header>
                            <div id="header-strip"> 

                                <div id="logo-main">
                                    <div id="emb1">
                                        <img src="<?php echo $this->webroot; ?>img/logo.png" alt="Government of Maharashtra">
                                    </div>
                                    <span> <?php echo __("School Education and Sports Department"); ?>
                                        <br>
                                            <small>Government of Maharashtra</small>
                                    </span>
                                </div>

                                <div id="emb2">
                                    <img src="<?php echo $this->webroot; ?>img/emb.png" alt="Government of India">
                                </div>

                            </div> 

                            <div id="static">

                                <nav>
                                    <ul class="nav">

                                        <li class="current-item"><?php echo $this->Html->link('Master Data', array('action' => '')); ?>
                                            <ul>
                                                <li><?php echo $this->Html->link('Board / University', array('action' => 'add_board_univ')); ?></li>
                                                  <li><?php echo $this->Html->link('Caste Data', array('action' => 'caste_state_data')); ?></li>
                                                  <li><?php echo $this->Html->link('Certificate Issuing Details', array('action' => 'certificate_data')); ?></li>
                                                  <li><?php echo $this->Html->link('Degree', array('action' => 'add_degree')); ?></li>
                                                  <li><?php echo $this->Html->link('Degree Subject', array('action' => 'add_subject')); ?></li>
                                                  <li><?php echo $this->Html->link('Pay Scale', array('action' => 'pay_scale')); ?></li>
                                            </ul>
                                        </li>
                                        <li class="current-item"><?php echo $this->Html->link('Reports', array('action' => '')); ?>
                                            <ul>
                                              <li><?php echo $this->Html->link('Statistical Report on Mapping and Data Entry Status', array('action' => 'st_mapping')); ?></li>
                                              <li><?php echo $this->Html->link('Caste Category', array('action' => 'stcastereport')); ?></li>
                                                
                                            </ul>
                                        </li>
                                        <li><?php echo $this->Html->link('Logout', array("controller" => 'Users', "action" => "logout")); ?></li>

                                    </ul>
                                </nav>
                            </div>
                        </header>	
                        <!-- /#pagewrap -->

                        <div id="content">
                                    <table id="logindetailtbl" width="100%">
                    <tr>
                        <td>
                            <table border="0" class="tdhead2">    
                                <tr>
                                    <td width="2%" style="padding-top:3px;color:rgb(194, 67, 21);font-weight:bold;">
                                       <img src="../img/login_role.png"  style="float:left;"/><?php echo __('Login as'); ?><span style="float:middle">&nbsp;:&nbsp;</span> 
                                    </td>
                                    <td width="22%">
                                        (<?php echo "" . $this->Session->read('user_id'); ?>)&nbsp;<?php echo "" . $this->Session->read('role_desc'); ?>                      
                                    </td>
                                  
                                </tr> 
                            </table>
                        </td>
                    </tr>
                </table>
                            <div id="report">

                                <!-- <div id="static">
                                     <nav class="menu">
                                         <ul class="clearfix">
                                             <li><a href="#"><img src="../img/data_entry.png" align="center" />Data Entry Status </a>
                                                 <ul class="sub-menu">      
                                                     <ul> 
                                                         <li>
                                <?php //echo $this->Html->link('Update Teachers Gender and DOB', array('action' => 'updatetchgendob'));    ?> 
                                                         </li>
                                                     </ul>
                                                 </ul>
                                             </li>
                                         </ul>
                                     </nav>
                                 </div>-->

                            </div>
                            <?php echo $this->fetch('content'); ?>
                        </div>

                        <footer id="footer">
                            <p>Copyright &copy; School Education and Sports Department.  
                                <span style="float: right;">   Site Designed and Developed by <a href="http://www.nic.in" target="_blank">National Inormatics Centre, Pune</a>
                                    <?php
                                    $server_ip = $this->Session->read('server_ip');
                                    if (isset($server_ip)) {
                                        echo "" . $server_ip;
                                    }
                                    ?>
                                </span>
                            </p>

                        </footer>
                    </div>
                    <!-- /#footer -->            
                    <?php echo $this->Session->flash(); ?>
                </body>
                </html>









