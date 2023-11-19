<?php
include_once 'conexao.php';

$id = $_POST['id'];
$nomeMusculo = $_POST['nomeMusculo'];
$nomeExercicio = $_POST['nomeExercicio'];
$quantidadeSeries = $_POST['quantidadeSeries'];
$quantidadeRepeticao = $_POST['quantidadeRepeticao'];
$anotacao = $_POST['anotacao'];

// Preparar a consulta
$stmt = mysqli_prepare($conn, "UPDATE tabelatreino SET nomeMusculo=?, nomeExercicio=?, quantidadeSeries=?, quantidadeRepeticao=?, anotacao=? WHERE id=?");

// Vincular os parâmetros
mysqli_stmt_bind_param($stmt, "sssisi", $nomeMusculo, $nomeExercicio, $quantidadeSeries, $quantidadeRepeticao, $anotacao, $id);

// Executar a consulta
if (mysqli_stmt_execute($stmt)) {
    header("Location: pagUpdate.php");
} else {
    echo "Erro ao atualizar os dados: " . mysqli_stmt_error($stmt);
}

// Fechar o statement
mysqli_stmt_close($stmt);
?>
