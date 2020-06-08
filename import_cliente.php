<?php
include_once '_conexao.php';
$conn = new conecta();
$conn->verifica_sessao();
if(isset($_GET['acao'])=='logout'){
@session_destroy();
}
$modulo="1";
$login = $_SESSION['login'];
?>
<!DOCTYPE html>
<html>
    <head>
       <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/estilo.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <script>
          $(document).ready(function() {
                $('#AlertFileOculto').hide();
          });
        </script>
        <title>Atendimento ao Cliente</title>
    </head>
    <body class="style">
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
                  Você não tem permissão para acessar este módulo!
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
              </div>
            </div>
        </div>
       <?php 
        $permissao = $conn->verificaPermissao($login, $modulo);
        if(!$permissao){
           echo '<script>$("#myModalPermissao").modal("show")</script>';
           echo "<script>$('#myModalPermissao').on('hidden.bs.modal', function (e) {
                            window.location='index.php';
            })</script>";
         }?> 
       <div class="div1">
        <img class="vertical-align" class="img-fluid" src="image/yara.png"/>   
        <h5>ATENDIMENTO AO CLIENTE</h5><br>
      </div>
       <div class="p1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="atend.php">Atendimento</a></li>
                  <li class="breadcrumb-item"><a href="cadastro.php">Cadastro</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Importar</li>
                  <li class="breadcrumb-item"><a href="login.php?acao=logout">Sair</a></li>
                </ol>
            </nav>
       </div>
       <div class="container">
           <h5> <center>Importar Cliente de arquivo XML</h5><br><br>
         <center>
             <div id="AlertFileOculto" class="form-group col-md-6">
                <div class="alert-danger"role="alert">
                  Tipo de Aquivo Inválido
                </div>
            </div>
             <div class="form-group col-md-6">
               <form name="processa" action="processacliente.php" method="POST" enctype="multipart/form-data">
                  <div class="custom-file mb-3">
                      <input type="file" class="custom-file-input" id="arquivo" name="arquivo" required>
                    <label class="custom-file-label" for="arquivo">Escolha o arquivo XML</label>
                  </div>
                  <div class="mt-3">
                      <button name="enviar" id="enviar" type="submit" class="btn btn-primary">Enviar</button>
                  </div>
               </form>
             </div>
         </center>
       </div>  
        <div class="footer" >
            <img class="img-fluid" src="image/copyright.png"/>
            POWERED BY REBECA SANTANA - 2020               
        </div>
        <script>
            // Add the following code if you want the name of the file appear on select
            $(".custom-file-input").on("change", function() {
              var fileName = $(this).val().split("\\").pop();
              $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
              var Extensao= fileName.substring(fileName.lastIndexOf('.') + 1);
              if(Extensao!=='xml'){
                  $('#AlertFileOculto').show();
                  document.getElementById("enviar").disabled = true;
              }
              else{
                  $('#AlertFileOculto').hide();
                  document.getElementById("enviar").disabled = false;
              }
            });
        </script>
    </body>
</html> 

