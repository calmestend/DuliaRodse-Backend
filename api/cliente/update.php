<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header(
    "Access-Control-Allow-Headers: Access-Control-Allow-Headers: Content-Type, X-Requested-With, Authorization"
);

include_once "../../core/initialize.php";
include_once "../../includes/config.php";

$post = new Cliente($db);

$data = json_decode(file_get_contents("php://input"));

$post->ID_CLIE = $data->ID_CLIE;
$post->NI_CLIE = $data->NI_CLIE;
$post->AP_CLIE = $data->AP_CLIE;
$post->AM_CLIE = $data->AM_CLIE;
$post->COL_CLIE = $data->COL_CLIE;
$post->CALLE_CLIE = $data->CALLE_CLIE;
$post->NOINT_CLIE = $data->NOINT_CLIE;
$post->NOEXT_CLIE = $data->NOEXT_CLIE;
$post->CP_CLIE = $data->CP_CLIE;
$post->EMAIL_CLIE = $data->EMAIL_CLIE;
$post->RFC_CLIE = $data->RFC_CLIE;
$post->TEL_CLIE = $data->TEL_CLIE;
$post->CVE_CIUDAD = $data->CVE_CIUDAD;

if ($post->update()) {
    echo json_encode(["message" => "Post created"]);
} else {
    echo json_encode(["message" => "Post not created"]);
}
