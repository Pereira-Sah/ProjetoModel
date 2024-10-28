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
    padding: 30px ;
}

.products {
    padding: 20px;
    max-width: 600px;
    margin: 20px auto;
}

.form-group {
    margin-bottom: 15px;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.buy-button {
    background-color: #3498db;
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
    <title> Movimentação de Contêineres</title>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="../index.php" class="logo">Modelo</a>
            <ul class="nav-links">
                <li><a href="index.html">Início</a></li>
                <li><a href="cadastroCliente.php">Cadastrar Cliente</a></li>
                <li><a href="cadastroConteiner.php">Cadastrar Contêiner</a></li>
            </ul>
        </div>
    </nav>

    <header class="hero">
        <h1> Movimentação de Contêineres</h1>
    </header>

    <section id="cadastro" class="products">
        <h2>Formulário Movimentação</h2>
        <form id="form-cadastro" method="POST" action="../backend/inserirMovimentacao.php">
            <div class="form-group">
                <label for="id_c">Numero Contêiner:</label>
                <input type="text" id="id_c" name="id_c" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select class="custom-select" id="tipo" name="tipo">
             <option selected>Escolha...</option>
            <option value="embarque">Embarque</option>
            <option value="descarga">Descarga</option>
            <option value="gate_in">Gate in</option>
            <option value="gate_out">Gate out</option>
            <option value="reposicionamento">Reposicionamneto</option>
            <option value="passagem">Passagem</option>
            <option value="scanner">Scanner</option>
                </select>
            </div>
            <div class="form-group">
            <label for="status">Data e Hora Saida:</label>
            <input type="text" id="dt_hr_inicio" class="form-control" name="dt_hr_inicio" required>
       </div>
       <div class="form-group">
       <label for="status">Data e Hora Chegada:</label>
            <input type="text" id="dt_hr_fim" name="dt_hr_fim" class="form-control" required>
       </div>
             
            <button type="submit" class="buy-button">Cadastrar</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Contêineres. Sabrina Pereira.</p>
    </footer>

    <script src="script.js"></script> <!-- Link para o JS -->
</body>
</html>
