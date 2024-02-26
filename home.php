<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/reset.css">
    <link rel="stylesheet" href="style/home.css">
    <link rel="shortcut icon" href="favicon.ico" />

    <title>Home - Teste</title>
</head>
<body>
    <?php
        include('components/cabecalho.php');
    ?>

    <div class="container">
        <div class="title-home">
            Leila cabeleleilos, o salao de cabeleleilo da cabeleleila Leila!
        </div>
        <div class="login">
            <h1>Login</h1>
            <form method="POST" action="actions/login.php" class="inputs">
                <input type="text" name="email" id="email" placeholder="Seu email" required>
                <div class="input-senha eye-visible">
                    <input type="password" name="senha" id="senha" placeholder="Sua senha" required class="input-pass">
                    <span class="material-symbols-outlined password-eye pass-visible">
                        visibility
                    </span>
                    <span class="material-symbols-outlined password-eye pass-hidden">
                        visibility_off
                    </span>
                </div>
                
                <input type="submit" value="Entrar" id="entrar" name="entrar">
            </form>
        </div>

        <div class="cadastro">
            <h1>Cadastro</h1>

            <form method="POST" action="actions/cadastro.php" class="inputs">
                <input type="text" name="nome" id="nome" placeholder="Seu nome" required>

                <input type="email" name="email" id="email" placeholder="Seu email" required>
                
                <div class="input-senha eye-visible">
                    <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required class="input-pass">
                    <span class="material-symbols-outlined password-eye pass-visible">
                        visibility
                    </span>
                    <span class="material-symbols-outlined password-eye pass-hidden">
                        visibility_off
                    </span>
                </div>

                <input type="submit" value="Cadastrar" id="cadastroUser">
            </form>
        </div>
    </div>

    <?php
        include('components/rodape.php');
    ?>
    <script src="js/global.js"></script>
</body>
</html>