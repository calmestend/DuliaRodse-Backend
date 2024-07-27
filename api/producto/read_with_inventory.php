<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../core/initialize.php";

$post = new Producto($db);

$result = $post->read_with_inventory();
$num = $result->rowCount();

if ($num > 0) {
    $post_array = [];
    $post_array["data"] = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = [
			"NO_SUC" => $NO_SUC,
			"NO_INV" => $NO_INV,
			"EXIST_INV" => $EXIST_INV,
            "ID_PRO" => $ID_PRO,
            "NOM_PRO" => $NOM_PRO,
            "GRAM_PRO" => $GRAM_PRO,
            "COS_PRO" => $COS_PRO,
            "PREC_PRO" => $PREC_PRO,
            "IMG_PRO" => $IMG_PRO,
            "NOM_CAT" => $NOM_CAT,
            "AROMA_PRO" => $AROMA_PRO,
            "ACTIVO" => $ACTIVO,
        ];

        array_push($post_array["data"], $post_item);
    }

    echo json_encode($post_array);
} else {
    echo json_encode(["message" => "No posts found"]);
}

?>
