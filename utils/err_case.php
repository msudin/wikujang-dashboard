<?php 

function ucHandler($msg) {
    $message = "Maaf, terjadi kesalahan dalam memuat data";
    echo "<script type='text/javascript'>alert('$message');</script>";

    if (empty($msg)) {
        echo "Error UC : null";
    } else {
        echo "Error UC : ".$msg;
    }
}
?>