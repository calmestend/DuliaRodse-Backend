<?php

class Cliente
{
    private $conn;

    public $ID_USU;
    public $NOM_USU;
    public $PASS_USU;
    public $ID_CLIE;
    public $NI_CLIE;
    public $AP_CLIE;
    public $AM_CLIE;
    public $COL_CLIE;
    public $CALLE_CLIE;
    public $NOINT_CLIE;
    public $NOEXT_CLIE;
    public $CP_CLIE;
    public $EMAIL_CLIE;
    public $RFC_CLIE;
    public $TEL_CLIE;
    public $CVE_CIUDAD;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
		$query = "SELECT * FROM CLIENTE";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function search_by_id()
    {
        $query = 'SELECT USUARIO.ID_USU, USUARIO.NOM_USU, USUARIO.PASS_USU,
        ID_CLIE, NI_CLIE, AP_CLIE, AM_CLIE, COL_CLIE, CALLE_CLIE,
        NOINT_CLIE, NOEXT_CLIE, CP_CLIE, EMAIL_CLIE,
        RFC_CLIE, TEL_CLIE, CIUDAD.CVE_CIUDAD
        FROM CLIENTE
        INNER JOIN USUARIO ON CLIENTE.ID_USU = USUARIO.ID_USU
        INNER JOIN CIUDAD ON CLIENTE.CVE_CIUDAD = CIUDAD.CVE_CIUDAD
        WHERE ID_CLIE = ?
        ';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_CLIE);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->ID_USU = $row["ID_USU"];
        $this->NOM_USU = $row["NOM_USU"];
        $this->PASS_USU = $row["PASS_USU"];
        $this->ID_CLIE = $row["ID_CLIE"];
        $this->NI_CLIE = $row["NI_CLIE"];
        $this->AP_CLIE = $row["AP_CLIE"];
        $this->AM_CLIE = $row["AM_CLIE"];
        $this->COL_CLIE = $row["COL_CLIE"];
        $this->CALLE_CLIE = $row["CALLE_CLIE"];
        $this->NOINT_CLIE = $row["NOINT_CLIE"];
        $this->NOEXT_CLIE = $row["NOEXT_CLIE"];
        $this->CP_CLIE = $row["CP_CLIE"];
        $this->EMAIL_CLIE = $row["EMAIL_CLIE"];
        $this->RFC_CLIE = $row["RFC_CLIE"];
        $this->TEL_CLIE = $row["TEL_CLIE"];
        $this->CVE_CIUDAD = $row["CVE_CIUDAD"];
    }

    public function search_by_username()
    {
        $query = 'SELECT USUARIO.ID_USU, USUARIO.NOM_USU, USUARIO.PASS_USU,
        ID_CLIE, NI_CLIE, AP_CLIE, AM_CLIE, COL_CLIE, CALLE_CLIE,
        NOINT_CLIE, NOEXT_CLIE, CP_CLIE, EMAIL_CLIE,
        RFC_CLIE, TEL_CLIE, CIUDAD.CVE_CIUDAD
        FROM CLIENTE
        INNER JOIN USUARIO ON CLIENTE.ID_USU = USUARIO.ID_USU
        INNER JOIN CIUDAD ON CLIENTE.CVE_CIUDAD = CIUDAD.CVE_CIUDAD
        WHERE NOM_USU = ?
        ';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NOM_USU);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->ID_USU = $row["ID_USU"];
        $this->NOM_USU = $row["NOM_USU"];
        $this->PASS_USU = $row["PASS_USU"];
        $this->ID_CLIE = $row["ID_CLIE"];
        $this->NI_CLIE = $row["NI_CLIE"];
        $this->AP_CLIE = $row["AP_CLIE"];
        $this->AM_CLIE = $row["AM_CLIE"];
        $this->COL_CLIE = $row["COL_CLIE"];
        $this->CALLE_CLIE = $row["CALLE_CLIE"];
        $this->NOINT_CLIE = $row["NOINT_CLIE"];
        $this->NOEXT_CLIE = $row["NOEXT_CLIE"];
        $this->CP_CLIE = $row["CP_CLIE"];
        $this->EMAIL_CLIE = $row["EMAIL_CLIE"];
        $this->RFC_CLIE = $row["RFC_CLIE"];
        $this->TEL_CLIE = $row["TEL_CLIE"];
        $this->CVE_CIUDAD = $row["CVE_CIUDAD"];
    }

