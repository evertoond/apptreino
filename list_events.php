
 <?php


$query_events= "SELECT id, nomeMusculo, nomeExercicio, quantidadeSeries,quantidadeRepeticao, data, anotacao FROM tabelatreino";

$resultado_events = $conn->prepare($query_events);
$resultado_events->execute();

$eventos = [];

while($row_events = $resultado_events->fetch(PDO::FETCH_ASSOC)){
    $id = $row_events['id'];
    $nomeMusculo = $row_events['nomeMusculo'];
    $nomeExercicio = $row_events['nomeExercicio'];
    $quantidadeSeries = $row_events['quantidadeSeries'];
    $quantidadeRepeticao = $row_events['quantidadeRepeticao'];
    $data = $row_events['data'];
    $anotacao = $row_events['anotacao'];

    array_push($eventos, ['id' => $id, 'nomeMusculo' => $nomeMusculo, 'nomeExercicio' => $nomeExercicio, 'quantidadeSeries' => $quantidadeSeries, 'quantidadeRepeticao' => $quantidadeRepeticao, 'data' => $data, 'anotacao' => $anotacao]);
}

echo json_encode($eventos);
?>
