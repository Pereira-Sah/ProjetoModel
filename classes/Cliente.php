<?php
require_once 'Conexao.php'; // Inclua a classe de conexão

class Cliente{
    private $pdo;

    public function __construct() {
        $conexao = new Conexao();
        $this->pdo = $conexao->conexao();
    }

    public function inserirCliente($nome, $documento, $tipo) {
        try {
            $sql = "INSERT INTO cliente (nome, documento, tipo_cliente) VALUES (:nome, :documento, :tipo)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':documento', $documento);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->execute();
        } catch (PDOException $e) {
            return "Erro: " . $e->getMessage();
        }
    }
}
?>
