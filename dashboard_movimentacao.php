<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
   <style>
    body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.navbar {
    background-color: #2c3e50;
    color: #ecf0f1;
    padding: 15px 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.logo {
    font-size: 28px;
    color: #ecf0f1;
    text-decoration: none;
}

.nav-links {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

.nav-links li {
    margin-left: 30px;
}

.nav-links a {
    color: #ecf0f1;
    text-decoration: none;
}

.hero {
    background-color: #3498db;
    color: #fff;
    text-align: center;
    padding: 30px;
}

.products {
    padding: 20px;
    max-width: 1200px;
    margin: 20px auto;
}

.table {
    width: 100%;
    margin-top: 20px;
}

.buy-button {
    background-color: #3498db;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    margin: 5px; 
}
.buy-buttonD {
    background-color: #2c3e50;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
}
.buy-button:hover {
    background-color: #2980b9;
}

footer {
    text-align: center;
    padding: 20px 0;
    background-color: #2c3e50;
    color: #fff;
}
</style> 
    <title>Dashboard de Movimentação de Contêineres</title>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.html" class="logo">Modelo</a>
            <ul class="nav-links">
                <li><a href="index.html">Início</a></li>
                <li><a href="cadastro/cadastroCliente.php">Cadastrar Cliente</a></li>
                <li><a href="cadastro/cadastroConteiner.php">Cadastrar Contêiner</a></li>
            </ul>
        </div>
    </nav>

    <header class="hero">
        <h1>Dashboard de Movimentação de Contêineres</h1>     
     <button class="buy-buttonD" onclick="window.location.href='cadastro/cadastroMovimentacao.php'">Nova Movimentação</button>

    </header>

    <section class="products">
        <h2>Lista de Contêineres</h2>
        <table class="table table-striped">
            <?php
            require_once 'classes/Conexao.php';
            $conexao = new Conexao();
            $pdo = $conexao->conexao();
          
            try{
                    $sql = "SELECT * FROM movimentacao";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $movimentacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
            foreach($movimentacoes as $movimentacao){
                $sql = "SELECT cliente_idcliente FROM cliente_conteiner WHERE conteiner_idconteiner = :idConteiner";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':idConteiner', $movimentacao['idconteiner'] );
                $stmt->execute();
                $idcliente = $stmt->fetch(PDO::FETCH_ASSOC);

                $sql = "SELECT nome FROM cliente WHERE idcliente = :idCliente";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':idCliente', $idcliente);
                $stmt->execute();
                $nome = $stmt->fetch(PDO::FETCH_ASSOC);

                echo"
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Cliente</th>
                    <th>Data e Hora Saida:</th>
                    <th>Data e Hora Chegada:</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>".$movimentacao['conteiner_idconteiner']."</td>
                    <td>".$movimentacao['tipo_movimentacao']."</td>
                    <td>".$nome."</td>
                    <td>".$movimentacao['data_hora_inicio']."</td>
                    <td>".$movimentacao['data_hora_fim']."</td>

                    <td>
                        <button class='buy-button' onclick='window.location.href='relatorio.php''>Relatorio</button>
                        <button class='buy-button' data-toggle='modal' data-target='#exampleModal'>Excluir</button>
                    </td>
       
        </tr>";
            }}catch(PDOException $e){
                echo "Erro: " .$e->getMessage();
            }
               ?>
            </tbody>
        </table>
    </section>
    <footer>
        <p>&copy; 2024 Contêineres. Sabrina Pereira.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="script.js"></script> 
</body>
</html>
            