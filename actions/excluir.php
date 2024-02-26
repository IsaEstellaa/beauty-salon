<?php
    if(isset($_GET['id_agendamento'])){
        $idAgendamento = $_GET['id_agendamento'];
        
        $conn = mysqli_connect("localhost", "root", "", "salon-beauty");
        
        $query = "DELETE FROM agendamentos WHERE id_agendamento = '$idAgendamento'";
        
        if(mysqli_query($conn, $query)){
            header("Location: ../lista-agendamento.php");
        } else {
            echo "Erro ao excluir o agendamento.";
        }
    } else {
        echo "Nenhum ID de agendamento foi especificado para excluir.";
    }
?>