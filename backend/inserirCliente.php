<?php
require '../classes/Cliente.php';
require '../classes/Contato.php';
require '../classes/Endereco.php';
require_once '../classes/Conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $documento = $_POST['documento'];
    $tipo = $_POST['tipo'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $estado = $_POST['estado']; 

    $conexao = new Conexao();
    $pdo = $conexao->conexao();

    try {
        $cliente = new Cliente();
        $cliente->inserirCliente($nome, $documento, $tipo);

        $sql = "SELECT idcliente FROM cliente WHERE documento = :documento";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':documento', $documento, PDO::PARAM_STR);
        $stmt->execute();
        $idCliente = $stmt->fetch(PDO::FETCH_ASSOC)['idcliente']; 

        $contato = new Contato();
        $contato->inserirContato($celular, $telefone, $email, $idCliente);

        $endereco = new Endereco();
        $endereco->inserirEndereco($rua, $bairro, $cidade, $estado, $idCliente);

      
        header('Location: ../index.php');
        exit();

    } catch (PDOException $e) {
        die("Erro: " . $e->getMessage()); 
    }
}
?>
