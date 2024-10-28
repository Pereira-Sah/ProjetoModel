<?php
require_once "classes/Conteiner.php";
$cont = new Conteiner();

// Captura da requisição para exclusão
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $resultado = $cont->excluirCont($_POST['delete_id']);
    $resultado = $cont->excluirConteiner($_POST['delete_id']);
    echo "<script>alert('$resultado');</script>";
}
?>

<!DOCTYPE html>  
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="#" class="logo">Modelo</a>
            <ul class="nav-links">
                <li><a href="index.php">Início</a></li>
                <li><a href="cadastro/cadastroCliente.php">Cadastrar Cliente</a></li>
                <li><a href="cadastro/cadastroConteiner.php">Cadastrar Contêiner</a></li>
            </ul>
        </div>
    </nav>

    <header class="hero">
        <div class="hero-content">
            <h1>Que possamos navegar com coragem em busca de novos horizontes!</h1>
            <p>Descubra os melhores contêineres para suas necessidades.</p>
            <a href="#produtos" class="cta-button">Explore Agora</a>
        </div>
    </header>
    
    <?php
    require_once 'classes/Conexao.php';

    $conexao = new Conexao();
    $pdo = $conexao->conexao();
    try {
        $sql = "SELECT * FROM conteiner";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $conteineres = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<section id='produtos' class='products'>
                <h2>Contêineres</h2>
                <div class='product-list'>";
        
        foreach ($conteineres as $conteiner) {
            $status = $conteiner['status'] === 'c' ? "Cheio" : "Vazio";
            $categoria = $conteiner['categoria'] === 'e' ? "Exportação" : "Importação";

            $sql = "SELECT cliente_idcliente FROM cliente_conteiner WHERE conteiner_idconteiner = :idconteiner";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idconteiner', $conteiner['idconteiner'], PDO::PARAM_STR);
            $stmt->execute();
            $idcliente = $stmt->fetch(PDO::FETCH_ASSOC)['cliente_idcliente'];

            $sql = "SELECT nome FROM cliente WHERE idcliente = :idcliente";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':idcliente', $idcliente, PDO::PARAM_STR);
            $stmt->execute();
            $nome = $stmt->fetch(PDO::FETCH_ASSOC)['nome']; 
            
            echo "<div class='product'>
                    <h3>".$conteiner['idconteiner']."</h3>
                    <p>Tipo: ".$conteiner['tipo_conteiner']."</p>
                    <p>Status: ".$status."</p>
                    <p>Categoria: ".$categoria."</p>
                    <p>Cliente: ".$nome."</p>
                    <button class='buy-button' onclick='window.location.href=\"dashboard_movimentacao.php\"'>Movimentação</button>
                    <button class='buy-button' onclick='window.location.href=\"cadastro/editarConteiner.php\"'>Editar</button>
                        <form method='POST' style='display:inline-block;'>
                <input type='hidden' name='delete_id' value='".$conteiner['idconteiner']."'>
                <button type='submit' class='buy-button' onclick='return confirm(\"Certeza que deseja deletar este contêiner?\")'>Excluir</button>
            </form>

                  </div>";
        }
        
        echo "</div></section>";
    } catch (PDOException $e) {
        echo "Erro ao consultar contêineres: " . $e->getMessage();
    }
    ?>

    <footer>
        <p>&copy; 2024 Contêineres. Sabrina Pereira.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
