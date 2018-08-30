<?php //

if (isset($age) && $age != '') {
    $jsonArr[] = $age;
	echo json_encode($jsonArr);
}



?>