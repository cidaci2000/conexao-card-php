<?php
// Configurações do Banco de Dados
$servidor = "localhost";    // Geralmente é 'localhost'
$usuario = "seu_usuario";   // Seu nome de usuário do MySQL
$senha = "sua_senha";       // Sua senha do MySQL
$banco = "seu_banco_de_dados"; // O nome do seu banco de dados

// Cria a conexão
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica se a conexão falhou
if ($conexao->connect_error) {
    // Para depuração:
    // die("Falha na conexão: " . $conexao->connect_error); 
    // Em produção:
    die("Ocorreu um erro ao conectar-se ao sistema. Tente novamente mais tarde.");
}

// Opcional: define o charset para evitar problemas com acentuação
$conexao->set_charset("utf8");

?>