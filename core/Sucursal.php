<?php class Sucursal 
{
	private $conn;

	public $NO_SUC;
	public $COL_SUC;
	public $CALLE_SUC;
	public $NOINT_SUC;
	public $NOEXT_SUC;
	public $CP_SUC;
	public $CVE_CIUDAD;
	public $ACTIVO;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function read()
	{
		$query = "SELECT * FROM SUCURSAL";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	public function read_with_direction()
	{
		$query = "SELECT NO_SUC, COL_SUC, CALLE_SUC, NOINT_SUC, NOEXT_SUC, CP_SUC, ACTIVO, CIUDAD.NOM_CIUDAD, ESTADO.NOM_ESTADO 
		FROM SUCURSAL
		INNER JOIN CIUDAD ON SUCURSAL.CVE_CIUDAD = CIUDAD.CVE_CIUDAD
		INNER JOIN ESTADO ON CIUDAD.CVE_ESTADO = ESTADO.CVE_ESTADO";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;

	}

    public function update()
    {
        $query = "UPDATE SUCURSAL SET COL_SUC= ?, CALLE_SUC= ?, NOINT_SUC= ?, NOEXT_SUC= ?, CP_SUC= ?, CVE_CIUDAD= ? WHERE NO_SUC= ?";

        $this->COL_SUC = htmlspecialchars(strip_tags($this->COL_SUC));
        $this->CALLE_SUC = htmlspecialchars(strip_tags($this->CALLE_SUC));
        $this->NOINT_SUC = htmlspecialchars(strip_tags($this->NOINT_SUC));
        $this->NOEXT_SUC = htmlspecialchars(strip_tags($this->NOEXT_SUC));
        $this->CP_SUC = htmlspecialchars(strip_tags($this->CP_SUC));
        $this->CVE_CIUDAD = htmlspecialchars(strip_tags($this->CVE_CIUDAD));
        $this->NO_SUC = htmlspecialchars(strip_tags($this->NO_SUC));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->COL_SUC);
        $stmt->bindParam(2, $this->CALLE_SUC);
        $stmt->bindParam(3, $this->NOINT_SUC);
        $stmt->bindParam(4, $this->NOEXT_SUC);
        $stmt->bindParam(5, $this->CP_SUC);
        $stmt->bindParam(6, $this->CVE_CIUDAD);
        $stmt->bindParam(7, $this->NO_SUC);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

	public function create()
	{
		$query = "INSERT INTO SUCURSAL (COL_SUC, CALLE_SUC, NOINT_SUC, NOEXT_SUC, CP_SUC, CVE_CIUDAD, ACTIVO) VALUES  (?, ?, ?, ?, ?, ?, ?)";
		
        $this->COL_SUC = htmlspecialchars(strip_tags($this->COL_SUC));
        $this->CALLE_SUC = htmlspecialchars(strip_tags($this->CALLE_SUC));
        $this->NOINT_SUC = htmlspecialchars(strip_tags($this->NOINT_SUC));
        $this->NOEXT_SUC = htmlspecialchars(strip_tags($this->NOEXT_SUC));
        $this->CP_SUC = htmlspecialchars(strip_tags($this->CP_SUC));
        $this->CVE_CIUDAD = htmlspecialchars(strip_tags($this->CVE_CIUDAD));
        $this->ACTIVO = htmlspecialchars(strip_tags($this->ACTIVO));

		
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->COL_SUC);
        $stmt->bindParam(2, $this->CALLE_SUC);
        $stmt->bindParam(3, $this->NOINT_SUC);
        $stmt->bindParam(4, $this->NOEXT_SUC);
        $stmt->bindParam(5, $this->CP_SUC);
        $stmt->bindParam(6, $this->CVE_CIUDAD);
        $stmt->bindParam(7, $this->ACTIVO);

        if ($stmt->execute()) {
            return true;
        }

        return false;
	}

	public function enable() {
        $query = "UPDATE SUCURSAL SET ACTIVO= 1 WHERE NO_SUC = ? ";

        $this->NO_SUC = htmlspecialchars(strip_tags($this->NO_SUC));
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NO_SUC);

        if ($stmt->execute()) {
            return true;
        }

        return false;
	}

	public function disable() {
        $query = "UPDATE SUCURSAL SET ACTIVO= 0 WHERE NO_SUC = ? ";

        $this->NO_SUC = htmlspecialchars(strip_tags($this->NO_SUC));
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NO_SUC);

        if ($stmt->execute()) {
            return true;
        }

        return false;
	}
}
