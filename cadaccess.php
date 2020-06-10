<!DOCTYPE html>
<?php
   include_once '_conexao.php';
   include_once 'funcoes.php';
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
                      
            // INICIO FUNÇÃO DE MASCARA MAIUSCULA
            function maiuscula(z){
              v = z.value.toUpperCase();
              z.value = v;
            }
            document.getElementById('cadastrar').disabled = false;
        </script>
        
<!------------------------------------------------------------------------------------>
     <title>Controle de Entrada</title>
    </head>
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
                      Usuário sem permissão para acessar este módulo!
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>
    <div class="modal fade" id="myModalBloqueio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                      <h5 class="modal-title" id="myModalBloqueio">Restrição de Acesso</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Motorista está bloqueado! Favor acionar Logística ou Expedição!
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>
    <div class="modal fade" id="myModalErroAcesso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                      <h5 class="modal-title" id="myModalErroAcesso">Restrição de Acesso</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Motorista com este CPF já está no pátio!
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>
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
                      Acesso registrado com sucesso!
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>
                  </div>
                </div>
              </div>
    <div class='modal fade' id='ModalMail' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
              <div class='modal-content'>
                <div class='modal-header bg-success text-white'>
                  <h5 class='modal-title' id='ModalMail'>Confirmação de Ação</h5>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Fechar'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                <div class='modal-body'>
                  Email enviado com sucesso!!
                </div>
                <div class='modal-footer'>
                  <button type='button' id='modal-btn-sim' class='btn btn-secondary' data-dismiss='modal'>Fechar</button>
                 </div>
              </div>
            </div>
    </div>   
    <body class="style">
        <script>
            function pegarDataAtual(){
                    data = new Date();
                    document.getElementById('data').value = data.getDate()+'/0'+(data.getMonth()+1)+'/'+data.getFullYear();
                    document.getElementById('horapatio').value = data.getHours()+':'+data.getMinutes();
            }
            $(document).ready(function(){
                $("#cpf").blur(function(){
                    var $motorista = $("#motorista");
                    var $cnh = $("#cnh");
                    var $valcnh = $("#valcnh");
                    var $catcnh = $("#catcnh");
                    var $tel = $("#tel");
                    var $mopp = $("#mopp");
                    var $placacav = $("#placacav");
                    var $placacar = $("#placacar");
                    var $vendor = $("#vendor");
                    var $transp = $("#transp");
                    var $frete = $("#frete");
                    var $cliente = $("#cliente");
                    var $tipocam = $("#tipocam");
                    var $grade = $("#grade");
                    var $comp = $("#comp");
                    var $tam = $("#tam");
                    var $data = $("#data");
                   
                    $.getJSON('json1.php',{
                        cpf: $(this).val()
                    },function(json){
                      if($motorista.val(json.motorista)!==''){
                        $cnh.val(json.cnh);
                        $valcnh.val(json.valcnh);
                        $catcnh.val(json.catcnh);
                        $tel.val(json.tel);
                        $mopp.val(json.mopp);
                        $placacav.val(json.placacav);
                        $placacar.val(json.placacar);
                        $vendor.val(json.vendor);
                        $transp.val(json.transp);
                        $frete.val(json.frete);
                        $cliente.val(json.cliente);
                        $tipocam.val(json.tipocam);
                        $grade.val(json.grade);
                        $tam.val(json.tam);
                        $comp.val(json.comp);
                       }
                    });
                    //pegarDataAtual();
                   });
                   
                   });
                
        </script>
     <div class="div1">
          <img class="vertical-align" class="img-fluid" src="image/yara.png"/>   
            <h5>CONTROLE DE ENTRADA E SAÍDA PARA CARREGAMENTO</h5><br>   
      </div>
     
      <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Página Inicial</a></li>
              <li class="breadcrumb-item"><a href="acesso.php">Controle de Acesso</a></li>
              <li class="breadcrumb-item active" aria-current="page">Entrada</li>
              <li class="breadcrumb-item"><a href="login.php?acao=logout">Sair</a></li>
            </ol>
      </nav>
      <div class="container">
        <center><h5>ENTRADA - PORTARIA I</h5></center><br>
          <form name="cadastro" method="post" enctype="multipart/form-data">
           <div class="form-row">
                 <div class="form-group col-md-2">
                    <label>CPF:</label><input class="form-control" type="text" name="cpf" id="cpf" size="14"maxlength="14" required class="form-control" data-mask-for-cpf-cnpj/>
                 </div>
                 <div class="form-group col-md-3">
                    <label>Motorista:</label><input type="text" name="motorista" id="motorista" size="30" required class="form-control"/>
                 </div>
               <div class="form-group col-md-2">
                   <label>CNH:</label><input type="text" name="cnh" size="15" maxlength="15" id="cnh" required class="form-control"/> 
               </div>
               <div class="form-group col-md-2">
                <label>Val. CNH:</label><input type="date" name="valcnh" size="10" id="valcnh" required class="form-control"/>   
               </div>
               <div class="form-group col-md-1">
                      <label>Cat CNH:</label><input type="text" size="1" maxlength="1" name="catcnh" id="catcnh" onkeyup="maiuscula(this)" required class="form-control"/>
               </div>
               <div class="form-group col-md-2">
                   <label>Telefone:</label> <input type="text" name="tel"size="15" maxlength="15" id="tel" required class="form-control" onkeypress="$(this).mask('(00) 0 0000-0000 / 0 0000-0000');">
               </div>
           </div>
              <div class="form-row">
                <div class="form-group col-md-1">
                    <label>Mopp</label><select name="mopp" id="mopp" required class="form-control" >
                            <option value="0" selected> </option>
                            <option value="SIM">SIM</option>
                            <option value="NAO">NÃO</option>
                           </select>
                  </div>
                <div class="form-group col-md-2">
                    <label>  Placa Cavalo/UF: </label><input type="text" name="placacav" id="placacav" size="10" required class="form-control"/>
                </div>
                <div class="form-group col-md-2">
                    <label>  Placa Carreta/UF: </label><input type="text" name="placacar" id="placacar" size="10" required class="form-control"/>
                </div>
                <div class="form-group col-md-2">
                  <label> Vendor:</label> <input type="text" name="vendor" id="vendor" size="10" required class="form-control"/>   
                </div>
                <div class="form-group col-md-4">
                 <label>  Transportadora:</label> <input type="text" name="transp" id="transp" size="30" required class="form-control"/>  
                </div>
                <div class="form-group col-md-1">
                  <label>Frete:</label> <select name="frete" id="frete" required class="form-control">
                                            <option selected></option>
                                            <option value="CIF">CIF</option>
                                            <option value="FOB">FOB</option>
                                        </select>
                </div>
                </div>
              <div class="form-row">
                <div class="form-group col-md-4">
                    <label> Cliente:</label><input type="text" id="cliente" name="cliente" size="30" required class="form-control"/>
                </div>
                <div class="form-group col-md-2">
                    <label>  Data:</label><input name="data" id="data" type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control"/>
                </div>
                <div class="form-group col-md-2">
                    <label> Entrada Patio:</label><input name="horapatio" id="horapatio" type="time" value="<?php echo date('H:i'); ?>"  class="form-control"/>  
                </div>
                <div class="form-group col-md-2">
                    <label>  Entrada Portaria:</label><input name="horaport" type="time" class="form-control"/>   
                </div>
                <div class="form-group col-md-2">
                    <label>Operação</label> <select name="operacao" id="operacao" required class="form-control">
                                                <option value="0" selected> </option>
                                                <option value="Carregamento">Carregamento</option>
                                                <option value="Descarga">Descarga</option>
                                            </select>
                </div>
              </div>
             <div class="form-row">
                <div class="form-group col-md-2">
                  <label> Tipo Cam.:</label> <select name="tipocam" id="tipocam" required class="form-control">
                                <option value="0" selected> </option>
                                <option value="TRUCK">TRUCK</option>
                                <option value="BITRUCK">BI-TRUCK</option>
                                <option value="CACAMBA">CAÇAMBA</option>
                                <option value="LS SIMPLES">LS SIMPLES</option>
                                <option value="LS TRUCK">LS TRUCK</option>
                                <option value="VANDERLEIA">VANDERLEIA</option>
                                <option value="BITREM">BITREM</option>
                                <option value="RODOTREM">RODOTREM</option>
                           </select>
                </div>
                <div class="form-group col-md-2">
                    <label>Status:</label><select name="status" id="status" required class="form-control">
                                                <option value="0" selected> </option>
                                                <option value="Aguardando">Aguardando</option>
                                                <option value="Concluido">Concluido</option>
                                                <option value="Desistencia">Desistencia</option>
                                           </select>
                </div>
                 <div class="form-group col-md-2">
                     <label> Nº Pedido:</label> <input type="text" name="pedido" size="12" required class="form-control"/>
                 </div>
                <div class="form-group col-md-2">
                     <label> Grade:</label> <select name="grade" id="grade" required class="form-control">
                                                <option value="0" selected> </option>
                                                <option value="ALTA">ALTA</option>
                                                <option value="BAIXA">BAIXA</option>
                                        </select>
                </div>
                <div class="form-group col-md-2">
                   <label>Comprimento:</label> <select name="comp" id="comp" class="form-control">
                                                  <option value="0" selected> </option>
                                                  <option value="CURTO">CURTO</option>
                                                  <option value="LONGO">LONGO</option>
                                               </select>
                </div>
                <div class="form-group col-md-2">
                    <label>Tamanho:</label> <select name="tam" id="tam" class="form-control">
                                                <option value="0" selected> </option>
                                                <option value="25MT">25MT</option>
                                                <option value="30MT">30MT</option>
                                                <option value="SIDER">SIDER</option>
                                            </select>
               </div>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-7">
                      <label>EPI's: </label><br>
                  <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" name="epi[]" value="Capacete"/>
                    <label class="form-check-label" for="epi[]">Capacete</label>
                  </div>
                   <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" name="epi[]" value="Oculos"/>
                    <label class="form-check-label" for="epi[]">Oculos</label>
                   </div>
                   <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" name="epi[]" value="Sapato Fechado"/>
                    <label class="form-check-label" for="epi[]">Sapato Fechado</label>
                   </div>
                   <div class="form-check form-check-inline">
                    <input type="checkbox" class="form-check-input" name="epi[]" value="Faixa Refletiva"/>
                    <label class="form-check-label" for="epi[]">Faixa Refletiva</label>
                   </div>
                   <div class="form-check form-check-inline">
                       <input type="checkbox" class="form-check-input" name="epi[]" checked value="Nenhum"/>
                    <label class="form-check-label" for="epi[]">Nenhum</label>
                   </div>
                  </div>
              <div class="form-group col-md-5">
                       <label> OBS.:</label> <input type="text" name="obs" size="40" class="form-control"/>
              </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-2"><input type="hidden" name="bloqueio" id="bloqueio"/></div>
                <div class="form-group col-md-2"></div>
                  <div class="form-group col-md-3">
                      <button type="submit" name="cadastrar" id="cadastrar" class="btn btn-info">Cadastrar</button>
                  </div>
                 <div class="form-group col-md-3">
                      <input type="reset" name="reset" value="Limpar" class="btn btn-danger"/>
                 </div>
                    </center>
                  </div>
              </form>
           </div>
        <div  class="footer" >
            <img class="img-fluid" src="image/copyright.png"/>
            POWERED BY REBECA SANTANA - 2020             
        </div>
     
    </body>
