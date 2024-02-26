
<?php
    $conn = mysqli_connect("localhost", "root", "", "salon-beauty");

    $email_user = mysqli_escape_string($conn, $_POST["email"]);

    $senha = MD5($_POST["senha"]);

    $sql = "SELECT * FROM users WHERE email = '$email_user' AND senha = '$senha'";

    $query = mysqli_query($conn, $sql);


    if (mysqli_num_rows($query) != 1) {
        echo"<script language='javascript' type='text/javascript'>
        alert('Login inválido');window.location.
        href='../home.php'</script>";
    } else {
        $resultado = mysqli_fetch_assoc($query);

        if (!isset($_SESSION)) session_start();

        $_SESSION["UsuarioID"] = $resultado["user_id"];
        $_SESSION["UsuarioNome"] = $resultado["nome"];
        $_SESSION["UsuarioNivel"] = $resultado["permission_id"];

        header("Location: ../lista-agendamento.php"); exit;
    }
?>