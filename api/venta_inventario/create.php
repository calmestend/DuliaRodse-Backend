<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header(
    "Access-Control-Allow-Headers: Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization"
);

include_once "../../core/initialize.php";
include_once "../../includes/config.php";

$post = new Venta_Inventario($db);

$data = json_decode(file_get_contents("php://input"));

$post->CVE_VENTA = $data->CVE_VENTA;
$post->NO_INV = $data->NO_INV;
$post->CANT_PRO = $data->CANT_PRO;

if ($post->create()) {
    echo json_encode(["message" => "Post created"]);
} else {
    echo json_encode(["message" => "Post not created"]);
}


