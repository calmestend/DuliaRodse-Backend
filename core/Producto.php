<?php

class Producto
{
    private $conn;

    public $ID_PRO;
    public $NOM_PRO;
    public $GRAM_PRO;
    public $COS_PRO;
    public $PREC_PRO;
    public $IMG_PRO;
    public $ID_CAT;
    public $AROMA_PRO;
    public $ACTIVO;
	public $NO_SUC;
	public $NO_INV;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        $query = "SELECT * FROM PRODUCTO";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function search_by_id()
    {
        $query = "SELECT * FROM PRODUCTO WHERE ID_PRO = ?";

        $stmt = $this->conn->prepare($query);

        $this->ID_PRO = htmlspecialchars(strip_tags($this->ID_PRO));

        $stmt->bindParam(1, $this->ID_PRO);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->ID_PRO = $row["ID_PRO"];
        $this->NOM_PRO = $row["NOM_PRO"];
        $this->GRAM_PRO = $row["GRAM_PRO"];
        $this->COS_PRO = $row["COS_PRO"];
        $this->PREC_PRO = $row["PREC_PRO"];
        $this->IMG_PRO = $row["IMG_PRO"];
        $this->ID_CAT = $row["ID_CAT"];
        $this->AROMA_PRO = $row["AROMA_PRO"];
        $this->ACTIVO = $row["ACTIVO"];
    }

	public function search_by_no_inv()
	{
		$query = "SELECT INVENTARIO.NO_INV, INVENTARIO.EXIST_INV,
		PRODUCTO.ID_PRO, PRODUCTO.NOM_PRO, PRODUCTO.GRAM_PRO,
		PRODUCTO.PREC_PRO, PRODUCTO.IMG_PRO, CATEGORIA.NOM_CAT,
		PRODUCTO.AROMA_PRO, PRODUCTO.ACTIVO
		FROM PRODUCTO
		INNER JOIN CATEGORIA ON PRODUCTO.ID_CAT = CATEGORIA.ID_CAT
		INNER JOIN INVENTARIO ON PRODUCTO.ID_PRO = INVENTARIO.ID_PRO
		WHERE INVENTARIO.NO_INV = ?";

		$stmt = $this->conn->prepare($query);
		$this->NO_INV = htmlspecialchars(strip_tags($this->NO_INV));

		$stmt->bindParam(1, $this->NO_INV);
		$stmt->execute();

		return $stmt;
	}

	public function read_by_no_suc() {
		$query = "SELECT INVENTARIO.NO_INV, INVENTARIO.EXIST_INV,
		PRODUCTO.ID_PRO, PRODUCTO.NOM_PRO, PRODUCTO.GRAM_PRO,
		PRODUCTO.PREC_PRO, PRODUCTO.IMG_PRO, CATEGORIA.NOM_CAT,
		PRODUCTO.AROMA_PRO, PRODUCTO.ACTIVO 
		FROM PRODUCTO 
		INNER JOIN CATEGORIA ON PRODUCTO.ID_CAT = CATEGORIA.ID_CAT 
		INNER JOIN INVENTARIO ON PRODUCTO.ID_PRO = INVENTARIO.ID_PRO 
		WHERE INVENTARIO.NO_SUC = ?";

        $stmt = $this->conn->prepare($query);

        $this->NO_SUC = htmlspecialchars(strip_tags($this->NO_SUC));

		$stmt->bindParam(1, $this->NO_SUC);
        $stmt->execute();

		return $stmt;
	}

	public function read_with_inventory() {
		$query = "SELECT INVENTARIO.NO_SUC, INVENTARIO.NO_INV, INVENTARIO.EXIST_INV,
		PRODUCTO.ID_PRO, PRODUCTO.NOM_PRO, PRODUCTO.GRAM_PRO, PRODUCTO.COS_PRO,
		PRODUCTO.PREC_PRO, PRODUCTO.IMG_PRO, CATEGORIA.NOM_CAT,
		PRODUCTO.AROMA_PRO, PRODUCTO.ACTIVO 
		FROM PRODUCTO 
		INNER JOIN CATEGORIA ON PRODUCTO.ID_CAT = CATEGORIA.ID_CAT 
		INNER JOIN INVENTARIO ON PRODUCTO.ID_PRO = INVENTARIO.ID_PRO";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;

	}

