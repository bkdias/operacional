<?PHP
  include("verifica_sessao.php");
  include("funcoes.php");
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
     <title>Logística</title>
    </head>
    <body class="style">
      <div class="div1">
        <img class="vertical-align" src="image/yara.png"/>   
         LOGÍSTICA <br><br>
      </div>
       <div class="p1">
           <div class="back"> <p align="left"><a href="logistica.php"><img src="image/voltar.png" title="Voltar"/></a></p></div>
            <p align= "right" style="margin-right: 20px;">
                <?php echo 'Usuário logado: '.$_SESSION['login'].' / '?>
                <a href="login.php?acao=logout">Sair</a><br><br>
            </p>
            <br>
           <div class="conteudo1">
             <center><strong><p>Cadastro de Transportadora</p></strong><br><br><br><br>
               <form name="cadastro" method="post" enctype="multipart/form-data">
                 Nome: <input type="text" name="nome" id="nome" size="50" required class="input_buton"/>&nbsp;&nbsp;
                 Código Vendor: <input type="text" name="codvendor" id="codvendor" required class="input_buton">&nbsp;&nbsp;
                 <br><br><br><br><br><br><br>
                 <center>
                    <input type="submit" name="cadastrar" value="Cadastrar" class="botaosubmit"/>&nbsp;&nbsp;
                    <input type="reset" name="reset" value="Limpar" class="botaosubmit"/>&nbsp;&nbsp;
                 </center>
             </form>
           </div>
        </div>
        <div class="footer" >
              EQUIPE DE TI - 2019                
        </div>
    </body>
</html>
 <?php
     if(isset($_REQUEST['cadastrar'])){
           $nome= $_REQUEST['nome'];
           $vendor= $_REQUEST['codvendor'];
           $cliente = array($nome,$vendor);
           if(insereTransp($cliente, $conexao)){
               echo '<script>alert("Transportadora cadastrada com sucesso!!")</script>';
           }else{
               echo '<script>alert("ERRO!!! Transportadora já cadastrada!")</script>';
           }
     }