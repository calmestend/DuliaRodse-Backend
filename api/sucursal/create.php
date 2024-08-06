<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header(
    "Access-Control-Allow-Headers: Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization"
);

include_once "../../core/initialize.php";
include_once "../../includes/config.php";

$post = new Sucursal($db);

$data = json_decode(file_get_contents("php://input"));

$post->COL_SUC = $data->COL_SUC;
$post->CALLE_SUC = $data->CALLE_SUC;
$post->NOINT_SUC = $data->NOINT_SUC;
$post->NOEXT_SUC = $data->NOEXT_SUC;
$post->CP_SUC = $data->CP_SUC;
$post->CVE_CIUDAD = $data->CVE_CIUDAD;
$post->ACTIVO = $data->NO_SUC;

if ($post->create()) {
    echo json_encode(["message" => "Post created"]);
} else {
    echo json_encode(["message" => "Post not created"]);
}

