<?php
class Factura
{
    private $conn;

	public $FEC_FACTURA;
	public $CVE_VENTA;


    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM DATOS_FACTURA";

        $stmt = $this->conn->prepare($query);
		$stmt->execute(); 
		return $stmt;
    }

	public function search_by_cve_venta()
	{
        $query = "SELECT * FROM DATOS_FACTURA WHERE CVE_VENTA = ?";

        $this->CVE_VENTA = htmlspecialchars(strip_tags($this->CVE_VENTA));
        $stmt = $this->conn->prepare($query);

		$stmt->bindParam(1, $this->CVE_VENTA);
		$stmt->execute(); 
		return $stmt;

	}

    public function create()
    {
        $query =
            "INSERT INTO FACTURA (FEC_FACTURA, CVE_VENTA) VALUES (?, ?)";

        $this->FEC_FACTURA = htmlspecialchars(strip_tags($this->FEC_FACTURA));
        $this->CVE_VENTA = htmlspecialchars(strip_tags($this->CVE_VENTA));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->FEC_FACTURA);
        $stmt->bindParam(2, $this->CVE_VENTA);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

