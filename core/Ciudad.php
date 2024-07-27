<?php
class Ciudad
{
    private $conn;

    public $CVE_CIUDAD;
    public $NOM_CIUDAD;
    public $CVE_ESTADO;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM CIUDAD";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function search_by_cve()
    {
        $query = "SELECT * FROM CIUDAD WHERE CVE_CIUDAD = ?";

        $stmt = $this->conn->prepare($query);
        $this->CVE_CIUDAD = htmlspecialchars(strip_tags($this->CVE_CIUDAD));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->CVE_CIUDAD);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function search_by_nom()
    {
        $query = "SELECT * FROM CIUDAD WHERE NOM_CIUDAD = ?";

        $stmt = $this->conn->prepare($query);
        $this->CVE_CIUDAD = htmlspecialchars(strip_tags($this->CVE_CIUDAD));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->CVE_CIUDAD);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function create()
    {
        $query =
            "INSERT INTO CIUDAD (CVE_CIUDAD, NOM_CIUDAD, CVE_ESTADO) VALUES ( ?, ?, ?)";

        $this->ID_CAT = htmlspecialchars(strip_tags($this->ID_CAT));
        $this->NOM_CAT = htmlspecialchars(strip_tags($this->NOM_CAT));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_CAT);
        $stmt->bindParam(2, $this->NOM_CAT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update()
    {
        $query =
            "UPDATE CIUDAD SET NOM_CIUDAD= ?, CVE_ESTADO=?  WHERE CVE_CIUDAD= ?";

        $this->NOM_CIUDAD = htmlspecialchars(strip_tags($this->NOM_CIUDAD));
        $this->CVE_ESTADO = htmlspecialchars(strip_tags($this->CVE_ESTADO));
        $this->CVE_CIUDAD = htmlspecialchars(strip_tags($this->CVE_CIUDAD));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NOM_CIUDAD);
        $stmt->bindParam(2, $this->CVE_ESTADO);
        $stmt->bindParam(3, $this->CVE_CIUDAD);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM CIUDAD WHERE CVE_CIUDAD = ? ";

        $this->CVE_CIUDAD = htmlspecialchars(strip_tags($this->CVE_CIUDAD));
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->CVE_CIUDAD);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

?>
