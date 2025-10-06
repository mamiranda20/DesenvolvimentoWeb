<?php
// listagem.php
include_once 'conexao_folha.php';
if (!$conn) die("Erro de conexão: " . mysqli_connect_error());

// filtro por nome (via GET)
$filtro = isset($_GET['filtro']) ? trim($_GET['filtro']) : '';

if ($filtro !== '') {
    $sql = "SELECT * FROM tb_funcionarios WHERE Nome_Funcionario LIKE ? ORDER BY N_Registro";
    $stmt = mysqli_prepare($conn, $sql);
    $like = "%$filtro%";
    mysqli_stmt_bind_param($stmt, "s", $like);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
} else {
    $res = mysqli_query($conn, "SELECT * FROM tb_funcionarios ORDER BY N_Registro");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Demonstrativo de Rendimentos Mensais</title>
<style>
body{font-family:Arial; background:#fff; padding:18px;}
.container{max-width:1000px; margin:0 auto;}
h1{text-align:center;}
.formrow{display:flex; gap:8px; align-items:center; margin-bottom:12px;}
input[type="text"]{padding:6px; width:350px; border:1px solid #ccc; border-radius:4px;}
.btn{padding:6px 12px; border-radius:4px; border:1px solid #999; background:#eee; cursor:pointer;}
.table{width:100%; border-collapse:collapse;}
.table th, .table td{border:1px solid #999; padding:8px; font-size:13px; text-align:left;}
.del{color:#900; text-decoration:none; font-weight:bold;}
</style>
</head>
<body>
<div class="container">
  <h1>DEMONSTRATIVO DE RENDIMENTOS MENSAIS</h1>

  <form method="get" action="listagem.php" class="formrow">
    <label for="filtro">DIGITE O NOME DO FUNCIONÁRIO:</label>
    <input type="text" id="filtro" name="filtro" value="<?=htmlspecialchars($filtro)?>">
    <button type="submit" class="btn">FILTRAR</button>
    <a href="home_funcionarios.php" class="btn">VOLTAR</a>
  </form>

  <table class="table">
    <thead>
      <tr>
        <th>Nº REGISTRO</th>
        <th>NOME FUNCIONÁRIO</th>
        <th>DATA ADMISSÃO</th>
        <th>CARGO</th>
        <th>SALÁRIO BRUTO</th>
        <th>INSS</th>
        <th>SALÁRIO LÍQUIDO</th>
        <th>APAGAR</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($res)): ?>
      <tr>
        <td><?=htmlspecialchars($row['N_Registro'])?></td>
        <td><?=htmlspecialchars($row['Nome_Funcionario'])?></td>
        <td><?=htmlspecialchars($row['data_admissao'])?></td>
        <td><?=htmlspecialchars($row['cargo'])?></td>
        <td>R$ <?=number_format($row['salario_bruto'],2,',','.')?></td>
        <td>
          <?php
            if ($row['inss'] == 0) echo "Isento";
            else echo "R$ " . number_format($row['inss'],2,',','.');
          ?>
        </td>
        <td>R$ <?=number_format($row['salario_liquido'],2,',','.')?></td>
        <td class="right">
          <a class="del" href="excluir.php?id=<?=urlencode($row['N_Registro'])?>" onclick="return confirm('Deseja apagar o registro <?=htmlspecialchars($row['N_Registro'])?>?')">✖</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</div>
</body>
</html>
<?php
mysqli_close($conn);
?>
