<?php
require_once '../classes/Conexao.php';
require '../classes/Conteiner.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $id = $_POST['id_c'];
    $tipo_conteiner = $_POST['tipo_conteiner'];
    $status = $_POST['status'];
    $categoria = $_POST['categoria'];
    $cliente = $_POST['documento']; 
    if (!$id || !$tipo_conteiner || !$status || !$categoria || !$cliente) {
        die("Erro: Todos os campos são obrigatórios.");
    }

    $conexao = new Conexao();
    $pdo = $conexao->Conexao();

    try {
        $sql = "SELECT idcliente FROM cliente WHERE documento = :documento";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':documento', $cliente, PDO::PARAM_STR);
        $stmt->execute();
        $idCliente = $stmt->fetch(PDO::FETCH_ASSOC)['idcliente'];

        $conteiner = new Conteiner();
        $conteiner->inserirConteiner($id, $tipo_conteiner, $status, $categoria);

        if ($idCliente) {
            $conteiner->inserirCont($idCliente, $id);
        }

        header('Location: ../index.php');
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
