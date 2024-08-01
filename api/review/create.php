<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header(
    "Access-Control-Allow-Headers: Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization"
);

include_once "../../core/initialize.php";
include_once "../../includes/config.php";

$post = new Review($db);

$data = json_decode(file_get_contents("php://input"));

$post->ID_ESC = $data->ID_ESC;
$post->ID_CLIE = $data->ID_CLIE;
$post->ID_PRO = $data->ID_PRO;
$post->COM_REV = $data->COM_REV;


if ($post->create()) {
    echo json_encode(["message" => "Post created"]);
} else {
    echo json_encode(["message" => "Post not created"]);
}


