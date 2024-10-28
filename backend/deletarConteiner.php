<?php
require 'classes/Conexao.php';

$conexao = new Conexao();
$pdo = $conexao->conexao();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $idConteiner = $_POST['id'];

    try {
        $sql = "DELETE FROM conteiner WHERE idconteiner = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $idConteiner, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            header('Location: ../index.php');
        } else {
            echo json_encode(["success" => false, "message" => "Erro ao deletar o contêiner."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Erro: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "ID do contêiner não fornecido."]);
}
?>
