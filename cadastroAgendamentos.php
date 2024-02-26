<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fazer um agendamento</title>
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/agendamentos.css">
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<body>
    <?php
        if (!isset($_SESSION)) session_start();

        include('components/cabecalho.php');

        $nivel_necessario = 1;

        if (!isset($_SESSION["UsuarioID"])) {
            // Destrói a sessão
            header("Location: lista-agendamento.php"); exit;
        }
    ?>

    <div class="container">
        <h1 class="title">Cadastro de agendamento</h1>

        <div class="agendamentos__box">
            <div class="agendamentos__inputs">
                <form method="POST" action="upload-agendamento.php"  enctype="multipart/form-data">
                    
                    <div class="form-check">
                        <div>
                            <!-- Data -->
                            <div class="form-check">
                                <label for="dataCad">Data do agendamento *</label>
                                <input type="date" name="dataCad" id="dataCad" class="input-text input-data" required>
                            </div>

                            <!-- Cliente -->
                            <div class="form-check">
                                <label for="criador_agendamento">Nome do cliente</label>
                                <input type="hidden" name="criador_agendamento" value="<?php echo $_SESSION["UsuarioNome"]; ?>">
                                <input type="text" name="criador_agendamento" class="input-text input-readonly" value="<?php echo $_SESSION["UsuarioNome"]; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Observação -->
                    <div class="form-check">
                        <label for="observacao_agendamento">Observação do agendamento</label>
                        <textarea name="observacao_agendamento" id="observacao_agendamento" rows="5" style="resize: none;"></textarea>
                    </div>

                    <!-- Tipo do servico -->
                    <div class="form-check">
                        <p>Tipo do serviço</p>
                        <div class="buttons-radio">
                            <input type="radio" name="tipo_serv" value="Cabelos" id="radio-tipo-cabelos">
                            <label for="radio-tipo-cabelos">
                                Cabelos
                            </label>
                        </div>
                        <div class="buttons-radio">
                            <input type="radio" name="tipo_serv" value="Hidratacao" id="radio-tipo-hidratacao">
                            <label for="radio-tipo-hidratacao">
                                Hidratação
                            </label>
                        </div>
                        <div class="buttons-radio">
                            <input type="radio" name="tipo_serv" value="Unhas" id="radio-tipo-unha">
                            <label for="radio-tipo-unha">
                                Unhas
                            </label>
                        </div>
                    </div>

                    <input type="hidden" name="situacao_agendamento" value="Em Processamento">
                    <?php
                        if ($_SESSION["UsuarioNivel"] >= $nivel_necessario) {
                            echo "<div class='form-check'>";
                            echo "<label for='situacao_agendamento'>Situação do agendamento</label>";
                            echo "<select name='situacao_agendamento' id='situacao_agendamento'>";
                            echo "<option value='Em Processamento' " . ($agendamento['situacao_agendamento'] == 'Em Processamento' ? 'selected' : '') . ">Em Processamento</option>";
                            echo "<option value='Concluído' " . ($agendamento['situacao_agendamento'] == 'Concluído' ? 'selected' : '') . ">Concluído</option>";
                            echo "<option value='Negado' " . ($agendamento['situacao_agendamento'] == 'Negado' ? 'selected' : '') . ">Negado</option>";
                            echo "<option value='Aceito' " . ($agendamento['situacao_agendamento'] == 'Aceito' ? 'selected' : '') . ">Aceito</option>";
                            echo "</select>";
                            echo "</div>";
                        }
                    ?>
                
                    <!-- Enviar e Limpar -->
                    <input type="submit" value="Agendar" id="cadastroAgendamento" class="input-button">
                    <input type="reset" value="Limpar" id="limparCampos" class="input-button">
                </form>
            </div>
        </div>
    </div>

    <?php
        include('components/rodape.php');
    ?>
</body>
</html>