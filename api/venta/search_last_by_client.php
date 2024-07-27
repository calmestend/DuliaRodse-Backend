<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../core/initialize.php";

$post = new Venta($db);

$post->ID_CLIE = isset($_GET["id_clie"]) ? $_GET["id_clie"] : false;

if ($post->ID_CLIE) {
    $post->search_last_by_client();
} else {
    echo json_encode(["message" => "No post found"]);
    die();
}

$post_array = [
    "CVE_VENTA" => $post->CVE_VENTA,
    "FEC_VENTA" => $post->FEC_VENTA,
	"PAGO_VENTA" => $post->PAGO_VENTA,
	"ID_CLIE" => $post->ID_CLIE
];

echo json_encode($post_array);
