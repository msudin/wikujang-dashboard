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
        return '<span class="label label-danger">Expired</span>';
    } else {
        return '<span class="label label-default">-</span>';
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


function bookingPaymentColorName($status) {
    if ($status == "PENDING") { 
        return '<span class="label label-primary">Belum Bayar</span>'; 
    } else if ($status == "PAID") { 
        return '<span class="label label-success">Terbayar</span>';
    } else if ($status == "EXPIRED") { 
        return '<span class="label label-danger">Expired</span>';
    } else {
        return '<span class="label label-default">-</span>';
    }
}

function bookingStatusColorName($status) {
    if ($status == "waiting_approval") { 
        return '<span class="label label-primary">Proses</span>'; 
    } else if ($status == "approved") { 
        return '<span class="label label-success">Disetujui</span>';
    } else if ($status == "rejected") { 
        return '<span class="label label-danger">Ditolak</span>';
    } else {
        return '<span class="label label-default">-</span>';
    }
}

function withdrawTypeColorName($status) {
    if ($status == "dp_paid") {
        return '<span class="label label-success">Booking</span>';
    } else if ($status == "withdraw") {
        return '<span class="label label-success">Withdraw</span>';
    } else if ($status == "refund") { 
        return '<span class="label label-danger">Refund</span>';
    } else {
        return '<span class="label label-default">Undefined Status</span>';
    }
}

function withdrawStatusColorName($status) {
    if ($status == "") { 
        return '<span class="label label-primary">Menunggu Pencairan</span>'; 
    } else if ($status == "transfered") { 
        return '<span class="label label-success">Ditransfer</span>';
    } else if ($status == "refund") { 
        return '<span class="label label-success">Dana Dikembalikan</span>';
    } else {
        return '<span class="label label-default">-</span>';
    }
}
?>