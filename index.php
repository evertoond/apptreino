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
            display: inline-block;
            vertical-align: top;
            padding: 10px;
        }

        .sub-campos .form-group {
            display: inline-block;
            vertical-align: top;
            margin-right: 10px;
        }

        .sub-campos {
            margin-top: 10px;
        }

        .formulario {
            margin-bottom: 10px;
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
        <div class="formulario" id="formulario1">
            <div class="form-group">
                <label>Grupo Muscular: </label>
                <input type="text" name="nomeMusculo[]">
                <button type="button" class="add-campo-sub"> + Adicionar Subgrupo</button>
            </div>
            <div class="sub-campos">
                <div class="form-group">
                    <label>Nome do exercício: </label>
                    <input type="text" name="nomeExercicio[]">
                </div>
                <div class="form-group">
                    <label>Quantidade de séries: </label>
                    <input type="text" name="quantidadeSeries[]">
                </div>
                <div class="form-group">
                    <label>Quantidade de repetições: </label>
                    <input type="text" name="quantidadeRepeticao[]">
                </div>
                <div class="form-group">
                    <label>Anotação: </label>
                    <input type="text" name="anotacao[]">
                </div>
                <button type="button" class="remover-campo-sub"> - Remover Subgrupo</button>
            </div>
        </div>

        <div class="form-group">
            <button type="button" class="add-campo"> + Adicionar Grupo</button>
        </div>
    </form>

    <script>
        var cont = 1;

        document.querySelector('form').addEventListener('click', function(event) {
            if (event.target.classList.contains('add-campo')) {
                cont++;

                var formulario = document.getElementById('add-aula');
                var novoFormulario = document.createElement('div');
                novoFormulario.className = 'formulario';
                novoFormulario.id = 'formulario' + cont;
                novoFormulario.innerHTML = '<div class="form-group">' +
                    '<label>Grupo Muscular: </label>' +
                    '<input type="text" name="nomeMusculo[]">' +
                    '<button type="button" class="add-campo-sub"> + Adicionar Subgrupo</button>' +
                    '</div>' +
                    '<div class="sub-campos">' +
                    '<div class="form-group">' +
                    '<label>Nome do exercício: </label>' +
                    '<input type="text" name="nomeExercicio[]">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Quantidade de séries: </label>' +
                    '<input type="text" name="quantidadeSeries[]">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Quantidade de repetições: </label>' +
                    '<input type="text" name="quantidadeRepeticao[]">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Anotação: </label>' +
                    '<input type="text" name="anotacao[]">' +
                    '</div>' +
                    '<button type="button" class="remover-campo-sub"> - Remover Subgrupo</button>' +
                    '</div>' +
                    '<button type="button" class="remover-formulario"> - Remover Grupo</button>';

                formulario.appendChild(novoFormulario);
            } else if (event.target.classList.contains('remover-formulario')) {
                var formularioParaRemover = event.target.parentNode;
                formularioParaRemover.remove();
            } else if (event.target.classList.contains('add-campo-sub')) {
                var formularioPai = event.target.closest('.formulario');
                var subCampos = formularioPai.querySelector('.sub-campos');

                var novoCampoSub = document.createElement('div');
                novoCampoSub.className = 'form-group';
                novoCampoSub.innerHTML = '<label>Nome do exercício: </label>' +
                    '<input type="text" name="nomeExercicio[]">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Quantidade de séries: </label>' +
                    '<input type="text" name="quantidadeSeries[]">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Quantidade de repetições: </label>' +
                    '<input type="text" name="quantidadeRepeticao[]">' +
                    '</div>' +
                    '<div class="form-group">' +
                    '<label>Anotação: </label>' +
                    '<input type="text" name="anotacao[]">' +
                    '</div>' +
                    '<button type="button" class="remover-campo-sub"> - Remover Subgrupo</button>';

                subCampos.appendChild(novoCampoSub);
            } else if (event.target.classList.contains('remover-campo-sub')) {
                var campoParaRemover = event.target.parentNode;
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
    <div class="form-group">
        <input type="button" name="CadAulas" id="CadAulas" value="cadastrar">
    </div>
</body>

</html>
