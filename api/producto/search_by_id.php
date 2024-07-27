<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../core/initialize.php";

$post = new Producto($db);

$post->ID_PRO = isset($_GET["id_pro"]) ? $_GET["id_pro"] : false;

if ($post->ID_PRO) {
    $post->search_by_id();
} else {
    echo json_encode(["message" => "No post found"]);
    die();
}

$post_array = [
    "ID_PRO" => $post->ID_PRO,
    "NOM_PRO" => $post->NOM_PRO,
    "GRAM_PRO" => $post->GRAM_PRO,
    "COS_PRO" => $post->COS_PRO,
    "PREC_PRO" => $post->PREC_PRO,
    "IMG_PRO" => $post->IMG_PRO,
    "ID_CAT" => $post->ID_CAT,
    "AROMA_PRO" => $post->AROMA_PRO,
    "ACTIVO" => $post->ACTIVO
];

echo json_encode($post_array);
