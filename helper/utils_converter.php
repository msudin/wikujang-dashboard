<?php

function convertDateFormat($date, $formatOutput = "d-m-Y H:i:s") {
    $originalDate = $date;
    $newDate = date($formatOutput, strtotime($originalDate));
    return $newDate;
}


function dateUtcToLocal($timeutc, $formatOutput = "d-m-Y H:i:s") {
    if (!empty($timeutc)) {
        $time1 = strtotime($timeutc.' UTC');
        $format1 = date($formatOutput, $time1);
        return $format1;
    } else {
        return "";
    }
}


function adsStatus($status) {
    if ($status == "inactive") {
        return "Tidak Aktif";
    } else if ($status == "active") {
        return "Aktif"; 
    } else {
        return "Undefined Status";
    }
}

function adsStatusColor($status) {
    if ($status == "inactive") {
        return "label label-danger";
    } else if ($status == "active") {
        return "label label-success"; 
    } else {
        return "label label-default";
    }
}

function adsPaymentStatus($status) {
    if ($status == "PENDING") { 
        return '<span class="label label-primary">Belum Bayar</span>'; 
    } else if ($status == "PAID") { 
        return '<span class="label label-success">Terbayar</span>';
    } else if ($status == "EXPIRED") { 
        return '<span class="label label-info">Kadaluarsa</span>';
    }
}

function adsStatusColorName($status) {
    if ($status == "inactive") {
        return '<span class="label label-danger">Tidak Aktif</span>';
    } else if ($status == "active") {
        return '<span class="label label-success">Aktif</span>';
    } else {
        return '<span class="label label-default">Undefined Status</span>';
    }
}

?>