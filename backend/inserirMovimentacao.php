<?php
require_once "../classes/Movimentacao.php";
require_once "../classes/Conexao.php";

if($_SERVER['REQUEST_METHOD']==='POST'){
    $idConteiner = $_POST['id_c'];
    $tipo = $_POST['tipo'];
    $dataHrInicio = $_POST['dt_hr_inicio'];
    $dataHrFim = $_POST['dt_hr_fim'];

    $conexao = new Conexao();
    $pdo = $conexao->conexao();

    try{
 
        $movimentacao = new Movimentacao();
        $movimentacao->inserirMovimentacao($tipo, $dataHrInicio, $dataHrFim, $idConteiner);
        header('Location: ../index.php');
    }catch(PDOException $e){
        echo "Erro: " . $e->getMessage();
    }
}
?>