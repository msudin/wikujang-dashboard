<?php
include_once('../helper/import.php');

function getTotalWarung() {
    $conn = callDb();
    $sqlCountWarung = "SELECT COUNT(warung_id) AS TotalWarung FROM warung WHERE `deleted_at` = ''";
    $result = $conn->query($sqlCountWarung);
    while($row = $result->fetch_assoc()) {
        return $row["TotalWarung"];
    }
}


function getListWarung($limit = 0) {
    $conn = callDb();
    $array = array();

    if (!empty($limit)) {
        $limitData = (int)$limit;
        $sqlAllUser = "SELECT * FROM `warung` WHERE deleted_at = '' ORDER BY `created_at` DESC LIMIT $limitData";
    } else {
        $sqlAllUser = "SELECT * FROM `warung` WHERE deleted_at = '' ORDER BY `created_at` DESC";
    }

    $result = $conn->query($sqlAllUser);
    while($row = $result->fetch_assoc()) {
        $data = new stdClass();
        $data->name = $row['name'];
        $data->createdAt = $row['created_at'];
        $data->isOpen = $row['is_open'];
        $data->openTime = $row['open_time'];
        $data->closedTime = $row['closed_time'];
        array_push($array, $data);
    }
    return $array;
}
?>