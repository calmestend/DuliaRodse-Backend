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

$post->ID_ESC= $data->ID_ESC;
$post->COM_REV= $data->COM_REV;
$post->ID_REV= $data->ID_REV;

if ($post->update()) {
    echo json_encode(["message" => "Post created"]);
} else {
    echo json_encode(["message" => "Post not created"]);
}
