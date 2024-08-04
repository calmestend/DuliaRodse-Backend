<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once "../../core/initialize.php";

$post = new Factura($db);

$result = $post->read();
$num = $result->rowCount();

if ($num > 0) {
	$post_array = [];
	$post_array["data"] = [];

	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$post_item = [
			"ID_CLIE" => $CVE_VENTA,
			"ID_CLIE" => $ID_CLIE,
			"NI_CLIE" => $NI_CLIE,
			"AP_CLIE" => $AP_CLIE,
			"AM_CLIE" => $AM_CLIE,
			"COL_CLIE" => $COL_CLIE,
			"CALLE_CLIE" => $CALLE_CLIE,
			"NOINT_CLIE" => $NOINT_CLIE,
			"NOEXT_CLIE" => $NOEXT_CLIE,
			"CP_CLIE" => $CP_CLIE,
			"EMAIL_CLIE" => $EMAIL_CLIE,
			"NOM_CIUDAD" => $NOM_CIUDAD,
			"NOM_ESTADO" => $NOM_ESTADO,
			"CVE_VENTA" => $CVE_VENTA,
			"FEC_VENTA" => $FEC_VENTA,
			"PAGO_VENTA" => $PAGO_VENTA,
			"CVE_PAGO" => $CVE_PAGO,
			"CANT_PAGO" => $CANT_PAGO,
			"TIP_PAGO" => $TIP_PAGO,
			"CVE_FACTURA" => $CVE_FACTURA,
			"CANT_PRO" => $CANT_PRO,
			"NO_INV" => $NO_INV,
			"ID_PRO" => $ID_PRO,
			"NOM_PRO" => $NOM_PRO,
			"PREC_PRO" => $PREC_PRO,
			"IMPORTE" => $IMPORTE,
		];

		array_push($post_array["data"], $post_item);
	}

	echo json_encode($post_array);
} else {
	echo json_encode(["message" => "No posts found"]);
}

?>


