<!DOCTYPE html>
<?php
  //  include("verifica_sessao.php");
    include("funcoes.php");
    
#Verifica se o usuário tem permissão para ver a tela, senão volta a anterior        
   
?>

<html>
     <?php
        if(isset($_GET['acao'])=='logout')
            @session_destroy();
     ?>
    <head>
        <link href="css/estilo.css" rel="stylesheet">
        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
        <title>Logistica</title>
        
    </head>
    
    <body class="style">
          
        <div class="div1">
           <img class="vertical-align" src="image/yara.png"/>&nbsp; 
           LOGÍSTICA <br><br>
        </div>
        <div class="p1">
           <div class="back"> <p align="left"><a href="index.php"><img src="image/home.png" title="Página Inicial" alter="Home"/>Home</a></p></div>
           <p align= "right" style="margin-right: 20px;" >
              <?php echo 'Usuário logado: '.$_SESSION['login'].' / '?>
              <a href="login.php?acao=logout">Sair</a>
           </p><br>
           <center><strong><p>OPERAÇÕES LOGÍSTICAS</p></strong></center>
           <div class="conteudo">
             <a href="logcad.php"><img src="image/transp.png" alt="Cadastro"></a>
           &nbsp;&nbsp;&nbsp;&nbsp;
           <p><strong>Cadastrar Transportadora</strong></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <a href="logbusca.php"><img src="image/consultar.png" alt="Consulta"></a>
           &nbsp;&nbsp;&nbsp;&nbsp;
           <p><strong>Consultar</strong></p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <a href="motorista.php"><img src="image/buscamoto.png" alt="Situacao"></a>
           &nbsp;&nbsp;&nbsp;&nbsp;
           <p><strong>Bloquear/Liberar Motorista</strong></p>
         </div> 
        </div>
        <div class="footer" >
            EQUIPE DE TI - 2019                
        </div>
        <?php
        // put your code here
        ?>
        
    </body>
</html>
