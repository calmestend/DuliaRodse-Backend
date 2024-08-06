<?php
class Usuario
{
    private $conn;

    public $ID_USU;
    public $NOM_USU;
    public $TIPO_USU;
    public $PASS_USU;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM USUARIO";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function login()
    {
        $query = "SELECT * FROM USUARIO WHERE (NOM_USU = ?) AND (PASS_USU = ?)";

        $this->NOM_USU = htmlspecialchars(strip_tags($this->NOM_USU));
        $this->PASS_USU = htmlspecialchars(strip_tags($this->PASS_USU));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NOM_USU);
        $stmt->bindParam(2, $this->PASS_USU);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->ID_USU = $row["ID_USU"];
        $this->NOM_USU = $row["NOM_USU"];
        $this->TIPO_USU = $row["TIPO_USU"];
        $this->PASS_USU = $row["PASS_USU"];
    }

    public function update()
    {
        $query = "UPDATE USUARIO SET NOM_USU= ?, PASS_USU= ? WHERE ID_USU= ?";

        $this->NOM_USU = htmlspecialchars(strip_tags($this->NOM_USU));
        $this->PASS_USU = htmlspecialchars(strip_tags($this->PASS_USU));
        $this->ID_USU = htmlspecialchars(strip_tags($this->ID_USU));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NOM_USU);
        $stmt->bindParam(2, $this->PASS_USU);
        $stmt->bindParam(3, $this->ID_USU);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function changeToClient()
    {
        $query = "UPDATE USUARIO SET TIPO_USU= 2 WHERE ID_USU= ?";

        $this->ID_USU = htmlspecialchars(strip_tags($this->ID_USU));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_USU);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function changeToAdmin()
    {
        $query = "UPDATE USUARIO SET TIPO_USU= 1 WHERE ID_USU= ?";

        $this->ID_USU = htmlspecialchars(strip_tags($this->ID_USU));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_USU);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM USUARIO WHERE ID_USU = ? ";

        $this->ID_USU = htmlspecialchars(strip_tags($this->ID_USU));
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_USU);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function create()
    {
        $query =
            "INSERT INTO USUARIO (NOM_USU, PASS_USU, TIPO_USU) VALUES (?, ?, ?)";

        $this->NOM_USU = htmlspecialchars(strip_tags($this->NOM_USU));
        $this->PASS_USU = htmlspecialchars(strip_tags($this->PASS_USU));
        $this->TIPO_USU = htmlspecialchars(strip_tags($this->TIPO_USU));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NOM_USU);
        $stmt->bindParam(2, $this->PASS_USU);
        $stmt->bindParam(3, $this->TIPO_USU);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
