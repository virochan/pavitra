<?php
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
            <?php echo $this->Html->charset(); ?>
            <!-- disable iPhone inital scale -->
            <meta name="viewport" content="width=700px; initial-scale=1.0">
                <title>School Education and Sports Department</title>
                <?php
                echo $this->Html->meta('icon');
                echo $this->Html->css('common');
                echo $this->Html->css('style');
                echo $this->Html->css('media-queries');
                echo $this->Html->script('common');
                echo $this->fetch('meta');
                echo $this->fetch('css');
                echo $this->fetch('script');
                echo $this->Html->script('http://code.jquery.com/jquery-2.1.0.min.js');
                echo $this->Html->script('http://code.jquery.com/jquery-1.10.2.min.js');
                echo $this->Html->meta('icon');
                echo $this->fetch('meta');
                echo $this->fetch('css');
                echo $this->fetch('script');
                echo $this->Html->script('jquery.min');
                echo $this->Html->css('common');
                echo $this->Html->css('style_menu');
                echo $this->Html->script('common');
                ?>

                </head>
                <body>


                    <div id="pagewrap">
                        <header id="header">
                            <p id="header-strip"></p>
                            <div class="example" style="margin-top: 90px;">
                                <nav>
                                    <ul class="nav">
                                        <li><?php echo $this->Html->link('Check Correctness of Teachers Data', array('action' => 'checkCorrectnessTch')); ?>                                           
                                        </li>
                                        <li><?php echo $this->Html->link('Reports', array('action' => '#')); ?>                                           
                                        </li>
                                        <li>  <?php echo $this->Html->link('Logout', array("controller" => 'Users', "action" => "logout")); ?></li>


                                    </ul>
                                    <!--                                    <div style="float: right;height: 45px;width: 60px;padding: 13px 0px 0px 5px ;"><?php
                                    echo $this->Html->link('Logout', array("controller" => 'Users',
                                        "action" => "index"));
                                    ?>
                                                                            </div>-->
                                </nav>

                            </div>
                        </header>	
                        <!-- /#pagewrap -->

                        <div id="content">

                            <?php echo $this->Session->flash(); ?>
                            <?php echo $this->fetch('content'); ?>
                        </div>

                        <footer id="footer">
                            <p>Copyright &copy; School Education and Sports Department.  
                                <span style="float: right;">   Site Designed and Developed by <a href="http://www.nic.in" target="_blank">National Inormatics Centre, Pune</a></span>
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









