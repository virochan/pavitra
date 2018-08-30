<?php

$json = array();
if (isset($error) && !empty($error)) {
    $json['error'] = $error;
} else {
    $json['error'] = '';
}
if (isset($url) && !empty($url)) {
    $json['url'] = $url;
} else {
    $json['url'] = '';
}

echo json_encode($json);
