<?php
class Venta_Inventario
{
    private $conn;

    public $CVE_VENTA;
	public $NO_INV;
	public $CANT_PRO;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM VENTA_INVENTARIO";

        $stmt = $this->conn->prepare($query);
		$stmt->execute(); 
		return $stmt;
    }



    public function create()
    {
        $query =
            "INSERT INTO VENTA_INVENTARIO (CVE_VENTA, NO_INV, CANT_PRO) VALUES (?, ?, ?)";

        $this->CVE_VENTA = htmlspecialchars(strip_tags($this->CVE_VENTA));
        $this->NO_INV = htmlspecialchars(strip_tags($this->NO_INV));
        $this->CANT_PRO = htmlspecialchars(strip_tags($this->CANT_PRO));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->CVE_VENTA);
        $stmt->bindParam(2, $this->NO_INV);
        $stmt->bindParam(3, $this->CANT_PRO);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

}

