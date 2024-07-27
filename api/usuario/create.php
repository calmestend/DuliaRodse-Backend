<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header(
    "Access-Control-Allow-Headers: Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization"
);

include_once "../../core/initialize.php";
include_once "../../includes/config.php";

$post = new Usuario($db);

$data = json_decode(file_get_contents("php://input"));

$post->NOM_USU = $data->NOM_USU;
$post->PASS_USU = $data->PASS_USU;
$post->TIPO_USU = $data->TIPO_USU;

if ($post->create()) {
    echo json_encode(["message" => "Post created"]);
} else {
    echo json_encode(["message" => "Post not created"]);
}