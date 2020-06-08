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
    <script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
</head>
<body>
    <div class="modal fade" id="myModalExclusao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="myModalExclusao">Confirmação de Ação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        REGISTRO EXCLUÍDO COM SUCESSO!!
      </div>
      <div class="modal-footer">
        <button type="button" id="modal-btn-sim" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>
 <div class="modal fade" id="myModalErro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="myModalErro">Confirmação de Ação</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body alert-danger">
        "ERRO - AÇÃO NÃO REALIZADA!!!"
      </div>
      <div class="modal-footer">
        <button type="button" id="modal-btn-sim" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>

<?php
include_once '_conexao.php';
$conn = new conecta();
$id = ($_GET['id']);
$campo = ($_GET['campo']);
$registros = $_GET['qtd'];
if($conn->deleteCliente($id)){
    echo '<script>$("#myModalExclusao").modal("show")</script>';
    if($registros>1){
        echo '<script>$("#myModalExclusao").on("hidden.bs.modal", function (e) {
                window.location="consulta.php?campo='.$campo.'";
        })</script>';
    }
    else{
        echo '<script>$("#myModalExclusao").on("hidden.bs.modal", function (e) {
                window.location="search.php?";
        })</script>';
    }
}
else{
    echo '<script>$("#myModalErro").modal("show")</script>';
      echo '<script>$("#myModalErro").on("hidden.bs.modal", function (e) {
              window.location="consulta.php?campo='.$campo.'";
          })</script>';
}

?>

</body>
</html>