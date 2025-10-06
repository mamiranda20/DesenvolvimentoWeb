<?php
$server = "127.0.0.1";
$usuario = "root";
$senha = "usbw";  // senha padrão do USBWebserver
$banco = "folha_pagto"; // nome do seu banco de dados para folha de pagamento

$conn = new mysqli($server, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}
?>
