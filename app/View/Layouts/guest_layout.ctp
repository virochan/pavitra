<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'Header Data');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
    <head>


        <meta charset="utf-8">
            <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>-->

            <script>

                function disply_udise_record_update(id)
                {
                    // alert("hhhhiiiii");
                    $("#right_td_update_udise").hide();
                    $("#right_ajax_td_update_udise").show();
                    var id = id;
                    $.ajax({
                        url: "UdiseRecordEdit",
                        type: "POST",
                        data: {'id': id},
                        success: function(output) {
                            //alert(output);
                            $("#right_ajax_td_update_udise").html(output);
                        }
                    });
                }
            </script>
            <script type="text/javascript" src="jquery-ui-1.10.4.custom.js"></script>
            <script type="text/javascript">
                window.webroot = '<?php echo $this->webroot; ?>';
            </script>
            <?php echo $this->Html->charset(); ?>
            <!-- disable iPhone inital scale -->
            <meta name="viewport" content="width=700px; initial-scale=1.0"/>
            <title>School Education and Sports Department</title>
            <?php
            echo $this->Html->meta('icon');
            echo $this->Html->css('style');
            echo $this->fetch('meta');
            echo $this->fetch('script');
            echo $this->Html->script('jquery.min');
            echo $this->Html->css('style_menu_ch_beo');
            echo $this->Html->script('common');
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
                <div class="example">

                    <nav>
                        <ul class="nav">
                            
                            <li class="current-item"> 
                               <?php echo $this->Html->link(__('Apply'), array('action' => '')); ?> 
                            </li>
                            <li class="current-item"> 
                               <?php echo $this->Html->link(__('View Status'), array('action' => '')); ?> 
                            </li>
                            <li class="current-item"> 
                               <?php echo $this->Html->link(__('Print'), array('action' => '')); ?> 
                            </li>


                            <li><?php echo $this->Html->link(__('Logout'), array("controller" => 'users', "action" => "logout")); ?></li>
                        </ul>  
                    </nav>
                </div>
                   <div id="logsection_cluster">
                                <table width="100%" height="50px" >
                                    <tr>

                                        <td width="15%" class="name">  <?php echo __('Login as : '); ?>   </td> 
                                        <td width="61%"> 

                                            <?php
                                            if ($this->Session->read('user_id'))
                                                $user_id = $this->Session->read('user_id');
                                            else
                                                $user_id = "-";

                                            if ($this->Session->read('user_desc'))
                                                $user_desc = $this->Session->read('user_desc');
                                            else
                                                $user_desc = "-";
                                            if ($this->Session->read('operator_name'))
                                                $operator_name = $this->Session->read('operator_name');
                                            else
                                                $operator_name = "-";
                                            ?>

                                            <?php echo " " . " ( " . $user_id . " ) " . $user_desc . $operator_name;
                                            ?>       </td> 
                                        <td width="16%" align="right" class="name" >Academic Year <span>:</span></td> 
                                        <td width="8%">
                                            <?php
                                            if ($this->Session->read('acad_year_tchr'))
                                                echo $this->Session->read('acad_year_tchr');
                                            else
                                                echo "-";
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
            </header>		
            <!-- /#pagewrap -->

            <div id="content">
                <?php echo $this->fetch('content'); ?>
            </div>

            <div id="footer">
                <p><span style="float: left;">Copyright &copy; School Education and Sports Department.  </span>
                    <span style="float: right;">   Site Designed and Developed by <a href="http://www.nic.in" target="_blank">National Inormatics Centre, Pune</a>
                        <?php
                        $server_ip = $this->Session->read('server_ip');
                        if (isset($server_ip)) {
                            echo "" . $server_ip;
                        }
                        ?>
                    </span>
                </p>
            </div>
            <!-- /#footer -->            
            <?php echo $this->Session->flash(); ?>
        </div>
    </body>
</html>









