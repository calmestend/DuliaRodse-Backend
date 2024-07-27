<?php class Categoria
{
    private $conn;

    public $ID_CAT;
    public $NOM_CAT;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM CATEGORIA";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO CATEGORIA (ID_CAT, NOM_CAT) VALUES (?, ?)";

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
        $query = "UPDATE CATEGORIA SET NOM_CAT= ? WHERE ID_CAT= ?";

        $this->ID_CAT = htmlspecialchars(strip_tags($this->ID_CAT));
        $this->NOM_CAT = htmlspecialchars(strip_tags($this->NOM_CAT));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NOM_CAT);
        $stmt->bindParam(2, $this->ID_CAT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM CATEGORIA WHERE ID_CAT = ? ";

        $this->ID_CAT = htmlspecialchars(strip_tags($this->ID_CAT));
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_CAT);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

?>