    public function create()
    {
        $query =
            "INSERT INTO PRODUCTO (ID_PRO, NOM_PRO, GRAM_PRO, COS_PRO, PREC_PRO, IMG_PRO, ID_CAT, AROMA_PRO, ACTIVO) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this->ID_PRO = htmlspecialchars(strip_tags($this->ID_PRO));
        $this->NOM_PRO = htmlspecialchars(strip_tags($this->NOM_PRO));
        $this->GRAM_PRO = htmlspecialchars(strip_tags($this->GRAM_PRO));
        $this->COS_PRO = htmlspecialchars(strip_tags($this->COS_PRO));
        $this->PREC_PRO = htmlspecialchars(strip_tags($this->PREC_PRO));
        $this->IMG_PRO = htmlspecialchars(strip_tags($this->IMG_PRO));
        $this->ID_CAT = htmlspecialchars(strip_tags($this->ID_CAT));
        $this->AROMA_PRO = htmlspecialchars(strip_tags($this->AROMA_PRO));
        $this->ACTIVO = htmlspecialchars(strip_tags($this->ACTIVO));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_PRO);
        $stmt->bindParam(2, $this->NOM_PRO);
        $stmt->bindParam(3, $this->GRAM_PRO);
        $stmt->bindParam(4, $this->COS_PRO);
        $stmt->bindParam(5, $this->PREC_PRO);
        $stmt->bindParam(6, $this->IMG_PRO);
        $stmt->bindParam(7, $this->ID_CAT);
        $stmt->bindParam(8, $this->AROMA_PRO);
        $stmt->bindParam(9, $this->ACTIVO);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function delete()
    {
        $query = "UPDATE PRODUCTO SET ACTIVO= 0 WHERE ID_PRO = ? ";

        $this->ID_PRO = htmlspecialchars(strip_tags($this->ID_PRO));
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_PRO);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update()
    {
        $query =
            "UPDATE PRODUCTO SET NOM_PRO= ?, GRAM_PRO= ?, COS_PRO= ?,PREC_PRO= ?,IMG_PRO= ?,ID_CAT= ? ,AROMA_PRO= ?, ACTIVO= ? WHERE ID_PRO= ?";

        $this->ID_PRO = htmlspecialchars(strip_tags($this->ID_PRO));
        $this->NOM_PRO = htmlspecialchars(strip_tags($this->NOM_PRO));
        $this->GRAM_PRO = htmlspecialchars(strip_tags($this->GRAM_PRO));
        $this->COS_PRO = htmlspecialchars(strip_tags($this->COS_PRO));
        $this->PREC_PRO = htmlspecialchars(strip_tags($this->PREC_PRO));
        $this->IMG_PRO = htmlspecialchars(strip_tags($this->IMG_PRO));
        $this->ID_CAT = htmlspecialchars(strip_tags($this->ID_CAT));
        $this->AROMA_PRO = htmlspecialchars(strip_tags($this->AROMA_PRO));
        $this->ACTIVO = htmlspecialchars(strip_tags($this->ACTIVO));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NOM_PRO);
        $stmt->bindParam(2, $this->GRAM_PRO);
        $stmt->bindParam(3, $this->COS_PRO);
        $stmt->bindParam(4, $this->PREC_PRO);
        $stmt->bindParam(5, $this->IMG_PRO);
        $stmt->bindParam(6, $this->ID_CAT);
        $stmt->bindParam(7, $this->AROMA_PRO);
        $stmt->bindParam(8, $this->ACTIVO);
        $stmt->bindParam(9, $this->ID_PRO);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
