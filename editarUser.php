<?php
    if (!isset($_SESSION)) session_start();

    $nivel_necessario = 1;

    if (!isset($_SESSION["UsuarioID"]) OR ($_SESSION["UsuarioNivel"] < $nivel_necessario)) {
        // Destrói a sessão
        header("Location: lista-agendamento.php"); exit;
    }

    include("components/cabecalho.php");

    $conn = mysqli_connect("localhost", "root", "", "salon-beauty");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["user_id"])) {

        $idUserEncode = $_GET["user_id"]; //ID com base 64
        $idUser = base64_decode($idUserEncode); //ID normal

        $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_id = $idUser");
        
        $usuario = mysqli_fetch_assoc($sql);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updateUser"])) {
        $idUser = $_POST["user_id"];

        $nomeUser = mysqli_escape_string($conn, $_POST["nome"]);
        $emailUser = mysqli_escape_string($conn, $_POST["email"]);
        $nivelUser = $_POST["permission_id"];

        $sql = mysqli_query($conn, "UPDATE users SET nome = '$nomeUser', email = '$emailUser', permission_id = '$nivelUser' WHERE user_id = $idUser");
        
        if ($sql) {
            header("Location: gerenciamento.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Usuario</title>
        <link rel="stylesheet" href="style/usuario.css">
        <link rel="stylesheet" href="style/reset.css">
        <link rel="shortcut icon" href="favicon.ico" />
    </head>
    <body>
        <div class="container">
            <h1 class="title">Editar Usuario - <?php echo $usuario['nome']; ?></h1>

            <div class="usuarios__inputs">
                <form method="POST" action="#">
                    <input type="hidden" name="user_id" value="<?php echo $usuario['user_id']; ?>">

                    <div class="form-check">
                        <label for="nome">Nome do Usuario</label>
                        <input type="text" name="nome" id="nome" class="input-text input-readonly" value="<?php echo $usuario['nome']; ?>" readonly>
                    </div>

                    <div class="form-check">
                        <label for="email">Email do Usuario</label>
                        <input type="text" name="email" id="email" class="input-text input-readonly" value="<?php echo $usuario['email']; ?>" readonly>
                    </div>

                    <div class="form-check">
                        <p>Permissão do Usuario</p>
                        <div class="buttons-radio">
                            <input type="radio" name="permission_id" value="0" id="radio-nivel-um" <?php echo ($usuario['permission_id'] == '0') ? 'checked' : ''; ?>>
                            <label for="radio-nivel-zero">
                                0 - Normal
                            </label>
                        </div>
                        <div class="buttons-radio">
                            <input type="radio" name="permission_id" value="1" id="radio-nivel-dois" <?php echo ($usuario['permission_id'] == '1') ? 'checked' : ''; ?>>
                            <label for="radio-nivel-um">
                                1 - Administrador não editor
                            </label>
                        </div>
                    </div>
                        
                    <input type="submit" value="Atualizar Usuario" name="updateUser" id="updateUser" class="input-button">

                </form>
            </div>
            
        </div>

        <?php
            include('components/rodape.php');
        ?>
    </body>
</html>
