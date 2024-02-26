<?php
    if (!isset($_SESSION)) session_start();

    $nivel_necessario = 0;

    if (!isset($_SESSION["UsuarioID"])) {
        // Destrói a sessão
        header("Location: lista-agendamento.php"); exit;
    }

    include("components/cabecalho.php");

    $conn = mysqli_connect("localhost", "root", "", "salon-beauty");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_agendamento"])) {

        $idAgendamentoEncode = $_GET["id_agendamento"]; //ID com base 64
        $idAgendamento = base64_decode($idAgendamentoEncode); //ID normal

        $idAgendamentoHash = base64_decode($idAgendamento);

        $sql = mysqli_query($conn, "SELECT * FROM agendamentos WHERE id_agendamento = $idAgendamento");
        
        $agendamento = mysqli_fetch_assoc($sql);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateAgendamento"])) {
        $idAgendamento = $_POST["id_agendamento"];

        $idAgendamentoHash = MD5($idAgendamento);

        $criador = mysqli_escape_string($conn, $_POST["criador_agendamento"]);
        $tipoServ = $_POST["tipo_serv"];
        $situacao_agendamento = $_POST["situacao_agendamento"];
        $observacao = mysqli_escape_string($conn, $_POST["observacao_agendamento"]);
        $dataCad = $_POST["dataCad"];

        $sql = mysqli_query($conn, "UPDATE agendamentos SET criador_agendamento = '$criador', tipo_serv = '$tipoServ', observacao_agendamento = '$observacao', dataCad = '$dataCad', situacao_agendamento = '$situacao_agendamento' WHERE id_agendamento = $idAgendamento");
        
        if ($sql) {
            header("Location: lista-agendamento.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar o agendamento</title>
        <link rel="stylesheet" href="style/agendamentos.css">
        <link rel="stylesheet" href="style/reset.css">
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <body>
        <div class="container">
            <h1 class="title">Editar seu agendamento</h1>

            <div class="agendamentos__inputs">
                <form method="POST" action="#" enctype="multipart/form-data">
                    <input type="hidden" name="id_agendamento" value="<?php echo $agendamento['id_agendamento']; ?>">

                    <div class="form-check">
                        <div>
                            <div class="form-check">
                                <label for="dataCad">Data do agendamento *</label>
                                <input type="date" name="dataCad" id="dataCad" class="input-text input-data" value="<?php echo $agendamento['dataCad']; ?>">
                            </div>

                            <div class="form-check">
                                <label for="criador_agendamento">Nome do cliente</label>
                                <input type="text" name="criador_agendamento" id="criador_agendamento" class="input-text input-readonly" value="<?php echo $agendamento['criador_agendamento']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                            
                    <div class="form-check">
                        <label for="observacao_agendamento">Observação do agendamento</label>
                        <textarea name="observacao_agendamento" id="observacao_agendamento" cols="30" rows="10" style="resize: none;"><?php echo $agendamento['observacao_agendamento']; ?></textarea>
                    </div>

                    <div class="form-check">
                        <p>Tipo do serviço</p>
                        <div class="buttons-radio">
                            <input type="radio" name="tipo_serv" value="Cabelos" id="radio-tipo-cabelos" <?php echo ($agendamento['tipo_serv'] == 'Cabelos') ? 'checked' : ''; ?>>
                            <label for="radio-tipo-cabelos">
                                Cabelos
                            </label>
                        </div>
                        <div class="buttons-radio">
                            <input type="radio" name="tipo_serv" value="Hidratacao" id="radio-tipo-hidratacao" <?php echo ($agendamento['tipo_serv'] == 'Hidratacao') ? 'checked' : ''; ?>>
                            <label for="radio-tipo-hidratacao">
                                Hidratação
                            </label>
                        </div>
                        <div class="buttons-radio">
                            <input type="radio" name="tipo_serv" value="Unhas" id="radio-tipo-unha" <?php echo ($agendamento['tipo_serv'] == 'Unhas') ? 'checked' : ''; ?>>
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
                        
                    <input type="submit" value="Atualizar agendamento" name="updateAgendamento" id="updateAgendamento" class="input-button">

                </form>
            </div>
            
        </div>

        <?php
            include('components/rodape.php');
        ?>
    </body>
</html>
