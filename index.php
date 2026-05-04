<?php
include('includes/functions.php');
$nome_da_tabela = "user";

$verificacao_log = $db->select($nome_da_tabela, '*', 'id = :id', '', [':id' => 1]);
$usuario_logado = !empty($verificacao_log) ? $verificacao_log[0]['username'] : null;

if (!empty($usuario_logado) && isset($_SESSION['name']) && $_SESSION['name'] === $usuario_logado) {
    header("Location: main.php");
    exit;
}

$dados = ['id' => '1','username' => 'admin','password' => 'admin',];
$db->insertIfEmpty($nome_da_tabela, $dados);

if (isset($_POST["login"])){
    $nome_usuario = $_POST["username"];
    $dados_usuario = $db->select($nome_da_tabela, '*', 'username = :username', '', [':username' => $nome_usuario]);
    if ($dados_usuario) {
        $senha_armazenada = $dados_usuario[0]['password'];
        $senha_digitada = $_POST["password"];
        if ($senha_digitada == $senha_armazenada) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            if ($_POST['username'] == 'admin'){
                header('Location: user.php');
            }else{
                header('Location: main.php');
            }
        }else{
            header('Location: ./api/index.php');
        }
    }else{
        header('Location: ./api/index.php');
    }
    $db->close();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="RTX Rebrand">
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="./img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon-16x16.png">
    <link rel="manifest" href="./img/site.webmanifest">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/css.css">
    <title>Painel 17 temas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: url('img/fundo.jpg') no-repeat center center fixed;
            background-size: cover;
            flex-direction: column;
        }

        .form {
            position: relative;
            width: 380px;
            padding: 1px 40px 10px;
            background: rgba(19, 20, 25, 0.7); /* Cor de fundo com transparência */
            border-radius: 10px;
            text-align: center;
            box-shadow: -5px -5px 10px rgba(255, 255, 255, 0.05),
                5px 5px 15px rgba(0,0,0,0.5);
        }

        .form h2 {
            color: #c7c7c7;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 4px;
        }

        .form .input {
            text-align: left;
            margin-top: 5px;
        }

        .form .input .inputBox {
            margin-top: 5px;
        }

        .form .input .inputBox label {
            display: block;
            color: #868686;
            margin-bottom: 1px;
            font-size: 15px;
        }

        .form .input .inputBox input {
            width: 100%;
            height: 40px;
            background: #131419;
            border: none;
            outline: none;
            border-radius: 30px;
            padding: 5px 15px;
            color: #fff;
            font-size: 18px;
            color: #03a9f4;
            box-shadow: inset -2px -2px 6px rgba(255, 255, 255, 0.1),
                inset 2px 2px 6px rgba(0,0,0,0.8);
        }

        .form .input .inputBox input[type="submit"] {
            margin-top: 20px;
            box-shadow: -2px -2px 6px rgba(255, 255, 255, 0.1),
                2px 2px 6px rgba(0,0,0,0.8);
        }

        .form .input .inputBox input[type="submit"]:active {
            color: #006c9c;
            margin-top: 20px;
            box-shadow: inset -2px -2px 6px rgba(255, 255, 255, 0.1),
            inset 2px 2px 6px rgba(0,0,0,0.8);
        }

        .form .input .inputBox input::placeholder {
            color: #555;
            font-size: 18px;
        }

        .esqueci {
            margin-top: 30px;
            color: #555;
        }

        .esqueci a {
            color: #ff0047;
        }

        /* Estilo para o relógio */
        .relogio {
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            margin-top: 10px; /* Ajustado para ficar abaixo do título */
            padding: 15px;
            border-radius: 15px;
            background: linear-gradient(45deg, #03a9f4, #00bcd4, #8bc34a); /* Degradê de fundo */
            background-size: 200% 200%;
            animation: gradientAnimation 3s ease infinite; /* Animação de transição suave para o degradê */
            display: inline-block;
            text-shadow: 0 4px 6px rgba(0, 0, 0, 0.5); /* Sombras para o texto */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Sombra mais intensa ao redor do relógio */
            transition: all 0.3s ease; /* Transições suaves ao interagir */
        }

        /* Animação de fundo degradê */
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Estilo para o texto do relógio */
        .relogio #clock {
            font-size: 15px;
            letter-spacing: 5px;
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }

        .logo {
            display: block;
            margin: 0 auto 0px;
            max-width: 150px; /* Ajuste o tamanho da logo conforme necessário */
        }

        .inputBox img {
            display: block;
            margin: 20px auto 0;
            width: 200px; /* Ajuste o tamanho da imagem conforme necessário */
            height: auto;
        }

        /* Rodapé fixo */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #131419;
            color: #fff;
            text-align: center;
            padding: 0px;
            z-index: 10; /* Menor z-index para o rodapé */
        }

        /* Botão do WhatsApp flutuante */
        .whatsapp-btn {
            position: fixed;
            bottom: 80px; /* Aumentado o valor para dar espaço entre o rodapé e o botão */
            right: 20px;
            background-color: #25d366;
            border-radius: 50%;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            z-index: 100; /* Garantir que o botão do WhatsApp fique acima do rodapé */
        }

        .whatsapp-btn img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>

<div class="form">
    <!-- Logo acima do título -->
    <img src="img/logovs.png" alt="Logo" class="logo">

    
    
    <!-- Relógio abaixo do título -->
    <div class="relogio">
        <div id="clock">00:00:00</div>
    </div>

    <form method="post">
        <div class="input">
            <div class="inputBox">
                <label>Usuário</label>
                <input type="text" name="username" placeholder="Nome de usuário"/>
            </div>
            <div class="inputBox">
                <label>Senha</label>
                <input type="password" name="password" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;"/>
            </div>
            <div class="inputBox">
                <input type="submit" name="login" value="ENTRAR"/>
            </div>

            <!-- Adicionando o botão de imagem com link abaixo do botão ENTRAR -->
            <div class="inputBox">
                <a href="seuapkaqui/Ibo-Pro-Player_3.9.apk">
                    <img src="img/botao.png" alt="Texto alternativo"/>
                </a>
            </div>
        </div>
    </form>
    <p class="esqueci"><a href="https://globallweb.com.br">GLOBAL WEB</a></p>

</div>

<!-- Rodapé -->
<footer>
    <p>&copy; 2025 Todos os direitos reservados. | <a href="https://globallweb.com.br" target="_blank" style="color: #ff0047; text-decoration: none;">Visite nosso site</a></p>
</footer>

<!-- Botão do WhatsApp -->
<a href="https://wa.me/5527981173992" class="whatsapp-btn" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
</a>

<script>
    // Função para atualizar o relógio
    function atualizarRelogio() {
        var agora = new Date();
        var horas = String(agora.getHours()).padStart(2, '0');
        var minutos = String(agora.getMinutes()).padStart(2, '0');
        var segundos = String(agora.getSeconds()).padStart(2, '0');
        
        var horaFormatada = horas + ':' + minutos + ':' + segundos;
        document.getElementById('clock').textContent = horaFormatada;
    }

    // Atualiza o relógio a cada segundo
    setInterval(atualizarRelogio, 1000);
    atualizarRelogio();  // Inicializa imediatamente
</script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

</body>
</html>
