<?php
    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        
        $conn = mysqli_connect("localhost", "root", "", "salon-beauty");
        
        $query = "DELETE FROM users WHERE user_id = '$user_id'";
        
        if(mysqli_query($conn, $query)){
            header("Location: ../gerenciamento.php");
        } else {
            echo "Erro ao excluir o usuario.";
        }
    } else {
        echo "Nenhum usuario foi especificado para excluir.";
    }
?>