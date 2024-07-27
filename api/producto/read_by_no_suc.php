<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../core/initialize.php";

$post = new Producto($db);

$data = json_decode(file_get_contents("php://input"));
$post->NO_SUC = $data->NO_SUC;
$result = $post->read_by_no_suc();
$num = $result->rowCount();

if ($num > 0) {
    $post_array = [];
    $post_array["data"] = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = [
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

        array_push($post_array["data"], $post_item);
    }

    echo json_encode($post_array);
} else {
    echo json_encode(["message" => "No posts found"]);
}

?>
