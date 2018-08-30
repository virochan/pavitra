<?php
    header('Content-Disposition: inline; filename="ApplicationDetails"'.date("Y/m/d").'".pdf"');
    echo $content_for_layout;
?>