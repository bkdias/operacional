<?PHP
  include("verifica_sessao.php");
  include("funcoes.php");
  if(isset($_GET['acao'])=='logout')
     @session_destroy();
  
  if (isset($_REQUEST['editar'])){
      $id=$_REQUEST['id'];
      $nome= $_REQUEST['nome'];
      $codvendor= $_REQUEST['codvendor'];
  }
?>  
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/estilo.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
     <title>Logistica</title>
    </head>
    <body class="style">
      <div class="div1">
        <img class="vertical-align" src="image/yara.png"/>   
         LOGÍSTICA 
      </div>
        <br>
        <div class="p1">
            <div class="back"> <p align="left"><a href="logbusca.php"><img src="image/voltar.png" title="Voltar"/></a></p></div>
            <p align= "right" style="margin-right: 20px;">
                <?php echo 'Usuário logado: '.$_SESSION['login'].' / '?>
                <a href="login.php?acao=logout">Sair</a><br><br>
            </p>
            <br>
           <div class="conteudo1">
             <center><strong><p>Alteração de Cadastro</p></strong><br><br><br>
                 <form name="cadastro" action="logatualizacad.php" method="post" enctype="multipart/form-data">
                Nome: <input type="text" name="nome" id="nome" value="<?php echo $nome?>" required size="50" class="input_buton"/>&nbsp;&nbsp;
                Código Vendor: <input type="text" name="codvendor" id="codvendor" value="<?php echo $codvendor?>" required class="input_buton">
                <input type="hidden" name="id" value="<?php echo $id?>"><br><br><br><br><br><br><br>
                <input type="submit" name="alterar" value="Alterar" class="botaosubmit"/>&nbsp;&nbsp;
                <input type="reset" name="reset" value="Limpar" class="botaosubmit"/>&nbsp;&nbsp;
             </form>
             </center>
           </div>
        <div class="footer" >
              EQUIPE DE TI - 2019                
        </div>
    </body>
</html>
