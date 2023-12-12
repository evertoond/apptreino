<?php
    session_start();
?>

<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Treino personalizado</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        .form-group {
            padding: 10px;
        }
    </style>
</head>

<body>
    <h1>Tabela de Treino</h1>
    <?php if(isset( $_SESSION['msg'])){
        echo  $_SESSION['msg'];
        unset  ($_SESSION['msg']);
    }?>
    <span id="msg"></span>
    <form id="add-aula" method="POST">
        <div id="formulario">
            <div class="grupo">
                <div class="form-group">
                    <label>Grupo Muscular: </label>
                    <input type="text" name="nomeMusculo[]">
                    <button type="button" class="add-campo"> + </button>
                    <button type="button" class="remove-grupo"> Remover Grupo </button>
                </div>
            </div>
            <button type="button" id="add-grupo"> Adicionar Grupo </button>
        </div>
        <div class="form-group">
            <input type="button" name="CadAulas" id="CadAulas" value="cadastrar">
        </div>

    </form>

    <script>
        var contGrupo = 1;
        var contCampo = 1;

        $('#add-grupo').click(function() {
            contGrupo++;

            var novoGrupo = $('<div class="grupo">' +
                '<div class="form-group">' +
                '<label>Grupo Muscular: </label>' +
                '<input type="text" name="nomeMusculo[]">' +
                '<button type="button" class="add-campo"> + </button>' +
                '<button type="button" class="remove-grupo"> Remover Grupo </button>' +
                '</div>' +
                '</div>');

            $('#formulario').append(novoGrupo);
        });

        $('#formulario').on('click', '.add-campo', function() {
            contCampo++;

            var novoCampo = $('<div class="form-group" id="campo' + contCampo + '">' +
                '<label>Nome do exercício: </label>' +
                '<input type="text" name="nomeExercicio[]">' +
                '<label>Quantidade de séries: </label>' +
                '<input type="text" name="quantidadeSeries[]">' +
                '<label>Quantidade de repetições: </label>' +
                '<input type="text" name="quantidadeRepeticao[]">' +
                '<label>Anotação: </label>' +
                '<input type="text" name="anotacao[]">' +
                '<button type="button" id="' + contCampo + '" class="btn-apagar"> - </button>' +
                '</div>');

            $(this).closest('.grupo').append(novoCampo);
        });

        $('#formulario').on('click', '.remove-grupo', function() {
            var confirmacao = confirm("Tem certeza de que deseja remover este grupo?");
            if (confirmacao) {
                $(this).closest('.grupo').remove();
            }
        });

        $('#formulario').on('click', '.btn-apagar', function() {
            var confirmacao = confirm("Tem certeza de que deseja remover este campo?");
            if (confirmacao) {
                var button_id = $(this).attr("id");
                $('#campo' + button_id).remove();
            }
        });

        $("#CadAulas").click(function() {
            var dados = $("#add-aula").serialize();
            $.post("insert.php", dados, function(retorna) {
                $("#msg").html(retorna);
                retirarMsg();
            });
        });

        function retirarMsg() {
            setTimeout(function() {
                $("#msg").slideUp('slow', function() {});
            }, 1700);
        }
    </script>
</body>

</html>
