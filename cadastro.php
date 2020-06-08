<?php
    include_once '_conexao.php';
    $conn = new conecta();
    $conn->verifica_sessao();
    if(isset($_GET['acao'])=='logout')
      @session_destroy();
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
       
        <title>Atendimento ao Cliente</title>
        
        <!----------------formatação dos inputs---------------------------------------------->
        <script type="text/javascript">
            $("#cpf").mask("'000.000.000-00'");
            $("#uf").mask("'AA'");
            $("#tel").mask("'(00) 0 0000-0000 / 0 0000-0000'");
            $(document).on('keydown', '[data-mask-for-cpf-cnpj]', function (e) {
                var digit = e.key.replace(/\D/g, '');
                var value = $(this).val().replace(/\D/g, '');
                var size = value.concat(digit).length;
                $(this).mask((size <= 11) ? '000.000.000-00' : '00.000.000/0000-00');
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
                      Você não tem permissão para acessar este módulo!
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>
        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                  <h5 class="modal-title" id="myModal2">Cadastro de Cliente</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Cliente com CPF/CNPJ já cadastrado!!
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
              </div>
            </div>
          </div>
        <script type="text/javascript">
          $(document).ready(function(){
            $("#cpf_cnpj").blur(function(){
                  var $nome = $("#nome");
                  var $email = $("#email");
                  var $tel = $("#tel");
                  var $cidade = $("#cidade");
                  var $uf = $("#uf");
                  var $obs = $("#obs");
                  $.getJSON('json.php',{
                      cpf_cnpj: $(this).val()
                  },function(json){
                     if($nome.val(json.nome)!==''){
                      $email.val(json.email);
                      $tel.val(json.tel);
                      $cidade.val(json.cidade);
                      $uf.val(json.uf);
                      $obs.val(json.obs);
                      $("#myModal2").modal("show");
                      $('#myModal2').on('hidden.bs.modal', function (e) {
                          window.location='cadastro.php';
                      });
                      }
                    });
                   });
                 });
               
           
        </script>
       
        <?php 
        $permissao = $conn->verificaPermissao($login, $tela);
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
      <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.php">Página Inicial</a></li>
                   <li class="breadcrumb-item"><a href="atend.php">Atendimento</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Cadastro</li>
                  <li class="breadcrumb-item"><a href="login.php?acao=logout">Sair</a></li>
                </ol>
      </nav>
      <div class="container">
        
        <center><h5>Cadastro de Cliente</h5></center><br>
        <form name="cadastro" method="post" enctype="multipart/form-data">
         <div class="form-row">
          <div class="form-group col-md-3">
              <label>CPF/CNPJ:</label> <input type="text" name="cpf_cnpj" id="cpf_cnpj" maxlength="18" required class="form-control" data-mask-for-cpf-cnpj/>
          </div>
          <div class="form-group col-md-3">
          <label>Nome Completo:</label> <input type="text" name="nome" id="nome" maxlength="50" required class="form-control"/>
          </div>
          <div class="form-group col-md-3">
              <label>Email:</label> <input type="email" name="email" id="email" maxlength="30" required class="form-control"/>
          </div>
          <div class="form-group col-md-3">
              <label>Telefone:</label> <input type="text" name="tel" maxlength="40" id="tel" required class="form-control" onkeypress="$(this).mask('(00) 0 0000-0000 / 0 0000-0000');"/>
          </div>
         </div>
         <div class="form-row">
         <div class="form-group col-md-3">
             Cidade: <input type="text" name="cidade" id="cidade" maxlength="30" required class="form-control"/>
         </div>
         <div class="form-group col-md-1">
             UF: <input type="text" name="uf" id="uf" required maxlength="2" onkeyup="$(this).val($(this).val().toUpperCase());" class="form-control"/>
         </div>
          <div class="form-group col-md-8">
              Observação: <input type="text" name="obs" id="obs" required maxlength="45" class="form-control"/>
          </div>
         </div>
         <div class="form-row">
            <div class="form-group col-md-2"></div>
            <div class="form-group col-md-3">
             <button type="submit" name="cadastrar" class="btn btn-info">Cadastrar</button>
            </div>
            <div class="form-group col-md-3">
             <button type="reset" name="reset" class="btn btn-danger"/>Limpar</button>
            </div>
           <div class="form-group col-md-3">
               <a href="import_cliente.php" name="importar" class="btn btn-secondary">Importar</a>
           </div>
          </div>
        </form>
    </div>
       </div>
    </div>
        <div class="footer" >
            <img class="img-fluid" src="image/copyright.png"/>
            POWERED BY REBECA SANTANA - 2020
        </div>
    </body>
    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="myModal1" bg-success text-white>Cadastro de Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Cliente cadastrado com sucesso!!
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
                  <h5 class="modal-title" id="myModalErro">Cadastro de Cliente</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Erro ao tentar cadastrar!! Procure o Administrador.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
              </div>
            </div>
          </div>
    
</html>
 <?php
     if(isset($_REQUEST['cadastrar'])){
           $nome= $_REQUEST['nome'];
           $cpf_cnpj= $_REQUEST['cpf_cnpj'];
           $tel= $_REQUEST['tel'];
           $email= $_REQUEST['email'];
           $cidade= $_REQUEST['cidade'];
           $uf= $_REQUEST['uf'];
           $obs= $_REQUEST['obs'];
           $cliente = array($nome,$cpf_cnpj,$tel,$email,$cidade,$uf,$obs);
           if($conn->insereCliente($cliente)){
              echo'<script>$("#myModal1").modal("show")</script>';
                  
           }else{
               echo '<script>$("#myModal2").modal("show")</script>';
           }
     }