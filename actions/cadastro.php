<?php
    $conn = mysqli_connect("localhost", "root", "", "salon-beauty");

    $name_user = mysqli_escape_string($conn, $_POST["nome"]);
    $email_user = mysqli_escape_string($conn, $_POST["email"]);
    $senha = MD5($_POST["senha"]);

    $check_query = "SELECT * FROM users WHERE email = '$email_user'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('E-mail já cadastrado!');window.location.href='../home.php';</script>";
    } else {
        $insert_query = "INSERT INTO users (nome, email, senha) VALUES ('$name_user', '$email_user', '$senha')";

        if (mysqli_query($conn, $insert_query)) {
            echo "<script>alert('Usuário cadastrado com sucesso!');window.location.href='../home.php';</script>";
        } else {
            echo "<script>alert('Não foi possível cadastrar esse usuário');window.location.href='../home.php';</script>";
        }
    }
?>
