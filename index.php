<!DOCTYPE html>
<?php
    include_once '_conexao.php';
    $conn = new conecta();
    $conn->verifica_sessao();
    if(isset($_GET['acao'])=='logout')
      @session_destroy();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/estilo.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <title>Gerenciamento Operacional</title>
    </head>
    <body class="style">
        <div class="div1">
           <img class="vertical-align" class="img-fluid" src="image/yara.png"/>   
           <h5>GERENCIAMENTO OPERACIONAL - YARA CANDEIAS</h5><br>
        </div>
        <div class="p1">
           <p align= "right" style="margin-right: 20px;" >
              <?php echo 'Usuário logado: '.$_SESSION['login'].' / '?>
           <a href="login.php?acao=logout">Sair</a>
           </p>
           <div class="cont1"><a href="atend.php"><img src="image/atend.png" class="img-fluid" alt="index"> Atendimento ao Cliente</a> </div>
           <div class="cont2"><a href="acesso.php"><img src="image/access.png" class="img-fluid" alt="acesso"> Controle de Acesso</a></div>
           <div class="cont3"><a href="logistica.php"><img src="image/logistica.png" class="img-fluid" alt="logistica"> Logística</a></div>
        </div>
        <div class="footer" >
            <img class="img-fluid" src="image/copyright.png"/>
            POWERED BY REBECA SANTANA - 2020
                            
        </div>
    </body>
</html>
