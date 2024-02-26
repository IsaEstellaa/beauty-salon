<?php
    if (!isset($_SESSION)) session_start();

    $nivel_necessario = 0;

    if (!isset($_SESSION["UsuarioID"]) OR ($_SESSION["UsuarioNivel"] < $nivel_necessario)) {
        session_destroy();
        header("Location: home.php"); exit;
    }

    $conn = mysqli_connect("localhost", "root", "", "salon-beauty");

    $query = "";

    //Cadastro de agendamentos
    $id_criador = $_SESSION["UsuarioID"];
    $criador = $_POST['criador_agendamento'];
    $situacao_agendamento = $_POST["situacao_agendamento"];
    $observacao = mysqli_escape_string($conn, $_POST['observacao_agendamento']);
    $data = $_POST['dataCad'];
    $tipoServ = isset($_POST['tipo_serv']) ? $_POST['tipo_serv'] : "";
    
    $query = "INSERT INTO agendamentos (criador_agendamento, id_criador_agendamento, observacao_agendamento, dataCad, tipo_serv , situacao_agendamento) VALUES ('$criador', '$id_criador', '$observacao', '$data', '$tipoServ', '$situacao_agendamento')";
    
    if (empty($query)) {
        
    } else {
        mysqli_query($conn, $query);

        if (mysqli_affected_rows($conn) < 1) {
            echo"<script language='javascript' type='text/javascript'>
            alert('Não foi possível cadastrar o agendamento');window.location.
            href='cadastroAgendamentos.php'";
        } else {
            echo"<script language='javascript' type='text/javascript'>
            alert('Agendamento cadastrado com sucesso!');window.location.
            href='lista-agendamento.php'</script>";
        }
    }
?>