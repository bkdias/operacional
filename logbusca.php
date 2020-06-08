<?PHP
  include("verifica_sessao.php");
  if(isset($_GET['acao'])=='logout')
     @session_destroy();
?>     
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
        <link href="css/estilo.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
     <title>Logistica</title>
    </head>
    <body class="style">
      <div class="div1">
        <img class="vertical-align" src="image/yara.png"/>   
         LOGÍSTICA <br><br>
      </div>
        <br>
       <div class="p1">
           <div class="back"> <p align="left"><a href="logistica.php"><img src="image/voltar.png" title="Voltar"/></a></p></div>
            <p align= "right" style="margin-right: 20px;">
                <?php echo 'Usuário logado: '.$_SESSION['login'].' / '?>
                <a href="login.php?acao=logout">Sair</a><br><br>
            </p>
          <div class="conteudo1">
             <center><strong><p>Consultar Transportadora</p></strong><br><br><br>
                 <form name="buscar" action="logresultbusca.php" method="POST" enctype="multipart/form-data">
               Buscar por:  <select name="opcao" id="opcao" required class="input_buton">
                                <option value="0" selected> </option>
                                <option value="1">NOME</option>
                                <option value="2">VENDOR</option>
                            </select> &nbsp; &nbsp;
              <input type="text" name="consultar" id="consultar" class="input_buton"><br><br><br><br><br>
              <input type="submit" name="search" value="BUSCAR" class="botaosubmit"/>
                 </form>
             </center>      
           </div>
       </div>
        <div class="footer" >
              EQUIPE DE TI - 2019                
        </div>
    </body>
</html>