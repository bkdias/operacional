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
    <script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <title>Gerenciamento de Caminhões</title>
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
        <?php 
        $permissao = $conn->verificaPermissao($login, $tela);
        if(!$permissao){
           echo '<script>$("#myModalPermissao").modal("show")</script>';
           echo "<script>$('#myModalPermissao').on('hidden.bs.modal', function (e) {
                            window.location='index.php';
            })</script>";
         }
         if(isset($_REQUEST['search']))
            $campo = $_REQUEST['consultar'];
        elseif(isset($_GET['campo']))
            $campo=$_GET['campo'];
      
  //verifica a página atual caso seja informada na URL, senão atribui como 1ª página
  $pagina = (isset($_GET['pagina']))? $_GET['pagina'] : 1;
  
//conta todos os itens da tabela que possuem o campo passado
  $qtd_reg = $conn->busca($campo);
  
  //seta a quantidade de itens por página, neste caso, 5 itens 
  $registros = 5;
  
  //calcula o número de páginas arredondando o resultado para cima 
  $numPaginas = ceil($qtd_reg/$registros);
  
  //variavel para calcular o início da visualização com base na página atual 
  $inicio = ($registros*$pagina)-$registros;
  
  //seleciona os itens por página 
   $clientes = $conn->buscaCliente($campo, $inicio, $registros);
   
    ?>
    <script>
    $(document).ready(function(){
	$('a[data-confirm]').click(function(ev){
            var href = $(this).attr('href');
            if(!$('#confirm-delete').length){
                    $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger text-white">EXCLUIR ITEM<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir o item selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Excluir</a></div></div></div></div>');
            }
            $('#dataComfirmOK').attr('href', href);
            $('#confirm-delete').modal({show: true});
            return false;
		
	});
    });
    </script>
    </head>
    <body class="style">
        <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title" id="myModal3">Cadastro de Cliente</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              CLIENTE NÃO CADASTRADO!!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
    </div>
        <div class="div1">
           <img class="vertical-align img-fluid" src="image/yara.png"/>   
           <h5>ATENDIMENTO AO CLIENTE</h5><br>
        </div>
        <div class="p1">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="atend.php">Atendimento</a></li>
              <li class="breadcrumb-item"><a href="search.php">Consultar</a></li>
              <li class="breadcrumb-item active" aria-current="page">Resultado</li>
              <li class="breadcrumb-item"><a href="login.php?acao=logout">Sair</a></li>
            </ol>
        </nav>
        <div class="container">
          <center><h5>Consulta Cliente</h5><br></center>
            <?php 
              if(($qtd_reg)==0){
                echo '<script>$("#myModal3").modal("show")</script>';
                echo "<script>$('#myModal3').on('hidden.bs.modal', function (e) {
                              window.location='search.php';
                         })</script>";
              }
              else{
                 echo '<div class="table-responsive-sm"><table class="table table-hover">
                      <thead>
                       <tr>
                     <th scope="col">Nome</th>
                     <th scope="col">CPF/CNPJ</th>
                     <th scope="col">Tel</th>
                     <th scope="col">Email</th>
                     <th scope="col">Cidade</th>
                     <th scope="col">UF</th>
                     <th scope="col">Observação</th>
                     <th scope="col"><center>Ação</center></th>
                     </tr>
                     </thead><tbody>';

                 foreach($clientes as $cliente){
                   $id=$cliente['id'];$nome=$cliente['nome'];$cpf_cnpj=$cliente['cpf_cnpj'];
                   $tel=$cliente['tel'];$email=$cliente['email'];$cidade=$cliente['cidade'];$uf=$cliente['uf'];
                   $obs=$cliente['obs'];               
                    
                   echo '<tr>
                         <td width="200"><font size="2">'.$cliente['nome'].'</td>
                         <td width="140"><font size="2">'.$cliente['cpf_cnpj'].'</center></td>
                         <td width="160"><font size="2">'.$cliente['tel'].'</center></td>
                         <td width="60"><font size="2">'.$cliente['email'].'</center></td>
                         <td width="100"><font size="2">'.$cliente['cidade'].'</center></td>
                         <td width="20"><font size="2">'.$cliente['uf'].'</center></td>
                         <td width="180"><font size="2">'.$cliente['obs'].'</center></td>
                         <td width="200"><center>
                          <div class="form-row">
                          <div class="form-group col-md-4">
                                <a href="exclusao.php?id='.$id.'&campo='.$campo.'&qtd='.$qtd_reg.'" class="btn btn-danger btn-sm" data-confirm=" " data-dismiss="modal">Excluir</a>
                          </div>
                                   <form name="edita" action="alteracad.php?campo='.$campo.'" method="post">
                                   <input type="hidden" value="'.$nome.'" name="nome">
                                    <input type="hidden" value="'.$cpf_cnpj.'" name="cpf_cnpj">
                                    <input type="hidden" value="'.$tel.'." name="tel">
                                    <input type="hidden" value="'.$email.'" name="email">
                                    <input type="hidden" value="'.$cidade.'" name="cidade">
                                    <input type="hidden" value="'.$uf.'" name="uf">
                                    <input type="hidden" value="'.$obs.'" name="obs">
                                    <input type="hidden" value="'.$id.'" name="id">
                                       <div class="form-group col-md-4">
                                          <input type="submit" value="Editar" name="editar" class="btn btn-info btn-sm">
                                        </div>
                                   </div>
                                    
                                </form>
                                <center>
                                    </td></tr>
                        ';
                }
                echo "</tbody></table>";
            }
            if($qtd_reg > 5){?>
            <nav>
                <ul class="pagination justify-content-center nav-fill">
                   <?php //exibe a paginação 
                    for($i = 1; $i <= $numPaginas; $i++) { ?>
                      <?php if($pagina == $i){ 
                        $classe="active";
                      }else{
                            $classe=" ";
                      }?>
                      <li class="page-item <?php echo $classe?>"><a class="page-link" 
                        href="consulta.php?campo=<?php echo $campo;?>&pagina=<?php echo $i;?>"><?php echo $i;?></a></li>
              <?php } ?>
                    
                </ul>
            </nav>
              <?php  } ?>
        </div>
      </div>
      <div class="footer" >
         <img class="img-fluid" src="image/copyright.png"/>
         POWERED BY REBECA SANTANA - 2020               
      </div>
    </body>
</html>