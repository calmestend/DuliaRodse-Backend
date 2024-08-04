<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header(
    "Access-Control-Allow-Headers: Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization"
);

include_once "../../core/initialize.php";
include_once "../../includes/config.php";

$post = new Factura($db);

$data = json_decode(file_get_contents("php://input"));

$post->FEC_FACTURA = $data->FEC_FACTURA;
$post->CVE_VENTA = $data->CVE_VENTA;

if ($post->create()) {
    echo json_encode(["message" => "Post created"]);
} else {
    echo json_encode(["message" => "Post not created"]);
}


