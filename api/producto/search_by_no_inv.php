<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../core/initialize.php";

$post = new Producto($db);

$data = json_decode(file_get_contents("php://input"));
$post->NO_INV = $data->NO_INV;
$result = $post->search_by_no_inv();
$num = $result->rowCount();

if ($num > 0) {
    $post_array = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_array = [
			"NO_INV" => $NO_INV,
            "EXIST_INV" => $EXIST_INV,
			"ID_PRO" => $ID_PRO,
			"NOM_PRO" => $NOM_PRO,
			"GRAM_PRO" => $GRAM_PRO,
			"PREC_PRO" => $PREC_PRO,
			"IMG_PRO" => $IMG_PRO,
			"NOM_CAT" => $NOM_CAT,
			"AROMA_PRO" => $AROMA_PRO,
			"ACTIVO" => $ACTIVO
        ];
    }

    echo json_encode($post_array);
} else {
    echo json_encode(["message" => "No posts found"]);
}

?>
