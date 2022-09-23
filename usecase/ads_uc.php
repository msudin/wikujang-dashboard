<?php
include_once('../helper/import.php');

if (isset($_POST['submitEditAdsStatus'])) {
    $status = $_POST['status'];
    $id = $_POST['id'];
    updateAds($id, $status);
}

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


function getAdsRevenue($paymentDate = NULL,  $paymentStatus = NULL) {
    $baseUrl = baseUrl();
    $endpoint = $baseUrl.'/api-admin/ads_revenue.php?paymentDate='.$paymentDate.'&paymentStatus='.$paymentStatus;

    $response = callAPI('GET', $endpoint, false, true);
    if ($response->success) {
        return $response->data;
    } else {
        return array();
    }
}

function updateAds($id, $status = "") {
    $body = array(
        "id" => $id,
        "status" => $status
    );

    $baseUrl = baseUrl();
    $response = callAPI('PUT', $baseUrl.'/api/ads_update.php', json_encode($body), true);
    if ($response->success) {
        ob_start(); 
        header('location: ../dashboard/ads.php?success=edit');
        exit();
    } else {
        ob_start(); 
        header('location: ../dashboard/ads.php?success=invalid');
        exit();
    }
}
?>