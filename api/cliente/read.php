<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../core/initialize.php";

$post = new Cliente($db);

$result = $post->read();
$num = $result->rowCount();

if ($num > 0) {
    $post_array = [];
    $post_array["data"] = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = [
            "ID_USU" => $ID_USU,
            "ID_CLIE" => $ID_CLIE,
            "NI_CLIE" => $NI_CLIE,
            "AP_CLIE" => $AP_CLIE,
            "AM_CLIE" => $AM_CLIE,
            "COL_CLIE" => $COL_CLIE,
            "CALLE_CLIE" => $CALLE_CLIE,
            "NOINT_CLIE" => $NOINT_CLIE,
            "NOEXT_CLIE" => $NOEXT_CLIE,
            "CP_CLIE" => $CP_CLIE,
            "EMAIL_CLIE" => $EMAIL_CLIE,
            "RFC_CLIE" => $RFC_CLIE,
            "TEL_CLIE" => $TEL_CLIE,
            "CVE_CIUDAD" => $CVE_CIUDAD,
        ];

        array_push($post_array["data"], $post_item);
    }

    echo json_encode($post_array);
} else {
    echo json_encode(["message" => "No posts found"]);
}

?>
