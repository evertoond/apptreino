
<?php
session_start();
include_once 'conexao.php';

$nomeMusculo = $_POST['nomeMusculo'];
$nomeExercicio = $_POST['nomeExercicio'];
$quantidadeSeries = $_POST['quantidadeSeries'];
$quantidadeRepeticao = $_POST['quantidadeRepeticao'];
$anotacao = $_POST['anotacao'];

function format($nomeMusculo, $nomeExercicio, $quantidadeSeries, $quantidadeRepeticao, $anotacao)
{
    return "('{$nomeMusculo}', '{$nomeExercicio}', '{$quantidadeSeries}','{$quantidadeRepeticao}','{$anotacao}')";
}

$valores = array_map("format", $nomeMusculo, $nomeExercicio, $quantidadeSeries, $quantidadeRepeticao, $anotacao);

$query = sprintf("INSERT INTO tabelatreino (nomeMusculo, nomeExercicio, quantidadeSeries,quantidadeRepeticao,anotacao) VALUES %s", join(', ', $valores));

$resultado_user = mysqli_query($conn, $query);

if (!$resultado_user) {
  printf("Error: %s\n", mysqli_error($conn));
}

if (mysqli_insert_id($conn)) {
    $_SESSION['msg'] = "Sucesso";
    header("Location: index.php");
} else {
    echo "erro ao cadastrar";
}
