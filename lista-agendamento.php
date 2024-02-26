<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Agendamentos</title>
    <link rel="stylesheet" href="style/agendamentos.css">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="shortcut icon" href="favicon.ico" />
</head>
<body>
    <?php
        if (!isset($_SESSION)) session_start();

        include("components/cabecalho.php");

        if (!isset($_SESSION["UsuarioID"])) {
            header("Location: home.php"); exit;
        }
    
        $conn = mysqli_connect("localhost", "root", "", "salon-beauty");

        $id_usuario_logado = $_SESSION["UsuarioID"];
        $nivel_necessario = 1;
        if ($_SESSION["UsuarioNivel"] >= $nivel_necessario) {
            $query = "SELECT * FROM agendamentos";
        } else {
            $query = "SELECT * FROM agendamentos WHERE id_criador_agendamento = '$id_usuario_logado'";
        }

        $resultado = mysqli_query($conn, $query);

        //HTML do card de agendamento
        function criarCardAgendamento($aux) {
            $nivel_necessario = 1;

            $html = "<div class='agendamento'>";
            $html .= "<div class='infos card'>";
        
            $html .= "<div class='agendamento__situacao ";
            switch ($aux['situacao_agendamento']) {
                case 'Em Processamento':
                    $html .= 'processamento';
                    break;
                case 'Concluído':
                    $html .= 'concluido';
                    break;
                case 'Negado':
                    $html .= 'negado';
                    break;
                case 'Aceito':
                    $html .= 'aceito';
                    break;
                default:
                    $html .= '';
                    break;
            }
            $html .= "'>";
            $html .= $aux['situacao_agendamento'];
            $html .= "</div>";

            $html .= "<p class='agendamento__criador'>Cliente: <span>";
            $html .= ($aux['criador_agendamento'] == '') ? "Não Especificado" : $aux['criador_agendamento'];
            $html .= "</span></p>";
            $html .= "<h1 class='agendamento__servico'>Serviço: <span>" . $aux['tipo_serv'] . "</span></h1>";
            $html .= "<p class='agendamento__observacao'>Observação: <span>" . $aux['observacao_agendamento'] . "</span></p>";
            $html .= "<p class='agendamento__data-cad'>Agendamento: <span>" . date('d/m/Y', strtotime($aux['dataCad'])) . "</span></p>";

            $html .= "</div>";

            $html .= "<div class='button-icons'>";

            date_default_timezone_set('America/Sao_Paulo');
            $dataAtual = date('Y-m-d');
            $dataDoBanco = $aux['dataCad'];
            $dataMaisDoisDias = date('Y-m-d', strtotime($dataDoBanco . ' + 2 days'));
            $idAgendamento = $aux['id_agendamento'];
            $idAgendamentoHash = base64_encode($idAgendamento);
            
            if ($_SESSION["UsuarioNivel"] >= $nivel_necessario) {
                $html .= "<a href='editar.php?id_agendamento=$idAgendamentoHash' class='editar-button modified-button'>";
                $html .= "<span class='material-symbols-outlined'>edit</span>";
                $html .= "</a>";
                $html .= "<a href='actions/excluir.php?id_agendamento=$idAgendamento' class='excluir-button modified-button'>";
                $html .= "<span class='material-symbols-outlined'>delete</span>";
                $html .= "</a>";
            } else {
                if ($dataMaisDoisDias >= $dataAtual) {
                    $html .= "<a href='editar.php?id_agendamento=$idAgendamentoHash' class='editar-button modified-button'>";
                    $html .= "<span class='material-symbols-outlined'>edit</span>";
                    $html .= "</a>";
                    $html .= "<a href='actions/excluir.php?id_agendamento=$idAgendamento' class='excluir-button modified-button'>";
                    $html .= "<span class='material-symbols-outlined'>delete</span>";
                    $html .= "</a>";
                } else {
                    $html .= "<p class='warning-tempo'>";
                    $html .= "<span class='material-symbols-outlined'>warning</span>";
                    $html .= "Você excedeu o limite do tempo de edição! A alteração só poderá ser feita por telefone!</p>";
                }
            }

            $html .= "</div>";
            $html .= "</div>";

            return $html;
        }
    ?>

    <div class="container">
        <h1 class="title">Agendamentos</h1>
        <p class="boas-vindas">Seja bem vindo, <?php echo $_SESSION["UsuarioNome"];?>!</p>

        <form method="POST" action="#" enctype="multipart/form-data" class="form-filtro">
            De
            <input type="date" name="dataInicial" id="dataInicial">
            até
            <input type="date" name="dataFinal" id="dataFinal">

            <input type="submit" value="Filtrar Agendamentos" name="filtrarAgendamentos" class="filtrarAgends">
            <button type="reset" onclick="location.href='lista-agendamento.php';" class="limparAgends">Limpar</button>
        </form>

        <?php
            if (mysqli_num_rows($resultado) > 0) {
                echo "<div class='tabela-agendamentos'>";
                while ($aux = mysqli_fetch_assoc($resultado)) {
                    if (isset($_POST['filtrarAgendamentos'])) {
                        $dataInicial = $_POST['dataInicial'];
                        $dataFinal = $_POST['dataFinal'];

                        if (strtotime($aux['dataCad']) >= strtotime($dataInicial) && strtotime($aux['dataCad']) <= strtotime($dataFinal)) {
                            echo criarCardAgendamento($aux);
                        }
                    } else {
                        echo criarCardAgendamento($aux);
                    }
                }
                echo "</div>";
            } else {
                echo "Não há agendamentos dentro do intervalo de datas especificado.";
            }
        ?>
    </div>

    <?php
        include('components/rodape.php');
    ?>
</body>
    <script src="js/global.js"></script>
</html>