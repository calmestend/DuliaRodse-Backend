<?php
class Venta
{
	private $conn;

	public $CVE_VENTA;
	public $FEC_VENTA;
	public $PAGO_VENTA;
	public $ID_CLIE;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function read()
	{
		$query = "SELECT * FROM VENTA";

		$stmt = $this->conn->prepare($query);
		$stmt->execute(); return $stmt;
	}



	public function create()
	{
		$query =
		"INSERT INTO VENTA (FEC_VENTA, PAGO_VENTA, ID_CLIE) VALUES (?, ?, ?)";

		$this->FEC_VENTA = htmlspecialchars(strip_tags($this->FEC_VENTA));
		$this->PAGO_VENTA = htmlspecialchars(strip_tags($this->PAGO_VENTA));
		$this->ID_CLIE = htmlspecialchars(strip_tags($this->ID_CLIE));

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->FEC_VENTA);
		$stmt->bindParam(2, $this->PAGO_VENTA);
		$stmt->bindParam(3, $this->ID_CLIE);

		if ($stmt->execute()) {
			return true;
		}
		return false;
	}

	public function search_last_by_client() {
		$query = "SELECT * FROM ULTIMAS_VENTAS_POR_CLIENTE WHERE ID_CLIE = ?";

		$this->ID_CLIE = htmlspecialchars(strip_tags($this->ID_CLIE));
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ID_CLIE);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->CVE_VENTA = $row["CVE_VENTA"];
		$this->FEC_VENTA = $row["FEC_VENTA"];
		$this->PAGO_VENTA = $row["PAGO_VENTA"];
		$this->ID_CLIE = $row["ID_CLIE"];
	}


	public function read_shopping_history()
	{
		$query = "SELECT * FROM HISTORIAL_DE_COMPRAS";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function read_shopping_history_by_client()
	{
		$query = "SELECT * FROM HISTORIAL_DE_COMPRAS WHERE ID_CLIE= ?";

		$this->ID_CLIE = htmlspecialchars(strip_tags($this->ID_CLIE));
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ID_CLIE);
		$stmt->execute();
		return $stmt;
	}

}
