<?php

require_once 'Conexao.php'; // Inclua a classe de conexão

class Conteiner {
    private $pdo;

    public function __construct() {
        $conexao4 = new Conexao();
        $this->pdo = $conexao4->conexao();
    }

    public function inserirConteiner($id,$tipo_conteiner, $status, $categoria) {
        try {
            $sql = "INSERT INTO conteiner (idconteiner, tipo_conteiner, status, categoria) VALUES (:id,:tipo_conteiner, :status, :categoria)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':tipo_conteiner', $tipo_conteiner);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':categoria', $categoria);
            if ($stmt->execute()) {
                return "Contêiner inserido com sucesso!";
            } else {
                return "Erro ao inserir contêiner.";
            }
        } catch (PDOException $e) {
            return "Erro: " . $e->getMessage();
        }
    }

    public function inserirCont($idcliente, $idconteiner) {
        try {
            $sql = "INSERT INTO cliente_conteiner (cliente_idcliente, conteiner_idconteiner) VALUES (:idcliente,:idconteiner)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':idcliente', $idcliente);
            $stmt->bindParam(':idconteiner', $idconteiner);
            $stmt->execute();
        
        }catch (PDOException $e) {
            return "Erro: " . $e->getMessage();
        
}
}

public function excluirCont($idConteiner){

    try {
        $sql = "DELETE FROM cliente_conteiner WHERE conteiner_idconteiner = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idConteiner, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        return "Erro: " . $e->getMessage();
    }
} 
public function excluirConteiner($idConteiner){

    try {
        $sql = "DELETE FROM conteiner WHERE idconteiner = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $idConteiner, PDO::PARAM_INT);
        $stmt->execute();
    } catch (PDOException $e) {
        return "Erro: " . $e->getMessage();
    }
} 



}
?>
