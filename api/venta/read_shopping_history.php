<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../core/initialize.php";

$post = new Venta($db);

$result = $post->read_shopping_history();
$num = $result->rowCount();

if ($num > 0) {
    $post_array = [];
    $post_array["data"] = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = [
            "CVE_VENTA" => $CVE_VENTA,
            "ID_CLIE" => $ID_CLIE,
            "FEC_VENTA" => $FEC_VENTA,
			"NO_INV" => $NO_INV,
			"ID_PRO" => $ID_PRO,
			"NOM_PRO" => $NOM_PRO,
			"PREC_PRO" => $PREC_PRO,
			"CANT_PRO" => $CANT_PRO,
            "PAGO_VENTA" => $PAGO_VENTA,
        ];

        array_push($post_array["data"], $post_item);
    }

    echo json_encode($post_array);
} else {
    echo json_encode(["message" => "No posts found"]);
}

?>


