<?php
//home_funcionarios.php
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>Cadastro de Funcionários</title>
<style>
    <body>font-family: Arial, sans-serif; background:#f7f7f7; margin:0; padding:20px;}
    .box{max-width:900px; margin:20px auto; background:#fff; padding:18px; border-radius:6px;
        box-shadow: 0 0 0 6px rgba(255,223,0,0.35);} /* sombra amarela em volta */
    h1{text-align:center; margin:6px 0 18px 0;}
    .row{display:flex; gap:12px; align-items:center; margin-bottom:12px;}
    .col{flex:1;}
    label{display:block; font-weight:bold; font-size:13px; color:#0033c; margin-bottom:4px;} /* texto azul */
    input[type="text"], input[type="date"], select{width:100%; padding:8px; border:1px solid #aaa; border-radius:4px;}
    .small{width:120px;}
    .actions{display:flex; gap:10px; align-items:center; margin-top:12px;}
    .btn-red{
        background:#d93025; color:#fff; border:none; padding:10px 20 px; border-radius:30px;
        font-weight:bold; cursor:pointer;
    }
    .btn-gray{background:#e9e9e9; border:1px solid #ccc; padding:8px 12px; border-radius:6px; cursor:pointer;}
    .link{margin-left:10px; text-decoration:underline; color:#0066cc;}
    table{width:100%; border-collapse:collapse; margin-top:18px;}
    table th, table td{border:1px solid #ccc; padding:8px; text-align:left; font-size:13px;}
    .right{ text-align:right; }
</style>
</head>
<body>
    <div class="box">
        <h1>CADASTRO DE FUNCIONÁRIOS</h1>

        <form action="gravar.php" method="post">
            <div style="border:1px solid #ddd; padding:12px; border-radius:4px; margin-radius:4px; margin-bottom:12px;">
                <div class="row">
                    <div class="col small">
                        <label for="N_Registro">Nº REGISTRO</label>
                        <input type="text" id="N_Registro" name="N_Registro" required>
                    </div>
                    <div class="col">
                        <label for="Nome_Funcionario">NOME DO FUNCIONARIO</label>
                        <input type="text" id="Nome_Funcionario" name="Nome_Funcionario" required>
                    </div>
                    <div class="col small">
                        <label for="data_admissao">DATA DE ADMISSAO</label>
                        <input type="date" id="data_admissao" name="data_admissao">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="cargo">CARGO</label>
                        <select id="cargo" name="cargo">
                            <option value="">Selecione</option>
                            <option>Auxiliar Administrativo</option>
                            <option>Analista de Projetos</option>
                            <option>Gerente de Projetos</option>
                            <option>Analista de Suporte</option>
                            <option>Programador Jr.</option>
                            <option>Analista de Sistema</option>
                        </select>
                    </div>
                    
                    <div class="col small">
                        <label for="qtde_salarios">QTDE DE SALÁRIOS MÍNIMOS</label>
                        <input type="number" id="qtde_salarios" name="qtde_salarios" min="0">
                    </div>

                    <div class="col small">
                        <label for="salario_bruto">SALÁRIO BRUTO (R$)</label>
                        <input type="text" id="salario_bruto" name="salario_bruto" required>
                    </div>
                </div>
            </div>

            <div class="action">
                <button type="submit" class="btn-red">CADASTRAR</button>
                <a href="listagem.php" class="link">VISUALIZAR DEMONSTRATIVOS DE PAGAMENTOS</a>
            </div>
        </form>
    </div>
</body>
</html> 



