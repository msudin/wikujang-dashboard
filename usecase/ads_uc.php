<?php
include_once('../helper/import.php');

function getAds() {
    $baseUrl = baseUrl();
    $get_data = callAPI('GET', $baseUrl.'/api/ads_all.php', false);
    $response = json_decode($get_data);
    if ($response->code == 200) {
        return $response->data;
    } else {
        return array();
    }
}
?>