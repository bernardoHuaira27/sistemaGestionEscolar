<?php
class Conexion {
    private $host = 'localhost';
    private $db = 'sistemaEscolar';
    private $user = 'root';
    private $password = '2002';
    private $charset = 'utf8mb4';
    public $pdo;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            echo "No se logró conectar a la base de datos: " . $e->getMessage();
        }
    }

    public function getConexion() {
        return $this->pdo;
    }
}

// Ejemplo de uso
$conexion = new Conexion();
$pdo = $conexion->getConexion();
