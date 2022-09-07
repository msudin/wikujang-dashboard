<?php
include_once('../helper/import.php');

function getTotalProduct() {
    $conn = callDb();
    $sqlCountProduct = "SELECT COUNT(product_id) AS TotalProduct FROM `product`";
    $result = $conn->query($sqlCountProduct);
    while($row = $result->fetch_assoc()) {
        return $row["TotalProduct"];
    }
}

?>