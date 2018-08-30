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
            <script type="text/javascript" src="jquery-ui-1.10.4.custom.js"></script>
            <script type="text/javascript">
                window.webroot = '<?php echo $this->webroot; ?>';
            </script>
            <script>
                function disply_record(id)
                {
//alert("1234");
                    $(".selectbox").prop("disabled", true);
                    var id = id;
                    // $('#user_id').val(id);
                    $('#LoginValidationUserId').val(id);

                    $.ajax({
                        url: "/Teachers/Users/SchoolData",
                        type: "POST",
                        data: {'id': id},
                        success: function (output) {
                            //    alert(output);
//                            var current = $("#schoolinfo_div").html();
//                            alert(current);
                            $("#schoolinfo_div").html(output);
                            // $("#my_login_school123").html(output);

                        }
                    });
                }

            </script>

            <?php echo $this->Html->charset(); ?>
            <meta name="viewport" content="width=700px; initial-scale=1.0">
                <title>School Education and Sports Department</title>
                <?php
                echo $this->Html->script('//www.google.com/jsapi');
                echo $this->Html->meta('icon');
                echo $this->Html->css('style');
                echo $this->Html->css('media-queries');
                echo $this->fetch('meta');
                echo $this->fetch('css');
                echo $this->fetch('script');
                echo $this->Html->script('http://code.jquery.com/jquery-2.1.0.min.js');
                echo $this->Html->script('http://code.jquery.com/jquery-1.10.2.min.js');
                echo $this->Html->script('https://www.google.com/jsapi'); //**********************https://www.google.com/jsapi

                echo $this->Html->meta('icon');
                echo $this->fetch('meta');
                echo $this->fetch('css');
                echo $this->fetch('script');
                echo $this->Html->script('jquery.min');
                echo $this->Html->css('common');
                echo $this->Html->script('common');
                ?>

                </head>
                <body >

                    <div id="pagewrap">

                        <header id="header">

                            <p id="header-strip">

                            </p>
                                    <h1 id="site-logo"><!-- <a href="#"><img src="images/top-bg.jpg" alt="Logo"></a>--></h1>



                            <nav>
                                <ul id="main-nav" class="clearfix">
                                    <li> <?php echo $this->Html->link('Initial Apt Dtl', array('action' => 'index')); ?></li>
                                    <!--                                    <li><a href="dataentry/initaptdtl" id="initaptdtl">Initial Apt Dtl</a></li>-->
                                    <li><a href="#" id="result">Addl. Personal Dtl</a> </li>
                                    <li><a href="#" id="fee">PH</a></li>
                                    <li><a href="#" id="fee">Address</a></li>
                                    <li><a href="#" id="fee">Family</a></li>
                                    <li><a href="dataentry/qualification" id="qualification">Qualification</a></li>
                                    <li><a href="#" id="fee">Service His.</a></li>
                                    <li><a href="dataentry/training" id="training">Training</a></li>

                                </ul>
                                <!-- /#main-nav --> 
                            </nav>



                        </header>	

                        <!-- /#pagewrap -->

                        <div id="content">

                            <?php echo $this->Session->flash(); ?>

                            <?php echo $this->fetch('content'); ?>
                        </div>

                        <footer id="footer">

                            <p>Copyright &copy; School Education and Sports Department.  
                                Site Designed and Developed by <a href="http://www.nic.in" target="_blank">National Inormatics Centre, Pune</a>
                                <?php
                                $server_ip = $this->Session->read('server_ip');
                                if (isset($server_ip)) {
                                    echo "" . $server_ip;
                                }
                                ?>
                            </p>

                        </footer>
                    </div>
                    <!-- /#footer --> 
                </body>
                </html>









