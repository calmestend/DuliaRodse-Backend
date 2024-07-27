<?php
class Pago
{
    private $conn;

    public $CVE_PAGO;
	public $FEC_PAGO;
	public $CANT_PAGO;
	public $TIP_PAGO;
	public $CVE_VENTA;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM PAGO";

        $stmt = $this->conn->prepare($query);
		$stmt->execute(); 
		return $stmt;
    }



    public function create()
    {
        $query =
            "INSERT INTO PAGO (FEC_PAGO, CANT_PAGO, TIP_PAGO, CVE_VENTA) VALUES (?, ?, ?, ?)";

        $this->FEC_PAGO = htmlspecialchars(strip_tags($this->FEC_PAGO));
        $this->CANT_PAGO = htmlspecialchars(strip_tags($this->CANT_PAGO));
        $this->TIP_PAGO = htmlspecialchars(strip_tags($this->TIP_PAGO));
        $this->CVE_VENTA = htmlspecialchars(strip_tags($this->CVE_VENTA));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->FEC_PAGO);
        $stmt->bindParam(2, $this->CANT_PAGO);
        $stmt->bindParam(3, $this->TIP_PAGO);
        $stmt->bindParam(4, $this->CVE_VENTA);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
