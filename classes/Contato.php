<?php
require_once "Conexao.php";
class Contato {
    private $pdo;

    public function __construct() {
        $conexao = new Conexao();
        $this->pdo = $conexao->conexao();
    }

    public function inserirContato($celular, $telefone, $email, $idcliente) {
        try {
            $sql = "INSERT INTO contato (celular, telefone, email, cliente_idcliente) VALUES (:celular, :telefone, :email, :idcliente)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':celular', $celular);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':idcliente', $idcliente);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            return "Erro: " . $e->getMessage();
        }
    }
}

?>
