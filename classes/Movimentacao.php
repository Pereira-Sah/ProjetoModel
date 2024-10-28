<?php
require_once "Conexao.php";
class Movimentacao{ 
    private $pdo;
    public function __construct(){
        $conexao = new Conexao();
        $this->pdo = $conexao->conexao();
    }

    public function inserirMovimentacao($tipo, $dataHrInicio, $dataHrfim, $idConteiner){
        try{
            $sql = "INSERT INTO movimentacao (tipo_movimentacao, data_hora_inicio, data_hora_fim, conteiner_idconteiner) VALUES (:tipo, :dataHrInicio, :dataHrFim, :idConteiner)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':dataHrInicio', $dataHrInicio);
            $stmt->bindParam(':dataHrFim', $dataHrfim);
            $stmt->bindParam(':idConteiner', $idConteiner);
            $stmt->execute();
        }
        catch(PDOException $e){
            return "Erro: " . $e->getMessage();
        }
    }
}
?>