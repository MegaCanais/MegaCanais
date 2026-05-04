<?php
ini_set('display_errors', 0);
include(__DIR__ . '/functions.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$log_check = $db->select('user', '*', 'id = :id', '', [':id' => 1]);
$loggedinuser = !empty($log_check) ? $log_check[0]['username'] : null;

if (!isset($_SESSION['name']) == $loggedinuser) {
    header("location:"."index.php");
    exit();
}

if (isset($_REQUEST['logout'])) {
    session_destroy();
    setcookie("auth", "");
    header("Location: index.php");
    exit;
}

$time = $_SERVER['REQUEST_TIME'];

$timeout_duration = 900;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['LAST_ACTIVITY'] = $time;

function sanitize($data) {
    $data = trim($data);
    $data = htmlspecialchars($data, ENT_QUOTES );
    $data = SQLite3::escapeString($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <title>Painel Midia Digital IBO 17 TEMAS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="RTX">
    <link rel="icon" type="image/x-icon" href="./img/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="./img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./img/favicon-16x16.png">
    <link rel="manifest" href="./img/site.webmanifest">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/themes/darkly/bootstrap.css" rel="stylesheet" title="main">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src='./js/jquery.particleground.js'></script>
    <script src='./js/demo.js'></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
    $(function() {
        $("#datepicker").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
    </script>
</head>
<div id="net-canvas"></div>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Barra Lateral-->
        <div class="" id="sidebar-wrapper">
            <div class="sidebar-heading">
                <div class="sidebar-logo">
                    <img src="./img/login_logo.png" alt="logo">
                </div>
            </div>
            <span><a class="list-group-item" href=" <?php echo $config_ini['contact']; ?>"
                    target="_blank"><?php echo $config_ini['panel_name']; ?></a> </span>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action " href="main.php">
                    <i class="fa fa-cogs"></i>&nbsp;&nbsp; Configurações de DNS </a>
                
                <a class="list-group-item list-group-item-action " href="mac_users.php">
                    <i class="fa fa-code"></i>&nbsp;&nbsp; Usuários MAC </a>

                <a class="list-group-item list-group-item-action " href="activation_code.php">
                    <i class="fa fa-key"></i>&nbsp;&nbsp; Código de Ativação </a>

                <a class="list-group-item list-group-item-action " href="setup_trial.php">
                    <i class="fa fa-calendar"></i>&nbsp;&nbsp; Definir Expiração </a> 

                <a class="list-group-item list-group-item-action " href="demo.php">
                    <i class="fa fa-asterisk"></i>&nbsp;&nbsp; Definir Demonstração </a>    
                    
                <a class="list-group-item list-group-item-action " href="note.php">
                    <i class="fa fa-commenting-o"></i>&nbsp;&nbsp; Definir Notificação </a>  

                <a class="list-group-item list-group-item-action " href="mac_lenth.php">
                    <i class="fa fa-sort-numeric-desc"></i>&nbsp;&nbsp; Definir Comprimento MAC </a>     

                <a class="list-group-item list-group-item-action " href="themes.php">
                    <i class="fa fa-themeisle"></i>&nbsp;&nbsp; Temas do Aplicativo </a>   
                    
                <div class="dropdown">
                  <a class="list-group-item list-group-item-action dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-university"></i>&nbsp;&nbsp; Página de Login</a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  			
                  					
                  			<a class="list-group-item list-group-item-action " href="themes_login.php">
                    		<i class="fa fa-university"></i>&nbsp;&nbsp; Tema da Página de Login </a>    
                    
                			<a class="list-group-item list-group-item-action " href="login_text.php">
                   			<i class="fa fa-university"></i>&nbsp;&nbsp; Texto da Página de Login </a>  
                 		</div>
    			</div>         
                    
                <div class="dropdown">
                  <a class="list-group-item list-group-item-action dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-binoculars"></i>&nbsp;&nbsp; Configurações de Anúncios</a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  			
                  					
                  			<a class="list-group-item list-group-item-action " href="ads_settings.php">
                    		<i class="fa fa-binoculars"></i>&nbsp;&nbsp; Tipo de Anúncios </a>    
                    
                			<a class="list-group-item list-group-item-action " href="auto_layout.php">
                   			<i class="fa fa-superpowers"></i>&nbsp;&nbsp; Layout Automático de Anúncios </a>  
                            
                            <a class="list-group-item list-group-item-action " href="frame_layout.php">
                   			<i class="fa fa-object-ungroup"></i>&nbsp;&nbsp; Layout de Anúncios em Frames </a>  
                    
                			<a class="list-group-item list-group-item-action " href="menads.php">
                    		<i class="fa fa-magic"></i>&nbsp;&nbsp; Anúncios Manuais </a>  
                 		</div>
    			</div>      
                    
                <div class="dropdown">
                  <a class="list-group-item list-group-item-action dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-futbol-o"></i>&nbsp;&nbsp; Esportes</a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  			
                  					
                  
            				<a class="list-group-item list-group-item-action " href="leagues.php">
                    		<i class="fa fa-futbol-o"></i>&nbsp;&nbsp; ID da Liga </a>
                            
                            <a class="list-group-item list-group-item-action " href="leagues_table.php">
                    		<i class="fa fa-futbol-o"></i>&nbsp;&nbsp; ID do Widget da Liga </a>
                            
                            <a class="list-group-item list-group-item-action " href="sports.php">
                    		<i class="fa fa-futbol-o"></i>&nbsp;&nbsp; Esporte </a>
                 		</div>
    			</div>     
                    
                <a class="list-group-item list-group-item-action " href="tmdb_api.php">
                    <i class="fa fa-imdb"></i>&nbsp;&nbsp; API TMDB </a>   
                    
                <a class="list-group-item list-group-item-action " href="update.php">
                    <i class="fa fa-upload"></i>&nbsp;&nbsp; Atualização Remota </a>      
                    
                <div class="dropdown">
                  <a class="list-group-item list-group-item-action dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-cog"></i>&nbsp;&nbsp; Configuração</a>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  			
                  				
                  					
                  
            				<a class="list-group-item list-group-item-action " href="user.php">  
                    			<i class="fa fa-user"></i>&nbsp;&nbsp; Atualizar credenciais </a>
                 		</div>
    			</div>     
                    
            </div>
        </div>
        <!-- /#sidebar-wrapper -->
        <!-- Conteúdo da Página -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-dark ctnav">
                <button class="btn btn-primary" id="menu-toggle"><i class="fa fa-bars"></i></button>
                <div class="center" id="pageMessages"></div>
                <a href="<?=basename($_SERVER["SCRIPT_NAME"]).'?logout'?>" class="btn btn-danger ml-auto mr-1"><i
                        class="fa fa-sign-out"></i> Sair</a>
            </nav>
            <div class="container-fluid">
                <br>
                <style>
                body {
                    background-color: #181828;
                    background-image: url("./img/binding_dark.webp");
                    color #fff;
                }

                #particles-js {
                    background-size: cover;
                    background-position: 50% 50%;
                    background-repeat: no-repeat;
                    /*width: 100%; height: 100vh;*/
                    background: #8000FF;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }

                .particles-js-canvas-el {
                    position: fixed;
                }

                #pageMessages {
                    left: 50%;
                    transform: translateX(-50%);
                    position: fixed;
                    text-align: center;
                    top: 5px;
                    width: 60%;
                    z-index: 9999;
                    border-radius: 0px
                }

                .alert {
                    position: relative;
                }

                .alert .close {
                    position: absolute;
                    top: 5px;
                    right: 5px;
                    font-size: 1em;
                }

                .alert .fa {
                    margin-right: .3em;
                }
                </style>
<script src="./js/custom.js"></script>
<script src="./js/three.min.js"></script>
<script src="./js/vanta.net.min.js"></script>
