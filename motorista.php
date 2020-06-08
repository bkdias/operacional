<?PHP
  include("verifica_sessao.php");
  include("funcoes.php");
  if(isset($_GET['acao'])=='logout')
     @session_destroy();
?>     
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
        <link href="css/estilo.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
     <title>Logística</title>
    </head>
    <body class="style">
      <div class="div1">
        <img class="vertical-align" src="image/yara.png"/>   
         LOGÍSTICA <br><br>
      </div>
       <div class="p1">
           <div class="back"> <p align="left"><a href="logistica.php"><img src="image/voltar.png" title="Voltar"/></a></p></div>
           <p align= "right" style="margin-right: 20px;" >
           <?php echo 'Usuário logado: '.$_SESSION['login'].' / '?>
           <a href="login.php?acao=logout">Sair</a>
           </p><br><br>
          <div class="conteudo3">
              <a href="motoristablock.php"><img src="image/block.png" alt="index"></a>&nbsp;
             <strong>Bloquear/Liberar Motorista</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <a href="motoristaconsultar.php"><img src="image/consultar.png" alt="acesso"></a>
             &nbsp;&nbsp;
             <strong>Consultar</strong>
        </div>
        </div>
        <div class="footer" >
              EQUIPE DE TI - 2019                
        </div>
    </body>
</html>