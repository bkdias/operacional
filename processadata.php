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
    <body>
         <div class="modal fade" id="myModalImportacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-success text-white">
                  <h5 class="modal-title" id="myModalImportacao">Confirmação de Ação</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Importação de Arquivo realizada com sucesso!!
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
             <div class="modal-body">
               Arquivo para importação não foi inserido!
             </div>
             <div class="modal-footer">
               <button type="button" id="modal-btn-sim" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

             </div>
           </div>
         </div>
       </div>
    </body>
       
</html>
<?php
include_once '_conexao.php';
$conn = new conecta();
$conn->verifica_sessao();

function getdados($linha){
    $nf = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
    $date = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
    $cliente = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
    $material = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
    $qtd = $linha->getElementsByTagName("Data")->itemrebeca;
    $pedido = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
    $destino = $linha->getElementsByTagName("Data")->item(6)->nodeValue;
    $int = $linha->getElementsByTagName("Data")->item(7)->nodeValue;
    return array($nf,$date,$cliente,$material,$qtd,$pedido,$destino,$int);
}

//Verifica se o arquivo não está vazio, cria um novo arquivo e carrega com 
//o arquivo temporario. Retorna 1 se nao está vazio.
if(empty($_FILES['arquivo']['temp_name'])){
    $arquivo = new DOMDocument;
    $arquivo->load($_FILES['arquivo']['tmp_name']);
    //carrega na variavel o contudo das linhas
    $linhas = $arquivo->getElementsByTagName("Row");
    
    $contLinha = 1;
    foreach ($linhas as $linha){
        if((!(empty($linhas))) and ($contLinha > 1)){
           $dados = array();
           $dados= getdados($linha);
           $conn->insereDadosPedido($dados);
        }
        $contLinha++;
    }
    echo '<script>$("#myModalImportacao").modal("show")</script>';
    echo "<script>$('#myModalImportacao').on('hidden.bs.modal', function (e) {
                            window.location='envio_pedido.php';
            })</script>";
}
else{
    echo '<script>$("#myModalErro").modal("show")</script>';
    echo "<script>$('#myModalErro').on('hidden.bs.modal', function (e) {
                            window.location='envio_pedido.php';
            })</script>";
   
}
?>
