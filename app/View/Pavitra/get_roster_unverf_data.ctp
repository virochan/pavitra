<?php

if (isset($check) && $check != '') {
    $jsonArr[] = $check;
	echo json_encode($jsonArr);
}



?>