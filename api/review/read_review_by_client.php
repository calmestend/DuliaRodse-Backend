<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../core/initialize.php";

$post = new Review($db);

$post->ID_CLIE = isset($_GET["id_clie"]) ? $_GET["id_clie"] : false;

$result = $post->read_by_id_clie();

$num = $result->rowCount();

if ($num > 0) {
    $post_array = [];
    $post_array["data"] = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $post_item = [
            "ID_REV" => $ID_REV,
			"ID_ESC" => $ID_ESC,
			"ID_CLIE" => $ID_CLIE,
			"ID_PRO" => $ID_PRO,
			"COM_REV" => $COM_REV,
        ];

        array_push($post_array["data"], $post_item);
    }

    echo json_encode($post_array);
} else {
    echo json_encode(["message" => "No posts found"]);
}

?>




