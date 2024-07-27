<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../core/initialize.php";

$post = new Cliente($db);

$post->ID_CLIE = isset($_GET["id_clie"]) ? $_GET["id_clie"] : false;
$post->NOM_USU = isset($_GET["nom_usu"]) ? $_GET["nom_usu"] : false;

if ($post->ID_CLIE) {
    $post->search_by_id();
} elseif ($post->NOM_USU) {
    $post->search_by_username();
} else {
    echo json_encode(["message" => "No post found"]);
    die();
}

$post_array = [
    "ID_USU" => $post->ID_USU,
    "NOM_USU" => $post->NOM_USU,
    "PASS_USU" => $post->PASS_USU,
    "ID_CLIE" => $post->ID_CLIE,
    "NI_CLIE" => $post->NI_CLIE,
    "AP_CLIE" => $post->AP_CLIE,
    "AM_CLIE" => $post->AM_CLIE,
    "COL_CLIE" => $post->COL_CLIE,
    "CALLE_CLIE" => $post->CALLE_CLIE,
    "NOINT_CLIE" => $post->NOINT_CLIE,
    "NOEXT_CLIE" => $post->NOEXT_CLIE,
    "CP_CLIE" => $post->CP_CLIE,
    "EMAIL_CLIE" => $post->EMAIL_CLIE,
    "RFC_CLIE" => $post->RFC_CLIE,
    "TEL_CLIE" => $post->TEL_CLIE,
    "CVE_CIUDAD" => $post->CVE_CIUDAD,
];

echo json_encode($post_array);
?>
