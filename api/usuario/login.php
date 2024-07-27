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

$post->login();

$post_item = [
    "ID_USU" => $post->ID_USU,
    "NOM_USU" => $post->NOM_USU,
    "TIPO_USU" => $post->TIPO_USU,
    "PASS_USU" => $post->PASS_USU,
];

echo json_encode($post_item);

?>
