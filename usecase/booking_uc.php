<?php
include_once('../helper/import.php');

function getBookings($limit = NULL, $status = NULL, $paymentStatus = NULL) {
    $baseUrl = baseUrl();
    $endpoint = $baseUrl.'/api/booking_all.php?limit='.$limit.'&status='.$status.'&paymentStatus='.$paymentStatus;

    $response = callAPI('GET', $endpoint, false, true);
    if ($response->success) {
        return $response->data;
    } else {
        return array();
    }
}

function getBookingSummary($bokingDate = NULL) {
    $baseUrl = baseUrl();
    $endpoint = $baseUrl.'/api-admin/booking_summary.php?bookingDate='.$bokingDate;

    $response = callAPI('GET', $endpoint, false, true);
    if ($response->success) {
        return $response->data;
    } else {
        return array();
    }
}

function getBookingRevenue($paymentDate = NULL,  $paymentStatus = NULL) {
    $baseUrl = baseUrl();
    $endpoint = $baseUrl.'/api-admin/booking_revenue.php?paymentDate='.$paymentDate.'&paymentStatus='.$paymentStatus;
    
    $response = callAPI('GET', $endpoint, false, true);
    if ($response->success) {
        return $response->data;
    } else {
        return array();
    }
}
?>