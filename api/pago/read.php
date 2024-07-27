<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../core/initialize.php";

$post = new Pago($db);

$result = $post->read();
$num = $result->rowCount();

if ($num > 0) {
    $post_array = [];
    $post_array["data"] = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = [
            "CVE_PAGO" => $CVE_PAGO,
            "FEC_PAGO" => $FEC_PAGO,
            "CANT_PAGO" => $CANT_PAGO,
            "CVE_VENTA" => $CVE_VENTA,
        ];

        array_push($post_array["data"], $post_item);
    }

    echo json_encode($post_array);
} else {
    echo json_encode(["message" => "No posts found"]);
}

?>

