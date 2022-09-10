<?php

function convertDateFormat($date) {
    $originalDate = $date;
    $newDate = date("d-m-Y H:i:s", strtotime($originalDate));
    return $newDate;
}

function adsStatus($status) {
    if ($status == "inactive") {
        return "Tidak Aktif";
    } else if ($status == "active") {
        return "Aktif"; 
    } else if ($status == "waiting payment") {
        return "Menunggu Pembayaran";  
    } else {
        return "Undefined Status";
    }
}

function adsStatusColor($status) {
    if ($status == "inactive") {
        return "label label-danger";
    } else if ($status == "active") {
        return "label label-success"; 
    } else if ($status == "waiting payment") {
        return "label label-info";  
    } else {
        return "label label-default";
    }
}

?>