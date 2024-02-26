<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<nav class="header">
    <div class="header__list">
        <div class="header__logo">
            <a href="home.php">
                <img src="./style/images/xampu.png" alt="">
            </a>
        </div>

        <div class="header__user">
            <?php
                $nivel_necessario = 1;

                if (!isset($_SESSION["UsuarioID"])) {
                    echo "<a href='' class='item'>Login</a>";
                    echo "<a href='' class='item destaque'>Cadastrar-se</a>";
                }

                if (isset($_SESSION["UsuarioID"])) {
                    echo "<a href='actions/logout.php' class='sairButton'>Sair</a>";
                    echo "<a href='cadastroAgendamentos.php' class='item destaque outlined'>Cadastrar um horário</a>";

                    if ($_SESSION["UsuarioNivel"] > $nivel_necessario) {
                        echo "<a href='gerenciamento.php' class='item destaque outlined'>Gerenciamento</a>";
                    }
                    if ($_SESSION["UsuarioNivel"] == $nivel_necessario) {
                        echo "<a href='gerenciamento.php' class='item destaque outlined'>Ver usuários</a>";
                    }

                    echo "<a href='lista-agendamento.php' class='item destaque'>Lista de agendamentos</a>";
                }
            ?>
        </div>
    </div>
</nav>