    public function create()
    {
        $query =
            "CALL INGRESAR_CLIENTE(:nom_usu, :pass_usu, :ni_clie, :ap_clie, :am_clie, :email_clie, :tel_clie)";

        $stmt = $this->conn->prepare($query);

        $this->NOM_USU = htmlspecialchars(strip_tags($this->NOM_USU));
        $this->PASS_USU = htmlspecialchars(strip_tags($this->PASS_USU));
        $this->NI_CLIE = htmlspecialchars(strip_tags($this->NI_CLIE));
        $this->AP_CLIE = htmlspecialchars(strip_tags($this->AP_CLIE));
        $this->AM_CLIE = htmlspecialchars(strip_tags($this->AM_CLIE));
        $this->EMAIL_CLIE = htmlspecialchars(strip_tags($this->EMAIL_CLIE));
        $this->TEL_CLIE = htmlspecialchars(strip_tags($this->TEL_CLIE));

        $stmt->bindParam(":nom_usu", $this->NOM_USU);
        $stmt->bindParam(":pass_usu", $this->PASS_USU);
        $stmt->bindParam(":ni_clie", $this->NI_CLIE);
        $stmt->bindParam(":ap_clie", $this->AP_CLIE);
        $stmt->bindParam(":am_clie", $this->AM_CLIE);
        $stmt->bindParam(":email_clie", $this->EMAIL_CLIE);
        $stmt->bindParam(":tel_clie", $this->TEL_CLIE);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error %s. \n", $stmt->error);
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM CLIENTE WHERE ID_CLIE = ? ";

        $this->ID_CLIE = htmlspecialchars(strip_tags($this->ID_CLIE));
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->ID_CLIE);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update()
    {
        $query =
		"UPDATE CLIENTE SET NI_CLIE= ?, AP_CLIE= ?, AM_CLIE= ?,
		COL_CLIE= ?, CALLE_CLIE= ?, NOINT_CLIE= ?,
		NOEXT_CLIE= ?, CP_CLIE= ?, EMAIL_CLIE= ?,
	   	RFC_CLIE= ?, TEL_CLIE= ?, CVE_CIUDAD= ? WHERE ID_CLIE= ?";

        $this->NI_CLIE = htmlspecialchars(strip_tags($this->NI_CLIE));
        $this->AP_CLIE = htmlspecialchars(strip_tags($this->AP_CLIE));
        $this->AM_CLIE = htmlspecialchars(strip_tags($this->AM_CLIE));
        $this->COL_CLIE = htmlspecialchars(strip_tags($this->COL_CLIE));
        $this->CALLE_CLIE = htmlspecialchars(strip_tags($this->CALLE_CLIE));
        $this->NOINT_CLIE = htmlspecialchars(strip_tags($this->NOINT_CLIE));
        $this->NOEXT_CLIE = htmlspecialchars(strip_tags($this->NOEXT_CLIE));
        $this->CP_CLIE = htmlspecialchars(strip_tags($this->CP_CLIE));
        $this->EMAIL_CLIE = htmlspecialchars(strip_tags($this->EMAIL_CLIE));
        $this->RFC_CLIE = htmlspecialchars(strip_tags($this->RFC_CLIE));
        $this->TEL_CLIE = htmlspecialchars(strip_tags($this->TEL_CLIE));
        $this->CVE_CIUDAD = htmlspecialchars(strip_tags($this->CVE_CIUDAD));
        $this->ID_CLIE = htmlspecialchars(strip_tags($this->ID_CLIE));

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->NI_CLIE);
        $stmt->bindParam(2, $this->AP_CLIE);
        $stmt->bindParam(3, $this->AM_CLIE);
        $stmt->bindParam(4, $this->COL_CLIE);
        $stmt->bindParam(5, $this->CALLE_CLIE);
        $stmt->bindParam(6, $this->NOINT_CLIE);
        $stmt->bindParam(7, $this->NOEXT_CLIE);
        $stmt->bindParam(8, $this->CP_CLIE);
        $stmt->bindParam(9, $this->EMAIL_CLIE);
        $stmt->bindParam(10, $this->RFC_CLIE);
        $stmt->bindParam(11, $this->TEL_CLIE);
        $stmt->bindParam(12, $this->CVE_CIUDAD);
        $stmt->bindParam(13, $this->ID_CLIE);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
