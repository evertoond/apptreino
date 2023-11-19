<?php
include_once 'conexao.php';

$id = $_POST['id'];

// Preparar a consulta
$stmt = mysqli_prepare($conn, "DELETE FROM tabelatreino WHERE id=?");

// Vincular os parâmetros
mysqli_stmt_bind_param($stmt, "i", $id);

// Executar a consulta
if (mysqli_stmt_execute($stmt)) {
    header("Location: pagDelete.php");
} else {
    echo "Erro ao excluir os dados: " . mysqli_stmt_error($stmt);
}

// Fechar o statement
mysqli_stmt_close($stmt);

// Adicionar links para as páginas de exibição e atualização
echo "<p><a href='index.php'>Página de Exibição</a></p>";
echo "<p><a href='pagUpdate.php'>Página de Atualização</a></p>";
?>