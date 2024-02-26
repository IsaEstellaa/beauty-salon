<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuarios</title>
    <link rel="stylesheet" href="style/usuario.css">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/agendamentos.css">
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<body>
    <?php
        if (!isset($_SESSION)) session_start();

        include("components/cabecalho.php");

        $nivel_necessario = 1;
        $nivel_necessario_admin = 2;

        if (!isset($_SESSION["UsuarioID"]) OR ($_SESSION["UsuarioNivel"] < $nivel_necessario)) {
            header("Location: lista-agendamento.php"); exit;
        }
    
        $conn = mysqli_connect("localhost", "root", "", "salon-beauty");

        $sql = mysqli_query($conn, "SELECT * FROM users") or die( 
            mysqli_error($cx)
        );

        $query = "SELECT nome, email, permission_id FROM users";
        $result = mysqli_query($conn, $query);

        // Agendamentos concluídos
        $queryConcluidos = "SELECT COUNT(*) AS total FROM agendamentos WHERE situacao_agendamento = 'Concluído'";
        $resultConcluidos = mysqli_query($conn, $queryConcluidos);
        $totalConcluidos = mysqli_fetch_assoc($resultConcluidos)['total'];

        // Agendamentos pendentes
        $queryPendentes = "SELECT COUNT(*) AS total FROM agendamentos WHERE situacao_agendamento != 'Concluído' AND situacao_agendamento != 'Negado'";
        $resultPendentes = mysqli_query($conn, $queryPendentes);
        $totalPendentes = mysqli_fetch_assoc($resultPendentes)['total'];

    ?>
    <div class="container">
        <!-- Card informativo -->
        <div class="card-informativo">
            <div class="card-informativo__permissoes">
                0 - Permissao Normal
                <div class="informacao">
                    <span class="material-symbols-outlined">
                        info
                    </span>
                    <p>O nível de permissão normal é atribuido aos <strong>clientes</strong>, onde o mesmo só pode visualizar seus agendamentos, criar e editar em até 2 dias.</p>
                </div>
            </div>
            <div class="card-informativo__permissoes">
                1 - Administrador não editor
                <div class="informacao">
                    <span class="material-symbols-outlined">
                        info
                    </span>
                    <p>O nível de administrador não editor costuma ser atribuido a <strong>pessoas que tem acesso ao sistema, como secretárias</strong>, pois consegue visualizar todos os agendamentos e editar mesmo que já tenha passado os 2 dias.</p>
                </div>
            </div>
            <div class="card-informativo__permissoes">
                2 - Administrador
                <div class="informacao">
                    <span class="material-symbols-outlined">
                        info
                    </span>
                    <p>O nível de administrador é o nível máximo, atribuido <strong>apenas à Leila</strong>, onde é possível realizar qualquer uma das funções anteriores e gerenciar os próprios usuarios, podendo excluir do sistema ou mudar seus níveis.</p>
                </div>
            </div>
        </div>


        <!-- Gerenciamento de usuarios -->
        <h1 class="title">Gerenciamento de Usuarios</h1>
        <div class="tabela-usuarios">
            <?php while($aux = mysqli_fetch_assoc($sql)) { ?>
            <div class="usuario">
                <div class="infos card">
                    <h1 class="usuario__nome">
                        Usuario:
                        <span>
                            <?php echo $aux['nome']?>
                        </span>
                    </h1>

                    <P class="usuario__email">
                        Email:
                        <span>
                            <?php echo $aux['email']; ?>
                        </span>
                    </P>

                    <p class="usuario__nivel">
                        Nivel de permissão:
                        <span>
                            <?php echo $aux['permission_id']; ?>
                        </span>
                    </p>
                </div>

                <?php
                    if ($_SESSION["UsuarioNivel"] == $nivel_necessario_admin) {
                        if ($aux['permission_id'] == 2) {
                            echo "<p class='warning-tempo'><span class='material-symbols-outlined'>warning</span>Não é possível editar/excluir esse usuário pois ele tem permissão máxima!</p>";
                        } else {
                ?>
                    <div class="button-icons">
                        <?php
                                $idUser = $aux['user_id'];
                                $idUserHash = base64_encode($idUser);

                                if ($_SESSION["UsuarioNivel"] == $nivel_necessario_admin) {
                                    echo "<a href='editarUser.php?user_id=$idUserHash' class='editar-button modified-button'>
                                            <span class='material-symbols-outlined'>
                                                edit
                                            </span>
                                        </a>";

                                    echo "<a href='actions/excluirUser.php?user_id=$idUser' class='excluir-button modified-button'>
                                            <span class='material-symbols-outlined'>
                                                delete
                                            </span>
                                        </a>";
                                }
                        ?>
                    </div>
                <?php
                    } 
                }
                ?>
            </div>

            <?php } ?> 
        </div>

        <!-- Filtro por semana -->
        <div class="filtro-semana">
            <h1 class="title">Filtrar por Semana</h1>
                <form method="POST" action="#" enctype="multipart/form-data" class="form-filtro-semanal">
                Visualizar agendamentos da semana:
                <input type="date" name="data" id="data">

                <input type="submit" value="Selecionar semana" class="filtrarSemana">
                <button type="reset" onclick="location.href='gerenciamento.php';" class="limparSemana">Limpar</button>

            </form>
        </div>

        <?php
            if (isset($_POST['data'])) {
                $dataEscolhida = $_POST['data'];
                $dataEscolhidaFormatada = date('Y-m-d', strtotime($dataEscolhida));

                $dataProximaSemana = date('Y-m-d', strtotime($dataEscolhidaFormatada . ' + 7 days'));
                $queryAgendamentosSemana = "SELECT * FROM agendamentos WHERE dataCad BETWEEN '$dataEscolhidaFormatada' AND '$dataProximaSemana'";
                $resultAgendamentosSemana = mysqli_query($conn, $queryAgendamentosSemana);
            }
            if (isset($resultAgendamentosSemana) && mysqli_num_rows($resultAgendamentosSemana) > 0) {
                echo "<div class='tabela-agendamentos'>";
                while ($auxAgendamento = mysqli_fetch_assoc($resultAgendamentosSemana)) {
                    ?>
                    <div class="agendamento">
                        <div class="infos card">
                            <div class="agendamento__situacao <?php
                                switch ($auxAgendamento['situacao_agendamento']) {
                                    case 'Em Processamento':
                                        echo 'processamento';
                                        break;
                                    case 'Concluído':
                                        echo 'concluido';
                                        break;
                                    case 'Negado':
                                        echo 'negado';
                                        break;
                                    case 'Aceito':
                                        echo 'aceito';
                                        break;
                                    default:
                                        echo '';
                                        break;
                                }
                            ?>">
                                <?php echo $auxAgendamento['situacao_agendamento']; ?>
                            </div>
                            <h1 class="agendamento__servico">
                                Serviço:
                                <span>
                                    <?php echo $auxAgendamento['tipo_serv']; ?>
                                </span>
                            </h1>
                            <p class="agendamento__criador">
                                Cliente:
                                <span>
                                    <?php echo ($auxAgendamento['criador_agendamento'] == '') ? "Não Especificado" : $auxAgendamento['criador_agendamento']; ?>
                                </span>
                            </p>
                            <p class="agendamento__observacao">
                                Observação:
                                <span>
                                    <?php echo $auxAgendamento['observacao_agendamento']; ?>
                                </span>
                            </p>
                            <p class="agendamento__data-cad">
                                Agendamento:
                                <span>
                                    <?php echo date('d/m/Y', strtotime($auxAgendamento['dataCad'])); ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    <?php
                }
                echo "</div>";
            } else {
                echo "<p class='warning-text'>Não há agendamentos para a semana selecionada.</p>";
            }
        ?>

        <!-- Informações de agendamentos -->
        <div class="info-agendamentos">
            <h1 class="title">Informações de Agendamentos</h1>
            <p class="contagem-agendamentos concluidos">Total de agendamentos concluídos:
                <span>
                    <?php echo $totalConcluidos; ?>
                    <span class="material-symbols-outlined">
                        check_circle
                    </span>
                </span>
            </p>
            <p class="contagem-agendamentos pendentes">Total de aceitos ou em processamento:
                <span>
                    <?php echo $totalPendentes; ?>
                    <span class="material-symbols-outlined">
                        pending
                    </span>
                </span>
            </p>
        </div>

    </div>

    <?php
        include('components/rodape.php');
    ?>
</body>
<script src="js/global.js"></script>
</html>