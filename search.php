 <?php
    include_once '_conexao.php';
   include_once 'funcoes.php';
   if(isset($_GET['acao'])=='logout'){
      @session_destroy();
   }
    $conn = new conecta();
    $conn->verifica_sessao();
    $login= $_SESSION['login'];
    $tela=1;
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
    <title>Atendimento ao Cliente</title>
        
<!--formatação dos inputs------------------------------------------------------------>
    <script type="text/javascript">
      $().ready(function(){
        $("#opcao").change(function(){ //Quando houver uma mudança no select
        var opt = $("#opcao option:selected").val(); //Recupera o valor do option selecionado
        var mask = "";
        if(opt == 1){
            mask = "99.999.999/9999-99";
        }else if(opt == 2){
            mask = "999.999.999-99";
        }
        $("input[name=consultar]").mask(mask);
        if (opt == 3){
           $("input[name=consultar]").unmask(mask); //desaplica a máscara
        }
       
        });
      });
            
        </script>
<!------------------------------------------------------------------------------------>
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
                      Usuário sem permissão para acessar este módulo!
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>
         
      <div class="div1">
        <img class="vertical-align img-fluid" src="image/yara.png"/>   
        <h5>ATENDIMENTO AO CLIENTE</h5> <br>
      </div>
      <div class="p1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Página Inicial</a></li>
              <li class="breadcrumb-item"><a href="atend.php">Atendimento</a></li>
              <li class="breadcrumb-item active" aria-current="page">Consultar</li>
              <li class="breadcrumb-item"><a href="login.php?acao=logout">Sair</a></li>
            </ol>
        </nav>
        <div class="container">
            <center><h5>Consultar Cliente</h5><br><br>
                <form name="buscar" action="consulta.php" method="POST" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="form-group col-md-3">
                       <label>Buscar cliente por:</label>
                    </div>
                    <div class="form-group col-md-2">
                       <select name="opcao" id="opcao"required class="custom-select">
                         <option value="0" selected>Selecione</option>
                         <option value="1">CNPJ</option>
                         <option value="2">CPF</option>
                         <option value="3">NOME</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" name="consultar" id="consultar" required placeholder="palavra-chave" class="form-control"/>
                    </div>
                    <div class="form-group col-md-2">
                       <input type="submit" name="search" value="BUSCAR" class="btn btn-primary" />
                    </div>
                    <div class="form-group col-md-1"></div>
                  </div>
                </form>
           </center>      
        </div>
       </div>
        <div class="footer" >
            <img class="img-fluid" src="image/copyright.png"/>
            POWERED BY REBECA SANTANA - 2020               
        </div>
    </body>
   
    
</html>