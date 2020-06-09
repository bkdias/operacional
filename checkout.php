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
      </head>
          <div class="modal fade" id="myModalAcesso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                      <h5 class="modal-title" id="myModalAcesso">Confirmação de Ação</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Checkout registrado com sucesso!
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
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
                    <div class="modal-body">
                      Erro! Checkout não realizado.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                  </div>
                </div>
      </div>
      <div class="modal fade" id="myModalAlerta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-sucess text-white">
                      <h5 class="modal-title" id="myModalAlerta">Confirmação de Ação</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Alerta de Desistencia enviado!
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>
      
      <body>
      </body>
  </html>
          
<?PHP
   include_once '_conexao.php';
   include_once 'funcoes.php';
   
   if(isset($_GET['acao'])=='logout'){
      @session_destroy();
   }
    $conn = new conecta();
    
    if(isset($_REQUEST['atualizar'])){
    $status= $_REQUEST['status'];
    $horasaida=$_REQUEST['horasaida'];
    $id= $_REQUEST['id'];
    $reg= array($status,$horasaida,$id);          
    
    
  if($status=='Concluido'){
    if($conn->checkoutCam($reg)){ 
      echo '<script>$("#myModalAcesso").modal("show")</script>';
      echo "<script>$('#myModalAcesso').on('hidden.bs.modal', function (e) {
                            window.location='acesso.php'
               })</script>";
    }
    else {
        echo '<script>$("#myModalErro").modal("show")</script>';
    }
  }
  else{
    if($status=='Desistencia'){
       if($conn->checkoutCam($reg)){
            echo '<script>$("#myModalAcesso").modal("show")</script>';
            if(EnviaAlerta($resp)){
                echo '<script>$("#myModalAlerta").modal("show")</script>';
                echo "<script>$('#myModalAlerta').on('hidden.bs.modal', function (e) {
                            window.location='acesso.php'
               })</script>";
            }
        }
    }
    else {
        echo '<script>$("#myModalErro").modal("show")</script>';
    } 
  }
 }
 
  