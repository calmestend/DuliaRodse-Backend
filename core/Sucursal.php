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
		$query = "SELECT NO_SUC, COL_SUC, CALLE_SUC, NOINT_SUC, NOEXT_SUC, CP_SUC, CIUDAD.NOM_CIUDAD, ESTADO.NOM_ESTADO 
		FROM SUCURSAL
		INNER JOIN CIUDAD ON SUCURSAL.CVE_CIUDAD = CIUDAD.CVE_CIUDAD
		INNER JOIN ESTADO ON CIUDAD.CVE_ESTADO = ESTADO.CVE_ESTADO";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;

	}


}
