<?php
class Conexao{
    public $host = 'localhost';
    public $dbname = 'db_modelo';
    public $username = 'root';
    public $password = '';

    public function conexao() {
        try {
            $pdo = new PDO("mysql:host={$this->host};dbname={$this->dbname};charset=utf8", $this->username, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            return "Erro de conexão: " . $e->getMessage();
        }
    }
}
?>
