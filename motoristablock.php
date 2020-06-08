<?PHP
  include("verifica_sessao.php");
  include("funcoes.php");
  if(isset($_GET['acao'])=='logout')
     @session_destroy();
 ?>     
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/estilo.css" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="image/favicon.png"/>
        <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
        <script type="text/javascript" src="js/jquery.mask.min.js"></script>
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
                
         $(document).ready(function(){
                $("input[name='cpfmotorista']").blur(function(){
                    var $nome = $("input[name='nome']");
                    $.getJSON('funcoes.php',{
                        cpfmotorista: $(this).val()
                    },function (json){
                        $nome.val(json.nome);
                    });
                });
            });
        });
        </script>
<!------------------------------------------------------------------------------------>
     <title>Logistica</title>
    </head>
    <body class="style">
      <div class="div1">
        <img class="vertical-align" src="image/yara.png"/>  
        LOGÍSTICA<br><br>
      </div>
       <div class="p1">
        <div class="back"> <p align="left"><a href="motorista.php"><img src="image/voltar.png" title="Voltar"/></a></p></div>
        <p align= "right" style="margin-right: 20px;">
            <?php echo 'Usuário logado: '.$_SESSION['login'].' / '?>
            <a href="login.php?acao=logout">Sair</a><br><br>
        </p>
        <br><br>
        <center><strong><p>BLOQUEIO / LIBERAÇÃO DE MOTORISTA</p><br><br><br><br><br></strong></center>
           <center>
            <form name="cadastro" method="post" enctype="multipart/form-data">
              CPF: <input type="text" name="cpfmotorista" id="cpfmotorista" maxlength="14" required class="input_buton" class= "form-control" data-mask-for-cpf-cnpj>&nbsp;&nbsp;
              Motorista: <input type="text" name="nome" id="nome" size="30" required class="input_buton"/>&nbsp;&nbsp;
              Status: <select name="status" id="status" required class="input_buton">
                        <option value=" " selected> </option>
                        <option value="0">BLOQUEAR</option>
                        <option value="1">LIBERAR</option>
                      </select>&nbsp;&nbsp;
              Observação: <input type="text" name="obs" size="40" id="obs" class="input_buton"/>
                <br><br><br><br><br><br>
             <input type="submit" name="enviar" value="Enviar" class="botaosubmit"/>&nbsp;&nbsp;
            </form>
          </center>
        </div>
      
      <div class="footer" >
            EQUIPE DE TI - 2019                
      </div>
     
    </body>
</html>
 <?php
 
 if(isset($_REQUEST['enviar'])){
    $nome= $_REQUEST['nome'];
    $cpf= $_REQUEST['cpfmotorista'];
    $status= $_REQUEST['status'];
    $obs= $_REQUEST['obs'];
    $motorista = array($nome,$cpf,$status,$obs);
    if(bloqueia_motorista($motorista, $conexao)){
        EnviaAlertaBloqueio($motorista);
        echo "<script>window.location='logistica.php';</script>";
    }else{
       echo '<script>alert("ERRO!!!")</script>';
     }
 }
 
 