<?php
// gravar.php
// ajustes: conexão direta (modifique se você usa um arquivo conexao.php)
include_once 'conexao_folha.php';

if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // sanitiza e pega valores
    $N_Registro = intval($_POST['N_Registro']);
    $Nome_Funcionario = trim($_POST['Nome_Funcionario']);
    $data_admissao = $_POST['data_admissao'] ?: null;
    $cargo = trim($_POST['cargo']);
    $qtde_salarios = intval($_POST['qtde_salarios']);
    $salario_bruto = floatval(str_replace(',', '.', $_POST['salario_bruto'])); // aceita vírgula

    // regra do enunciado: INSS = 11% se salario_bruto > 1550, do contrário isento (0)
    if ($salario_bruto > 1550.00) {
        $inss = round($salario_bruto * 0.11, 2);
    } else {
        $inss = 0.00;
    }

    $salario_liquido = round($salario_bruto - $inss, 2);

    // prepared statement para inserir
    $sql = "INSERT INTO tb_funcionarios (N_Registro, Nome_Funcionario, data_admissao, cargo, qtde_salarios, salario_bruto, inss, salario_liquido)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("Erro na preparação: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, "isssiidd",
        $N_Registro, $Nome_Funcionario, $data_admissao, $cargo, $qtde_salarios, $salario_bruto, $inss, $salario_liquido
    );

    if (mysqli_stmt_execute($stmt)) {
        // sucesso -> redireciona para listagem
        header("Location: listagem.php");
        exit;
    } else {
        // possível erro (ex.: registro duplicado)
        $err = mysqli_error($conn);
        echo "<p>Erro ao gravar: $err</p>";
        echo "<p><a href='home_funcionarios.php'>Voltar</a></p>";
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($conn);

?>
