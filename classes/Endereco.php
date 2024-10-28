<?php
require_once 'Conexao.php'; // Inclua a classe de conexão

class Endereco{
    private $pdo;

    public function __construct() {
        $conexao5 = new Conexao();
        $this->pdo = $conexao5->conexao();
    }

    public function inserirEndereco($rua, $bairro,$cidade, $estado,$idcliente) {
        try {
            $sql = "INSERT INTO endereco (rua, bairro,cidade, estado,cliente_idcliente) VALUES (:rua, :bairro, :cidade, :estado,:idcliente)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':rua', $rua);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':cidade', $cidade);
            $stmt->bindParam(':estado', $estado);
            $stmt->bindParam(':idcliente', $idcliente);
            $stmt->execute();
        } catch (PDOException $e) {
            return "Erro: " . $e->getMessage();
        }
    }
}
?>