</html>
 <?php
     if(isset($_POST['cadastrar'])){
           $nome= $_POST['motorista'];
           $cpf= $_POST['cpf'];
           $cnh= $_POST['cnh'];
           $catcnh= $_POST['catcnh'];
           $valcnh=$_POST['valcnh'];
           $fone=$_POST['tel'];
           $placacav= $_POST['placacav'];
           $placac=$_POST['placacar'];
           $vendor=$_POST['vendor'];
           $transp= $_POST['transp'];
           $cliente=$_POST['cliente'];
           $data= $_POST['data'];
           $entradaPatio= $_POST['horapatio'];
           $entradaPor=$_POST['horaport'];
           $op= $_POST['operacao'];
           $status= $_POST['status'];
           $mopp = $_POST['mopp'];
           $obs= $_POST['obs'];
           $frete = $_POST['frete'];
           $tipocam= $_POST['tipocam'];
           $grade= $_POST['grade'];
           $comp= $_POST['comp'];
           $tam= $_POST['tam'];
           $epis= $_POST['epi'];
           $epi= implode(", ", $epis);
           $pedido=$_POST['pedido'];
    $acesso = array($nome,$cpf,$cnh,$catcnh,$placac,$cliente,$data,$entradaPatio,
            $op,$status,$obs,$valcnh,$fone,$placacav,$transp,$mopp,$entradaPor,
            $tipocam,$grade,$comp,$tam,$vendor,$epi,$frete,$pedido);
     if(!$conn->consultaBloqueio($cpf)){
        if($conn->insereCaminhao($acesso)){
            $data1 = $conn->converte_data($data);
         echo '<script>$("#myModalAcesso").modal("show")</script>';
         echo "<script>$('#myModalAcesso').on('hidden.bs.modal', function (e) {
               })</script>";
         if(EnviaAlertaChegada($acesso,$data1)){
            echo '<script>$("#ModalMail").modal("show")</script>';
         }
         
         }else{
          echo '<script>$("#myModalErroAcesso").modal("show")</script>';
        }
       }
       else{
         echo '<script>$("#myModalBloqueio").modal("show")</script>';
       }
    }    