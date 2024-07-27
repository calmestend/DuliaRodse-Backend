<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../core/initialize.php";

$post = new Sucursal($db);

$result = $post->read_with_direction();
$num = $result->rowCount();

if ($num > 0) {
    $post_array = [];
    $post_array["data"] = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = [
            "NO_SUC" => $NO_SUC,
			"COL_SUC" => $COL_SUC,
			"CALLE_SUC" => $CALLE_SUC,
			"NOINT_SUC" => $NOINT_SUC,
			"NOEXT_SUC" => $NOEXT_SUC,
			"CP_SUC" => $CP_SUC,
			"NOM_CIUDAD" => $NOM_CIUDAD,
			"NOM_ESTADO" => $NOM_ESTADO,
        ];

        array_push($post_array["data"], $post_item);
    }

    echo json_encode($post_array);
} else {
    echo json_encode(["message" => "No posts found"]);
}

?>
