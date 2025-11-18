<?php
class Conectar {
    protected $conexion_bd;

    public function conectar_bd(){
        $host = getenv("MYSQLHOST");
        $user = getenv("MYSQLUSER");
        $pass = getenv("MYSQLPASSWORD");
        $db   = getenv("MYSQLDATABASE");
        $port = getenv("MYSQLPORT");

        try {
            $this->conexion_bd = new PDO(
                "mysql:host=$host;port=$port;dbname=$db;charset=utf8",
                $user,
                $pass,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (Exception $e) {
            die("Error de conexión: " . $e->getMessage());
        }

        return $this->conexion_bd;
    }

    public function establecer_codificacion(){
        $this->conexion_bd->query("SET NAMES 'utf8'");
    }
}
