
<?php
include_once 'conexao.php';

// Consultar o banco de dados para recuperar os dados existentes
$query = "SELECT * FROM tabelatreino";
$result = mysqli_query($conn, $query);

// Gerar a tabela HTML dinamicamente
echo "<table>";
echo "<tr><th>Nome do Músculo</th><th>Nome do Exercício</th><th>Quantidade de Séries</th><th>Quantidade de Repetições</th><th>Anotação</th><th></th><th></th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<form action='update.php' method='post'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<td><input type='text' name='nomeMusculo' value='" . $row['nomeMusculo'] . "'></td>";
    echo "<td><input type='text' name='nomeExercicio' value='" . $row['nomeExercicio'] . "'></td>";
    echo "<td><input type='text' name='quantidadeSeries' value='" . $row['quantidadeSeries'] . "'></td>";
    echo "<td><input type='text' name='quantidadeRepeticao' value='" . $row['quantidadeRepeticao'] . "'></td>";
    echo "<td><input type='text' name='anotacao' value='" . $row['anotacao'] . "'></td>";
    echo "<td><input type='submit' value='Atualizar'></td>";
    echo "</form>";
    echo "<form action='delete.php' method='post'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<td><input type='submit' value='Excluir'></td>";
    echo "</form>";
    echo "</tr>";
}
echo "</table>";

// Adicionar links para as páginas de atualização e exclusão
echo "<p><a href='pagUpdate.php'>Página de Atualização</a></p>";
echo "<p><a href='delete.php'>Página de Exclusão</a></p>";
?>
