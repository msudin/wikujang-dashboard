<?php
include_once('../helper/import.php');

function getAds($limit = NULL, $status = NULL) {
    $baseUrl = baseUrl();
    $endpoint = $baseUrl.'/api/ads_all.php?limit='.$limit.'&status='.$status;

    $response = callAPI('GET', $endpoint, false);
    if ($response->success) {
        return $response->data;
    } else {
        return array();
    }
}
?>