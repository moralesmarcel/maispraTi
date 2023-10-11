<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <title>Cadastro de Notas</title>
</head>
    <body>

    <?php
    // ler Parâmetros
    function lerParametro($parametro) {
        return isset($_GET[$parametro]) ? $_GET[$parametro] : null;
    }

    // Conectar ao BD
    function conectarBanco() {
        $host = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "aulaphp";
        $porta = 3306;

        try {
            return new PDO("mysql:host=$host;port=$porta;dbname=$banco", $usuario, $senha);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    // Executar instrução SQL com Tratamento de Erros
    function executarConsulta($sql, $parametros = []) {
        $conexao = conectarBanco();
        $consulta = $conexao->prepare($sql);
        $consulta->execute($parametros);
        return $consulta;
    }

    // Inserir Registro
    function inserirRegistro($nome, $nota) {
        $sql = "INSERT INTO notas (nome, nota) VALUES (:nome, :nota)";
        executarConsulta($sql, [':nome' => $nome, ':nota' => $nota]);
    }

    // Excluir Registro
    function excluirRegistro($id) {
        $sql = "DELETE FROM notas WHERE id = :id";
        executarConsulta($sql, [':id' => $id]);
    }

    // Formulário de Cadastro
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = $_POST["nome"];
        $nota = $_POST["nota"];
        inserirRegistro($nome, $nota);
    }

    // Ação para exclusão
    if ($acao = lerParametro("acao")) {
        $id = lerParametro("id");
        if ($acao === "remover" && $id !== null) {
            excluirRegistro($id);
        }
    }

    // Exibição dos dados da tabela
    $sql = "SELECT id, nome, nota FROM notas";
    $consulta = executarConsulta($sql);
    $resultados = $consulta->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Registros</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome</th><th>Nota</th><th>Ação</th></tr>";

    foreach ($resultados as $cadastro) {
        $id = $cadastro["id"];
        $nome = $cadastro["nome"];
        $nota = $cadastro["nota"];

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$nome</td>";
        echo "<td>$nota</td>";
        echo "<td><a href='?acao=remover&id=$id'>Remover</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    ?>

    <br>
    <hr size="3">
    <h2>Cadastro</h2>
    <form method="post">
        Nome: <input type="text" name="nome"><br>
        Nota: <input type="text" name="nota"><br>
        <br>
        <input type="submit" value="Cadastrar">
    </form>

    </body>
</html>
