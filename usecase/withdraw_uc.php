<?php
include_once('../helper/import.php');

if (isset($_POST['submitStatusPencairan'])) {
    $status = $_POST['status'];
    $id = $_POST['id'];
    if ($status == "approve") {
        postApproveWithdraw($id);
    } else if ($status == "refund") {
        postRefundWithdraw($id);
    }
}

function getWithdrawList($type = NULL, $status = NULL, $date = NULL) {
    $baseUrl = baseUrl();
    $endpoint = $baseUrl.'/api-admin/withdraw_all.php?status='.$status.'&date='.$date.'&type='.$type;

    $response = callAPI('GET', $endpoint, false, true);
    if ($response->success) {
        return $response->data;
    } else {
        return array();
    }
}


function postRefundWithdraw($mutasiId = NULL) {
    $baseUrl = baseUrl();
    $endpoint = $baseUrl.'/api-admin/withdraw_refund.php?id='.$mutasiId;

    $response = callAPI('GET', $endpoint, false, true);
    if ($response->success) {
        ob_start(); 
        header('location: ../dashboard/withdraw_process.php?success=refund');
        exit();
    } else {
        ob_start(); 
        header('location: ../dashboard/ads.php?success=invalid');
        exit();
    }
}

function postApproveWithdraw($mutasiId = NULL) {
    $baseUrl = baseUrl();
    $endpoint = $baseUrl.'/api-admin/withdraw_approve.php?id='.$mutasiId;

    $response = callAPI('GET', $endpoint, false, true);
    if ($response->success) {
        ob_start(); 
        header('location: ../dashboard/withdraw_process.php?success=withdraw');
        exit();
    } else {
        ob_start(); 
        header('location: ../dashboard/ads.php?success=invalid');
        exit();
    }
}
?>