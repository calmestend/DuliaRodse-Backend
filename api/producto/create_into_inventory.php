<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header(
    "Access-Control-Allow-Headers: Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization"
);

include_once "../../core/initialize.php";
include_once "../../includes/config.php";

$post = new Producto($db);

$data = json_decode(file_get_contents("php://input"));

$post->EXIST_INV = $data->EXIST_INV;
$post->NO_SUC = $data->NO_SUC;
$post->ID_PRO = $data->ID_PRO;

if ($post->create_into_inventory()) {
    echo json_encode(["message" => "Post created"]);
} else {
    echo json_encode(["message" => "Post not created"]);
}

