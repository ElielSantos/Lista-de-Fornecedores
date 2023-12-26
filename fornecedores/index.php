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
        <h2>Lista de Fornecedores</h2>
        <br>
                <a class="btn btn-primary" href="/fornecedores/create.php" role="button">Novo Fornecedor</a>
                <br>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Endereço</th>
                            <th>Criado em</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "Fornecedores";

                        // Criar a conexão
                        $connection = new mysqli($servername, $username, $password, $database);

                        // Verifique a conexão
                        if ($connection->connect_error) {
                            die("Conexão Falhou! #" . $connection->connect_error);
                        }

                        //Leia todas as linhas da tabela do banco de dados
                        $sql = "SELECT * FROM clients";
                        $result = $connection->query($sql);

                        if (!$result) {
                            die("Query Inválida:" . $connection->error);
                        }

                        // Leia data de cada linha
                        while($row = $result->fetch_assoc()) {
                            echo "
                            <tr>
                              <td>$row[id]</td>
                              <td>$row[nome]</td>
                              <td>$row[email]</td>
                              <td>$row[telefone]</td>
                              <td>$row[endereco]</td>
                              <td>$row[criado_em]</td>
                              <td>
                                 <a class='btn btn-primary' href='/fornecedores/edit.php?id=$row[id]'>Editar</a>
                                 <a class='btn btn-primary btn-danger' href='/fornecedores/delete.php?id=$row[id]'>Deletar</a>
                              </td>
                            </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
    </div>
</body>

</html>