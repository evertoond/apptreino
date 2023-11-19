<?php
    session_start();
?>

<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Treino personalizado</title>
    <style>
        .form-group {
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1>Tabela de Treino</h1>
    <?php if(isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }?>
    <span id="msg"></span>
    <form id="add-aula" method="POST">
        <div id="formulario">
            <div class="form-group">
                <label>Grupo Muscular: </label>
                <input type="text" name="nomeMusculo[]">
                <button type="button" id="add-campo"> + </button>
            </div>
        </div>
        <div class="form-group">
            <input type="button" name="CadAulas" id="CadAulas" value="cadastrar">
        </div>
    </form>

    <script>
        var cont = 1;

        document.getElementById('add-campo').addEventListener('click', function() {
            cont++;

            var formulario = document.getElementById('formulario');

            var novoCampo = document.createElement('div');
            novoCampo.className = 'form-group';
            novoCampo.id = 'campo' + cont;
            novoCampo.innerHTML = '<label>Nome do exercício: </label>' +
                '<input type="text" name="nomeExercicio[]">' +
                '<label>Quantidade de séries: </label>' +
                '<input type="text" name="quantidadeSeries[]">' +
                '<label>Quantidade de repetições: </label>' +
                '<input type="text" name="quantidadeRepeticao[]">' +
                '<label>Anotação: </label>' +
                '<input type="text" name="anotacao[]">' +
                '<button type="button" id="' + cont + '" class="btn-apagar"> - </button>';

            formulario.appendChild(novoCampo);
        });

        document.querySelector('form').addEventListener('click', function(event) {
            if (event.target.classList.contains('btn-apagar')) {
                var buttonId = event.target.id;
                var campoParaRemover = document.getElementById('campo' + buttonId);
                campoParaRemover.remove();
            }
        });

        document.getElementById('CadAulas').addEventListener('click', function() {
            var dados = new FormData(document.getElementById('add-aula'));

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'insert.php', true);

            xhr.onload = function() {
                if (xhr.status == 200) {
                    document.getElementById('msg').innerHTML = xhr.responseText;
                    retirarMsg();
                }
            };

            xhr.send(dados);
        });

        function retirarMsg() {
            setTimeout(function() {
                document.getElementById('msg').style.display = 'none';
            }, 1700);
        }
    </script>

</body>

</html>
