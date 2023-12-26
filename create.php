<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "Fornecedores";

// Criar a conexão
$connection = new mysqli($servername, $username, $password, $database);

$nome = "";
$email = "";
$telefone = "";
$endereco = "";

$mensagemErro = "";
$mensagemSucesso = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    do {
        if (empty($nome) || empty($email) || empty($telefone) || empty($endereco)) {
            $mensagemErro = "Os campos estão vazios";
            break;
        }

        //Adicionando novo fornecedor ao banco de dados

        $sql = "INSERT INTO clients (nome, email, telefone, endereco) 
                VALUES ('$nome', '$email', '$telefone', '$endereco')";
        $result = $connection->query($sql);

        if (!$result) {
            $mensagemErro = "Consulta inválida: " . $connection->error;
            break;
        }

        $nome = "";
        $email = "";
        $telefone = "";
        $endereco = "";

        $mensagemSucesso = "Cliente adicionado com sucesso!";

        header("location: /fornecedores/index.php");
        exit;

    } while (false);
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Novo Fornecedor</h2>
        <br>

        <?php
        if (!empty($mensagemErro)) {
            echo "
           <div class='alert alert-warning alert-dismissible fade show' role='alert'>
             <strong>$mensagemErro</strong>
             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
           </div>
           ";
        }
        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nome" value="<?php echo $nome; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Telefone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="telefone" value="<?php echo $telefone; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Endereço</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="endereco" value="<?php echo $endereco; ?>">
                </div>
            </div>

            <?php
            if (!empty($mensagemSucesso)) {
                echo "
                  <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                  <strong>$mensagemSucesso</strong>
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                  </div>                
                  ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="http://localhost:81/fornecedores/index.php" role="button">Cancelar</a>
                 </div>
            </div>
        </form>
    </div>
</body>

</html>