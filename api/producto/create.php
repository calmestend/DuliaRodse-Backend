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

$post->ID_PRO = $data->ID_PRO;
$post->NOM_PRO = $data->NOM_PRO;
$post->GRAM_PRO = $data->GRAM_PRO;
$post->COS_PRO = $data->COS_PRO;
$post->PREC_PRO = $data->PREC_PRO;
$post->IMG_PRO = $data->IMG_PRO;
$post->ID_CAT = $data->ID_CAT;
$post->AROMA_PRO = $data->AROMA_PRO;
$post->ACTIVO = $data->ACTIVO;

if ($post->create()) {
    echo json_encode(["message" => "Post created"]);
} else {
    echo json_encode(["message" => "Post not created"]);
}
