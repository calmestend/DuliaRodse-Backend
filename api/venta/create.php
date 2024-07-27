<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header(
    "Access-Control-Allow-Headers: Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization"
);

include_once "../../core/initialize.php";
include_once "../../includes/config.php";

$post = new Venta($db);

$data = json_decode(file_get_contents("php://input"));

$post->FEC_VENTA = $data->FEC_VENTA;
$post->PAGO_VENTA = $data->PAGO_VENTA;
$post->ID_CLIE = $data->ID_CLIE;

if ($post->create()) {
    echo json_encode(["message" => "Post created"]);
} else {
    echo json_encode(["message" => "Post not created"]);
}

