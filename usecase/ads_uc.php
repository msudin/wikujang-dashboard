<?php
include_once('../helper/import.php');

function getAds($limit = NULL, $status = NULL, $paymentStatus = NULL) {
    $baseUrl = baseUrl();
    $endpoint = $baseUrl.'/api/ads_all.php?limit='.$limit.'&status='.$status.'&paymentStatus='.$paymentStatus;

    $response = callAPI('GET', $endpoint, false, true);
    if ($response->success) {
        return $response->data;
    } else {
        return array();
    }
}
?>