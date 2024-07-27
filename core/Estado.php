<?php
class Estado
{
    private $conn;

    public $CVE_ESTADO;
    public $NOM_ESTADO;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM ESTADO";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function search_by_cve()
    {
        $query = "SELECT * FROM ESTADO WHERE CVE_ESTADO = ?";

        $stmt = $this->conn->prepare($query);
        $this->CVE_ESTADO = htmlspecialchars(strip_tags($this->CVE_ESTADO));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->CVE_ESTADO);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function search_by_nom()
    {
        $query = "SELECT * FROM ESTADO WHERE NOM_ESTADO = ?";

        $stmt = $this->conn->prepare($query);
        $this->CVE_ESTADO = htmlspecialchars(strip_tags($this->CVE_ESTADO));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->CVE_ESTADO);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update()
    {
        $query = "UPDATE ESTADO SET NOM_ESTADO= ? WHERE CVE_ESTADO= ?";

        $this->NOM_ESTADO = htmlspecialchars(strip_tags($this->NOM_ESTADO));
        $this->CVE_ESTADO = htmlspecialchars(strip_tags($this->CVE_ESTADO));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NOM_ESTADO);
        $stmt->bindParam(2, $this->CVE_ESTADO);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM ESTADO WHERE CVE_ESTADO = ? ";

        $this->CVE_ESTADO = htmlspecialchars(strip_tags($this->CVE_ESTADO));
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->CVE_ESTADO);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

?>
