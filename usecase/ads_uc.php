<?php
include_once('../helper/import.php');

function getAds() {
    $baseUrl = baseUrl();
    $response = callAPI('GET', $baseUrl.'/api/ads_all.php', false);
    if ($response->success) {
        return $response->data;
    } else {
        return array();
    }
}
?>