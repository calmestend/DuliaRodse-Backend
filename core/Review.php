<?php class Review
{
	private $conn;

	public $ID_REV;
	public $ID_ESC;
	public $ID_CLIE;
	public $ID_PRO;
	public $COM_REV;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	public function read()
	{
		$query = "SELECT * FROM REVIEW";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}


	public function read_by_id_pro()
	{
		$query = "SELECT * FROM REVIEW WHERE ID_PRO = ?";

		$this->ID_PRO = htmlspecialchars(strip_tags($this->ID_PRO));

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ID_PRO);

		$stmt->execute();

		return $stmt;
	}

	public function read_by_id_clie()
	{
		$query = "SELECT * FROM REVIEW WHERE ID_CLIE = ?";

		$this->ID_CLIE = htmlspecialchars(strip_tags($this->ID_CLIE));

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ID_CLIE);

		$stmt->execute();

		return $stmt;
	}

	public function create()
	{
		$query = "INSERT INTO REVIEW (ID_ESC, ID_CLIE, ID_PRO, COM_REV) VALUES (? , ? , ? , ?)";

        $this->ID_ESC = htmlspecialchars(strip_tags($this->ID_ESC));
		$this->ID_CLIE = htmlspecialchars(strip_tags($this->ID_CLIE));
		$this->ID_PRO = htmlspecialchars(strip_tags($this->ID_PRO));
		$this->COM_REV = htmlspecialchars(strip_tags($this->COM_REV));

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->ID_ESC);
        $stmt->bindParam(2, $this->ID_CLIE);
        $stmt->bindParam(3, $this->ID_PRO);
        $stmt->bindParam(4, $this->COM_REV);

        if ($stmt->execute()) {
            return true;
        }

        return false;
	}

}
?>

