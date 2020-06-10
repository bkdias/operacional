<?PHP
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
    date_default_timezone_set('America/Sao_Paulo');
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
<!--formatação dos inputs------------------------------------------------------------>
    <script>  
        $(document).ready(function() {
          $('#inputOculto').hide();
          $('#inputOculto2').hide();
          //$('#inputConsultar').hide();
          $('#opcao').change(function() {
            if($('#opcao').val() == 'cpf'){
                $("#cpf").mask("'000.000.000-00'");
                $(document).on('keydown', '[data-mask-for-cpf-cnpj]', function (e) {
                        var digit = e.key.replace(/\D/g, '');
                        var value = $(this).val().replace(/\D/g, '');
                        var size = value.concat(digit).length;
                        $(this).mask((size <= 11) ? '000.000.000-00' : '00.000.000/0000-00');
                });
            }
            if ($('#opcao').val() == 'status') {
                  $('#inputConsultar').hide();
                  $('#inputOculto2').show();
                  $('#inputOculto').hide();
            } else {
                if ($('#opcao').val() == 'periodo') {
                  $('#inputConsultar').hide();
                  $('#inputOculto2').hide();
                  $('#inputOculto').show();
              }
              else{
              $('#inputOculto').hide();
              $('#inputOculto2').hide();
              $('#inputConsultar').show();
            }
          }
        })
        });
    </script>
    <title>Gerenciamento de Acesso</title>
  </head>
    <body class="style">
      <div class="div1">
        <img class="vertical-align" src="image/yara.png"/>  
        CONTROLE DE ACESSO CAMINHOES<br><br>
      </div>
      <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Página Inicial</a></li>
              <li class="breadcrumb-item"><a href="acesso.php">Controle de Acesso</a></li>
              <li class="breadcrumb-item active" aria-current="page">Consulta</li>
              <li class="breadcrumb-item"><a href="login.php?acao=logout">Sair</a></li>
            </ol>
      </nav>
       <div class="container">
           <center><h5>Registros de Entrada e Saída - Caminhões</h5><br><br><br>
           <form name="consultar" action="listar.php" method="POST" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Buscar por:</label>
                </div>
                <div class="form-group col-md-2">
                    <select name="opcao" id="opcao" required class="custom-select">
                      <option selected> </option>
                      <option value="cpf">CPF</option>
                      <option value="periodo">PERIODO</option>
                      <option value="status">STATUS</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <div id="inputConsultar">
                        <input type="text" name="consultar" id="consultar" size="11" maxlength="11" placeholder="palavra-chave" class="form-control" data-mask-for-cpf-cnpj>
                    </div>
                    <div id="inputOculto">
                        <input type="date" name="dataI" class="form-control"> à <input type="date" name="dataF" class="form-control"/>
                    </div>
                    <div id="inputOculto2">
                       <select name="status" id="status" class="custom-select">
                            <option selected> </option>
                            <option value="Aguardando">AGUARDANDO</option>
                            <option value="Desistencia">DESISTENCIA</option>
                            <option value="Concluido">CONCLUÍDO</option>
                        </select>
                      </div>
                </div>
                <div class="form-group col-md-2">
                   <input type="submit" name="search" value="BUSCAR" class="btn btn-primary"/>
                </div>
                <div class="form-group col-md-1"></div>
             </div>
           </form>
            </center>
        </div>
        <div class="footer" >
            <img class="img-fluid" src="image/copyright.png"/>
            POWERED BY REBECA SANTANA - 2020               
        </div>
    </body>
</html>