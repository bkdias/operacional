<!DOCTYPE html>
<?php
   include_once '_conexao.php';
   if(isset($_GET['acao'])=='logout'){
      @session_destroy();
   }
    $conn = new conecta();
    $conn->verifica_sessao();
    $login= $_SESSION['login'];
    $tela=2;
    $permissao = $conn->verificaPermissao($login, $tela);
    if(!$permissao){
       echo '<script>$("#myModalPermissao").modal("show")</script>';
       echo "<script>$('#myModalPermissao').on('hidden.bs.modal', function (e) {
                        window.location='index.php';
        })</script>";
     }
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
        <title>Marcação</title>
    </head>
    <div class="modal fade" id="myModalPermissao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                      <h5 class="modal-title" id="myModalPermissao">Restrição de Acesso</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Usuário sem permissão para acessar este módulo!
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>
    <body class="style">
      <div class="div1">
          <img class="vertical-align" class="img-fluid" src="image/yara.png"/>   
            <h5>CONTROLE DE ACESSO CAMINHÕES</h5><br>   
      </div>
      <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Página Inicial</a></li>
              <li class="breadcrumb-item active" aria-current="page">Controle de Acesso</li>
              <li class="breadcrumb-item"><a href="login.php?acao=logout">Sair</a></li>
            </ol>
      </nav>
      <div class="container">
        <center><h5>MARCAÇÃO - PORTARIA I</h5></center>
        <div class="cont1"><a href="cadaccess.php"><img src="image/in.png" class="img-fluid" alt="acesso"> Entrada</a></div>
        <div class="cont2"><a href="consultaccess.php"><img src="image/out.png" class="img-fluid" alt="acesso"> Saída</a></div>
        <div class="cont3"><a href="listagem.php"><img src="image/consultar.png" class="img-fluid" alt="acesso"> Consultar/Alterar</a></div>
      </div>
      <div class="footer" >
            <img class="img-fluid" src="image/copyright.png"/>
            POWERED BY REBECA SANTANA - 2020                
      </div>  
    </body>
</html>
