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
             <div class="modal-header bg-success text-white">
               <h5 class="modal-title" id="myModalErro">Confirmação de Ação</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               Erro na Importação!!
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
  
function importacliente($linha){
    $nome = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
    $cpf_cnpj = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
    $tel = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
    $email = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
    $cidade = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
    $uf = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
    $obs = $linha->getElementsByTagName("Data")->item(6)->nodeValue;
    return array($nome,$cpf_cnpj,$tel,$email,$cidade,$uf,$obs);
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
            $dados= importacliente($linha);
           $resultado = $conn->insereCliente($dados);
        }
        $contLinha++;
    }
    echo '<script>$("#myModalImportacao").modal("show")</script>';
    echo "<script>$('#myModalImportacao').on('hidden.bs.modal', function (e) {
                            window.location='cadastro.php';
            })</script>";
    #Redireciona para página inicial
    
}
else{
    echo '<script>$("#myModalErro").modal("show")</script>';
    echo "<script>$('#myModalErro').on('hidden.bs.modal', function (e) {
                            window.location='cadastro.php';
            })</script>";
}

