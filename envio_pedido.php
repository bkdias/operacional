 <?php
include_once '_conexao.php';
$conn = new conecta();
$conn->verifica_sessao();
if(isset($_GET['acao'])=='logout'){
    @session_destroy();
}
 $tela="1";
    $login = $_SESSION['login'];
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
        <title>Gerenciamento de Caminhões</title>
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
        <div class="div1">
        <img class="vertical-align img-fluid" src="image/yara.png"/>   
        <h5>ATENDIMENTO AO CLIENTE</h5> <br>
      </div>
      <div class="p1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Página Inicial</a></li>
              <li class="breadcrumb-item"><a href="atend.php">Atendimento</a></li>
              <li class="breadcrumb-item active" aria-current="page">Status de Envio</li>
              <li class="breadcrumb-item"><a href="login.php?acao=logout">Sair</a></li>
            </ol>
        </nav>
         <div class="container">
             <a href="import_data.php"><img src="image/import.png" title="Importar de Arquivo" alt="Importar de Arquivo"/> Importar</a>
             <center><h5>Envio(s) de Email Pendente(s) - Resumo do Pedido</h5></center><br>
                
              <?php 
                echo '<div class="table-responsive-sm"><table class="table table-hover">
                      <thead>
                       <tr>
                     <th scope="col">NF</th>
                     <th scope="col">Data</th>
                     <th scope="col">Cliente</th>
                     <th scope="col">Material</th>
                     <th scope="col">Qtd</th>
                     <th scope="col">Pedido</th>
                     <th scope="col">Destino</th>
                     <th scope="col">Frete</th>
                     <th scope="col"><center>Status</center></th>
                     </tr>
                     </thead><tbody>';
                $conn->listarPedido();
                echo "</tbody></table>";
             ?>
        </div>
        </div>
        <div class="footer" >
              EQUIPE DE TI - 2019                
        </div>
    </body>
</html>