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
                      Registro atualizado com sucesso!
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
                      Erro! Não atualizado.
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
    
   if(isset($_GET['acao'])=='logout'){
      @session_destroy();
   }
    $conn = new conecta();
   
if(isset($_POST['atualizar'])){
    $motorista= $_POST['motorista'];
    $cpf= $_POST['cpf'];
    $cnh= $_POST['cnh'];
    $valcnh= $_POST['valcnh'];
    $data= $_POST['data'];
    $cliente= $_POST['cliente'];
    $entradaPor= $_POST['entradaPor'];
    $entradaPatio= $_POST['entradaPatio'];
    $status= $_POST['status'];
    $obs= $_POST['obs'];
    $id= $_POST['id'];
    $placac= $_POST['placac'];
    $placacv= $_POST['placacv'];
    $grade= $_POST['grade'];
    $tam= $_POST['tam'];
    $comp=$_POST['comp'];
    $transp=$_POST['transp'];
    $mopp=$_POST['mopp'];
    $fone=$_POST['fone'];
    $op=$_POST['operacao'];
    $frete=$_POST['frete'];
    $catcnh=$_POST['catcnh'];
    $vendor=$_POST['vendor'];
    $tipocam=$_POST['tipocam'];
    $pedido=$_POST['pedido'];
    $epis= $_POST['epi'];
    $epi= implode(", ", $epis);
    $reg= array($motorista,$cpf,$cnh,$catcnh,$placac,$cliente,$data,$entradaPatio,
            $op,$status,$obs,$valcnh,$fone,$placacv,$transp,$mopp,$entradaPor,
            $tipocam,$grade,$comp,$tam,$id,$vendor,$epi,$frete,$pedido);
    
    if($conn->atualizaCam($reg)){
        echo '<script>$("#myModalAcesso").modal("show")</script>';
        echo "<script>$('#myModalAcesso').on('hidden.bs.modal', function (e) {
                            window.location='listagem.php'
               })</script>";
    }
    else{ 
        echo '<script>$("#myModalErro").modal("show")</script>';
        echo "<script>$('#myModalErro').on('hidden.bs.modal', function (e) {
                            window.location='listar.php?id=$id';
               })</script>";
        
    }
}