<?PHP
  include_once '_conexao.php';
   $conn = new conecta();
   $conn->verifica_sessao();
   if(isset($_GET['acao'])=='logout')
     @session_destroy();
   $tela="1";
   $login = $_SESSION['login'];
   $campo=$_GET['campo'];
   if (isset($_POST['editar'])){
      $nome= $_POST['nome'];
      $cpf_cnpj= $_POST['cpf_cnpj'];
      $tel= $_POST['tel'];
      $email= $_POST['email'];
      $cidade= $_POST['cidade'];
      $uf= $_POST['uf'];
      $obs= $_POST['obs'];
      $id= $_POST['id'];
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
     <title>Atendimento ao Cliente</title>
    </head>
    <body class="style">
      <div class="div1">
        <img class="vertical-align" class="img-fluid" src="image/yara.png"/>   
        <h5>ATENDIMENTO AO CLIENTE</h5><br>
      </div>
      <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="atend.php">Atendimento</a></li>
                  <li class="breadcrumb-item"><a href="search.php">Consulta</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Alteração</li>
                  <li class="breadcrumb-item"><a href="login.php?acao=logout">Sair</a></li>
                </ol>
       </nav>
            <div class="container">
                <center><h5>Alteração de Cadastro</h5></center><br>
             <form name="cadastro" method="post" enctype="multipart/form-data">
               <div class="form-row">
                   <div class="form-group col-md-3">
                    <label>Nome Completo: </label> <input type="text" name="nome" maxlength="50" id="nome" value="<?php echo $nome?>" required size="50" class="form-control"/>
                   </div>
                   <div class="form-group col-md-3">
                    <label>CPF/CNPJ: </label> <input type="text" name="cpf_cnpj" maxlength="18" id="cpf" value="<?php echo $cpf_cnpj?>" required class="form-control" data-mask-for-cpf-cnpj>
                   </div>
                   <div class="form-group col-md-3">
                    <label>Email</label> <input type="text" name="email" maxlength="30" value="<?php echo $email?>" required class="form-control"/>
                   </div>
                   <div class="form-group col-md-3">
                    <label>Telefone: </label> <input type="text" name="tel" maxlength="40" value="<?php echo $tel?>" required id="tel" class="form-control" onkeypress="$(this).mask('(00) 0 0000-0000 / 0 0000-0000');"/>
                   </div>
                </div>
               <div class="form-row">
                   <div class="form-group col-md-3">
                    <label>Cidade: </label> <input type="text" maxlength="30" name="cidade" value="<?php echo $cidade?>" required class="form-control"/>
                   </div>
                   <div class="form-group col-md-1">
                    <label>UF: </label> <input type="text" name="uf" id="uf" value=<?php echo $uf?> required maxlength="2" class="form-control" onkeypress="$(this).val($(this).val().toUpperCase());"/>
                   </div>
                   <div class="form-group col-md-8">
                    <label>OBS: </label> <input type="text" name="obs" maxlength="45" value="<?php echo $obs?>" required class="form-control"/>
                   </div>
               </div>
               <div class="form-row">
                   
                   <div class="form-group col-md-4">
                       <input type="hidden" name="id" value="<?php echo $id?>"/>
                   </div>
                   <div class="form-group col-md-2">
                       <input type="submit" name="atualizar" value="Atualizar" class="btn btn-info"/>
                   </div>
                  <div class="form-group col-md-2">
                      <a class="btn btn-danger text-white" onClick='window.location="consulta.php?campo=<?php echo $campo?>"'>Cancelar</a>
                  </div>
                  <div class="form-group col-md-4"></div>
             </form>
           </div>
       </div>
        <div class="footer" >
              EQUIPE DE TI - 2019                
        </div>
    </body>
    <div class="modal fade" id="myModalRefresh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="myModalRefresh" bg-success text-white>Cadastro de Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Informações Atualizadas!!
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
      <div class="modal-body alert-danger">
        "ERRO - Registro não foi atualizado!!!"
      </div>
      <div class="modal-footer">
        <button type="button" id="modal-btn-sim" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>
</html>
<?php
if(isset($_REQUEST['atualizar'])){
      $nome= $_REQUEST['nome'];
      $cpf_cnpj= $_REQUEST['cpf_cnpj'];
      $tel= $_REQUEST['tel'];
      $email= $_REQUEST['email'];
      $cidade= $_REQUEST['cidade'];
      $uf= $_REQUEST['uf'];
      $obs= $_REQUEST['obs'];
      $id= $_REQUEST['id'];
      $registro= array($nome,$cpf_cnpj,$tel,$email,$cidade,$uf,$obs,$id);
      if($conn->atualizaCliente($registro)){
          echo '<script>$("#myModalRefresh").modal("show");</script>';
          echo '<script>$("#myModalRefresh").on("hidden.bs.modal", function (e) {
                              window.location="consulta.php?campo='.$campo.'";
          })</script>';
      }
      else{
          echo '<script>$("#myModalErro").modal("show");</script>'; 
      }
          
  }